<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->ajax()) {
            if ($e instanceof ValidationException) {
                $errors = $e->errors();

                return new JsonResponse([
                    'status' => 422,
                    'data' => null,
                    'errors' => $errors
                ], 422);
            }

            if ($e instanceof UnauthorizedHttpException) {
                return new JsonResponse([
                    'status' => 401,
                    'data' => null,
                    'errors' => [
                        $e->getMessage()
                    ]
                ], 401);
            }

            return new JsonResponse([
                'status' => 400,
                'data' => null,
                'errors' => [
                    $e->getMessage()
                ]
            ], 400);
        }

        return parent::render($request, $e);
    }
}
