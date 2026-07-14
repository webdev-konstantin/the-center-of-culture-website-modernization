
# Day 3 — Reverse Engineering the CMS Content-Loading Mechanism

**Date:** 2026-07-02  
**Status:** Completed

## Photo of the Investigation Process

> Place 1–3 screenshots here illustrating the investigation process:
>
> - Exported Tilda page
> - Chrome DevTools
> - phpMyAdmin
>
> Example:
>
> ```text
> /images/day03/devtools-network.png
> /images/day03/phpmyadmin-content-table.png
> /images/day03/tilda-export-preview.png
> ```

---

## Goal

The objective of the third day was to determine how the exported Tilda landing page could be integrated with the existing CMS **without changing the current publishing workflow**.

Instead of manually transferring news, events, and images into the new design, the goal was to make the new homepage retrieve data directly from the existing MySQL database.

The intended architecture was defined as follows:

```text
Employee publishes content in the existing CMS
        ↓
The CMS stores the record in MySQL
        ↓
The new homepage requests the latest records
        ↓
The content appears automatically
        ↓
The Tilda design remains unchanged
```

The investigation focused on four practical questions:

1. Which parts of the exported Tilda page already work independently?
2. Why do several sections display **Feed not found**?
3. Where are publications actually stored inside the CMS?
4. How does the current website retrieve and display those publications?

---

# Completed Tasks

## 1. Local Launch of the Exported Tilda Page

The exported homepage was launched directly from the local computer.

```text
page32107432.html
```

The page was opened without connecting it to the production server.

The following components were verified:

- page layout;
- navigation;
- logo;
- images;
- typography;
- buttons;
- styles;
- JavaScript;
- footer;
- responsive layout.

The test showed that almost the entire visual layer works independently of the CMS.

The following elements were displayed correctly:

- Header
- Navigation
- Main slider
- Images
- Buttons
- Fonts
- Styles
- Footer
- Responsive layout

This confirmed that the exported Tilda project already provides a complete visual framework for the future homepage.

---

## 2. Responsive Layout Testing

The exported page was tested using **Chrome DevTools** in Responsive Mode.

Primary testing width:

```text
400 px
```

Additional resolutions:

```text
320 px
375 px
430 px
```

The following behavior was confirmed:

- desktop navigation changed to a mobile menu;
- the slider adapted automatically;
- images scaled correctly;
- sections were rearranged vertically;
- the footer remained readable;
- no critical horizontal scrolling appeared.

The exported layout preserved Tilda's responsive behavior without requiring any modifications.

---

## 3. Static and Dynamic Parts of the Page

During testing it became obvious that not every section behaved the same way.

Three information blocks displayed the following message:

```text
Feed not found
```

The affected sections were:

- Our News
- Our Upcoming Events
- International Events

At the same time, the page structure remained intact:

- section headings were visible;
- containers preserved their size;
- spacing remained correct;
- styles were loaded normally.

This allowed the homepage to be divided into two logical layers.

### Static Layer

The following elements already work independently:

```text
Header
Navigation
Slider
Images
Buttons
Fonts
Styles
Footer
Responsive Grid
```

### Dynamic Layer

The following sections require an external data source:

```text
Our News
Our Upcoming Events
International Events
```

The investigation therefore showed that only three dynamic sections need to be connected to the existing CMS.

---

## 4. Analysis of the Tilda Feed Mechanism

The exported HTML contains the following files:

```text
tilda-feed-1.0.min.css
tilda-feed-1.0.min.js
```

The page also contains Tilda Feed classes:

```text
t-feed
t-feed__container
t-feed__post
t-feed__post-preloader
```

The **Our News** section was identified by:

```text
rec519092551
```

Its configuration includes:

```text
feeduid = 66956374651
amountOfPosts = 4
blocksInRow = 4
methodRelevants = newest
showImage = true
showDate = true
showShortDescr = true
link = /news
```

Initialization is performed by:

```javascript
t_feed_init('519092551', options);
```

The expected workflow is:

```text
Tilda Feed
        ↓
Latest publications
        ↓
Four news cards
        ↓
Image + Date + Description + Link
```

When the page is opened locally, the original Feed source is unavailable, resulting in the message:

```text
Feed not found
```

This confirmed that the HTML structure is present, but the content source is external.

---

## 5. Selecting the Integration Strategy

After examining the exported page and the existing CMS, a different integration approach was chosen.

Instead of reconnecting the page to the original Tilda Feed, the decision was made to reuse the current CMS as the data source.

Current architecture:

```text
Tilda Feed
        ↓
Publications
        ↓
Cards
```

Target architecture:

```text
Existing CMS
        ↓
MySQL
        ↓
PHP
        ↓
JSON
        ↓
JavaScript
        ↓
Cards inside the Tilda layout
```

This approach preserves:

- the existing administration panel;
- the current publication workflow;
- the MySQL database;
- stored images;
- multilingual content;
- the exported Tilda design.

Most importantly, employees can continue publishing materials exactly as before while the new homepage retrieves them automatically.

## 6. Database Structure

The next step was to examine how the existing CMS stores publications.

The main table was identified in phpMyAdmin:

```text
content
```

It contains the data required for news and event cards.

Important fields:

| Field | Purpose |
|---|---|
| `id` | Unique database record |
| `locale` | Language version |
| `hash` | Logical material identifier |
| `published` | Publication status |
| `categ` | Content category |
| `important` | Display priority |
| `starttime` | Start or publication date |
| `endtime` | End date |
| `header` | Title |
| `subheader` | Short description |
| `thumbnail` | Image path |
| `html` | Full content |

A typical record contains both the publication data and a link to its image.

Example:

```text
id = 1560
locale = ru
hash = hash1560
published = 1
categ = 2
important = 9
starttime = 2024-07-04 02:00:00
endtime = 2024-10-10
thumbnail = uploads/content/hash1560/img2820.jpg
```

The relationship between the database record and the image is:

```text
content record
        ↓
hash1560
        ↓
thumbnail
        ↓
uploads/content/hash1560/img2820.jpg
```

This confirmed that the CMS already stores everything needed to build a card:

- title;
- short description;
- dates;
- language;
- category;
- priority;
- image;
- full text.

---

## 7. Language Versions

The CMS stores Russian and Hungarian versions as separate database rows.

Example:

```text
id 15 | locale = ru | hash = hash15
id 16 | locale = hu | hash = hash15
```

The same `hash` connects the language versions of one material:

```text
hash15
├── locale = ru
└── locale = hu
```

The fields work as follows:

- `id` identifies a specific database row;
- `hash` identifies the logical material;
- `locale` selects the language.

This means that the future API can switch languages using a simple condition:

```sql
WHERE locale = 'ru'
```

or:

```sql
WHERE locale = 'hu'
```

---

## 8. SQL Investigation

All SQL commands used during the investigation were read-only `SELECT` queries.

They did not change or delete website data.

### Latest Russian Records

```sql
SELECT
    id,
    locale,
    published,
    categ,
    important,
    starttime,
    endtime,
    header,
    thumbnail
FROM content
WHERE locale = 'ru'
ORDER BY id DESC
LIMIT 30;
```

This query showed that the table contains:

- published and unpublished records;
- several categories;
- different priority values;
- start and end dates;
- image paths.

### Number of Records by Category

```sql
SELECT
    categ,
    COUNT(*) AS total
FROM content
WHERE locale = 'ru'
GROUP BY categ
ORDER BY categ;
```

Result:

| Category | Records |
|---:|---:|
| `0` | 54 |
| `1` | 321 |
| `2` | 371 |
| `3` | 7 |

The Russian-language part of the database therefore uses four category values.

### Category `3`

```sql
SELECT
    id,
    published,
    important,
    starttime,
    endtime,
    header,
    subheader,
    thumbnail
FROM content
WHERE locale = 'ru'
  AND categ = 3
ORDER BY id DESC
LIMIT 10;
```

The query returned seven records.

Their titles were mainly related to:

- international programmes;
- international competitions;
- film festivals;
- educational projects;
- study visits.

This confirmed the actual content stored under category `3`.

---

## 9. Publication and Sorting Logic

The table uses the following values for publication status:

```text
published = 0
published = 1
```

A real request from the current website contained:

```sql
published = 1
```

This means that the examined website section retrieves only published materials.

The same request used:

```sql
ORDER BY important DESC, starttime DESC
```

The sorting logic is simple:

1. higher-priority records appear first;
2. records with the same priority are ordered by date.

Example:

```text
important = 9
```

appears before:

```text
important = 4
```

The relevant fields are:

```text
published
important
starttime
endtime
```

Some older records contain zero-date values:

```text
0000-00-00
0000-00-00 00:00:00
```

These values will need to be converted to `null` before they are sent to the new frontend.

---

## 10. Finding the Real CMS Requests

The available server files did not reveal the complete CMS source code.

The following hosting directory was inspected:

```text
/home/h011479956/ruscenter.hu/docs/
```

Visible items included:

```text
php
ruscenter
WEB-INF
index.php
```

The downloaded `index.php` contained rendered HTML and JavaScript rather than the original server-side PHP logic.

The investigation therefore moved to the working website itself.

Chrome DevTools was opened:

```text
DevTools
        ↓
Network
        ↓
Page Refresh
```

Several XHR requests were detected:

```text
uac.php
select.php
```

Multiple calls were made to:

```text
/php/select.php
```

The responses had different sizes, showing that the same handler retrieves different sets of data.

---

## 11. Request Method and Payload

The request headers confirmed:

```text
Request Method: POST
Request URL: /php/select.php
Content-Type: application/x-www-form-urlencoded
Status: 200 OK
```

The Payload tab contained three main parameters:

```text
fields
tables
condition
```

The selected table was:

```text
tables = content
```

The `fields` parameter also included date conversion expressions:

```sql
IFNULL(UNIX_TIMESTAMP(content.starttime), 0) AS start
```

```sql
IFNULL(UNIX_TIMESTAMP(content.endtime), 0) AS end
```

```sql
UNIX_TIMESTAMP(lmod) AS lastmod
```

These expressions prepare dates for processing in JavaScript.

---

## 12. Real CMS Query

One of the actual requests contained the following condition:

```text
locale='ru'
AND categ=2
AND published=1
ORDER BY important DESC, starttime DESC
LIMIT 5
```

Together with:

```text
tables = content
```

the request corresponds to this SQL logic:

```sql
SELECT *
FROM content
WHERE locale = 'ru'
  AND categ = 2
  AND published = 1
ORDER BY important DESC,
         starttime DESC
LIMIT 5;
```

The algorithm is:

```text
Open content
        ↓
Select Russian records
        ↓
Select category 2
        ↓
Keep published records
        ↓
Sort by priority
        ↓
Sort by start date
        ↓
Return five records
```

This was the key technical result of the database investigation: the real content-selection logic was recovered directly from a working website request.

---

## 13. Server Response

The `Response` tab showed structured data rather than a completed webpage.

Returned text fields could include HTML fragments:

```html
<p>
<strong>
<a href="...">
<br>
```

Russian text could be transferred as Unicode sequences:

```text
\u0434
\u0430
\u043d
\u043d
\u044b
\u0435
```

The browser then performs the following steps:

```text
Receive server response
        ↓
Decode text
        ↓
Read titles, dates and image paths
        ↓
Process HTML fragments
        ↓
Create cards
        ↓
Insert cards into the page
```

Therefore:

```text
select.php
```

returns data, while JavaScript builds the visible interface.

---

## 14. Reconstructed Existing Architecture

The current content-loading mechanism is:

```text
CMS Administration Panel
        ↓
content table
        ↓
Images in uploads/content/hashXXXX/
        ↓
POST /php/select.php
        ↓
MySQL query
        ↓
Structured response
        ↓
JavaScript
        ↓
Website cards
```

A simplified request looks like this:

```text
tables = content

condition =
locale='ru'
AND categ=2
AND published=1
ORDER BY important DESC, starttime DESC
LIMIT 5
```

This architecture confirms that the current CMS already separates:

- content management;
- database storage;
- server-side data retrieval;
- browser-side rendering.

---

## 15. Planned Integration Architecture

The investigation showed that the exported Tilda page can become the new visual layer while the existing CMS continues to manage all website content.

The planned architecture is:

```text
Existing CMS
        ↓
MySQL
        ↓
Read-only PHP API
        ↓
JSON
        ↓
JavaScript
        ↓
Existing Tilda sections
```

In this model:

- the CMS remains responsible for creating and editing content;
- MySQL remains the single source of information;
- the new homepage becomes responsible only for presentation;
- employees continue using the familiar administration panel.

No manual migration of news or events is required.

---

## 16. Proposed PHP API

Instead of allowing the frontend to execute arbitrary SQL requests, a dedicated read-only endpoint should be created.

Example:

```text
/api/home-feed.php
```

The endpoint should:

- accept the requested section;
- receive the language;
- validate the number of requested records;
- execute a predefined SQL query;
- prepare image URLs;
- normalize dates;
- return JSON.

Example request:

```text
/api/home-feed.php?type=news&locale=ru&limit=4
```

Example response:

```json
{
  "status": "ok",
  "items": [
    {
      "id": 1560,
      "hash": "hash1560",
      "header": "News title",
      "subheader": "Short description",
      "thumbnail": "/uploads/content/hash1560/img2820.jpg",
      "starttime": "2024-07-04 02:00:00"
    }
  ]
}
```

This keeps SQL logic on the server while exposing only the data required by the homepage.

---

## 17. JavaScript Integration

The new homepage should request JSON instead of using Tilda Feed.

Simplified workflow:

```text
JavaScript
        ↓
Request JSON
        ↓
Receive records
        ↓
Create cards
        ↓
Insert cards into the existing Tilda layout
```

Example:

```javascript
fetch('/api/home-feed.php?type=news&locale=ru&limit=4')
    .then(response => response.json())
    .then(data => {
        console.log(data.items);
    });
```

Each returned record already contains everything needed to create a card:

- title;
- short description;
- publication date;
- image;
- page identifier.

---

## Key Technical Findings

During the investigation the following facts were confirmed.

### Exported Tilda Page

The exported project already contains:

- HTML;
- CSS;
- JavaScript;
- responsive layout;
- navigation;
- slider;
- visual sections.

### Dynamic Sections

The following sections depend on external data:

```text
Our News
Our Upcoming Events
International Events
```

### Main Database Table

```text
content
```

### Important Fields

```text
locale
hash
published
categ
important
starttime
thumbnail
header
subheader
```

### Existing CMS Endpoint

```text
POST /php/select.php
```

### Request Parameters

```text
fields
tables
condition
```

### Confirmed SQL Logic

```sql
SELECT *
FROM content
WHERE locale = 'ru'
  AND categ = 2
  AND published = 1
ORDER BY important DESC,
         starttime DESC
LIMIT 5;
```

---

## Technologies Studied

- HTML
- CSS
- JavaScript
- PHP
- MySQL
- SQL
- phpMyAdmin
- JSON
- AJAX
- Fetch API
- Chrome DevTools
- Chrome Network Inspector
- HTTP POST
- Responsive Web Design
- Tilda Export
- Tilda Feed
- Reverse Engineering

---

## Tools Used

- Google Chrome
- Chrome DevTools
- Responsive Mode
- Network Panel
- Headers
- Payload
- Response
- phpMyAdmin
- RU-CENTER Hosting
- File Manager
- SQL SELECT queries
- Exported Tilda project
- ChatGPT

---

## Main Result

The complete content-loading mechanism of the existing website was reconstructed.

The investigation confirmed that:

- the exported Tilda page can be reused;
- only three sections require a new data source;
- publications are already stored in MySQL;
- the existing CMS retrieves them through `select.php`;
- JavaScript converts the server response into visual cards;
- the current administration panel can remain unchanged.

The future homepage will therefore use the following architecture:

```text
Employee
        ↓
Existing CMS
        ↓
MySQL
        ↓
Read-only PHP API
        ↓
JSON
        ↓
JavaScript
        ↓
Tilda design
```

---

## Practical Value

The modernization can be implemented without replacing the existing CMS.

The publishing workflow remains unchanged:

```text
Employee publishes news
        ↓
CMS stores the record
        ↓
MySQL updates
        ↓
Homepage requests new data
        ↓
Latest publication appears automatically
```

This approach preserves:

- the existing CMS;
- the current database;
- uploaded images;
- multilingual content;
- employee workflow;
- responsive design.

---

## Next Steps

The following tasks were identified for the next stage.

1. Identify SQL conditions used for the remaining homepage sections.

2. Map every Tilda block to its corresponding CMS query.

3. Develop a secure read-only PHP API.

4. Replace the Tilda Feed mechanism with JSON requests.

5. Test Russian and Hungarian versions.

6. Verify responsive behavior after integration.

7. Preserve backup copies before implementation.

---

## Final Conclusion

The third day marked the transition from reverse engineering to integration planning.

The investigation reconstructed the complete data path used by the current website:

```text
CMS
        ↓
MySQL
        ↓
select.php
        ↓
Structured response
        ↓
JavaScript
        ↓
Homepage cards
```

It also demonstrated that the exported Tilda design can be integrated with the existing CMS without rebuilding the entire website.

The CMS remains responsible for content management, while the new homepage becomes responsible only for presentation.

This architecture minimizes implementation risks, preserves the existing editorial workflow, and provides a solid technical foundation for the next stage of the project.

**Status:** Completed
