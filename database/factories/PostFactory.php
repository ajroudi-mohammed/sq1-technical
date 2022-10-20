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
            'title' => fake()->sentence(6, true),
            'description' => fake()->text(260).'..',
            'user_id' => rand(1, 10),
            'publishedAt' => fake()->dateTimeBetween('-40 days' ,'now')
        ];
    }
}
