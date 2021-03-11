<?php

namespace App\Models\Database;

use DB;
use Illuminate\Database\Eloquent\Model;

class Knowledgebase_Categorys extends Model
{
    protected $table = 'knowledgebase_categorys';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function Articles()
    {
        return $this->hasMany(Knowledgebase::class, 'category_id');
    }
}
