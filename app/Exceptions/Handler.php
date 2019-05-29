<?php

namespace App\Exceptions;

use App\Exceptions\Api\ApiValidationException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        ModelNotFoundException::class,
        NotFoundHttpException::class,
        ApiValidationException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
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

        }

        return parent::render($request, $exception);
    }
}
