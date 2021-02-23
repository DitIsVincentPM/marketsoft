<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use PayPal;
use Request;
use Shorten;

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
}
