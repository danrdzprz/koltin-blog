<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
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
        $this->reportable(function (\Throwable $e) {
        });

        $this->renderable(function (\Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                return $this->handleException($e);
            }
        });
    }

    public function handleException(\Throwable $e): JsonResponse
    {
        if ($e instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($e->getModel()));

            return $this->errorResponse("Does not exist any instance of {$model} with the given id", Response::HTTP_NOT_FOUND);
        } elseif ($e instanceof AuthorizationException) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_FORBIDDEN);
        } elseif ($e instanceof NotFoundHttpException) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_NOT_FOUND);
        } elseif ($e instanceof AuthenticationException) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        } elseif ($e instanceof ValidationException) {
            $errors = $e->validator->errors()->getMessages();

            return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        } elseif ($e instanceof \Exception) {
            $errors = $e->getMessage();

            return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            if (config('app.debug')) {
                return $this->dataResponse($e->getMessage());
            } else {
                return $this->errorResponse('Try later', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    /**
     * Data Response.
     */
    public function dataResponse(string $data): JsonResponse
    {
        return response()->json(['content' => $data], Response::HTTP_OK);
    }

    /**
     * Success Response.
     *
     * @param int $code
     */
    public function successResponse(string $message, $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['success' => $message, 'code' => $code], $code);
    }

    /**
     * Error Response.
     *
     * @param int $code
     */
    public function errorResponse(array|string $message, $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json(['message' => $message, 'code' => $code], $code);
    }
}
