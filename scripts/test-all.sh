#!/bin/bash
BASE=$(dirname "$(dirname "$0")")
echo "====== POS MONOREPO TESTS ======"
PASS=0; FAIL=0

run_tests() {
  echo "--- Testing $1 ---"
  cd "$2" && php artisan test --quiet
  if [ $? -eq 0 ]; then echo "✅ $1: PASSED"; PASS=$((PASS+1))
  else echo "❌ $1: FAILED"; FAIL=$((FAIL+1)); fi
  cd - > /dev/null
}

run_tests "Web" "$BASE/apps/web"
run_tests "Mobile API" "$BASE/apps/mobile-api"
run_tests "Admin" "$BASE/apps/admin"
echo "====== Results: ✅ $PASS passed | ❌ $FAIL failed ======"
[ $FAIL -gt 0 ] && exit 1 || exit 0
