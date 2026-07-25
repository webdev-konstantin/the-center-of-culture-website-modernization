# Day 8 — Integrating the New Homepage with PHP and MySQL
**Date:** 2026-07-24  
**Status:** Completed

---

## Development Photos

> You can place 4–6 screenshots here:
>
> - creating the new MySQL table;
> - API testing;
> - connecting `news-carousel.php`;
> - the first news item retrieved from the database;
> - the working carousel;
> - the final version of the section.
>
> Example:
>
> ```text
> /images/day08/mysql-table.png
> /images/day08/api-json.png
> /images/day08/news-carousel.php.png
> /images/day08/first-news.png
> /images/day08/final-carousel.png
> ```

---

# Objective

Convert the **"Latest News"** section from a completely static HTML implementation into a dynamic PHP/MySQL solution while preserving the existing user interface and JavaScript carousel.

Planned architecture:

```text
phpMyAdmin
        ↓
home_feed_items
        ↓
PHP
        ↓
HTML
        ↓
JavaScript Carousel
        ↓
Homepage
```

---

# Completed Tasks

## 1. Designing the New Data Structure

A dedicated database table for homepage publications was created:

```text
home_feed_items
```

The table includes:

- publication ID;
- content type;
- language;
- title;
- subtitle;
- image path;
- target URL;
- publication date;
- event dates;
- publication flags;
- sorting order.

Architecture:

```text
MySQL
        ↓
home_feed_items
        ↓
Homepage Publications
```

---

## 2. Creating Initial Publications

The first test news items were inserted directly through phpMyAdmin.

The following operations were verified:

- inserting records;
- editing data;
- deleting records;
- publication sorting.

The new database structure was successfully validated.

---

## 3. Developing the Server API

A new PHP endpoint was created:

```text
home-feed.php
```

Implemented features:

- MySQL connection;
- filtering by content type;
- language filtering;
- published records only;
- sorting;
- result limiting.

Architecture:

```text
MySQL
        ↓
PHP
        ↓
JSON
```

---

## 4. JSON Verification

The API endpoint was tested successfully.

Real database records were returned through JSON.

Verified:

```text
MySQL
        ↓
PHP
        ↓
JSON
        ↓
Browser
```

The following were confirmed:

- successful database connection;
- SQL query execution;
- correct JSON serialization.

---

## 5. Creating the Server-Side Card Generator

A dedicated file was developed:

```text
news-carousel.php
```

Its workflow:

```text
MySQL
        ↓
SQL
        ↓
PHP
        ↓
HTML Cards
```

Every news card is generated automatically.

---

## 6. Integrating the Generator into the Homepage

The previous static HTML markup was replaced with a PHP include:

```php
<?php include __DIR__ . '/../../api/news-carousel.php'; ?>
```

Resulting architecture:

```text
index.php
        ↓
include
        ↓
news-carousel.php
        ↓
HTML
```

---

## 7. Integration Testing

The following components were verified:

- PHP include;
- HTML generation;
- page rendering;
- compatibility with the existing carousel.

Confirmed architecture:

```text
PHP
        ↓
HTML
        ↓
JavaScript
```

No JavaScript modifications were required.

---

## 8. Image Verification

Image paths were corrected.

Verified:

- images;
- publication dates;
- titles;
- subtitles;
- links.

All cards were displayed correctly.

---

## 9. Multiple Publication Testing

Additional news records were inserted through phpMyAdmin.

Verified:

- automatic appearance of new cards;
- sorting;
- carousel functionality;
- dynamic content loading.

Architecture:

```text
phpMyAdmin
        ↓
INSERT
        ↓
MySQL
        ↓
PHP
        ↓
Homepage
```

---

## 10. End-to-End Publishing Workflow

The complete publishing process was successfully tested.

Final workflow:

```text
Create News
        ↓
phpMyAdmin
        ↓
home_feed_items
        ↓
news-carousel.php
        ↓
index.php
        ↓
HTML
        ↓
content-carousel.js
        ↓
Rendered News Card
```

No critical issues were detected.

---

# Final Architecture

```text
phpMyAdmin
        ↓
home_feed_items
        ↓
SQL
        ↓
PHP
        ↓
HTML
        ↓
CSS
        ↓
JavaScript
        ↓
Dynamic Carousel
```

---

# Key Technical Achievements

### Server-Side Card Generation Implemented

News cards are no longer written manually in HTML.

They are generated automatically from the database.

---

### Existing User Interface Fully Preserved

The following components continue working without modification:

- CSS;
- JavaScript;
- responsive layout;
- navigation arrows;
- pagination indicators;
- carousel animation.

---

### Foundation of the New CMS Established

The first production-ready architecture has been implemented:

```text
MySQL
        ↓
PHP
        ↓
HTML
        ↓
JavaScript
```

---

### Independence from Tilda Confirmed

The homepage is no longer dependent on static HTML news cards.

All publications are generated dynamically.

---

# Technologies Studied

- PHP
- MySQL
- SQL
- phpMyAdmin
- mysqli
- HTML5
- JSON
- PHP include
- GitHub Markdown

---

# Tools Used

- Visual Studio Code
- phpMyAdmin
- Google Chrome
- Chrome DevTools
- ChatGPT

---

# Main Result of the Day

For the first time, the homepage successfully retrieves and displays news directly from a MySQL database.

Verified:

- database connectivity;
- SQL query execution;
- automatic HTML generation;
- seamless carousel integration;
- successful PHP integration with the new homepage.

---

# Practical Significance

The first fully functional server-side component of the new CMS has been completed.

This makes it possible to:

- eliminate manual HTML editing;
- publish homepage content directly from the database;
- gradually replace the existing publishing workflow;
- build a unified homepage content management system.

---

# Next Steps

1. Add hashtag support for publications.
2. Develop an administrative news editor.
3. Implement publication editing.
4. Implement publication deletion.
5. Connect the **Events** and **International Projects** sections.
6. Build a complete administration panel for the new CMS.

---

# Conclusion

Day 8 marked the first successful integration of the new homepage with the server-side infrastructure.

```text
phpMyAdmin
        ↓
MySQL
        ↓
PHP
        ↓
HTML
        ↓
JavaScript
        ↓
Fully Functional Homepage
```

The static HTML implementation of the **Latest News** section has been successfully replaced with dynamic database-driven content generation while preserving the existing user interface and carousel functionality.

**Status:** Completed
