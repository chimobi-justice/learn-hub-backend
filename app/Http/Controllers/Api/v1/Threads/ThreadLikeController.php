<?php

namespace App\Http\Controllers\Api\v1\Threads;

use App\Models\Thread;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadLikeController extends Controller
{
    /**
    * @OA\Post(
    *  path="/threads/{thread}/likes",
    *  tags={"threads"},
    *  summary="like a thread",
    *  description="user like can only like a thread if not liked before.",
    *  security={{"bearer_token": {}}},
    *  @OA\Parameter(
    *      name="id",
    *      description="Thread ID",
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
    public function store(Request $request, Thread $thread) {
        if ($thread->threadLikeBy($request->user())) {
            return response()->json(null, 204);
        }

        $thread->threadLikes()->create([
            'user_id' => $request->user()->id
        ]);

        return ResponseHelper::success(
            statusCode: 201
        );
    }

    /**
    * @OA\Delete(
    *  path="/threads/{thread}/dislikes",
    *  tags={"threads"},
    *  summary="dislike a thread",
    *  description="user dislike his/her liked thread",
    *  security={{"bearer_token": {}}},
    *  @OA\Parameter(
    *      name="id",
    *      description="Thread ID",
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
    public function destroy(Request $request, Thread $thread) {
        $request->user()->threadLikes()->where('thread_id', $thread->id)->delete();

        return ResponseHelper::success(
            statusCode: 204
        );
    }
}
