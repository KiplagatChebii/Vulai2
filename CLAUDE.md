# CLAUDE.md — POS Monorepo
> Instructions only. Read fully. Follow exactly.

## What This Is
Laravel 11 POS Monorepo — three apps, one repository.
Multi-tenant. Web + Mobile API + Admin Panel.

```
pos-monorepo/
  apps/
    web/          ← Customer-facing POS (Laravel 11 + Blade)
    mobile-api/   ← Mobile app backend (Laravel 11 + Sanctum)
    admin/        ← Super-admin panel (Laravel 11 + Blade)
  packages/
    ui/           ← Shared Blade components
    utils/        ← Shared PHP helpers and traits
    config/       ← Shared config files
```

## The Golden Monorepo Rule
Shared code goes in packages/ ONLY. Never copy between apps.

## Stack
| App | Framework | Auth | Port |
|---|---|---|---|
| web | Laravel 11 + Blade + Alpine.js | Session | 8000 |
| mobile-api | Laravel 11 + Sanctum | Token | 8001 |
| admin | Laravel 11 + Blade | Session | 8002 |

PHP 8.2 | MySQL 8 (shared DB across all apps)

## Multi-Tenancy — CRITICAL
- EVERY data table has tenant_id
- EVERY query scoped: ->where('tenant_id', $tenantId)
- admin/ manages tenants — it is NOT tenant-scoped
- web/ and mobile-api/ are ALWAYS tenant-scoped

## Naming — No Exceptions
| Thing | Convention | Example |
|---|---|---|
| Controllers | PascalCase singular | SaleController |
| Models | PascalCase singular | Sale |
| Services | PascalCase + Service | SaleService |
| API Resources | PascalCase + Resource | SaleResource |
| Form Requests | PascalCase + Request | StoreSaleRequest |
| DB columns | snake_case | tenant_id, total_amount |
| Routes | kebab-case | /point-of-sale |

## Controllers — All Apps
- Thin only. Validate → Service → Response.
- Max 30 lines per method.
- Always Form Requests. Never inline validate.
- No business logic. Ever.

## Services — Core Services
- SaleService — sale lifecycle
- StockService — inventory
- PaymentService — payments (never bypass this)
- CartService — cart operations
- ReceiptService — receipts
- ReportService — analytics
- TenantService — tenant management (admin only)

## Database Rules — Every Migration
```php
$table->unsignedBigInteger('tenant_id'); // all data tables
$table->index('tenant_id');
$table->softDeletes();
$table->timestamps();
```

## Do Not
- ❌ Logic in controllers
- ❌ Copy code between apps (use packages/)
- ❌ Raw SQL anywhere
- ❌ Skip tenant_id on queries (web and mobile-api)
- ❌ Return raw models from API (always Resources)
- ❌ Payment logic outside PaymentService
- ❌ Stock logic outside StockService
- ❌ Install packages without asking
- ❌ Modify existing migrations
- ❌ Touch .env — use config() only

## Known Failure Modes
- ! You forget tenant_id on new queries
- ! You put logic in controllers instead of services
- ! You duplicate code between apps instead of packages/
- ! You return raw model from mobile-api instead of Resource
- ! You forget softDeletes on new migrations
- ! You work in the wrong app for the task

## Commands
```bash
cd apps/web && php artisan serve --port=8000
cd apps/mobile-api && php artisan serve --port=8001
cd apps/admin && php artisan serve --port=8002
bash scripts/test-all.sh
bash scripts/serve-all.sh
```

## How to Ask
- State which app you are working in FIRST
- Blocked? Ask ONE sharp question. Do not guess.
- Show plan before touching more than 2 files.
- "Done" = runs + tested + tenant-scoped + follows this file.
