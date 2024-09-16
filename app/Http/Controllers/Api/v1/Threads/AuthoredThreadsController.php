<?php

namespace App\Http\Controllers\Api\v1\Threads;

use App\Models\Thread;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Thread\AuthoredThreadsResource;
use App\Http\Resources\PaginationResource;

class AuthoredThreadsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/threads/authored",
     *      tags={"threads"},
     *      summary="Get paginated list of authored threads",
     *      description="Returns paginated list of authored threads if limit is provided 10 by default",
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
    public function getAuthoredThreads(Request $request) {
        $limit = $request->query('limit', 10);

        $threads = auth()->user()->threads()->paginate($limit);
        
        return ResponseHelper::success(
            message: "success", 
            data: [
                "threads" => AuthoredThreadsResource::collection($threads),
                "pagination" => PaginationResource::make($articles)
            ]
        );
    }
}
