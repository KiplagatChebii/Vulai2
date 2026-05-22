# /test — Run full test suite
```bash
bash scripts/test-all.sh
```
Per app:
```bash
cd apps/web && php artisan test
cd apps/mobile-api && php artisan test
cd apps/admin && php artisan test
```
On failure: explain root cause, propose fix, wait for approval, re-run after fix.
