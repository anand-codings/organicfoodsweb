<?php

use Illuminate\Support\Facades\Response;

function sendSuccess($message, $data) {
//    return Response::json(array('status' => 'success', 'successMessage' => $message, 'successData' => $data), 200, [], JSON_NUMERIC_CHECK);
    return Response::json(array('status' => 'success', 'successMessage' => $message, 'successData' => $data), 200, []);
}

function sendError($error_message, $code) {
    return Response::json(array('status' => 'error', 'errorMessage' => $error_message), $code);
}


