<?php

namespace App\Traits;

trait MessageTrait
{

    public function sendSuccess($data = [], $message = 'Operation Successful', $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }


    public function sendError($message = 'Something went wrong', $status = 400, $data = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
