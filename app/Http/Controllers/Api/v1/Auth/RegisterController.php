<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;

class RegisterController extends Controller
{
    /**
     * @OA\Post(
     *    path="/auth/register",
     *    tags={"auth"},
     *    summary="Registers a new user",
     *    description="Registers a new user",
     *    @OA\RequestBody(
     *        required=true,
     *        description="create new user",
     *        @OA\JsonContent(
     *            @OA\Property(property="fullname", type="string", example="justice Owen"),
     *            @OA\Property(property="email", type="string", example="justice@example.com"),
     *            @OA\Property(property="password", type="string", example="secrets"),
     *        )
     *    ),
     *    @OA\Response(
     *        response="201", 
     *        description="account created successfully",
     *        
     *        @OA\JsonContent(
     *           example={
     *              "message": "account created successfully",
     *           }
     *        ),
     *    ),
     *    @OA\Response(response="400", description="Bad Request"),
     *    @OA\Response(response="422", description="Unprocessable Content"),
     * )
    */
    public function register(RegisterFormRequest $request) {
        $user = User::create($request->validated());

        return ResponseHelper::success(
            message: "account created successfully!", 
            statusCode: 201
        );
    }
}
