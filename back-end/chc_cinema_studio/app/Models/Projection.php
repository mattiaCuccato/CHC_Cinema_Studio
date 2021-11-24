<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projection extends Model
{
    use HasFactory;

    public function film(){
        return $this->belongsTo(Film::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function tickets(){
        return $this->hasManyThrough(Ticket::class, Reservation::class);
    }
}
