<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;
use DB;
use Route;

class Modules
{
    public function handle(Request $request, Closure $next)
    {
        $modules = DB::table('modules')->get();
        foreach ($modules as $module) {
            $json = json_decode($module->controllers, true);
            for ($i = 0; $i < count($json); $i++) {
                if (class_basename(Route::current()->controller) == $json[$i]) {
                        return $next($request);
                }
            }
        }

        return $next($request);
    }
}
