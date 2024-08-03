<?php

namespace App\Http\Controllers\Api\v1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\User\EditProfileFormRequest;

class EditProfileController extends Controller
{
    public function __construct(private ImageUploadService $imageUploadService) {}

    /**
     * @OA\Post(
     *    path="/users/settings/accounts/update-profile",
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
     *            @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="avatar",
     *                      type="string",
     *                      format="binary",
     *                      description="avatar file to upload"
     *                  )
     *              )
     *          )
     *            @OA\Property(property="gitHub", type="string", example="@/chimobi-justice"),
     *            @OA\Property(property="website", type="string", example="justice-chimobi.vercel.app"),
     *            @OA\Property(property="profile_headlines", type="string", example="Frontend Developer || React || Typescript || laravel"),
     *            @OA\Property(property="bio", type="string", example="shout bio about me"),
     *            @OA\Property(property="state", type="string", example="Ebonyi"),
     *            @OA\Property(property="country", type="string", example="Nigeria"),
     * 
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
            $validated = $request->validated();

            if ($request->hasFile('avatar')) {
                $avatarUrl = $this->$imageUploadService->upload($request->file('avatar'));
                $validated['avatar'] = $avatarUrl;
            }

            $request->user()->update($validated);

            return response([
                'message' => 'Profile updated successfully!'
            ], 200);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);           
        }
    }
}