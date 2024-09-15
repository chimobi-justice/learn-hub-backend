<?php

namespace App\Http\Controllers\Api\v1\Articles;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Article\ArticleFormRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EditArticleController extends Controller
{
    use AuthorizesRequests;

    /**
    * @OA\Patch(
    *  path="/articles/edit/{article}",
    *  tags={"articles"},
    *  summary="Update articles created by a author",
    *  description="Update articles created by a author",
    *  security={{"bearer_token": {}}},
    *  @OA\Parameter(
    *      name="id",
    *      description="Articles ID",
    *      required=true,
    *      in="path",
    *      @OA\Schema(
    *         type="string"
    *      ),
    *      @OA\Examples(example="ID", value="660", summary="An UUID value."),
    *  ),
    *  @OA\RequestBody(
    *    required=true,
    *    description="Update articles created by a author",
    *    @OA\JsonContent(
    *      @OA\Property(property="title", type="string", example="learn-hub article name"),
    *      @OA\Property(property="content", type="string", example="content of the article body"),
    *      @OA\Property(property="thumbnail", type="string", example="https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.png"),
    *    )
    *  ),
    *  @OA\Response(
    *    response="200", 
    *    description="Successful operation",
    *    @OA\JsonContent(
    *      example={
    *       "message": "Article updated successfully",      
    *       }
    *    ),
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    *    @OA\Response(response="403", description="You are not authorized to edit this article.")
    * )
    */
    public function edit(ArticleFormRequest $request, $id) {
        $article = Article::findOrFail($id);

        $this->authorize('update', $article);

        $article->update($request->validated());

        return ResponseHelper::success("Article updated successfully!");
    }
}
