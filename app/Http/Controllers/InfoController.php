<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Team;

class InfoController
{
    public function announcements()
    {
        $announcements = DB::table('announcements')->get();

        return view('information.announcements.index', [
            'announcements' => $announcements,
        ]);
    }

    public function AnnounceView(Request $request, $id)
    {
        $announcement = DB::table('announcements')->where('id', $id)->first();

        return view('information.announcements.view', [
            'announcement' => $announcement,
        ]);
    }
}