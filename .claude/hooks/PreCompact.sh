#!/bin/bash
TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')
mkdir -p tasks
echo "## Compact — $TIMESTAMP" >> tasks/session_state.md
echo "Resume from tasks/todo.md" >> tasks/session_state.md
echo "State saved. Safe to compact."
