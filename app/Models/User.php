<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD
=======
use DB;
use App\Models\Database\Roles;
>>>>>>> 15ae9d615294e6b7453c1599909432246ab139a1

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
<<<<<<< HEAD
=======
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $primaryKey = 'id';

    /**
>>>>>>> 15ae9d615294e6b7453c1599909432246ab139a1
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
<<<<<<< HEAD
=======

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function Role()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }
>>>>>>> 15ae9d615294e6b7453c1599909432246ab139a1
}
