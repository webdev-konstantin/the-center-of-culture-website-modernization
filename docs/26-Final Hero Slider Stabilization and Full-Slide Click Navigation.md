# Day 26 — Final CMS Integration of the Hero Slider

**Date:** 2026-08-26–2026-08-29  
**Status:** completed  
**Day score:** 5/5

---

# What was done — in plain language

On Day 25, the Hero slider received its own editor in the CMS.

The goal of Day 26 was to turn that editor into a fully finished homepage module: an administrator should be able to manage slides in the CMS, while a visitor should see the current Hero, move through slides in the correct order, and open the related material by clicking the active slide itself.

The final flow is:

```text
Hero editor in the CMS
        ↓
hero_slides table
        ↓
public hero-slider.php
        ↓
homepage Hero
        ↓
arrows / dots / autoplay
        ↓
click the active slide
        ↓
URL of that exact slide
```

The main result is that Hero now works as one CMS-driven component rather than a collection of separate PHP, CSS, and JavaScript fragments.

---

# Main goal of the day

Deliver a completed Hero module with the following behaviour:

- content comes from the CMS;
- only published slides are shown;
- configured ordering is preserved;
- both image display modes remain available;
- every slide can store its own destination URL;
- arrows and dots move through slides sequentially;
- autoplay remains available;
- the entire active slide is clickable;
- no separate “More details” button is required;
- updated CSS and JavaScript can be loaded without stale browser-cache issues.

---

# 1. Use the CMS as the single source of content

The Hero editor created on Day 25 remains the management point for slide content.

An administrator configures:

- image;
- heading;
- short text;
- destination URL;
- display mode;
- ordering;
- publication status.

The public page does not keep a second copy of these values.

Principle:

```text
one CMS record
        ↓
one homepage slide
```

This prevents the administrative version and the public version of Hero from drifting apart.

---

# 2. Include Hero on the homepage as one PHP component

The homepage loads Hero through a dedicated component:

```php
<?php require __DIR__ . '/includes/hero-slider.php'; ?>
```

`hero-slider.php` renders the complete Hero section itself.

Therefore `index.php` does not need another outer `<section class="hero">` wrapper.

The resulting structure is simpler:

```text
index.php
   ↓
hero-slider.php
   ↓
complete Hero markup
```

---

# 3. Load only the required slides

`hero-slider.php` reads records from the `hero_slides` table.

The component:

- respects the current locale;
- renders published records only;
- follows `sort_order`;
- safely outputs text values;
- validates destination URLs;
- creates the HTML for each slide.

The content and ordering of Hero are therefore controlled from the CMS rather than manually in `index.php`.

---

# 4. Keep both Hero display modes

Each slide supports two display variants.

## Overlay mode

Used when the image needs:

- a heading;
- a short supporting text;
- a dark overlay for contrast.

## Image-only mode

Used for:

- posters;
- event artwork;
- ready-made promotional graphics;
- images that should remain visually unchanged.

The display mode is stored separately for every slide in the CMS.

---

# 5. Make the entire active slide a link

Instead of a separate “More details” button, Hero uses one transparent link covering the slide:

```html
<a class="hero-slide-link" href="..."></a>
```

Its URL comes from the current slide record.

The model is straightforward:

```text
slide 1 → URL 1
slide 2 → URL 2
slide 3 → URL 3
```

When the pointer moves over Hero, the cursor indicates that the slide is clickable. Clicking any free area of the active slide opens the related material.

A separate visual CTA is no longer necessary.

---

# 6. Separate the clickable slide from navigation controls

The full-slide link must not block the arrows or dot navigation.

A clear layer order is used:

```text
z-index 5 → arrows and dots
z-index 3 → full-slide link
z-index 2 → Hero text
z-index 1 → overlay
            image
```

As a result:

- clicking Hero opens the material;
- clicking an arrow only changes the slide;
- clicking a dot only selects the requested slide.

---

# 7. Stabilise JavaScript navigation

`hero.js` is responsible only for slider behaviour:

- tracking the active slide;
- moving to previous and next slides;
- synchronising the dots;
- keeping autoplay available;
- handling manual navigation predictably;
- avoiding repeated initialisation of the same Hero block.

The key rule is:

```text
one user action
        ↓
one slide change
```

So the right arrow moves 1 → 2 → 3, while the left arrow moves in the opposite direction.

---

# 8. Keep all public Hero styles in one CSS file

Public Hero styling is consolidated in:

```text
/new-home/css/hero.css
```

This file contains:

- Hero dimensions;
- slide positioning;
- active/inactive states;
- overlay styling;
- text layer;
- arrows;
- dots;
- `.hero-slide-link`;
- responsive rules.

No additional intermediate Hero stylesheet is required.

---

# 9. Load updated CSS and JavaScript without stale cache

After public assets are changed, a browser may continue to use an older cached copy.

For that reason, `index.php` uses versioned asset URLs:

```html
<link rel="stylesheet" href="/new-home/css/hero.css?v=20260829-2">
<script src="/new-home/js/hero.js?v=20260829-1"></script>
```

This makes the browser request the current CSS and JavaScript after deployment.

---

# 10. Add a technical build marker

For quick verification of the public PHP component, Hero includes a technical marker:

```html
data-hero-build="20260829-clickable-v1"
```

It can be checked in DevTools:

```js
document.querySelector('.hero')?.dataset.heroBuild
```

This immediately confirms which `hero-slider.php` build the browser has received.

It is not a user-facing feature; it is a lightweight maintenance and deployment check.

---

# 11. Final file structure

The main Hero implementation now consists of:

```text
/new-home/admin/hero-slides.php
/new-home/includes/hero-slider.php
/new-home/css/hero.css
/new-home/js/hero.js
/new-home/index.php
```

Responsibilities are separated clearly:

```text
hero-slides.php  → content management
hero-slider.php  → data loading and HTML
hero.css         → presentation
hero.js          → slide behaviour
index.php        → include the finished component
```

---

# Architecture after Day 26

```text
              administrator
                   ↓
             CMS Hero editor
                   ↓
            hero_slides table
                   ↓
            hero-slider.php
                   ↓
      ┌──────── active Hero ──────────┐
      │                              │
      │ image / text / overlay       │
      │                              │
      │ full-slide destination link  │
      │                              │
      └──────────────────────────────┘
          ↑                      ↑
        arrows                  dots
                   ↓
                hero.js
```

---

# What changed for the administrator

The administrator no longer needs to edit the homepage manually.

To update Hero, it is enough to:

1. open the Hero editor in the CMS;
2. create or edit a slide;
3. select an image;
4. enter text and a destination URL;
5. choose the display mode;
6. set the order;
7. publish the record.

The public component then renders the required slide automatically.

---

# What changed for the site visitor

Hero is now simpler to use:

- slides move in sequence;
- arrows and dots remain available;
- autoplay is preserved;
- there is no redundant separate button;
- hover indicates that Hero is clickable;
- clicking the active slide opens the related material.

---

# Verified result

- Hero is managed through the CMS;
- data comes from `hero_slides`;
- only published records are rendered;
- slide order is controlled from the CMS;
- overlay mode works;
- image-only mode works;
- arrows move sequentially;
- dots work;
- autoplay remains available;
- the entire active slide is clickable;
- every slide opens its own URL;
- arrows and dots do not trigger the slide link;
- the separate “More details” button is no longer used;
- Hero does not flash that button during page loading;
- the browser receives the current CSS and JavaScript assets;
- the public Hero build can be checked quickly through the build marker;
- the final Hero implementation was verified on the production page.

---

# Technologies and skills practised

- PHP 8;
- MySQL;
- CMS → database → frontend integration;
- prepared SQL statements;
- HTML escaping;
- safe URL handling;
- reusable PHP components;
- CSS positioning;
- `z-index`;
- full-area HTML links;
- JavaScript events;
- slider state management;
- autoplay management;
- repeated-initialisation protection;
- cache busting;
- Chrome DevTools;
- build markers for component-version checks.

---

# Main achievement of the day

After Day 25, Hero could already be edited from the CMS.

After Day 26, the **public integration of that editor is complete**.

```text
Day 25:
Hero can be edited

Day 26:
Hero can be edited → published → navigated → opened as the correct linked material
```

The administrative and public sides now form one finished module.

---

# Day score

## 5 out of 5

The maximum score is justified because:

- the Hero CMS integration with the homepage is complete;
- the component structure is simpler;
- `hero_slides` remains the single source of content;
- both display modes are supported;
- navigation moves sequentially;
- autoplay is preserved;
- every slide has its own destination;
- the UX was simplified to full-slide clicking;
- arrows and dots do not conflict with the link;
- CSS/JS loading is protected from stale cache;
- the current public component can be verified through a build marker;
- the final result works on the production site.

**Status: ✅ Day 26 completed**
