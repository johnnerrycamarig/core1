# IntelliTrack — Quick Start Guide

Get the fullstack dashboard running in 5 minutes.

## Option 1: Static Preview (Instant, No Setup)
```bash
# Open this file in your browser:
frontend/preview.html
```
Shows a mockup of the dashboard without running any backend.

---

## Option 2: Frontend Only (2 minutes)
**Requires:** Node.js + npm (https://nodejs.org)

```bash
cd frontend
npm install
npm run dev
```
Then open http://localhost:5173

**Note:** Metrics and job orders will show "Loading…" because the backend isn't running.

---

## Option 3: Full Stack (5 minutes)
**Requires:** Node.js, PHP 8.1+, Composer (https://getcomposer.org)

### Terminal 1: Start Backend
```bash
cd backend/laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve --host=0.0.0.0 --port=8000
```

### Terminal 2: Start Frontend
```bash
cd frontend
npm install
cp .env.example .env
npm run dev
```

Open http://localhost:5173 — you'll see the full dashboard with live data from the API.

---

## Option 4: Docker Compose (Recommended for Complex Setup)
**Requires:** Docker & Docker Compose

```bash
docker compose up --build
```

- **Frontend:** http://localhost:3000
- **API:** http://localhost:8000
- **Database:** PostgreSQL (internal)
- **Cache:** Redis (internal)

---

## Testing

```bash
cd frontend
npm install
npm run test           # Run vitest
npm run test:ui        # Interactive UI
npm run test:coverage  # Coverage report
```

---

## Next Steps

- **Add a new page:** Create component in `frontend/src/pages/MyPage.tsx`, add route in `frontend/src/App.tsx`
- **Add API endpoint:** Create controller in `backend/laravel/app/Http/Controllers/Api/`, add route in `backend/laravel/routes/api.php`
- **Customize styling:** Edit Tailwind CSS classes in React components or `frontend/tailwind.config.ts`
- **Environment config:** Update `.env` files (API URL, Database, etc.)

---

## Troubleshooting

| Problem | Solution |
|---------|----------|
| `npm: command not found` | Install Node.js: https://nodejs.org (v18+) |
| `composer: command not found` | Install Composer: https://getcomposer.org |
| Port 8000 already in use | Run `php artisan serve --port=9000` instead |
| Port 5173 already in use | Run `npm run dev -- --port=5174` instead |
| Database connection error | Ensure PostgreSQL is running or use Docker: `docker compose up db` |

---

See [README.md](README.md) for full documentation.
