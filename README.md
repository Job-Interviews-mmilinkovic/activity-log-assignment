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

## Future Improvements

### Redis queue for log writes
Instead of writing `activity_log` rows directly to MySQL on every request, events could publish to a Redis list. A cron job (running every minute/hour) would flush buffered logs to the database in batches. This reduces MySQL write pressure under high load.

### NoSQL for activity logs
Activity logs have no fixed schema — different actions carry different metadata (page path, browser, IP, duration, etc.). A document store like MongoDB would be a better fit than a relational table, allowing each log entry to have its own structure without migrations.

### REST API + frontend
The current app is server-rendered HTML. Extracting a JSON REST API and building a separate frontend (React / Vue) would decouple presentation from logic and make the app easier to extend.

### Queue workers per event type
Each event listener could publish to a dedicated queue (Beanstalkd / RabbitMQ). This allows independent horizontal scaling — high-volume events (page views) can have more workers without competing with low-volume events (registrations).

### CSRF protection
Forms currently have no CSRF tokens. Adding middleware that validates a per-session token on every POST would prevent cross-site request forgery.
