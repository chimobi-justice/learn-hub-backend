<?php

namespace App\Http\Controllers\Api\v1\Articles;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DeleteArticleController extends Controller
{
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
    *      @OA\Examples(example="id", value="300", summary="Id value."),
    *  ),
    *  @OA\Response(
    *        response="204", 
    *        description="Article deleted successfully!",
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    *    @OA\Response(response="403", description="You are not authorized to delete this article."),
    * )
    */
    public function delete(Request $request, Article $article) {        
         if (Gate::denies('delete', $article)) {
            return ResponseHelper::error(
                message: "You are not authorized to delete this article.", 
                statusCode: 403
            );
            
        }

        $article->delete();

        return ResponseHelper::success(
            message: "Article deleted successfully!", 
            statusCode: 204
        );
    }
}
