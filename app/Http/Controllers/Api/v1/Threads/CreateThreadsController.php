<?php

namespace App\Http\Controllers\Api\v1\Threads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Thread\ThreadFormRequest;

class CreateThreadsController extends Controller
{
    /**
     * @OA\Post(
     *    path="/threads/create",
     *    tags={"threads"},
     *    summary="Create a thread",
     *    description="Create a thread",
     *    security={{"bearer_token": {}}},
     *    @OA\RequestBody(
     *        required=true,
     *        description="Create a thread",
     *        @OA\JsonContent(
     *            @OA\Property(property="title", type="string", example="Intro to Reactjs and typeScript"),
     *            @OA\Property(property="content", type="string", example="Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."),
     *        )
     *    ),
     *    @OA\Response(
     *        response="201", 
     *        description="Thread created successfully!",
     *        
     *        @OA\JsonContent(
     *           example={
     *              "message": "Thread created successfully!"
     *           }
     *        ),
     *    ),
     *    @OA\Response(response="400", description="Bad Request"),
     *    @OA\Response(response="401", description="Unauthenticated."),
     *    @OA\Response(response="422", description="Unprocessable Content"),
     * )
    */
    public function store(ThreadFormRequest $request) {
        auth()->user()->threads()->create($request->validated());

        return ResponseHelper::success(
            message: "Thread created successfully!", 
            statusCode: 201
        );
    }
}
