# Activity Log Tracker — Roadmap

## Product Vision

A simple web application that tracks user activity events (login, logout, page views, button clicks) and provides administrators with statistics and reports.

---

## Phase 1 — Foundation

Goal: Set up authentication and the core database structure.

Features:
- User registration, login, logout
- Session-based auth
- Activity events table (user, action, timestamp, metadata)
- Database migrations for users and events
- Basic routing system

Done when: A user can register, log in, and log out; every auth action is recorded as an event.

---

## Phase 2 — Core Pages

Goal: Build the two main user-facing pages and wire up activity tracking.

Features:
- Page A with "Buy a cow" button (click hides button, shows "thank you")
- Page B with "Download" button (triggers .exe download)
- Track `view-page` and `button-click` events

Done when: Anonymous and authenticated page views and button clicks are all logged.

---

## Phase 3 — Admin Statistics

Goal: Give admins a filterable table of all activity events.

Features:
- Admin-only /stats page
- Table with columns: date, user, action
- Date range filter
- User filter
- Action type filter (login, logout, registration, view-page, button-click)

Done when: An admin can filter events by any combination of date, user, and action.

---

## Phase 4 — Reports

Goal: Provide aggregated reports with graphs and summary tables.

Features:
- Admin-only /reports page
- Line graph: dates on X-axis, event counts on Y-axis (page view A, page view B, click "Buy a cow", click "Download")
- Summary table: date, count per event type
- Date range selector

Done when: An admin can view trends and daily counts for the four tracked actions.

---

## Phase 5 — Polish & Hardening

Goal: Handle edge cases, improve UX, and prepare for production use.

Features:
- Input validation and error handling
- Rate limiting on auth endpoints
- Proper .exe download file delivery
- Responsive layout for all pages
- README with setup instructions
- Seed data for development

Done when: The app can be set up from scratch and used without errors.
