<?php

namespace App\Http\Controllers\Api\v1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * @OA\POST(
     *   path="/auth/signout",
     *   tags={"auth"},
     *   summary="Logs out an existing user",
     *   description="Logs out an existing user",
     *   security={{"bearer_token": {}}},
     *   @OA\Response(
     *    response="200",
     *    description="logged out Successfully",
     *       
     *    @OA\JsonContent(
     *       example={
     *          "message": "logged out Successfully",     
     *        }
     *    )
     *   ),
     *   @OA\Response(response="401", description="Unauthenticated"),
     *   @OA\Response(response="500", description="Internal Server Error")
     * )
    */
    public function logout() {
        Auth::guard('api')->logout();

        return response()->json(['message' => 'logged out Successfully']);
    }
}
