# Day 22 — Connecting the Media Library to Publications and Updating Public CMS Cards

**Date:** 2026-08-11–2026-08-12  
**Status:** completed  
**Day rating:** 5/5

---

# What was done — in plain language

On Day 22, the media library stopped being an isolated catalogue and became part of the real editorial workflow.

An editor no longer needs to upload the same image again or copy a server path manually. A main image can now be selected directly from the media library in a dedicated dialog and assigned to a publication.

One selected file is reused in two places:

```text
card in a feed or carousel
            +
main image on the full publication page
```

Public cards for news, announcements, and international events were also updated. They now receive images, hashtags, event dates, and locations. The full publication page gained a clearer layout and a separate sharing panel.

---

# Main objectives

1. Connect the media library to the publication main-image field.
2. Create a dedicated image-selection dialog.
3. Add search and filters inside the selector.
4. Return the selected file path to the editor.
5. Update the preview without reloading the page.
6. Save the selected path with the publication.
7. Reuse one image in the card and on the full page.
8. Verify news, announcements, and international events.
9. Place new publications at the beginning of the relevant feeds.
10. Display hashtags in cards and full pages.
11. Display event start and end dates.
12. Display the event location on its own line.
13. Improve tag presentation.
14. Add publication sharing and a print version.
15. Use one public-page architecture for all publication types.

---

# Initial state

At the beginning of Day 22:

- the media library already displayed CMS uploads and existing website files;
- images could be searched, filtered, and deleted;
- multiple selection was available;
- new images were optimized automatically;
- publications already had an `image_path` field;
- selecting an existing image still required a manual route;
- cards from different sections displayed data inconsistently;
- dates, locations, and hashtags were not available in every required component.

The main objective was to connect the existing parts into one editorial process.

---

# 1. “Choose from media library”

A dedicated command was added to the main-image card:

```text
Choose from media library
```

The editor now has two clear workflows:

```text
new file → upload image

existing file → choose from media library
```

Existing visual materials can therefore be reused without creating duplicates.

---

# 2. Image-selection dialog

The media library opens in a dedicated modal above the publication form.

It provides:

- a visual card grid;
- search by title or filename;
- an “All” filter;
- a “CMS uploads” filter;
- a “Website files” filter;
- a preview of the active image;
- technical file information;
- a “Use image” button.

The publication editor remains open, and entered content is preserved.

---

# 3. Selection without another upload

After confirmation, JavaScript reads the selected media card and performs three actions:

```text
file path → image_path
        ↓
preview refresh
        ↓
dialog closes
```

The file is not copied or uploaded again. The publication points to the existing media object.

---

# 4. One main image

The current stage deliberately uses one main image per publication.

It appears in:

- the news carousel;
- the announcements and international events carousel;
- the publication repository;
- the full news, announcement, or event page.

An additional in-post gallery is intentionally outside the present scope. This keeps the data model clear and avoids premature complexity.

---

# 5. New publications at the beginning of a feed

Public queries and sorting were checked.

A new published item follows this route:

```text
matching publication type
        +
matching locale
        +
Published status
        ↓
card in the corresponding feed
```

The new international publication successfully appeared in the combined announcements and events section and received its own full page.

---

# 6. Event dates

Announcements and international events use two separate values:

```text
event_start
event_end
```

Cards display them as a compact period. The full page uses explicit labels:

```text
Start: 16 September 2026
End: 20 September 2026
```

Regular news continues to use its publication date and does not receive irrelevant event fields.

---

# 7. Event location

The `event_location` value is displayed on a separate row below the event period:

```text
Location: Budapest, Centre for Further Professional Education
```

The location no longer competes with dates and remains easy to scan in both cards and full pages.

---

# 8. Hashtags

Keywords now work as visible publication tags.

They appear:

- below the image on the full page;
- in combined repository cards;
- in the announcements and international events carousel.

Long tags wrap inside their own visual badge without breaking the grid.

---

# 9. Unified public components

The following components were aligned:

```text
home feed
news carousel
events carousel
repository query
repository card
full publication template
```

They use the same data from `home_feed_items` while presenting it appropriately for each context.

---

# 10. New full-page layout

The title now sits above the two-column area and uses the full page width.

The main grid begins below it:

```text
main image                     ← Back to homepage
                               Share panel
                               Related publications
```

Long titles receive more space, while the right sidebar begins at the same horizontal level as the top of the main image.

The same structure is reused for:

- news;
- Centre announcements;
- international events.

---

# 11. Sharing panel

The right sidebar contains commands for:

```text
MAX
VK
Odnoklassniki
WhatsApp
Telegram
X
Instagram
Facebook
```

The first six controls are placed on one row. The remaining services and the following command appear below:

```text
Print version
```

For MAX and Instagram, where a universal web sharing endpoint is limited, the publication URL is copied before the service opens.

---

# 12. Print version

The print command starts the browser’s standard print dialog:

```js
window.print();
```

Print styles hide:

- the website header;
- the sidebar;
- social controls;
- service navigation.

The publication content remains available for paper output or PDF export.

---

# 13. Verified scenarios

The following workflows were tested in practice:

- opening the media library from the editor;
- image search and filtering;
- selecting an existing file;
- preview refresh;
- publication saving;
- reopening the editor;
- displaying the image in a card;
- displaying the same image on the full page;
- publishing a new international event;
- displaying the event period and location;
- displaying hashtags;
- handling a long title;
- using the sharing panel;
- preparing a print version.

---

# Why the rating is 5/5

Day 22 received the maximum rating because its stated objective was completed, not because there are no further ideas.

By the end of the stage:

- the media library is genuinely connected to publications;
- the main image can be selected without a manual path;
- one file is reused in every intended area;
- news, announcements, and events share one architecture;
- new records appear in public sections;
- dates, locations, and tags are visible;
- the full publication page is clearer and more functional.

Replacing letter labels with authentic local SVG social-network logos remains a separate visual refinement. It does not block the feature and does not reduce the completeness of the main task.

---

# Result of the day

The main result of Day 22 can be summarized as follows:

```text
media library
        ↓
select existing image
        ↓
publication editor
        ↓
save image_path
        ↓
feed card + full publication page
```

The CMS now provides one complete editorial route from image selection to public publication display.

**Final rating: 5/5.**

