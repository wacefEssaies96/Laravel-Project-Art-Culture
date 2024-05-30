<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function evenement(){
        return $this->belongsTo(Evenement::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
