<?php

namespace App\Http\Controllers;

use App\Helpers\ShoppingCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Products;
use App\Models\Product_Categories;

class ProductsController
{
    public function Home(Request $request, $category = null)
    {
        if($category == null) {
            $products = Products::get();
        } else {
            $categories = Product_Categories::where('name', $category)->first();
            if($categories == null) {
                $products = Products::get();
            } else {
                $products = Products::where('category', '=', $categories->id)->get();
            }
        }
        $categories = Product_Categories::get();
        $users = DB::table('users')->get();

        return view('Products.index', [
            'products' => $products,
            'users' => $users,
            'categories' => $categories,
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
