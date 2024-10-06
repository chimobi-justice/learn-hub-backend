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
    public function getFollowingUsersArticles(Request $request) {
        $user = auth()->user();
    
        if (!$user) {
            return ResponseHelper::error("Unauthorized", 401);
        }
    
        $limit = (int) $request->query("limit", 10);

        $followingUserIds = $user->followings()->pluck('user_id');

        try {
            $articles = Article::whereIn('user_id', $followingUserIds)
                ->withCount(['articleComments', 'articleLikes'])
                ->orderByRaw('(article_comments_count + article_likes_count) DESC')
                ->paginate($limit);
    
            return ResponseHelper::success(
                message: "Success",
                data: [
                    "articles" => ArticleResource::collection($articles),
                    "pagination" => PaginationResource::make($articles)
                ]
            );
        } catch (\Exception $e) {
            return ResponseHelper::error(
                message: "An error occurred while fetching articles", 
                statusCode: 500
            );
        }
    }
    
}
