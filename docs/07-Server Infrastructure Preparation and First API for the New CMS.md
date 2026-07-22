# Day 7 — Server Infrastructure Preparation and First API for the New CMS

**Date:** 2026-07-22  
**Status:** Completed

---

## Development Photos

> You may place 3–6 screenshots here:
>
> - website backup process;
> - MySQL database export;
> - `content` table structure;
> - creation of the `api` directory;
> - first JSON response from the server;
> - the new homepage running on the live server.
>
> Example:
>
> ```text
> /images/day07/backup.png
> /images/day07/phpmyadmin.png
> /images/day07/api-json.png
> /images/day07/new-home.png
> ```

---

# Goal of the Day

Prepare the server infrastructure required to integrate the new homepage with the existing custom CMS without interrupting the production website.

The objectives were:

- create a complete recovery point;
- analyze the existing database structure;
- prepare the server for API development;
- deploy the new homepage to a testing environment;
- verify execution of custom PHP code on the live server.

Planned architecture:

```text
New Homepage
        ↓
PHP API
        ↓
JSON
        ↓
JavaScript
        ↓
Future CMS Integration
```

---

# Completed Tasks

## 1. Full Project Backup

Complete backups were created for:

- website files;
- MySQL database;
- project structure.

A full recovery point has been successfully confirmed.

Architecture:

```text
Website Files
        +
MySQL Database
        ↓
Complete Backup
```

---

## 2. MySQL Database Export Verification

A complete database export was created using phpMyAdmin.

Verified components:

- table structure;
- table data;
- `CREATE TABLE` statements;
- `INSERT INTO` statements.

The backup is fully suitable for restoring the project.

---

## 3. CMS Structure Analysis

The following table was analyzed:

```text
content
```

The primary fields were confirmed:

- locale;
- hash;
- published;
- categ;
- important;
- starttime;
- endtime;
- header;
- subheader;
- thumbnail.

---

## 4. Content Category Research

The CMS content classification was investigated.

Confirmed categories:

```text
categ = 0
Static Pages

categ = 1
Events

categ = 2
News

categ = 3
International Projects
```

The internal structure of the CMS content model has now been fully documented.

---

## 5. Server Recovery

During development, the contents of the following directory unexpectedly disappeared:

```text
/docs/php
```

After investigation, the PHP directory was restored from the project backup archive.

All PHP files were successfully recovered.

Recovery workflow:

```text
docs.rar
        ↓
Extract Archive
        ↓
Restore PHP Directory
        ↓
Fully Operational Server
```

---

## 6. Creating the First Server API

A new directory was created:

```text
/api
```

The first API endpoint was implemented:

```text
home-feed.php
```

The server successfully returned JSON data.

Architecture:

```text
PHP
        ↓
JSON
        ↓
Browser
```

---

## 7. PHP Execution Verification

Confirmed:

- PHP execution works correctly;
- JSON headers are sent properly;
- the browser receives valid JSON;
- the API functions without errors.

The first operational API endpoint became available at:

```text
https://ruscenter.hu/api/home-feed.php
```

---

## 8. Deploying the New Homepage

A dedicated testing directory was created:

```text
new-home
```

The complete local version of the new homepage was uploaded to the server.

Verified:

- correct rendering;
- CSS loading;
- JavaScript execution;
- carousel functionality;
- responsive layout.

The production CMS remained completely unaffected.

---

## 9. Architecture Verification

The future migration strategy was successfully validated.

Current architecture:

```text
Production CMS
        ↓
Production Website

New Homepage
        ↓
new-home
        ↓
Testing Environment
        ↓
Future Production Deployment
```

---

# Current Project Architecture

```text
New Homepage
        ↓
HTML
        ↓
CSS
        ↓
JavaScript
        ↓
PHP API
        ↓
JSON
        ↓
Ready for MySQL Integration
```

---

# Key Technical Achievements

### First Server API Created

```text
PHP
        ↓
JSON
```

The project is now technically ready for dynamic server-side integration.

---

### Safe Testing Environment Established

The production CMS continues operating independently.

All development is now performed in an isolated environment.

---

### Complete Backup Strategy Implemented

A reliable recovery point has been successfully created.

---

### Live Homepage Successfully Verified

The new homepage works correctly:

- on desktop computers;
- on mobile devices;
- on the live web server.

---

# Technologies Studied

- PHP
- JSON
- MySQL
- phpMyAdmin
- REST API Fundamentals
- RU-CENTER Hosting
- ISPmanager
- Backup & Restore
- GitHub Markdown

---

# Development Tools

- RU-CENTER
- ISPmanager
- phpMyAdmin
- Visual Studio Code
- Google Chrome
- ChatGPT

---

# Main Achievement of the Day

The first server-side API for the new website has been successfully created.

Confirmed:

- PHP execution;
- JSON generation;
- successful deployment of the new homepage;
- readiness for MySQL integration.

---

# Practical Value

Today the project evolved from a purely local frontend into a real server-based web application architecture.

This enables:

- server-side development in a live testing environment;
- safe testing of new functionality;
- gradual replacement of the existing homepage;
- seamless CMS modernization without production downtime.

---

# Next Steps

1. Connect `home-feed.php` to MySQL.
2. Retrieve news records using SQL queries.
3. Generate dynamic JSON responses.
4. Connect the News Carousel to the server API.
5. Implement manual content management.
6. Apply the same architecture to Events and International Projects.

---

# Summary

Day 7 marked the transition from local frontend development to a server-based application architecture.

```text
Local Development
        ↓
Server
        ↓
PHP
        ↓
JSON
        ↓
Ready for MySQL Integration
```

Today a complete server-side foundation was established for the new homepage. The first API endpoint was implemented, the working environment was successfully restored after an unexpected PHP directory issue, full project backups were created, and the new homepage was successfully deployed and tested on the live server.

**Status:** Completed
