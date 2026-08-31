# Day 27 — Full HU Version on a Shared Component Architecture

**Date:** 2026-08-30  
**Status:** completed  
**Day score:** 5/5

---

# What was done — in simple terms

The goal of Day 27 was to turn the previously prepared second-language support into a genuinely working Hungarian public version without creating a separate copy of the entire website.

If this goal had been defined from the start, the ideal sequence would have been:

```text
one website architecture
        ↓
current locale ru / hu
        ↓
shared Header / Hero / Footer
        ↓
localized news carousel
        ↓
localized publication page
        ↓
HU publications from the same CMS
        ↓
localized Studios & Courses section
        ↓
complete HU homepage
```

The key result: the HU version stopped being a technical placeholder. It now uses the same component foundation as the main version while receiving its own interface text, publications, dates, labels and routes.

---

# Main task of the day

The task was to build a working second-language version without duplicating the website.

This required:

- one current-locale variable;
- a bilingual shared Header;
- a shared Hero filtered by locale;
- HU news on the homepage;
- HU routes;
- a localized individual publication page;
- the first real HU publications;
- the complete Studios & Courses block on the HU homepage;
- a locale-aware Footer;
- one shared set of PHP, CSS and JavaScript components.

---

# 1. One variable controls the page language

The HU entry point defines:

```php
<?php
$currentLocale = 'hu';
?>
```

Shared components receive this value and select the required labels and data.

```text
$currentLocale = 'ru' → RU interface
$currentLocale = 'hu' → HU interface
```

Separate Header, Hero and Footer copies are therefore unnecessary.

---

# 2. Header moved to shared RU/HU logic

A single `header.php` now renders the interface according to the current locale.

Service labels, menu items, language switching, home navigation, routes and accessibility elements follow the selected language.

Future structural changes to the Header can be made once instead of being repeated for every language.

---

# 3. Hero is reused instead of duplicated

The Hero slider is connected to the CMS and its records contain a locale. The same public component is therefore reused for HU:

```text
Hero table
   ↓
locale = ru / hu
   ↓
hero-slider.php
   ↓
slides for the required language
```

A second Hero module was not required.

---

# 4. HU homepage assembled from shared components

A complete HU homepage replaced the earlier placeholder.

Its structure is:

```text
Header
Hero
Híreink
Stúdiók és tanfolyamok
Footer
```

The page acts as an assembly point for shared components rather than as a duplicated website.

---

# 5. News carousel became locale-aware

One API component serves both language versions. Published news is filtered by the requested locale, so RU receives RU content and HU receives HU content.

```sql
WHERE content_type = 'news'
  AND locale = ?
  AND is_published = 1
```

The same sorting and card-generation logic is reused.

---

# 6. Dates are localized programmatically

Stored dates remain normal database values, while the public component formats them for the active locale.

```text
RU → day + month + year
HU → year + month + day
```

This keeps content storage independent from display formatting.

---

# 7. Shared routes prepared for RU and HU

Routing is built around locale-aware paths for media, news, events and individual publication slugs.

The same routing system serves both languages instead of maintaining two unrelated sets of pages.

---

# 8. Individual publication page localized

One publication page serves both locales.

For HU, interface elements such as the date, return navigation, sharing area, print action, event fields, accessibility labels and supporting messages follow the selected locale.

```text
locale + slug
     ↓
one publication page
     ↓
correct content + correct interface
```

---

# 9. First four HU publications added through the CMS

The first Hungarian materials were created with localized titles, body text, subtitles where required, slugs, SEO fields, tags, dates and publication status.

After publication they automatically appeared in the HU news carousel and opened through the HU publication route.

---

# 10. Entire Studios & Courses block added at once

Instead of rebuilding cards one by one, the complete six-card component was transferred in one pass.

Existing HTML structure, images, CSS, responsive grid and card behavior were reused. Language data and routes were adapted for HU.

Until unfinished internal HU sections are ready, their links can safely point to a shared under-construction page.

---

# 11. No separate HU CSS was created

The HU homepage reuses the existing Header, Hero, carousel, studios and Footer styles.

This preserves one visual system and reduces maintenance overhead.

---

# 12. Footer became locale-aware

The existing shared Footer was extended rather than duplicated.

It receives `$currentLocale` and renders the corresponding interface text. A separate language-specific Footer file is therefore unnecessary.

---

# 13. Final HU homepage became the assembly point

The resulting architecture is:

```text
HU homepage
    ↓
shared Header
    ↓
shared Hero
    ↓
locale-aware news carousel
    ↓
HU Studios & Courses
    ↓
shared locale-aware Footer
```

The language version is assembled from modules rather than copied as a standalone site.

---

# Resulting architecture after Day 27

```text
                  $currentLocale
                    /       \
                  ru         hu
                   \         /
                    shared Header
                         ↓
                    shared Hero
                         ↓
                 locale-aware API
                         ↓
             publications by locale
                         ↓
              shared publication page
                         ↓
                  homepage sections
                         ↓
                    shared Footer
```

---

# What changed for the editor

Adding second-language material no longer requires editing homepage PHP. The editor creates a CMS publication, selects the locale, fills in content and SEO fields, chooses an image and date, and publishes it. The material then enters the correct language feed automatically.

---

# What changed for the visitor

The HU version now provides a localized Header, HU Hero slides, HU news, Hungarian date formatting, HU publication pages, the Studios & Courses block and a localized Footer. The visitor sees a coherent language version rather than a technical placeholder.

---

# Verified result

- HU homepage works with the HU locale;
- Header switches correctly between RU and HU;
- Hero receives records for the required locale;
- HU news carousel works;
- the first four HU publications were added successfully;
- published HU materials appear automatically;
- dates use Hungarian formatting;
- individual publication interface is localized;
- HU routes use the shared routing model;
- all six Studios & Courses cards are present;
- shared CSS is reused;
- Footer is locale-aware;
- the HU homepage is assembled from shared components;
- separate Header, Hero and Footer copies are not required.

---

# Main files involved

```text
/new-home/hu/index.php
/new-home/includes/header.php
/new-home/includes/hero-slider.php
/new-home/includes/footer.php
/new-home/api/news-carousel.php
/new-home/news.php
/new-home/.htaccess
/new-home/css/header.css
/new-home/css/hero.css
/new-home/css/content-carousel.css
/new-home/css/studios.css
/new-home/css/footer.css
/new-home/js/hero.js
/new-home/js/content-carousel.js
```

The important point is not the number of files, but that existing components were extended for the second language instead of creating a parallel system.

---

# Technologies and skills practiced

- PHP locale-aware templates;
- shared PHP components;
- RU/HU localization;
- MySQL filtering by locale;
- prepared statements;
- multilingual CMS content;
- slug-based routing;
- Apache RewriteRule;
- locale-aware URLs;
- localized date formatting;
- HTML escaping;
- SEO localization;
- reusable CSS;
- accessibility labels;
- multilingual publication workflow;
- second-language migration without architecture duplication.

---

# Main achievement of the day

Day 27 converted the second language from a prepared technical capability into a functioning public version built on the same reusable architecture as the main site.

---

# Day 27 score

## 5/5

The score is justified because the language version was implemented without parallel component duplication, real HU content was connected through the CMS, routing and publication rendering became locale-aware, and the public homepage now works as one coherent multilingual system.

**Day 27 result: 5/5 — a complete HU public version was assembled on top of the shared component architecture.**
