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
        $settings = DB::table('settings')->first();

        return view('admin.settings', [
            'settings' => $settings,
        ]);
    }

    public function settingssave(Request $request)
    {
        if($request->input('type') == "general") {
            $file = $request->file('companylogo');
            $favicon = $request->file('faviconlogo');

            if (isset($file)) {
                $new_name = "logo" . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/companylogo'), $new_name);
                DB::table('settings')->update([
                    'CompanyLogo' => '/images/companylogo/' . $new_name,
                ]);
            }

            if (isset($favicon)) {
                $namefavicon = "favicon" . '.' . $favicon->getClientOriginalExtension();
                $favicon->move(public_path('images/companyfavicon'), $namefavicon);
                DB::table('settings')->update([
                    'CompanyFavicon' => '/images/companyfavicon/' . $namefavicon,
                ]);
            }

            DB::table('settings')->update([
                'CompanyName' => $request->input('companyname'),
                'NavbarIcon' => $request->input('navbaricon'),
            ]);
        } else if($request->input('type') == "nav") {

        } else if($request->input('type') == "text") {

        } else {
            return redirect()->route('admin.settings')->with('error', "No type set!");
        }

        return redirect()->route('admin.settings')->with('success', "You successful updated the settings!");
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
