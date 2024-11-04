<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $articles = Article::all();

        foreach ($articles as $article) {
            foreach ($users->random(15) as $user) {
                ArticleComment::factory()->create([
                    'article_id' => $article->id,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
