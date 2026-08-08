# Day 21 — CMS Visual Editor Media Library: Upload, Optimization, and Image Management

**Date:** 2026-08-08–2026-08-09  
**Status:** Completed  
**Day Rating:** 4/5

---

# What Was Done — In Plain Language

On Day 21, the publication editor received its own media library.

Previously, an editor could upload a main publication image and save its path in the database. However, there was no unified image catalogue. Existing files could not be conveniently browsed, searched, described with metadata, selected in groups, or safely deleted through the CMS.

A dedicated administration section is now available at:

```text
/new-home/admin/media.php
```

It combines two image sources:

```text
images uploaded through the CMS
        +
existing website images from /new-home/img/
        ↓
one visual media catalogue
```

An administrator can search and filter images, change card sizes, open technical details, edit metadata, select several files with `Ctrl`, and perform group operations.

New images are automatically optimized for web publishing and registered in MySQL. When the media library opens, the newest database record becomes active and its preview and metadata are displayed in the right-hand panel.

---

# Main Objectives

1. Create a dedicated MySQL table for media records.
2. Store information about both the original and processed image.
3. Support JPEG, JPG, PNG, and WebP.
4. Optimize uploaded images for web publishing.
5. Convert the processed result to WebP.
6. Store image dimensions, MIME type, file size, and hash.
7. Add editorial metadata.
8. Build a protected media-library API.
9. Create a dedicated visual catalogue page.
10. Add image search and source filters.
11. Add three card-size modes.
12. Implement multiple selection with `Ctrl`.
13. Add bulk operations.
14. Connect the existing `/new-home/img/` directory.
15. Index existing files without modifying them.
16. Add physical file deletion through the CMS.
17. Protect images currently used by publications.
18. Open the newest image automatically.
19. Preserve compatibility with `home_feed_items.image_path`.

---

# Initial State

At the beginning of Day 21:

- the administration panel was already operational;
- publications could be created and edited;
- the visual text editor supported formatting, lists, and hyperlinks;
- a main publication image could be uploaded;
- its path was stored in `home_feed_items.image_path`;
- there was no separate image registry;
- the existing `/new-home/img/` directory was not connected to the new CMS;
- image metadata was not stored systematically;
- reusing an existing image was inconvenient;
- permanent deletion still required the hosting file manager.

---

# 1. Creating the Media Table

A new table was created:

```text
media_items
```

The binary image is not stored inside MySQL. The file remains in the server filesystem, while the database stores its description and technical data.

```text
image file on the server
        +
media_items record
        ↓
managed media object
```

Main technical fields:

```text
id
file_path
stored_filename
original_filename
original_mime_type
original_file_size
original_width
original_height
mime_type
file_extension
file_size
width
height
file_hash
source_kind
created_at
updated_at
```

Editorial fields:

```text
title
alt_text
caption
annotation
credit
source_url
```

This structure allows one image to be described once and reused later without uploading another copy.

---

# 2. Why Images Need Metadata

A file path answers only one question:

```text
Where is the image stored?
```

The media library also answers:

```text
What does the image show?
Who created it?
Where did it come from?
What caption should be displayed?
What alternative text should be used?
```

The following fields were added:

- **Title** — a clear internal name;
- **Alternative text** — a description for accessibility and search;
- **Caption** — text that may later appear below the image;
- **Internal annotation** — a private CMS note;
- **Author or copyright holder** — authorship and rights information;
- **Source URL** — the original page or resource.

---

# 3. Supported Source Formats

The upload handler accepts:

```text
JPEG
JPG
PNG
WebP
```

The `.jpg` and `.jpeg` extensions represent the same JPEG format and are handled identically.

iPhone photographs are supported when saved or exported as JPEG, JPG, PNG, or WebP.

HEIC and HEIF are outside the current stage. They would require server-side Imagick/ImageMagick support or conversion before upload.

---

# 4. Automatic Web Optimization

An uploaded file is not simply copied to the server.

The processing flow is:

```text
source image
        ↓
format and size validation
        ↓
width and height detection
        ↓
resize when necessary
        ↓
WebP conversion
        ↓
optimized file storage
        ↓
media_items record creation
```

WebP reduces page weight and improves loading time on desktop and mobile devices.

A verified example:

```text
source JPEG: 378,301 bytes
        ↓
processed WebP: 227,206 bytes
        ↓
dimensions: 1024 × 768
```

Optimization reduces:

- server load;
- mobile traffic;
- publication loading time;
- disk usage;
- the risk of unnecessarily heavy pages.

---

# 5. Safe Stored Filenames

Every uploaded image receives a unique server filename.

Example:

```text
20260808-120649-eb5dfdaf885eca453d63eecc07a39dcd.webp
```

This prevents filename collisions, removes unsafe characters, avoids language-related path problems, and makes automated processing safer.

The original name remains available in:

```text
original_filename
```

---

# 6. Technical Image Data

The media record stores:

```text
original MIME type
original file size
original width and height
processed MIME type
processed extension
processed file size
processed width and height
SHA-256
```

The `file_hash` field provides a foundation for future duplicate detection and integrity checking.

---

# 7. Media-Library API

The server endpoint was created at:

```text
/new-home/admin/media-library-api.php
```

It supports:

```text
list
update
remove
delete_file
```

## list

Returns images according to the current search query and source filter.

## update

Saves editorial metadata.

## remove

Removes the database record from the media catalogue while leaving the file on the server.

## delete_file

Physically deletes the file and removes its media record.

The API returns JSON, allowing the page to update without a full reload.

---

# 8. Authentication and Security

The API uses the administration protection layer:

```text
admin-bootstrap.php
        ↓
administrator check
        ↓
session validation
        ↓
CSRF validation
        ↓
database or filesystem operation
```

An incognito-window test confirmed that unauthorized visitors receive an authentication prompt.

A public visitor cannot:

- retrieve the media list;
- change metadata;
- remove a media record;
- delete a file.

Database operations use prepared statements.

---

# 9. The Media-Library Interface

The `media.php` page contains:

```text
search
source filters
card-size controls
result counter
image grid
active-image panel
metadata form
deletion controls
```

The interface follows the design language of the new Centre administration panel.

---

# 10. Two Image Sources

The media library distinguishes:

```text
cms_upload
site_asset
```

## CMS Uploads

New files uploaded and processed through the publication editor.

## Website Files

Previously existing images in:

```text
/new-home/img/
```

The interface provides:

```text
All
CMS Uploads
Website Files
```

Each card displays a source badge.

---

# 11. Indexing the Existing Website Directory

A safe scanner was created:

```text
/new-home/admin/media-scan-existing.php
```

It reads:

```text
/home/h011479956/ruscenter.hu/docs/new-home/img/
```

and registers discovered files in `media_items`.

The safety rule is explicit:

```text
files are not moved
files are not renamed
files are not recompressed
files are not modified
```

The scanner creates database records only.

After the fixes, the scan completed without insertion errors:

```text
already in the media library: 220
skipped: 1
errors: 0
```

---

# 12. Russian and Hungarian Characters

The existing directory contained filenames with Hungarian characters.

An initial attempt to apply `utf8mb4` to an indexed `VARCHAR(500)` produced:

```text
#1071 — specified key was too long
```

The cause was the combination of:

```text
long VARCHAR
        ×
multibyte character set
        ×
legacy MySQL index limit
```

The schema was adjusted without creating an oversized index. Russian and Hungarian paths could then be processed correctly.

---

# 13. Search

Images can be searched by:

```text
title
original filename
alternative text
caption
author
```

A short delay is applied before sending the request, preventing unnecessary server calls after every immediate keystroke.

---

# 14. Card Sizes

Three display modes were added:

```text
Small
Medium
Large
```

The selected size is stored in `localStorage` and restored when the media library is opened again.

```text
small cards
        → overview of many files

medium cards
        → normal editorial work

large cards
        → visual comparison
```

---

# 15. The Newest Image Opens Automatically

The API sorts records using:

```sql
ORDER BY id DESC
```

The first record is therefore the most recently added record.

After loading, the interface:

```text
receives the media list
        ↓
selects the first card
        ↓
adds the active outline
        ↓
opens the preview and metadata
```

After the active `media-library.js` file was actually replaced on the server, manual testing confirmed that the newest image opens automatically.

---

# 16. Multiple Selection

Several cards can be selected with:

```text
Ctrl + mouse click
```

Selected cards receive an outline, and a toolbar appears:

```text
Selected: N
Remove Selected
Delete Selected Physically
Clear Selection
```

Manual testing confirmed a selection of five images at the same time.

---

# 17. Bulk Operations

Two different actions are deliberately separated.

## Remove from the Media Library

Deletes the `media_items` record while keeping the file.

## Delete Physically

Deletes both the server file and its database record.

```text
remove from the CMS catalogue
        ≠
erase from the server
```

One standard confirmation is displayed before physical deletion. The additional prompt requiring the word “DELETE” was removed as unnecessarily repetitive.

---

# 18. Protecting Images Used by Publications

Before permanent deletion, the server checks whether `file_path` is used in `home_feed_items.image_path`.

```text
delete command
        ↓
publication lookup
        ↓
image is in use
        → deletion is blocked

image is not in use
        → physical deletion is allowed
```

This prevents published pages from losing their main image.

The path is also checked against allowed directories, so the CMS cannot erase arbitrary server files.

---

# 19. Active-Image Panel

The right-hand panel displays:

```text
preview
technical details
title
alternative text
caption
annotation
author
source URL
save button
deletion controls
```

The panel has its own vertical scrolling area.

An empty area still remains below the right panel when the image grid on the left is much longer than the panel content. This does not block any function, but the layout has not yet reached its ideal visual state.

The remaining limitation is recorded openly:

- no data is lost;
- all buttons remain available;
- independent scrolling works;
- multiple selection works;
- the empty container area remains visible.

---

# 20. Connection to the Publication Editor

The complete flow is:

```text
publication-edit.php
        ↓
file selection
        ↓
publication-image-upload.php
        ↓
validation and optimization
        ↓
WebP file on the server
        +
media_items record
        ↓
publication image_path
        ↓
public publication page
```

Compatibility with:

```text
home_feed_items.image_path
```

is preserved.

---

# Verified Results

## Database

- the `media_items` table exists;
- technical data is stored;
- editorial metadata can be updated;
- Russian and Hungarian paths are supported;
- existing publications remain intact.

## Upload and Optimization

- JPEG and JPG are accepted;
- PNG is accepted;
- WebP is accepted;
- an optimized WebP file is produced;
- a unique filename is generated;
- dimensions and file size are stored;
- the image path is returned to the editor.

## Interface

- the media-library page works;
- the JSON API responds correctly;
- search and filters work;
- the newest image opens automatically;
- card sizes can be changed and remembered;
- metadata appears in the right-hand panel.

## Existing Website Assets

- `/new-home/img/` is connected;
- source files remain unchanged;
- repeated scans do not create duplicates;
- indexing errors were resolved.

## Selection and Deletion

- `Ctrl` selects several cards;
- the selection counter works;
- bulk removal is available;
- physical deletion is available;
- one confirmation is used;
- publication images are protected.

## Security

- administrator authentication works;
- unauthorized access is blocked;
- CSRF validation is retained;
- SQL uses prepared statements;
- deletion is restricted to approved directories.

---

# Main Files

```text
/docs/new-home/admin/media.php
/docs/new-home/admin/media-library-api.php
/docs/new-home/admin/media-scan-existing.php
/docs/new-home/admin/publication-image-upload.php
/docs/new-home/admin/publication-edit.php
/docs/new-home/admin/publication-save.php
/docs/new-home/admin/includes/admin-bootstrap.php
/docs/new-home/admin/includes/admin-db.php
/docs/new-home/admin/includes/admin-layout.php
/docs/new-home/admin/js/media-library.js
/docs/new-home/admin/css/media-library.css
```

Tables:

```text
media_items
home_feed_items
```

Directories:

```text
/new-home/uploads/publications/
/new-home/img/
```

---

# Architecture After Day 21

```text
publication editor
        ↓
image upload handler
        ↓
JPEG / JPG / PNG / WebP
        ↓
optimization
        ↓
WebP on the server
        +
media_items
        ↓
CMS media library
        ├── search
        ├── filters
        ├── card sizes
        ├── metadata
        ├── multiple selection
        └── safe deletion
                ↓
home_feed_items.image_path
                ↓
public publication
```

Existing website files enter through a parallel route:

```text
/new-home/img/
        ↓
safe scanner
        ↓
source_kind = site_asset
        ↓
unified media library
```

---

# Technologies Practiced

- PHP;
- MySQL;
- SQL DDL and migrations;
- prepared statements;
- JavaScript Fetch API;
- JSON;
- FormData;
- DOM API;
- CSS Grid;
- independent scrolling;
- `localStorage`;
- multiple selection;
- JPEG/JPG;
- PNG;
- WebP;
- MIME validation;
- SHA-256;
- safe filesystem operations;
- CSRF protection;
- administrator authentication;
- physical file deletion;
- protection of images used by publications.

---

# Main Achievement of the Day

Images stopped being disconnected file-path strings and became manageable CMS objects.

```text
scattered files
        ↓
unified database
        ↓
visual cards
        ↓
metadata
        ↓
search and filtering
        ↓
reuse
        ↓
safe management
```

This is the transition from a single “Upload Image” button to a real media-management system.

---

# Day Rating

## 4 out of 5

Day 21 produced a strong and functionally substantial result.

The main goals were achieved:

- the data structure was created;
- upload is connected to the media library;
- images are optimized;
- the existing website directory is connected;
- metadata is stored;
- search and filters work;
- the newest image opens automatically;
- card sizes can be changed;
- multiple selection works;
- physical deletion is implemented;
- files used by publications are protected.

However, a maximum score would not be objective.

During implementation:

- several repeated fixes were required;
- the scanner contained a syntax error at one stage;
- the first character-set migration reached a MySQL index limit;
- some intermediate versions were considered ready too early;
- deployment of the active JavaScript file was not initially verified;
- the empty right-container area remains unresolved;
- there are no automated tests yet.

The honest result is:

```text
large working feature
        +
verified main workflows
        −
extended debugging
        −
remaining layout defect
        −
no automated tests
```

Therefore, the most accurate rating is **4 out of 5**.

---

# Next Steps

1. Connect direct media-library selection to the publication editor.
2. Create a modal dialog for choosing the main image.
3. Remove the empty area below the right-hand container.
4. Add pagination or incremental loading for large libraries.
5. Add sorting by name, date, size, and source.
6. Use `file_hash` for duplicate detection.
7. Add HEIC/HEIF support if required.
8. Connect the media library to inline article images.
9. Generate responsive thumbnails.
10. Continue preparing the Russian–Hungarian editorial workflow.

**Status:** Day 21 completed.
