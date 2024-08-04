<?php

namespace App\Http\Controllers\Api\v1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    /**
     * @OA\Patch(
     *    path="/users/accounts/update-password",
     *    tags={"users"},
     *    summary="Update user password",
     *    description="Update user password",
     *    security={{"bearer_token": {}}},
     *    @OA\RequestBody(
     *        required=true,
     *        description="Update user password",
     *        @OA\JsonContent(
     *            @OA\Property(property="current_password", type="string", example="oldpassword"),
     *            @OA\Property(property="password", type="string", example="mynewpassword"),
     *            @OA\Property(property="password_confirmation", type="string", example="mynewpassword")
     *        )
     *    ),
     *    @OA\Response(
     *        response="200", 
     *        description="Password updated successfully!",
     *        
     *        @OA\JsonContent(
     *           example={
     *              "message": "Password updated successfully!",
     *           }
     *        ),
     *    ),
     *    @OA\Response(response="400", description="Bad Request"),
     *    @OA\Response(response="401", description="Unauthenticated."),
     *    @OA\Response(response="422", description="Unprocessable Content"),
     * )
    */
    public function store(Request $request) {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed', 
        ]);

        auth()->user()->update([
            'password' => $request->password
        ]);

        return response()->json([
            'message' => 'Password updated successfully!'
        ]);
    }
}
