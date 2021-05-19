<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Database\Products;

class ProductsController
{
    public function Home()
    {
        $products = Products::get();
        $users = DB::table('users')->get();

        return view('Products.index', [
            'products' => $products,
            'users' => $users,
        ]);
    }

    public function Product(Request $request, $id)
    {
        $product = Products::where('id', $id)->first();

        if ($product == null) {
            return redirect()->route('index')->with('error', 'Oops! It seems that this product does not exist.');
        }

        $user = DB::table('users')->where('id', $product->seller_id)->first();

        // Cookie Check
        $cookie = 'product-' . $id;
        if (!$request->session()->has($cookie)) {
            DB::table('products')->where('id', $id)->update([
                'views' => $product->views + 1,
            ]);
            $request->session()->put($cookie, '1');
        }

        return view('Products.view', [
            'product' => $product,
            'user' => $user,
        ]);
    }

    public function RemoveProduct(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $response = ShoppingCart::RemoveProduct($id);

        return redirect()->back()->with('success', "$product->name is removed from your shoppingcart.");
    }

    public function AddProduct(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $response = ShoppingCart::AddProduct($id);

        return redirect()->back()->with('success', "$product->name is added from your shoppingcart.");
    }
}
