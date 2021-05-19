<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\InputCheck as InputCheck;
use Laravel\Socialite\Facades\Socialite;
use Hash;
use Auth;
use App\Models\User;
use Settings;

class AuthController
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('auth.settings')->with('error', "You are already logged into an account!");
        }

        return view('Authentication.login');
    }

    public function loginuser(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $error = InputCheck::check([$password, $email]);
        if ($error != false) {
            return redirect()->route('auth.login')->with('error', $error);
        }

        $credentials = array(
            'email'     => $email,
            'password'  => $password
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('index')->with('success', "We have successfully logged you in!");
        } else {
            return redirect()->route('auth.login')->with('error', "Your login credentials are incorrect! Please try again.");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success', "We have successfully logged you out!");
    }

    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('auth.settings')->with('error', "You are already logged into an account! If you need to create another, please logout first.");
        }

        return view('Authentication.register');
    }

    public function newuser(Request $request)
    {
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $password = Hash::make($password);

        DB::table('users')->insert([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role_id' => 1,
        ]);

        return redirect()->route('auth.register')->with('success', "You have successfully registered your account!");
    }

    public function accountsettings(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', "The user settings page can only be viewed if you are logged in!");
        }
        return view('Authentication.settings');
    }

    public function accountsettingssave(Request $request)
    {
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $username = $request->input('username');
        $image = $request->file('picture');

        $error = InputCheck::check([$firstname, $lastname, $username]);
        if ($error != false) {
            return redirect()->route('auth.settings')->with('error', $error);
        }

        if (isset($image)) {
            $new_name = Auth::user()->id . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images/profile_pictures'), $new_name);

            DB::table('users')->where('id', '=', Auth::user()->id)->update([
                'profile_picture' => '/images/profile_pictures/' . $new_name,
            ]);
        }

        DB::table('users')->where('id', '=', Auth::user()->id)->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $lastname,
            'name' => $username,
        ]);

        return redirect()->route('auth.settings')->with('success', "You updated your account settings!");
    }

    public function Seller()
    {
        return view('Authentication.seller');
    }

    public function newseller(Request $request)
    {
        $name = $request->input('name');
        $company = $request->input('company');
        $email = $request->input('email');
        $age = $request->input('age');
        $selling = $request->input('selling');

        $error = InputCheck::check([$name, $company, $email, $age, $selling]);
        if ($error != false) {
            return redirect()->route('auth.seller')->with('error', $error);
        }

        DB::table('seller_requests')->insert([
            'name' => $name,
            'company' => $company,
            'email' => $email,
            'age' => $age,
            'selling' => $selling,
        ]);

        return redirect()->route('auth.seller')->with('success', "You're seller request is submit!");
    }
}
