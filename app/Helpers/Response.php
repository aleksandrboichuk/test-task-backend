<?php

namespace App\Helpers;

use App\Interfaces\ResponseInterface;
use Illuminate\Http\JsonResponse;

class Response implements ResponseInterface
{
    public static function success(array $data): JsonResponse
    {
        return response()->json($data);
    }

    public static function badRequest(string $message = 'Bad Request'): JsonResponse
    {
        return response()->json([
            'message' => $message
        ], 400);
    }

    public static function failed(string $message = 'Internal Server Error'): JsonResponse
    {
        return response()->json([
            'message' => $message
        ], 500);
    }
}