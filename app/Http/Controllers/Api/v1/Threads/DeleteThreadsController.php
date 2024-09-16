<?php

namespace App\Http\Controllers\Api\v1\Threads;

use App\Models\Thread;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteThreadsController extends Controller
{
    use AuthorizesRequests;

    /**
    * @OA\Delete(
    *  path="/threads/delete/{thread}",
    *  tags={"threads"},
    *  summary="Author delete a created thread",
    *  description="Author delete a created thread",
    *  security={{"bearer_token": {}}},
    *  @OA\Parameter(
    *      name="id",
    *      description="Thread ID",
    *      required=true,
    *      in="path",
    *      @OA\Schema(
    *         type="string"
    *      ),
    *      @OA\Examples(example="id", value="9d04e3b2-7e14-472e-8095-7f7f9f0c943f", summary="Id value."),
    *  ),
    *  @OA\Response(
    *        response="200", 
    *        description="Thread deleted successfully!",
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    *    @OA\Response(response="403", description="You are not authorized to delete this Thread."),
    * )
    */
    public function delete($id) {        
        try {
            $thread = Thread::findOrFail($id);

            $this->authorize('delete', $thread);

            $thread->delete();

            return ResponseHelper::success(
                message: "Thread deleted successfully!", 
                statusCode: 200
            );

        } catch (ModelNotFoundException  $th) {
            return ResponseHelper::error(
                message: "Thread not found",
                statusCode: 404
            );
        }
    }
}
