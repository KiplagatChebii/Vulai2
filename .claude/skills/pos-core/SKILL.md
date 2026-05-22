# POS Core Skill
Loads when: sales, cart, checkout, payments, stock, receipts

## Sale Flow — Never Break This Order
1. Validate cart (CartService)
2. Check stock (StockService)
3. Process payment (PaymentService)
4. ONLY after confirmed payment → deduct stock (StockService)
5. Create sale record (SaleService)
6. Generate receipt (ReceiptService)

## Service Boundaries
- CartService: add/remove/discount/totals
- PaymentService: process only, never touches stock
- StockService: deduct/restock/alerts, never processes payments
- SaleService: sale CRUD, voids, refunds
- ReceiptService: HTML/PDF/thermal output

## Rules
- Never deduct stock before payment confirmed
- Voided sales → softDelete only
- Refunds → new negative sale record, never modify original
- Every sale must have tenant_id
