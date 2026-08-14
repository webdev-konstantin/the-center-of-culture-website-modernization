# Day 24 — Shared Footer and Standard Section Page Template

**Date:** 2026-08-13–2026-08-15  
**Status:** completed  
**Day score:** 4.7/5

---

# What was done — in plain language

Day 24 gave the website two important reusable building blocks: a shared footer and a standard template for internal sections.

Previously, the footer had to be connected and checked page by page, while new informational sections had no common structure. The shared elements are now stored in reusable PHP and CSS files.

The resulting structure is straightforward:

```text
shared header
        ↓
page-specific content
        ↓
shared footer
```

A standard template was also prepared for pages such as “About the Centre”, “Study in Russia”, “Russian Language”, “Projects and Programmes”, and other main-menu sections.

---

# Main tasks of the day

1. Transfer the footer without third-party analytics or redundant code.
2. Connect one shared footer to the public website pages.
3. Add the Centre logo, satellite-site notice, and contact details.
4. Prepare accurate wording about cookies and technical data.
5. Fix the footer on the “News and Media” page.
6. Build a reusable template for internal pages.
7. Match the main heading to the “News and Media” design.
8. Add a lead image, alt text, caption, and information sidebar.
9. Prepare responsive and print layouts.

---

# 1. A shared footer without unnecessary external services

An external footer was used only as a visual reference. The new project received only the useful structure and styling.

The final version excludes:

```text
Yandex Metrika
Google Analytics
Google Tag Manager
Tilda Stats
third-party counters
redundant inline scripts
```

The footer is split into two shared files:

```text
/new-home/includes/footer.php
/new-home/css/footer.css
```

This means that footer content or styling can be updated once and reused by every connected page.

---

# 2. Footer information and contact details

The footer now contains:

- the Centre logo;
- a link to the official website;
- an explanation that this is a satellite website;
- the Budapest address;
- telephone and fax numbers;
- the official email address;
- a short explanation of the website’s purpose.

The contacts are arranged in a separate column, turning the footer into a useful information block rather than a purely decorative ending.

---

# 3. Accurate notice about technical data

The initial statement that no data is processed at all was refined. Even when the website itself does not use analytics, the hosting provider may automatically create technical logs.

The final notice states that:

```text
the website does not use analytics or advertising cookies;
the website does not analyse visitor behaviour;
the hosting provider may process limited technical information
for operation and security;
the data is not used for advertising or user profiling;
the website serves informational and educational purposes.
```

The expression “user tracking” was replaced with the more neutral and accurate “visitor behaviour analysis”.

---

# 4. Connecting the footer to public pages

The shared footer is connected to:

```text
the homepage;
detailed news pages;
RCC announcement pages;
international event pages;
publication repositories;
the “News and Media” page.
```

The standard include is:

```php
<?php
require_once __DIR__ . '/includes/footer.php';
?>
```

It is placed after the main content and before the closing `body` and `html` tags.

---

# 5. Diagnosing the “News and Media” page

At:

```text
/new-home/ru/media/
```

the page opened correctly, but the footer did not appear.

The issue was not in `footer.php`. The end of `media.php` contained duplicate closing tags and the include was placed incorrectly.

The correct file ending is:

```php
</main>

<?php
require_once __DIR__ . '/includes/footer.php';
?>

</body>
</html>
```

After removing the duplicates, the footer rendered correctly.

---

# 6. Controlling the logo size

When first connected, the logo was much larger than the footer area because it had no size constraint in the new page context.

The dimensions were controlled in CSS:

```css
.site-footer__logo-image {
    display: block;
    width: 100%;
    max-width: 150px;
    height: auto;
}
```

The logo now preserves its proportions, stays inside its column, and adapts to the viewport.

---

# 7. Standard internal-page template

A reusable PHP template was created for main-menu sections.

Page-specific settings are defined at the beginning of the file:

```php
$pageTitle = 'Centre for Further Professional Education';
$pageDescription = '...';
$pageEyebrow = 'ABOUT THE CENTRE';
$pageLead = '...';
$currentLocale = 'en';
$pageImage = '/new-home/img/example.jpg';
$pageImageAlt = 'Image description';
$pageImageCaption = 'Image caption';
```

The rest of the architecture remains shared.

This makes a new page a matter of filling in several clear parameters instead of copying unrelated fragments.

---

# 8. Standard page structure

The final template contains:

```text
shared header
breadcrumbs
section eyebrow
main heading on a blue background
lead paragraph
lead image
alt text
image caption
main article
“Additional information” sidebar
shared footer
```

The content area uses a two-column grid:

```text
main content               additional information
```

On smaller screens, the columns automatically become one vertical flow.

---

# 9. Heading matched to “News and Media”

The primary `h1` now uses the same blue background and dimensions as the existing public section.

```css
.standard-page__title {
    display: inline-block;
    margin: 0;
    padding: 18px 30px;
    color: #ffffff;
    background: #223b82;
    font-size: clamp(28px, 4vw, 44px);
    line-height: 1.15;
    font-weight: 700;
}
```

The page title and the article heading no longer duplicate one another:

```text
h1 → section title
h2 → meaningful subsection inside the article
```

---

# 10. Lead image, alt text, and caption

The template now contains a semantic `figure` block:

```html
<figure class="standard-page__figure">
    <img
        class="standard-page__image"
        src="..."
        alt="..."
    >
    <figcaption class="standard-page__caption">
        ...
    </figcaption>
</figure>
```

This provides:

- consistent image scaling;
- an accessible text alternative;
- an editorial caption;
- sizing consistent with publication lead images;
- clean alignment with the sidebar.

---

# 11. Reducing unnecessary top spacing

The distance between the main navigation and the breadcrumbs was reduced in `page-template.css`.

The top of the page is now more compact, allowing visitors to reach the heading and content faster.

The change preserves:

- visual separation between the header and content;
- readability;
- responsive behaviour;
- safe spacing on mobile screens.

---

# 12. Main files

```text
/new-home/includes/header.php
/new-home/includes/footer.php
/new-home/css/header.css
/new-home/css/footer.css
/new-home/css/page-template.css
/new-home/index.php
/new-home/media.php
/new-home/news.php
/new-home/repository.php
```

New informational pages are based on the standard PHP template and use the same shared components.

---

# Architecture after Day 24

```text
header.php
        ↓
standard or dynamic page
        ├── homepage
        ├── news and events
        ├── repositories
        ├── “News and Media”
        └── informational sections
        ↓
footer.php
```

For informational sections:

```text
page settings
        ↓
shared PHP structure
        ↓
page-template.css
        ↓
consistent responsive interface
```

---

# Verified results

## Shared components

- the header continues to work;
- the footer appears on all tested public pages;
- third-party analytics scripts are absent;
- contact details and the technical notice are visible;
- the logo uses a safe responsive size.

## “News and Media” page

- the footer is connected;
- duplicate closing tags were removed;
- existing page content remains intact.

## Standard template

- the heading uses the available width;
- the blue background matches “News and Media”;
- the image and sidebar are aligned;
- alt text and the caption work;
- the grid rearranges on mobile devices;
- the footer is connected consistently.

---

# Technologies practised

- PHP `include` and `require_once`;
- reusable components;
- semantic `header`, `main`, `article`, `aside`, `figure`, and `footer` elements;
- HTML escaping with `htmlspecialchars`;
- CSS Grid and Flexbox;
- responsive typography with `clamp()`;
- accessible alt descriptions;
- breadcrumbs;
- responsive design;
- print styles;
- diagnosing closing-tag order;
- removing third-party analytics;
- accurate disclosure of technical data processing.

---

# Main achievement of the day

The website now has a unified outer structure and a foundation for quickly creating new sections.

```text
separate page implementations
        ↓
shared header and footer
        ↓
standard section template
        ↓
predictable responsive layout
        ↓
simpler future website development
```

The remaining main-menu sections can now be migrated systematically without designing every screen from scratch.

---

# Day score

## 4.7 out of 5

The day ended with a strong working result:

- a shared footer was created;
- unnecessary analytics were removed;
- contact details and an accurate technical notice were added;
- the footer was connected to public pages;
- the “News and Media” page was fixed;
- a standard internal-page template was created;
- the main heading was unified;
- an image, alt text, caption, and sidebar were added;
- responsive behaviour was prepared.

The score is not rounded up to 5/5 because the integration required several correction cycles: the footer connection in `media.php`, duplicate closing tags, logo sizing, and exact heading matching were not completed on the first attempt.

This does not diminish the completed result, but it makes the assessment honest: the functionality is finished, while the implementation process can still become more precise and efficient.

---

# Next logical step

Use the completed template to migrate the remaining informational sections of the main menu, then introduce a shared multilingual architecture after the Russian version has stabilised.
