<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role_Permissions extends Model
{
    protected $table = 'role_permissions';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
