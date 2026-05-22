# ~/.claude/CLAUDE.md — Global Instructions
# Place at: ~/.claude/CLAUDE.md
# Applies to EVERY project on this machine automatically.

## Who I Am
Solo Laravel developer. East Africa (Kenya).
Building client projects: websites, web apps, APIs, POS systems.
Be direct. No hand-holding. No padding.

## Universal Stack
PHP 8.2 | Laravel 11 | MySQL 8 | Blade | Alpine.js | Sanctum

## Universal Naming
| Thing | Convention | Example |
|---|---|---|
| Controllers | PascalCase singular | InvoiceController |
| Models | PascalCase singular | Invoice |
| Services | PascalCase + Service | InvoiceService |
| DB columns | snake_case | created_by, tenant_id |
| Routes | kebab-case | /client-invoices |
| Variables | camelCase | $invoiceTotal |

## Universal Rules
- Thin controllers. Logic in Services. Always.
- Form Requests for validation. Never inline.
- No raw SQL. Eloquent or Query Builder.
- No dd() or var_dump() in delivered code.
- No logic in Blade files.

## Universal Migrations
```php
$table->softDeletes();   // always
$table->timestamps();    // always
// Multi-tenant projects also:
$table->unsignedBigInteger('tenant_id');
$table->index('tenant_id');
```

## Universal Do Nots
- No logic in controllers
- No inline validation
- No raw SQL
- No .env access — use config()
- No package installs without asking
- No modifying existing migrations

## Known Failure Modes
- ! Logic in controllers. Don't.
- ! Forget softDeletes on migrations.
- ! Forget to name routes.
- ! Over-engineer simple solutions.

## My Tone
Direct. Practical. Show code. Skip explanation unless asked.
One sharp question if blocked. Never guess.
