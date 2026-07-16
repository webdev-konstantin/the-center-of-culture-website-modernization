# Day 5 — Migration of the Static "Studios & Courses" Component from Tilda into Autonomous HTML/CSS Architecture

**Date:** 2026-07-16  
**Status:** Completed  

---

# Project Development Context

The fifth development day continued the gradual transformation of the exported Tilda website into an independent website architecture based on:

```text
HTML

+

CSS

+

Vanilla JavaScript

+

Local Assets

+

Future CMS Integration
```

At this stage, the project had already passed several important milestones.

Before starting the migration of the "Studios & Courses" component, the following components had already been successfully separated from Tilda:

```text
Header Component

↓

Center DPO Logo Integration

↓

Hero Slider Component

↓

Studios & Courses Component
```

Therefore, the "Studios & Courses" section was not the first autonomous component of the project.

It became the next major static component migrated after the successful preparation of the main structural elements of the website.

---

# Previous Completed Components

## 1. Header Component

The website header was separated from the original Tilda structure.

Completed tasks:

- removed dependency on Tilda block structure;
- created independent HTML markup;
- moved styles into a dedicated CSS file;
- preserved navigation structure;
- prepared the component for future CMS-controlled menu items.

Result:

```text
Independent Header

without

Tilda JavaScript dependency
```

---

## 2. Center DPO Logo Integration

The logo of the Center for Continuing Professional Development was integrated into the autonomous Header structure.

The following elements were preserved:

```text
Logo image

Position

Size

Alignment

Responsive behaviour
```

The logo became a part of the independent website header instead of remaining connected to Tilda-generated blocks.

---

## 3. Hero Slider Component

The main visual slider was migrated into an autonomous structure.

The component received:

```text
hero.css

+

hero.js

+

local images
```

Implemented functionality:

- multiple slides;
- autoplay;
- navigation arrows;
- indicators;
- manual switching;
- independent JavaScript logic.

The current stable version uses:

```text
fade transition
```

The original Tilda horizontal slide animation:

```text
right-to-left movement

left-to-right movement
```

was intentionally postponed.

Reason:

The current priority is:

```text
complete migration of all page components

↓

stable autonomous website

↓

CMS integration

↓

visual refinements
```

The Hero component was therefore marked as:

```text
Stable working version
```

---

# Main Goal of Day 5

The main objective of the fifth development day was:

```text
Migration of the static "Studios & Courses" section
from Tilda into an independent HTML/CSS component
```

The goal was not simply to copy the original Tilda HTML.

The objective was to create a clean autonomous component which:

- works without Tilda;
- uses local assets;
- has independent CSS;
- keeps the original visual concept;
- remains understandable for future maintenance;
- can later receive dynamic data from the CMS.

---

# Why "Studios & Courses" Was Selected

The section was selected because it represents an ideal static component for migration.

Unlike news and events blocks, it does not require external data sources.

The section contains:

```text
Images

Titles

Descriptions

Links
```

Therefore, it allowed testing the new component architecture before moving to dynamic CMS-driven blocks.

---

# Initial State

Before migration, the section existed inside the exported Tilda page.

The original structure contained:

```text
Tilda containers

Generated block identifiers

Service classes

Inline styles

Tilda CSS dependencies

Tilda JavaScript dependencies
```

The component depended on the original Tilda environment.

The task was to transform it into:

```text
Clean HTML structure

+

Independent CSS

+

Local images

```

---

# Architectural Decision

The following component architecture was confirmed:

```text
HTML
    |
    |-- Structure

CSS
    |
    |-- Appearance

JavaScript
    |
    |-- Only interactive behaviour

CMS
    |
    |-- Future content management
```

The component was created according to the same principles as the previously migrated Header and Hero components.

---

# Component Structure

The new architecture:

```text
index.html

        ↓

studios section

        ↓

studios.css

        ↓

local images
```

The component received its own CSS module:

```text
css/studios.css
```

This keeps the styles isolated from:

```text
header.css

hero.css

future components
```

---

# Completed Tasks

---

# 1. Creation of the Studios CSS Module

A separate stylesheet was created:

```text
css/studios.css
```

Before:

```text
css/

header.css

hero.css
```

After:

```text
css/

header.css

hero.css

studios.css
```

The new stylesheet contains only:

```text
Studios component styles
```

This prevents global CSS conflicts.

---

# 2. Integration into index.html

The new stylesheet was connected:

```html
<link rel="stylesheet" href="css/studios.css">
```

The component was inserted into the main page structure:

```html
<main>

    Hero Slider

    ↓

    Studios & Courses

</main>
```

---

# 3. Analysis of Original Tilda Markup

The original section was inspected before migration.

The analysis identified:

```text
Tilda generated containers

service classes

automatic identifiers

inline styling
```

These elements were not transferred.

Reason:

They are part of Tilda's internal system and are unnecessary for an autonomous website.

---

# 4. Extraction of Required Content

Only meaningful content was preserved:

```text
Image

Title

Description

Link
```

The new structure became:

```html
<article class="studio-card">

    <img>

    <h3>
        Title
    </h3>

    <p>
        Description
    </p>

</article>
```

This structure is:

- readable;
- maintainable;
- independent from Tilda;
- ready for future CMS integration.

---

**(Continuation — Part 2/2)**
