# Admin Skill
Loads when: apps/admin/

## Critical
Admin sees ALL tenants. It is NOT tenant-scoped.
web/ and mobile-api/ = always tenant-scoped
admin/ = never tenant-scoped

## Rules
- Separate admin middleware — never auth:sanctum
- Admin users in admins table — never users table
- Log ALL admin actions to admin_audit_logs
- Confirm destructive actions before executing
