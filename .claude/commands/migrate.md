# /migrate — Safe migration workflow
## Always run from apps/web (primary app, shared DB)

1. Show pending: cd apps/web && php artisan migrate:status
2. Verify each has: tenant_id + softDeletes + timestamps + indexes
3. Show plan. Wait for approval.
4. Run: php artisan migrate
5. Verify: php artisan migrate:status
6. Report tables created/modified
