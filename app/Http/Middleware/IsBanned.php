<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class IsBanned
{
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()) {
            return $next($request);
        }
        elseif(Auth::user()->is_banned == "1") {
            return redirect()->route('banned');
        }

        return $next($request);
    }
}
