# /ship — Test, cache, deploy
## Usage: /ship web | /ship api | /ship admin | /ship all

1. Run tests for target app — STOP if any fail
   ```bash
   cd apps/web && php artisan test          # /ship web
   cd apps/mobile-api && php artisan test   # /ship api
   cd apps/admin && php artisan test        # /ship admin
   bash scripts/test-all.sh                 # /ship all
   ```
2. Safety checks: no dd(), no hardcoded secrets, no DB:: in controllers
3. Cache rebuild: optimize:clear, config:cache, route:cache, view:cache
4. Show git status — wait for approval
5. After confirmation: git add . && git commit && git push origin main
6. Report: what shipped, tests passed, any warnings
