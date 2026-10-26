# Day 31. Bilingual Sections and Russian Language Course Pages

**Previous report:** [Day 30 — first pages and a shared design system](30-First%20Pages,%20Unified%20Header%20and%20a%20Modern%20Design%20System%20EN.md).

**Report prepared:** 26 October 2026. Day 31 is the next entry in the project journal; this report brings together the completed work documented in the project conversation after Day 30.

## Goal of this stage

By Day 30, the website had a shared header and footer, a consistent layout for information pages, and its first working sections. The next task was to use that foundation to add content and give visitors a complete journey from a homepage card to a detailed page in their chosen language.

The template was applied in sequence to the “Compatriots” section, the ART children’s creative centre, and Russian language courses. The main outcome of the final part of the work was a pair of Russian and Hungarian course pages with agreed content, illustrations, and working links from both homepages.

## Complex things in simple words

A new section has three separate parts:

| Part | What visitors see | What needs to be prepared |
|---|---|---|
| Homepage card | An image, a title, and a short description | The card markup on the homepage for the relevant language |
| Section page | Full information about the classes | A separate Russian or Hungarian PHP file |
| Image | An illustration on a card or page | An image file and the correct URL pointing to it |

Uploading a course page does not automatically change its homepage card. An image also does not determine which page should open when a visitor clicks it.

Two short attributes express this distinction in the code:

- `href` — the destination of a link;
- `src` — the location from which an image is loaded.

When both addresses match the files on the server, visitors have a clear route from the homepage to the relevant card and then to the course information.

## What was implemented

### 1. The shared template was used to develop further sections

The previously prepared “Study in Russia” and “Compatriots” pages provided the layout reference. The corporate blue title with white text, calm grey introduction, back link, information sidebar, and shared Header and Footer were retained.

For the “Compatriots” section, the supplied material about the voluntary resettlement programme, regional programmes, and information documents was organised into a readable structure. Links to materials and the official resource were presented in the content and sidebar.

For the ART centre, Russian and Hungarian descriptions of the creative activities were prepared. Photographs received descriptive filenames and captions; the replacement photograph was identified as a theatrical performance for Victory Day. The gallery design used photo switching on desktop and a sequential presentation on mobile.

These pages provided the foundation for the next section: Russian language courses received a familiar layout, with their own content structure and one large illustration instead of a gallery.

### 2. Course information was updated using the supplied poster

The original text served as a draft. Dates, timetables, fees, and contact details were checked against the attached autumn 2026 poster and carried into both language versions.

| Poster information | Information placed on the page |
|---|---|
| Teaching period | 25 September–21 December 2026 |
| Programme length | 48 teaching periods |
| Beginner groups | A0; Monday and Wednesday or Tuesday and Thursday |
| Class times | 17:00–18:30 or 18:30–20:00 |
| Standard fee | HUF 57,600 |
| Student fee | HUF 48,000 |
| Main registration period | 1–21 September 2026 |
| Registration hours during that period | Monday–Friday, 10:00–13:00 and 14:00–18:00 |
| Announced placement tests | 14 September, 15:00–18:00, or 16 September, 10:00–13:00; by prior appointment |
| Venue and registration location | The Centre’s library, 1062 Budapest, Andrássy út 120., second floor |

These details describe a particular autumn intake rather than a permanent timetable. PHP provides a date-aware notice using Budapest time: after the main registration period, visitors are asked to check availability; after the semester ends, they are directed to enquire about the next intake.

Telephone and email details became active links. A map link and access to the original poster were also included.

Conditions from the old draft that the poster did not confirm were not presented as guarantees. Questions about payment, available places, and additional conditions are directed to the course secretary.

### 3. Russian and Hungarian course pages were prepared

The section has two destinations:

| Language | Page URL |
|---|---|
| Russian | `/new-home/russian-language.php` |
| Hungarian | `/new-home/hu/russian-language.php` |

Both pages follow the same content order:

1. title and short introduction;
2. textbook illustration;
3. registration-period notice;
4. course description;
5. beginner-group timetable;
6. level placement and testing;
7. teachers and learning materials;
8. fees;
9. registration, contacts, and location.

The agreed Russian title was “В Российском культурном центре в Будапеште открыт набор на курсы русского языка”. Its Hungarian counterpart was *Megnyílt a jelentkezés a budapesti Orosz Kulturális Központ orosznyelv-tanfolyamaira*.

The pages provide a link to the other language, a return to the homepage, and navigation between content sections. The established “Share / Print version” panel was reused.

Information is divided into short sections, tables, and information blocks. Visitors can find a fee or a class time without reading one long uninterrupted text.

### 4. Two illustrations were prepared for different uses

The detailed course page and its homepage card needed different compositions.

| Image | Purpose |
|---|---|
| Landscape illustration | A large image following the introduction on the course page |
| Square collage | A compact section card on the homepage |

The supplied photograph of the Centre’s actual library provided the setting. The composition includes the Pojehali! 1.1 textbook, additional copies on the table, and students in the background.

For the square card, the interior was brought closer to the library photograph: the relative positions of the wooden cabinets, display rack, fireplace, painting, and sculpture were retained. The entire background, including both people and the interior, was then given a consistent soft blur. The textbook, stacked copies, and front of the table remained the sharp foreground.

This makes the image readable at card size: the textbook attracts attention first, while the background establishes the learning environment. The familiar interior, restrained palette, and existing page layout support the Centre’s visual identity.

The captions disclose AI-assisted image editing. Agreed author and textbook information was used in the captions; the illustrated cover does not replace a bibliographic description.

### 5. Captions, alternative descriptions, and filenames were organised

Each image received two different kinds of text:

- `alt` — a short description for assistive technology and situations where the image is unavailable;
- `figcaption` — the visible caption directly below the photograph.

The caption is centred. The Hungarian version identifies the authors and textbook and explains the image editing:

> Csernisov, Sz. – Csernisova, A.: **Pojehali! 1.1 – kezdő szintű orosz nyelvkönyv**, a tanfolyam alapvető tananyaga. A fotó szerkesztése mesterséges intelligencia segítségével történt.

The caption belongs in `<figcaption>` within the photograph block. The `Tanárok és tananyagok` section keeps its separate purpose: explaining the teachers and learning materials.

The prepared package uses descriptive image names:

- `russian-language-poekhali-library.png`;
- `russian-language-poekhali-home-card.png`;
- `russian-language-courses-budapest-autumn-2026.jpg`.

The installation work also used the name `russian-language-in-russian-culture-centre-in-budapest.png`. The practical rule is consistent: the name in `src` must match the uploaded file, including its extension. Renaming an image requires updating its address in the code.

Descriptive names make the correct image easier to find in the file manager and simplify ongoing website maintenance.

### 6. Cards on both homepages were connected

The Russian language card received a working destination in place of the under-construction page.

Each language now has its corresponding destination:

| Homepage | Card destination |
|---|---|
| Russian | `/new-home/russian-language.php` |
| Hungarian | `/new-home/hu/russian-language.php` |

The same square image can be used by both cards. Its URL begins with `/new-home/img/`, so it does not depend on whether the visitor is at the root of the new website or inside the `hu` directory.

The markup was aligned with the role of each attribute: `href` belongs to the `<a>` link, and `src` belongs to the `<img>` image. The image address is enclosed in a complete pair of quotation marks.

Example for the Hungarian card using the filename from the package:

```html
<a class="studio-card-link"
   href="/new-home/hu/russian-language.php"
   aria-label="Orosz nyelvtanulás">
    <img class="studio-card-image"
         src="/new-home/img/russian-language-poekhali-home-card.png"
         alt="Pojehali! 1.1 tankönyv – orosznyelv-tanfolyamok Budapesten">
</a>
```

This is an explanatory fragment. The full card also retains its title, description, and existing styling classes.

Updating the Hungarian homepage separately was an important step. Shared Header and Footer components are reused, but the static cards belong to the individual homepage files. Editing a Russian card therefore does not automatically update the Hungarian card.

### 7. CSS and JavaScript responsibilities were clarified

This version of the page did not require additional separate files: shared styles are loaded from the website, while page-specific rules and a small script are included in the prepared PHP files.

| Component | Responsibility |
|---|---|
| HTML within the page | Headings, paragraphs, tables, links, and images |
| PHP | Settings, shared header and footer includes, and the date-aware notice |
| `header.css`, `page-template.css`, `footer.css` | The shared appearance of the website and information pages |
| Local `<style>` block | The course timetable, fees, illustration, and other course elements |
| Local `<script>` block | Printing, copying a link, and configuring language destinations |

Page-specific CSS rules are scoped to the course page. This supports its individual content within the shared design system.

An ordinary card click is handled by an HTML link. It requires the correct `href` and an existing page at that address.

### 8. File placement on the hosting server was clarified

The package contains both pages, images, and instructions. An important distinction was recorded: it does not replace complete homepages; the cards are edited in the existing `index.php` files.

| File or group | Location |
|---|---|
| Russian `russian-language.php` | `docs/new-home/` |
| Hungarian `russian-language.php` | `docs/new-home/hu/` |
| Images | `docs/new-home/img/` |
| Russian card | Existing `docs/new-home/index.php` |
| Hungarian card | Existing `docs/new-home/hu/index.php` |

Here, `docs` is a hosting directory. Public URLs begin with `/new-home/`.

After placement, direct page URLs, images, and card navigation were checked. A browser force refresh was used to load the latest version. The user performed the hosting-side checks and confirmed completion with “Всё получилось!” (“Everything worked!”).

## How to connect another section

1. Assemble the content and identify information tied to a particular intake or period.
2. Prepare both language pages using the shared website components.
3. Create illustrations for the page and its card.
4. Add alternative descriptions and a visible caption.
5. Upload the PHP files and images to their respective directories.
6. Check that each page and image opens directly.
7. Update `href` and `src` in the cards on both homepages.
8. Check navigation and presentation on desktop and mobile.

This sequence brings content, design, and navigation together as a complete section.

## Result

- Further sections were developed using the shared template.
- Bilingual Russian language course pages were prepared with information for a specific autumn intake.
- Timetables, fees, learning materials, and registration were organised into clear blocks.
- A landscape illustration and square card image were prepared.
- Captions, alternative descriptions, and AI-editing disclosure were added.
- Page URLs and image paths were aligned.
- Russian and Hungarian cards were connected to the corresponding pages.
- A clear process was documented for updating PHP pages, images, and both homepages.

## Stage assessment

**Task-completion score: 5/5.**

The score applies to this completed stage: bilingual content was prepared, visual materials were agreed, the cards were connected to their pages, and the user confirmed that the deployed result worked.

The main outcome is a complete visitor journey: Russian language courses can be opened from the appropriate language homepage, with programme details, the timetable, fees, and registration information available in one place.
