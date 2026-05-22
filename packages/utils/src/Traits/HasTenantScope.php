<?php
namespace Pos\Utils\Traits;
use Illuminate\Database\Eloquent\Builder;
/**
 * HasTenantScope — Auto-scopes all queries to current tenant.
 * Add to every Model that is tenant-scoped.
 */
trait HasTenantScope
{
    protected static function bootHasTenantScope(): void
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            if (auth()->check() && auth()->user()->tenant_id) {
                $builder->where(
                    (new static)->getTable() . '.tenant_id',
                    auth()->user()->tenant_id
                );
            }
        });
        static::creating(function ($model) {
            if (auth()->check() && empty($model->tenant_id)) {
                $model->tenant_id = auth()->user()->tenant_id;
            }
        });
    }
    public function scopeForTenant(Builder $query, int $tenantId): Builder
    {
        return $query->withoutGlobalScope('tenant')
                     ->where($this->getTable() . '.tenant_id', $tenantId);
    }
}
