<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\Database\Settings;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class IsBanned
{
    public function handle(Request $request, Closure $next)
    {
        if(Settings::key('Installed') == 0) {
            return redirect()->route('installation.index');
        }

        if (Auth::user() != NULL && Auth::user()->is_banned == 1) {
            return new response(view('banned'));
        }

        return $next($request);
    }
}
