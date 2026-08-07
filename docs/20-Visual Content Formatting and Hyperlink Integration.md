# Day 20 — Visual Content Formatting and Hyperlink Integration

**Date:** 2026-08-07  
**Status:** completed  
**Day rating:** 5/5

---

# What was done — in simple terms

On Day 20, the publication editor learned to work with text almost like a regular word processor.

The `full_text` field already stored HTML, but editors had to format its content manually. The editor now displays formatted text visually and applies formatting through a toolbar.

The workflow is simple:

```text
write or paste text
        ↓
select a fragment
        ↓
choose formatting
        ↓
save the publication
```

The editor supports paragraphs, headings, bold, italic, underline, quotations, bulleted lists, numbered lists, hyperlinks and formatting cleanup.

The CMS still stores standard HTML in `full_text`. The visual editor does not replace the existing server model; it makes that model accessible to a non-technical content editor.

```text
visual editing
        ↓
generated HTML
        ↓
full_text
        ↓
home_feed_items
        ↓
public publication page
```

The result was verified in the administration panel and on a real public test publication.

---

# Main tasks of the day

1. Turn the main content field into a visual editor.
2. Preserve compatibility with `full_text`.
3. Add the main formatting commands.
4. Implement bulleted and numbered lists.
5. Add second- and third-level headings.
6. Create hyperlinks for selected text.
7. Add hyperlink removal.
8. Validate URLs before insertion.
9. Synchronise visual content with HTML before saving.
10. Verify reopening an existing publication.
11. Confirm the result on the public page.
12. Preserve a working JavaScript backup.

---

# Initial state

At the beginning of Day 20:

- the administration panel was operational;
- publications could be created and edited;
- the main image could be uploaded, replaced and removed;
- `full_text` was stored in `home_feed_items`;
- the public template already rendered HTML content;
- there was no complete visual content editor;
- links and structured formatting required manual HTML.

The objective was not to introduce a new data format. It was to build a convenient visual layer on top of the working `full_text` field.

---

# 1. Visual editing area

An editable HTML area was connected to the main content field:

```html
<div
    contenteditable="true"
    data-wysiwyg-editor
></div>
```

The user sees formatted content rather than raw tags.

The original form field remains available to PHP:

```text
name="full_text"
```

The two elements have different responsibilities:

```text
visual area
        ↓
editorial interface

full_text field
        ↓
server-side HTML value
```

---

# 2. Formatting toolbar

The toolbar provides:

```text
undo
redo
paragraph
H2
H3
bold
italic
underline
bulleted list
numbered list
quotation
add link
remove link
clear formatting
```

Each control uses:

```html
data-wysiwyg-command
```

A shared JavaScript handler reads the command and applies it to the current selection.

---

# 3. Synchronisation with `full_text`

The key synchronisation function is:

```js
syncWysiwygToTextarea();
```

It:

1. reads HTML from the visual area;
2. normalises formatting tags;
3. writes the result to `full_text`;
4. dispatches an `input` event;
5. runs again before form submission.

For example, visually formatted text becomes:

```html
We have reached <a href="https://ruscenter.hu/">real progress!</a>
```

The user works visually while the server receives normal HTML.

---

# 4. Paragraphs and headings

The editor supports semantic document structure:

```html
<p>Regular paragraph</p>

<h2>Section heading</h2>

<h3>Subheading</h3>
```

This makes it possible to build long publications with a clear hierarchy without typing tags manually.

---

# 5. Text emphasis

Selected text can be formatted as:

```html
<strong>bold text</strong>
<em>italic text</em>
<u>underlined text</u>
```

During synchronisation, browser-generated `<b>` and `<i>` tags are normalised:

```text
b → strong
i → em
```

---

# 6. Bulleted and numbered lists

Bulleted list:

```html
<ul>
    <li>First item</li>
    <li>Second item</li>
    <li>Third item</li>
</ul>
```

Numbered list:

```html
<ol>
    <li>First step</li>
    <li>Second step</li>
</ol>
```

Selected lines are converted into separate `<li>` elements. Both structures remain intact after saving and reopening the publication.

---

# 7. Hyperlink dialogue

A dedicated dialogue was created instead of using a browser `prompt()`.

```text
select a word or phrase
        ↓
click “Link”
        ↓
enter a full URL
        ↓
click “Add link”
        ↓
receive clickable text
```

If no text is selected, the editor displays a clear message asking the user to select the text first.

---

# 8. Preserving text selection

Opening a dialogue moves browser focus away from the content area. The editor therefore saves and restores the selected range with:

```js
saveWysiwygSelection();
restoreWysiwygSelection();
```

```text
select text
        ↓
save Range
        ↓
open dialogue
        ↓
enter URL
        ↓
restore Range
        ↓
apply hyperlink
```

The link is applied to the intended fragment even after the URL field receives focus.

---

# 9. URL validation

The address is validated before insertion.

Only the following protocols are accepted:

```text
https://
http://
```

An invalid address is rejected before an `<a href="...">` element can be created. The validation message is cleared automatically when the user edits the field again.

---

# 10. One hyperlink application function

All hyperlink creation is handled by:

```js
applyWysiwygLink();
```

It performs:

```text
element checks
        ↓
selection check
        ↓
URL validation
        ↓
focus and Range restoration
        ↓
link creation
        ↓
full_text synchronisation
```

The same function is called by:

- the **Add link** button;
- the `Enter` key in the URL field.

This keeps the behaviour consistent and avoids duplicated link logic.

---

# 11. Removing hyperlinks

The **Remove link** command removes the `<a>` element while preserving its text.

```html
<a href="https://ruscenter.hu/">progress!</a>
```

becomes:

```text
progress!
```

The updated content is immediately synchronised with `full_text`.

---

# 12. Clearing formatting

The cleanup command removes unwanted formatting and returns the selected content to a regular paragraph.

This is particularly useful when content is pasted from Word, email or another website.

---

# 13. Administration panel verification

The test publication verified:

- regular text;
- a hyperlink;
- a bulleted list;
- a numbered list;
- an `H2` heading;
- HTML synchronisation;
- saving and reopening.

The editor produced valid structured content such as:

```html
We have reached <a href="https://ruscenter.hu/">real progress!</a>

<ul>
    <li>1</li>
    <li>2</li>
    <li>3</li>
</ul>

<ol>
    <li>Yes</li>
    <li>No</li>
</ol>

<h2>Is it really working?!</h2>
```

---

# 14. Public page verification

The test publication was opened through the pretty URL:

```text
/new-home/ru/news/test-novogo-redaktora
```

The public page correctly displayed:

- date;
- title;
- main image;
- main content;
- clickable hyperlink;
- the “Other news” column.

This confirmed the complete data route:

```text
editor
        ↓
HTML
        ↓
MySQL
        ↓
PHP template
        ↓
public page
```

---

# Verified results

## Visual editor

- content is edited directly in the visual area;
- selection survives the hyperlink dialogue;
- commands affect the intended text;
- raw HTML is no longer required for routine formatting.

## HTML and saving

- `full_text` receives current HTML;
- an empty editor saves an empty value;
- `b` and `i` tags are normalised;
- synchronisation runs before saving.

## Hyperlinks

- a link is added to selected text;
- the URL is validated;
- the confirmation button works;
- the `Enter` key works;
- the link can be removed without deleting its text.

## Lists and headings

- bulleted lists persist;
- numbered lists persist;
- `H2` headings persist;
- the structure is restored when the publication is reopened.

## Public page

- stored HTML renders correctly;
- the hyperlink remains clickable;
- the main image is preserved;
- neighbouring page components remain stable.

---

# Main files

```text
/docs/new-home/admin/publication-edit.php
/docs/new-home/admin/assets/js/admin-editor.js
/docs/new-home/news.php
```

Main table and field:

```text
home_feed_items.full_text
```

---

# Architecture after Day 20

```text
publication-edit.php
        ├── formatting toolbar
        ├── contenteditable area
        ├── hyperlink dialogue
        └── full_text field
                ↓
        admin-editor.js
        ├── formatting commands
        ├── Selection API
        ├── Range API
        ├── URL validation
        └── HTML synchronisation
                ↓
        publication save
                ↓
        home_feed_items.full_text
                ↓
        news.php
                ↓
        public publication page
```

---

# Technologies practised

- HTML5 `contenteditable`;
- JavaScript DOM API;
- Selection API;
- Range API;
- URL API;
- visual text formatting;
- HTML and form synchronisation;
- semantic `strong` and `em` tags;
- `ul`, `ol` and `li` lists;
- `a href` hyperlinks;
- PHP;
- MySQL;
- dynamic publication templates;
- pretty URLs.

---

# Main achievement of the day

The publication editor changed from a technical HTML form into a practical editorial tool.

```text
manual HTML formatting
        ↓
visual editor
        ↓
structured full_text
        ↓
finished public publication
```

An editor can now prepare content with headings, lists and hyperlinks without directly writing tags, while the website still receives clean structured HTML.

---

# Day rating

## 5 out of 5

Day 20 deserves the highest rating because the complete main-content workflow was finished:

- a visual interface was created;
- compatibility with `full_text` was preserved;
- the main formatting commands were connected;
- both list types were implemented;
- hyperlinks were added and verified;
- URL validation was introduced;
- the result is stored in MySQL;
- the public page renders the saved HTML correctly;
- a working JavaScript version was preserved as a backup.

This was not a cosmetic improvement. It was the transition from a technical form to an editor suitable for everyday work.

---

# Next steps

1. Test formatting with a long real publication.
2. Add a server-side allowlist for permitted HTML tags and attributes.
3. Test content pasted from Word and other external sources.
4. Add a convenient way to edit an existing hyperlink.
5. Test the editor on mobile devices.
6. Connect the editor to `event` and `international` publication types.
7. Continue developing the publication archive, filters and search.
8. Prepare the Russian–Hungarian editorial workflow.

**Status:** Day 20 completed.
