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
     *      description="Returns list of articles and if limit is provided returns the number of limited articles",
     *      security={{"bearer_token": {}}},
     *      @OA\Parameter(
     *          name="limit",
     *          in="query",
     *          description="Number of articles to return",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
    public function getAllArticles(Request $request) {
        $limit = $request->query("limit");

        $articles = Article::latest()->limit($limit)->get();       

        return ResponseHelper::success(
            message: "success", 
            data: ArticleResource::collection($articles),
        );
    }

    /**
     * @OA\Get(
     *      path="/articles/all/paginate",
     *      tags={"articles"},
     *      summary="Get paginated list of articles",
     *      description="Returns paginated list of articles if limit is provided 8 by default",
     *      security={{"bearer_token": {}}},
     *      @OA\Parameter(
     *          name="limit",
     *          in="query",
     *          description="Number of articles to return per page",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
    public function getPaginatedArticles(Request $request) {
        $limit = $request->query("limit", 8);

        $articles = Article::latest()->paginate($limit);
        
        return ResponseHelper::success(
            message: "success", 
            data: [
                "articles" => ArticleResource::collection($articles),
                "pagination" => [
                    "current_page" => $articles->currentPage(),
                    "last_page" => $articles->lastPage(),
                    "next_page_url" => $articles->nextPageUrl(),
                    "total" => $articles->total()
                ],
            ],
        );
    }
}
