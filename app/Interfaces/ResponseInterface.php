<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;

interface ResponseInterface
{
    public static function success(array $data): JsonResponse;

    public static function badRequest(string $message = 'Bad Request'): JsonResponse;

    public static function failed(string $message = 'Internal Server Error'): JsonResponse;
}