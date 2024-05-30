<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    public function articles(){
        return $this->hasMany(Article::class);
    }
    public function commentaires(){
        return $this->hasMany(Commentaire::class);
    }
    public function actors(){
        return $this->belongsToMany(Actor::class);
    }
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function place(){
        return $this->belongsTo(Place::class);
    }
}
