<?php

namespace App\Http\Controllers\Api\v1\Articles;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ShowArticleController extends Controller
{
    /**
    * @OA\Get(
    *  path="/articles/{article}",
    *  tags={"articles"},
    *  summary="Get an article by ID",
    *  description="Get an article by ID",
    *  security={{"bearer_token": {}}},
    *  @OA\Parameter(
    *      name="id",
    *      description="Article ID",
    *      required=true,
    *      in="path",
    *      @OA\Schema(
    *         type="number"
    *      ),
    *      @OA\Examples(example="id", value="9d04e3b2-7e14-472e-8095-7f7f9f0c943f", summary="An ID value."),
    *  ),
    *  @OA\Response(
    *     response="200", 
    *     description="Successful operation",
    *     @OA\JsonContent(
    *       @OA\Property(
    *         property="data", 
    *         type="array",
    *         @OA\Items(
    *           type="object",
    *           ref="#/components/schemas/ArticleResource"
    *         )
    *       )
    *     )
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    *    @OA\Response(response="404", description="Article not found"),
    * )
    */
    public function show($id) {
        try {
            $article = Article::findOrFail($id);

            return ResponseHelper::success(
                message: "success", 
                data: new ArticleResource($article),
            );
        } catch (ModelNotFoundException  $th) {
            return ResponseHelper::error(
                message: "Article not found",
                statusCode: 404
            );
        }
    }
}
