<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Categories extends Model
{
    protected $table = 'product_categorys';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
