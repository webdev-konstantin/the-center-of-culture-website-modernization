# Day 26 — Final Hero Slider Stabilization and Full-Slide Click Navigation

**Date:** 2026-08-29  
**Status:** completed  
**Day score:** 5/5

---

# What was done — in plain language

Day 26 was not about adding another large module. It was about finishing the Hero slider properly.

After the Hero editor had been connected to the CMS, two visible issues were still left:

- arrow navigation could behave inconsistently;
- the destination link was tied to a separate “More details” button, which could briefly flash in the upper-left corner before all Hero styles were applied.

Instead of applying another isolated patch, the complete Hero chain was checked:

```text
index.php → hero-slider.php → hero.css → hero.js → browser DOM
```

The final interaction model is now simpler:

```text
CMS stores the slide URL
        ↓
hero-slider.php renders the slide
        ↓
the whole active slide becomes a link
        ↓
arrows and dots stay above that link
        ↓
the user clicks the current Hero slide
        ↓
the URL of that exact slide opens
```

The separate “More details” button is no longer required.

---

# Main goal of the day

Finish the Hero slider as a production-ready homepage component: remove residual visual artifacts, stabilise navigation, and make opening the associated material natural by clicking the active slide itself.

---

# 1. Verifying the real homepage structure

The current `index.php` was checked first.

The Hero component is now included correctly only once:

```php
<?php require __DIR__ . '/includes/hero-slider.php'; ?>
```

The obsolete outer `<section class="hero">` wrapper is no longer present.

The shared `footer.php` was also inspected. It does not include `hero.js` again, so it cannot create duplicate click handlers.

This ruled out two false causes and allowed the debugging to move to the actual Hero implementation.

---

# 2. Cleaning up CSS and JavaScript includes

`index.php` still referenced an intermediate stylesheet:

```text
hero-day25-additions.css
```

That file was no longer present in the production structure.

All public Hero styling was therefore consolidated in the existing file:

```text
/new-home/css/hero.css
```

Version parameters were also added to the updated CSS and JavaScript assets so the browser would not continue using stale cached copies.

Principle:

```text
hero.css?v=new-version
hero.js?v=new-version
```

This is especially important during production debugging: replacing a file on the host does not necessarily mean the browser immediately loads that exact version.

---

# 3. Stabilising slide navigation

The logic in `hero.js` was checked independently.

The original algorithm mathematically advanced only one slide at a time, but autoplay relied on a persistent `setInterval`. For more predictable interaction, autoplay was changed to a controlled `setTimeout` flow.

After a manual navigation action, the sequence is now:

```text
stop the current timer
        ↓
move exactly one slide
        ↓
start a new autoplay timer
```

A guard against repeated Hero initialisation was also added.

This reduces the risk of accidentally attaching multiple sets of event handlers to the same Hero block.

---

# 4. Removing the separate “More details” button

Testing showed that a dedicated CTA button no longer provided a clear benefit for the current Hero design.

A more natural interaction is:

- the user moves the pointer over the image;
- the pointer indicates that the slide is clickable;
- clicking the Hero itself opens the related material.

The old public elements were therefore removed:

```text
.hero-button
.hero-image-action
.hero-button--image
```

The Hero no longer renders a separate navigation button.

---

# 5. Making the entire active slide clickable

For every slide with a valid `button_url`, `hero-slider.php` now creates a transparent full-size link:

```html
<a class="hero-slide-link" href="..."></a>
```

It covers the whole slide.

The URL still comes from the same CMS record, so no second source of truth was introduced.

The logic is straightforward:

```text
slide 1 → URL 1
slide 2 → URL 2
slide 3 → URL 3
```

Whichever slide is currently active opens its own configured URL.

---

# 6. Correct interface layering

To keep the full-slide link from blocking navigation controls, the layers were separated with `z-index`.

```text
z-index 5 → arrows and dots
z-index 3 → transparent full-slide link
z-index 2 → Hero text
z-index 1 → overlay
            image
```

This produces both expected behaviours:

- clicking the main Hero area opens the material;
- clicking an arrow or dot only changes the slide and does not follow the slide link.

---

# 7. Using DevTools to inspect reality instead of guessing

The most important part of the day was moving from assumptions to checking what the browser had actually received from the server.

The Console was used to run:

```js
document.querySelectorAll('.hero-slide-link').length
```

and:

```js
document.querySelectorAll('.hero-button, .hero-image-action').length
```

The result was:

```text
.hero-slide-link = 0
old button elements = 4
```

That proved the browser was still receiving the old HTML structure even though the expected PHP changes had already been discussed.

A diagnostic build marker was then added to the new public component:

```html
data-hero-build="20260829-clickable-v1"
```

The browser check:

```js
document.querySelector('.hero')?.dataset.heroBuild || 'NO MARKER'
```

initially returned:

```text
NO MARKER
```

So the problem was not CSS. The production site was still serving an old version of `hero-slider.php`.

---

# 8. Replacing the public Hero component completely

Instead of continuing to edit fragments, a complete replacement file was prepared:

```text
/new-home/includes/hero-slider.php
```

The new version combines all required behaviour in one known-good component:

- loading active slides from `hero_slides`;
- RU/HU support;
- safe URL handling;
- overlay and no-overlay image modes;
- configured slide order;
- full-size `.hero-slide-link`;
- no legacy “More details” controls;
- arrows and dots;
- a diagnostic build marker.

After the actual production file was replaced, the new behaviour appeared in the browser and the Hero worked as intended.

---

# 9. Why the “More details” text stopped flashing in the corner

The brief “More details” flash during page loading came from the old HTML structure.

The browser could render the plain anchor text before all Hero CSS rules had been applied.

After switching to a transparent full-slide link, the words “More details” no longer exist in the public Hero markup.

The loading artifact therefore disappeared as well.

---

# 10. Main Day 26 files

```text
/new-home/index.php
/new-home/includes/hero-slider.php
/new-home/css/hero.css
/new-home/js/hero.js
/new-home/includes/footer.php
```

`footer.php` did not ultimately require a change, but verifying it was important to rule out duplicate JavaScript loading.

---

# Hero architecture after Day 26

```text
                CMS
                 ↓
          hero_slides table
                 ↓
          hero-slider.php
                 ↓
     ┌──────── active slide ───────────┐
     │                                │
     │   image / Hero text            │
     │                                │
     │   transparent URL link         │
     │                                │
     └────────────────────────────────┘
          ↑                    ↑
        arrows                dots
       z-index 5             z-index 5
                 ↓
             hero.js
```

---

# Verified result

- Hero content is still managed through the CMS;
- active slides load in the configured order;
- overlay mode works;
- no-overlay mode works;
- arrows move through slides sequentially;
- dot navigation continues to work;
- autoplay remains available;
- the separate “More details” button is gone;
- the loading-time “More details” artifact is gone;
- the entire active Hero shows a clickable pointer;
- clicking the Hero opens the current slide URL;
- arrows and dots remain independent controls;
- the new public PHP component was confirmed on the production page;
- the user confirmed the final result and closed the Hero task.

---

# Technologies and skills practised

- PHP 8 and strict typing;
- MySQL and an existing CMS data model;
- safe URL filtering;
- reusable PHP components;
- CSS positioning and `z-index`;
- full-area HTML anchors;
- JavaScript events;
- `setTimeout` autoplay management;
- repeated-initialisation guards;
- cache busting for CSS/JS;
- Chrome DevTools Console;
- inspecting the actual DOM;
- diagnostic build markers;
- finding mismatches between server-side files and browser-rendered output;
- step-by-step debugging instead of rewriting the whole component.

---

# Main achievement of the day

The Hero changed from a CMS slider that “mostly works” into a finished interactive component.

```text
before:
separate button → separate click target → residual artifacts → harder debugging

now:
the whole active slide = a clear link to its own material
```

Equally important was the debugging method itself: the issue was not solved by another random CSS change, but by inspecting the real DOM, counting legacy elements, and verifying which PHP build the server was actually rendering.

---

# Day score

## 5 out of 5

The maximum score is justified:

- the final unfinished Hero task was closed;
- navigation behaviour was stabilised;
- the user interaction model was simplified;
- the redundant CTA element was removed;
- the loading-time visual artifact was eliminated;
- every main layer was checked: `index.php`, PHP component, CSS, JavaScript, and browser DOM;
- reproducible DevTools diagnostics were used;
- the mismatch between expected and actually loaded PHP was identified;
- the result was verified on the production site after replacing the full component;
- the user confirmed: **Hero is closed**.

The Console also showed a `404` for one news-carousel image. That issue is separate from Hero and did not affect completion of this day; it remains a future technical-cleanup item.

**Status: ✅ Day 26 completed**
