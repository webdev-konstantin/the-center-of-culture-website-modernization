# Day 11/12 — Building the Dynamic News Page and Integrating CMS Components

**Date:** 2026-07-28  
**Status:** Completed

---

# Development Photos

> You may place 4–6 screenshots here:
>
> - final news page;
> - two-column layout;
> - Latest News sidebar;
> - `news.php` structure;
> - CSS components;
> - restored shared website header.
>
> Example:
>
> ```text
> /images/day11/news-page-final.png
> /images/day11/news-layout.png
> /images/day11/latest-news.png
> /images/day11/news-php.png
> /images/day11/news-css.png
> /images/day11/header-restored.png
> ```

---

# Objective

Transform the static news template into a fully dynamic CMS-driven page while preserving the modern visual style of the redesigned website.

The primary objective was to create a reusable article template that automatically retrieves data from the MySQL database and shares common website components across the entire project.

Target architecture:

```text
Browser
        ↓
news.php
        ↓
MySQL
        ↓
home_feed_items
        ↓
Dynamic Article
        ↓
Latest News Component
```

---

# Completed Tasks

## 1. Connecting Dynamic Article Loading

The news page was fully integrated with the CMS database.

Implemented:

- loading articles by `slug`;
- Prepared Statements;
- published record validation;
- dynamic image loading;
- article tag support;
- automatic HTTP 404 response for missing articles.

### Main Project Files

```text
/docs/news.php
/docs/includes/latest-news.php
/docs/includes/db.php
```

### Main Variables

```php
$slug
$title
$seoTitle
$seoDescription
$imagePath
$visibleDate
$fullText
$tags
```

### Database Table

```text
home_feed_items
```

### Main Fields

```text
id
title
slug
subtitle
full_text
image_path
publication_date
tags
seo_title
seo_description
locale
published
```

### Main SQL Query

```sql
SELECT
    id,
    title,
    slug,
    subtitle,
    full_text,
    image_path,
    publication_date,
    tags,
    seo_title,
    seo_description
FROM home_feed_items
WHERE slug = ?
AND locale = 'ru'
AND published = 1
LIMIT 1;
```

### Workflow

```text
URL
        ↓
slug
        ↓
Prepared Statement
        ↓
MySQL
        ↓
fetch_assoc()
        ↓
PHP Variables
        ↓
HTML Template
```

---

## 2. Dynamic SEO Integration

All essential SEO metadata is now loaded automatically from the database.

Implemented:

- page title;
- meta description;
- publication date;
- article tags;
- Open Graph preparation.

### Database Fields

```text
seo_title
seo_description
publication_date
tags
```

### HTML Head Generation

```php
<title><?= $seoTitle ?></title>

<meta
    name="description"
    content="<?= $seoDescription ?>">
```

### Architecture

```text
MySQL
        ↓
SEO Fields
        ↓
PHP
        ↓
HTML Head
        ↓
Browser
```

---

## 3. Building a Component-Based Page Structure

The page was divided into reusable components to simplify future maintenance and development.

Components:

- Header;
- News Article;
- Latest News;
- Footer.

### Project Structure

```text
/docs
│
├── news.php
│
├── css
│      ├── header.css
│      └── news.css
│
├── includes
│      ├── header.php
│      ├── latest-news.php
│      └── db.php
│
└── img
```

### Component Includes

```php
<?php include __DIR__.'/includes/header.php'; ?>

<?php include __DIR__.'/includes/latest-news.php'; ?>
```

### Page Architecture

```text
news.php
      │
      ├── Header
      ├── News Article
      ├── Latest News
      └── Footer
```

### Rendering Workflow

```text
Browser
        ↓
news.php
        ↓
include()
        ↓
Header
        ↓
Latest News
        ↓
HTML Output
```

---

## 4. Building the New Page Layout

A modern two-column article layout was developed.

The primary goal was to create a clean, balanced design comparable to modern cultural institution websites.

Desktop Layout:

```text
+--------------------------------------+----------------------+
|                                      |                      |
|            ARTICLE                   |    LATEST NEWS       |
|                                      |                      |
|                                      |                      |
+--------------------------------------+----------------------+
```

Tablet & Mobile Layout:

```text
ARTICLE

↓

LATEST NEWS
```

### Main CSS Files

```text
/docs/css/news.css
/docs/css/header.css
```

### Main CSS Components

```text
.news-page
.news-layout
.news-content-row
.news-content-main
.news-article
.latest-news
```

### Primary CSS Grid

```css
.news-content-row{

    display:grid;

    grid-template-columns:
        minmax(0,900px)
        300px;

    gap:32px;

    align-items:start;

}
```

### Final Page Structure

```text
news-page
        │
        ├── article
        │       ├── title
        │       ├── tags
        │       ├── image
        │       └── text
        │
        └── latest-news
```

---
## 5. Configuring the Article Featured Image

The featured image was fully integrated into the new page structure and became part of the reusable news template.

Implemented:

- automatic image loading from the database;
- responsive scaling while preserving aspect ratio;
- proper rendering on different screen resolutions;
- placement inside the main article column;
- unified styling across all news articles.

### Primary Data Source

```text
home_feed_items.image_path
```

### Main Variable

```php
$imagePath
```

### Main HTML Structure

```html
<figure class="news-article-media">

    <img
        class="news-article-image"
        src="<?= htmlspecialchars($imagePath) ?>"
        alt="<?= htmlspecialchars($title) ?>">

</figure>
```

### Main CSS Components

```text
.news-article-media
.news-article-image
```

### Final CSS Configuration

```css
.news-article-image{

    display:block;

    width:100%;

    height:auto;

    border-radius:12px;

}
```

### Rendering Workflow

```text
MySQL
        ↓
image_path
        ↓
PHP
        ↓
<img>
        ↓
Responsive Image
```

---

## 6. Integrating the "Latest News" Component

A reusable sidebar component was integrated to automatically display the latest published news articles.

Features:

- automatic retrieval of recent publications;
- article thumbnails;
- publication dates;
- links to full articles;
- consistent appearance across the website.

### Main File

```text
/docs/includes/latest-news.php
```

### Database Fields

```text
title
slug
image_path
publication_date
```

### Component Include

```php
<?php include __DIR__.'/includes/latest-news.php'; ?>
```

### Component Workflow

```text
Database
        ↓
Latest News Query
        ↓
latest-news.php
        ↓
Sidebar
```

### Page Layout

```text
.news-content-row

        │

        ├── Article

        └── Latest News
```

---

## 7. Integrating the Shared Website Header

The news page was migrated to the shared website header used throughout the project.

This eliminated duplicated code and ensured a consistent visual identity across all pages.

Integrated:

- website logo;
- main navigation;
- language switcher;
- contact button;
- social media links.

### Main File

```text
/docs/includes/header.php
```

### Component Include

```php
<?php include __DIR__.'/includes/header.php'; ?>
```

### Resources

```text
/img/orosz-kulturális-központ.web-site.png
/css/header.css
```

### Header Components

```text
.logo
.main-menu
.top-actions
.language-switcher
.social-links
```

### Rendering Flow

```text
Browser
        ↓
news.php
        ↓
header.php
        ↓
Shared Website Header
```

---

## 8. Final Visual Refinement

After all components had been integrated, the final visual adjustments were completed.

The primary objective was to achieve a clean, balanced, and modern layout while preserving full responsiveness.

Configured:

- overall page width;
- centered page composition;
- featured image dimensions;
- spacing between content blocks;
- sidebar width;
- consistent visual styling.

### Main CSS Files

```text
/docs/css/news.css
/docs/css/header.css
```

### Key Layout Parameters

```text
Maximum Page Width

1320 px

↓

Main Content Column

≈900 px

↓

Sidebar

≈300 px
```

### Main CSS Components

```text
.news-page
.news-layout
.news-content-row
.news-content-main
.news-article
.latest-news
```

### Final Page Architecture

```text
Browser
        ↓
Header
        ↓
News Layout

        ├── Article

        │       ├── Date
        │       ├── Title
        │       ├── Tags
        │       ├── Featured Image
        │       └── Article Text

        └── Latest News

                ├── Thumbnail
                ├── Date
                └── Article Link

        ↓

Footer
```

### Final Project Structure

```text
/docs

├── news.php

├── css
│      ├── header.css
│      └── news.css

├── includes
│      ├── header.php
│      ├── latest-news.php
│      └── db.php

├── img

└── api
```

---
