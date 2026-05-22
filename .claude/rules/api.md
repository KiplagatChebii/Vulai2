# API Rules — loads for apps/mobile-api/** only
- Every route: auth:sanctum middleware
- All responses: Resource classes
- Format: {data, message, status, meta}
- Lists: ->paginate(20)
- Routes: /api/v1/ prefix
- Eager loading to prevent N+1
- Form Requests — never inline validate
- Empty lists return [] not null
- Currency as integer cents
