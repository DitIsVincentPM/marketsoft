<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthenticateAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || ! Auth::user()->is_admin) {
            throw new AccessDeniedHttpException;
        }

        return $next($request);
    }
}
