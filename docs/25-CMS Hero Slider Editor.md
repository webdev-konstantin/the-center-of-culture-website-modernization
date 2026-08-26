# Day 25 — CMS Hero Slider Editor

**Date:** 2026-08-25–2026-08-26  
**Status:** completed  
**Day score:** 5/5

---

# What was done — in plain language

On Day 25, the homepage hero stopped being a static block that could only be changed manually in the source code.

A dedicated CMS editor was built for the existing Hero slider. An administrator can now create and edit slides, choose images from the media library, enter a large heading and a short lead, configure a link, change the display order, and temporarily disable individual slides.

The key addition is support for two independent image modes:

- **dark overlay** — for slides with a large white heading and supporting text;
- **no overlay** — for posters, banners, and other images that must retain their original brightness.

The existing arrows and slide indicators remain in use.

---

# Main goal of the day

Connect the homepage Hero slider to the custom CMS so that its content can be updated without manually editing PHP, HTML, CSS, or JavaScript.

The resulting flow is:

```text
CMS editor
        ↓
validation and saving
        ↓
hero_slides table
        ↓
public PHP component
        ↓
homepage Hero slider
```

---

# 1. Dedicated slide storage

A separate database table was prepared for Hero slides.

It stores:

- heading;
- short lead;
- button label;
- destination URL;
- image path;
- image alternative text;
- display mode;
- slide order;
- active status;
- creation and update timestamps.

Hero slides are not mixed with news, RCC announcements, or international events. This keeps the data model clear and easier to maintain.

---

# 2. Hero slider editor in the CMS

The administration area now includes a dedicated slide-management screen.

The editor allows an administrator to:

1. create a slide;
2. edit an existing slide;
3. select an image;
4. enter the heading and short lead;
5. configure the button label and URL;
6. enable or disable the dark overlay;
7. set the display order;
8. publish or disable a slide;
9. remove an obsolete slide.

The main settings are presented in a clear form, so routine updates no longer require source-code changes.

---

# 3. Reusing the media library

The Hero editor is integrated with the media library created earlier.

An image can therefore be:

- selected from existing media;
- reused without another upload;
- stored through its existing path;
- supplied with an appropriate `alt` description.

The media library is now a shared image source for both publications and the main visual block of the homepage.

---

# 4. Two image display modes

## Slide with a dark overlay

This mode is intended for text-led Hero slides.

The image can contain:

- a large heading;
- a short explanatory lead;
- a call-to-action button;
- navigation controls.

The overlay improves contrast and keeps white text readable.

## Slide without an overlay

This mode is intended for assets that must remain visually unchanged:

- posters;
- information banners;
- branded graphics;
- images where colour is part of the content.

The CMS stores the selected mode separately for every slide.

---

# 5. Public PHP component

The Hero output is placed in a reusable component:

```text
/new-home/includes/hero-slider.php
```

The component:

- loads active records only;
- follows the configured order;
- safely renders text values;
- creates the required HTML structure;
- applies the overlay through a modifier class;
- remains compatible with the existing navigation.

The homepage includes this component in place of the previous static Hero markup.

---

# 6. Preserving the working navigation

The new editor did not replace the proven public carousel mechanism.

The following elements remain in place:

- previous button;
- next button;
- dot indicators;
- active-slide switching;
- existing JavaScript behaviour.

The CMS now controls the content, while the established client-side logic continues to control presentation.

---

# 7. Validation and security

The saving process follows the project’s basic security requirements:

- administrative authentication;
- server-side input validation;
- allowed display-mode values;
- numeric sort order;
- normalised publication status;
- escaped frontend output;
- prepared SQL statements.

The image field stores a reference to an existing media asset rather than executable markup supplied by an editor.

---

# 8. Main Day 25 files

```text
/new-home/admin/hero-slides.php
/new-home/admin/js/hero-editor.js
/new-home/admin/css/hero-editor.css
/new-home/includes/hero-slider.php
/new-home/css/hero.css
/new-home/index.php
day25-hero-slider.sql
```

A CMS-menu integration fragment and a step-by-step installation guide were also prepared.

---

# Architecture after Day 25

```text
media library ───────────┐
                        ↓
administrator → Hero editor → database
                                      ↓
                               hero-slider.php
                                      ↓
                                  homepage
                                      ↓
                         overlay or plain slide
```

---

# Verified result

- the Hero slider section is available in the CMS;
- slides can be created and edited;
- images can be selected from the media library;
- headings, short leads, and buttons are rendered;
- slide order is configurable;
- inactive records are hidden;
- dark-overlay mode works;
- no-overlay mode works;
- arrows and indicators continue to switch slides;
- saved changes appear on the homepage.

---

# Technologies practised

- PHP 8 and strict typing;
- MySQL;
- prepared SQL statements;
- CRUD administration;
- reusable PHP components;
- media-library integration;
- HTML escaping;
- CSS modifier classes;
- JavaScript form management;
- ordering and publication status;
- incremental improvement of an existing architecture.

---

# Main achievement of the day

The Hero slider changed from a static homepage fragment into a manageable content module.

```text
before: changing a slide = manually editing code

now: changing a slide = using a clear CMS form
```

The new system extends the existing carousel without breaking its proven navigation.

---

# Day score

## 5 out of 5

The maximum score is justified:

- the assigned task was completed;
- the editor is connected to the CMS;
- slide data is stored separately and consistently;
- the media library is reused;
- both required image modes are supported;
- the working navigation was preserved;
- the final system was tested on the live project;
- the user confirmed that everything works.

**Status: ✅ Day 25 completed**
