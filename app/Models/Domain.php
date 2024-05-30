<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Actor;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description' 
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }
}
