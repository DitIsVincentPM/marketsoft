<?php

namespace App\Http\Controllers;

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

        return view('products.index', [
            'products' => $products,
            'users' => $users,
            'categorys' => $category,
        ]);
    }

    public function Product(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $product->seller_id)->first();

        return view('products.view', [
            'product' => $product,
            'user' => $user,
        ]);
    }
}
