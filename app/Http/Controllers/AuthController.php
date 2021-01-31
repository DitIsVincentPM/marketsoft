<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Hash;
use Auth;

class AuthController
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('index.home');
        }

        return view('auth.login');
    }

    public function loginuser(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $credentials = array(
            'email'     => $email,
            'password'  => $password
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('index.home')->with('success',"You're logged in!");
        } else {
            return redirect()->route('auth.login')->with('error',"Your inlog credentials are wrong!");
        }
    }

    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('index.home')->with('error',"You are already logged in.");
        }

        return view('auth.register');
    }

    public function newuser(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $password = Hash::make($password);

        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        return redirect()->route('auth.register')->with('success',"You're account is register!");
    }

    public function accountsettings(Request $request)
    {
        return view('auth.settings');
    }

    public function accountsettingssave(Request $request)
    {
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $image = $request->file('picture');

        if (isset($image)) {
            $new_name = Auth::user()->id . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images/profile_pictures'), $new_name);

            DB::table('users')->where('id', '=', Auth::user()->id)->update([
                'profile_picture' => '/images/profile_pictures/' . $new_name,
            ]);
        }

        DB::table('users')->where('id', '=', Auth::user()->id)->update([
            'firstname' => $firstname,
            'lastname' => $lastname,
        ]);

        return redirect()->route('auth.settings')->with('success',"You updated your account settings!");
    }

    public function Seller()
    {
        return view('auth.seller');
    }

    public function newseller(Request $request)
    {
        $name = $request->input('name');
        $company = $request->input('company');
        $email = $request->input('email');
        $age = $request->input('age');
        $selling = $request->input('selling');

        DB::table('seller_requests')->insert([
            'name' => $name,
            'company' => $company,
            'email' => $email,
            'age' => $age,
            'selling' => $selling,
        ]);

        return redirect()->route('auth.seller')->with('success',"You're seller request is submit!");
    }
}
