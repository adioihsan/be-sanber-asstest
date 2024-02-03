<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    /**
     * Indicates that an exception instance should only be reported once.
     *
     * @var bool
     */
    protected $withoutDuplicates = true;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (\Throwable $exception, $request) {
            if($exception instanceof NotFoundHttpException){
                $statusCode = $exception->getStatusCode() ?: 404;
                $message = $exception->getMessage();
                return response()->api_fail($message,[],$statusCode);
            }
            if($exception instanceof AuthenticationException){
                $message = $exception->getMessage();
                return response()->api_fail($message,[],401);
            }
            if($exception instanceof HttpException){
                $message = $exception->getMessage();
                return response()->api_fail($message,[],401);
            }
            return response()->api_fail("Server Error!",[],401);
        });
        
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
