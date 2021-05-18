<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Index()
    {
        return view('index');
    }

    public function Register()
    {
        return view('register');
    }

    public function NewRegister(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'password' => 'required|confirmed',
        ]);

        $password = $request->input('password');
        $password = Hash::make($password);

        DB::table('users')->insert([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'agree' => $request->input('agree'),
            'password' => $password,
        ]);

        return redirect()->route('login')->with('success',"");
    }

    public function Login()
    {
        return view('login');
    }

    public function Pricing()
    {
        return view('pricing');
    }
}
