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
    public function definition(): array
    {
        $user = $this->faker->numberBetween(1, 2);
        return [
            'body' => $this->faker->sentence,
            'user_id' => $user,
            'group_id' => null,
            'deleted_by' => $user,

        ];
    }
}
