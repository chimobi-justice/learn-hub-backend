<?php

namespace App\Http\Controllers\Api\v1\Threads;

use App\Models\Thread;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Thread\ThreadFormRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EditThreadsController extends Controller
{
    use AuthorizesRequests;

    /**
    * @OA\Patch(
    *  path="/threads/edit/{thread}",
    *  tags={"threads"},
    *  summary="Update thread created by a author",
    *  description="Update thread created by a author",
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
    *    description="Update thread created by a author",
    *    @OA\JsonContent(
    *      @OA\Property(property="title", type="string", example="learn-hub thread name"),
    *      @OA\Property(property="content", type="string", example="content of the thread body"), 
    *    )
    *  ),
    *  @OA\Response(
    *    response="200", 
    *    description="Successful operation",
    *    @OA\JsonContent(
    *      example={
    *       "message": "Thread updated successfully",      
    *       }
    *    ),
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    *    @OA\Response(response="403", description="You are not authorized to edit this thread."),
    *    @OA\Response(response="404", description="Thread not found")
    * )
    */
    public function edit(ThreadFormRequest $request, Thread $thread) {
        try {
            $this->authorize('update', $thread);
    
            $thread->update($request->validated());
    
            return ResponseHelper::success("Thread updated successfully!");

        } catch (ModelNotFoundException  $th) {
            return ResponseHelper::error(
                message: "Thread not found",
                statusCode: 404
            );
        }
    }
}
