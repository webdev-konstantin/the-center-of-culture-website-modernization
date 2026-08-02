# Day 17 — Building Publication Repositories, the News and Media Overview, and the Events Calendar

**Date:** 2026-08-02  
**Status:** Completed  
**Day Rating:** 5/5

---

# What Was Done — In Plain Language

Day 17 transformed the dynamic homepage feeds into a complete publication storage, navigation, and search system.

Before this work, news and announcements were already loaded from the `home_feed_items` table, but visitors mainly interacted with the limited homepage carousels. Older records remained in the database, yet there was no convenient public interface for browsing all publications.

During the day, the project received:

```text
a shared “News and Media” overview page
        ↓
a complete news repository
        ↓
a combined announcements and international-events repository
        ↓
search, filtering, pagination, and a calendar
```

The homepage also received two professional navigation links:

```text
All News and Media →
All Announcements and Events →
```

Pretty URLs were configured:

```text
/new-home/ru/media/
/new-home/ru/news/
/new-home/ru/events/
```

A two-month calendar was developed for announcements and international events. It supports date-range selection, quick periods, apply and reset actions, and synchronization with the existing MySQL server-side filtering.

As a result, the homepage keeps its role as a compact showcase while the full content collection now has its own multi-level navigation architecture.

---

# Main Objectives

1. Define the archive architecture for news, announcements, and international events.
2. Preserve three logical content types while launching two public repositories.
3. Create a universal repository configuration.
4. Implement safe SQL search, filtering, sorting, and pagination.
5. Create one reusable card template for all publication types.
6. Build an adaptive repository grid.
7. Assemble the working `repository.php` page.
8. Connect the news repository to the database.
9. Diagnose and fix the MySQL connection error.
10. Add the “All News and Media” link to the homepage.
11. Design the `media.php` overview page with three semantic sections.
12. Add the right-side “On This Page” navigator.
13. Configure pretty routes through `.htaccess`.
14. Create the combined announcements and international-events repository.
15. Develop the two-month interactive calendar.
16. Connect the calendar to `date_from` and `date_to`.
17. Make the calendar compact and visually close to the selected reference.
18. Move quick periods, Apply, and Reset into the right column.
19. Add the “All Announcements and Events” link to the homepage.
20. Verify the full user journey from the homepage to an individual publication.

---

# Initial State

At the beginning of Day 17:

- `home_feed_items` already contained news and four announcement records;
- the homepage displayed two dynamic carousels;
- news, announcements, and international events opened through one shared template;
- the related-content sidebar already respected the publication type;
- older records remained in the database, but there was no public repository page;
- no full-text publication search existed;
- date-range filtering had not been implemented;
- pagination did not exist;
- there was no shared “News and Media” page;
- no pretty URLs existed for the overview and repository pages;
- no large events-calendar interface existed;
- the homepage had no links to complete publication catalogs.

---

# 1. Publication Repository Architecture

The project preserved three logical content types:

```text
news          → news
event         → Russian Cultural Centre announcements
international → international events
```

At the first public stage, two full repositories are enabled:

```text
news
→ content_type = news

events
→ content_type IN ('event', 'international')
```

A separate `international` collection is already described in the configuration but remains disabled as a standalone public page.

Therefore:

```text
three editorial types
        ↓
two public repositories
        ↓
future separation without moving database records
```

## Showcase and Full Catalog Principle

The homepage remains a showcase of recent materials:

```text
limited carousel
        ↓
only several current cards
```

The repository has a different purpose:

```text
all published materials
        ↓
search
        ↓
filters
        ↓
pagination
```

When a new record pushes an older one out of a carousel because of `LIMIT`, the older publication is not deleted and remains available in the complete repository.

---

# 2. Creating `repository-config.php`

A new configuration file was created:

```text
/docs/new-home/includes/repository-config.php
```

It stores settings without executing SQL or rendering HTML.

The configuration defines:

```text
project_base_path → /new-home
items_per_page    → 12
allowed_locales   → ru, hu
```

It also defines the three collections:

```php
'news' => [
    'enabled' => true,
    'content_types' => ['news'],
    'route' => 'news',
    'date_field' => 'publication_date',
    'sort_mode' => 'newest_first'
]
```

```php
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

```php
'international' => [
    'enabled' => false,
    'content_types' => ['international']
]
```

This separates editorial rules from page rendering and avoids duplicating hard-coded logic.

---

# 3. Creating `repository-query.php`

A universal SQL component was created:

```text
/docs/new-home/includes/repository-query.php
```

It handles:

```text
MySQL connection validation
configuration validation
collection validation
locale validation
search processing
date-range processing
content-type filtering
total record count
pagination calculation
current-page retrieval
```

## Search

The search checks:

```sql
title
subtitle
tags
event_location
```

The condition uses prepared parameters:

```sql
(
    title LIKE ?
    OR subtitle LIKE ?
    OR tags LIKE ?
    OR event_location LIKE ?
)
```

## Date Range

News uses:

```text
publication_date
```

Events use:

```sql
COALESCE(
    event_start,
    publication_date
)
```

Therefore:

```text
event_start exists
        ↓
filter by event date

event_start is missing
        ↓
fall back to publication date
```

## Pagination

A count query runs first:

```sql
SELECT COUNT(*) AS total
FROM home_feed_items
WHERE ...
```

The system then calculates:

```text
total_items
items_per_page
current_page
total_pages
offset
```

The main query retrieves only the requested page:

```sql
LIMIT ?
OFFSET ?
```

## Sorting

News:

```text
newest first
```

Announcements and international events:

```text
nearest future events first
then past events from newest to oldest
```

---

# 4. Creating the Shared Card Template

A reusable file was created:

```text
/docs/new-home/includes/repository-card.php
```

One template supports:

```text
news
event
international
```

Each card can display:

```text
image
publication type
date or date range
title
location
summary
link to the detailed page
```

## Dynamic Labels

```text
news          → News
event         → RCC Announcement
international → International Event
```

## Link Building

At the current stage, all content types reuse the shared publication route:

```text
/new-home/{locale}/news/{slug}
```

The reading-position anchor is preserved:

```text
#news-reading
```

## Date Formatting

News uses `publication_date`.

Announcements and international events use:

```text
event_start
event_end
```

When both dates differ, the card displays a range.

---

# 5. Adaptive Repository Styling

A new stylesheet was created:

```text
/docs/new-home/css/repository.css
```

All classes use the isolated prefix:

```text
repository-
```

This prevents conflicts with the Hero, carousels, and other homepage sections.

## Card Grid

Desktop:

```text
3 cards per row
```

Tablet:

```text
2 cards per row
```

Mobile:

```text
1 card per row
```

The stylesheet also covers:

- page heading;
- search bar;
- date inputs;
- type filters;
- buttons;
- cards;
- empty states;
- error messages;
- pagination;
- overview page;
- right-side navigator;
- events calendar.

---

# 6. Assembling `repository.php`

The main repository page was created at:

```text
/docs/new-home/repository.php
```

It connects:

```text
repository-config.php
        ↓
MySQL connection
        ↓
repository-query.php
        ↓
repository-card.php
        ↓
repository.css
```

The page supports:

```text
collection
locale
q
type
date_from
date_to
page
```

Technical URLs used during testing:

```text
/new-home/repository.php?collection=news&locale=ru
/new-home/repository.php?collection=events&locale=ru
```

Each page renders:

- localized heading;
- meta description;
- section description;
- search;
- filters;
- result count;
- cards;
- pagination.

---

# 7. Diagnosing the MySQL Connection

The first repository test produced:

```text
php_network_getaddresses:
getaddrinfo failed:
Name or service not known
```

The page itself already rendered correctly:

- the Header loaded;
- CSS worked;
- the heading appeared;
- the search form was visible;
- the page displayed “Unable to load publications”.

This isolated the problem to the database connection.

Cause:

```text
incorrect MySQL host value in repository.php
```

The working `new mysqli(...)` block was copied from an already functioning server component.

After the correction, the repository loaded eight published news records from `home_feed_items`.

This confirmed the value of separating presentation and data access:

```text
HTML and CSS work
        ↓
the error is limited to MySQL
        ↓
correct the connection
        ↓
data appears without rebuilding the interface
```

---

# 8. Launching the News Repository

After the database connection was corrected, the full news catalog became available.

It displays:

```text
Our News
news search
date range
result count
card grid
pagination when records exceed 12
```

Verified result:

```text
Publications found: 8
```

The homepage received the link:

```text
All News and Media →
```

Initially, it temporarily opened the technical news repository directly.

The architecture was then refined: because the link name includes more than news, it should open a shared overview page rather than one specific archive.

---

# 9. Creating `media.php`

A new file was created:

```text
/docs/new-home/media.php
```

It acts as a navigation hub:

```text
News and Media
        ├── News
        ├── RCC Announcements
        └── International Events
```

Each section loads up to three recent records from `home_feed_items`.

## News Section

The link opens:

```text
/new-home/ru/news/
```

## RCC Announcements Section

The link opens the combined repository with:

```text
/new-home/ru/events/?type=event
```

## International Events Section

The link uses the same repository with:

```text
/new-home/ru/events/?type=international
```

If no `international` records exist yet, the page shows a localized empty-state message. The architecture is already ready for future content.

---

# 10. Right-Side Navigator

A right-side navigator was added following the selected reference layout:

```text
On This Page

News
RCC Announcements
International Events
```

Section anchors:

```text
#media-news
#media-event
#media-international
```

On desktop, the navigator uses:

```css
position: sticky;
```

On tablets and mobile devices, it moves above the main content.

Verified URLs:

```text
/new-home/ru/media/#media-news
/new-home/ru/media/#media-event
/new-home/ru/media/#media-international
```

---

# 11. Configuring Pretty URLs

The following rules were added to `.htaccess`:

```apache
RewriteRule ^(ru|hu)/media/?$ media.php?locale=$1 [L,QSA,NC]

RewriteRule ^(ru|hu)/news/?$ repository.php?collection=news&locale=$1 [L,QSA,NC]

RewriteRule ^(ru|hu)/events/?$ repository.php?collection=events&locale=$1 [L,QSA,NC]
```

The detailed-publication rule remains below them:

```apache
RewriteRule ^(ru|hu)/news/([a-z0-9-]+)/?$ news.php?locale=$1&slug=$2 [L,QSA,NC]
```

This allows Apache to distinguish:

```text
/ru/news/
→ repository

/ru/news/real-slug
→ detailed publication
```

After verification, technical links in `index.php` and `media.php` were replaced by pretty URLs.

Final public routes:

```text
/new-home/ru/media/
/new-home/ru/news/
/new-home/ru/events/
/new-home/ru/news/<real-slug>
```

---

# 12. Building the Calendar Interface

The full calendar appears only for:

```text
collection = events
```

News keeps the compact date inputs.

The calendar shell in `repository.php` includes:

```text
title
selected period
two months
previous arrow
next arrow
quick periods
actions
```

The calendar receives:

```text
data-calendar-locale
data-calendar-date-from
data-calendar-date-to
```

Russian and Hungarian labels were added to the shared localization array.

Quick periods:

```text
Today
Tomorrow
Next Week
Next Month
```

---

# 13. Creating `repository-calendar.js`

A new JavaScript file was created:

```text
/docs/new-home/js/repository-calendar.js
```

It handles:

- finding the calendar container;
- preventing repeated initialization;
- locating the form and date inputs;
- parsing ISO dates;
- localized formatting;
- rendering two months;
- rendering weekday labels;
- creating 42 date cells per month;
- marking today;
- selecting the start date;
- selecting the end date;
- highlighting the range;
- changing months with arrows;
- handling quick periods;
- synchronizing `date_from` and `date_to`;
- restoring the selected range after reload.

## Range Selection

```text
first click
        ↓
start date

second click
        ↓
end date

days between them
        ↓
highlighted range
```

## Server Connection

JavaScript does not execute SQL.

It only writes values into the existing fields:

```text
date_from
date_to
```

After the user clicks Apply, the browser submits a GET request and `repository-query.php` performs the server-side filtering.

```text
calendar
        ↓
GET parameters
        ↓
prepared SQL query
        ↓
filtered cards
```

---

# 14. Compact Calendar Design

The first calendar version worked but occupied too much vertical space.

After comparison with the selected reference, the interface was redesigned.

Final desktop layout:

```text
‹   first month   second month   ›   Today
                                       Tomorrow
                                       Next Week
                                       Next Month

                                       Apply
                                       Reset
```

The following were reduced:

- internal padding;
- cell height;
- month-title size;
- arrow size;
- right-column width;
- total block height.

The right column became a dedicated action area.

## Progressive Enhancement

The original date inputs were not removed from the HTML.

After successful JavaScript initialization, the form receives:

```text
has-enhanced-calendar
```

Only then does CSS hide the duplicate technical row.

```text
JavaScript works
        ↓
show enhanced calendar
hide technical inputs

JavaScript fails
        ↓
normal date inputs remain available
```

This preserves reliability and server-side filtering accessibility.

---

# 15. Homepage Navigation Links

Below “Our News”, the homepage now displays:

```text
All News and Media →
```

It opens:

```text
/new-home/ru/media/
```

Below “Announcements of the Russian Cultural Centre and International Events”, the homepage now displays:

```text
All Announcements and Events →
```

It opens the calendar repository directly:

```text
/new-home/ru/events/
```

The same shared styles are reused:

```text
content-carousel-title-group
content-carousel-all-link
```

---

# Verified Results

## Homepage

- the news carousel works;
- the announcements carousel works;
- “All News and Media” opens the overview page;
- “All Announcements and Events” opens the calendar repository;
- existing homepage sections remain intact.

## Overview Page

- the “News and Media” heading is displayed;
- three semantic sections are rendered;
- each section has its own destination link;
- the right-side navigator works;
- anchor navigation works;
- adaptive behavior is prepared.

## News Repository

- MySQL connection works;
- eight published news records are displayed;
- search is ready;
- date filtering is ready;
- pagination is calculated;
- cards open detailed publications.

## Events Repository

- the All filter works;
- the RCC Announcements filter works;
- the International Events filter works;
- the calendar displays two months;
- arrows change months;
- manual range selection works;
- quick periods work;
- Apply submits the dates to the server;
- Reset clears the filters;
- cards open detailed publications.

## Pretty URLs

- `/new-home/ru/media/` works;
- `/new-home/ru/news/` works;
- `/new-home/ru/events/` works;
- `/new-home/ru/news/<real-slug>` works;
- technical URLs remain backward-compatible.

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
/docs/new-home/css/content-carousel.css
/docs/new-home/js/repository-calendar.js
/docs/new-home/.htaccess
```

Database table:

```text
home_feed_items
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
        ├── news carousel
        └── announcements and events carousel
                ↓
        “News and Media” overview
        ├── News
        ├── RCC Announcements
        └── International Events
                ↓
        universal repository.php
        ├── collection = news
        └── collection = events
                ↓
        repository-query.php
        ├── search
        ├── filtering
        ├── sorting
        └── pagination
                ↓
        repository-card.php
                ↓
        detailed publication news.php
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
filtered card grid
```

Public navigation:

```text
Homepage
│
├── All News and Media
│   └── /ru/media/
│       ├── /ru/news/
│       ├── /ru/events/?type=event
│       └── /ru/events/?type=international
│
└── All Announcements and Events
    └── /ru/events/
```

---

# Technologies Practiced

- PHP configuration arrays;
- reusable PHP components;
- prepared SQL statements;
- dynamic `bind_param` argument counts;
- SQL `COUNT`, `LIMIT`, and `OFFSET`;
- pagination;
- multi-field search;
- content-type filtering;
- date-range filtering;
- `COALESCE` date fallback;
- dynamic sorting;
- Apache `mod_rewrite` pretty URLs;
- anchor navigation;
- sticky navigation;
- adaptive CSS Grid layouts;
- progressive enhancement;
- JavaScript `Intl.DateTimeFormat`;
- generated calendar grids;
- date-range selection;
- JavaScript and HTML-form synchronization;
- RU/HU localization;
- MySQL connection debugging.

---

# Main Achievement of the Day

The homepage is no longer the only access point to dynamic publications.

The site now has a complete information architecture:

```text
limited homepage carousels
        ↓
shared overview page
        ↓
full repositories
        ↓
search and filters
        ↓
calendar
        ↓
detailed publication
```

Materials that leave the homepage carousels because of card limits now remain automatically accessible in the full catalog.

This is not a temporary archive page. It is a reusable foundation for the future CMS editor, multilingual publishing, larger content volumes, and further content separation.

---

# Day Rating

## 5 out of 5

Day 17 deserves the maximum rating because one work cycle produced a large connected system:

- repository architecture was designed;
- five core repository components were created;
- search, filtering, sorting, and pagination were implemented;
- the MySQL connection was diagnosed and fixed;
- the full news catalog was launched;
- the “News and Media” overview page was created;
- the right-side navigator was added;
- pretty URLs were configured;
- the combined announcements and international-events repository was launched;
- an interactive two-month calendar was implemented;
- the calendar was connected to server-side SQL filtering;
- the interface was refined into a compact professional layout;
- both user journeys were connected to the homepage;
- existing carousels and detailed pages remained intact.

For Konstantin, this is an especially strong result: a complex system was assembled in small, testable steps without rewriting already working parts of the project.

---

# Next Steps

1. Design the new CMS editor interface.
2. Add create, edit, publish, unpublish, and soft-delete operations.
3. Add `content_type` selection: `news`, `event`, or `international`.
4. Add a separate content-format field: article, photo material, or video.
5. Add image upload and replacement through the administration interface.
6. Add automatic slug generation and validation.
7. Connect SEO-field editing.
8. Implement linked Russian and Hungarian publication versions.
9. Prepare Hungarian public routes and verify localized labels.
10. Migrate historical publications from the legacy CMS.
11. Test pagination with more than 12 records.
12. Add tag filtering to the news repository.
13. Add calendar markers on days containing events.
14. Consider dedicated `/event/` and `/international/` detailed-page routes.
15. Configure user roles and secure the administrative editor.
16. Gradually replace direct phpMyAdmin editing with the new CMS interface.

**Status:** Day 17 completed.