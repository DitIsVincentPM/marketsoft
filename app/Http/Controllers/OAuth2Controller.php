<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\InputCheck as InputCheck;
use Laravel\Socialite\Facades\Socialite;
use Hash;
use Auth;
use App\Models\User;

class OAuth2Controller
{
    public function DiscordRedirect()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function DiscordCallback()
    {
        try {
            $user = Socialite::driver('discord')->stateless()->user();
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return redirect()->route('index');
        }
        
        $discord_id = $user->getId();
        $discord_id = Hash::make($discord_id);

        if (!Auth::Check()) {
            $users = User::get();

            foreach($users as $account) {
                $hash = Hash::check($user->getId(), $account->discord_id);
                if($hash == true) {
                    Auth::loginUsingId($account->id);
            
                    return redirect()->route('index')->with('success', "You have successfully logged into your account!");
                }
            }

            return redirect()->route('auth.login')->with('error', "We couldn't find an account with your discord connected! Please try again!");
        } else {
            $users = DB::table('users')->where('discord_id', $user->getId())->first();

            if ($users == null) {
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'discord_id' => $discord_id,
                ]);

                return redirect()->route('auth.settings')->with('success', "You have successfully connected your discord account!");
            } else {
                return redirect()->route('auth.settings')->with('error', "This discord account is already connected to a user!");
            }

            return redirect()->route('auth.settings')->with('error', "Something went wrong when trying to connect!");
        }
    }

    public function DiscordRemove() {
        DB::table('users')->where('id', Auth::user()->id)->update([
            'discord_id' => NULL,
        ]);

        return redirect()->route('auth.settings')->with('success', "We have successfully disconnected your discord account!");
    }

    public function GoogleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function GoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return redirect()->route('index');
        }
        
        $google_id = $user->getId();
        $google_id = Hash::make($google_id);

        if (!Auth::Check()) {
            $users = User::get();

            foreach($users as $account) {
                $hash = Hash::check($user->getId(), $account->google_id);
                if($hash == true) {
                    Auth::loginUsingId($account->id);
            
                    return redirect()->route('index')->with('success', "You have successfully logged into your account!");
                }
            }

            return redirect()->route('auth.login')->with('error', "We couldn't find an account with your google connected! Please try again!");
        } else {
            $users = DB::table('users')->where('google_id', $user->getId())->first();

            if ($users == null) {
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'google_id' => $google_id,
                ]);

                return redirect()->route('auth.settings')->with('success', "You have successfully connected your google account!");
            } else {
                return redirect()->route('auth.settings')->with('error', "This google account is already connected to a user!");
            }

            return redirect()->route('auth.settings')->with('error', "Something went wrong when trying to connect!");
        }
    }

    public function GoogleRemove() {
        DB::table('users')->where('id', Auth::user()->id)->update([
            'google_id' => NULL,
        ]);
    
        return redirect()->route('auth.settings')->with('success', "We have successfully disconnected your google account!");
    }

    public function GithubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function GithubCallback()
    {
        try {
            $user = Socialite::driver('github')->stateless()->user();
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return redirect()->route('index');
        }
        
        $github_id = $user->getId();
        $github_id = Hash::make($github_id);

        if (!Auth::Check()) {
            $users = User::get();

            foreach($users as $account) {
                $hash = Hash::check($user->getId(), $account->github_id);
                if($hash == true) {
                    Auth::loginUsingId($account->id);
            
                    return redirect()->route('index')->with('success', "You have successfully logged into your account!");
                }
            }

            return redirect()->route('auth.login')->with('error', "We couldn't find an account with your github connected! Please try again!");
        } else {
            $users = DB::table('users')->where('github_id', $user->getId())->first();

            if ($users == null) {
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'github_id' => $github_id,
                ]);

                return redirect()->route('auth.settings')->with('success', "You have successfully connected your github account!");
            } else {
                return redirect()->route('auth.settings')->with('error', "This github account is already connected to a user!");
            }

            return redirect()->route('auth.settings')->with('error', "Something went wrong when trying to connect!");
        }
    }

    public function GithubRemove() {
        DB::table('users')->where('id', Auth::user()->id)->update([
            'github_id' => NULL,
        ]);
    
        return redirect()->route('auth.settings')->with('success', "We have successfully disconnected your github account!");
    }
}