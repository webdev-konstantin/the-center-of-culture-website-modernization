# Day 16 — Moving the News Carousel and Launching the Unified Announcements Feed

**Date:** 2026-08-01  
**Status:** Completed  
**Day Rating:** 5/5

---

# What Was Done — In Plain Language

Day 16 expanded the dynamic publishing architecture beyond ordinary news.

First, the already working news carousel was moved from the bottom of the homepage to the position immediately below the Hero section. The move was intentionally isolated: the carousel markup itself, the Hero, the “Studios and Courses” section, CSS files, JavaScript files, and the database logic were not redesigned.

Then the project received a second dynamic carousel for announcements. Four real records with `content_type = 'event'` were added to `home_feed_items`, a separate PHP component was created for them, and the shared article template was extended so that it can open news, announcements, and international-event records.

The vertical sidebar on the article page was also made context-aware:

```text
open a news item
        ↓
show “Other News”

open an announcement
        ↓
show “Other Announcements”

open an international event
        ↓
show “Other International Events”
```

The separate homepage container “International Events” was removed from the roadmap. International-event content will now be displayed inside one combined homepage section:

```text
Announcements of the Russian Cultural Centre and International Events
```

---

# Main Objectives

1. Move the news carousel directly below the Hero without changing other homepage components.
2. Confirm that the existing carousel still works after the move.
3. Verify the available `content_type` values in MySQL.
4. Add four real announcement records with `content_type = 'event'`.
5. Create a reusable `events-carousel.php` component.
6. Add a second carousel to the homepage.
7. Rename the section to “Announcements of the Russian Cultural Centre and International Events”.
8. Reuse the existing article template for announcements.
9. Diagnose and correct broken announcement links.
10. Make the vertical sidebar display publications of the same type as the open page.
11. Finalize the decision to combine announcements and international events in one homepage feed.

---

# Initial State

At the beginning of Day 16:

- the Hero worked;
- the news carousel displayed eight records;
- the news carousel was located below “Studios and Courses”;
- the shared `news.php` template opened ordinary news;
- the right sidebar displayed six other news items;
- `home_feed_items` already supported the types `news`, `event`, and `international`;
- no announcement records had yet been added to the table;
- there was no announcement carousel on the homepage.

---

# 1. Moving the News Carousel Below the Hero

The existing order was:

```text
Header
Hero
Studios and Courses
News Carousel
```

The target order was:

```text
Header
Hero
News Carousel
Studios and Courses
```

The complete `<section class="content-carousel-section" id="news-section">...</section>` block was moved as one uninterrupted fragment.

No internal line of the carousel was rewritten. The include remained:

```php
<?php include __DIR__ . '/api/news-carousel.php'; ?>
```

The JavaScript include remained at the bottom of the page:

```html
<script src="js/content-carousel.js"></script>
```

The operation changed only the DOM order of two independent sections.

## Verified result

- the Hero remained unchanged;
- eight news cards remained visible;
- arrows and dots continued to work;
- “Studios and Courses” remained intact;
- the news carousel no longer appeared at the bottom of the page.

---

# 2. Verifying the Database Content Types

The structure of `home_feed_items.content_type` was checked with:

```sql
SHOW COLUMNS
FROM home_feed_items
LIKE 'content_type';
```

The result confirmed:

```text
enum('news','event','international')
```

The record count was then checked:

```sql
SELECT
    content_type,
    COUNT(*) AS total
FROM home_feed_items
GROUP BY content_type
ORDER BY content_type;
```

At that moment, the table contained only:

```text
news → 9
```

This meant that the architecture already supported announcements and international events, but the corresponding content had not yet been added.

---

# 3. Adding Four Announcement Records

Four real announcement records were created in `home_feed_items`.

For each record:

```text
content_type      → event
locale            → ru
slug              → unique
is_published      → 1
deleted_at        → NULL
event_start       → filled
image_path        → filled
```

The records also used content fields already familiar from ordinary news:

```text
title
subtitle
full_text
tags
seo_title
seo_description
```

This confirmed that one shared table can support several editorial content types without duplicating the database architecture.

---

# 4. Creating `events-carousel.php`

A separate component was created:

```text
/docs/new-home/api/events-carousel.php
```

It was based on the proven `news-carousel.php` structure but selects:

```sql
WHERE content_type = 'event'
```

The component retrieves announcement-specific fields:

```text
event_start
event_end
event_location
registration_url
```

The visible date uses `event_start` first and falls back to `publication_date` only when necessary.

Simplified logic:

```text
event_start exists
        ↓
show event date

event_start is empty
        ↓
show publication date
```

The component displays:

```text
image
event date
title
location
subtitle
```

---

# 5. Adding the Unified Homepage Section

A second content carousel was inserted after “Studios and Courses”.

The final homepage order became:

```text
Hero
Our News
Studios and Courses
Announcements of the Russian Cultural Centre and International Events
```

The section uses the same universal carousel classes:

```html
class="content-carousel-section"
data-carousel="content"
```

Therefore, no separate JavaScript file was required.

The existing script already processes every matching carousel independently:

```javascript
document.querySelectorAll(
    '[data-carousel="content"]'
);
```

## Final section title

The original temporary heading:

```text
Announcements
```

was replaced with:

```text
Announcements of the Russian Cultural Centre and International Events
```

This title reflects the final editorial decision: `event` and `international` materials will share one homepage container.

---

# 6. Reusing the Shared Article Template

The shared page template was extended from ordinary news to multiple content types.

The main query now accepts:

```sql
AND content_type IN (
    'news',
    'event',
    'international'
)
```

The `SELECT` also includes:

```text
content_type
event_start
event_end
event_location
registration_url
```

This allows the same template to open:

```text
news
announcements
international events
```

The existing pretty route is temporarily reused:

```text
/new-home/ru/news/<slug>
```

A dedicated `/event/` route may be introduced later, but it is not required for the current working architecture.

---

# 7. Diagnosing Broken Announcement Links

At first, clicking announcement cards opened a blank page with:

```text
Новость не найдена.
```

The routing layer was working because the request reached `news.php`. The database record was also verified with SQL:

```sql
SELECT
    id,
    content_type,
    locale,
    slug,
    is_published,
    deleted_at
FROM home_feed_items
WHERE slug = '...';
```

The record existed and had:

```text
content_type  → event
locale        → ru
is_published  → 1
deleted_at    → NULL
```

The final cause was incorrect URL data in `home_feed_items`. After correcting the URL values, the announcement pages opened successfully.

This debugging step demonstrated an important separation of responsibilities:

```text
carousel markup
        ↓
generated href
        ↓
.htaccess route
        ↓
news.php query
        ↓
matching database record
```

A fault in any one layer can produce a visually similar 404 result.

---

# 8. Making the Vertical Sidebar Context-Aware

The existing `latest-news.php` component was originally hard-coded to:

```sql
WHERE content_type = 'news'
```

Therefore, even an announcement page displayed ordinary news in the right column.

The component was rewritten so that it reads the current page type from:

```php
$news['content_type']
```

The allowed values are:

```php
[
    'news',
    'event',
    'international'
]
```

The SQL query now uses a prepared parameter:

```sql
WHERE content_type = ?
```

The bind parameters are:

```php
$stmtLatestItems->bind_param(
    'sss',
    $currentContentType,
    $currentLocale,
    $currentSlug
);
```

The current publication remains excluded by slug.

## Dynamic headings

For Russian pages:

```text
news          → Другие новости
event         → Другие анонсы
international → Другие международные события
```

For Hungarian pages, corresponding localized headings are already prepared.

## Dynamic date choice

For news:

```text
publication_date
```

For announcements and international events:

```text
event_start
```

with fallback to `publication_date`.

---

# 9. Final Editorial Decision

A separate homepage container titled “International Events” will not be created.

Instead:

```text
content_type = event
content_type = international
```

will both be presented in one homepage section:

```text
Announcements of the Russian Cultural Centre and International Events
```

This reduces duplication and makes the homepage more compact.

The database distinction remains useful because it allows:

- different filtering;
- different labels;
- different sidebar headings;
- future archive filtering;
- multilingual editorial control.

The visual container is shared, but the semantic content types remain separate.

---

# Verified Results

## Homepage

- the news carousel is directly below the Hero;
- eight news cards still work;
- “Studios and Courses” remains intact;
- the unified announcements section appears below it;
- four announcement cards are displayed;
- the universal carousel script manages both sections independently.

## Database

- `content_type` supports `news`, `event`, and `international`;
- four `event` records were created;
- announcement slugs and URLs were corrected;
- publication state and soft-delete filters work.

## Article Template

- ordinary news still opens;
- announcement pages now open;
- dynamic SEO remains active;
- the shared template accepts all three content types.

## Vertical Sidebar

- news pages show other news;
- announcement pages show other announcements;
- international-event pages are prepared to show other international events;
- the current item is excluded;
- the limit remains six items.

---

# Key Files

```text
/docs/new-home/index.php
/docs/new-home/news.php
/docs/new-home/api/news-carousel.php
/docs/new-home/api/events-carousel.php
/docs/new-home/includes/latest-news.php
/docs/new-home/css/content-carousel.css
/docs/new-home/js/content-carousel.js
/docs/new-home/.htaccess
```

Database table:

```text
home_feed_items
```

---

# Final Architecture after Day 16

```text
home_feed_items
        ├── news
        ├── event
        └── international
                ↓
        homepage components
        ├── news-carousel.php
        └── events-carousel.php
                ↓
        shared content-carousel.js
                ↓
        shared article template news.php
                ↓
        context-aware sidebar
        ├── Other News
        ├── Other Announcements
        └── Other International Events
```

Homepage presentation:

```text
Hero
Our News
Studios and Courses
Announcements of the Russian Cultural Centre and International Events
```

---

# Technologies Practiced

- safe DOM block relocation
- reusable PHP components
- MySQL `ENUM`
- multiple content types in one table
- prepared SQL statements
- dynamic query filtering
- slug and URL debugging
- shared article templates
- context-aware sidebars
- reusable JavaScript carousels
- soft deletion
- multilingual fallback preparation

---

# Main Achievement of the Day

The website moved from a news-only dynamic system to a reusable multi-type publishing architecture.

```text
news-only homepage
        ↓
second dynamic feed
        ↓
shared article template
        ↓
context-aware related-content sidebar
        ↓
unified editorial architecture
```

The result is already close to the behavior expected from a future CMS editor: one record can automatically appear in a homepage feed, open in a shared article template, receive dynamic SEO, and populate the correct related-content sidebar.

---

# Day Rating

## 5 out of 5

Day 16 deserves the maximum rating because it completed several connected tasks without breaking the existing news system:

- the homepage was reorganized safely;
- the news carousel remained stable;
- four real announcement records were added;
- a second dynamic carousel was launched;
- broken links were diagnosed and fixed;
- the shared template was extended;
- the vertical sidebar became content-type aware;
- the homepage information architecture was simplified by merging announcements and international events into one visual section.

The work produced a real architectural expansion rather than a cosmetic change.

---

# Next Steps

1. Design and build the new CMS editor interface.
2. Add create, edit, publish, unpublish, and soft-delete operations.
3. Add content-type selection for `news`, `event`, and `international`.
4. Connect multilingual Russian and Hungarian content management.
5. Prepare dynamic Hungarian routes and templates.
6. Create archive or repository pages for publications that leave the homepage carousels.
7. Add pagination, filtering, and search to the publication repository.
8. Decide whether to introduce dedicated `/event/` and `/international/` pretty URLs.
9. Extend editorial validation for slugs, dates, images, SEO fields, and links.
10. Gradually replace direct phpMyAdmin editing with the new CMS interface.

**Status:** Day 16 completed.