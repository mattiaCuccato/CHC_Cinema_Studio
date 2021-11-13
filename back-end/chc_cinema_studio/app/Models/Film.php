<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public function actors(){
        return $this->belongsToMany(Actor::class);
    }

    public function directors(){
        return $this->belongsToMany(Director::class);
    }

    public function genres(){
        return $this->belongsToMany(Genre::class);
    }

    public function projections(){
        return $this->hasMany(Projection::class);
    }
}
