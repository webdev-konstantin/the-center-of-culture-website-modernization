# Day 14 — Pretty URLs, Vertical News Feed and Final Dynamic News Page Configuration

**Date:** 2026-07-30  
**Status:** Completed  
**Day Rating:** 5/5

---

# Development Process Photos

> Suggested screenshots:
>
> - a working pretty URL for a news article;
> - the “Other News” sidebar;
> - the rebuilt news page layout;
> - navigation to another article at the reading position;
> - the soft-deleted test publication;
> - a homepage carousel card using the new URL format.
>
> Example structure:
>
> ```text
> /images/day14/pretty-url.png
> /images/day14/other-news-sidebar.png
> /images/day14/news-page-layout.png
> /images/day14/anchor-navigation.png
> /images/day14/soft-delete.png
> /images/day14/homepage-carousel-url.png
> ```

---

# Objective

Complete the technical configuration of dynamic news pages after moving the project into the permanent `/docs/new-home/` working directory.

Main goals:

1. Implement human-readable news URLs.
2. Preserve compatibility with old addresses.
3. Complete the vertical “Other News” component.
4. Limit it to three recent publications.
5. Exclude the currently opened article.
6. Safely remove the test publication.
7. Rebuild the news page layout.
8. Improve navigation between articles.
9. Prepare the homepage carousel to use the same pretty URLs.

---

# Initial State

News pages were previously opened through technical addresses such as:

```text
/new-home/news.php?slug=den-russkogo-yazyka-v-rkc
```

The vertical news component worked only partially:

- several records were missing a `slug`;
- the number of cards did not match the intended layout;
- the current article affected the final result set;
- the test article was still published;
- navigation to another article returned the user to the top of the page;
- the date and title were placed above the entire two-column layout;
- the “Back to homepage” link remained inside the article column.

---

# Completed Tasks

## 1. Implementing Pretty URLs with Apache mod_rewrite

A routing rule was added to the test project `.htaccess` file:

```apache
RewriteRule ^(ru|hu)/news/([a-z0-9-]+)/?$ news.php?locale=$1&slug=$2 [L,QSA,NC]
```

New URL format:

```text
/new-home/ru/news/den-russkogo-yazyka-v-rkc
```

Routing flow:

```text
Pretty URL
        ↓
Apache mod_rewrite
        ↓
news.php?locale=ru&slug=...
        ↓
MySQL
        ↓
Dynamic article page
```

Legacy addresses remain functional, so the migration was completed without forcing redirects and without breaking existing links.

---

## 2. Locale Support in the Dynamic News Template

The `news.php` template now reads and validates the locale parameter:

```php
$locale = strtolower(
    trim((string) ($_GET['locale'] ?? 'ru'))
);
```

Allowed locales:

```php
$allowedLocales = [
    'ru',
    'hu'
];
```

The SQL query now retrieves a publication by both `slug` and `locale`:

```sql
WHERE slug = ?
  AND content_type = 'news'
  AND locale = ?
  AND is_published = 1
  AND deleted_at IS NULL
```

This prepares the page template for the future Hungarian version.

---

## 3. Filling Missing Slugs

A diagnostic SQL query showed that several real publications had:

```text
slug = NULL
```

Because of this, the “Other News” component skipped them and displayed only one card.

Unique slugs were added:

```text
na-territorii-hrama-usypalnitsy
muzykalnyy-podarok-dlya-gostey-rkc
den-russkogo-yazyka-v-rkc
```

After the database update, all real news items became available to the dynamic query.

---

## 4. Completing the “Other News” Component

Updated file:

```text
/docs/new-home/includes/latest-news.php
```

The component now:

- uses the current locale;
- excludes the opened publication;
- selects only published and non-deleted records;
- ignores records without a slug;
- sorts by publication date in descending order;
- displays no more than three cards;
- generates pretty URLs.

Configured limit:

```php
$otherNewsLimit = 3;
```

Main query:

```sql
SELECT
    id,
    title,
    slug,
    image_path,
    publication_date
FROM home_feed_items
WHERE content_type = 'news'
  AND locale = ?
  AND is_published = 1
  AND deleted_at IS NULL
  AND slug IS NOT NULL
  AND slug <> ''
  AND slug <> ?
ORDER BY
    publication_date DESC,
    id DESC
LIMIT 3
```

---

## 5. Safely Removing the Test Publication

The test record was not physically deleted from the database.

Instead, soft deletion was used:

```sql
UPDATE home_feed_items
SET
    is_published = 0,
    deleted_at = NOW()
WHERE id = 6
  AND slug = 'testovaya-novost'
LIMIT 1;
```

Result:

- the test article disappeared from the homepage;
- it disappeared from the vertical sidebar;
- its pretty URL no longer opens the article;
- the record remains available for restoration;
- the future CMS trash architecture is preserved.

---

## 6. Rebuilding the News Page Layout

The structure of `news.php` was reorganized into a clear two-column layout.

Final structure:

```text
news-page
    ↓
news-layout
    ├── news-article
    │      ├── date
    │      ├── title
    │      ├── tags
    │      ├── image
    │      └── full text
    │
    └── news-sidebar
           ├── “Back to homepage” link
           └── “Other News” component
```

The date, title and main image now belong directly to the left article column.

The link:

```text
← Back to homepage
```

was moved to the right sidebar above the list of other publications.

---

## 7. Navigating Directly to the Reading Area

An anchor target was added to the main page container:

```html
<main
    class="news-page"
    id="news-reading"
>
```

Sidebar links now include:

```text
#news-reading
```

Example:

```text
/new-home/ru/news/den-russkogo-yazyka-v-rkc#news-reading
```

When a user opens another article, the browser moves directly to the reading area instead of returning to the top of the large header.

---

## 8. Completely Cleaning `news.css`

The previous stylesheet contained:

- repeated `.news-page` rules;
- conflicting `.news-layout` definitions;
- multiple `.news-article-media` versions;
- extra closing braces;
- old and new layout rules at the same time.

The stylesheet was fully replaced with one clean and consistent version.

Desktop grid:

```css
.news-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 320px;
    gap: 40px;
    align-items: start;
}
```

On screens below 900 pixels, the columns stack vertically:

```css
@media (max-width: 900px) {
    .news-layout {
        grid-template-columns: 1fr;
    }
}
```

The new stylesheet also defines:

- responsive title sizes;
- 16:9 article images;
- article typography;
- tag styles;
- sidebar layout;
- vertical news cards;
- mobile behavior.

---

## 9. Correct CSS Path and Cache Busting

The working test stylesheet is now connected in `news.php`:

```html
<link rel="stylesheet" href="/new-home/css/news.css?v=20260730-2">
```

The `?v=` parameter forces the browser to load the updated CSS instead of a cached copy.

---

## 10. Removing Double Escaping from the Image Path

The image path variable now stores its original value:

```php
$imagePath = trim(
    (string) ($news['image_path'] ?? '')
);
```

Escaping is performed only when the value is rendered into HTML:

```php
src="<?= htmlspecialchars(
    $imagePath,
    ENT_QUOTES,
    'UTF-8'
) ?>"
```

Correct data flow:

```text
MySQL
    ↓
raw PHP value
    ↓
HTML escaping at output
```

---

## 11. Preparing the Homepage Carousel for Pretty URLs

Reviewed file:

```text
/docs/new-home/api/news-carousel.php
```

The carousel already retrieves up to eight publications:

```sql
LIMIT 8
```

Therefore, `content-carousel.js` did not need to be changed. It already calculates the number of carousel pages from the actual card count.

Slug-based link generation was added to `news-carousel.php`:

```php
$slugValue = trim(
    (string) ($item['slug'] ?? '')
);

if ($slugValue !== '') {
    $targetUrl =
        '/new-home/ru/news/' .
        rawurlencode($slugValue);
}
```

The old `target_url` field remains as a fallback for legacy records without a slug.

Safe output escaping was added:

```php
href="<?= htmlspecialchars(
    $targetUrl,
    ENT_QUOTES,
    'UTF-8'
) ?>"
```

and:

```php
src="<?= htmlspecialchars(
    $imagePath,
    ENT_QUOTES,
    'UTF-8'
) ?>"
```

---

# Prepared Improvements

The following improvements were also prepared for the next implementation step.

## Blue Hover Highlight for News Titles

Prepared CSS:

```css
.latest-news-item:hover .latest-news-title,
.latest-news-item:focus-visible .latest-news-title {
    color: #5367a5;
}
```

This matches the visual language of the horizontal header menu.

## Adding More Publications

It was confirmed that two additional news items do not need to be hard-coded into `index.php` or `content-carousel.js`.

They only need to be added to:

```text
home_feed_items
```

with the required fields:

```text
title
slug
subtitle
full_text
image_path
publication_date
content_type = news
locale = ru
is_published = 1
deleted_at = NULL
```

After that:

- the homepage carousel will receive the cards automatically;
- the sidebar will continue to show only three recent publications;
- article pages will be rendered by the shared `news.php` template.

---

# Verified Files

```text
/docs/new-home/.htaccess
/docs/new-home/news.php
/docs/new-home/css/news.css
/docs/new-home/includes/latest-news.php
/docs/new-home/api/news-carousel.php
/docs/new-home/api/home-feed.php
/docs/new-home/js/content-carousel.js
```

---

# Final News Architecture

```text
Pretty URL
        ↓
.htaccess
        ↓
news.php
        ↓
slug + locale
        ↓
home_feed_items
        ↓
Dynamic article
        ├── date
        ├── title
        ├── tags
        ├── image
        ├── full text
        └── 3 other news items
```

---

# Key Technical Results

### Pretty URLs Implemented

News articles now open through human-readable addresses without visible GET parameters.

### Vertical News Feed Completed

The sidebar displays the three most recent publications while excluding the current article.

### Soft Delete Implemented

The test publication was unpublished without being physically removed from MySQL.

### Navigation Improved

Article-to-article navigation now opens directly at the reading area.

### Page Structure Rebuilt

The article and sidebar are now separated both semantically and visually.

### CSS Cleaned

Conflicts, duplicated rules and syntax errors were removed.

### Homepage Carousel Migrated to Slug Routing

Carousel cards can now use the same pretty URL structure as the vertical sidebar.

---

# Technologies Studied

- Apache `mod_rewrite`
- `.htaccess`
- PHP routing
- URL slugs
- Locale validation
- MySQL prepared statements
- Soft delete
- CSS Grid
- Responsive layout
- Anchor navigation
- HTML escaping
- Cache busting
- Dynamic PHP components

---

# Development Tools

- DirectAdmin File Manager
- phpMyAdmin
- Google Chrome
- Chrome DevTools
- GitHub
- ChatGPT

---

# Main Achievement of the Day

The complete dynamic news user flow is now operational:

```text
Homepage card
        ↓
Pretty URL
        ↓
Article page
        ↓
Reading area
        ↓
Vertical feed with three other articles
        ↓
Navigation to another publication
```

The news pages work reliably, retrieve data from MySQL correctly, and are ready for additional real publications.

---

# Day Rating

## 5 out of 5

The day produced both a visible and architectural result:

- routing works;
- article pages open correctly;
- URLs are human-readable;
- the sidebar is complete;
- the test record is safely hidden;
- navigation is more convenient;
- CSS has been cleaned;
- the carousel is ready for a unified link system.

---

# Next Steps

1. Add two new real publications to `home_feed_items`.
2. Verify their automatic appearance in the homepage carousel.
3. Apply and test the blue title hover effect.
4. Connect the dynamic **Announcements** section.
5. Connect the dynamic **International Events** section.
6. Prepare one editor for creating, editing, publishing and soft-deleting content.

---

# Conclusion

Day 14 completed the dynamic news system of the new website.

```text
MySQL
        ↓
slug + locale
        ↓
Pretty URLs
        ↓
Dynamic article page
        ↓
Responsive layout
        ↓
Vertical news feed
        ↓
Unified carousel routing
```

The project is ready to receive more publications and to reuse the same architecture for the **Announcements** and **International Events** sections.

**Status:** Completed  
**Rating:** 5/5