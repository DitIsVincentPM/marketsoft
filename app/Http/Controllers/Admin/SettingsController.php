<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\PermissionCheck as Permission;
use App\Models\InputCheck as InputCheck;
use App\Models\GetExternals as GetExternals;
use DB;
use Illuminate\Http\Request;

class SettingsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function settings()
    {
        $check = Permission::checkmultiple([
            ['Settings', 'general'],
            ['Settings', 'mail'],
            ['Settings', 'modules'],
            ['Settings', 'addon'],
            ['Settings', 'theme'],
            ['Settings', 'roles'],
            ['Settings', 'legal']
        ]);

        $addons = GetExternals::getaddons();
        $themes = GetExternals::getthemes();
        $icons = GetExternals::geticons();
        $version = GetExternals::getversionstring();
        $settings = DB::table('settings')->first();
        $modules = DB::table('modules')->get();
        $permissions = DB::table('permissions')->get();
        $roles = DB::table('roles')->get();
        $role_perms = DB::table('role_permissions')->get();
        $tos_sections = DB::table('tos_sections')->latest()->get();
        $privacy_sections = DB::table('privacy_sections')->latest()->get();

        return view('Admin.settings', [
            'settings' => $settings,
            'themes' => $themes,
            'addons' => $addons,
            'modules' => $modules,
            'version' => $version,
            'check' => $check,
            'permissions' => $permissions,
            'icons' => $icons,
            'roles' => $roles,
            'role_perms' => $role_perms,
            'tos_sections' => $tos_sections,
            'privacy_sections' => $privacy_sections,
        ]);
    }

    public function settingssave(Request $request)
    {
        $error = InputCheck::check([$request->input('companyname'), $request->input('navbaricon')]);
        if ($error != false) {
            return redirect('/admin/settings#general')->with('error', $error);
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

        return redirect('/admin/settings#general')->with('success', "You successful updated the settings!");
    }

    public function CreateRole(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $icon = $request->input('icon');
        $color = $request->input('color');

        $error = InputCheck::check([$name, $description, $icon, $color]);
        if ($error != false) {
            return redirect('/admin/settings#roles')->with('error', $error);
        }

        DB::table('roles')->insert([
            'name' => $name,
            'description' => $description,
            'icon' => $icon,
            'color' => $color,
        ]);
        
        $role = DB::table('roles')->latest()->first();
        $permissions = DB::table('permissions')->get();

        foreach($permissions as $permission) {
            $perm = $request->input($permission->key);
            if($perm == true) {
                DB::table('role_permissions')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permission->id,
                ]);
            }
        }

        return redirect('/admin/settings#roles')->with('success', "You successfully created the new role $name!");
    }

    public function UpdateRole(Request $request, $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $icon = $request->input('icon');
        $color = $request->input('color');

        $error = InputCheck::check([$name, $description, $icon, $color]);
        if ($error != false) {
            return redirect('/admin/settings#roles')->with('error', $error);
        }

        DB::table('roles')->where('id', $id)->update([
            'name' => $name,
            'description' => $description,
            'icon' => $icon,
            'color' => $color,
        ]);
        
        $role = DB::table('roles')->latest()->first();
        $permissions = DB::table('permissions')->get();

        foreach($permissions as $permission) {
            $perm = $request->input($permission->key);
            if($perm == true) {
                DB::table('role_permissions')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permission->id,
                ]);
            }
        }

        return redirect('/admin/settings#roles')->with('success', "You successfully created the new role $name!");
    }

    public function DeleteRole($id)
    {
        DB::table('role_permissions')->where('role_id', $id)->delete();

        DB::table('roles')->where('id', $id)->delete();

        return redirect('/admin/settings#roles')->with('success', "You successfully deleted the role!");
    }

    public function tosstatus(Request $request)
    {
        $setting = DB::table('settings')->first();
        
        if($setting->tos_status == 0)
        {
            DB::table('settings')->update([
                'tos_status' => 1,
            ]);
        } elseif($setting->tos_status == 1) {
            DB::table('settings')->update([
                'tos_status' => 0,
            ]);
        }

        return redirect('/admin/settings#legal')->with('success', "You successfully updated the status of Terms of Service!");
    }

    public function tossection(Request $request)
    {
        DB::table('tos_sections')->insert([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect('/admin/settings#legal')->with('success', "You successfully added a new Terms of Service section!");
    }

    public function tossectiondelete($id)
    {
        DB::table('tos_sections')->where('id', $id)->delete();

        return redirect('/admin/settings#legal')->with('success', "You successfully deleted a Terms of Service section!");
    }

    public function tossectionedit(Request $request, $id)
    {
        DB::table('tos_sections')->where('id', $id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect('/admin/settings#legal')->with('success', "You successfully updated a Terms of Service section!");
    }

    public function privacystatus(Request $request)
    {
        $setting = DB::table('settings')->first();
        
        if($setting->privacy_status == 0)
        {
            DB::table('settings')->update([
                'privacy_status' => 1,
            ]);
        } elseif($setting->privacy_status == 1) {
            DB::table('settings')->update([
                'privacy_status' => 0,
            ]);
        }

        return redirect('/admin/settings#legal')->with('success', "You successfully updated the status of the Privacy Policy!");
    }

    public function privacysection(Request $request)
    {
        DB::table('privacy_sections')->insert([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect('/admin/settings#legal')->with('success', "You successfully added a new Privacy Policy section!");
    }

    public function privacysectiondelete($id)
    {
        DB::table('privacy_sections')->where('id', $id)->delete();

        return redirect('/admin/settings#legal')->with('success', "You successfully deleted a Privacy Policy section!");
    }

    public function privacysectionedit(Request $request, $id)
    {
        DB::table('privacy_sections')->where('id', $id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect('/admin/settings#legal')->with('success', "You successfully updated a Privacy Policy section!");
    }
}
