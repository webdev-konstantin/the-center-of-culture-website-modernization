# Day 9 — Building the Dynamic News Page Architecture and Preparing the CMS for Slug-Based Routing

**Date:** 2026-07-25  
**Status:** Completed

---

# Development Progress Photos

> You can place 5–8 screenshots here:
>
> - extending the `home_feed_items` table;
> - creating the `content_revisions` table;
> - fixing the PHP Parse Error;
> - adding the first `slug`;
> - developing `news.php`;
> - opening the first dynamic news page;
> - final version of the article page.
>
> Example:
>
> ```text
> /images/day09/home-feed-items-extended.png
> /images/day09/content-revisions.png
> /images/day09/php-error-fixed.png
> /images/day09/slug.png
> /images/day09/news-page.png
> /images/day09/final-news-page.png
> ```

---

# Goal of the Day

Prepare the new CMS architecture for fully dynamic individual news pages.

Target architecture:

```text
Home Page
      ↓
News Card
      ↓
Slug
      ↓
news.php
      ↓
MySQL
      ↓
Full Article
```

---

# Completed Tasks

## 1. Extending the Publications Database Structure

The

```text
home_feed_items
```

table was expanded to support a fully featured CMS.

New fields were added:

- slug
- full_text
- seo_title
- seo_description
- tags
- created_at
- updated_at
- deleted_at
- created_by
- updated_by

The database is now capable of storing complete articles together with SEO metadata.

Architecture:

```text
home_feed_items
        ↓
News Card
+
Full Article
+
SEO
+
Revision Support
```

---

## 2. Creating the Revision History Table

A dedicated table

```text
content_revisions
```

was created to store the history of content modifications.

The table is designed to record:

- entity type;
- record ID;
- operation type;
- previous state;
- new state;
- author;
- modification timestamp.

Architecture:

```text
Content Editing
        ↓
content_revisions
        ↓
Revision History
```

---

## 3. Fixing a Critical PHP Syntax Error

While modifying

```text
news-carousel.php
```

a PHP error occurred:

```text
Parse error
unexpected '|'
```

The cause was an incorrectly opened block comment.

After correcting the syntax:

- PHP execution was restored;
- the carousel began rendering correctly again;
- the file structure became fully valid.

---

## 4. Updating the SQL Query

The SQL query responsible for loading news cards was extended.

New fields:

- slug
- tags

Soft-delete filtering was also introduced:

```sql
deleted_at IS NULL
```

Architecture:

```text
MySQL
        ↓
SQL
        ↓
Published Content Only
```

---

## 5. Introducing the First Slug

The first publication received its unique slug:

```text
nastoyaschiy-russkiy-duh
```

A new identification mechanism was introduced.

Instead of:

```text
?id=15
```

the project now uses:

```text
slug
```

Architecture:

```text
News Card
        ↓
Slug
        ↓
Unique Article
```

---

## 6. Creating the First Dynamic News Page

A new file

```text
news.php
```

was developed.

Implemented features:

- reading the slug from the URL;
- validating the parameter;
- prepared SQL query;
- loading article data;
- rendering the page dynamically.

Architecture:

```text
URL
        ↓
Slug
        ↓
PHP
        ↓
MySQL
        ↓
HTML
```

---

## 7. Implementing Secure Database Access

For the first time in the project, article loading uses prepared statements.

Implemented methods:

- prepare()
- bind_param()
- execute()
- get_result()

Architecture:

```text
URL
        ↓
Prepared Statement
        ↓
MySQL
```

This significantly improves application security.

---

## 8. Building a Responsive Article Layout

A completely new article page was designed.

Implemented:

- SEO title;
- SEO description;
- publication date;
- article headline;
- subtitle;
- large featured image;
- full article body;
- back-to-home link.

Responsive layouts were prepared for:

- Desktop;
- Tablet;
- Mobile.

---

## 9. Testing the First Dynamic Article

The following URL was successfully tested:

```text
news.php?slug=nastoyaschiy-russkiy-duh
```

Verified:

- slug retrieval;
- SQL execution;
- article loading;
- correct HTML rendering;
- no PHP errors.

---

## 10. Establishing the New Publishing Workflow

A complete publication flow has now been achieved.

```text
Home Page
        ↓
News Card
        ↓
Slug
        ↓
news.php
        ↓
Prepared SQL
        ↓
MySQL
        ↓
Full Article
```

---

# Final Architecture

```text
phpMyAdmin
        ↓
home_feed_items
        ↓
Slug
        ↓
Prepared SQL
        ↓
PHP
        ↓
HTML
        ↓
CSS
        ↓
Dynamic News Page
```

---

# Key Technical Achievements

### First Fully Dynamic News Page

For the first time, an individual news article is generated directly from the database.

---

### Modern URL Architecture

The project begins moving away from numeric IDs toward meaningful slugs.

```text
slug
```

This forms the basis for SEO-friendly URLs.

---

### First Use of Prepared Statements

Secure database access has been implemented using prepared SQL statements.

---

### Revision System Foundation

The project now includes a dedicated infrastructure for tracking content revisions.

---

### CMS Architecture Expansion

The project architecture now includes:

```text
Home Page
        ↓
News Card
        ↓
Full Article
```

This represents the next major milestone in the CMS development.

---

# Technologies Studied

- PHP
- MySQL
- SQL
- phpMyAdmin
- mysqli
- Prepared Statements
- bind_param()
- get_result()
- HTML5
- CSS3
- SEO Meta Tags
- Slug-Based Routing
- GitHub Markdown

---

# Tools Used

- Visual Studio Code
- phpMyAdmin
- Google Chrome
- Chrome DevTools
- ChatGPT

---

# Main Achievement of the Day

For the first time, the project successfully loads and displays a complete news article directly from the database using a unique slug.

Verified:

- URL parameter processing;
- secure SQL execution;
- automatic page generation;
- responsive layout;
- stable operation of the new architecture.

---

# Practical Value

The first fully functional article-viewing module of the new CMS has been completed.

This makes it possible to:

- eliminate static HTML news pages;
- manage articles through a unified database;
- prepare SEO-friendly URLs;
- build a scalable publishing platform.

---

# Next Steps

1. Connect homepage news cards to slug-based article pages.
2. Implement SEO-friendly URLs such as:
   ```text
   /en/news/your-article-slug
   ```
3. Create a custom 404 page.
4. Develop an administrative interface for creating news articles.
5. Implement article editing.
6. Begin building the CMS administration panel.

---

# Summary

Day 9 marked the first implementation of a fully dynamic article delivery system.

```text
Home Page
        ↓
News Card
        ↓
Slug
        ↓
Prepared SQL
        ↓
MySQL
        ↓
Dynamic Article Page
```

The project has successfully evolved from dynamic news card generation to a complete article architecture, representing one of the key milestones in developing a custom PHP/MySQL content management system.

**Status:** Completed
