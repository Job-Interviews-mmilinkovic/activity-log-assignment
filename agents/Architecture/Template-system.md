# Template System Architecture

## Purpose

The Template System is responsible for transforming static HTML/CSS/JavaScript portfolio templates into dynamic Laravel Blade portfolio websites.

The main goal is to allow adding new portfolio designs quickly without changing application logic.

A new Template should only require:

* HTML conversion
* CSS/JS/assets integration
* Blade component implementation

Business logic, database structure, and user data must remain unchanged.

---

# Template Workflow

The lifecycle of every Template:

```
HTML Template
      ↓
Blade Conversion
      ↓
Blade Components
      ↓
Template Registration
      ↓
Available For Users
```

---

# Static Templates Directory

During Template conversion, original HTML templates are stored inside:

```
resources/templates/
```

Example:

```
resources/templates/

    modern-portfolio/
        index.html
        about.html
        css/
        js/
        images/
        fonts/
        scss/

    creative-portfolio/
        index.html
        css/
        js/
```

This directory is temporary.

After the Template has been fully converted into Blade components, the original static template can be removed.

The final application should not depend on this directory.

---

# Template Structure

Every converted Template has its own directory.

Example:

```
resources/views/templates/

    modern-portfolio/

        layouts/
            app.blade.php

        sections/
            home.blade.php
            about.blade.php
            skills.blade.php
            services.blade.php
            portfolio.blade.php
            resume.blade.php
            blog.blade.php
            contact.blade.php
```

Each Template owns only presentation.

---

# Default Portfolio Sections

Every portfolio Template should support the following sections:

## Home

Purpose:

Main introduction section.

Contains:

* Follow the template design.

---

## About

Purpose:

Professional summary.

Contains:

* Follow the template design.

---

## Skills

Purpose:

Display user capabilities.

Contains:

* Skill categories
* Technologies
* Experience level (optional)

---

## Services

Purpose:

Show offered services.

Mostly useful for freelancers.

Contains:

* Service title
* Description
* Icon/image

---

## Portfolio

Purpose:

Display projects.

Contains:

* Project title
* Description
* Images
* Technologies
* Links

---

## Resume

Purpose:

Professional history.

Contains:

* Work experience
* Education
* Certifications

---

## Blog

Purpose:

Long-form content.

Contains:

* Articles
* Categories
* Metadata

Optional section.

---

## Contact

Purpose:

Allow visitors to contact the user.

Contains:

* Contact information
* Social links
* Contact form

---

# Section Visibility

Users control which sections appear on their portfolio.

Example:

User settings:

```
Home        visible
About       visible
Skills      visible
Services    hidden
Portfolio   visible
Resume      visible
Blog        hidden
Contact     visible
```

The rendering system checks section visibility before displaying components.

Example:

```php
@if($portfolio->isSectionVisible('skills'))
    <x-Template.sections.skills />
@endif
```

---

# Blade Component Strategy

Each section should become a reusable Blade component.

Example:

```
resources/views/components/

    portfolio/

        home.blade.php
        about.blade.php
        skills.blade.php
        projects.blade.php
```

Templates provide their own visual implementation.

Application provides the data.

---

# Data Flow

```
Database
    ↓
Portfolio Models
    ↓
Portfolio DTO
    ↓
Template Renderer
    ↓
Blade Components
    ↓
HTML Output
```

Templates must never:

* Query database
* Call services
* Modify business data
* Contain business rules

---

# Template Requirements

Every Template must:

* Be responsive
* Support all default sections
* Support section visibility
* Use application data
* Work without JavaScript dependency when possible
* Have isolated assets

---

# Template Assets

Every Template should have its own assets:

```
public/template-name/
    assets/
        css/
        js/
        images/
        fonts/
```

Assets should not conflict between Templates.
Public directory is only directory that can be publicly accessed, so we need to set static frontend stuff there.

---

# Future Template Marketplace

The architecture should allow future support for:

* Premium Templates
* Template marketplace
* User Template switching
* Template customization
* Template previews
* Template packages

```
```
