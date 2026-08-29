# Day 26 — Hero CMS Refinement, Link Recovery, and Final Slider Stabilisation

**Date:** 2026-08-26–2026-08-29  
**Status:** completed  
**Day score:** 5/5

---

# What was done — in plain language

Day 26 started immediately after Day 25 had been completed.

By that point, a dedicated Hero slider editor already existed inside the CMS. However, the first real use of the editor showed an important distinction: **building an editor is not the same as finishing the entire integration**.

Several problems appeared at the boundary between the administration area and the public homepage:

- navigation behaviour after actions in `hero-slides.php` still needed refinement;
- a newly created slide could be saved in the system but fail to appear immediately on the homepage;
- the expected “More details” link was not rendered correctly;
- after an intermediate button fix, the right arrow could jump from slide 1 directly to slide 3;
- later it became clear that the browser was still receiving an old version of the public `hero-slider.php` component.

Day 26 therefore became a full **end-to-end refinement of the Hero flow, from CMS editing to final visitor interaction on the homepage**.

The separate “More details” button was eventually removed altogether. The entire active Hero slide became clickable and now opens the URL stored for that exact slide.

The final flow is:

```text
administrator edits a slide in the CMS
        ↓
data is saved to hero_slides
        ↓
hero-slider.php loads active records
        ↓
hero.js selects the active slide
        ↓
the whole active Hero becomes the link target
        ↓
clicking opens the URL of that exact slide
```

---

# Main goal of the day

The goal was not simply to “add a button” or “fix an arrow”. The real goal was to finish the module created on Day 25 so that the whole chain behaves consistently:

```text
CMS → database → PHP component → CSS → JavaScript → browser
```

In other words, what an administrator saves in the editor must appear and behave correctly on the public site.

---

# 1. Continuing Day 25: checking the Hero administration editor

Day 26 began as a continuation of the `hero-slides.php` integration.

The editor could already create and modify records, but real use required additional checks of navigation and return behaviour inside the administration workflow.

Instead of rebuilding the editor, the Day 25 architecture was preserved and only the problematic parts were refined.

This follows a key principle used throughout the project:

```text
working module
        ↓
local issue
        ↓
check the exact flow
        ↓
apply a minimal corrective change
```

rather than replacing the entire CMS again.

---

# 2. A new slide existed in the CMS but not on the homepage

The next real-world test was especially useful.

A new Hero slide was created in the editor. The data was visible in the system, but the public homepage did not show the new item.

This proved that debugging could no longer focus on the administration form alone. The complete delivery path had to be checked:

```text
hero-slides.php
        ↓
hero_slides table
        ↓
hero-slider.php
        ↓
index.php
        ↓
homepage HTML
```

From this point on, Hero was treated as one end-to-end component rather than as a separate CMS form and a separate carousel.

---

# 3. Checking the public `hero-slider.php`

The public component determines which Hero records actually reach the homepage.

The implementation retained support for:

- loading published slides only;
- the current locale;
- configured sorting;
- overlay mode;
- image-only mode;
- safe rendering of text and URLs.

The destination link required particular attention.

The URL is stored as part of the Hero record and must remain usable regardless of whether the slide uses a text overlay or a plain image mode.

---

# 4. Restoring “More details” as an intermediate solution

At one stage the expected “More details” link was missing from Hero.

This was not purely a styling issue. In some display modes the button element itself was not being generated in the HTML, so CSS alone could never restore it.

The link-rendering logic was restored, including a special version for image-only slides.

The intermediate result worked: “More details” appeared and received a clean corporate border that remained readable on a light background.

However, this was not the final interaction design. After testing the interface, a simpler solution was chosen: **remove the separate button and make the whole slide clickable**.

---

# 5. Navigation issue discovered: 1 → 3 instead of 1 → 2

Once the visible Hero state had been improved, another issue became obvious.

Clicking the right arrow could move directly from the first slide to the third, skipping the second.

The actual JavaScript next-slide function only performed:

```text
current index + 1
```

So searching for a literal “+2 bug” in one line would have been misleading.

The investigation was expanded to include:

- DOM structure;
- possible duplicate Hero initialisation;
- slide ordering;
- arrow event handlers;
- autoplay timing;
- whether the browser had loaded the latest JavaScript.

---

# 6. Verifying the real `index.php`

The actual production `index.php` was checked instead of relying on older file versions.

A historically important problem was an obsolete wrapper around the dynamic component:

```php
<section class="hero">
    <?php require __DIR__ . '/includes/hero-slider.php'; ?>
</section>
```

while `hero-slider.php` already renders its own:

```html
<section class="hero">
```

The production structure was reduced to a single include:

```php
<?php require __DIR__ . '/includes/hero-slider.php'; ?>
```

The Hero should therefore no longer receive a second obsolete container around the dynamic component.

---

# 7. Checking `footer.php` and JavaScript loading

The shared footer was also inspected.

One possible cause of double navigation would have been loading `hero.js` a second time and attaching two click handlers to the same arrow.

The check showed that `footer.php` did not add another Hero script include.

No unnecessary footer changes were made, and debugging continued in the actual Hero logic.

---

# 8. Stabilising `hero.js`

The original index-changing logic was correct, but autoplay relied on a persistent `setInterval`.

To make manual navigation more predictable, autoplay was changed to a controlled `setTimeout` model.

After manual interaction the sequence is now:

```text
stop the current timer
        ↓
perform exactly one slide change
        ↓
start a fresh autoplay timer
```

A repeated-initialisation guard was also added:

```text
if this Hero is already initialised → do not attach another handler set
```

This makes arrow behaviour more controlled and reduces possible races between manual navigation and autoplay.

---

# 9. Cleaning CSS references and browser cache

`index.php` still referenced an intermediate file:

```text
hero-day25-additions.css
```

That file was no longer part of the current project structure.

All required public Hero styles were therefore consolidated in:

```text
/new-home/css/hero.css
```

Versioned asset URLs were used for CSS and JavaScript:

```text
hero.css?v=20260829-...
hero.js?v=20260829-...
```

This avoids a common production-debugging problem where the server file is already updated but the browser continues displaying a cached copy.

---

# 10. Final UX decision: the entire Hero becomes the link

After the separate “More details” button had already been restored and visually styled, the interaction was reconsidered.

A more natural Hero pattern was chosen:

- hovering the active slide shows a clickable pointer;
- clicking the main Hero area opens the associated material;
- arrows and dots remain independent navigation controls.

For every slide with a valid `button_url`, `hero-slider.php` now creates a transparent full-size link:

```html
<a class="hero-slide-link" href="..."></a>
```

It covers the slide.

The separate visible CTA button is no longer required.

---

# 11. Correct layer hierarchy

To keep the full-slide link from blocking arrows and dots, the interface layers were separated with `z-index`:

```text
z-index 5 → arrows and dots
z-index 3 → transparent slide link
z-index 2 → Hero text
z-index 1 → overlay
            image
```

The resulting behaviour is:

- clicking the image or free Hero area opens the current slide URL;
- clicking an arrow only changes the slide;
- clicking a dot only selects a slide.

---

# 12. Why the pointer initially did not become clickable

After CSS for `.hero-slide-link` was added, the expected pointer still did not appear.

Instead of applying another visual patch, Chrome DevTools Console was used.

The check:

```js
document.querySelectorAll('.hero-slide-link').length
```

returned:

```text
0
```

while the legacy-element check:

```js
document.querySelectorAll('.hero-button, .hero-image-action').length
```

returned:

```text
4
```

This was the key diagnostic moment of the day.

The new CSS existed, but **the new link did not exist in the actual DOM at all**. The browser was still receiving the old button markup.

---

# 13. A build marker proved an old PHP version was being rendered

To stop guessing which component version the server was actually executing, a diagnostic marker was added to the new `hero-slider.php`:

```html
data-hero-build="20260829-clickable-v1"
```

The Console check:

```js
document.querySelector('.hero')?.dataset.heroBuild || 'NO MARKER'
```

first returned:

```text
NO MARKER
```

This proved that the browser was not receiving the expected new PHP component.

That is why earlier CSS changes could not make `.hero-slide-link` appear: the server was still delivering the legacy HTML structure.

---

# 14. Full replacement of the working `hero-slider.php`

To eliminate accumulated intermediate versions, a complete replacement file was prepared:

```text
/new-home/includes/hero-slider.php
```

The final component combines:

- the `hero_slides` database source;
- RU/HU support;
- published-record filtering;
- configured ordering;
- overlay mode;
- image-only mode;
- safe URL handling;
- arrows;
- dots;
- full-size `.hero-slide-link`;
- the diagnostic build marker;
- no legacy visible “More details” buttons.

After the actual production file was replaced, the new markup finally appeared in the browser.

The user confirmed the result:

> “Finally, it worked!”

---

# 15. Removing the “More details” loading flash

Before the final replacement, the words “More details” could briefly appear in the upper-left corner during page refresh before Hero finished styling.

The DOM investigation explained why: the old HTML still contained ordinary text links/buttons.

The final Hero contains a transparent full-slide link instead, so the words “More details” no longer exist in the public Hero markup.

The loading artifact disappeared with them.

---

# Main Day 26 files

```text
/new-home/admin/hero-slides.php
/new-home/includes/hero-slider.php
/new-home/index.php
/new-home/css/hero.css
/new-home/js/hero.js
/new-home/includes/footer.php
```

The final changes were concentrated in the public Hero layer, but the administration editor is also part of the beginning of Day 26 because the work started as a continuation of the Day 25 integration.

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
        ┌──────── active slide ──────────┐
        │                               │
        │    image / Hero text          │
        │                               │
        │ transparent current URL link  │
        │                               │
        └───────────────────────────────┘
             ↑                    ↑
           arrows                dots
          z-index 5             z-index 5
                      ↓
                   hero.js
```

The core principle is now:

```text
one CMS record
        ↓
one public slide
        ↓
one active Hero state
        ↓
one correct URL for the current slide
```

---

# Verified result

- Day 26 correctly continues Day 25 rather than representing a separate unrelated module;
- the Hero administration editor remained in use and was refined through real operation;
- a newly created slide now follows the complete CMS-to-public flow;
- active records are loaded from `hero_slides`;
- configured ordering is preserved;
- overlay mode works;
- no-overlay mode works;
- the intermediate “More details” button was restored and tested;
- the separate button was then deliberately removed in favour of whole-slide click behaviour;
- arrows move sequentially;
- dot navigation works;
- autoplay remains available;
- repeated-initialisation protection was added;
- the obsolete extra CSS file is no longer required;
- cache busting forces updated CSS/JS to load;
- the whole active Hero shows a clickable pointer;
- clicking opens the URL of the current slide;
- arrows and dots remain above the link and do not trigger navigation;
- legacy `.hero-button` / `.hero-image-action` output was removed from the final public behaviour;
- the brief “More details” loading artifact disappeared;
- DevTools proved there was a mismatch between expected PHP and actual DOM output;
- the build marker helped identify the stale public component;
- after full replacement of the production `hero-slider.php`, the user confirmed correct behaviour;
- Hero is officially closed.

---

# Technologies and skills practised

- PHP 8 and strict typing;
- MySQL;
- integration between administrative CRUD and a public component;
- prepared SQL statements;
- safe URL filtering;
- HTML escaping;
- reusable PHP components;
- CSS positioning;
- `z-index` layer management;
- full-area HTML anchors;
- JavaScript events;
- `setTimeout` autoplay management;
- repeated-initialisation guards;
- CSS/JS cache busting;
- Chrome DevTools Console;
- real DOM inspection;
- diagnostic build markers;
- checking the complete `CMS → DB → PHP → DOM` chain;
- finding mismatches between server files and browser-rendered output;
- step-by-step debugging without unnecessarily rewriting working parts.

---

# Why this day matters

Day 26 demonstrates the difference between “implementing a feature” and “finishing a feature in production”.

Day 25 created the Hero editor.

Day 26 tested the next level:

```text
can an administrator really add a slide
        ↓
does it reach the homepage
        ↓
can a visitor navigate to it correctly
        ↓
can the visitor open exactly the material attached to it
```

That final integration layer is what turns a prototype into a working product.

---

# Main achievement of the day

The Hero slider moved from “the CMS module exists, but integration edges still have problems” to a finished interactive homepage component.

```text
start of Day 26:
CMS saves slides → new slide may not appear → “More details” is missing → navigation is unstable

end of Day 26:
CMS → database → public Hero → sequential navigation → the whole active slide opens its own URL
```

The debugging method itself is also important.

The final issue was not solved through another random CSS change. It was solved by inspecting the real DOM, counting legacy elements, and checking a PHP build marker.

---

# Day score

## 5 out of 5

The maximum score is justified because this stage completed **the end-to-end integration**, not merely a cosmetic patch:

- Hero editor work was continued and stabilised after Day 25;
- saving and public appearance of new slides were tested;
- the CMS → DB → public PHP flow was debugged;
- destination-link behaviour was restored and verified;
- a simpler final UX was introduced without a separate button;
- navigation jumping was eliminated and client-side behaviour stabilised;
- `index.php`, `footer.php`, `hero-slider.php`, `hero.css`, and `hero.js` were all checked;
- reproducible DevTools diagnostics were used;
- it was discovered that the browser was receiving stale PHP markup;
- the public component was fully replaced;
- the loading artifact was removed;
- the result was verified on the production page;
- the user confirmed: **Hero is closed**.

The Console still showed a `404` for one image in the news carousel. That issue is unrelated to Hero and does not affect completion of this task; it remains a separate technical-cleanup item.

**Status: ✅ Day 26 fully completed**
