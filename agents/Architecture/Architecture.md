# Architecture

## Architecture Overview

This project follows a layered architecture with middleware and controllers.

The goal is to keep HTTP, business logic, and persistence concerns separated.

```
HTTP Request
    ↓
Middleware (PSR-15)
    ↓
Router (FastRoute)
    ↓
Controller
    ↓
Response
```

---

# Layers

## Middleware

Middleware executes before the request reaches the controller.

Responsibilities:

* Authentication
* Authorization
* Request preprocessing
* Other cross-cutting concerns

Middleware must never contain business logic.

---

## Router

Routes are defined in `routes/web.php` using FastRoute.

The Router class (`bootstrap/Router.php`) loads the route file and dispatches requests to controllers.

---

## Controllers

Controllers receive the request and return a PSR-7 response.

Responsibilities:

* Receive requests
* Call services / auth
* Return HTTP responses

Controllers must never contain raw database queries.

---

# General Principles

* Keep Controllers thin.
* Use strict typing.
* Keep methods small and focused.
* One class should have one clear responsibility.
* Avoid duplicated logic.

---

# Standard Request Flow

```
HTTP Request
    ↓
Session Start
    ↓
Middleware (Auth check)
    ↓
Router
    ↓
Controller
    ↓
Response
```

---

# Tech Stack

| Component | Library |
|---|---|
| PHP | 8.3+ |
| Database ORM | illuminate/database (Eloquent standalone) |
| Routing | nikic/fast-route |
| PSR-7/15 | laminas-diactoros, relay/relay |
| Auth | phpauth/phpauth |
| Debugging | symfony/var-dumper |
