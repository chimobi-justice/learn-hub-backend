<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    /**
     * @OA\Patch(
     *      path="/users/accounts/upload-avatar",
     *      tags={"users"},
     *      summary="Update current authenticated user avatar profile, please ensure you get your image url from cloudinary image upload endpoint",
     *      security={{"bearer_token": {}}},
     *      description="Update current authenticated user avatar profile",
     *      @OA\RequestBody(
     *        required=true,
     *        description="Update user avatar profile",
     *        @OA\JsonContent(
     *            @OA\Property(property="avatar", type="string", example="https://res.cloudinary.com/dbx3dhfkt/image/upload/v1672045944/estudy/pictures/image-5a9482cd3-a97e-4627-dbc3-9cb53797e40a.png")
     *        )
     *      ),
     * *    @OA\Response(
     *        response="200", 
     *        description="Updated successfully",
     *        
     *        @OA\JsonContent(
     *           example={
     *              "message": "Updated successfully"
     *           }
     *        ),
     *     ),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="422", description="Unprocessable Content"),
     *     @OA\Response(response="401", description="Unathenticated")
     *  )
     */  
    public function store(Request $request) {
        try {
            $request->user()->update([
                'avatar' => $request->avatar
            ]);

            return response([
                'message' => 'Updated successfully!'
            ], 200);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);           
        }
    }
}
