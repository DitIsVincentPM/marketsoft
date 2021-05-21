<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function Permissions()
    {
        return $this->hasMany(Role_Permissions::class, 'role_id');
    }
}
