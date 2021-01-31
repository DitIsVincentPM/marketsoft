<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Team;

class TeamController
{
    public function users()
    {
        $users = DB::table('users')->get();

        return view('team.users', [
            'users' => $users,
        ]);
    }
}