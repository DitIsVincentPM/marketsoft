<?php

namespace App\Models;

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

    public function Sections()
    {
        return $this->hasMany(Product_Sections::class, 'product_id')->orderBy('order');
    }

    public function Images()
    {
        return $this->hasMany(Product_Images::class, 'product_id');
    }
}
