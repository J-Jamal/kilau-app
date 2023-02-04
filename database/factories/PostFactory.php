<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sumber_dana' => $this->faker->sentence(3),
            'program'  => $this->faker->sentence(3),
            'keterangan'  => $this->faker->sentence(3),
        ];
    }
}
