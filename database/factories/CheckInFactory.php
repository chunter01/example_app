<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CheckIn>
 */
class CheckInFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->words($nb = 4, $asText = true),
            'lat'         => fake()->latitude(),
            'lng'         => fake()->longitude(),
            'notes'       => fake()->words($nb = 6, $asText = true),
            'created_at'  => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at'  => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
};