<?php
namespace Pos\Utils\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
/**
 * BaseService — All POS services extend this.
 */
abstract class BaseService
{
    protected function transaction(callable $callback): mixed { return DB::transaction($callback); }
    protected function logError(string $message, array $context = []): void { Log::error('[' . static::class . '] ' . $message, $context); }
    protected function logInfo(string $message, array $context = []): void { Log::info('[' . static::class . '] ' . $message, $context); }
}
