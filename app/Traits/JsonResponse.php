<?php

namespace App\Traits;

use App\Helpers\DatatableForResource;
use Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

trait JsonResponse
{
    public function successResponse($data, $statusCode = Response::HTTP_OK): \Illuminate\Http\JsonResponse
    {
        return response()->json($data, $statusCode);
    }

    public function errorResponse($data = null, $message = null, $statusCode = Response::HTTP_BAD_REQUEST): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "data" => $data,
            "message" => $message
        ], $statusCode);
    }

    public function fatalErrorResponse(Exception $e, $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): \Illuminate\Http\JsonResponse
    {
        $line = $e->getTrace();

        $error = [
            "message" => $e->getMessage(),
            "trace" => $line[0],
            "mini_trace" => $line[1]
        ];

        if (strtoupper(config("APP_ENV")) === "production") $error = null;


        return response()->json([
            "message" => "Oops! Something went wrong on the server",
            "error" => $error
        ], $statusCode);
    }
}
