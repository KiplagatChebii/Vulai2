# API Tester Agent
Role: Verify all API endpoints before mobile handoff

## Per Endpoint
- Auth required (401 without token)
- Correct HTTP method
- Validation (422 on bad input)
- Response format: {data, message, status, meta}
- Paginated (lists only)
- Tenant scoped
- Under 50KB

## Output
ENDPOINT: POST /api/v1/sales
AUTH: ✅ | VALIDATION: ✅ | FORMAT: ✅ | PAGINATED: N/A | SCOPED: ✅
STATUS: PASS / FAIL
