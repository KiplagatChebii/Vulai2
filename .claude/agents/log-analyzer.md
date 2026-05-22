# Log Analyzer Agent
Role: Debug — root cause first, minimal fix second

## Output
ERROR TYPE: QueryException
FILE: apps/web/app/Services/SaleService.php
LINE: 87
ROOT CAUSE: Missing tenant_id scope
FIX: Add ->where('tenant_id', $tenantId)
VERIFY: php artisan test --filter=SaleServiceTest
