<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use DB;

class Modules extends Model
{
    public static function get()
    {
        $modules = DB::table('modules')->where('type', '1')->get();
    
        return $modules;
    }

}
