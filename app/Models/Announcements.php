<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
