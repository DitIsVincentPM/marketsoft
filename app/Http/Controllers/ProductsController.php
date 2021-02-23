<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Hash;
use Auth;

class ProductsController
{
    public function Home()
    {
        $products = DB::table('products')->get();
        $users = DB::table('users')->get();
        $category = DB::table('category')->get();

        return view('Products.index', [
            'products' => $products,
            'users' => $users,
            'categorys' => $category,
        ]);
    }

    public function Product(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $product->seller_id)->first();

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
