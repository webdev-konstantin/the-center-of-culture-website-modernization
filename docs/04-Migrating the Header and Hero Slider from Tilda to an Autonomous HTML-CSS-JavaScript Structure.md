# Day 4 — Migrating the Header and Hero Slider from Tilda to an Autonomous HTML/CSS/JavaScript Structure

**Date:** 2026-07-10  
**Status:** completed

## Development Process Screenshots

> It is recommended to place 3–5 screenshots illustrating the main stages of the work here.
>
> For example:
>
> - the original exported Tilda code;
> - the local Header version;
> - the project folder structure;
> - editing `index.html`, `header.css`, `hero.css`, and `hero.js`;
> - the final working page with the Hero slider.
>
> Example structure:

```text
/images/day04/tilda-export-analysis.png
/images/day04/header-local-version.png
/images/day04/project-folder-structure.png
/images/day04/hero-slider-code.png
/images/day04/header-hero-result.png
```

---

## Goal of the Day

The main goal of the fourth day was to begin the practical migration of the home page from Tilda to an independent website structure.

During the previous stage, the architecture of the existing CMS and the mechanism used to retrieve content from MySQL were examined. On Day 4, the work moved from research to the development of a new user interface.

The following tasks had to be completed:

1. define the home-page migration strategy;
2. separate the visual part of the website from Tilda;
3. migrate the Header;
4. create an autonomous Hero slider;
5. separate HTML, CSS, and JavaScript into individual files;
6. ensure that the page could run locally without a CMS or server.

The target workflow was defined as follows:

```text
Tilda export
        ↓
Analysis of HTML and resources
        ↓
Independent Header
        ↓
Independent Hero slider
        ↓
HTML + CSS + JavaScript
        ↓
Local version of the home page
        ↓
Future CMS integration
```

---

# Completed Tasks

## 1. Analysis of the Exported Home-Page Structure

The work began with an examination of the exported Tilda HTML file.

The main sections of the page were identified in the source code:

```text
Header
Hero / Slider
Studios and Courses
Our News
Our Upcoming Events
International Events
Footer
```

The following service directories were also identified:

```text
css/
js/
img/
files/
fonts/
```

It was confirmed that the export contains:

- HTML markup;
- CSS files;
- Tilda JavaScript;
- images;
- fonts;
- responsive styles;
- interactive elements.

At the same time, a decision was made not to migrate the entire Tilda code without modification. Instead, its components would gradually be replaced with independent ones.

---

## 2. Defining the Migration Strategy

Initially, two approaches were considered.

### Option 1 — Using the Exported Tilda Code

```text
Tilda HTML
+
Tilda CSS
+
Tilda JavaScript
```

Disadvantages:

- dependency on Tilda’s internal scripts;
- a large amount of service code;
- difficulty of future maintenance;
- risk of conflicts with the custom CMS;
- dependency on jQuery and `tilda-scripts` functions.

### Option 2 — Creating Autonomous Components

```text
Custom HTML
+
Custom CSS
+
Custom JavaScript
```

The second option was selected.

The appearance of the exported page is being used as a visual reference, while its internal structure is gradually being converted into independent code.

---

## 3. Defining the Order of Block Migration

The following development sequence was approved:

```text
1. Header
2. Hero slider
3. Studios and Courses
4. Content sections
5. Footer
6. Full local HTML version testing
7. CMS integration
```

This approach makes it possible to:

- migrate the website one major component at a time;
- test every block separately;
- locate errors more quickly;
- avoid mixing design tasks with server-side logic;
- preserve a working version after every stage.

---

## 4. Creating the Local Project

A separate project folder was prepared for the new version of the website.

Example structure:

```text
RusCenter_New/
│
├── index.html
├── favicon.ico
│
├── css/
│   ├── header.css
│   └── hero.css
│
├── js/
│   └── hero.js
│
├── img/
│   ├── logo
│   ├── first-slide image
│   ├── second-slide image
│   └── third-slide image
│
└── backup copies
```

The main page file is:

```text
index.html
```

The page can be opened with a standard double-click without starting a local server.

---

## 5. Creating an Autonomous Header

The Header became the first major independent component.

It includes:

- the logo;
- the main navigation menu;
- the language switcher;
- the search button;
- social media buttons;
- working links;
- a responsive structure.

The main Header logic was separated from Tilda.

Component structure:

```text
index.html
        ↓
Header HTML markup
        ↓
css/header.css
        ↓
images and links
```

The following elements were successfully restored:

- element positioning;
- menu structure;
- buttons;
- language switcher;
- links;
- social media links;
- opening external pages.

---

## 6. Verifying Image Paths

One of the main issues involved displaying the logo and background images.

It was established that the filename used in the HTML must match the actual filename in the following directory exactly:

```text
img/
```

The following elements were checked:

- file extension;
- digit sequence;
- underscore characters;
- letter case;
- relative path.

Example connection:

```html
<img src="img/file-name.png" alt="Logo">
```

An error in even a single character caused the image not to appear.

After correcting the paths, the logo and images began displaying properly in the local version.

---

## 7. Analysis of the Original Tilda Hero Block

The following Hero block was found in the exported code:

```text
t734
```

For the block to work fully, it required:

```text
jQuery
tilda-scripts
tilda-blocks-page32107432.min.js
t734_init
```

Using these files would have preserved the project’s dependency on Tilda.

For this reason, the decision was made not to restore the original `t734` mechanism, but to create a custom autonomous slider instead.

The target structure was defined as follows:

```text
Slide HTML
        ↓
hero.css
        ↓
hero.js
        ↓
Automatic slide switching
```

---

## 8. Creating the Hero HTML Markup

A Hero section was added below the Header.

General structure:

```html
<section class="hero">

    <div class="hero-slide active">
        <img src="img/slide-1.jpg" alt="">

        <div class="hero-overlay"></div>

        <div class="hero-content">
            <h1>Title</h1>
            <p>Description</p>
            <a href="#">Learn more</a>
        </div>
    </div>

</section>
```

Each slide includes:

- an image;
- an overlay;
- a title;
- a description;
- a link;
- an individual container.

Three slides were included in the final version.

---

## 9. Adding Three Slides

Images from the exported project were used in the Hero section.

The slides were:

```text
Slide 1 — “Victory Map”
Slide 2 — St. Petersburg Literary Competition
Slide 3 — Baltic Higher School
```

Each slide received:

- its own image;
- a title;
- descriptive text;
- a link;
- unified visual formatting.

This made it possible to preserve the main content of the original Hero block without using Tilda JavaScript.

---

## 10. Creating a Separate `hero.css` File

The Hero styles were moved into a separate file:

```text
css/hero.css
```

The main CSS tasks were:

- setting the Hero height;
- placing the slides on top of one another;
- hiding inactive slides;
- displaying the active slide;
- configuring smooth fading;
- scaling images;
- creating a dark overlay;
- positioning the text;
- providing responsive behaviour.

Basic logic:

```css
.hero {
    position: relative;
    height: 500px;
    overflow: hidden;
}

.hero-slide {
    position: absolute;
    width: 100%;
    height: 500px;
    opacity: 0;
    transition: opacity 1s;
}

.hero-slide.active {
    opacity: 1;
}
```

As a result, the Hero section no longer depends on Tilda CSS.

---

## 11. Creating a Separate `hero.js` File

The slider logic was moved to:

```text
js/hero.js
```

The JavaScript performs the following actions:

```text
Retrieve the list of slides
        ↓
Determine the active slide
        ↓
Remove the active class
        ↓
Move to the next slide
        ↓
Add the active class
        ↓
Repeat after the specified interval
```

Basic structure:

```javascript
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.hero-slide');
    let index = 0;

    setInterval(function () {
        slides[index].classList.remove('active');

        index++;

        if (index >= slides.length) {
            index = 0;
        }

        slides[index].classList.add('active');
    }, 6000);
});
```

The slides change automatically approximately every six seconds.

---

## 12. Separating HTML, CSS, and JavaScript

During the initial stages, styles and scripts were temporarily placed directly inside `index.html`.

After the working code was tested, it was divided into separate files:

```text
index.html
        ↓
HTML markup only

css/header.css
        ↓
Header styles

css/hero.css
        ↓
Hero styles

js/hero.js
        ↓
Slider logic
```

Connections inside `<head>`:

```html
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/hero.css">
```

JavaScript connection before `</body>`:

```html
<script src="js/hero.js"></script>
```

The embedded blocks:

```html
<style>
    ...
</style>
```

and:

```html
<script>
    ...
</script>
```

were removed from `index.html`.

---

## 13. Verifying the `index.html` Structure

The correct order of the document elements was established:

```text
<!DOCTYPE html>
<html>
<head>
    meta
    title
    CSS connections
</head>

<body>

    Header

    <main>

        Hero

    </main>

    hero.js connection

</body>
</html>
```

Correct ending of the file:

```html
<!-- end of Hero -->
</section>

</main>

<script src="js/hero.js"></script>

</body>
</html>
```

The following items were also verified:

- the presence of the opening `<main>` tag;
- the presence of the corresponding `</main>` tag;
- the absence of duplicate `</body>` tags;
- the absence of duplicate `</html>` tags;
- placement of the script before `</body>`;
- the absence of unnecessary closing tags.

---

## 14. Fixing the Error After Separating the Files

After CSS and JavaScript were moved into separate files, the page design temporarily stopped displaying correctly.

The cause was not the general HTML markup. The issue was that the new files:

```text
header.css
hero.css
hero.js
```

either did not yet contain the complete working code or were connected using incorrect paths.

A step-by-step verification was performed:

```text
Directory structure
        ↓
Filenames
        ↓
Paths in index.html
        ↓
CSS contents
        ↓
JavaScript contents
        ↓
Closing HTML tags
        ↓
Page refresh
```

After the paths were corrected, the files were populated, and the correct tag sequence was restored, the page began working again.

---

## 15. Verifying the Folder Structure

The final structure was organised as follows:

```text
website-folder/
│
├── index.html
├── favicon.ico
│
├── css/
│   ├── header.css
│   └── hero.css
│
├── js/
│   └── hero.js
│
└── img/
    ├── logo file
    ├── first-slide image
    ├── second-slide image
    └── third-slide image
```

Special attention was paid to ensuring that the following directories:

```text
css
js
img
```

were located at the same level as:

```text
index.html
```

This ensures that the relative paths work correctly:

```html
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/hero.css">
<script src="js/hero.js"></script>
<img src="img/file-name.jpg" alt="">
```

---

## 16. Testing the Local Launch

After all files had been saved, the page was force-refreshed using:

```text
Ctrl + F5
```

The following elements were tested:

- Header display;
- logo loading;
- menu links;
- language switcher;
- buttons;
- background images;
- all three slides;
- automatic slide switching;
- smooth fading;
- operation without a server;
- operation without a CMS;
- operation without Tilda libraries.

The final launch sequence is:

```text
Double-click index.html
        ↓
The browser loads the HTML
        ↓
header.css is connected
        ↓
hero.css is connected
        ↓
hero.js is connected
        ↓
Header and Hero work locally
```

---

## 17. Creating a Backup Copy

Before major changes, a working backup copy was created:

```text
index_backup_header_hero.html
```

This makes it possible to:

- return to the previous version;
- compare changes;
- preserve the working Header;
- experiment safely with new blocks;
- restore the page quickly after an error.

The backup-copy principle will also be used during the next migration stages.

---

# Current Project Architecture

At the end of Day 4, the project structure is as follows:

```text
RusCenter_New/
│
├── index.html
├── favicon.ico
├── index_backup_header_hero.html
│
├── css/
│   ├── header.css
│   └── hero.css
│
├── js/
│   └── hero.js
│
└── img/
    ├── logo.png
    ├── victory-map.jpg
    ├── literature.png
    └── baltic-higher-school.jpg
```

Separation of responsibilities:

| File | Purpose |
|---|---|
| `index.html` | page HTML structure |
| `header.css` | Header styling |
| `hero.css` | Hero-slider styling |
| `hero.js` | automatic slide-switching logic |
| `img/` | logo and images |
| `index_backup_header_hero.html` | working backup version |

---

# Main Results of the Day

The following results were achieved during Day 4.

### Header

An independent Header was created, including:

- the logo;
- the menu;
- the language switcher;
- search;
- buttons;
- social media links;
- working hyperlinks.

### Hero

An autonomous Hero slider was created:

```text
3 slides
automatic switching
smooth fading
image overlay
text and links
responsive structure
```

### Architecture

The project was divided into:

```text
HTML
CSS
JavaScript
Images
```

### Independence

The current version works:

```text
without the Tilda CMS
without Tilda JavaScript
without jQuery
without PHP
without MySQL
without a local server
```

---

# Technologies Studied

- HTML5
- CSS3
- JavaScript
- DOM
- `DOMContentLoaded`
- `querySelectorAll`
- `classList`
- `setInterval`
- CSS Transitions
- Absolute Positioning
- Responsive Web Design
- Relative File Paths
- Directory Structure
- Separation of Concerns
- Component-Based Approach
- HTML Debugging
- CSS Debugging
- JavaScript Debugging
- Tilda Export
- Reverse Engineering

---

# Tools Used

- Google Chrome
- text editor
- Windows Notepad
- Windows File Explorer
- exported Tilda project
- local HTML file
- `css`, `js`, and `img` directories
- forced refresh using `Ctrl + F5`
- file backup copies
- ChatGPT

---

# Main Result of the Day

The project moved from analysing the exported website to the practical development of an independent home-page version.

The following workflow was implemented:

```text
Exported Tilda design
        ↓
Header and Hero analysis
        ↓
Independent HTML markup
        ↓
Separate CSS files
        ↓
Custom JavaScript
        ↓
Working local page
```

By the end of the day, the foundation of the new home page had been created:

```text
Header
+
autonomous Hero slider
+
clean HTML/CSS/JS structure
```

---

# Practical Significance

The result of Day 4 forms the technical foundation of the future independent CMS.

Instead of the following structure:

```text
Tilda HTML
+
Tilda CSS
+
Tilda JavaScript
+
Tilda CMS
```

the project is moving towards:

```text
Independent HTML
+
custom CSS components
+
custom JavaScript
+
future PHP API
+
existing MySQL database
```

This will make it possible to:

- gradually eliminate the dependency on Tilda;
- preserve the appearance of the new home page;
- connect the existing CMS;
- manage content centrally;
- update slides through the database;
- maintain the project independently of the website builder.

---

# Connection to the Future CMS

At the current stage, the slide content is stored directly in the HTML.

In the future, the Hero data can be stored separately.

For example:

```text
hero.json
```

Example structure:

```json
[
  {
    "title": "Victory Map",
    "description": "A project dedicated to the 80th anniversary of Victory",
    "image": "img/victory-map.jpg",
    "url": "/projects/victory-map"
  },
  {
    "title": "St. Petersburg Literary Competition",
    "description": "An international literary project",
    "image": "img/literature.png",
    "url": "/projects/literature"
  },
  {
    "title": "Baltic Higher School",
    "description": "An educational programme",
    "image": "img/baltic-higher-school.jpg",
    "url": "/education/baltic-school"
  }
]
```

Later, instead of static JSON, the data can be returned by a PHP API:

```text
CMS
        ↓
MySQL
        ↓
PHP API
        ↓
JSON
        ↓
hero.js
        ↓
Hero slider
```

Therefore, the component created on Day 4 is already prepared for future integration.

---

# Next Steps

The following tasks are planned for the next stage:

1. create an additional backup copy of the current working version;
2. test the Header and Hero at different screen resolutions;
3. improve the mobile layout;
4. migrate the “Studios and Courses” section;
5. create a separate CSS file for the cards;
6. verify the section’s images and links;
7. continue migrating the remaining static sections;
8. connect the CMS and MySQL after the front end has been completed.

The next major component is:

```text
“Studios and Courses”
```

Proposed structure:

```text
Card HTML markup
        ↓
css/studios.css
        ↓
images
        ↓
responsive grid
        ↓
future CMS connection
```

---

# Conclusion

Day 4 became the first full day of practical development of the new home page.

The following tasks were successfully completed:

- the correct migration strategy was defined;
- direct dependency on Tilda JavaScript was abandoned;
- the Header was migrated;
- a three-slide Hero slider was created;
- HTML, CSS, and JavaScript were separated;
- path and document-structure errors were corrected;
- the correct directory structure was restored;
- a fully functioning local result was achieved.

The current architecture is:

```text
index.html
        ↓
header.css
        ↓
hero.css
        ↓
hero.js
        ↓
images
        ↓
working local page
```

The project has moved from researching the existing system to creating an independent user interface.

**Performance score:** 5/5  
**Status:** ✅ Completed
