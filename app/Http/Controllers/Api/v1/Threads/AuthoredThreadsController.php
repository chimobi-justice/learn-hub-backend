<?php

namespace App\Http\Controllers\Api\v1\Threads;

use App\Models\User;
use App\Models\Thread;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Thread\AuthoredThreadsResource;
use App\Http\Resources\PaginationResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthoredThreadsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/threads/authored/{username}",
     *      tags={"threads"},
     *      summary="Fetch paginated threads authored by the authenticated user, please pass the authored username",
     *      description="Returns paginated threads authored by the authenticated user if limit is provided 10 by default",
     *      security={{"bearer_token": {}}},
     *      @OA\Parameter(
     *          name="limit",
     *          in="query",
     *          description="Number of threads to return per page",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="success"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(
     *                      property="threads",
     *                      type="array",
     *                      @OA\Items(ref="#/components/schemas/AuthoredThreadsResource")
     *                  ),
     *                  @OA\Property(
     *                      property="pagination",
     *                      type="array",
     *                      @OA\Items(ref="#/components/schemas/PaginationResource")
     *                  ),
     *              )
     *           )
     *       )
     *  )
     */
    public function getAuthoredThreads(Request $request, $username) {
        try {
            $user = User::where('username', $username)->firstOrFail();

            if (auth()->id() !== $user->id) {
                throw new ModelNotFoundException();
            }
            
            $limit = $request->query('limit', 10);

            $threads = $user->threads()->paginate($limit);
            
            return ResponseHelper::success(
                message: "Success",
                data: [
                    "threads" => AuthoredThreadsResource::collection($threads),
                    "pagination" => PaginationResource::make($threads)
                ]
            );
            
        } catch (ModelNotFoundException $th) {
            return ResponseHelper::error(
                message: "Resource not found",
                statusCode: 404
            );
        }
    }
}
