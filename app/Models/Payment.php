<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'Card_Security_Code',
        'Cardholder_Name',
        'Card_Number',
        'Card_Expiration_Date',
        'Address', 
        'payment_method'
    ];
    public function tickets()
{
    return $this->hasMany(Ticket::class);
}
}
