<?php

namespace App\Http\Controllers\Api\v1\Threads;

use App\Models\Thread;
use App\Models\ThreadComment;
use App\Http\Requests\Thread\ThreadCommentFormRequest;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ThreadCommentController extends Controller
{
    use AuthorizesRequests;
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
        $thread->threadComments()->create([
            'comment' => $request->input('comment'),
            'user_id' => Auth::id(),
            'parent_id' => $request->input('parent_id')
        ]);

        return ResponseHelper::success(
            message: "Commented successfully", 
            statusCode: 201
        );
    }

    public function edit(ThreadCommentFormRequest $request, ThreadComment $thread) {
        try {
            $thread->update([
                'comment' => $request->input('comment'),
            ]);
            
            return ResponseHelper::success(message: "Your reply edited successfully");
        } catch (ModelNotFoundException $th) {
            return ResponseHelper::error(
                message: "Not found",
                statusCode: 404
            );
        }
    }

    public function destroy($id) {
        try {
            $comment = ThreadComment::findOrFail($id);

            $this->authorize('delete', $comment);

            $comment->delete();

            return ResponseHelper::success(
                message: "Deleted successfully!", 
                statusCode: 200
            );
        } catch (ModelNotFoundException  $th) {
            return ResponseHelper::error(
                message: "Comment not found",
                statusCode: 404
            );
        }
    }
}
