<?php

namespace App\Http\Controllers\Api\v1\Articles;

use App\Models\Article;
use App\Helpers\ResponseHelper;
use App\Http\Resources\Article\ArticleSavedResource;
use App\Http\Resources\PaginationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SavedUnsavedArticleController extends Controller
{
    public function saveArticle($articleId) {
        try {
            $user = auth()->user();

            Article::where('id', $articleId)->firstOrFail();

            $user->savedArticles()->create(['article_id' => $articleId]);

            return ResponseHelper::success(message: "Article Saved to reading list Successfully!");
        } catch (ModelNotFoundException $th) {
            return ResponseHelper::error(
                message: "Article Not Found",
                statusCode: 404
            );
        }
    }

    public function unsaveArticle($articleId) {
        $user = auth()->user();

        $savedArticle = $user->savedArticles()->where('article_id', $articleId);

        if ($savedArticle->exists()) {
            $savedArticle->delete();

            return ResponseHelper::success(message: "Article Removed from saved list Successfully!");
        }

        return ResponseHelper::error(
            message: "Article Not Found",
            statusCode: 404
        );
    }

    public function getSavedArticles(Request $request) {
        $user = auth()->user();
        $limit = (int) $request->query("limit", 15);

        $saveArticles = $user->savedArticles()->with('article.user')->latest()->paginate($limit);

        return ResponseHelper::success(
            message: "Success",
            data: [
                "articles" => ArticleSavedResource::collection($saveArticles),
                "pagination" => PaginationResource::make($saveArticles)
            ]
        );
    }
}
