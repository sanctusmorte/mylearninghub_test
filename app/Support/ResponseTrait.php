<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    protected function responseLibrary(Response $response, array $additionalData = []): JsonResponse
    {
        $responseLibraryData = $response->toArray();

        return response()->json(array_merge($responseLibraryData, $additionalData));
    }

    protected function responseSuccess(array $data = []): JsonResponse
    {
        return response()->json(array_merge($data, ['status' => 'success']));
    }

    protected function responseError(
        $message = 'error_core_internal',
        $data = [],
        int $httpCode = 200
    ): JsonResponse {
        return response()->json(
            array_merge(
                ['status' => 'error', 'error_message' => $message],
                $data
            ),
            $httpCode
        );
    }

    protected function response($data, int $httpCode = 200): JsonResponse
    {
        return response()->json($data, $httpCode);
    }

    protected function responseList(array $data, int $total, ?int $limit = null, ?int $offset = null): JsonResponse
    {
        $data = [
            'data' => $data,
            'metadata' => [
                'limit' => $limit ?? $total,
                'offset' => $offset ?? 0,
                'total' => $total,
            ],
        ];

        return $this->responseSuccess($data);
    }
}
