# Day 6 — Development of the Standalone "Latest News" Component

**Date:** 2026-07-17  
**Status:** Completed

---

## Development Photos

> You may place 2–4 screenshots here:
>
> - project structure;
> - completed News section;
> - carousel in operation;
> - final homepage layout.
>
> Example:
>
> ```text
> /images/day06/news-block.png
> /images/day06/news-carousel.png
> /images/day06/final-layout.png
> ```

---

# Objective

Develop a fully standalone **Latest News** component capable of running independently from PHP, MySQL and the existing CMS.

The objective was to create a reusable HTML/CSS/JavaScript module that could later receive dynamic data from the current CMS without changing its visual appearance.

Planned architecture:

```text
index.html
        ↓
HTML Layout
        ↓
CSS Styling
        ↓
JavaScript Logic
        ↓
Standalone Component
        ↓
Future CMS Integration
```

---

# Completed Tasks

## 1. HTML Structure

A complete HTML structure was created for the News section.

Structure:

```text
Latest News
        ↓
Section Header
        ↓
Carousel
        ↓
News Cards
        ↓
Navigation Controls
```

The component was built independently from the server-side architecture.

---

## 2. CSS Development

A dedicated stylesheet was created:

```text
content-carousel.css
```

The stylesheet defines:

- section layout;
- responsive container;
- news cards;
- images;
- typography;
- navigation arrows;
- pagination dots;
- responsive behaviour.

Overall hierarchy:

```text
Section
        ↓
Container
        ↓
Track
        ↓
Cards
        ↓
Navigation
```

---

## 3. JavaScript Implementation

A separate JavaScript module was developed:

```text
content-carousel.js
```

Implemented features:

- previous/next navigation;
- arrow controls;
- pagination indicators;
- active slide calculation;
- responsive carousel movement.

General workflow:

```text
Click
        ↓
JavaScript
        ↓
Transform Update
        ↓
Carousel Movement
```

---

## 4. Standalone Testing

The component was tested locally.

Confirmed:

- HTML renders correctly;
- CSS loads properly;
- JavaScript executes successfully;
- no server is required.

Architecture:

```text
HTML
    +
CSS
    +
JavaScript
        ↓
Standalone Component
```

---

## 5. Project Structure Verification

The homepage file was inspected:

```text
index.html
```

Verified resources:

```text
header.css
hero.css
studios.css
content-carousel.css
content-carousel.js
```

Each module operates independently.

---

## 6. Section Spacing Analysis

The vertical spacing between homepage sections was investigated.

It was confirmed that the spacing is produced by the internal padding of neighbouring sections.

Structure:

```text
Hero
        ↓
.studios
padding-top
padding-bottom
        ↓
.content-carousel-section
padding-top
padding-bottom
```

---

## 7. Studios Section Optimization

The following stylesheet was analysed:

```text
studios.css
```

Original values:

```css
.studios {
    padding: 85px 20px 90px;
}

.studios-header {
    margin-bottom: 110px;
}
```

The layout was optimized.

Updated value:

```text
margin-bottom

110 px
        ↓
60 px
```

The distance between the section title and the cards became visually balanced.

---

## 8. Spacing Between Sections

The gap between sections was found to consist of two values:

```text
.studios
padding-bottom

+

.content-carousel-section
padding-top
```

The lower padding of the Studios section was reduced:

```text
90 px
        ↓
40 px
```

This significantly improved the visual continuity of the homepage.

---

## 9. Final Verification

The following items were verified:

- HTML structure;
- CSS integration;
- JavaScript integration;
- responsive layout;
- carousel navigation;
- spacing between homepage sections.

No layout or functional issues were detected.

---

# Final Component Architecture

```text
index.html
        ↓
content-carousel.css
        ↓
content-carousel.js
        ↓
News Cards
        ↓
Navigation
        ↓
Responsive Carousel
```

---

# Key Technical Results

### The component is fully standalone

The component does not require:

- PHP;
- MySQL;
- AJAX;
- CMS.

---

### Responsibilities are separated

```text
HTML
        ↓
Structure

CSS
        ↓
Presentation

JavaScript
        ↓
Interaction
```

---

### Ready for CMS Integration

The visual component is already prepared to receive dynamic content from the existing CMS without changing its layout or styles.

Future architecture:

```text
MySQL
        ↓
PHP
        ↓
JSON
        ↓
JavaScript
        ↓
News Cards
```

---

# Technologies Studied

- HTML5
- CSS3
- Flexbox
- JavaScript (ES6)
- DOM
- Responsive Design
- CSS Grid
- Carousel UI
- Chrome DevTools
- GitHub Markdown

---

# Development Tools

- Visual Studio Code
- Google Chrome
- Chrome DevTools
- ChatGPT

---

# Main Achievement

A fully functional standalone **Latest News** component was successfully developed.

The following objectives were achieved:

- correct visual rendering;
- fully operational carousel;
- modular project structure;
- independence from the existing CMS;
- readiness for future backend integration.

---

# Practical Value

This is the first complete UI component of the future website.

The completed module makes it possible to:

- replace homepage sections step by step;
- test new components locally;
- integrate them gradually into the existing CMS;
- significantly reduce modernization risks.

---

# Next Steps

1. Prepare a JSON data structure for news items.
2. Connect the component to the existing CMS.
3. Automate news loading.
4. Replace placeholder content with real publications.
5. Begin PHP/MySQL integration.

---

# Conclusion

Day 6 completed the development of the standalone **Latest News** user interface.

```text
HTML
        ↓
CSS
        ↓
JavaScript
        ↓
Standalone Component
        ↓
Ready for CMS Integration
```

The component now works entirely without a server or database, follows the planned architecture of the new website, and is ready for the next development stage — connecting dynamic content from the existing CMS.

**Status:** Completed
