<?php

namespace App\Models\Database;

use DB;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
