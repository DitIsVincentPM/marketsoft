<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Roles;

class Users extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function Role()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }
}
