<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Helpers\ResponseHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *  path="/users/me",
     *  tags={"users"},
     *  summary="Get curently authenticated user details",
     *  description="Get curently authenticated user details",
     *  security={{"bearer_token": {}}},
     *  @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        
     *        @OA\JsonContent(
     *           @OA\property(
     *             property="data", 
     *             example={
     *               "id": "550e8400-e29b-41d4-a716-446655440000",
     *               "fullname": "justice chimobi",      
     *               "email": "justice@emample.com",
     *               "twiter": "x.com/justice-chimobi",
     *               "avatar": "https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.jpg",
     *               "github": "github.com/justice-chimobi",
     *               "website": "justice-chimobi.vercel.app",
     *               "profile_headlines": "Frontend Developer || React || Typescript || laravel",
     *               "bio": "short bio about me",
     *               "state": "Ebonyi",
     *               "country": "Nigeria",
     *             }
     *           )
     *        )
     *    ),
     *    @OA\Response(response="401", description="Unathenticated"),
     * )
    */
    public function index(Request $request) {
        $user = auth()->user();
        $user->load("socials");
        
        return new UserResource($user);
    }

    /**
     * @OA\Get(
     *  path="/users/{username}",
     *  tags={"users"},
     *  summary="Get user details when not authenticated eg eg using username of the user to get the response publicly",
     *  description="Get user details when not authenticated eg using username of the user to get the response publicly",
     *  security={{"bearer_token": {}}},
     *  @OA\Parameter(
     *     name="username",
     *     in="query",
     *     description="Get user details when not authenticated eg using username of the user to get the response publicly",
     *     required=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *  ),
     *  @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        
     *        @OA\JsonContent(
     *           @OA\property(
     *             property="data", 
     *             example={
     *               "id": "550e8400-e29b-41d4-a716-446655440000",
     *               "fullname": "justice chimobi",      
     *               "email": "justice@emample.com",
     *               "twiter": "x.com/justice-chimobi",
     *               "avatar": "https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.jpg",
     *               "github": "github.com/justice-chimobi",
     *               "website": "justice-chimobi.vercel.app",
     *               "profile_headlines": "Frontend Developer || React || Typescript || laravel",
     *               "bio": "short bio about me",
     *               "state": "Ebonyi",
     *               "country": "Nigeria",
     *             }
     *           )
     *        )
     *    ),
     *    @OA\Response(response="401", description="Unathenticated"),
     * )
    */
    public function publicUser($username) {
        try {
            $user = User::with('socials')->where('username', $username)->firstOrFail();
        
            return ResponseHelper::success(
                message: "success", 
                data: new UserResource($user)
            );
        } catch (ModelNotFoundException $th) {
            return ResponseHelper::error(
                message: "Not found",
                statusCode: 404
            );
        }
    }
}
