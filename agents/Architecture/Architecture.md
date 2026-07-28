# Architecture

## Architecture Overview

This project follows the MVC pattern with a Service-oriented architecture.

The goal is to keep business logic isolated from HTTP, persistence, and infrastructure concerns.

```
HTTP Request
    ↓
Middleware
    ↓
Request Validation
    ↓
Controller
    ↓
DTO
    ↓
Service
    ↓
Manager
    ↓
Database / Cache
```

---

# Layers

## Middleware

Middleware executes before the request reaches the controller.

Responsibilities:

* Authentication
* Authorization
* Rate limiting
* Locale detection
* Request preprocessing
* Other cross-cutting concerns

Middleware must never contain business logic.

---

## Controllers

Controllers are responsible only for coordinating the request.

Think of a controller as a traffic controller—it receives a request and forwards it to the appropriate service.

Responsibilities:

* Receive validated requests
* Create DTOs
* Call Services
* Return HTTP responses

Controllers must never:

* Contain business logic
* Perform database queries
* Communicate directly with the cache
* Contain complex calculations

Flow:

```
Request
    ↓
Controller
    ↓
DTO
    ↓
Service
```

---

## DTOs (Data Transfer Objects)

DTOs are used to transfer structured data between Controllers and Services.

Responsibilities:

* Strong typing
* Immutable data
* Clear contracts between layers

DTOs should not contain business logic.

---

## Services

Services contain all business logic.

Each service represents a business domain and is responsible for answering **why** and **how** a business process works.

Examples:

* SubscriptionService
* ExperienceService
* UserService

Services may:

* Validate business rules
* Calculate values
* Coordinate multiple Managers
* Trigger events
* Call external integrations when part of the business process

Services must never perform persistence directly.

Instead, Services delegate persistence to Managers.

Example:

```
Controller
    ↓
SubscriptionService
        ↓
SubscriptionManager
            ↓
Database
```

Each business domain should have its own directory.

Example:

```
Services/
    Subscription/
        DTO/
        Contracts/
        Enums/
        Exceptions/
        Mappers/
        SubscriptionService.php
```

Additional classes such as Value Objects, Policies, Specifications, or Helpers may be added when they naturally belong to the domain.

---

## Managers

Managers are responsible for persistence and infrastructure operations.

Their responsibility is **how data is stored**, not **why it is stored**.

Responsibilities:

* Insert records
* Update records
* Delete records
* Bulk operations
* Cache operations
* Database transactions
* Exception handling
* Query optimization
* Safe persistence

Managers may interact with:

* Database
* Redis
* Cache
* Filesystem
* Search indexes

Managers must never contain business rules.

Example:

```
SubscriptionService

Checks:

✔ User exists

✔ User is active

✔ Selected plan exists

✔ Payment succeeded

✔ User is not already subscribed

↓

SubscriptionManager

Stores:

- subscription
- payment record
- cache updates
```

---

# General Principles

* Keep Controllers thin.
* Keep Services focused on business logic.
* Keep Managers focused on persistence.
* Use dependency injection.
* Prefer composition to inheritance.
* Use constructor injection.
* Use strict typing.
* Keep methods small and focused.
* One class should have one clear responsibility.
* Avoid duplicated logic.
* Never bypass the defined application flow.

---

# Standard Request Flow

```
HTTP Request
    ↓
Middleware
    ↓
Request Validation
    ↓
Controller
    ↓
DTO
    ↓
Service
    ↓
Manager
    ↓
Database / Cache
    ↓
Service
    ↓
Controller
    ↓
HTTP Response
```
