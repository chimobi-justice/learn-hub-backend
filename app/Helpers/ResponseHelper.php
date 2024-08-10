<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper {
    /**
     * Return a successful JSON response.
     *
     * @param string $message
     * @param array|object $data
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success(
        string $message = "Operation successful", 
        array|object $data = [], 
        int $statusCode = 200
    ): JsonResponse {

        $response = ["message" => $message];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

     /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error(
        $message = 'An error occurred', 
        $statusCode = 400
    ): JsonResponse {
        return response()->json(['message' => $message], $statusCode);
    }
}