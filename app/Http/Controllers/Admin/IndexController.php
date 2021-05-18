<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\InputCheck as InputCheck;
use App\Models\GetExternals as GetExternals;
use App\Models\Charts as Charts;
use Rainwater\Active\Active as Active;
use DB;
use App\Models\User;
use App\Models\Database\Products;

class IndexController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $users = User::get();
        $products = Products::latest()->paginate(3);

        $chart_users = Charts::generate('users');
        $chart_sales = Charts::generate('ca_ownedProducts');

        $version = GetExternals::getversionstring();

        $active_admins = Active::users(3)->get();
        $active_users = Active::users(3)->paginate(3);

        $roles = DB::table('roles')->get();
        $role_permissions = DB::table('role_permissions')->get();
        $users_online = count($active_users) + count(Active::guests(3)->get());

        return view('Admin.dashboard', [
            'users' => $users,
            'active_users' => $active_users,
            'admins_online' => $active_admins,
            'roles' => $roles,
            'products' => $products,
            'role_permissions' => $role_permissions,
            'newusers' => $chart_users,
            'sales' => $chart_sales,
            'users_online' => $users_online,
            'version' => $version,
        ]);
    }

    public function settings()
    {
        $settings = DB::table('settings')->first();

        return view('Admin.settings', [
            'settings' => $settings,
        ]);
    }

    public function settingssave(Request $request)
    {
        if ($request->input('type') == "general") {
            $error = InputCheck::check([$request->input('companyname'), $request->input('navbaricon')]);
            if ($error != false) {
                return redirect()->route('admin.settings')->with('error', $error);
            }

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
        } else if ($request->input('type') == "nav") {
        } else if ($request->input('type') == "text") {
        } else {
            return redirect()->route('admin.settings')->with('error', "No type set!");
        }

        return redirect()->route('admin.settings')->with('success', "You successful updated the settings!");
    }

    public function products()
    {
        $users = DB::table('users')->get();
        $products = DB::table('products')->get();

        return view('Admin.products', [
            'users' => $users,
            'products' => $products,
        ]);
    }
}
