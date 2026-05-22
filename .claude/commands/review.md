# /review — Code review before delivery
## Usage: /review web | /review api | /review admin

### Blockers (must fix)
- [ ] tenant_id scoped on all queries (web + mobile-api)
- [ ] No DB:: in controllers
- [ ] No logic in controllers
- [ ] Payment logic only in PaymentService
- [ ] API returns Resource classes only
- [ ] No code duplicated across apps

### Warnings (should fix)
- [ ] Methods under 30 lines
- [ ] No dd() / var_dump()
- [ ] Naming follows CLAUDE.md
- [ ] softDeletes on new migrations
- [ ] Routes named and versioned

## Output Per Issue
FILE: apps/web/app/Http/Controllers/Web/SaleController.php
LINE: 34 | SEVERITY: Blocker | ISSUE: ... | FIX: ...

Final: Blockers: X | Warnings: X | PASS / FAIL
