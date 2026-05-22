#!/bin/bash
BASE=$(dirname "$(dirname "$0")")
echo "WARNING: This wipes the database."
read -p "Type 'yes' to continue: " C
[ "$C" != "yes" ] && echo "Cancelled." && exit 0
echo "Running fresh migrate + seed from apps/web..."
cd "$BASE/apps/web" && php artisan migrate:fresh --seed
[ $? -eq 0 ] && echo "✅ Database ready." || echo "❌ Failed. Check DB connection."
