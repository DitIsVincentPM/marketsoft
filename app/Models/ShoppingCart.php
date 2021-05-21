<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class ShoppingCart extends Model
{
    protected $table = 'shoppingcart';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function Product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
