<?php

namespace App\Http\Controllers\Api\v1\Articles;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ShowArticleResource;

class ShowArticleController extends Controller
{
    /**
    * @OA\Get(
    *  path="/articles//{article}",
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
    *           ref="#/components/schemas/ShowArticleResource"
    *         )
    *       )
    *     )
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    * )
    */
    public function show(Article $article) {
        return ResponseHelper::success(
            message: "success", 
            data: new ShowArticleResource($article),
        );
    }
}
