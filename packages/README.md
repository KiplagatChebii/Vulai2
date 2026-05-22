# packages/ — Shared Code Across All Apps

Never duplicate code between apps. Extract it here.

packages/ui/     → Blade components (web + admin)
packages/utils/  → PHP traits and helpers (all apps)
packages/config/ → Shared constants and config

## Included
- HasTenantScope trait — auto-scopes queries to current tenant
- HasAuditLog trait — auto-sets created_by / updated_by
- Currency helper — safe money handling (always cents)
- ApiResponse helper — consistent API JSON responses
- BaseService — all services extend this
- PosConstants — sale statuses, payment methods, etc.
