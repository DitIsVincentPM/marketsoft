<?php

namespace App\Models\Database;

use DB;
use Illuminate\Database\Eloquent\Model;

class Product_Images extends Model
{
    protected $table = 'product_images';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
