<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Article;
use App\Models\Thread;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $search = $request->query('search');

        $articles = Article::select('id', 'title', 'slug')
            ->where("title", "like", "%$search%")
            ->orWhere("slug", "like", "%$search%")
            ->without('user', 'articleComments', 'articleLikes') 
            ->paginate(30);

        $threads = Thread::select('id', 'title', 'slug')
            ->where("title", "like", "%$search%")
            ->orWhere("slug", "like", "%$search%")
            ->without('user', 'threadComments', 'threadLikes') 
            ->paginate(30);

        return ResponseHelper::success(
            message: "Success",
            data: [
                'articles' => [
                    'data' => $articles->map(function ($article) {
                        return [
                            'id' => $article->id,
                            'title' => $article->title,
                            'slug' => $article->slug,
                            'url' => "/articles/{$article->slug}/{$article->id}",
                        ];
                    }),
                ],
                'threads' => [
                    'data' => $threads->map(function ($thread) {
                        return [
                            'id' => $thread->id,
                            'title' => $thread->title,
                            'slug' => $thread->slug,
                            'url' => "/threads/{$thread->slug}/{$thread->id}",
                        ];
                    }),
                ],
            ]
        );
    }
}
