<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserRating>
 */
class UserRatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rating' => fake()->string(),
            'rating_datetime' => fake()->time(),
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
        ];
    }
}
