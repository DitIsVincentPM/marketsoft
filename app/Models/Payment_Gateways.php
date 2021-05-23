<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment_Gateways extends Model
{
    protected $table = 'payment_gateaways';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
