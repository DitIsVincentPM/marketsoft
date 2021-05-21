<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $table = 'modules';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
