<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Rainwater\Active\Active;
use App\Helpers\GetExternals;
use App\Helpers\Charts;
use App\Models\User;
use App\Models\Settings;
use App\Models\Products;
use App\Models\Roles;
use App\Models\Role_Permissions;
use App\Models\Users;

class IndexController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $users = Users::get();
        $products = Products::latest()->paginate(3);

        $chart_users = Charts::generate('users');
        $chart_sales = Charts::generate('ca_ownedProducts');

        $version = GetExternals::getversionstring();

        $active_admins = Active::users(3)->get();
        $active_users = Active::users(3)->paginate(3);

        $roles = Roles::get();
        $role_permissions = Role_Permissions::get();
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
        $settings = Settings::first();

        return view('Admin.settings', [
            'settings' => $settings,
        ]);
    }

    public function settingssave(Request $request)
    {
        if ($request->input('type') == "general") {

            $file = $request->file('companylogo');
            $favicon = $request->file('faviconlogo');

            if (isset($file)) {
                $new_name = "logo" . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/companylogo'), $new_name);
                Settings::update([
                    'CompanyLogo' => '/images/companylogo/' . $new_name,
                ]);
            }

            if (isset($favicon)) {
                $namefavicon = "favicon" . '.' . $favicon->getClientOriginalExtension();
                $favicon->move(public_path('images/companyfavicon'), $namefavicon);
                Settings::update([
                    'CompanyFavicon' => '/images/companyfavicon/' . $namefavicon,
                ]);
            }

            Settings::update([
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
        $users = Users::get();
        $products = Products::get();

        return view('Admin.products', [
            'users' => $users,
            'products' => $products,
        ]);
    }
}
