<?php

namespace App\Models\Database;

use DB;
use Illuminate\Database\Eloquent\Model;

class Knowledgebase extends Model
{
    protected $table = 'knowledgebase';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
