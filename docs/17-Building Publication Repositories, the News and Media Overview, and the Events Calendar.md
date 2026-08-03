# Day 17 — Publication Repositories, the News and Media Page, and the Events Calendar

**Date:** 2026-08-02  
**Status:** completed  
**Day rating:** 5/5

---

# What Was Done — In Plain Language

Day 17 transformed the dynamic homepage feeds into a complete publication storage, navigation, and search system.

News and announcements were already loaded from `home_feed_items`, but visitors mainly saw the limited homepage carousels. Older records remained in the database, yet there was no convenient public interface for browsing the complete archive.

The following structure was created:

```text
shared “News and Media” overview
        ↓
complete news repository
        ↓
combined RCC announcements and international-events repository
        ↓
search, filters, pagination, and a two-month calendar
```

The homepage received:

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

An interactive calendar was built for announcements and international events. It supports date-range selection, quick periods, Apply and Reset actions, and synchronization with server-side MySQL filtering.

---

# Main Objectives

1. Design the archive-page architecture.
2. Preserve three content types: `news`, `event`, and `international`.
3. Launch two public repositories: news and events.
4. Create a universal collection configuration.
5. Implement safe SQL search, filtering, sorting, and pagination.
6. Create one shared publication-card template.
7. Assemble `repository.php`.
8. Create the `media.php` overview page.
9. Add the “On This Page” navigator.
10. Configure pretty URLs through `.htaccess`.
11. Build a two-month JavaScript calendar.
12. Connect the calendar to `date_from` and `date_to`.
13. Refine the calendar into a compact reference-based layout.
14. Add homepage navigation links.
15. Verify the complete visitor journey.

---

# 1. Repository Architecture

The database preserves three logical types:

```text
news          → news
event         → RCC announcements
international → international events
```

The first public stage uses two collections:

```text
news
→ content_type = 'news'

events
→ content_type IN ('event', 'international')
```

A standalone `international` collection is already described in configuration but is not yet enabled as a separate public repository.

```php
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
    'fallback_date_field' => 'publication_date',
    'sort_mode' => 'upcoming_then_recent',
    'show_type_filter' => true
]
```

The homepage remains a compact showcase, while the repositories become complete catalogs. When a publication leaves a carousel because of `LIMIT`, it remains available in the archive.

---

# 2. Repository Files

Core components:

```text
/docs/new-home/repository.php
/docs/new-home/includes/repository-config.php
/docs/new-home/includes/repository-query.php
/docs/new-home/includes/repository-card.php
/docs/new-home/css/repository.css
```

Responsibilities:

```text
repository-config.php
→ collection and locale rules

repository-query.php
→ SQL, filters, sorting, pagination

repository-card.php
→ shared news/event/international card

repository.php
→ page assembly

repository.css
→ adaptive presentation
```

---

# 3. SQL Search, Dates, and Pagination

Search covers:

```sql
title
subtitle
tags
event_location
```

The prepared condition is:

```sql
(
    title LIKE ?
    OR subtitle LIKE ?
    OR tags LIKE ?
    OR event_location LIKE ?
)
```

News uses `publication_date`; events use:

```sql
COALESCE(
    event_start,
    publication_date
)
```

Pagination runs a separate `COUNT(*)`, calculates the current page and offset, and applies:

```sql
LIMIT ?
OFFSET ?
```

---

# 4. Working News Repository

After correcting the MySQL connection parameters, the repository began loading published records from `home_feed_items`.

Verified result:

```text
Publications found: 8
```

The page includes:

- heading and description;
- search field;
- date range;
- result count;
- adaptive card grid;
- pagination once the collection exceeds 12 records.

---

# 5. “All News and Media” Homepage Link

The homepage received:

```text
All News and Media →
```

It opens the shared overview rather than a single archive:

```text
/new-home/ru/media/
```

This keeps the homepage compact, uses the overview page for content discovery, and reserves repositories for search and filtering.

---

# 6. Creating `media.php`

`media.php` became a navigation hub:

```text
News and Media
        ├── News
        ├── RCC Announcements
        └── International Events
```

Each block loads up to three recent publications.

Routing:

```text
/news/
→ complete news repository

/events/?type=event
→ RCC announcements

/events/?type=international
→ international events
```

A sticky right-side navigator was added:

```text
On This Page
News
RCC Announcements
International Events
```

Anchors:

```text
#media-news
#media-event
#media-international
```

---

# 7. Announcements and International Events

RCC announcements and international events share one repository while retaining separate `content_type` values.

This gives visitors one calendar now and preserves the option to split the content into independent repositories later without migrating records.

---

# 8. Pretty URLs

The following rules were added:

```apache
RewriteRule ^(ru|hu)/media/?$ \
    media.php?locale=$1 [L,QSA,NC]

RewriteRule ^(ru|hu)/news/?$ \
    repository.php?collection=news&locale=$1 [L,QSA,NC]

RewriteRule ^(ru|hu)/events/?$ \
    repository.php?collection=events&locale=$1 [L,QSA,NC]

RewriteRule ^(ru|hu)/news/([a-z0-9-]+)/?$ \
    news.php?locale=$1&slug=$2 [L,QSA,NC]
```

Rule order distinguishes:

```text
/ru/news/
→ repository

/ru/news/real-slug
→ detailed publication
```

---

# 9. Calendar Interface

The enhanced calendar appears only for:

```text
collection = events
```

The shell includes:

```text
title
selected period
two months
navigation arrows
quick periods
Apply
Reset
```

Quick periods:

```text
Today
Tomorrow
Next Week
Next Month
```

Russian and Hungarian labels were added to the shared localization array.

---

# 10. Creating `repository-calendar.js`

The script handles:

- calendar-container discovery;
- duplicate-initialization protection;
- ISO-date parsing;
- localized formatting;
- two-month rendering;
- 42 cells per month;
- today highlighting;
- range start and end selection;
- intermediate-day highlighting;
- month navigation;
- quick periods;
- synchronization with `date_from` and `date_to`.

```javascript
function handleDateSelection(clickedDate) {
    if (!selectedStart || selectedEnd) {
        selectedStart = clickedDate;
        selectedEnd = null;
    } else if (
        compareDates(clickedDate, selectedStart) < 0
    ) {
        selectedStart = clickedDate;
        selectedEnd = null;
    } else {
        selectedEnd = clickedDate;
    }

    renderCalendar();
}
```

---

# 11. Working Two-Month Calendar

After JavaScript was connected, the interface displayed:

- two neighboring months;
- weekday headings and numbers;
- date-range selection;
- highlighted start and end dates;
- synchronized system fields;
- month navigation.

---

# 12. Final Compact Design

The first working version occupied too much vertical space. It was redesigned to match the selected reference more closely.

Final desktop layout:

```text
‹   first month   second month   ›   Today
                                       Tomorrow
                                       Next Week
                                       Next Month

                                       Apply
                                       Reset
```

Reduced elements:

- internal padding;
- cell height;
- month-title size;
- arrows;
- right-column width;
- total block height.

---

# 13. Progressive Enhancement

The original date fields remain in the HTML. After successful initialization, JavaScript adds:

```javascript
form.classList.add(
    'has-enhanced-calendar'
);
```

Only then does CSS hide the duplicate technical row:

```css
.repository-filter-form.has-enhanced-calendar
.repository-date-row--calendar-sync {
    display: none;
}
```

Fallback behavior:

```text
JavaScript works
→ enhanced calendar is shown
→ technical fields are hidden

JavaScript fails
→ standard date fields remain available
```

---

# 14. “All Announcements and Events” Link

Below the homepage heading for announcements and international events, the following link was added:

```text
All Announcements and Events →
```

Destination:

```text
/new-home/ru/events/
```

The homepage now supports two complete journeys:

```text
All News and Media
→ overview
→ selected repository

All Announcements and Events
→ calendar repository
```

---

# Verified Results

## Homepage

- both carousels work;
- both full-catalog links work;
- existing sections remain intact.

## News and Media Page

- three semantic sections are displayed;
- the right navigator works;
- anchor links work;
- section links open the correct collections.

## News Repository

- MySQL connection works;
- published records are displayed;
- search and date filtering work;
- cards open detailed publications.

## Events Repository

- All, RCC Announcements, and International Events filters work;
- two months are displayed;
- manual range selection works;
- quick periods work;
- Apply submits dates to the server;
- Reset clears filters.

## Pretty URLs

```text
/new-home/ru/media/
/new-home/ru/news/
/new-home/ru/events/
/new-home/ru/news/<slug>
```

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
        homepage — compact showcase
                ↓
        media.php — overview and navigation
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
        news.php — detailed publication
```

Calendar chain:

```text
repository-calendar.js
        ↓
select date_from and date_to
        ↓
GET request
        ↓
repository-query.php
        ↓
MySQL
        ↓
filtered cards
```

---

# Technologies Practiced

- PHP configuration arrays;
- reusable components;
- prepared SQL statements;
- `COUNT`, `LIMIT`, and `OFFSET`;
- multi-field search;
- type and date-range filtering;
- `COALESCE`;
- dynamic sorting;
- Apache `mod_rewrite`;
- anchor and sticky navigation;
- adaptive CSS Grid;
- progressive enhancement;
- `Intl.DateTimeFormat`;
- generated calendar grids;
- JavaScript and HTML-form synchronization;
- RU/HU localization;
- MySQL connection debugging.

---

# Main Achievement

The homepage is no longer the only access point to dynamic publications.

The website now has a complete information architecture:

```text
homepage carousels
        ↓
shared overview
        ↓
complete repositories
        ↓
search and filters
        ↓
calendar
        ↓
detailed publication
```

Materials pushed out of the homepage carousels by card limits remain automatically available in the complete catalog.

---

# Day Rating

## 5 out of 5

Day 17 deserves the maximum rating because one work cycle produced a connected system:

- repository architecture was designed;
- reusable PHP components were created;
- search, filtering, sorting, and pagination were implemented;
- the complete news catalog was launched;
- the News and Media overview was created;
- the navigator was added;
- pretty URLs were configured;
- the combined events repository was launched;
- the two-month calendar was implemented;
- the calendar was connected to server filtering;
- the interface was refined into a compact professional layout;
- both user journeys were connected to the homepage.

For Konstantin, this is an especially strong result: a complex system was assembled in small, testable steps without rewriting already working parts.

---

# Next Steps

1. Design the new CMS editor.
2. Add create, edit, publish, and soft-delete operations.
3. Add `content_type` selection.
4. Connect image upload.
5. Add automatic slug generation.
6. Connect SEO fields.
7. Implement linked Russian and Hungarian versions.
8. Prepare migration of legacy CMS publications.
9. Test pagination with more than 12 records.
10. Add calendar markers for dates containing events.
11. Configure user roles and editor security.
12. Gradually replace direct phpMyAdmin editing.

**Status:** Day 17 completed.