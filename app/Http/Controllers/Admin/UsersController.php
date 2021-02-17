<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\InputCheck as InputCheck;
use DB;
use Illuminate\Http\Request;

class UsersController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();

        return view('Admin.users', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
}
