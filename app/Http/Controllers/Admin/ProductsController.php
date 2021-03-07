<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\InputCheck as InputCheck;
use DB;
use Products;

class ProductsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $products = DB::table('products')->get();

        return view('Admin.products', [
            'products' => $products,
        ]);
    }

    public function view(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if($product == null) return redirect()->route('admin.products')->with('error', "Oops! There isn't any product with that id.");

        return view('Admin.Products.view', [
            'product' => $product,
        ]);
    }
}