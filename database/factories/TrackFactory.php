<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Track>
 */
class TrackFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst(fake()->words(3, true)),
            'artwork_url' => 'https://placehold.co/300x300/1a1d29/e8a33d?text=%E2%99%AA',
            'track_url' => 'https://soundcloud.com/getafixx',
            'posted_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
