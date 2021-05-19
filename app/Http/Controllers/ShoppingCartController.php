<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Database\Products;
use PayPal;
use Carbon\Carbon;

class ShoppingCartController
{
    public function index()
    {
        $products = Products::get();
        $items = ShoppingCart::GetShoppingCart();

        return view('Products.shoppingcart', [
            'products' => $products,
            'items' => $items,
        ]);
    }

    public function Status(Request $request)
    {
        return view('Products.status', [
            'status' => $request->input('status'),
        ]);
    }

    public function Checkout()
    {
        if(!Auth::check()) {
            return redirect()->route('shoppingcart')->with('error', "The needed information isn't sent trough");
        }

        return redirect(ShoppingCart::GeneratePaypalLink());
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

        dd($json = $provider->doExpressCheckoutPayment($data, $token, $PayerID));        
        if($json["PAYMENTINFO_0_PAYMENTSTATUS"] == "Completed") {
            DB::table('ca_invoices')->where('id', $response["INVNUM"])->update([
                'status' => 2,
            ]);

            DB::table('shoppingcart')->where('ip', $request->ip())->delete();
    
            return redirect('/shoppingcart/status?status=success');
        } else if($json["PAYMENTINFO_0_PAYMENTSTATUS"] == "Pending") {
            DB::table('ca_invoices')->where('id', $response["INVNUM"])->update([
                'status' => 0,
            ]);
    
            return redirect('/shoppingcart/status?status=processing');
        } else if($json['PAYMENTINFO_0_PAYMENTSTATUS'] == 'fail' or $json['PAYMENTINFO_0_PAYMENTSTATUS'] == 'failed') {
            DB::table('ca_invoices')->where('id', $response["INVNUM"])->update([
                'status' => 4,
            ]);
    
            return redirect('/shoppingcart/status?status=canceld');
        }
    
        return redirect()->route('index')->with('error', "Sorry, An error was encounterd.");
    }

}
