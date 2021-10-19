<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct()
    {
    }

    public function SuccessResponse($data, $message = 'OK'): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    public function ErrorResponse($data, $message = 'Error', $errorCode = 404): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $errorCode);

    }
}
