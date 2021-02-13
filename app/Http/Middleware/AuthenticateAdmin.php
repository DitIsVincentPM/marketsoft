<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use DB;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthenticateAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $permission = DB::table('permissions')->where('group', 'Admin')->where('key', 'view')->first();
        if($permission == null) {  
            throw new AccessDeniedHttpException;
        } 
        $user_permissions = DB::table('role_permissions')->where('role_id', Auth::user()->role_id)->where('permission_id', $permission->id)->first();
        if($user_permissions == null) {
            throw new AccessDeniedHttpException;
        }

        return $next($request);
    }
}
