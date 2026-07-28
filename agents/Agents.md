# Portfolio SaaS - AI Agent Instructions

## Mission

Build a User Activity Tracking System.

Priorities:

1. Clean Architecture
2. Maintainability
3. Readability
4. Simplicity
5. Testability
6. Performance

Never optimize prematurely.

---

## Tech Stack

PHP 8.5
MySQL
Redis
Docker
HTML, CSS, JS/JQuery

---

## General Principles

- SOLID
- KISS
- DRY
- Composition over inheritance
- Small classes
- Small methods
- Constructor injection
- Strict typing
- Value Objects where appropriate
- Immutable DTOs

---

## Never

- Duplicate code
- Use magic strings
- Create God classes
- Mix business logic into controllers
- Use static helper classes
- Skip validation

---

## Testing

Every service should be testable.

Feature tests for HTTP.

Unit tests for domain logic.

---

## Before Writing Code

Always:

- understand the feature
- inspect existing code
- reuse existing components
- keep consistency

Never invent new patterns if one already exists.

---

## When Finished

Verify:

- PHPStan passes
- Pint passes
- Tests pass
