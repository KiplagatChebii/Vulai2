<?php
namespace Pos\Utils\Traits;
/**
 * HasAuditLog — Auto-sets created_by and updated_by.
 * Requires: created_by, updated_by columns in migration.
 */
trait HasAuditLog
{
    protected static function bootHasAuditLog(): void
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->created_by = auth()->id();
                $model->updated_by = auth()->id();
            }
        });
        static::updating(function ($model) {
            if (auth()->check()) {
                $model->updated_by = auth()->id();
            }
        });
    }
    public function creator() { return $this->belongsTo(config('auth.providers.users.model'), 'created_by'); }
    public function updater() { return $this->belongsTo(config('auth.providers.users.model'), 'updated_by'); }
}
