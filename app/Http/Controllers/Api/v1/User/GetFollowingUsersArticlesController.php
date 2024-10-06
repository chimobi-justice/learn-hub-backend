<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Models\Article;
use App\Helpers\ResponseHelper;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Resources\PaginationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetFollowingUsersArticlesController extends Controller
{
    public function getfollowingUsersArticles(Request $request) {
        $userId = auth()->user()->id;
        $limit = $request->query("limit", 10);

        $articles = Article::whereHas('user.followers', function($query) use ($userId) {
            $query->where('follower_id', $userId);
        })
        ->withCount(['articleComments', 'articleLikes'])
        ->orderByRaw('(article_comments_count + article_likes_count) DESC')
        ->paginate($limit);

        return ResponseHelper::success(
            message: "success", 
            data: [
                "articles" => ArticleResource::collection($articles),
                "pagination" => PaginationResource::make($articles)
            ]
        );
    }
}
