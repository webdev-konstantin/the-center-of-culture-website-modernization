# Day 15 — Adding Real News Content and Dynamic SEO Configuration

**Date:** 2026-07-31  
**Status:** Completed  
**Day Rating:** 5/5

---

# What Was Done — In Plain Language

Day 15 proved that the new news architecture works not only with several test records but also with a larger set of real publications.

The completed workflow now looks like this:

```text
one news record is added to MySQL
        ↓
the homepage carousel receives it automatically
        ↓
the shared news.php template opens the full article
        ↓
the article appears in the vertical “Other News” feed
        ↓
its own SEO title and description are generated dynamically
```

The main practical result is that new news items no longer require separate HTML or PHP pages. One database record is enough for all connected components.

---

# Main Objectives

1. Add several real publications to `home_feed_items`.
2. Confirm automatic output in the homepage carousel.
3. Confirm automatic output in the vertical news feed.
4. Finalize the sidebar limit at six publications.
5. Prepare one reliable record structure for copying future news items.
6. Connect `seo_title` and `seo_description` to the dynamic page template.
7. Add safe fallback values when SEO fields are empty.
8. Verify the generated metadata in the final HTML source.

---

# Initial State

At the beginning of the day:

- the dynamic news page already worked;
- pretty URLs were active;
- the homepage carousel used slug-based links;
- the vertical “Other News” component worked;
- only a limited number of real publications existed in the new table;
- SEO fields existed in MySQL but had not yet been fully reviewed and connected to the rendering logic.

---

# 1. Adding Real Publications through phpMyAdmin

New publications were added to:

```text
home_feed_items
```

The safest method was to copy one correctly configured real news record and replace all content-specific values.

## Required fields for a normal news item

```text
id                 → empty / auto increment
content_type       → news
locale             → ru
title              → full publication title
slug               → unique URL identifier
subtitle           → short card description
full_text          → complete article body
image_path         → path to the main image
target_url         → fallback article URL
publication_date   → editorial publication date
is_published       → 1
is_featured        → 0
sort_order         → 0
deleted_at         → NULL
```

Fields related to announcements and events remained `NULL` for ordinary news:

```text
event_start
event_end
event_location
registration_url
```

User audit fields also remained `NULL` at this stage:

```text
created_by
updated_by
```

---

# 2. Understanding the Main Database Fields

## `title`

The full visible article title.

Example:

```text
Международная историческая акция «Диктант Победы» в Будапеште
```

## `slug`

The unique machine-readable address segment:

```text
diktant-pobedy-v-budapeshte
```

The final URL becomes:

```text
/new-home/ru/news/diktant-pobedy-v-budapeshte
```

## `subtitle`

A short introduction used in the homepage card and as an SEO fallback description.

## `full_text`

The complete article body. It can contain simple HTML paragraphs:

```html
<p>First paragraph of the publication.</p>
<p>Second paragraph of the publication.</p>
```

## `image_path`

Example:

```text
/new-home/img/diktant-pobedy-v-budapeshte.jpeg
```

## `publication_date`

The date used for chronological sorting on the website.

## `created_at` and `updated_at`

These fields record when the database row was actually created or edited.

In phpMyAdmin, the function was set to:

```text
NOW
```

while the value field itself was left empty.

Correct logic:

```text
publication_date → editorial date of the news item
created_at       → actual database insertion time
updated_at       → actual last editing time
```

---

# 3. Avoiding the `NOW()` Input Error

An insertion warning appeared because `NOW` was selected in the function column while an old date remained in the value field.

Incorrect combination:

```text
Function: NOW
Value:    2026-04-24 01:11:54
```

Correct combination:

```text
Function: NOW
Value:    empty
```

`NOW()` generates the timestamp itself and does not require a manual value.

---

# 4. Adding Tags and SEO Fields

The database already supported:

```text
tags
seo_title
seo_description
```

## Tags

Tags may be stored as comma- or semicolon-separated values:

```text
Диктант Победы, Будапешт, историческая память, Российский культурный центр
```

The page template later converts them into visible tag labels.

## SEO title

Example:

```text
Диктант Победы в Будапеште | Российский культурный центр
```

## SEO description

Example:

```text
В Российском культурном центре в Будапеште состоялась международная историческая акция «Диктант Победы».
```

These values do not require approval from a domain registrar, hosting provider, or search engine. They are normal HTML metadata controlled by the website owner.

---

# 5. Confirming the Homepage Carousel with Eight News Items

After adding several real records, the homepage displayed:

```text
8 news cards
```

This confirmed that:

- `news-carousel.php` retrieves the records correctly;
- the configured `LIMIT 8` is respected;
- `index.php` does not require manual card creation;
- the carousel JavaScript calculates the necessary pages automatically;
- each card receives its title, date, image, subtitle, and URL from MySQL.

Simplified flow:

```text
home_feed_items
        ↓
news-carousel.php
        ↓
8 generated cards
        ↓
content-carousel.js
        ↓
responsive carousel pages
```

---

# 6. Final Sidebar Decision: Six Other News Items

The “Other News” column was tested with a larger dataset.

The final design decision was:

```php
$otherNewsLimit = 6;
```

The component now performs this logic:

```text
select published news
        ↓
exclude soft-deleted records
        ↓
exclude records without a slug
        ↓
exclude the article currently open
        ↓
sort newest to oldest
        ↓
show no more than 6
```

The SQL ordering remains:

```sql
ORDER BY
    publication_date DESC,
    id DESC
LIMIT {$otherNewsLimit}
```

The previous limit of three is now considered an intermediate design setting.

---

# 7. Removing Double Escaping from `image_path`

The image path should remain a normal PHP string until it is printed into HTML.

Correct preparation:

```php
$imagePath = trim(
    (string) ($news['image_path'] ?? '')
);
```

Correct output:

```php
src="<?= htmlspecialchars(
    $imagePath,
    ENT_QUOTES,
    'UTF-8'
) ?>"
```

Correct data flow:

```text
MySQL value
        ↓
raw PHP string
        ↓
HTML escaping only at output
```

This avoids double escaping while preserving safe HTML output.

---

# 8. Connecting Dynamic SEO Fields to `news.php`

The SQL query already retrieves:

```sql
seo_title,
seo_description
```

The page now prepares these values without escaping them too early:

```php
$seoTitle = trim(
    (string) ($news['seo_title'] ?? '')
);

if ($seoTitle === '') {
    $seoTitle = trim(
        (string) ($news['title'] ?? '')
    );
}

$seoDescription = trim(
    (string) ($news['seo_description'] ?? '')
);

if ($seoDescription === '') {
    $seoDescription = trim(
        (string) ($news['subtitle'] ?? '')
    );
}
```

## Plain-language explanation

```text
seo_title exists
        ↓
use seo_title

seo_title is empty
        ↓
use the normal article title
```

The same fallback applies to the description:

```text
seo_description exists
        ↓
use it

seo_description is empty
        ↓
use subtitle
```

This allows older or incomplete records to remain usable without producing an empty `<title>` or missing description.

---

# 9. Safe SEO Output in the HTML `<head>`

The title is rendered as:

```php
<title><?= htmlspecialchars(
    $seoTitle,
    ENT_QUOTES,
    'UTF-8'
) ?></title>
```

The description is rendered only when it is not empty:

```php
<?php if ($seoDescription !== ''): ?>

    <meta
        name="description"
        content="<?= htmlspecialchars(
            $seoDescription,
            ENT_QUOTES,
            'UTF-8'
        ) ?>"
    >

<?php endif; ?>
```

`htmlspecialchars()` protects the generated HTML from special characters in database values.

---

# 10. Verifying Dynamic SEO in the Browser

The final output was checked in two ways.

## Browser tab

The browser tab displayed the value from:

```text
seo_title
```

## Page source

Using:

```text
Ctrl + U
```

and then searching for:

```html
<title>
```

and:

```text
name="description"
```

confirmed that each article receives its own metadata.

A second article with empty SEO fields was also checked. The fallback logic correctly used:

```text
title    → <title>
subtitle → meta description
```

---

# 11. What Dynamic SEO Does and Does Not Do

Dynamic metadata helps search engines understand and present each page correctly.

```text
unique article data
        ↓
unique <title>
        ↓
unique meta description
        ↓
clearer search-result presentation
```

However, these fields alone do not guarantee top search positions. Ranking also depends on content quality, relevance, crawlability, links, performance, mobile usability, and many other signals.

The test version is still protected by Basic Authentication and `noindex`, so the SEO implementation is currently being prepared and tested rather than indexed publicly.

---

# Verified Results

## Database

- several additional real news records were created;
- ordinary news records use `content_type = news`;
- event-only fields remain `NULL`;
- publication dates and audit timestamps are separated correctly;
- tags and SEO fields can be stored independently for each article.

## Homepage

- eight news cards are displayed;
- all cards are generated dynamically;
- no manual editing of `index.php` was needed.

## News page

- the shared template renders every new publication;
- pretty URLs work for new slugs;
- the sidebar displays six other news items;
- the current article is excluded;
- dynamic title and description metadata work.

---

# Key Files

```text
/docs/new-home/news.php
/docs/new-home/includes/latest-news.php
/docs/new-home/api/news-carousel.php
/docs/new-home/js/content-carousel.js
/docs/new-home/css/news.css
```

Database table:

```text
home_feed_items
```

---

# Final Architecture after Day 15

```text
editorial news data
        ↓
home_feed_items
        ├── title
        ├── slug
        ├── subtitle
        ├── full_text
        ├── image_path
        ├── publication_date
        ├── tags
        ├── seo_title
        └── seo_description
                ↓
        PHP components
        ├── homepage carousel: up to 8 items
        ├── dynamic article page
        └── “Other News” sidebar: up to 6 items
                ↓
        safe HTML output and dynamic SEO
```

---

# Technologies Practiced

- MySQL content modeling
- phpMyAdmin record copying
- SQL `NULL`
- `NOW()` timestamps
- PHP fallback logic
- dynamic metadata
- HTML escaping
- slug-based routing
- dynamic carousel population
- reusable page templates
- browser source inspection

---

# Main Achievement of the Day

The news system was successfully tested at a realistic content scale.

```text
multiple real records
        ↓
8 homepage cards
        ↓
shared article template
        ↓
6 related-news links
        ↓
unique dynamic SEO for every page
```

The system now demonstrates the core behavior expected from the future CMS editor: content is entered once and automatically appears in every required part of the site.

---

# Day Rating

## 5 out of 5

The day produced a complete and verifiable result:

- real news content was added;
- database copying rules were clarified;
- common phpMyAdmin input errors were resolved;
- eight homepage cards were confirmed;
- six sidebar items were finalized;
- dynamic SEO fields were connected;
- safe fallback logic was implemented;
- generated HTML metadata was verified successfully.

---

# Next Steps

1. Review the existing `content_type` values for announcements and international events.
2. Analyze the current static “Announcements” section in `index.php`.
3. Create or adapt a dynamic PHP component for announcements.
4. Reuse the existing carousel behavior where appropriate.
5. Define pretty URL routing for announcement pages.
6. Later transfer the same architecture to “International Events”.
7. Begin planning the CMS editor for creating and editing content without phpMyAdmin.

**Status:** Day 15 completed.