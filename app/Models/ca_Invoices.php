<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class ca_Invoices extends Model
{
    protected $table = 'ca_invoices';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
