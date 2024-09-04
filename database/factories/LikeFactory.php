<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'likeable_id' => $this->faker->randomNumber(),
            'likeable_type' => $this->faker->randomElement(['App\Models\Post', 'App\Models\Comment']),
        ];
    }

    public function post()
    {
        return $this->state(function (array $attributes) {
            return [
                'likeable_type' => 'App\Models\Post',
            ];
        });
    }

    public function comment()
    {
        return $this->state(function (array $attributes) {
            return [
                'likeable_type' => 'App\Models\Comment',
            ];
        });
    }
}
