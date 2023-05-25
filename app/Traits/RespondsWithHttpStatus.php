<?php


namespace App\Traits;
use Illuminate\Http\Response;

trait RespondsWithHttpStatus
{
    protected function success($message, $data = [], $status =  Response::HTTP_OK)
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function failure($message, $status =  Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
