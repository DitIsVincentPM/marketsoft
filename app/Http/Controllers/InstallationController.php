<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Helpers\Settings;
use App\Models\Users;
use Auth;
use Hash;
use DB;

class InstallationController extends BaseController
{
    public function index()
    {
        if(Settings::key('Installed') == 1) {
            return redirect()->route('index');
        }

        return view('installation.index');
    }

    public function save(Request $request) {
        if(Settings::key('Installed') == 1) {
            return redirect()->route('index');
        }


        $password = Hash::make($request->input('password'));
        Users::insert([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => 2,
            'password' => $password,
        ]);

        DB::table('settings')->where('key', 'Installed')->update([
            'value' => 1,
        ]);

        DB::table('settings')->where('key', 'CompanyName')->update([
            'value' => $request->input('companyname'),
        ]);


        $credentials = array(
            'email'     => $request->input('email'),
            'password'  => $request->input('password')
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        }

        $image = $request->file('profile');
        if (isset($image)) {
            $new_name = Auth::user()->id . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images/profile_pictures'), $new_name);
        }

        Users::where('id', '=', Auth::user()->id)->update([
            'profile_picture' => '/images/profile_pictures/' . $new_name,
        ]);

        return redirect()->route('index');
    }
}
