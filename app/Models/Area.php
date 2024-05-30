<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', // Room name
        'capacity', // Room capacity
        'description', // Room description
        'address', // Room address
        'city', // City where the room is located
        'postal_code', // Postal code of the room
        'rental_cost', // Room rental cost
        'availability',
        'places_id' // Availability indicator of the room
    ];


    public function place()
    {
        return $this->belongsTo(Place::class, 'places_id');    }
}
