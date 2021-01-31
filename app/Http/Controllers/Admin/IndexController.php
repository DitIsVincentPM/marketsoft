<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $users = DB::table('users')->get();
        $users = count($users);

        $products = DB::table('products')->get();
        $products = count($products);

        return view('admin.dashboard', [
            'users' => $users,
            'products' => $products,
        ]);
    }

    public function settings()
    {
        $settings = DB::table('settings')->get();
        return view('admin.settings', [
            'settings' => $settings,
        ]);
    }

    public function settingssave(Request $request)
    {
        $settings = DB::table('settings')->get();

        foreach($settings as $setting) {
            $x = strtolower($setting->key);
            DB::table('settings')->where('key', $setting->key)->update([
                'value' => $request->input($x),
            ]);
        }

        return redirect()->route('admin.settings')->with('success',"You're seller request is submit!");
    }

    public function products()
    {
        $users = DB::table('users')->get();
        $products = DB::table('products')->get();

        return view('admin.products', [
            'users' => $users,
            'products' => $products,
        ]);
    }
}
