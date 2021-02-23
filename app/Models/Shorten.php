<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shorten extends Model
{
    public static function string($input, $min)
    {
        if (strlen($input) >= $min) {
            $description_sized = substr($input, 0, $min) . " ... ";
        } else {
            $description_sized = $input;
        }

        return $description_sized;
    }
}