# Day 2 — Analysis of Dynamic Page Generation and CMS Network Requests. Restoring the Dynamic “Library and Studios” Section

**Date:** 2026-07-01  

**Status:** Completed

## Photos of the Investigation Process

> Add 1–3 screenshots here, for example:
>
> - the `coursesandstudios` table in phpMyAdmin;
> - the “Shortcut Panel” widget settings;
> - the restored section in the visual editor.
>
> Example:
>
> ```text
> /images/day02/coursesandstudios-table.png
> /images/day02/widget-settings.png
> /images/day02/restored-section.png
> ```

---

## Goal

Continue investigating the custom CMS used by `ruscenter.hu`, identify the data source for the **“Library and Studios”** section, and restore the section without changing PHP code or transferring content manually.

The investigation focused on the complete data path:

```text
Homepage
        ↓
CMS Widget
        ↓
PHP Handler
        ↓
MySQL
        ↓
Section Cards
        ↓
Linked Pages
```

Four practical questions had to be answered:

1. Where are the section cards stored?
2. Where are the full pages linked from those cards stored?
3. How does the CMS retrieve data from MySQL?
4. Why was the existing widget unable to display its content?

---

# Completed Tasks

## 1. Analysis of the CMS Server and Client Layers

The following project areas were examined through the hosting file manager:

- PHP files;
- JavaScript directories;
- the administrative interface;
- the `WEB-INF` directory;
- server-side request handlers;
- possible database configuration files.

One of the key files was:

```text
select.php
```

The analysis showed that this file does not store page content. Instead, it performs database queries based on parameters received from the CMS interface.

Its general logic is:

```sql
SELECT $_POST['fields']
FROM $_POST['tables']
WHERE $_POST['condition']
```

`select.php` therefore acts as an intermediary:

```text
CMS Interface
        ↓
POST Request
        ↓
select.php
        ↓
MySQL
        ↓
Response to the Interface
```

---

## 2. Analysis of Network Requests

Chrome DevTools was used to inspect requests made by the administrative interface.

The requests included parameters such as:

```text
tables = content
```

and:

```text
tables = fragments
```

This confirmed that the CMS does not store editable pages as complete static HTML documents.

Instead, the interface:

1. sends an AJAX request;
2. specifies the required table;
3. receives data from the PHP handler;
4. converts the response into interface objects;
5. dynamically builds the visual editor.

---

## 3. Analysis of the JavaScript Structure

The project contained files matching:

```text
*.cache.js
```

as well as:

```text
ruscenter.nocache.js
```

This structure is typical of applications built with Google Web Toolkit.

It explains why the administrative interface logic could not be found in ordinary PHP templates.

The client-side architecture can be represented as follows:

```text
GWT Application
        ↓
Compiled JavaScript
        ↓
AJAX Requests
        ↓
PHP
        ↓
MySQL
```

---

## 4. Browser Console Inspection

The `Console` tab showed Mixed Content warnings:

```text
Mixed Content:
The page was loaded over HTTPS,
but requested an insecure element over HTTP.
```

Some images were requested through addresses such as:

```text
http://ruscenter.hu/uploads/...
```

Chrome automatically upgraded these requests to HTTPS.

The console also contained the following message:

```text
Uncaught (in promise)
Error: A listener indicated an asynchronous response,
but the message channel closed before a response was received
```

No critical editor errors were found.

In particular, the following errors were absent:

```text
CKEDITOR is not defined
TypeError
Cannot read property
```

The missing section was therefore not caused by a complete JavaScript or visual-editor failure.

---

## 5. Database Investigation

The next stage was performed in phpMyAdmin.

The database contained the following tables:

```text
content
coursesandstudios
fragments
keywords
menu
snapshot
tickets
usefullinks
users
voters
votes
```

The two key tables for the investigated section were:

```text
content
coursesandstudios
```

The `fragments` table participates in CMS operation, but it did not contain the cards used by the **“Library and Studios”** section.

---

## 6. The `coursesandstudios` Table

The following table contained records matching the visible section cards:

```text
coursesandstudios
```

| `id` | `text` | `command` |
|---:|---|---|
| 7 | Studios | empty |
| 8 | Piano Studio of the Russian Cultural Center | page link |
| 20 | Speech Therapist | page link |
| 21 | Library | empty |
| 22 | Library | page link |
| 23 | Theatre Studio | page link |
| 24 | Children’s Theatre Studio | page link |

Important fields include:

| Field | Purpose |
|---|---|
| `locale` | language version |
| `seqno` | display order |
| `text` | card label |
| `command` | navigation command or link |
| `icon` | image path |
| `iconheight` | image height |
| `forecolor` | text color |
| `backcolor` | background color |
| `colspan` | card width |
| `rowspan` | card height |

Example “Library” record:

```text
id = 22
text = Library
command = !page=hash7
icon = uploads/coursesandstudios/img1723.jpg
locale = ru
iconheight = 120
```

The card does not contain the full page. It stores the following navigation command:

```text
!page=hash7
```

---

## 7. Connecting the Card to the Page

The linked page was located in:

```text
content
```

The following SQL query was used:

```sql
SELECT *
FROM content
WHERE hash = 'hash7';
```

Two language versions were found:

- Russian;
- Hungarian.

For the Russian version, the following values were confirmed:

```text
hash = hash7
locale = ru
published = 1
header = Library
```

The record also contained:

- HTML content;
- an image;
- publication settings;
- a language version.

The card-to-page relationship is:

```text
coursesandstudios.command
        ↓
!page=hash7
        ↓
content.hash
        ↓
hash7
        ↓
“Library” Page
```

---

## 8. Role of the `content` Table

The `content` table is the main page repository of the CMS.

Important fields include:

```text
id
classid
locale
hash
published
header
subheader
thumbnail
html
```

A page record can be represented as:

```text
hash
        ↓
Material Identifier
        ↓
locale
        ↓
Language Version
        ↓
header
        ↓
Title
        ↓
html
        ↓
Main Content
```

The homepage uses:

```text
hash = main
```

The Library page uses:

```text
hash = hash7
```

Cards and full pages are stored separately:

```text
coursesandstudios
        ↓
Cards and Visual Settings

content
        ↓
Full Pages and Main Content
```

---

## 9. Verification of the “Library” Page

The `hash7` page was opened directly in the administrative interface.

The following facts were confirmed:

- the page exists;
- it is published;
- the title is displayed;
- the text is available;
- images load correctly;
- the visual editor works;
- editing is available.

The issue was therefore not caused by:

- the `content` table;
- the Library page itself;
- its publication status;
- the hash link;
- the page editor.

---

## 10. Investigation of the Homepage

The homepage record was found in `content`:

```text
id = 1
hash = main
header = Homepage
```

Its `html` field did not contain the complete markup of the **“Library and Studios”** section.

This confirmed that the homepage is assembled from separate components:

```text
Main Text
        +
Images
        +
Banners
        +
Widgets
        +
MySQL Data
```

The **“Library and Studios”** section is therefore a CMS widget rather than part of the ordinary HTML field.

---

## 11. Visual Editor and Widgets

The homepage visual editor provided access to:

- text blocks;
- images;
- banners;
- videos;
- PDF files;
- linked files;
- translated elements;
- specialized widgets.

The widget list included:

```text
Shortcut Panel
Online Registration
Image with Rating
Video with Rating
Voting
Newsletter Subscription
Carousel
```

The **“Library and Studios”** section is generated by:

```text
Shortcut Panel
```

---

## 12. Widget Parameters

The “Shortcut Panel” properties contained three parameters:

```text
columns
dbtable
locale
```

At the time of the investigation, all three fields were empty.

As a result, the widget did not know:

- how many columns to display;
- which table to use;
- which language version to load.

The correct values for the Russian version were restored:

```text
columns = 4
dbtable = coursesandstudios
locale = ru
```

Parameter purposes:

| Parameter | Purpose |
|---|---|
| `columns` | number of columns |
| `dbtable` | data source |
| `locale` | card language |

The Hungarian version requires:

```text
columns = 4
dbtable = coursesandstudios
locale = hu
```

---

## 13. Restoring the Section

After entering:

```text
columns = 4
dbtable = coursesandstudios
locale = ru
```

the widget loaded its content again.

The visual editor displayed:

- the “Library” heading;
- the Library card;
- the “Studios” heading;
- the Piano Studio card;
- the Speech Therapist card;
- Theatre Studio cards;
- images;
- labels;
- colors;
- links.

This confirmed that:

- the `coursesandstudios` table is valid;
- the linked pages in `content` are valid;
- the images exist;
- the PHP handler works;
- the administrative interface receives the data;
- the issue was caused by empty widget parameters.

---

## 14. Reconstructed Architecture

The complete section-generation process is:

```text
Homepage
hash = main
        ↓
CMS Visual Editor
        ↓
“Shortcut Panel” Widget
        ↓
columns = 4
dbtable = coursesandstudios
locale = ru
        ↓
AJAX
        ↓
select.php
        ↓
MySQL
        ↓
coursesandstudios
        ↓
Section Cards
        ↓
command = !page=hash7
        ↓
content.hash = hash7
        ↓
“Library” Page
```

Simplified architecture:

```text
CMS Editor
        ↓
Widget Settings
        ↓
AJAX
        ↓
PHP
        ↓
MySQL
        ↓
Cards
        ↓
Target Pages
```

---

## Key Technical Findings

### The Homepage Is Generated Dynamically

It is assembled from HTML blocks, images, and widgets rather than stored as one static document.

### Cards and Pages Are Stored Separately

```text
coursesandstudios
        ↓
Cards and Visual Settings

content
        ↓
Full Pages
```

### Navigation Uses Hash Commands

```text
!page=hash7
```

### PHP Acts as an Intermediary Layer

```text
JavaScript
        ↓
select.php
        ↓
MySQL
```

### The Widget Requires Mandatory Parameters

```text
columns
dbtable
locale
```

Without them, the section cannot retrieve its data.

---

## Restored Parameters

### Russian Version

```text
Widget: Shortcut Panel
columns: 4
dbtable: coursesandstudios
locale: ru
```

### Hungarian Version

```text
Widget: Shortcut Panel
columns: 4
dbtable: coursesandstudios
locale: hu
```

---

## Technologies Studied

- PHP
- MySQL
- SQL
- phpMyAdmin
- JavaScript
- AJAX
- Google Web Toolkit
- HTML
- HTTPS
- Chrome DevTools
- visual CMS editors
- dynamic page generation
- hash-based navigation
- Reverse Engineering

## Tools Used

- RU-CENTER Hosting
- hosting file manager
- phpMyAdmin
- Google Chrome
- Chrome DevTools
- Network
- Console
- CMS visual editor
- SQL queries
- PHP and JavaScript analysis
- ChatGPT

---

## Main Result of the Day

The generation mechanism of the **“Library and Studios”** section was fully reconstructed.

It was established that:

- cards are stored in `coursesandstudios`;
- full pages are stored in `content`;
- cards link to pages through hash commands;
- the widget receives data through `select.php`;
- the homepage is assembled dynamically;
- the missing section was caused by empty widget parameters.

After restoring:

```text
columns = 4
dbtable = coursesandstudios
locale = ru
```

the section appeared again in the visual editor.

---

## Practical Value

The investigation established:

- where pages are stored;
- where cards are stored;
- how the tables are connected;
- how hash-based navigation works;
- how widgets retrieve data;
- which parameters are required to restore dynamic sections.

This reduces the risks of further website modernization and creates a technical foundation for integrating the new Tilda design with the existing CMS.

---

## Next Steps

1. Document the parameters of the remaining CMS widgets.

2. Create the following mapping:

```text
Widget
        ↓
Parameters
        ↓
MySQL Table
        ↓
Linked Pages
```

3. Test both Russian and Hungarian versions.

4. Preserve backup copies of:

- the MySQL database;
- the website directory;
- images;
- widget parameters;
- the current homepage.

5. Prepare a CMS technical reference containing:

- widgets;
- database tables;
- hash identifiers;
- language versions;
- image paths;
- restoration instructions.

---

## Final Conclusion

The second day confirmed that the custom CMS has a modular architecture.

```text
Visual Editor
        ↓
Widget Parameters
        ↓
AJAX
        ↓
PHP
        ↓
MySQL
        ↓
Dynamic Section
```

The **“Library and Studios”** section was restored without changing PHP code and without manually editing page records.

The existing CMS can remain the content-management system and serve as the foundation for the gradual implementation of components from the new website.

**Status:** Completed
