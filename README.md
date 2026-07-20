# IntelliTrack Fullstack Monorepo

A fullstack starter project containing:
- Frontend: React 19, React Router, TypeScript, Vite, Tailwind CSS 4
- Mobile: React Native + TypeScript
- Backend: Laravel + Native PHP REST API
- Database: PostgreSQL + Redis
- Auth: JWT, Laravel Sanctum, MFA-ready
- DevOps: Nx, Docker, GitHub Actions

## Structure
- frontend/
- mobile/
- backend/laravel/
- backend/php/

## Quick start (website focus)
1. Install dependencies: `npm install`
2. Create frontend env file: `cp frontend/.env.example frontend/.env`
3. Start Docker environment: `docker compose up --build`
4. Run frontend: `cd frontend && npm run dev`
5. Open the website at `http://localhost:5173`

## Authentication
- Login and registration are implemented in the React frontend
- The backend provides Laravel Sanctum / JWT-style token authentication
- Multi-factor authentication can be verified using the `/auth/mfa/verify` endpoint

## Backend setup
- Laravel backend stub lives in `backend/laravel`
- Run migrations with `php artisan migrate` after installing dependencies and creating `.env`

