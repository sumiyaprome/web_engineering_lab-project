<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['poster_id', 'subject', 'description', 'status', 'type', 'date', 'deleted'];

    public function poster()
    {
        return $this->belongsTo(User::class, 'poster_id');
    }

    public function ticketDetails()
    {
        return $this->hasMany(TicketDetail::class);
    }
}
