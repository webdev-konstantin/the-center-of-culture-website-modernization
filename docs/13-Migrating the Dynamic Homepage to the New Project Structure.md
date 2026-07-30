# Day 13 — Migrating the Dynamic Homepage to the New Project Structure
**Date:** 2026-07-29  
**Status:** Completed

---

# Development Process Photos

> Suggested screenshots:
>
> - new project structure;
> - restored news carousel;
> - dynamic homepage;
> - dynamic news page;
> - final project after migration.
>
> Example:
>
> ```text
> /images/day11/project-structure.png
> /images/day11/homepage-after-migration.png
> /images/day11/news-carousel.png
> /images/day11/news-page.png
> ```

---

# Objective

Move the fully functional version of the new website from the temporary backup directory into its permanent working structure while preserving the functionality of every dynamic component.

Planned architecture:

```text
Backup_new-home_2026-07-22
            ↓
        new-home
            ↓
      Path validation
            ↓
     Component fixes
            ↓
 Fully operational project
```

---

# Completed Tasks

## 1. Migrating the Project to the Working Directory

The project was moved from the backup folder into its permanent development directory.

Current project structure:

```text
/docs/new-home/
│
├── api/
├── backup/
├── css/
├── img/
├── includes/
├── js/
│
├── index.php
├── news.php
├── favicon.ico
├── .htaccess
└── .htpasswd
```

The website no longer depends on the backup directory.

---

## 2. Restoring Project Protection

Password protection for the development version has been fully restored.

Configuration files:

```text
.htaccess
.htpasswd
```

Authentication configuration:

```apache
AuthType Basic
AuthName "Restricted Area"

AuthUserFile
/home/.../docs/new-home/.htpasswd

Require valid-user
```

Search engine indexing protection has also been preserved.

```apache
Options -Indexes

Header always set X-Robots-Tag
"noindex, nofollow, noarchive, nosnippet, noimageindex"
```

---

## 3. Updating Project Paths After Migration

After the migration, several absolute paths still referenced the previous directory.

All references were updated:

```text
Backup_new-home_2026-07-22
                ↓
new-home
```

The following files were verified:

```text
PHP
CSS
JavaScript
HTML
.htaccess
```

No references to the previous directory remain.

---

## 4. Restoring the News Carousel

The homepage news carousel stopped loading after the migration.

The following file was investigated:

```text
index.php
```

The component include statement was corrected:

```php
<?php
include __DIR__ . '/api/news-carousel.php';
?>
```

As a result, the following functionality was restored:

- news cards;
- carousel navigation;
- previous/next arrows;
- carousel controls.

---

## 5. Restoring Images

Following the migration, images disappeared from:

- homepage news cards;
- news pages;
- latest news sidebar.

The following files were reviewed:

```text
api/news-carousel.php
news.php
```

The image variable was analyzed:

```php
$imagePath
```

The issue was traced to outdated database paths.

Previous path:

```text
/new-home/Backup_new-home_2026-07-22/img/
```

Updated path:

```text
/new-home/img/
```

All images were successfully restored.

---

## 6. Database Verification

The following database field was verified:

```text
image_path
```

Publication structure:

```text
title
subtitle
slug
publication_date
image_path
target_url
tags
```

Correct image retrieval from MySQL has been confirmed.

---

## 7. Testing the News Page

The following file was verified:

```text
news.php
```

Successfully restored:

- featured image;
- latest news sidebar;
- article navigation.

Architecture:

```text
news.php
        ↓
MySQL
        ↓
slug
        ↓
Retrieve article
        ↓
Render page
```

---

## 8. Project Structure Validation

The following directories were inspected:

```text
api/
includes/
css/
img/
js/
backup/
```

Confirmed:

- no remaining references to the backup directory;
- consistent project structure;
- independent component operation.

---

## 9. Creating a New Backup

After all fixes were completed, a fresh backup of the fully functional project was created.

The project state has been safely preserved before the next development phase.

---

# Final Project Architecture

```text
index.php
        ↓
includes/
        ↓
api/
        ↓
MySQL
        ↓
News Cards
        ↓
news.php
```

---

# Key Technical Results

### Successful Project Migration

The development version no longer depends on the backup directory.

---

### Dynamic Components Fully Restored

Verified:

- homepage;
- news carousel;
- article pages;
- images;
- latest news block;
- authentication.

---

### Project Structure Cleaned Up

All references to:

```text
Backup_new-home_2026-07-22
```

have been completely removed.

The project structure is now cleaner, more maintainable, and easier to expand.

---

### Foundation for Further CMS Integration

The project is now ready for the remaining dynamic CMS components.

Planned architecture:

```text
MySQL
        ↓
PHP
        ↓
API
        ↓
Homepage
        ↓
News
        ↓
Announcements
        ↓
International Events
        ↓
Library
```

---

# Technologies Studied

- PHP
- MySQL
- phpMyAdmin
- Apache (.htaccess)
- Basic Authentication
- X-Robots-Tag
- Include Architecture
- Relative Paths
- Dynamic Components
- GitHub Markdown

---

# Development Tools

- Visual Studio Code
- DirectAdmin File Manager
- phpMyAdmin
- Google Chrome
- Chrome DevTools
- ChatGPT

---

# Main Achievement of the Day

The new version of the website has been fully migrated into its permanent working directory.

Verified:

- correct homepage rendering;
- fully functional news carousel;
- restored images;
- dynamic news pages;
- password protection;
- complete independence from the backup directory.

---

# Practical Value

A stable development version of the new website has been established.

This makes it possible to:

- continue development safely;
- integrate additional dynamic sections;
- gradually replace the existing homepage;
- prepare the final migration to the production website without changing the future URL structure.

---

# Next Steps

1. Integrate the vertical latest news sidebar.
2. Implement keyword-based search on the homepage.
3. Connect the **Announcements** carousel.
4. Connect the **International Events** carousel.
5. Integrate the dynamic **Library** section.
6. Implement the website footer.
7. Develop the administrative content editor inside the existing CMS.
8. Enable creating, editing, and deleting publications through the `/admin` panel.

---

# Conclusion

Day 11 completed the migration of the new website into its permanent project structure.

```text
Backup
        ↓
new-home
        ↓
Path Validation
        ↓
Component Restoration
        ↓
Fully Functional Dynamic Website
        ↓
Ready for Full CMS Integration
```

The project has been successfully transferred to its new directory structure, all functionality has been restored after migration, and the system is now fully prepared for the next stage: integrating the remaining dynamic modules and building the administrative content management interface.

**Status:** Completed
