# Day 23 — News Sharing Features and Recovery of a Production File

**Date:** 2026-08-12  
**Status:** completed  
**Final score:** **4.4 out of 5**

---

## Goal of the Day

The main goal of Day 23 was to complete the user-facing features of the public news page in the `new-home` project.

The planned tasks were to:

1. turn the “Share” area into a clean and understandable interface;
2. replace temporary text labels with local SVG icons for the configured social platforms;
3. configure correct sharing links for each publication;
4. add a convenient print version of the page;
5. verify the final appearance of the block on the public news page.

The second part of the day also required the diagnosis and resolution of a serious side incident: code from the new news template was accidentally saved into the legacy production file `/docs/news.php`.

---

# Completed Tasks

## 1. The “Share” Block Was Finalised

A dedicated social-actions block was completed on the public publication page.

Each configured platform now has its own button with a clear purpose and a correct sharing link. The current news title and page address are encoded in PHP before they are safely passed to the platform URL.

```text
Publication title + page URL
              ↓
       parameter encoding
              ↓
   selected platform share URL
              ↓
     new browser tab is opened
```

External links use `target="_blank"` together with `rel="noopener noreferrer"`.

---

## 2. Text Abbreviations Were Replaced with SVG Icons

Temporary text labels were replaced with local SVG icons for the configured social services.

The icons are stored on the project server and do not require an external library when the page is opened. This preserves the independence of the new website from third-party CDNs and provides better control over the visual design.

The following details were corrected during implementation:

- paths to the SVG files;
- button and icon dimensions;
- icon alignment inside circular controls;
- spacing between buttons;
- visual separation of primary and secondary sharing options;
- the misleading active-state appearance of the MAX button.

After these corrections, the block became compact and no longer distracts from the publication itself.

---

## 3. Link Copying Was Added

For services that do not provide a universal public web sharing endpoint, a copy-first workflow was implemented.

The user receives clear status feedback, while the current publication URL remains available for pasting into the selected application.

---

## 4. A Print Version Was Added

The publication page now includes a dedicated “Print version” button.

The print layout excludes interface elements that are not required on paper:

- navigation and interactive buttons;
- the social sharing block;
- decorative interface elements;
- auxiliary screen-only components.

The main text, title, image, and publication details remain readable in print.

---

## 5. An Accidental Overwrite of the Legacy `news.php` Was Identified

During the work, the following production file was accidentally replaced:

```text
/home/h011479956/ruscenter.hu/docs/news.php
```

It received code from the new template located at:

```text
/home/h011479956/ruscenter.hu/docs/new-home/news.php
```

The issue was isolated using three indicators:

- the exact file path shown in the hosting file manager;
- the modification time, `2026-08-12 22:04`;
- the presence of the new template’s social sharing markup inside the file.

This confirmed that the legacy production file `/docs/news.php` had been affected, rather than the intended version inside `new-home`.

---

## 6. The Production File Was Successfully Restored

The hosting recovery function was used. The restored copy was located in the account’s temporary service directory, and the correct version of `news.php` was returned to its production location.

As a result:

- the legacy website again uses its correct `news.php` file;
- the new template remains separate at `/docs/new-home/news.php`;
- the effects of the accidental overwrite have been removed;
- website operation has been confirmed.

---

# Main Results of the Day

1. The “Share” block was brought to its final compact form.
2. Local SVG icons for the configured social platforms were integrated.
3. Icon paths, sizes, and alignment were corrected.
4. The misleading highlighted appearance of the MAX button was removed.
5. Sharing URLs now receive the correctly encoded page address and title.
6. A link-copying workflow was added.
7. A print version of the publication was implemented.
8. The accidental overwrite of the legacy `/docs/news.php` was diagnosed.
9. A recovered copy was found and the working file was restored.
10. Separation between the legacy website and the `new-home` project was preserved.

---

# Technologies Used

- PHP;
- HTML5;
- CSS3;
- JavaScript;
- Clipboard API;
- SVG;
- URL encoding;
- responsive layout;
- `@media print` CSS rules;
- RU-CENTER file manager;
- hosting backup and recovery system;
- GitHub Markdown.

---

# Practical Value

The publication page now feels like a finished component of a modern website rather than a technical database output page.

The user can now:

```text
open a news item
→ read the publication
→ share its link
→ copy the address
→ print the page
```

At the same time, the `/docs/news.php` incident demonstrated the need for a stricter workflow when working with legacy and new website files.

A timestamped copy should be created before every production file replacement. After each major milestone, the complete `new-home` directory should be archived together with related files and a CMS data export.

---

# What Required Additional Attention

The day cannot receive the maximum score of 5 because a legacy production file was accidentally overwritten.

Although the issue was detected in time and fully resolved, it created a real risk for the live website and required a separate recovery procedure.

The overall result remains strong: the user-facing features were completed, the interface was improved, and the hosting recovery mechanism was successfully validated in practice.

**Honest final score: 4.4 out of 5.**

---

# Next Steps

1. Make the hashtags in the “News” carousel consistent with the “RCC Announcements” and “International Events” carousels.
2. Connect the Hungarian version of the new homepage and public publications.
3. Configure a shared template for the six main-menu sections.
4. Migrate and connect the website footer.
5. Test both the Russian and Hungarian versions on desktop and mobile devices.
6. Create timestamped backups of modified files before each subsequent stage.

---

# Conclusion

Day 23 completed the user-facing layer of the public news page: social actions, local SVG icons, link copying, and the print version now operate as one coherent system.

The incident involving the legacy `/docs/news.php` was neither hidden nor postponed. The cause was identified, a recovered version was found, and the working file was restored.

The project is ready for the next presentation-focused stage: visual alignment of the carousels, connection of the Hungarian version, creation of templates for the six menu pages, and migration of the footer. These tasks will make the move from Tilda to RU-CENTER visibly clear and convincing.

**Status:** ✅ Day 23 completed
