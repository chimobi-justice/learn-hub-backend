<?php

namespace App\Http\Controllers\Api\v1\Articles;

use App\Models\Article;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleLikeController extends Controller
{
    /**
    * @OA\Post(
    *  path="/articles/{article}/likes",
    *  tags={"articles"},
    *  summary="like a articles",
    *  description="user can only like article if not liked before.",
    *  security={{"bearer_token": {}}},
    *  @OA\Parameter(
    *      name="id",
    *      description="Article ID",
    *      required=true,
    *      in="path",
    *      @OA\Schema(
    *         type="string"
    *      ),
    *      @OA\Examples(example="ID", value="9d04e3b2-7e14-472e-8095-7f7f9f0c943f", summary="An UUID value."),
    *  ),
    *  @OA\Response(
    *    response="201", 
    *    description="Successful operation",
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated")
    * )
    */
    public function store(Request $request, Article $article) {
        if ($article->articleLikeBy($request->user())) {
            return response()->json(null, 204);
        }

        $article->articleLikes()->create([
            'user_id' => $request->user()->id
        ]);

        return ResponseHelper::success(
            statusCode: 201
        );
    }

    /**
    * @OA\Delete(
    *  path="/articles/{article}/dislikes",
    *  tags={"articles"},
    *  summary="dislike an article",
    *  description="user dislike his/her liked article",
    *  security={{"bearer_token": {}}},
    *  @OA\Parameter(
    *      name="id",
    *      description="Article ID",
    *      required=true,
    *      in="path",
    *      @OA\Schema(
    *         type="string"
    *      ),
    *      @OA\Examples(example="ID", value="9d04e3b2-7e14-472e-8095-7f7f9f0c943f", summary="An UUID value."),
    *  ),
    *  @OA\Response(
    *    response="204", 
    *    description="Successful operation",
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated")
    * )
    */
    public function destroy(Request $request, Article $article) {
        $request->user()->articleLikes()->where('article_id', $article->id)->delete();

        return ResponseHelper::success(
            statusCode: 204
        );
    }
}
