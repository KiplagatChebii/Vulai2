#!/bin/bash
BASE=$(dirname "$(dirname "$0")")
echo "Starting POS Monorepo..."
echo "  Web:        http://localhost:8000"
echo "  Mobile API: http://localhost:8001"
echo "  Admin:      http://localhost:8002"
echo "Press Ctrl+C to stop all."
pkill -f "artisan serve" 2>/dev/null
cd "$BASE/apps/web" && php artisan serve --port=8000 --quiet &
WEB=$!
cd "$BASE/apps/mobile-api" && php artisan serve --port=8001 --quiet &
API=$!
cd "$BASE/apps/admin" && php artisan serve --port=8002 --quiet &
ADM=$!
echo "All apps started."
trap "kill $WEB $API $ADM 2>/dev/null; echo 'Stopped.'; exit 0" INT
wait
