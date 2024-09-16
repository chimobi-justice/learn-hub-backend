<?php

namespace App\Http\Controllers\Api\v1\Threads;

use App\Models\Thread;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Thread\ThreadResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ShowThreadController extends Controller
{
     /**
    * @OA\Get(
    *  path="/threads/{thread}",
    *  tags={"threads"},
    *  summary="Get an thread by ID",
    *  description="Get an thread by ID",
    *  security={{"bearer_token": {}}},
    *  @OA\Parameter(
    *      name="id",
    *      description="Thread ID",
    *      required=true,
    *      in="path",
    *      @OA\Schema(
    *         type="number"
    *      ),
    *      @OA\Examples(example="id", value="9d04e3b2-7e14-472e-8095-7f7f9f0c943f", summary="An ID value."),
    *  ),
    *  @OA\Response(
    *     response="200", 
    *     description="Successful operation",
    *     @OA\JsonContent(
    *       @OA\Property(
    *         property="data", 
    *         type="array",
    *         @OA\Items(
    *           type="object",
    *           ref="#/components/schemas/ThreadResource"
    *         )
    *       )
    *     )
    *   ),
    *    @OA\Response(response="401", description="Unauthenticated"),
    *    @OA\Response(response="404", description="Thread not found"),
    * )
    */
    public function show($id) {
        try {
            $thread = Thread::findOrFail($id);

            return ResponseHelper::success(
                message: "success", 
                data: new ThreadResource($thread),
            );


        } catch (ModelNotFoundException  $th) {
            return ResponseHelper::error(
                message: "Thread not found",
                statusCode: 404
            );
        }
    }
}
