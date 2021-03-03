<?php

namespace App\Models\Database;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Database\Product_Categorys;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function Category()
    {
        return $this->belongsTo(Product_Categorys::class, 'category');
    }
}
