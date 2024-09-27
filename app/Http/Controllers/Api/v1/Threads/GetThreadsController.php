<?php

namespace App\Http\Controllers\Api\v1\Threads;

use App\Models\Thread;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Thread\ThreadResource;
use App\Http\Resources\PaginationResource;

class GetThreadsController extends Controller
{
        /**
     * @OA\Get(
     *      path="/threads/all",
     *      tags={"threads"},
     *      summary="Get list of threads",
     *      description="Returns list of threads and if limit is provided returns the number of limited threads",
     *      security={{"bearer_token": {}}},
     *      @OA\Parameter(
     *          name="limit",
     *          in="query",
     *          description="Number of threads to return",
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
     *                  property="data", 
     *                  type="array",
     *                   @OA\Items(
     *                   type="object",
     *                      ref="#/components/schemas/ThreadResource"
     *                   )
     *               )
     *           )
     *       )
     *  )
     */
    public function getAllThreads(Request $request) {
        $limit = $request->query("limit");

        $threads = Thread::latest()->limit($limit)->get();       

        return ResponseHelper::success(
            message: "success", 
            data: ThreadResource::collection($threads),
        );
    }

    /**
     * @OA\Get(
     *      path="/threads/all/paginate",
     *      tags={"threads"},
     *      summary="Get paginated list of threads",
     *      description="Returns paginated list of threads if limit is provided 8 by default",
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
     *                      @OA\Items(ref="#/components/schemas/ThreadResource")
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
    public function getPaginatedThreads(Request $request) {
        $limit = $request->query("limit", 8);

        $threads = Thread::latest()->paginate($limit);
        
        return ResponseHelper::success(
            message: "success", 
            data: [
                "threads" => ThreadResource::collection($threads),
                "pagination" => PaginationResource::make($threads)
            ],
        );
    }
}
