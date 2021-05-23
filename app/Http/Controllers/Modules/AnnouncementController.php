<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Team;
use App\Helpers\ShoppingCart;

class AnnouncementController
{
    public function announcements()
    {
        $announcements = DB::table('announcements')->get();

        return view('Announcements.index', [
            'announcements' => $announcements,
        ]);
    }

    public function AnnounceView(Request $request, $id)
    {
        $announcement = DB::table('announcements')->where('id', $id)->first();

        DB::table('announcements')->where('id', $id)->update([
            'views' => $announcement->views + 1,
        ]);

        return view('Announcements.view', [
            'announcement' => $announcement,
        ]);
    }
}