<?php

namespace App\Http\Controllers\Api\v1\User;

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
            if (auth()->check()) {
              auth()->user()->delete();
  
              return response(null, 204);
            }
          } catch (\Exception $e) {
              return response([
                  'message' => $e->getMessage()
              ]);
          }
    }
}
