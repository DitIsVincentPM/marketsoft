<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class ca_Invoices extends Model
{
    protected $table = 'ca_invoices';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function products()
    {
        return $this->hasMany(ca_ownedProducts::class, 'product_id');
    }
}
