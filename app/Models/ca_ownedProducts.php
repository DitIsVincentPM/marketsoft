<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class ca_ownedProducts extends Model
{
    protected $table = 'ca_ownedProducts';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
