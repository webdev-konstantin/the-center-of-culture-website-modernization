# Day 18 — Building the Modern CMS Publication Editor

**Date:** 2026-08-06  
**Status:** Completed  
**Day Rating:** 5/5

---

# What Was Done — In Plain Language

Day 18 transformed the publication system from a database-driven public frontend into a real editorial platform.

Until this stage, news, announcements, and international events could already be displayed dynamically from `home_feed_items`, but adding or changing records still depended largely on direct work with MySQL and phpMyAdmin.

A new administration section was therefore built inside:

```text
/docs/new-home/admin/
```

The new interface now provides:

```text
secure administrator access
        ↓
a dashboard with publication statistics
        ↓
a searchable and filterable publication repository
        ↓
a modern create/edit form
        ↓
safe saving to MySQL
        ↓
soft deletion to Trash
        ↓
restoration from Trash
        ↓
protection of unpublished and deleted public pages
```

The result is no longer a static mock-up. The editor successfully creates records, reloads them by ID, updates content, moves records to Trash, restores them, and prevents unpublished material from being displayed publicly.

---

# Main Objectives

1. Create a separate modern administration module for the new website.
2. Preserve the existing custom CMS and the `home_feed_items` table.
3. Add secure administrator authentication and session protection.
4. Build a dashboard with publication statistics.
5. Create a unified list for news, announcements, and international events.
6. Add search and filters by type, language, and status.
7. Build one reusable publication editor for creation and editing.
8. Add automatic slug generation and SEO preview.
9. Add fields for event dates, location, registration URL, image path, and tags.
10. Save new and existing records safely through prepared SQL statements.
11. Add soft deletion without removing records from MySQL.
12. Add restoration from Trash.
13. Prevent unpublished and deleted records from opening through direct public URLs.
14. Replace the plain “News not found” response with a branded 404 page.
15. Keep the module ready for future Russian and Hungarian editorial workflows.

---

# Initial State

At the beginning of Day 18:

- the public homepage already contained dynamic news and event carousels;
- publication repository pages and filters were working;
- `news.php` served news, announcements, and international events;
- the database table `home_feed_items` was already the shared source of content;
- records were still created and adjusted manually through phpMyAdmin;
- the old custom CMS editor was visually outdated and difficult to use;
- no modern administration dashboard existed for the new `/new-home/` system;
- no safe Trash and restore workflow existed in the new module;
- unpublished records could still be opened if their direct slug was known.

---

# 1. Designing a Separate Administration Module

The new editor was placed in an isolated directory:

```text
/docs/new-home/admin/
```

This separation is important because the public frontend and the administration interface now have different responsibilities:

```text
/new-home/
        ↓
public website for visitors

/new-home/admin/
        ↓
private editorial interface
```

The administration module received its own:

```text
PHP entry points
shared bootstrap
access control
MySQL connection layer
layout components
CSS
JavaScript
```

This made it possible to modernize editorial work without replacing the existing database architecture or disrupting the public website.

---

# 2. Administration Bootstrap, Authentication, and Database Layer

The reusable backend foundation was separated into dedicated files:

```text
/docs/new-home/admin/includes/admin-bootstrap.php
/docs/new-home/admin/includes/admin-auth.php
/docs/new-home/admin/includes/admin-db.php
/docs/new-home/admin/includes/admin-layout.php
```

The bootstrap connects the shared administration functions required by every page.

The authentication layer protects the editor from public access. The administration session uses a necessary technical session cookie rather than an advertising or analytics cookie.

The database layer provides one controlled connection to the same MySQL database already used by the public website.

The architecture now follows this sequence:

```text
administration page request
        ↓
admin-bootstrap.php
        ↓
authentication check
        ↓
CSRF/session helpers
        ↓
admin-db.php
        ↓
prepared MySQL operation
```

No public registration form, analytics tracker, advertising cookie, or collection of visitor personal data was added.

---

# 3. Creating the Administration Dashboard

The main administration page now shows a real overview of the publication database.

The dashboard contains summary cards for:

```text
all records
published records
unpublished records
Trash
```

It also displays publication distribution by type:

```text
news
announcements of the Russian Cultural Centre
international events
```

The recent-publications block makes the newest records immediately accessible for editing.

This changed the administration entry point from a simple technical page into a clear editorial workspace.

---

# 4. Building the Unified Publication Repository

The page:

```text
/docs/new-home/admin/publications.php
```

became the central publication repository.

It reads real records from:

```text
home_feed_items
```

and supports:

```text
search by title, slug, tag, or location
filter by content type
filter by language
filter by publication status
separate Trash view
```

The left navigation provides direct sections for:

```text
All Publications
Create Publication
News
Announcements of the Russian Cultural Centre
International Events
Drafts
Unpublished Publications
Trash
```

The same repository is reused with different query parameters instead of creating separate duplicate pages.

Example:

```text
publications.php?type=event
```

shows only announcement records.

---

# 5. Creating a Modern Responsive Publication Table

The first version successfully loaded records but looked like an unstyled HTML table.

A dedicated table system was then added to:

```text
/docs/new-home/admin/css/admin.css
```

The final table includes:

```text
publication symbol
headline
subtitle
slug
type
language badge
date
status
actions
```

Desktop behavior:

```text
fixed logical columns
readable spacing
row hover state
status and language badges
compact action links
```

Mobile behavior:

```text
each table row becomes an independent card
column headings become field labels
horizontal overflow is removed
```

The filter form was also converted into a responsive grid.

---

# 6. Diagnosing the CSS Loading Problem

During implementation, the main administration styles loaded correctly, but the new publication-table rules did not appear.

The investigation confirmed that:

```text
admin.css was connected
        ↓
old selectors were present
        ↓
new selectors were absent from the server copy
```

A temporary diagnostic rule was added:

```css
.admin-publications-table-wrapper {
    outline: 4px solid green !important;
}
```

The green outline proved that the correct file and selector were being used.

The final CSS block was then inserted into the verified server file, and the asset version was increased in `admin-layout.php`.

This diagnosis prevented unnecessary changes to PHP and confirmed the actual cause: the new CSS block had not been saved in the active file.

---

# 7. Building the Unified Create/Edit Form

The main editor page was created as:

```text
/docs/new-home/admin/publication-edit.php
```

One file supports two modes:

```text
publication-edit.php
        ↓
create a new publication

publication-edit.php?id=15
        ↓
edit an existing publication
```

The editor loads an existing record by ID through a prepared statement and fills the same form that is used for creation.

The form contains the following sections:

```text
Basic Information
Main Content
Event Parameters
SEO and Tags
Publication Management
Main Image
```

This avoids separate editors for news, announcements, and international events.

---

# 8. Publication Fields Added to the Interface

The editor now provides controls for:

```text
content_type
locale
title
subtitle
slug
full_text
publication_date
event_start
event_end
event_location
registration_url
tags
seo_title
seo_description
image_path
is_featured
sort_order
is_published
```

The supported content types remain:

```text
news
 event
international
```

The language selector is prepared for:

```text
ru
hu
```

The event block is intended for `event` and `international` records, while ordinary news does not need to display those fields.

File uploading has not yet been implemented. The current image field accepts an existing path or URL and displays a preview.

---

# 9. Creating the Two-Column Editorial Layout

The form received a modern two-column layout:

```text
left column
        ↓
content and SEO cards

right column
        ↓
publication controls and image
```

The main cards are:

```text
Basic Information
Main Content
Event Parameters
SEO and Tags
```

The right sidebar contains:

```text
publication status
publication date
featured flag
sort priority
save and cancel controls
main-image preview
```

The first version used a sticky publication card. During scrolling, the tall card visually overlapped the image card below it.

The sticky behavior was therefore removed:

```css
.admin-editor-card--sticky {
    position: static;
    top: auto;
}
```

The two right-column cards now remain in their normal document order and no longer cover one another.

---

# 10. Adding Editor JavaScript

The file:

```text
/docs/new-home/admin/js/admin-editor.js
```

was expanded with interactive publication-editor behavior.

## Automatic slug

A Russian title such as:

```text
Тест нового редактора
```

is converted into:

```text
test-novogo-redaktora
```

The generated slug is normalized to lowercase Latin letters, digits, and hyphens.

After the editor manually changes the slug, automatic replacement stops so that the custom URL is preserved.

## Dynamic heading

The large editor heading updates immediately while the title is typed.

## Language-aware path

The visible prefix switches between:

```text
/ru/news/
/hu/news/
```

## Event fields

The event card is shown only for:

```text
event
international
```

## SEO counters

The interface tracks:

```text
SEO title       → recommended 60 characters
SEO description → recommended 160 characters
```

## SEO preview

The search-result preview updates from:

```text
SEO title or publication title
SEO description or subtitle
locale
slug
```

## Text-formatting buttons

The simple toolbar can insert:

```html
<strong></strong>
<em></em>
<h2></h2>
<a href=""></a>
<ul><li></li></ul>
```

This is a controlled HTML textarea, not yet a full visual WYSIWYG editor.

---

# 11. Saving New and Existing Records to MySQL

The save handler was implemented in:

```text
/docs/new-home/admin/publication-save.php
```

The form now performs real database operations.

Creation flow:

```text
filled editor form
        ↓
POST request
        ↓
CSRF validation
        ↓
field validation and normalization
        ↓
prepared INSERT
        ↓
new ID generated
        ↓
redirect to publication-edit.php?id=<ID>
```

Update flow:

```text
existing publication
        ↓
POST request with ID
        ↓
prepared UPDATE
        ↓
redirect back to the same editor
```

The successful test created:

```text
Publication #15
Title: Тест нового редактора
Slug: test-novogo-redaktora
```

After the redirect, the saved title, subtitle, slug, date, tags, status, and SEO preview were loaded again from MySQL.

This confirmed the complete round trip:

```text
editor
        ↓
MySQL
        ↓
editor
```

---

# 12. Adding Soft Deletion to Trash

The action handler was implemented in:

```text
/docs/new-home/admin/publication-action.php
```

The “Move to Trash” button performs a POST request with:

```text
id
csrf_token
action = trash
```

The SQL operation is intentionally reversible:

```sql
UPDATE home_feed_items
SET
    is_published = 0,
    deleted_at = NOW()
WHERE id = ?
  AND deleted_at IS NULL
LIMIT 1
```

The record is not physically removed from MySQL.

The resulting workflow is:

```text
publication
        ↓
confirmation dialog
        ↓
remove from public access
        ↓
set deleted_at
        ↓
appear in Trash
```

A JavaScript confirmation dialog protects the operation from accidental clicks.

---

# 13. Adding Restoration from Trash

Trash records display a warning and a dedicated button:

```text
Restore from Trash
```

The restoration operation performs:

```sql
UPDATE home_feed_items
SET
    deleted_at = NULL,
    is_published = 0
WHERE id = ?
  AND deleted_at IS NOT NULL
LIMIT 1
```

The restored record deliberately remains unpublished.

This safety rule prevents an old or incomplete publication from becoming public automatically after restoration.

The complete lifecycle now works:

```text
create
        ↓
edit
        ↓
move to Trash
        ↓
restore
        ↓
unpublished editorial record
```

The restored record reappeared in the main publication list with all content preserved.

---

# 14. Protecting Unpublished and Deleted Public Pages

The public detail template already selected records by `slug`, `locale`, and allowed content type.

The final public query was confirmed to contain:

```sql
AND is_published = 1
AND deleted_at IS NULL
```

The effective rule is now:

```text
published and not deleted
        ↓
public page is available

unpublished
        ↓
public page returns 404

in Trash
        ↓
public page returns 404
```

The test URL:

```text
/new-home/ru/news/test-novogo-redaktora
```

correctly stopped displaying the unpublished record.

The record remained available inside the administration editor.

---

# 15. Creating a Branded 404 Publication Page

The original response was only:

```text
News not found.
```

A reusable localized template was created:

```text
/docs/new-home/includes/publication-not-found.php
```

`news.php` now keeps the real HTTP status:

```php
http_response_code(404);
```

and loads the branded template.

The new page contains:

```text
404 label
clear explanation
link to all news
link to the homepage
responsive layout
Russian and Hungarian text variants
```

It also sends:

```html
<meta name="robots" content="noindex, nofollow">
```

The first attempt failed because the template was not located in the expected `/new-home/includes/` directory. After the file was placed at the exact required path, the styled page loaded successfully and both navigation links worked.

---

# 16. Privacy and Regulatory Scope

The editor itself does not introduce public collection of personal data.

The current scope excludes:

```text
public registration forms
feedback forms
visitor accounts
advertising trackers
analytics cookies
public personal-data storage
```

The only cookie required by the module is the technical administration session cookie used for authentication and CSRF protection.

The interface stores editorial publication data already intended for the website:

```text
texts
publication metadata
existing image paths
publication status
SEO fields
event information
```

No external approval process was required for creating the internal CMS module itself. Before a production switch, the appropriate internal authorization by the organization remains an administrative matter rather than a technical dependency of the editor.

---

# Verified Results

## Authentication and Layout

- the protected administration section opens correctly;
- the new sidebar and top bar load consistently;
- the dashboard displays real publication statistics;
- the active section changes according to the current page or content type.

## Publication Repository

- all records are read from `home_feed_items`;
- search and filters work;
- news and announcement sections open through the same repository;
- the Trash filter works;
- the publication table is responsive and styled.

## Publication Editor

- creation mode works;
- edit mode works by ID;
- automatic slug generation works;
- language-dependent URL prefixes work;
- event fields react to the selected type;
- SEO counters and preview work;
- the image-path preview is prepared;
- text-formatting buttons insert controlled HTML.

## Database Operations

- new records are inserted;
- existing records are reloaded and updated;
- soft deletion sets `deleted_at` and removes publication status;
- restoration clears `deleted_at` and keeps the record unpublished;
- prepared statements and CSRF tokens are used.

## Public Security

- unpublished records no longer open publicly;
- Trash records no longer open publicly;
- published records remain available;
- missing publications return a branded HTTP 404 page;
- the 404 navigation links work.

---

# Main Files

```text
/docs/new-home/admin/index.php
/docs/new-home/admin/publications.php
/docs/new-home/admin/publication-edit.php
/docs/new-home/admin/publication-save.php
/docs/new-home/admin/publication-action.php
/docs/new-home/admin/includes/admin-bootstrap.php
/docs/new-home/admin/includes/admin-auth.php
/docs/new-home/admin/includes/admin-db.php
/docs/new-home/admin/includes/admin-layout.php
/docs/new-home/admin/css/admin.css
/docs/new-home/admin/js/admin-editor.js
/docs/new-home/news.php
/docs/new-home/includes/publication-not-found.php
```

Database table:

```text
home_feed_items
```

---

# Architecture After Day 18

```text
administrator
        ↓
/new-home/admin/
        ↓
authentication and session protection
        ↓
dashboard / publication repository / editor
        ↓
publication-save.php
        ├── INSERT
        └── UPDATE
        ↓
home_feed_items
        ↓
publication-action.php
        ├── move to Trash
        └── restore
        ↓
public frontend
        ├── published + not deleted → display
        └── unpublished or deleted → branded 404
```

Editorial lifecycle:

```text
new publication
        ↓
draft or unpublished record
        ↓
published record
        ↓
soft deletion
        ↓
Trash
        ↓
restoration as unpublished
```

---

# Technologies Practiced

- custom PHP administration architecture;
- reusable bootstrap and layout components;
- session-based authentication;
- CSRF protection;
- prepared MySQL statements;
- `INSERT`, `UPDATE`, soft delete, and restore operations;
- responsive CSS Grid and table-to-card adaptation;
- dynamic JavaScript form behavior;
- Cyrillic-to-Latin slug generation;
- SEO counters and live preview;
- conditional event fields;
- reusable localized 404 templates;
- correct HTTP 404 responses;
- `noindex, nofollow` handling;
- cache-busting through asset version parameters;
- diagnosis of server-side file and path problems.

---

# Main Achievement of the Day

The project received its first complete modern editorial workflow.

Before Day 18:

```text
content in MySQL
        ↓
manual editing through phpMyAdmin
        ↓
public frontend
```

After Day 18:

```text
secure editor
        ↓
create or update publication
        ↓
MySQL
        ↓
publish, unpublish, Trash, or restore
        ↓
protected public output
```

The most important result is that the custom CMS is no longer only a legacy backend being preserved. It now has a new, usable, extensible editorial interface built directly around the real publication table.

---

# Day Rating

## 5 out of 5

Day 18 deserves the maximum rating because it completed a full vertical slice of the CMS rather than an isolated visual component:

- a protected administration section was launched;
- a real dashboard was created;
- a searchable publication repository was built;
- the table interface was made responsive;
- one form now creates and edits all publication types;
- automatic slug and SEO tools were connected;
- records are saved through secure MySQL operations;
- Trash and restore workflows are operational;
- unpublished and deleted records are protected from public access;
- a branded localized 404 page replaced the plain error message;
- the full workflow was verified with real test records.

This was the largest editorial-system step of the project so far.

---

# Next Steps

1. Add direct image upload, validation, resizing, and safe file naming.
2. Add a richer visual editor while preserving clean HTML output.
3. Add explicit publish and unpublish quick actions to the list and editor.
4. Add permanent deletion from Trash with a second, stronger confirmation.
5. Lock editing controls for records that remain in Trash.
6. Add duplicate-slug validation with a clear inline error.
7. Add publication revision history and an audit log.
8. Add separate administrator accounts and editorial roles.
9. Add Hungarian editorial labels and complete Hungarian public routes.
10. Add preview mode that is available only to authenticated editors.
11. Add automatic image and SEO validation before publication.
12. Replace remaining manual phpMyAdmin publication work with the new editor.
13. Test the full administration interface on smartphones and tablets.
14. Prepare a controlled production-launch procedure with backup and rollback steps.

**Status:** Day 18 completed.