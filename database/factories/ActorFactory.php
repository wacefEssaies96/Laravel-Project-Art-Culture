<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fullName' => fake()->name,
            'birthDate' => fake()->date,
            'birthPlace' => fake()->city,
            'biography' => fake()->text,
            'nationality' => fake()->country,
            // 'specialties' => fake()->word,
            'profilePicture' => fake()->imageUrl(200, 200),
            'email' => fake()->unique()->safeEmail,
            'phoneNumber' => fake()->e164PhoneNumber(),
            'socialConnections' => fake()->url,
            'discography' => fake()->text,
            'availability' => fake()->randomElement(['Available', 'Not Available']),
        ];
    }
}
