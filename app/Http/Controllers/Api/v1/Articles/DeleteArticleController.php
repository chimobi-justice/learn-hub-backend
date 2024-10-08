<?php

namespace App\Http\Controllers\Api\v1\Articles;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteArticleController extends Controller
{
    use AuthorizesRequests;
      /**
    * @OA\Delete(
    *  path="/articles/delete/{article}",
    *  tags={"articles"},
    *  summary="Author delete a created article",
    *  description="Author delete a created article",
    *  security={{"bearer_token": {}}},
    *  @OA\Parameter(
    *      name="id",
    *      description="Article ID",
    *      required=true,
    *      in="path",
    *      @OA\Schema(
    *         type="string"
    *      ),
    *      @OA\Examples(example="id", value="9d04e3b2-7e14-472e-8095-7f7f9f0c943f", summary="Id value."),
    *  ),
    *  @OA\Response(
    *        response="200", 
    *        description="Article deleted successfully!",
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    *    @OA\Response(response="403", description="You are not authorized to delete this article."),
    *    @OA\Response(response="404", description="Article not found"),
    * )
    */
    public function delete($id) {        
        try {
            $article = Article::findOrFail($id);

            $this->authorize('delete', $article);

            $article->delete();

            return ResponseHelper::success(
                message: "Article deleted successfully!", 
                statusCode: 200
            );

        } catch (ModelNotFoundException  $th) {
            return ResponseHelper::error(
                message: "Article not found",
                statusCode: 404
            );
        }
    }
}
