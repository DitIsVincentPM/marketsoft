<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    public static function GetAll()
    {
        $DB = DB::table('announcements')->get();
        return $DB;
    }

    public static function GetLatest()
    {
        $DB = DB::table('announcements')->latest()->first();
        return $DB;
    }
}
