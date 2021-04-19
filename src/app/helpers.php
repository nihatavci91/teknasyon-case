<?php

function response_success($data = null, $message = 'success', $statusCode = 200)
{
    return response()->json([
        "message" => $message,
        "data" => $data
    ], $statusCode);
}

function response_error($errors = null, $message = 'error', $statusCode = 400)
{
    return response()->json([
        'message' => $message,
        'errors' => $errors
    ], $statusCode);
}
