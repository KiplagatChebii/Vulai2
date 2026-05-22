#!/bin/bash
echo "=== PostToolUse Safety Check ==="
if find apps/*/app/Http/Controllers -name "*.php" -exec grep -l "DB::" {} \; 2>/dev/null | grep -q .; then
  echo "BLOCKED: Raw DB:: query found in Controller. Move to Service."
  exit 1
fi
if find apps/mobile-api/app/Http/Controllers -name "*.php" 2>/dev/null | xargs grep -l "return \$" 2>/dev/null | grep -q .; then
  echo "WARNING: mobile-api controller may return raw model. Use Resource classes."
fi
touch /tmp/.claude_pos_check
echo "=== Check Complete ==="
