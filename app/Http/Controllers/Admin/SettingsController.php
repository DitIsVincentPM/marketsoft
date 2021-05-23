<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Helpers\Env;
use ZanySoft\Zip\Zip;
use \GuzzleHttp\Client;
use App\Helpers\PermissionCheck as Permission;
use App\Helpers\InputCheck;
use App\Helpers\GetExternals;
use App\Models\Modules;
use App\Models\Roles;
use App\Models\Role_Permissions;
use App\Models\Permissions;
use DB;
use Settings;
use Config;
use Artisan;
use File;
use Storage;

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
            ['Settings', 'legal'],
            ['Settings', 'oauth2']
        ]);

        $addons = GetExternals::getaddons();
        $themes = GetExternals::getthemes();
        $icons = GetExternals::geticons();
        $version = GetExternals::getversionstring();

        $json = file_get_contents('http://marketsoft.io/modules/config.json', "\xEF\xBB\xBF");
        $json = json_decode($json, true);

        $permissions = DB::table('permissions')->get();
        $roles = DB::table('roles')->get();
        $role_perms = DB::table('role_permissions')->get();
        $tos_sections = DB::table('tos_sections')->latest()->get();
        $privacy_sections = DB::table('privacy_sections')->latest()->get();
        $payment_gateways = DB::table('payment_gateaways')->get();

        return view('Admin.settings', [
            'themes' => $themes,
            'addons' => $addons,
            'modules' => $json,
            'version' => $version,
            'check' => $check,
            'permissions' => $permissions,
            'payment_gateways' => $payment_gateways,
            'icons' => $icons,
            'roles' => $roles,
            'role_perms' => $role_perms,
            'tos_sections' => $tos_sections,
            'privacy_sections' => $privacy_sections,
        ]);
    }

    public function settingssave(Request $request)
    {
        $file = $request->file('companylogo');
        $favicon = $request->file('faviconlogo');

        if (isset($file)) {
            $new_name = "logo" . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/companylogo'), $new_name);
            DB::table('settings')->where('key', 'CompanyLogo')->update([
                'value' => '/images/companylogo/' . $new_name,
            ]);
        }
        
        if (isset($favicon)) {
            $namefavicon = "favicon" . '.' . $favicon->getClientOriginalExtension();
            $favicon->move(public_path('images/companyfavicon'), $namefavicon);
            DB::table('settings')->where('key', 'CompanyFavicon')->update([
                'value' => '/images/companyfavicon/' . $namefavicon,
            ]);
        }

        DB::table('settings')->where('key', 'CompanyName')->update([
            'value' => $request->input('companyname'),
        ]);

        DB::table('settings')->where('key', 'NavbarIconStatus')->update([
            'value' => $request->input('navbaricon'),
        ]);

        return redirect('/admin/settings#general')->with('success', "You successful updated the settings!");
    }

    public function updataproductsettings(Request $request)
    {
        DB::table('settings')->where('key', 'ProductNotice')->update([
            'value' => $request->input('notice'),
        ]);

        $prod = DB::table('payment_gateaways')->get();
        foreach($prod as $item) {
            DB::table('payment_gateaways')->where('id', $item->id)->update([
                'status' => $request->input('ga-' . $item->id),
            ]);
        }

        return redirect('/admin/settings#product')->with('success', "You successful updated the product settings!");
    }
    
    public function CreateRole(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $icon = $request->input('icon');
        $color = $request->input('color');

        DB::table('roles')->insert([
            'name' => $name,
            'description' => $description,
            'icon' => $icon,
            'color' => $color,
        ]);
        
        $role = DB::table('roles')->latest()->first();
        $permissions = DB::table('permissions')->get();

        foreach ($permissions as $permission) {
            $perm = $request->input($permission->key);
            if ($perm == true) {
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

        DB::table('roles')->where('id', $id)->update([
            'name' => $name,
            'description' => $description,
            'icon' => $icon,
            'color' => $color,
        ]);
        
        $role = DB::table('roles')->latest()->first();
        $permissions = DB::table('permissions')->get();

        foreach ($permissions as $permission) {
            $perm = $request->input($permission->key);
            if ($perm == true) {
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
        
        if (DB::table('settings')->where('key', 'TosStatus')->first()->value == 0) {
            DB::table('settings')->where('key', 'TosStatus')->update([
                'value' => 1,
            ]);
        } elseif ($setting->tos_status == 1) {
            DB::table('settings')->where('key', 'TosStatus')->update([
                'value' => 0,
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
        
        if (DB::table('settings')->where('key', 'PrivacyStatus')->first()->value == 0) {
            DB::table('settings')->where('key', 'PrivacyStatus')->update([
                'value' => 1,
            ]);
        } elseif ($setting->privacy_status == 1) {
            DB::table('settings')->where('key', 'PrivacyStatus')->update([
                'value' => 0,
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

    public function OAuth2Status(Request $request)
    {
        if ($request->input('oauth2') == "google") {
            if (Settings::key('GoogleStatus') == 1) {
                DB::table('settings')->where('key', "GoogleStatus")->update([
                    'value' => 0,
                ]);
            } else {
                DB::table('settings')->where('key', "GoogleStatus")->update([
                    'value' => 1,
                ]);
            }
        } elseif ($request->input('oauth2') == "discord") {
            if (Settings::key('DiscordStatus') == 1) {
                DB::table('settings')->where('key', "DiscordStatus")->update([
                    'value' => 0,
                ]);
            } else {
                DB::table('settings')->where('key', "DiscordStatus")->update([
                    'value' => 1,
                ]);
            }
        } elseif ($request->input('oauth2') == "github") {
            if (Settings::key('GithubStatus') == 1) {
                DB::table('settings')->where('key', "GithubStatus")->update([
                    'value' => 0,
                ]);
            } else {
                DB::table('settings')->where('key', "GithubStatus")->update([
                    'value' => 1,
                ]);
            }
        }

        return redirect('/admin/settings#oauth2')->with('success', "You successfully updated the status!");
    }

    public function OAuth2Update(Request $request)
    {
        if ($request->input('oauth2') == "google") {
            $client_id = $request->input('GOOGLE_CLIENT_ID');
            $client_secret = $request->input('GOOGLE_CLIENT_SECRET');

            Env::set(['GOOGLE_CLIENT_ID', $client_id]);
            Env::set(['GOOGLE_CLIENT_SECRET', $client_secret]);
        } elseif ($request->input('oauth2') == "discord") {
            $client_id = $request->input('DISCORD_CLIENT_ID');
            $client_secret = $request->input('DISCORD_CLIENT_SECRET');

            Env::set(['DISCORD_CLIENT_ID', $client_id]);
            Env::set(['DISCORD_CLIENT_SECRET', $client_secret]);
        } elseif ($request->input('oauth2') == "github") {
            $client_id = $request->input('GITHUB_CLIENT_ID');
            $client_secret = $request->input('GITHUB_CLIENT_SECRET');

            Env::set(['GITHUB_CLIENT_ID', $client_id]);
            Env::set(['GITHUB_CLIENT_SECRET', $client_secret]);
        }

        return redirect('/admin/settings#oauth2')->with('success', "You successfully updated the OAuth2 information!");
    }
    
    public function modules_toggle(Request $request, $id)
    {
        $module = DB::table('modules')->where('id', $id)->first();

        if ($module->status == "enabled") {
            DB::table('modules')->where('id', $id)->update([
                'status' => 'disabled',
            ]);
            return redirect('/admin/settings#modules')->with('success', "Module " . $module->name . " is disabled!");
        } else {
            DB::table('modules')->where('id', $id)->update([
                'status' => 'enabled',
            ]);
            return redirect('/admin/settings#modules')->with('success', "Module " . $module->name . " is enabled!");
        }
    }

    public function modules_upload(Request $request)
    {
        // Essentials
        $id = rand();
        $path = storage_path('modules/temp/' . $id);
        $path_module = storage_path('modules/' . $id);

        // Make Temp Directory
        File::makeDirectory($path);

        // Get and Move Zip to Temp Module Directory
        /* $module_files->move($path, "module.zip"); */
        try {
            $url = 'http://marketsoft.io/modules/Example.zip';
            $guzzle = new Client();
            $response = $guzzle->get($url);
            File::put($path . "/module.zip", $response->getBody());

            $module_files = File::files($path);
        } catch (\Exception $e) {
            File::deleteDirectory($path);
            return redirect('/admin/settings#modules')->with('error', "The url is not vailed. API Call cannceld.");
        }

        if ($module_files[0]->getExtension() != "zip") {
            return redirect('/admin/settings#modules')->with('error', "This file type isn't supported yet.");
        }

        // Get file
        $original_name = $module_files[0]->getFilename();
        $no_extension_name = str_replace("." . $module_files[0]->getExtension(), "", $original_name);

        // Extract Files To Temp Folder
        $zip = Zip::open($path . "/" . "module.zip");
        $zip->extract($path);

        // Remove zip
        File::delete($path . "/" . "module.zip");

        // If in extra folder get out of folder
        if (File::exists($path . "/" . $no_extension_name)) {
            File::copyDirectory($path . "/" . $no_extension_name, $path);
            File::deleteDirectory($path . "/" . $no_extension_name);
        }

        // Generate Json with config data
        try {
            $content = File::get($path . "/config.json");
        } catch (\Exception $e) {
            File::deleteDirectory($path);
            return redirect('/admin/settings#modules')->with('error', "No module config found.");
        }
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
        $data = json_decode($content, true);

        // Create Logs File
        File::makeDirectory($path_module);
        File::put($path_module . "/logs.txt", "|- This is the logs file for #" . $data["name"] . " -| \r\n\r\n");

        // Get files and directories
        $files = File::allFiles($path);
        $directories = File::directories($path);

        File::append($path_module . "/logs.txt", "|- All files that are uploaded -| \r\n");

        // Create Json
        $list = [];
        for ($i=0;$i < count($directories); $i++) {
            $directory_name = str_replace(storage_path('modules/temp/' . $id . "/"), "", $directories[$i]);
            $list["directories"][$i]["name"] = $directory_name;
            $list["directories"][$i]["path"] = $directories[$i];
            File::append($path_module . "/logs.txt", "- DIR: " . $directory_name . " | " . $directories[$i] . "\r\n");
        }
        for ($i=0;$i < count($files); $i++) {
            $list["files"][$i]["name"] = $files[$i]->getFilename();
            $list["files"][$i]["extension"] = $files[$i]->getExtension();
            $list["files"][$i]["path"] = $files[$i]->getPath();
            File::append($path_module . "/logs.txt", "- FIL: " . $files[$i]->getFilename() . "." . $files[$i]->getExtension() . " | " . $files[$i]->getPath() . "\r\n");
        }

        /* Allowed Folders: 
            Routes, 
            Public, 
            Resources, 
            App
        */
        for ($i=0;$i < count($list["directories"]); $i++) {
            if ($list["directories"][$i]["name"] == "routes" or $list["directories"][$i]["name"] == "resources" or $list["directories"][$i]["name"] == "public" or $list["directories"][$i]["name"] == "app") {
                /* File::copyDirectory($path . "/" . "routes", base_path('routes')); */
                $files = File::allFiles($path . "/" . $list["directories"][$i]["name"]);
                for ($i=0; $i < count($files); $i++) {
                    if (File::exists(base_path($list["directories"][$i]["name"] . '/' . $files[$i]->getFilename()))) {
                        $generated_file = [];

                        $current_file_contents = File::get(base_path($list["directories"][$i]["name"] .'/' . $files[$i]->getFilename()));
                        $new_file_contents = File::get($files[$i]->getPath() . "/" . $files[$i]->getFilename());
                        $current_file_json = explode("\n", $current_file_contents);
                        $new_file_json = explode("\r\n", $new_file_contents);

                        for ($y = 0; $y < count($new_file_json); $y++) {
                            if (array_key_exists($y, $current_file_json)) {
                                if ($current_file_json[$y] == $new_file_json[$y]) {
                                    array_push($generated_file, $current_file_json[$y]);
                                } else {
                                    array_push($generated_file, $new_file_json[$y]);
                                }
                            } else {
                                array_push($generated_file, $new_file_json[$y]);
                            }
                        }

                        File::put(base_path($list["directories"][$i]["name"] .'/' . $files[$i]->getFilename()), "");
                        for ($x = 0; $x < count($generated_file); $x++) {
                            File::append(base_path($list["directories"][$i]["name"] .'/' . $files[$i]->getFilename()), $generated_file[$x] . "\r\n");
                        }
                    } else {
                    }
                }
            }
        }

        // Determin Type
        if ($data["type"] == "normal") {
            $type = 1;
        } elseif ($data["type"] == "product") {
            $type = 2;
        }

        // Add module to database
        DB::table('modules')->insert([
            'name' => $data["name"],
            'Navbar_Name' => $data["navbar"]["name"],
            'Navbar_Route' => $data["navbar"]["route"],
            'description' => $data["description"],
            'type' => $type,
            'module_id' => $id,
        ]);

        File::deleteDirectory($path);

        return redirect('/admin/settings#modules')->with('success', "You downloaded module " . $data["name"] . " !");
    }

    public function wordSimilarity($s1, $s2)
    {
        $wordsof = function ($s) {
            $a=[];
            foreach (explode(" ", $s)as $w) {
                if ($w) {
                    $a[$w]=1;
                }
            }
            return $a;
        };
    
        $w1 = $wordsof($s1);
        if (!$w1) {
            return 0;
        }
        $w2 = $wordsof($s2);
        if (!$w2) {
            return 0;
        }
    
        $allWords = "";
        $allWords.= join("", array_keys($w1));
        $allWords.= join("", array_keys($w2));
        $totalLen = max(strlen($allWords), 1);
        $charDiff = 0;
    
        foreach ($w1 as $word=>$x) {
            if (!isset($w2[$word])) {
                $charDiff+=strlen($word);
            }
        }
        foreach ($w2 as $word=>$x) {
            if (!isset($w1[$word])) {
                $charDiff+=strlen($word);
            }
        }
    
        return 1-($charDiff/$totalLen);
    }
}
