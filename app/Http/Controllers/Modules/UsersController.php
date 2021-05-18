<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Auth;

class UsersController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function users()
    {
        $users = DB::table('users')->get();

        return view('users', [
            'users' => $users,
        ]);
    }
}
