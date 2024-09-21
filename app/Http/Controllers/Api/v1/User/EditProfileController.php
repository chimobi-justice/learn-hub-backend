<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\User\EditProfileFormRequest;

class EditProfileController extends Controller
{
    /**
     * @OA\Patch(
     *    path="/users/accounts/update-profile",
     *    tags={"users"},
     *    summary="Edit a user profile",
     *    description="Edit a user profile",
     *    security={{"bearer_token": {}}},
     *    @OA\RequestBody(
     *        required=true,
     *        description="Edit a user profile",
     *        @OA\JsonContent(
     *            @OA\Property(property="fullname", type="string", example="justice chimobi"),
     *            @OA\Property(property="username", type="string", example="justice-chimobi"),
     *            @OA\Property(property="twitter", type="string", example="@justice-chimobi"),
     *            @OA\Property(property="gitHub", type="string", example="@/chimobi-justice"),
     *            @OA\Property(property="website", type="string", example="justice-chimobi.vercel.app"),
     *            @OA\Property(property="profile_headlines", type="string", example="Frontend Developer || React || Typescript || laravel"),
     *            @OA\Property(property="bio", type="string", example="shout bio about me"),
     *            @OA\Property(property="state", type="string", example="Ebonyi"),
     *            @OA\Property(property="country", type="string", example="Nigeria")
     *        )
     *    ),
     *    @OA\Response(
     *        response="200", 
     *        description="Profile updated successfully!",
     *        
     *        @OA\JsonContent(
     *           example={
     *              "message": "Profile updated successfully!",
     *           }
     *        ),
     *    ),
     *    @OA\Response(response="400", description="Bad Request"),
     *    @OA\Response(response="401", description="Unauthenticated."),
     *    @OA\Response(response="422", description="Unprocessable Content"),
     * )
    */
    public function store(EditProfileFormRequest $request) {
        try {
            auth()->user()->update($request->validated());

            return response([
                'message' => 'Profile updated successfully!'
            ], 200);

            return ResponseHelper::success(message: "Profile updated successfully!");
        } catch (\Exception $e) {    
            return ResponseHelper::error(
                message: "Something went wrong!",
                statusCode: 500
            );
        }
    }
}
