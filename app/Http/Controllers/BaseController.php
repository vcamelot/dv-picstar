<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    public function __construct()
    {
    }

    public function SuccessResponse($data, $message = 'OK', $errorCode = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $errorCode);
    }

    public function ErrorResponse($data, $message = 'Error', $errorCode = 404): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $errorCode);

    }
}
