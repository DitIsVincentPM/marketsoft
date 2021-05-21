<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Modules;
use App\Models\Product_Images;
use App\Models\Product_Sections;
use App\Models\Product_Categories;

class ProductsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $products = Products::get();

        return view('Admin.products', [
            'products' => $products,
        ]);
    }

    public function view(Request $request, $id)
    {
        $product = Products::where('id', $id)->first();
        $modules = Modules::where('type', 2)->get();

        if($product == null) return redirect()->route('admin.products')->with('error', "Oops! There isn't any product with that id.");

        return view('Admin.Products.view', [
            'product' => $product,
            'modules' => $modules,
        ]);
    }

    public function image(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image',
        ]);
        
        $product = DB::table('products')->where('id', $id)->first();
        if($product == null) return redirect()->route('admin.products')->with('error', "Oops! There isn't any product with that id.");

        $file = $request->file('image');

        Product_Images::where('product_id', $id)->insert([
            'product_id' => $id,
            'type' => '2',
        ]);

        $image = Product_Images::latest()->first();

        $new_name = $product->id . '-' . $image->id . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/products'), $new_name);

        Product_Images::where('id', $image->id)->update([
            'image_url' => $new_name,
        ]);

        return redirect('/admin/products/view/' . $id . '#images');
    }
}