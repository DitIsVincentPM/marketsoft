<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Database\Product_Categorys;

class Product_Sections extends Model
{
    protected $table = 'product_sections';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
