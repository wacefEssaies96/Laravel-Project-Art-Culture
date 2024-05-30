<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    public function emojis()
    {
        return $this->belongsToMany(Emoji::class)->withTimestamps();
    }
    public function parentComment() {
        return $this->belongsTo(Commentaire::class, 'parent_comment_id');
    }

    public function replies() {
        return $this->hasMany(Commentaire::class, 'parent_comment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }
}
