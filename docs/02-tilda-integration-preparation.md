# 02. Tilda Integration Research

**Date:** 2026-07-01

## Summary

Continued reverse engineering of the legacy website and investigation of the exported Tilda landing page to determine the optimal modernization strategy without replacing the existing custom CMS.

## Completed tasks

- Verified the custom CMS widget storage mechanism
- Confirmed that widget data is stored in the MySQL database
- Restored the "Library and Studios" section and related banners
- Investigated the structure of the exported Tilda project
- Identified the main landing page for future integration
- Designed the preliminary architecture of the modernization process
- Selected technologies and technical approaches for the project
- Defined the long-term modernization strategy

## Technical research

### Verified CMS widget mechanism

Confirmed that:

- the "Shortcut Panel" widget stores its data in MySQL;
- the administrative panel retrieves these values while generating pages;
- restoring the database records automatically restored page content.

As a result:

- the **Library and Studios** section became available;
- subsection banners were restored;
- widget content was displayed correctly.

This fully confirmed the correctness of the reverse engineering results obtained during Day 1.

### Investigated the exported Tilda project

Analyzed the exported landing page intended for integration with the existing CMS.

Studied:

- HTML files;
- CSS stylesheets;
- JavaScript files;
- images;
- service directories;
- static resources.

Identified the project's primary landing page:

`page32107432.html`

This page was selected as the main candidate to replace the existing homepage of **ruscenter.hu**.

### Designed the integration architecture

Prepared the preliminary modernization strategy.

The following decisions were made:

- preserve the existing custom CMS;
- replace only the public user interface with the exported Tilda landing page;
- continue using the existing administrative panel;
- minimize modifications to the server-side architecture;
- maintain long-term project supportability.

This established a gradual modernization approach instead of a complete CMS replacement.

### Technology assessment

Analyzed the technologies and project components involved.

Identified:

- HTML;
- CSS;
- JavaScript;
- PHP;
- SQL;
- MySQL;
- phpMyAdmin;
- website file structure;
- CMS widgets;
- content storage system;
- administrative panel;
- reverse engineering techniques;
- technical documentation.

### Defined the technical strategy

Established the main principles for future development.

Decided to:

- use the existing CMS as the project's foundation;
- perform modernization incrementally;
- integrate the exported Tilda landing page without replacing the CMS;
- document every research stage;
- ensure future maintainability of the website.

## Technologies

- HTML5
- CSS3
- JavaScript
- PHP
- SQL
- MySQL
- phpMyAdmin
- Custom CMS
- Tilda Export
- Reverse Engineering
- Legacy CMS
- UX/UI

## Tools

- ChatGPT
- Google Chrome DevTools
- phpMyAdmin
- RU-CENTER Hosting
- Hosting File Manager
- HTML analysis
- Project structure analysis
- Exported Tilda project

## Result

Successfully verified the widget storage mechanism of the legacy custom CMS, analyzed the structure of the exported Tilda project, and developed the architectural concept for gradual website modernization.

This became the next major milestone toward integrating a modern user interface while preserving the existing CMS infrastructure.
