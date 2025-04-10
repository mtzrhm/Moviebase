<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->name();

        return [
            'title' => $name,
            'slug' => str($name)->slug(),
            'year' => fake()->year,
            'released_at' => fake()->randomElement([null, Carbon::parse(fake()->date('Y-m-d', '+2 years'))]),
            'runtime' => fake()->numberBetween(90,180),
            'genre' => fake()->randomElement(['Unknown', 'Example', 'Horror']),
            'plot' => fake()->sentence(),
            'languages' => ['German', 'English'],
            'poster' => fake()->randomElement([null, fake()->imageUrl()]),
            'imdb_rating' => 0.0,
            'imdb_id' => fake()->unique()->numerify('test-#######'),
        ];
    }
}
