# Activity Log Tracker

User activity tracking web app built with a custom PHP framework (FastRoute, Relay PSR-15, Eloquent standalone).

## Quick Start

### 1. Build & start containers

```bash
docker compose up -d --build
```

### 2. Install dependencies

```bash
docker exec activity-log-app composer install
```

### 3. Run migrations

```bash
docker exec activity-log-app php bin/migrate up
```

### 4. Seed the database

```bash
docker exec activity-log-app php bin/seed
```

### 5. Access the app

Open [http://localhost:8080](http://localhost:8080) in your browser.

## Default Users

| Email                     | Password      | Role  |
|---------------------------|---------------|-------|
| super.admin@yopmail.com   | super.admin   | Admin |
| pera@yopmail.com          | pera1234      | User  |

## Useful Commands

```bash
# Run all migrations
php bin/migrate up

# Rollback all migrations
php bin/migrate down

# Refresh (rollback + migrate)
php bin/migrate refresh

# Run seeders
php bin/seed
```

## Docker

```bash
# Start services
docker compose up -d

# Stop services
docker compose down

# View logs
docker compose logs -f

# Execute commands inside the container
docker exec activity-log-app php bin/migrate up
docker exec activity-log-app php bin/seed
```
