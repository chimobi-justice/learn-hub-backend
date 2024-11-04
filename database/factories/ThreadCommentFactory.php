<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ThreadComment>
 */
class ThreadCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'thread_id' => Thread::factory(),
            'user_id' => User::factory(),
            'comment' => $this->faker->sentence(),
        ];
    }
}
