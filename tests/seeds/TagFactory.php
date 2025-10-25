<?php


namespace seeds;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
        ];

    }
}
