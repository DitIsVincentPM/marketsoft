<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use DB;

class Modules extends Model
{
    public static function get()
    {
        $modules = DB::table('modules')->where('status', 'enabled')->where('type', '1')->get();
        return $modules;
    }

    public static function is_enabled($id)
    {
        $module = DB::table('modules')->where('name', $id)->first();
        if ($module->status == "enabled") {
            return true;
        } else {
            return false;
        }
    }
}
