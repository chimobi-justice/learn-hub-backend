<?php

namespace App\Http\Controllers\Api\v1\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;

class UploadController extends Controller
{
    public function __construct(private ImageUploadService $imageUploadService) {}

     /**
     * @OA\Post(
     *      path="/image/upload",
     *      tags={"upload"},
     *      summary="Upload image to cloudinary",
     *      security={{"bearer_token": {}}},
     *      description="Upload image to cloudinary and get actual url from response to use for avatar, thumbnail endpoint",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Image file to upload",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="avatar",
     *                      type="string",
     *                      format="binary",
     *                      description="image file to upload"
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Uploaded successfully",
     *          @OA\JsonContent(
     *              example={
     *                  "message": "Uploaded successfully!",
     *                  "imageUploadUrl": "https://res.cloudinary.com/estudy/image/upload/v1705789451/yofikr4gyecw04sp5ial.png"
     *              }
     *          )
     *      ),
     *      @OA\Response(response="401", description="Unauthenticated")
     * )
     */
    public function store(Request $request) {
        $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg,JPG,PNG|max:2048',
        ]);

        try {
            $imageUploadUrl = $this->imageUploadService->upload($request->file('image'));

            return response()->json([
                'message' => 'Uploaded successfully!',
                'imageUploadUrl' => $imageUploadUrl
            ], 201);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
