# Day 30. First Pages, a Unified Header and a Modern Design System

## Goal of the day

Start filling the main sections of the new website with real pages and make them accessible directly from the horizontal navigation menu.

At the same time, the Header had to be made visually consistent on standard pages, the “News and Media” overview, the complete news archive and individual publication pages.

The final goal was not a collection of similar but independent pages. It was one understandable system:

```text
one horizontal menu
        ↓
real RU / HU pages
        ↓
shared Header, styles and design rules
```

---

## Complex things in simple words

A website page is not only the text visible to a visitor. It is usually assembled from several parts:

- a shared Header — the top area and main navigation;
- the content of the current page;
- CSS — the visual rules;
- a shared Footer — the bottom area of the website.

If one page loads the current Header and another page loads an old copy, the result looks like two different websites. If the HTML structure is new but the CSS is old, controls also lose their intended size and position.

The main task was therefore not to restyle every page separately. It was to return all pages to the same shared components and the same rules.

---

## What was implemented

### 1. The first real pages were connected to the horizontal menu

Some navigation items were previously temporary. A link could contain `#` or lead to a placeholder page. It looked complete, but did not open a finished section.

Working destinations were defined in the shared file:

```text
/new-home/includes/header.php
```

This file provides a destination for every completed section. For example:

```php
$aboutUrl = $isHu
    ? '/new-home/hu/the-russian-culture-centre-in-budapest.php'
    : '/new-home/the-russian-culture-centre-in-budapest.php';

$newsUrl = $isHu
    ? '/new-home/hu/media/'
    : '/new-home/ru/media/';

$educationUrl = $isHu
    ? '/new-home/hu/education-in-russia.php'
    : '/new-home/education-in-russia.php';
```

In simple terms, the Header first identifies the page language and then inserts the appropriate Russian or Hungarian URL.

The first fully operational horizontal-menu items are:

- “О центре” / `A központról`;
- “Новости и анонсы” / `Hírek és programok`;
- “Обучение в России” / `Tanulás Oroszországban`.

For a visitor, this is just a menu click. For the project, it is an important architectural change: one Header structure serves both languages, so two independent menus do not need to be corrected manually.

---

### 2. Russian and Hungarian “About the Centre” pages were completed

The page about the Russian Cultural Centre now has complete Russian and Hungarian versions.

The page now includes:

- the shared structure of the new website;
- an active link to the Centre’s official website;
- a meaningful alternative description for the image;
- a clean, centred photograph caption;
- the back link in the familiar position above the content;
- an information sidebar following the same principle as the news pages.

An image 404 error was also fixed. The reason was simple: the address written in the code must match the real server filename exactly, including every character, the file extension and the directory.

---

### 3. “Study in Russia” pages were created in both languages

Two separate visitor entry points were prepared:

```text
/new-home/education-in-russia.php
/new-home/hu/education-in-russia.php
```

The pages received:

- Russian and Hungarian content;
- a clear section structure;
- active links to official information resources;
- the shared Header and Footer;
- a compact blue title block with white text;
- a back-to-home link above the title;
- a side action panel based on the publication page;
- responsive behaviour on narrow screens.

The important point for someone who has never worked with a CMS is this: the page is already a complete PHP file. Once it is uploaded to the correct directory, it works, and its menu destination is defined once in the shared Header.

---

### 4. The Header markup and Header styles were brought back into sync

During the update, a common but disruptive issue was discovered: some pages were using an incomplete or outdated Header version, while the stylesheet expected a different HTML structure.

As a result, the top area could look oversized, misaligned or unexpectedly empty. The problem was not in the page content. It was a mismatch between two parts of the same component:

```text
Header markup ≠ Header CSS
```

The correction was applied systematically:

1. the current shared `header.php` was restored;
2. its matching `header.css` was connected;
3. stylesheet URLs were made absolute from `/new-home/`;
4. a version was added to the CSS URL so browsers would not display an old cached file;
5. routes for the first completed pages were changed only in the shared source.

After this change, the Header became consistent again on the home page, standard information pages and all news-related screens.

---

### 5. Every level of the news section was made consistent

The news area contains several different screens:

```text
“News and Media”
        ↓
“All News”
        ↓
an individual publication
```

Their browser URLs look different, but all of them must use the same Header. Previously, some levels displayed an older version of the website top area.

The shared Header and CSS connections were checked and aligned for:

- the “News and Media” overview;
- the “All News” page;
- the full publication page;
- Russian and Hungarian routing.

The important technical detail is easy to explain: a clean news URL may look like a nested directory, but `.htaccess` passes it to a shared PHP template. The template must therefore include the Header from the project’s real directory, while styles should use absolute URLs.

The result is consistent: moving from the overview to the archive and then to a full publication no longer changes the appearance of the website Header.

---

### 6. Styles were put in order

The problem was not a lack of CSS. It was that several rules could try to style the same element at the same time.

Responsibilities were clarified:

- `header.css` controls the Header;
- `page-template.css` controls standard information pages;
- `repository.css` controls publication archives and lists;
- `news.css` controls a full news page;
- `footer.css` controls the Footer;
- page-specific rules are used only where a genuinely unique layout is required.

The “Study in Russia” page was synchronised with the “News and Media” page:

- the same main container width;
- the same top spacing;
- the same back-link position;
- the same title font size and internal blue-block padding;
- the same responsive logic on mobile screens.

A “double styling” effect was also removed. Previously, background and padding could be applied to both the outer wrapper and the title itself, producing a block larger than intended. The blue background now occupies exactly the area required by the title.

Versioned CSS URLs make the browser receive the new design immediately after an update:

```html
<link rel="stylesheet" href="/new-home/css/header.css?v=20260909-1">
```

The part after `?v=` does not create another file. It tells the browser to download the existing stylesheet again instead of using an old cached copy.

---

### 7. A modern design was chosen without abandoning the corporate identity

A modern interface does not require replacing an organisation’s visual character.

The Centre’s recognisable foundations were preserved:

- the corporate blue colour;
- a white background and calm neutral palette;
- the official logo;
- strict horizontal navigation;
- a clear information hierarchy.

The contemporary quality comes from other decisions:

- compact colour title blocks instead of heavy decorative banners;
- more breathing room between content sections;
- modular cards and side panels;
- thin borders and restrained corner rounding;
- responsive type sizes using `clamp()`;
- visible but restrained link states;
- one spacing rhythm across different pages.

The result is not an unrelated fashionable template. It is an updated digital version of the Centre’s existing identity: official, calm and recognisable, but lighter and easier to read.

---

## How to repeat this transition from the start

For someone with no CMS experience, the sequence is:

1. Complete the new page and test its direct URL first.
2. Upload the PHP file to the correct server directory.
3. Open the shared `/new-home/includes/header.php` file.
4. Find the variable for the relevant menu item and replace the temporary URL with the working one.
5. Do not copy the Header into every page; include the shared component.
6. Confirm that CSS is loaded from an absolute `/new-home/css/...` path.
7. Change the number after `?v=` when a stylesheet is updated.
8. Open the home page, “News and Media”, “All News” and an individual publication.
9. Check both Russian and Hungarian versions.
10. Force-refresh the browser with `Ctrl + F5`.

This sequence helps distinguish three different causes:

```text
wrong link → the page does not open
wrong include → the wrong Header appears
old CSS cache → the code is fixed, but the old appearance remains
```

---

## Result

- the first real sections open from the horizontal menu;
- Russian and Hungarian destinations are selected by the shared Header;
- complete “About the Centre” pages are available;
- complete “Study in Russia” pages are available;
- official links inside the new content are active;
- the incorrect image path was fixed;
- standard pages and all news levels now use the current Header;
- “News and Media”, “All News” and full publication pages no longer look like different website versions;
- CSS behaviour is more understandable and predictable;
- title blocks and back links are synchronised across sections;
- the new design preserves the Centre’s corporate colours and official character;
- the changes were verified on the live website.

---

## Day result

**Score: 5/5.**

The maximum score does not mean that no issues appeared during the work. It means that every discovered problem was traced to an understandable system-level cause and corrected for the whole relevant group of pages, not just for one screen.

In one working day, the first content sections became part of the real horizontal navigation, the Header was stabilised across information and news pages, style responsibilities became clear, and the new visual language was brought into one modern but recognisably corporate system.

**Final score for Day 30: 5/5.**
