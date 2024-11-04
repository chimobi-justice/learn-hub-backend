<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleComment>
 */
class ArticleCommentFactory extends Factory
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
            'article_id' => Article::factory(),
            'user_id' => User::factory(),
            'comment' => $this->faker->sentence(),
        ];
    }
}
