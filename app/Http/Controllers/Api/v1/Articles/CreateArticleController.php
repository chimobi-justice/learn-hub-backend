<?php

namespace App\Http\Controllers\Api\v1\Articles;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleFormRequest;

class CreateArticleController extends Controller
{
    /**
     * @OA\Post(
     *    path="/articles/create",
     *    tags={"articles"},
     *    summary="Create a articles, please ensure you get your image url from upload tags image/upload endpoint",
     *    description="Create a articles",
     *    security={{"bearer_token": {}}},
     *    @OA\RequestBody(
     *        required=true,
     *        description="Create a articles",
     *        @OA\JsonContent(
     *            @OA\Property(property="title", type="string", example="Intro to Reactjs and typeScript"),
     *            @OA\Property(property="content", type="string", example="Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."),
     *            @OA\Property(property="thumbnail", type="string", example="https://res.cloudinary.com/dbx3dhfkt/image/upload/v1672045944/estudy/pictures/image-5a9482cd3-a97e-4627-dbc3-9cb53797e40a.png")
     *        )
     *    ),
     *    @OA\Response(
     *        response="201", 
     *        description="Article created successfully!",
     *        
     *        @OA\JsonContent(
     *           example={
     *              "message": "Article created successfully!"
     *           }
     *        ),
     *    ),
     *    @OA\Response(response="400", description="Bad Request"),
     *    @OA\Response(response="401", description="Unauthenticated."),
     *    @OA\Response(response="422", description="Unprocessable Content"),
     * )
    */
    public function store(ArticleFormRequest $request) {
        auth()->user()->articles()->create($request->validated());
        
        return ResponseHelper::success(
            message: "Article created successfully!", 
            statusCode: 201
        );
    }
}
