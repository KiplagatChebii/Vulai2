# Mobile API Skill
Loads when: apps/mobile-api/ or API endpoints

## Response Format
```json
{ "data": {}, "message": "Success", "status": 200, "meta": {} }
```

## Rules
- All routes: auth:sanctum middleware
- All responses: Resource classes only
- All lists: paginate(20)
- Routes: /api/v1/ prefix
- Max response: 50KB
- Eager load all relationships
- Currency as integer cents
- Dates in ISO 8601
