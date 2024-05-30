<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Domain;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullName',
        'birthDate' ,
        'birthPlace',
        'biography',
        'nationality',
        'profilePicture',
        'email',
        'phoneNumber',
        'socialConnections' ,
        'discography',
        'availability',
    ];

    public function domains()
    {
        return $this->belongsToMany(Domain::class);
    }
    public function evenements(){
        return $this->belongsToMany(Evenement::class);
    }

}
