<?php

namespace App\Http\Controllers\Api\v1\Threads;

use App\Models\Thread;
use App\Http\Requests\Thread\ThreadCommentFormRequest;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadCommentController extends Controller
{
    /**
    * @OA\Post(
    *  path="/threads/{thread}/comments",
    *  tags={"threads"},
    *  summary="Write a comment on a specific thread",
    *  description="Write a comment on a specific thread",
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
    *  @OA\RequestBody(
    *    required=true,
    *    description="Write a comment on a specific thread",
    *    @OA\JsonContent(
    *      @OA\Property(property="comment", type="string", example="Hey i love your content and keep it up"), 
    *    )
    *  ),
    *  @OA\Response(
    *    response="201", 
    *    description="Successful operation",
    *    @OA\JsonContent(
    *      example={
    *       "message": "Comment successfully",      
    *       }
    *    ),
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated")
    * )
    */
    public function store(ThreadCommentFormRequest $request, Thread $thread) {
        $thread->threadComments()->create(array_merge(
            $request->validated(),
            ['user_id' => Auth::id()]
        ));

        return ResponseHelper::success(
            message: "Commented successfully", 
            statusCode: 201
        );
    }
}
