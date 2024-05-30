<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emoji extends Model
{
    protected $table = 'emojis';

    protected $fillable = ['emj'];

    
    use HasFactory;

    public function commentaires()
    {
        return $this->belongsToMany(Commentaire::class)->withTimestamps();
    }
}
