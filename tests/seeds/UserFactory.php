<?php

namespace Tests\Seeds;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->username(),
            'email'    => fake()->email(),
            'mobile'   => fake()->phoneNumber(),
            'avatar'   => fake()->imageUrl(),
            'password' => '$2y$10$U2WSLymU6eKJclK06glaF.Gj3Sw/ieDE3n7mJYjKEgDh4nzUiSESO', // bcrypt(123456)
        ];
    }
}
