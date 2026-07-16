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

# 5. Creation of Autonomous Studio Cards

Six independent cards were created:

```text
1. Russian Language Courses

2. Piano Studio

3. Children's Creative Center "ART"

4. Children's Theatre Studio "Artists"

5. Ali Tankybaeva Ballet School

6. Library
```

Each card contains:

```text
Image

Title

Description

Link
```

The final HTML structure no longer depends on:

```text
Tilda card system

Generated identifiers

External scripts

Block initialization
```

---

# 6. Recreating the Original Visual Composition

During the first implementation attempt, the section was created as:

```text
3 × 2 equal cards grid
```

After comparison with the original Tilda design, it was discovered that this structure did not match the original layout.

The original composition uses an asymmetric design:

```text
+----------------+-------------+-------------+
|                |             |             |
|                |  Card 2     |  Card 3     |
|   Card 1       |-------------|-------------|
|                |  Card 4     |  Card 5     |
|                |             |             |
+----------------+-------------+-------------+

|              Card 6                         |
+----------------------------------------------+
```

The final implementation uses:

```text
CSS Grid

+

custom positioning

+

row spanning
```

The first card occupies two rows:

```css
grid-row: span 2;
```

This approach allows the autonomous component to visually reproduce the original Tilda concept while keeping clean and maintainable code.

---

# 7. Development of the Visual Layer

The new stylesheet:

```text
css/studios.css
```

was created to control:

```text
Layout

Spacing

Typography

Image behaviour

Overlay effects

Responsive behaviour

Hover animation
```

The styling was separated from HTML according to modern frontend principles:

```text
HTML

↓

Structure


CSS

↓

Presentation
```

---

# 8. Implemented Visual Features

The autonomous component includes:

## Image Overlay

Each card contains an independent overlay layer:

```html
<div class="studio-card-overlay"></div>
```

The structure:

```text
Image

↓

Gradient Overlay

↓

Text
```

This ensures readable text regardless of image brightness.

---

## Card Content Area

Text information is placed inside:

```html
<div class="studio-card-content">
```

Containing:

```text
h3 — Studio title

p — Description
```

---

## Smooth Hover Animation

A modern but minimal interaction was added.

When the user places the cursor over a card:

```text
Mouse hover

↓

Image smoothly scales

↓

Card becomes visually active
```

Implemented with:

```css
transform: scale(1.035);
```

The effect was intentionally kept subtle.

The goal:

- improve user experience;
- avoid excessive animation;
- maintain a professional educational website style.

---

# 9. Responsive Design Preparation

The component was created with responsive behaviour.

Three layouts were considered:

```text
Desktop

↓

Tablet

↓

Mobile
```

Desktop:

```text
Large asymmetric grid
```

Tablet:

```text
Simplified two-column layout
```

Mobile:

```text
Single-column cards
```

The component does not depend on Tilda responsive scripts.

All adaptation is handled by:

```css
@media queries
```

---

# 10. Browser Testing

After integration, the following structure was tested:

```text
Header

↓

Hero Slider

↓

Studios & Courses
```

Verified:

```text
Header works

Hero works

Studios section loads

Images display

CSS applies correctly

Hover interaction works
```

The result confirmed that the new component does not break previously completed sections.

---

# 11. Detected Minor Issue

During testing, one small problem was identified:

```text
Library card image
```

was not displayed.

The reason:

```text
incorrect image path

or

filename mismatch
```

This issue is isolated and does not affect the component architecture.

The planned correction:

```text
Check local image folder

↓

Verify filename

↓

Update image path
```

---

# 12. CMS Integration Readiness

Although the component is currently static, the structure was created with future CMS integration in mind.

Current version:

```text
HTML

↓

Static Cards
```

Future version:

```text
MySQL CMS

↓

PHP API

↓

JSON

↓

JavaScript

↓

Dynamic Cards
```

Potential CMS-controlled fields:

```text
image

title

description

link

order

active status
```

The visual component will not need to be redesigned when dynamic data is introduced.

---

# 13. Removed Tilda Dependencies

The migrated component no longer requires:

```text
Tilda JavaScript

Tilda initialization functions

Tilda generated classes

Inline styles

Tilda block identifiers
```

Only the useful content concept was preserved:

```text
Images

Text

Links

Visual structure
```

---

# 14. Final Project Structure After Day 5

Current architecture:

```text
Website Project

│

├── index.html

│

├── css

│     ├── header.css

│     ├── hero.css

│     └── studios.css

│

├── js

│     └── hero.js

│

└── img

      └── local assets
```

---

# Technologies Learned and Applied

During Day 5 the following technologies were used:

```text
HTML5

CSS3

CSS Grid

CSS Media Queries

Responsive Web Design

Component-based Architecture

Local Asset Management

Tilda Export Analysis

Frontend Refactoring
```

---

# Tools Used

```text
Google Chrome

Chrome DevTools

Responsive Mode

Microsoft Windows

HTML Editor

Local Browser Testing

Exported Tilda Website

ChatGPT
```

---

# Main Results of Day 5

The fifth development day achieved the following:

## 1. Successful migration of another autonomous component

Completed:

```text
Studios & Courses
```

The component now:

- works without Tilda;
- uses local resources;
- has independent CSS;
- follows the new website architecture.

---

## 2. Confirmation of Component-Based Development Strategy

The website structure now contains:

```text
Header + Center Logo

↓

Hero Slider

↓

Studios & Courses
```

Each component has:

```text
Own HTML structure

Own CSS module

Own responsibility
```

---

## 3. Preparation for Dynamic Content Migration

The next stage will move from static components to CMS-driven components.

The following sections require migration:

```text
Our News

Our Upcoming Events

International Events
```

These blocks currently depend on:

```text
Tilda Feed
```

and display:

```text
Feed not found
```

in the local exported version.

---

# Next Development Steps

## Phase 1

Analyze dynamic blocks:

```text
News

Events

International Events
```

---

## Phase 2

Determine required CMS fields:

```text
Title

Description

Image

Date

Category

Link
```

---

## Phase 3

Create autonomous feed components:

```text
HTML

+

CSS

+

JavaScript
```

without Tilda Feed dependency.

---

## Phase 4

Connect components to existing CMS:

```text
CMS

↓

MySQL

↓

PHP

↓

JSON

↓

JavaScript

↓

Website Cards
```

---

# Final Assessment of Day 5

## Technical Result

```text
5 / 5
```

The component was successfully migrated and integrated.

---

## Development Process

```text
5 / 5
```

The work followed the planned methodology:

```text
Analyze

↓

Create isolated component

↓

Implement

↓

Test

↓

Fix only necessary issues

↓

Save stable version
```

---

# Final Summary

Day 5 became another important step in transforming the exported Tilda website into an autonomous maintainable website.

It confirmed that:

- Tilda components can be migrated independently;
- visual quality can be preserved without internal Tilda mechanisms;
- the new architecture remains understandable;
- future CMS integration is possible without rebuilding the frontend.

The project now contains another independent component:

```text
Studios & Courses
```

The website development continues with the next stage:

```text
Migration of dynamic content blocks

↓

News

↓

Upcoming Events

↓

International Events
```

**Status:** ✅ Completed
