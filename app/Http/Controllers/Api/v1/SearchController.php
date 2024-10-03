<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Article;
use App\Models\Thread;
use App\Helpers\ResponseHelper;
use App\Http\Resources\PaginationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $search = $request->query('search');
        $perPage = 15;
        $page = $request->query('page', 1);

        $users = User::select('id', 'avatar', 'fullname', 'username', 'bio')
            ->where("fullname", "like", "%$search%")
            ->orWhere("username", "like", "%$search%")
            ->paginate($perPage, 'users_page', $page);

        $articles = Article::select('id', 'title', 'slug')
            ->where("title", "like", "%$search%")
            ->orWhere("slug", "like", "%$search%")
            ->without('user', 'articleComments', 'articleLikes') 
            ->paginate($perPage, 'users_page', $page);

        $threads = Thread::select('id', 'title', 'slug')
            ->where("title", "like", "%$search%")
            ->orWhere("slug", "like", "%$search%")
            ->without('user', 'threadComments', 'threadLikes') 
            ->paginate($perPage, 'users_page', $page);

        return ResponseHelper::success(
            message: "Success",
            data: [
                'users' => [
                    'data' => $users->map(function ($user) {
                        return [
                            'id' => $user->id,
                            'fullname' => $user->fullname,
                            'username' => $user->username,
                            'avatar' => $user->avatar,
                            'bio' => $user->bio,
                            'url' => "/user/{$user->username}",
                        ];
                    }),
                    "pagination" => PaginationResource::make($users)
                ],
                'articles' => [
                    'data' => $articles->map(function ($article) {
                        return [
                            'id' => $article->id,
                            'title' => $article->title,
                            'slug' => $article->slug,
                            'url' => "/articles/{$article->slug}/{$article->id}",
                        ];
                    }),
                    "pagination" => PaginationResource::make($articles)
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
                    "pagination" => PaginationResource::make($threads)
                ],
            ]
        );
    }
}
