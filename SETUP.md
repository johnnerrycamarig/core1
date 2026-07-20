# IntelliTrack — Complete Setup Guide

Comprehensive instructions for setting up, deploying, and maintaining the IntelliTrack platform.

---

## Table of Contents
1. [Prerequisites](#prerequisites)
2. [Local Development](#local-development)
3. [Docker Setup](#docker-setup)
4. [Production Deployment](#production-deployment)
5. [Environment Configuration](#environment-configuration)
6. [Database & Migrations](#database--migrations)
7. [Testing & CI/CD](#testing--cicd)
8. [Troubleshooting](#troubleshooting)

---

## Prerequisites

### Minimum Requirements
| Component | Version | Purpose |
|-----------|---------|---------|
| Node.js | 18+ | Frontend & Mobile |
| npm/pnpm | Latest | Package management |
| PHP | 8.1+ | Laravel backend |
| Composer | 2.0+ | PHP dependencies |
| PostgreSQL | 14+ | Primary database |
| Redis | 6.0+ | Caching & sessions |

### Installation Links
- **Node.js:** https://nodejs.org (includes npm)
- **PHP:** https://www.php.net/downloads
- **Composer:** https://getcomposer.org/download/
- **PostgreSQL:** https://www.postgresql.org/download/
- **Redis:** https://redis.io/download (or Docker)

### Optional for Containerization
- **Docker:** https://www.docker.com/products/docker-desktop
- **Docker Compose:** Included with Docker Desktop

---

## Local Development

### Quick Start (5 minutes)
```bash
# 1. Clone the repository
git clone <repo-url>
cd core1

# 2. Start backend (Terminal 1)
cd backend/laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve --host=0.0.0.0 --port=8000

# 3. Start frontend (Terminal 2)
cd frontend
npm install
cp .env.example .env
npm run dev
# Open http://localhost:5173
```

### Full Development Stack

#### Backend Setup
```bash
cd backend/laravel

# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Create database and run migrations
php artisan migrate

# (Optional) Seed sample data
php artisan db:seed

# Start development server
php artisan serve --host=0.0.0.0 --port=8000
```

**Expected Output:**
```
Starting Laravel development server: http://0.0.0.0:8000
```

#### Frontend Setup
```bash
cd frontend

# Install Node dependencies
npm install

# Copy environment file
cp .env.example .env

# (Optional) Update API URL in .env if backend is on different host
# VITE_API_BASE_URL=http://localhost:8000/api

# Start Vite dev server
npm run dev
```

**Expected Output:**
```
  VITE v5.0.0  ready in 500 ms

  ➜  Local:   http://localhost:5173/
  ➜  press h to show help
```

#### Mobile Setup (Optional)
```bash
cd mobile

npm install

# For iOS (macOS only)
npm run ios

# For Android (requires Android Studio/SDK)
npm run android

# Or run in Expo Developer App
npx expo start
```

---

## Docker Setup

### With Docker Compose (Recommended)
```bash
# From repository root
docker compose up --build

# In another terminal, run migrations
docker compose exec app php artisan migrate
```

**Compose Services:**
- `app` (Laravel) — http://localhost:8000
- `frontend` (React) — http://localhost:3000
- `postgres` (DB) — localhost:5432
- `redis` (Cache) — localhost:6379

### Custom Docker Image
```bash
# Build image
docker build -t intellitrack:latest -f backend/laravel/Dockerfile backend/laravel

# Run container
docker run -p 8000:8000 \
  -e DB_HOST=postgres \
  -e REDIS_HOST=redis \
  intellitrack:latest
```

---

## Production Deployment

### Pre-Production Checklist
- [ ] Update `.env` with production database URL
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_ENV=production`
- [ ] Generate new `APP_KEY`: `php artisan key:generate`
- [ ] Configure `SANCTUM_STATEFUL_DOMAINS` for your domain
- [ ] Set up SSL certificate (via Certbot or provider)
- [ ] Configure environment secrets in CI/CD pipeline

### Deploy to AWS
```bash
# 1. Create RDS PostgreSQL instance
# 2. Create ElastiCache Redis cluster
# 3. Push Docker image to ECR
aws ecr get-login-password --region us-east-1 | docker login --username AWS --password-stdin <account-id>.dkr.ecr.us-east-1.amazonaws.com
docker tag intellitrack:latest <account-id>.dkr.ecr.us-east-1.amazonaws.com/intellitrack:latest
docker push <account-id>.dkr.ecr.us-east-1.amazonaws.com/intellitrack:latest

# 4. Deploy with ECS/EKS
# 5. Update load balancer
# 6. Run migrations on new database
```

### Deploy to DigitalOcean
```bash
# 1. Create Droplet (Ubuntu 22.04, 4GB+ RAM)
# 2. SSH into droplet
ssh root@<ip>

# 3. Install dependencies
apt update && apt install -y curl apt-transport-https ca-certificates git docker.io docker-compose
usermod -aG docker $USER

# 4. Clone repo & configure
git clone <repo-url>
cd core1
cp backend/laravel/.env.example backend/laravel/.env
# Edit .env with production values

# 5. Start services
docker compose -f docker-compose.yml up -d --build

# 6. Setup Nginx reverse proxy
# Configure SSL with Certbot
sudo apt install certbot python3-certbot-nginx
sudo certbot certonly --standalone -d yourdomai.com

# 7. Configure Nginx to forward to Docker containers
# See nginx.conf below
```

### Nginx Configuration (Reverse Proxy)
```nginx
upstream laravel {
    server app:8000;
}

upstream react {
    server frontend:3000;
}

server {
    listen 443 ssl http2;
    server_name intellitrack.example.com;

    ssl_certificate /etc/letsencrypt/live/intellitrack.example.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/intellitrack.example.com/privkey.pem;

    # API routes
    location /api {
        proxy_pass http://laravel;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }

    # Frontend
    location / {
        proxy_pass http://react;
        proxy_set_header Host $host;
        proxy_ws_connect_timeout 7d;
        proxy_ws_read_timeout 7d;
        proxy_ws_send_timeout 7d;
    }

    # Redirect HTTP to HTTPS
}

server {
    listen 80;
    server_name intellitrack.example.com;
    return 301 https://$server_name$request_uri;
}
```

---

## Environment Configuration

### Frontend (`.env`)
```env
# API Base URL
VITE_API_BASE_URL=http://localhost:8000/api

# (Optional) Analytics, Sentry, etc.
VITE_SENTRY_DSN=https://your-sentry-project@sentry.io/xxx
```

### Backend Laravel (`.env`)
```env
APP_NAME=IntelliTrack
APP_ENV=production
APP_DEBUG=false
APP_URL=https://intellitrack.example.com

# Database
DB_CONNECTION=pgsql
DB_HOST=db.example.com
DB_PORT=5432
DB_DATABASE=intellitrack
DB_USERNAME=intellitrack_user
DB_PASSWORD=secure_password_here

# Redis
REDIS_HOST=redis.example.com
REDIS_PASSWORD=redis_password
REDIS_PORT=6379

# Auth
SANCTUM_STATEFUL_DOMAINS=intellitrack.example.com
SESSION_DOMAIN=.intellitrack.example.com
SANCTUM_GUARD=web

# Mail (optional)
MAIL_DRIVER=smtp
MAIL_HOST=mail.example.com
MAIL_PORT=587
MAIL_USERNAME=noreply@example.com
MAIL_PASSWORD=email_password
MAIL_FROM_ADDRESS=noreply@example.com
```

---

## Database & Migrations

### Running Migrations
```bash
# Apply all pending migrations
php artisan migrate

# Rollback last migration batch
php artisan migrate:rollback

# Rollback all migrations
php artisan migrate:reset

# Refresh all migrations (drops + recreates)
php artisan migrate:refresh

# Seed sample data
php artisan db:seed
```

### Creating New Migrations
```bash
# Create migration file
php artisan make:migration create_my_table

# Edit file in database/migrations/
# Run migration
php artisan migrate
```

### Backup & Restore
```bash
# Backup database
pg_dump -U intellitrack_user -h db.example.com intellitrack > backup.sql

# Restore database
psql -U intellitrack_user -h db.example.com intellitrack < backup.sql
```

---

## Testing & CI/CD

### Frontend Tests
```bash
cd frontend

# Run tests once
npm run test -- --run

# Watch mode
npm run test

# Interactive UI
npm run test:ui

# Coverage report
npm run test:coverage
```

### Backend Tests
```bash
cd backend/laravel

# Run all tests
php artisan test

# Run specific test file
php artisan test --filter=ClientControllerTest

# With coverage
php artisan test --coverage
```

### GitHub Actions CI/CD
The repository includes `.github/workflows/ci.yml` which:
- ✅ Runs frontend TypeScript checks & builds
- ✅ Runs mobile TypeScript checks
- ✅ Installs Laravel dependencies
- ✅ Runs database migrations
- ✅ Runs backend tests
- ✅ Uploads build artifacts

Configure secrets in GitHub:
1. Go to Settings → Secrets and variables → Actions
2. Add required secrets (if using external services):
   - `TEST_DATABASE_URL` (for CI tests)
   - `DOCKER_REGISTRY_TOKEN` (for image builds)

---

## Troubleshooting

### Common Issues

#### 1. npm Install Fails
**Error:** `npm ERR! code ENOENT`
```bash
# Solution: Clear cache and try again
npm cache clean --force
rm -rf node_modules package-lock.json
npm install
```

#### 2. Composer Install Fails
**Error:** `Your requirements could not be resolved`
```bash
# Solution: Update Composer
composer self-update
composer install --no-interaction
```

#### 3. Database Connection Error
**Error:** `SQLSTATE[08006] could not connect to server`
```bash
# Solution: Check PostgreSQL is running
sudo systemctl status postgresql

# Or with Docker
docker-compose up db -d
```

#### 4. Port Already in Use
```bash
# Find process using port 8000
lsof -i :8000

# Kill process
kill -9 <PID>

# Or use different port
php artisan serve --port=9000
```

#### 5. CORS Errors in Frontend
**Error:** `Access to XMLHttpRequest has been blocked by CORS`
```bash
# Solution: Update Laravel .env
SANCTUM_STATEFUL_DOMAINS=localhost:5173,127.0.0.1:5173
```

#### 6. "Cannot find module" React Errors
```bash
# Solution: Re-install dependencies
cd frontend
rm -rf node_modules package-lock.json
npm install
```

### Getting Help
- Check logs: `docker compose logs app`
- Run tests: `npm run test` or `php artisan test`
- Reset environment: `php artisan migrate:reset && php artisan migrate`

---

## Additional Resources

- **Laravel Docs:** https://laravel.com/docs
- **React Docs:** https://react.dev
- **Tailwind CSS:** https://tailwindcss.com
- **Vite:** https://vitejs.dev
- **PostgreSQL:** https://www.postgresql.org/docs/
- **Docker:** https://docs.docker.com

---

**Last Updated:** July 21, 2026  
**Maintainer:** IntelliTrack Team
