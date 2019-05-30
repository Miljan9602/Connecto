<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionHandler extends Handler
{
    public function render($request, Exception $exception)
    {
        if ($request->expectsJson()) {

            // Resource does not exists.
            if ($exception instanceof ModelNotFoundException) {
                return response()->json(['status' => 'fail', 'error_type' => 'resource_not_found', 'message' => 'Resource does not exists'], 404);
            }

            // Page does not exists
            if ($exception instanceof NotFoundHttpException) {
                return response()->json(['status' => 'fail', 'error_type' => 'page_not_found', 'message' => 'Requested page does not exists.'], 404);
            }

            // User not authenticated
            if ($exception instanceof AuthenticationException) {
                return response()->json(['status' => 'fail', 'error_type' => 'authentication_error', 'message' => 'Please authenticate for a given request'], 401);
            }

            if ($exception instanceof ThrottleRequestsException) {
                return response()->json(['status' => 'fail', 'error_type' => 'throttle_error', 'message' => 'Request rate is exceeded.'], 429, $exception->getHeaders());
            }

        }

        return parent::render($request, $exception);
    }
}
