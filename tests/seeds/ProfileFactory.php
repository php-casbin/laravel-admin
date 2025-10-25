<?php


namespace Tests\Seeds;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName,
            'last_name'  => fake()->lastName,
            'postcode'   => fake()->postcode,
            'address'    => fake()->address,
            'latitude'   => fake()->latitude,
            'longitude'  => fake()->longitude,
            'color'      => fake()->hexColor,
            'start_at'   => fake()->dateTime,
            'end_at'     => fake()->dateTime,
        ];

    }
}
