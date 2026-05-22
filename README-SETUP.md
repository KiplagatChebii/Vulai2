# POS Monorepo — Complete Setup Guide
## Claude Code + Cursor IDE

---

## What Is a Monorepo?
One git repo containing three Laravel apps that share code via packages/.

```
pos-monorepo/
  apps/web/         ← POS cashier interface (port 8000)
  apps/mobile-api/  ← REST API for mobile app (port 8001)
  apps/admin/       ← Super-admin, manages all clients (port 8002)
  packages/ui/      ← Shared Blade components
  packages/utils/   ← Shared PHP traits and helpers
  packages/config/  ← Shared constants
  .claude/          ← Claude Code brain
  scripts/          ← Automation
  tasks/            ← Todo + lessons learned
```

### Why Monorepo for POS?
- One commit updates all three apps together
- Shared logic (e.g. currency, tenant scope) lives once in packages/
- Consistent conventions enforced everywhere
- One CI/CD pipeline
- Scale by adding new apps to apps/ — they instantly share packages/

---

## PART 1 — Install Claude Code

```bash
# Check Node (must be 18+)
node --version

# Install if needed
npm install -g n && n 18

# Install Claude Code
npm install -g @anthropic/claude-code

# Verify
claude --version

# Get API key from https://console.anthropic.com
# Then authenticate
claude
```

---

## PART 2 — Install and Configure Cursor

### Install
Download from https://cursor.sh — install and open.

### Open the Monorepo
```bash
cursor /path/to/pos-monorepo
# Or: File → Open Folder → select pos-monorepo/
```

### Install Extensions (Ctrl+Shift+X)
- PHP Intelephense (bmewburn.vscode-intelephense-client)
- Laravel Artisan (ryannaddy.laravel-artisan)
- Laravel Blade Snippets (onecentlin.laravel-blade)
- GitLens (eamodio.gitlens)
- DotENV (mikestead.dotenv)

The .vscode/settings.json and .cursorrules are already included.
Cursor reads .cursorrules automatically for AI context.

---

## PART 3 — Set Up Each Laravel App

### Step 1 — Install dependencies for each app
```bash
cd apps/web && composer install
cd ../mobile-api && composer install
cd ../admin && composer install
```

### Step 2 — Configure environment
```bash
# Web
cp apps/web/.env.example apps/web/.env
cd apps/web && php artisan key:generate

# Mobile API
cp apps/mobile-api/.env.example apps/mobile-api/.env
cd apps/mobile-api && php artisan key:generate

# Admin
cp apps/admin/.env.example apps/admin/.env
cd apps/admin && php artisan key:generate
```

### Step 3 — Configure database (all three apps share ONE DB)
Edit all three .env files:
```
DB_DATABASE=pos_system
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 4 — Create the database
```bash
mysql -u root -p -e "CREATE DATABASE pos_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### Step 5 — Run migrations (from web only — shared DB)
```bash
bash scripts/fresh.sh
# Or manually:
cd apps/web && php artisan migrate:fresh --seed
```

### Step 6 — Make scripts executable
```bash
chmod +x .claude/hooks/*.sh scripts/*.sh
```

---

## PART 4 — Run All Three Apps

### Option A — One command
```bash
bash scripts/serve-all.sh
```

### Option B — Three terminals in Cursor
```bash
# Terminal 1
cd apps/web && php artisan serve --port=8000

# Terminal 2
cd apps/mobile-api && php artisan serve --port=8001

# Terminal 3
cd apps/admin && php artisan serve --port=8002
```

### Access
| App | URL |
|---|---|
| POS Web | http://localhost:8000 |
| Mobile API | http://localhost:8001/api/v1/ |
| Admin | http://localhost:8002 |

---

## PART 5 — Start Claude Code

```bash
# Always start from monorepo root
cd pos-monorepo
claude

# On very first session — scan the project
/init
```

### Your Slash Commands
| Command | What it does |
|---|---|
| /init | First-run project scan |
| /ship web | Test + deploy web app |
| /ship api | Test + deploy mobile-api |
| /ship all | Test + deploy everything |
| /review web | Code review web app |
| /review api | Code review mobile-api |
| /feature web sale-void | Start a new feature |
| /migrate | Safe migration workflow |
| /test | Run all tests |
| /compact | Compress context (save tokens) |
| /clear | Wipe context for new task |

### Token Saving Tips
- Start each session: state which app you're working on
- Complex tasks: add "UltraThink" to your prompt
- Architecture decisions: use /model opus plan
- Context at 70%: run /compact immediately
- New unrelated task: run /clear

---

## PART 6 — Cursor + Claude Code Together

| Use Cursor AI for | Use Claude Code for |
|---|---|
| Quick questions | Full feature builds |
| Reading files | Multi-file changes |
| Short snippets | Running tests |
| Explaining code | /ship deploy workflow |

### Best Workflow
1. Open Cursor — browse the codebase
2. Open terminal in Cursor
3. Run `claude` from the monorepo root
4. Tell Claude which app: "Working on apps/web today."
5. Describe the task with UltraThink for complex features
6. Claude plans → you approve → Claude builds
7. /review → /ship

---

## PART 7 — Git Workflow

### Branches
```bash
git checkout -b feature/web-sale-void
git checkout -b fix/api-tenant-scope
git checkout -b chore/admin-pagination
```

### Commit Format
```
feat(web): add void sale feature
fix(api): add tenant_id scope on product query
chore(admin): update tenant list pagination
feat(packages): add HasAuditLog trait
```

### Before Merge
```
/test → /review web → /ship web
```

---

## PART 8 — Scaling the Monorepo

Add new apps as the business grows:
```
apps/
  web/              ← existing
  mobile-api/       ← existing
  admin/            ← existing
  kiosk/            ← self-service kiosk (future)
  reports-api/      ← dedicated analytics API (future)
```

Add new packages as shared code grows:
```
packages/
  ui/               ← existing
  utils/            ← existing
  config/           ← existing
  notifications/    ← shared notification system (future)
  pos-sdk/          ← third-party integration SDK (future)
```

Each new app follows the same pattern:
its own CLAUDE.md + connects to shared packages/.

---

## PART 9 — Global CLAUDE.md (Optional but Recommended)

Place GLOBAL-CLAUDE-TEMPLATE.md at ~/.claude/CLAUDE.md
This applies your universal Laravel rules to every project on your machine.
Edit it with your personal preferences then every new project benefits automatically.

```bash
mkdir -p ~/.claude
cp GLOBAL-CLAUDE-TEMPLATE.md ~/.claude/CLAUDE.md
```

---

## Quick Start Checklist

```
[ ] Node 18+ installed
[ ] npm install -g @anthropic/claude-code
[ ] Cursor installed, repo opened
[ ] Extensions installed
[ ] composer install in all three apps
[ ] .env configured for all three apps (same DB_DATABASE)
[ ] Database created: pos_system
[ ] bash scripts/fresh.sh (migrate + seed)
[ ] chmod +x .claude/hooks/*.sh scripts/*.sh
[ ] bash scripts/serve-all.sh
[ ] claude → /init
[ ] Start building!
```

---

## File Map

| File | Purpose |
|---|---|
| CLAUDE.md | Monorepo-wide rules — read every session |
| apps/web/CLAUDE.md | Web-specific overrides |
| apps/mobile-api/CLAUDE.md | API-specific overrides |
| apps/admin/CLAUDE.md | Admin-specific overrides |
| .cursorrules | Cursor AI context |
| .vscode/settings.json | Cursor editor settings |
| .claude/hooks/SessionStart.sh | Briefing every session |
| .claude/hooks/PostToolUse.sh | Safety checks after edits |
| .claude/commands/ship.md | /ship |
| .claude/commands/review.md | /review |
| .claude/commands/feature.md | /feature |
| .claude/skills/pos-core/ | Sale flow rules |
| .claude/skills/mobile-api/ | API response standards |
| .claude/agents/code-reviewer.md | Pre-delivery review |
| packages/utils/src/Traits/HasTenantScope.php | Auto tenant scoping |
| packages/utils/src/Traits/HasAuditLog.php | Auto audit logging |
| packages/utils/src/Helpers/Currency.php | Safe money handling |
| packages/utils/src/Helpers/ApiResponse.php | API response builder |
| packages/config/src/PosConstants.php | Shared constants |
| scripts/serve-all.sh | Start all three apps |
| scripts/test-all.sh | Run all tests |
| tasks/todo.md | Current task tracking |
| tasks/lessons.md | Accumulated Claude lessons |
| GLOBAL-CLAUDE-TEMPLATE.md | Copy to ~/.claude/CLAUDE.md |
