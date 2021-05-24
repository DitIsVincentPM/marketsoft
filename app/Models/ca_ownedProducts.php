<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class ca_ownedProducts extends Model
{
    protected $table = 'ca_ownedProducts';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
