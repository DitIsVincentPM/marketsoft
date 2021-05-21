<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket_Categories extends Model
{
    protected $table = 'ticket_categories';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
