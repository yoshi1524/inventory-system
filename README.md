# Countryside POS — Next.js

Full conversion of the PHP+MySQL POS system to Next.js 14 + TypeScript + MySQL.

## Stack
- **Next.js 14** (App Router)
- **NextAuth.js** — session auth (replaces PHP sessions)
- **mysql2** — MySQL queries (same database, no migration needed)
- **bcryptjs** — password hashing (compatible with PHP's password_hash)
- **TypeScript** throughout

## Project Structure
```
src/
  app/
    login/          → Login page
    admin/          → Admin dashboard (Reports, Menu, Inventory, Users, POS)
    manager/        → Manager dashboard (Menu, Inventory, Reports, POS)
    staff/          → Staff dashboard (POS only)
    api/
      auth/         → NextAuth login/logout
      menu/         → GET all items, POST add/update/archive/restock
      ingredients/  → GET all, POST add/restock
      orders/       → GET history, POST place order (atomic: saves + deducts stock)
      users/        → GET active users, POST create/archive
      reports/      → GET sales summary, branch breakdown, top items, transactions
      me/           → GET current session user info
  components/
    Sidebar.tsx       → Navigation sidebar with clock + logout
    Clock.tsx         → Live clock
    Toast.tsx         → Toast notifications (global singleton)
    POSView.tsx       → Full POS: menu grid + cart + checkout + receipt
    MenuManagement.tsx → Add/edit/archive menu items
    InventoryView.tsx  → Ingredient stock table + restock + add ingredient
    ReportsView.tsx    → Sales reports (admin sees all branches, manager sees own)
    UserManagement.tsx → Create/archive users
  lib/
    db.ts    → MySQL connection pool
    auth.ts  → NextAuth config
  types/
    index.ts → TypeScript interfaces for all entities
```

## Setup

### 1. Install dependencies
```bash
npm install
```

### 2. Configure environment
Edit `.env.local`:
```env
DB_HOST=localhost
DB_USER=root
DB_PASS=your_password
DB_NAME=resto_pos
NEXTAUTH_SECRET=generate-with-openssl-rand-base64-32
NEXTAUTH_URL=http://localhost:3000
```

### 3. Database
Use the **same `resto_pos` MySQL database** from your PHP project.
No migration needed — the schema is identical.
The app adds one requirement: users need `status = 'active'` to log in.

### 4. Copy logo
Put `cside.png` in the `public/` folder.

### 5. Run
```bash
npm run dev    # development: http://localhost:3000
npm run build  # production build
npm start      # run production build
```

## Default Login
- **Username:** admin
- **Password:** admin123

## What changed from PHP
| PHP | Next.js |
|-----|---------|
| `session_start()` + `$_SESSION` | NextAuth JWT sessions |
| `api.php` (single file, 30+ actions) | Separate `/api/*` route files |
| `adminscript.js` DOM manipulation | React components with useState |
| `admin.php` / `managerr.php` / `staff.php` | `/admin`, `/manager`, `/staff` pages |
| `config.php` DB functions | `src/lib/db.ts` connection pool |
| `rbac.php` role checks | NextAuth session callbacks + page `useEffect` guards |
| `password_verify()` | `bcrypt.compare()` — **compatible** with existing hashes |
| localStorage for cart | React `useState` — no persistence needed |
