<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\InputCheck as InputCheck;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SettingsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function settings()
    {
        $themes = [];

        // Get filles
        $files = File::allFiles(storage_path('theme/'));
        foreach ($files as $file) {
            if (str_contains($file->getFilename(), 'config.json')) {
                $content = file_get_contents($file->getPathname());
                $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
                $json = json_decode($content, true);
                array_push($themes, $json);
            }
        }

        $settings = DB::table('settings')->first();

        return view('admin.settings', [
            'settings' => $settings,
            'themes' => $themes,
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
}
