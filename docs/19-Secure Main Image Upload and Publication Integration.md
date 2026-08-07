# Day 19 — Secure Main Image Upload and Publication Integration

**Date:** 2026-08-06  
**Status:** completed  
**Day rating:** 5/5

---

# What was done — in simple terms

On Day 19, the publication editor learned how to work with real image files.

The `image_path` field already existed in the database, but an editor still had to know the server path and enter it manually. This was too technical for normal editorial work.

The new workflow is straightforward:

```text
choose a file
        ↓
upload the image
        ↓
check the preview
        ↓
save the publication
```

The same main image is now reused in two places:

```text
publication card in a carousel
                +
large image on the publication page
```

If the image is removed from a publication, the publication remains available and the carousel continues to work correctly without a broken image.

---

# Main tasks of the day

1. Create a dedicated storage directory for publication images.
2. Prevent server-side scripts from running inside the upload directory.
3. Build a server-side image upload endpoint.
4. Restrict allowed formats, file size and image dimensions.
5. Add file selection, upload, preview and removal controls to the editor.
6. Fill `image_path` automatically after upload.
7. Save the path in `home_feed_items`.
8. Reuse one image for the carousel card and full publication page.
9. Test image replacement and removal.
10. Confirm that publications without images remain valid.
11. Prepare the editor for a future media library.

---

# Initial state

At the beginning of Day 19:

- the modern administration panel was operational;
- publications could be created, edited, published, moved to trash and restored;
- `home_feed_items` contained an `image_path` field;
- carousel cards and publication pages could display an image from a stored path;
- the editor had no native file upload mechanism;
- paths had to be entered manually;
- there was no dedicated protected upload directory.

The objective was therefore larger than adding a file input. A secure and portable media workflow had to be created.

---

# 1. Publication image storage

A dedicated directory was created:

```text
/docs/new-home/uploads/publications/
```

Files are grouped by year and month:

```text
/uploads/publications/2026/08/
/uploads/publications/2026/09/
/uploads/publications/2027/01/
```

This structure prevents thousands of files from accumulating in one directory and makes backups, maintenance and future migration easier.

---

# 2. Upload directory protection

An `.htaccess` file was added to the publication upload directory.

It disables handlers for executable server-side formats and denies access to suspicious script extensions.

```apache
RemoveHandler .php .phtml .php3 .php4 .php5 .php7 .php8 .phar .cgi .pl .py .sh
RemoveType .php .phtml .php3 .php4 .php5 .php7 .php8 .phar .cgi .pl .py .sh

<FilesMatch "\.(php|phtml|php3|php4|php5|php7|php8|phar|cgi|pl|py|sh|shtml)$">
    Require all denied
</FilesMatch>
```

In practical terms:

```text
an image may be stored
        ↓
an uploaded script cannot be executed
```

---

# 3. Server-side upload endpoint

A new endpoint was created:

```text
/docs/new-home/admin/publication-image-upload.php
```

It performs the following checks:

- request method must be `POST`;
- the administrative session must be valid;
- the CSRF token must match;
- upload errors must be absent;
- file size must not exceed 8 MB;
- actual MIME type must be JPEG, PNG or WebP;
- the file must be a real image;
- the maximum image side must not exceed 12,000 pixels.

The server does not rely only on the filename extension. It examines the actual content of the uploaded file.

---

# 4. Safe unique filenames

The original filename is not used as the final server filename.

A unique name is generated from the upload time and a random sequence:

```text
/uploads/publications/2026/08/20260806-184530-a1b2c3d4e5f6.jpg
```

This prevents:

- accidental overwriting;
- URL problems caused by spaces or Cyrillic characters;
- user-controlled server paths;
- predictable file collisions.

---

# 5. Main image card in the editor

A dedicated media card was added to the right column:

```text
MEDIA
Main image
```

It includes:

- the current image preview;
- file selection;
- an upload button;
- a remove-image button;
- operation status messages;
- the resulting `image_path` value.

The right column now clearly separates publication controls from media controls.

---

# 6. Asynchronous upload workflow

After a file is selected, the upload button becomes available.

JavaScript sends the file to:

```text
publication-image-upload.php
```

without reloading the publication form.

The server returns JSON containing the public image path. JavaScript then:

1. writes the path into `image_path`;
2. refreshes the preview;
3. displays a success message;
4. keeps the editor open.

The upload and publication save remain two explicit operations:

```text
upload file
        ↓
receive image path
        ↓
save publication
        ↓
store path in MySQL
```

---

# 7. Automatic preview

The preview follows the state of `image_path`:

```text
path exists
        ↓
show preview

path is empty
        ↓
hide preview
```

When an existing publication is opened again, its saved image is immediately visible in the editor.

---

# 8. Removing an image from a publication

The **Remove image** command:

- clears the selected file input;
- clears `image_path`;
- disables the upload button;
- removes the preview source;
- hides the preview area;
- informs the editor that the publication must be saved.

The publication itself is not deleted. After saving, it simply becomes a publication without a main image.

---

# 9. Integration with the database

The existing field remains the single source of truth:

```text
home_feed_items.image_path
```

No additional media table was required at this stage.

```text
uploaded file
        ↓
public relative path
        ↓
image_path
        ↓
carousel and publication template
```

---

# 10. Reusing one image in two interfaces

The stored image path is used by:

```text
news-carousel.php
events-carousel.php
news.php
publication-edit.php
```

One upload therefore updates both the compact card and the full publication page.

---

# 11. Graceful operation without an image

The templates check whether `image_path` is empty before rendering an image.

```text
image_path filled
        ↓
render image

image_path empty
        ↓
render publication without image
```

This prevents empty `<img>` elements and broken placeholders.

---

# Verified results

## Security

- the upload directory is isolated;
- executable script formats are blocked;
- CSRF protection is applied;
- real MIME type is checked;
- file size and dimensions are limited;
- server filenames are generated safely.

## Editor

- file selection works;
- upload works without a page reload;
- preview updates automatically;
- `image_path` is filled automatically;
- an image can be replaced or removed;
- status messages explain the current state.

## Public website

- the carousel card displays the uploaded image;
- the publication page displays the same image;
- a publication without an image remains valid;
- neighbouring carousel cards are not affected.

---

# Main files

```text
/docs/new-home/admin/publication-edit.php
/docs/new-home/admin/publication-image-upload.php
/docs/new-home/admin/assets/js/admin-editor.js
/docs/new-home/uploads/publications/.htaccess
/docs/new-home/api/news-carousel.php
/docs/new-home/api/events-carousel.php
/docs/new-home/news.php
```

Database field:

```text
home_feed_items.image_path
```

---

# Architecture after Day 19

```text
publication-edit.php
        ↓
file selection
        ↓
admin-editor.js
        ↓
publication-image-upload.php
        ↓
validation and safe filename
        ↓
/uploads/publications/YYYY/MM/
        ↓
image_path
        ↓
home_feed_items
        ├── carousel card
        └── publication page
```

---

# Technologies practised

- secure PHP file uploads;
- CSRF protection;
- MIME validation;
- image dimension validation;
- unique filename generation;
- asynchronous `fetch()` requests;
- `FormData`;
- JSON responses;
- dynamic preview updates;
- Apache `.htaccess` protection;
- MySQL path storage;
- graceful optional media rendering.

---

# Main achievement of the day

The publication editor moved from manual image paths to a real editorial media workflow.

```text
manual server path
        ↓
secure upload
        ↓
automatic preview
        ↓
single image_path
        ↓
carousel + publication page
```

The solution is already useful in daily work and also provides a foundation for a future media library.

---

# Day rating

## 5 out of 5

Day 19 deserves the highest rating because the work covered the complete image lifecycle:

- secure storage was created;
- upload validation was implemented;
- the editor received a usable media interface;
- the database integration remained simple;
- image replacement and removal were tested;
- public templates work both with and without an image.

This was not merely a visual control. It was a complete secure upload pipeline.

---

# Next steps

1. Add visual formatting controls for `full_text`.
2. Add image metadata such as alternative text and captions.
3. Create a reusable media library.
4. Add optional image resizing and thumbnail generation.
5. Add cleanup rules for files no longer referenced by publications.
6. Extend the same media workflow to events and international publications.

**Status:** Day 19 completed.
