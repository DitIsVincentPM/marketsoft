<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use DB;

class Env extends Model
{
    public static function set($value)
    {
        $path = base_path('.env');
        file_put_contents($path, str_replace($value[0] . '=' . env($value[0]), $value[0] . '=' . $value[1],file_get_contents($path)));
    }
}
