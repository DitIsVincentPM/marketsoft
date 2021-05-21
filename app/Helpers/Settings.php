<?php

namespace App\Helpers;

use DB;

class Settings
{
    public static function key($input) {
        return DB::table('settings')->where('key', $input)->first()->value;
    }
}
