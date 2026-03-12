<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Borne;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borne>
 */
class BorneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'borne_id' => Borne::factory(),
            'user_id' => User::factory(),
            'date' => fake()->date(),
            'heure' => fake()->time('H:i:s'),
        ];
    }
}
