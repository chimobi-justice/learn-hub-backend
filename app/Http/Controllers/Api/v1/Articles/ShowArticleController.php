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
    *  summary="Get an articles by ID",
    *  description="Get an articles by ID",
    *  security={{"bearer_token": {}}},
    *  @OA\Parameter(
    *      name="id",
    *      description="Article ID",
    *      required=true,
    *      in="path",
    *      @OA\Schema(
    *         type="number"
    *      ),
    *      @OA\Examples(example="id", value="569", summary="An ID value."),
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
    public function show($slug) {
        try {
            $article = Article::where('slug', $slug)->firstOrFail();

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
