<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket_Replies extends Model
{
    protected $table = 'ticket_replies';
    protected $primaryKey = 'id';
    public $incrementing = true;
}
