<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;

trait ApiResponse
{
    protected function success($result = null, string $message = 'Sucesso'): JsonResponse
    {
        return response()->json([
            'ok' => true,
            'result' => $result,
            'message' => $message
        ], 200);
    }

    protected function create($result = null, string $message = 'Criado'): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'ok' => true,
            'result' => $result
        ], 201);
    }

    protected function noContent(): Response
    {
        return response()->noContent();
    }

    protected function badRequest(MessageBag|null $errors, string $message = 'Requisição inválida')
    {
        return response()->json([
            'ok' => false,
            'result' => null,
            'errors' => $errors,
            'message' => $message
        ], 400);
    }

    protected function unathorized(
        string $message,
        MessageBag|null $errors = null
    ) {
        return response()->json([
            'ok' => false,
            'result' => null,
            'errors' => $errors,
            'message' => $message,
        ], 401);
    }

    protected function forbidden(
        string $message,
        MessageBag|null $errors = null
    ) {
        return response()->json([
            'ok' => false,
            'result' => null,
            'errors' => $errors,
            'message' => $message,
        ], 403);
    }

    protected function notFound($result = null, string $message = 'Não encontrado'): JsonResponse
    {
        return response()->json([
            'ok' => false,
            'result' => $result,
            'message' => $message,
        ], 404);
    }

    protected function serverError($result = null, string $message = 'Falha no servidor'): JsonResponse
    {
        return response()->json([
            'ok' => false,
            'result' => $result,
            'message' => $message
        ], 500);
    }
}
