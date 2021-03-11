<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use PayPal;
use Request;
use Shorten;

class ShoppingCart extends Model
{
    public static function GetShoppingCart() {
        $shoppingcart_items = DB::table('shoppingcart')->where('ip', Request::ip())->get();
        return $shoppingcart_items;
    }

    public static function AddProduct($product)
    {
        $prod = DB::table('products')->where('id', $product)->first();
        $shoppingcart_items = DB::table('shoppingcart')->where('ip', Request::ip())->get();

        if ($shoppingcart_items == null) {
            DB::table('shoppingcart')->insert([
                'product_id' => $product,
                'ip' => Request::ip(),
                'qty' => 1,
            ]);
        }

        foreach ($shoppingcart_items as $item) {
            if ($product == $item->product_id) {
                DB::table('shoppingcart')->where('ip', Request::ip())->where('product_id', $product)->update([
                    'qty' => $item->qty + 1,
                ]);

                return "$prod->name is added to your shopping cart.";
            }
        }

        DB::table('shoppingcart')->insert([
            'product_id' => $product,
            'ip' => Request::ip(),
            'qty' => 1,
        ]);

        return "$prod->name is added to your shopping cart.";
    }

    public static function RemoveProduct($product)
    {
        $prod = DB::table('products')->where('id', $product)->first();
        $shoppingcart_item = DB::table('shoppingcart')->where('product_id', $product)->where('ip', Request::ip())->first();

        if($shoppingcart_item->qty == 1) {
            DB::table('shoppingcart')->where('product_id', $product)->where('ip', Request::ip())->delete();
        } elseif($shoppingcart_item->qty > 1) {
            DB::table('shoppingcart')->where('product_id', $product)->where('ip', Request::ip())->update([
                'qty' => $shoppingcart_item->qty - 1,
            ]);
        }

        DB::table('shoppingcart')->where('product_id', $product)->where('ip', Request::ip())->delete();

        return "$prod->name is removed from your shopping cart.";
    }

    public static function GeneratePaypalLink()
    {
        $provider = PayPal::setProvider('express_checkout');

        $shoppingcart_items = DB::table('shoppingcart')->where('ip', Request::ip())->get();
        $products = DB::table('products')->get();

        $invoices = DB::table('ca_invoices')->get();
        $invoice_id = count($invoices) + 1;

        $data['items'] = [];
        $index = 0;

        foreach ($shoppingcart_items as $item) {
            foreach ($products as $product) {
                if ($product->id == $item->product_id) {
                    $data['items'][$index]["name"] = Shorten::string($product->name, 40);
                    $data['items'][$index]["price"] = $product->price;
                    $data['items'][$index]["desc"] = Shorten::string($product->description, 40);
                    $data['items'][$index]["qty"] = 1;
                }
            }
            $index++;
        }

        $data['invoice_description'] = "Invoice #$invoice_id";
        $data['return_url'] = url('/');
        $data['cancel_url'] = url('/');
        $data['invoice_id'] = $invoice_id;

        $total = 0;
        foreach ($data['items'] as $item) $total += $item['price'] * $item['qty'];
        $data['total'] = $total;

        $response = $provider->setExpressCheckout($data);

        return redirect($response['paypal_link']);
    }
}
