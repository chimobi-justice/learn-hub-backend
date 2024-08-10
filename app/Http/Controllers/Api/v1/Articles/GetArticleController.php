<?php

namespace App\Http\Controllers\Api\v1\Articles;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;

class GetArticleController extends Controller
{
     /**
     * @OA\Get(
     *      path="/articles/all",
     *      tags={"articles"},
     *      summary="Get list of articles",
     *      description="Returns list of articles",
     *      security={{"bearer_token": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data", 
     *                  type="array",
     *                   @OA\Items(
     *                   type="object",
     *                      ref="#/components/schemas/ArticleResource"
     *                   )
     *               )
     *           )
     *       )
     *  )
     */
    public function index(Request $request) {
        $articles = Article::latest()->get();

        return ResponseHelper::success(
            message: "success", 
            data: ArticleResource::collection($articles),
        );
    }
}
