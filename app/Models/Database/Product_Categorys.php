<?php

namespace App\Models\Database;

use DB;
use Illuminate\Database\Eloquent\Model;

class Product_Categorys extends Model
{
    protected $table = 'product_categorys';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
