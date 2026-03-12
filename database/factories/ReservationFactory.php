<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Station',
            'latitude' => fake()->latitude(27, 36),
            'longitude' => fake()->longitude(-13, -1),
            'connector_type' => fake()->randomElement(['Type2', 'CCS', 'CHAdeMO']),
        ];
    }
}
