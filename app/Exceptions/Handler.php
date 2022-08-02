<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }
    
    public function register()
    {
        //
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof QueryException) {
            return response()->json(['error' => $exception->getMessage()], 301);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(['error' => 'Method Not Allowed'], 405);
        }

        if ($exception instanceof ServiceUnavailableHttpException) {
            return response()->json(['error' => 'Server in maintenance'], 503);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json(['error' => 'Not Found'], 404);
        }


        if ($exception instanceof HttpException) {
            return response()->json(['error' => $exception->getMessage()], $exception->getStatusCode());
        }

        return parent::render($request, $exception);
    }
}
