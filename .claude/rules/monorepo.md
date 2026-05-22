# Monorepo Rules
Shared code lives in packages/. Never anywhere else.

packages/ui/     → Blade components only (no PHP logic)
packages/utils/  → PHP utilities only (no Blade)
packages/config/ → Shared config arrays and constants

Before adding code: "Will another app need this?"
Yes → packages/    No → in the app
