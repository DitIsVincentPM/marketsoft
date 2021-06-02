<?php

namespace App\Http\Controllers;

use App\Helpers\ShoppingCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Products;
use PayPal;
use Carbon\Carbon;
use App\Models\Payment_Gateways;
use App\Models\ca_ownedProducts;
use App\Models\ca_Invoices;

class ShoppingCartController
{
    public function index()
    {
        $products = Products::get();
        $items = ShoppingCart::GetShoppingCart();
        $payment_gateaways = Payment_Gateways::get();

        return view('Products.shoppingcart', [
            'products' => $products,
            'items' => $items,
            'payment_gateaways' => $payment_gateaways,
        ]);
    }

    public function Status(Request $request)
    {
        return view('Products.status', [
            'status' => $request->input('status'),
        ]);
    }

    public function Checkout(Request $request)
    {
        if(!Auth::check()) {
            return redirect()->route('shoppingcart')->with('error', "The needed information isn't sent trough");
        }

        return redirect(ShoppingCart::GeneratePaypalLink($request));
    }

    public function Callback(Request $request){
        $provider = PayPal::setProvider('express_checkout');

        $token = $request->input('token');
        $PayerID = $request->input('PayerID');

        if($PayerID == null or $token == null) {
            return redirect()->route('index')->with('error', "The needed information isn't sent trough");
        }

        $response = $provider->getExpressCheckoutDetails($token);

        $data = [];
        $data["total"] = $response["AMT"];
        $data["items"] = [];
        $data["invoice_description"] = $response["DESC"];
        $data["invoice_id"] = $response["INVNUM"];

        $json = $provider->doExpressCheckoutPayment($data, $token, $PayerID);
        if($json["PAYMENTINFO_0_PAYMENTSTATUS"] == "Completed") {
            ca_Invoices::where('id', $response["INVNUM"])->update([
                'status' => 2,
                'paypal_id' => $json["PAYMENTINFO_0_TRANSACTIONID"],
                'token' => $token,
                'payer_id' => $PayerID,
            ]);

            ca_ownedProducts::where('invoice_id', $response["INVNUM"])->update([
                'status' => '0',
            ]);

            $products = ca_ownedProducts::where('invoice_id', $response["INVNUM"])->get();

            foreach($products as $p) {
                DB::table('products')->where('id', $p->product->id)->update([
                    'purchases' => $p->product->purchases + 1,
                ]);
            }

            DB::table('shoppingcart')->where('ip', $request->ip())->delete();

            return redirect('/shoppingcart/status?status=success');
        } else if($json["PAYMENTINFO_0_PAYMENTSTATUS"] == "Pending") {
            DB::table('ca_invoices')->where('id', $response["INVNUM"])->update([
                'status' => 0,
                'token' => $token,
                'payer_id' => $PayerID,
            ]);

            return redirect('/shoppingcart/status?status=processing');
        } else if($json['PAYMENTINFO_0_PAYMENTSTATUS'] == 'fail' or $json['PAYMENTINFO_0_PAYMENTSTATUS'] == 'failed') {
            DB::table('ca_invoices')->where('id', $response["INVNUM"])->update([
                'status' => 4,
                'token' => $token,
                'payer_id' => $PayerID,
            ]);

            return redirect('/shoppingcart/status?status=canceld');
        }

        return redirect()->route('index')->with('error', "Sorry, An error was encounterd.");
    }

}
