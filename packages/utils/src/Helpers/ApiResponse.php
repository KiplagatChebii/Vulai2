<?php
namespace Pos\Utils\Helpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
/**
 * ApiResponse — Consistent JSON responses for mobile-api.
 */
class ApiResponse
{
    public static function success(mixed $data = null, string $message = 'Success', int $status = 200): JsonResponse
    {
        return response()->json(['data' => $data, 'message' => $message, 'status' => $status], $status);
    }
    public static function error(string $message = 'Error', int $status = 400, mixed $errors = null): JsonResponse
    {
        $payload = ['data' => null, 'message' => $message, 'status' => $status];
        if ($errors !== null) $payload['errors'] = $errors;
        return response()->json($payload, $status);
    }
    public static function paginated(LengthAwarePaginator $paginator, string $resourceClass, string $message = 'Success'): JsonResponse
    {
        return response()->json([
            'data'    => $resourceClass::collection($paginator->items()),
            'message' => $message,
            'status'  => 200,
            'meta'    => ['current_page' => $paginator->currentPage(), 'last_page' => $paginator->lastPage(), 'per_page' => $paginator->perPage(), 'total' => $paginator->total()],
        ]);
    }
    public static function unauthorized(string $message = 'Unauthorized'): JsonResponse { return self::error($message, 401); }
    public static function notFound(string $message = 'Not found'): JsonResponse { return self::error($message, 404); }
    public static function validationError(mixed $errors, string $message = 'Validation failed'): JsonResponse { return self::error($message, 422, $errors); }
}
