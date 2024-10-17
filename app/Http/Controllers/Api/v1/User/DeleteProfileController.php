<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteProfileController extends Controller
{
     /**
     * @OA\Delete(
     *  path="/users/accounts/delete",
     *  tags={"users"},
     *  summary="Delete user account",
     *  description="Delete user account",
     *  security={{"bearer_token": {}}},
     *  @OA\Response(
     *        response="204", 
     *        description="Successful operation",
     *    ),
     *    @OA\Response(response="401", description="Unauthenticated"),
     * )
    */
    public function destroy()
    {
        try {
            if (!auth()->check()) {
              return ResponseHelper::error(
                message: "Unauthenticated.",
                statusCode: 401
              );
            }
              $user = auth()->user();
              // Delete related user data
              $this->deleteUserData($user);
              // Delete the user account
              $user->delete();
              // Return successful deletion response
              return response(null, 204);
          } catch (\Exception $e) {
              return ResponseHelper::error(
                message: "Something went wrong!",
                statusCode: 500
            );
          }
    }

    private function deleteUserData($user) {
      // delete user articles, threads, saved articles 
      $user->articles()->delete();
      $user->threads()->delete();
      $user->savedArticles()->delete();
    }
}
