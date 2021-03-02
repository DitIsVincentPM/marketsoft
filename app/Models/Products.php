<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public static function GetAll()
    {
        $DB = DB::table('products')->get();
        return $DB;
    }

    public static function Get($productid)
    {
        $DB = DB::table('products')->where('id', $productid)->first();
        return $DB;
    }

    public static function convertTo($string)
    {   
        if($string[0] == "status") {
            if ($string[1] == 1) {
                return "Active";
            } elseif ($string[1] == 2) {
                return "Hidden";
            }
        } elseif($string[0] == "type") {
            if ($string[1] == 1) {
                return "Digital";
            } elseif ($string[1] == 2) {
                return "Physical";
            } elseif ($string[1] == 3) {
                return "Online Service";
            }
        }

        return "Not found";
    }
}
