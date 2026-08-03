# Day 17 — Building Publication Repositories, the News and Media Overview, and the Events Calendar

**Date:** 2026-08-02  
**Status:** Completed  
**Day Rating:** 5/5

---

# What Was Done — In Plain Language

Day 17 transformed the limited homepage feeds into a complete publication storage, navigation, search, and filtering system.

The project received:

```text
a shared “News and Media” overview
        ↓
a complete news repository
        ↓
a combined RCC announcements and international-events repository
        ↓
search, filters, pagination, and a two-month calendar
```

The homepage now provides:

```text
All News and Media →
All Announcements and Events →
```

Pretty routes were configured:

```text
/new-home/ru/media/
/new-home/ru/news/
/new-home/ru/events/
```

> **Public-documentation note.** Every image below is based on a real screenshot of the working project. Only browser address bars, server paths, credentials, database parameters, and administrative controls were removed. The interface and code were not redrawn or replaced with invented mock-ups.

---

# Main Objectives

1. Define the publication archive architecture.
2. Preserve `news`, `event`, and `international` content types.
3. Launch two public repositories.
4. Implement search, filtering, sorting, and pagination.
5. Create the shared `media.php` overview.
6. Add right-side section navigation.
7. Configure pretty URLs through `.htaccess`.
8. Build a two-month interactive calendar.
9. Connect the calendar to MySQL server-side filtering.
10. Connect the complete repositories to the homepage.

---

# 1. Repository Architecture

Three editorial types are served by two public collections:

```php
$collections = [
    'news' => [
        'enabled' => true,
        'content_types' => ['news'],
        'route' => 'news',
        'date_field' => 'publication_date',
        'sort_mode' => 'newest_first'
    ],

    'events' => [
        'enabled' => true,
        'content_types' => [
            'event',
            'international'
        ],
        'route' => 'events',
        'date_field' => 'event_start',
        'fallback_date_field' =>
            'publication_date',
        'sort_mode' =>
            'upcoming_then_recent',
        'show_type_filter' => true
    ]
];
```

A standalone `international` collection is already anticipated and can be enabled later without migrating records.

---

# 2. Universal SQL Layer

`repository-query.php` handles search, date ranges, content type, result count, pagination, and sorting.

```php
$dateExpression =
    $collectionKey === 'events'
        ? 'COALESCE(
            event_start,
            publication_date
        )'
        : 'publication_date';

$whereParts[] = '(
    title LIKE ?
    OR subtitle LIKE ?
    OR tags LIKE ?
    OR event_location LIKE ?
)';

$sql .= ' LIMIT ? OFFSET ?';
```

Events use `event_start` and fall back to `publication_date` when necessary.

---

# 3. News Repository

After the MySQL connection was corrected, the repository loaded published records from `home_feed_items` and rendered them in an adaptive grid.

![Working news repository](images/day-17/01-news-repository.jpg)

Verified: cards, search, date range, result count, pagination preparation, and detailed-publication links.

---

# 4. Homepage Entry Point

The homepage now displays “All News and Media →” below the news heading.

![All News and Media homepage link](images/day-17/02-homepage-news-media-link.jpg)

The homepage remains a compact showcase while the repository stores the complete publication history.

---

# 5. Shared `media.php` Overview

The page acts as a navigation hub:

```text
News and Media
├── News
├── RCC Announcements
└── International Events
```

![News and Media overview](images/day-17/03-news-media-overview.jpg)

Routes are generated from one array:

```php
$mediaSections = [
    [
        'class' => 'news',
        'link_url' =>
            $projectBasePath .
            '/' . rawurlencode($locale) .
            '/news/'
    ],
    [
        'class' => 'event',
        'link_url' =>
            $projectBasePath .
            '/' . rawurlencode($locale) .
            '/events/?type=event'
    ],
    [
        'class' => 'international',
        'link_url' =>
            $projectBasePath .
            '/' . rawurlencode($locale) .
            '/events/?type=international'
    ]
];
```

---

# 6. RCC Announcements and International Events

Each semantic section received its own overview block and a link to the combined repository with the appropriate GET filter.

![RCC announcements section](images/day-17/04-announcements-section.jpg)

The right-side navigator uses `#media-news`, `#media-event`, and `#media-international`. It is sticky on desktop and moves above the content on smaller screens.

---

# 7. Pretty URLs

```apache
RewriteRule ^(ru|hu)/media/?$ \
    media.php?locale=$1 \
    [L,QSA,NC]

RewriteRule ^(ru|hu)/news/?$ \
    repository.php?collection=news&locale=$1 \
    [L,QSA,NC]

RewriteRule ^(ru|hu)/events/?$ \
    repository.php?collection=events&locale=$1 \
    [L,QSA,NC]

RewriteRule ^(ru|hu)/news/([a-z0-9-]+)/?$ \
    news.php?locale=$1&slug=$2 \
    [L,QSA,NC]
```

Rule order distinguishes the complete `/news/` repository from `/news/<slug>`.

---

# 8. Working Two-Month Calendar

The enhanced calendar appears only for `collection = events`. It renders two months and supports arrows, quick periods, and range selection.

![Working two-month calendar](images/day-17/05-working-two-month-calendar.jpg)

```javascript
function handleDateSelection(clickedDate) {
    if (!selectedStart || selectedEnd) {
        selectedStart = clickedDate;
        selectedEnd = null;
    } else if (
        compareDates(
            clickedDate,
            selectedStart
        ) < 0
    ) {
        selectedStart = clickedDate;
        selectedEnd = null;
    } else {
        selectedEnd = clickedDate;
    }

    renderCalendar();
}
```

JavaScript writes values to `date_from` and `date_to`; the normal GET request then reaches `repository-query.php`.

---

# 9. Final Compact Calendar

The calendar was reduced and reorganized to match the selected reference:

```text
‹   first month   second month   ›   Today
                                       Tomorrow
                                       Next Week
                                       Next Month

                                       Apply
                                       Reset
```

![Final compact calendar](images/day-17/06-final-compact-calendar.jpg)

The original inputs remain in HTML and are hidden only after successful JavaScript initialization:

```javascript
form.classList.add(
    'has-enhanced-calendar'
);
```

```css
.repository-filter-form.has-enhanced-calendar
.repository-date-row--calendar-sync {
    display: none;
}
```

If JavaScript fails, the standard date inputs remain available. This is progressive enhancement.

---

# 10. Second Homepage Link

“All Announcements and Events →” now opens `/new-home/ru/events/` directly.

```text
Homepage
├── All News and Media
│   └── /ru/media/
│       ├── /ru/news/
│       ├── /ru/events/?type=event
│       └── /ru/events/?type=international
└── All Announcements and Events
    └── /ru/events/
        └── calendar
            └── SQL filtering
```

---

# Verified Results

- Both homepage carousels and both repository links work.
- The overview renders three semantic sections.
- Right-side and anchor navigation work.
- News search, date filtering, cards, and pagination preparation work.
- Event type filters work.
- Two-month rendering, arrows, manual range selection, quick periods, Apply, and Reset work.
- The selected dates are processed by server-side SQL.
- All pretty routes were verified.

---

# Key Files

```text
/docs/new-home/index.php
/docs/new-home/media.php
/docs/new-home/repository.php
/docs/new-home/includes/repository-config.php
/docs/new-home/includes/repository-query.php
/docs/new-home/includes/repository-card.php
/docs/new-home/css/repository.css
/docs/new-home/js/repository-calendar.js
/docs/new-home/.htaccess
```

---

# Architecture after Day 17

```text
home_feed_items
├── news
├── event
└── international
        ↓
homepage showcase
        ↓
News and Media overview
        ↓
repository.php
├── collection = news
└── collection = events
        ↓
repository-query.php
├── search
├── filters
├── sorting
└── pagination
        ↓
repository-card.php
        ↓
news.php
```

---

# Technologies Practiced

- reusable PHP configuration and components;
- prepared SQL queries;
- `COUNT`, `LIMIT`, `OFFSET`, and `COALESCE`;
- multi-field search;
- content-type and date-range filtering;
- Apache `mod_rewrite`;
- anchor and sticky navigation;
- adaptive CSS Grid;
- JavaScript `Intl.DateTimeFormat`;
- generated calendar grids;
- date-range selection;
- progressive enhancement;
- RU/HU localization.

---

# Main Achievement

The homepage is no longer the only access point to dynamic publications. Materials pushed out of limited carousels now remain accessible in full repositories.

---

# Day Rating

## 5 out of 5

One work cycle produced repositories, an overview page, routing, search, filters, pagination, and an interactive calendar without breaking already working components.

---

# Next Steps

1. Design the CMS editor.
2. Add create, edit, publish, and soft-delete operations.
3. Add `content_type` selection.
4. Add image uploads.
5. Implement slug generation and SEO fields.
6. Link Russian and Hungarian versions.
7. Migrate historical legacy-CMS content.
8. Add calendar markers for event dates.
9. Configure user roles and editor security.

**Status:** Day 17 completed.
