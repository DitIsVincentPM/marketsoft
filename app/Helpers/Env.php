<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class Env
{
    public static function set($value)
    {
        $path = base_path('.env');
        file_put_contents($path, str_replace($value[0] . '=' . env($value[0]), $value[0] . '=' . $value[1],file_get_contents($path)));
    }
}
