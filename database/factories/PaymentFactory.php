<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            
            
           'Card_Security_Code' => $this->faker->numberBetween(100, 999),
            'Cardholder_Name' => $this->faker->name,
            'Card_Number' => $this->faker->creditCardNumber,
            'Card_Expiration_Date' => $this->faker->creditCardExpirationDate,
            'Address' => $this->faker->address,
            'payment_method' => $this->faker->randomElement(['Credit Card', 'PayPal', 'Stripe', 'Other']),
        ];
    }
}
