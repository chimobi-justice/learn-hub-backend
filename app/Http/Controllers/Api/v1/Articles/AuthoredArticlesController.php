<?php

namespace App\Http\Controllers\Api\v1\Articles;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article\AuthoredArticleResource;
use App\Http\Resources\PaginationResource;

class AuthoredArticlesController extends Controller
{
     /**
     * @OA\Get(
     *      path="/articles/authored",
     *      tags={"articles"},
     *      summary="Get paginated list of authored articles",
     *      description="Returns paginated list of authored articles if limit is provided 10 by default",
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
     *                  property="message",
     *                  type="string",
     *                  example="success"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(
     *                      property="articles",
     *                      type="array",
     *                      @OA\Items(ref="#/components/schemas/AuthoredArticleResource")
     *                  ),
     *                  @OA\Property(
     *                      property="pagination",
     *                      type="array",
     *                      @OA\Items(ref="#/components/schemas/PaginationResource")
     *                  ),
     *              )
     *           )
     *       )
     *  )
     */
    public function getAuthoredArticles(Request $request) {
        $limit = $request->query('limit', 10);

        $articles = auth()->user()->articles()->paginate($limit);
        
        return ResponseHelper::success(
            message: "success", 
            data: [
                "articles" => AuthoredArticleResource::collection($articles),
                "pagination" => PaginationResource::make($articles)
            ],
        );
    }
}
