<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Models\Article;
use App\Helpers\ResponseHelper;
use App\Http\Resources\Article\FollowingAuthorArticlesResource;
use App\Http\Resources\PaginationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetFollowingUsersArticlesController extends Controller
{
    public function getFollowingUsersArticles(Request $request){
        try {
            $user = auth()->user();
            $perPage = (int) $request->query("limit", 25);

            $articles = Article::whereHas('user.followers', function ($query) use ($user) {
                $query->where('follower_id', $user->id);
            })->withCount('articleComments')
                ->orderBy('article_comments_count', 'desc')
                ->paginate($perPage);

            return ResponseHelper::success(
                message: "success",
                data: [
                    "articles" => FollowingAuthorArticlesResource::collection($articles),
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
