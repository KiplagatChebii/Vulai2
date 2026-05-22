#!/bin/bash
echo ""
echo "============================================="
echo "  POS MONOREPO — SESSION BRIEFING"
echo "============================================="
echo "  apps/web/         → POS Web     (port 8000)"
echo "  apps/mobile-api/  → Mobile API  (port 8001)"
echo "  apps/admin/       → Admin       (port 8002)"
echo ""
echo "CRITICAL RULES:"
echo "  1. State which app FIRST before any task"
echo "  2. tenant_id — scope EVERY query in web/ and mobile-api/"
echo "  3. Shared code → packages/ only"
echo "  4. Payments → PaymentService ONLY"
echo "  5. Stock    → StockService ONLY"
echo "  6. API responses → always Resource classes"
echo "  7. Controllers → thin. Logic in Services."
echo "============================================="
if [ -f "tasks/lessons.md" ]; then
  echo "LESSONS FROM PREVIOUS SESSIONS:"
  cat tasks/lessons.md
  echo "============================================="
fi
echo ""
