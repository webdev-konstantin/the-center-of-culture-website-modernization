# Day 28 — Complete Emergency Backup and Safe Website Redirect

**Date:** 2026-08-31  
**Status:** completed  
**Day score:** 5/5

---

# What was done — in simple terms

The goal of Day 28 was to prepare the project for a situation in which access to the current hosting environment might become unavailable: preserve everything required to restore the project and, only after verifying the backups, safely redirect visitors to the current official resource.

If this goal had been defined from the beginning, the ideal sequence would have been:

```text
complete file backup
        ↓
test extraction of the archive
        ↓
complete MySQL export
        ↓
verify SQL structure and data
        ↓
preserve hosting and SSL information
        ↓
preserve relevant service documentation
        ↓
test HTTP 302 redirect
        ↓
verify destination
        ↓
permanent HTTP 301 redirect
```

The key result: the project was not merely copied into an archive. A verified recovery set was created — website files, database and technical information — while the old public address now correctly sends visitors to the current official resource.

---

# Main task of the day

Two different problems had to be solved in the correct order:

- preserve the developed website and its data;
- prevent visitors from remaining on a potentially unavailable legacy resource.

Backup and verification therefore came before any change to public website behavior.

---

# 1. Complete website files were preserved

Instead of copying only the newly developed section, the complete public web root was archived.

This preserves the new version, existing public files, PHP components, CSS, JavaScript, images, uploads, service files, `.htaccess` rules and related dependencies in one recovery package.

The backup uses `tar.gz`:

```text
website root
    ↓
TAR container
    ↓
GZIP compression
    ↓
backup .tar.gz
```

---

# 2. The archive was verified by extraction

A large archive file alone does not prove that restoration will work.

The downloaded backup was therefore extracted locally:

```text
.tar.gz
   ↓
.tar
   ↓
normal website directory
```

The extracted project tree was inspected and confirmed to contain the current website version, administration area, API, styles, images, shared PHP components, JavaScript, uploads and language-specific sections.

This confirmed that the backup is a real project archive rather than an empty or unusable container.

---

# 3. Database was backed up separately

A file backup is not enough for a dynamic website, so the complete MySQL database was exported through phpMyAdmin as SQL.

The export includes table structure, table data, `AUTO_INCREMENT`, creation statements, `INSERT` data and UTF-8 content, together with additional database objects where applicable.

```text
WEBSITE FILES       DATABASE
      │                 │
   .tar.gz            .sql
      │                 │
      └────────┬────────┘
               ↓
        recovery package
```

---

# 4. SQL export was verified internally

The SQL file was not accepted merely because of its size.

Two key statement types were checked:

```sql
CREATE TABLE ...
```

and

```sql
INSERT INTO ...
```

The first confirms that database structure is present; the second confirms that actual records are present. A control table contained both field definitions and real data rows.

---

# 5. Technical hosting information was preserved

Screenshots and relevant documentation were retained for information that may be useful during a future migration or reconstruction of the old environment, including hosting parameters, SSL state and relevant service documentation.

Unrelated provider documentation was not duplicated unnecessarily.

---

# 6. DNS was left unchanged

The primary DNS configuration is managed separately from the current hosting environment.

Therefore the DNS zone and mail-related records were not modified during Day 28.

The technical distinction is important:

```text
DNS → determines where a domain resolves

Web server → handles HTTP/HTTPS requests

HTTP redirect → tells a browser to use another URL
```

The visitor-routing task required an HTTP redirect, not a DNS rewrite.

---

# 7. Existing root `.htaccess` was inspected first

Before changing redirect behavior, the current `.htaccess` was reviewed.

It contained a simple HTTP-to-HTTPS rule, so there was no need to create a second competing redirect mechanism. The existing Apache control point could be changed cleanly.

---

# 8. Temporary 302 redirect was implemented first

A permanent redirect was deliberately not enabled immediately.

The first rule used a temporary redirect:

```apache
RewriteEngine On

RewriteRule ^ https://TARGET-URL/ [R=302,L]
```

`TARGET-URL` is intentionally a placeholder; the actual destination is not recorded in this project documentation.

Using `302` first allowed the destination to be tested without prematurely establishing a permanent redirect.

---

# 9. Test redirect was verified in a browser

After saving `.htaccess`, the old public address was opened separately and the browser reached the required destination.

```text
old URL
   ↓
Apache
   ↓
.htaccess
   ↓
302
   ↓
correct destination
```

Only after this real-world verification was the redirect made permanent.

---

# 10. Permanent 301 redirect was enabled

After successful testing, only the HTTP status changed:

```text
302 → 301
```

Final logic:

```apache
RewriteEngine On

RewriteRule ^ https://TARGET-URL/ [R=301,L]
```

Requests to the legacy website now receive a permanent redirect to the current official resource. The original files and database were not deleted.

---

# 11. Why another ZIP or RAR was unnecessary

Creating another archive of exactly the same files in a different format does not significantly increase resilience.

```text
different archive format ≠ independent backup

independent storage location = additional protection
```

The better model is:

```text
extracted working copy
        +
verified original .tar.gz
        +
SQL export
        +
technical documentation
        +
copy of the package on independent storage
```

Backups containing SQL and configuration files should not be published in an open Git repository.

---

# Resulting scheme after Day 28

```text
                 LEGACY SITE
                     │
          ┌──────────┴──────────┐
          │                     │
       BACKUP                VISITOR
          │                     │
   ┌──────┴──────┐              ↓
   │             │           old URL
files           SQL              ↓
.tar.gz         .sql          .htaccess
   │             │               ↓
   └──────┬──────┘             HTTP 301
          │                      ↓
          ↓               current resource
   restoration
    capability
```

---

# What changed for the administrator

There is now a clear emergency recovery package. A future migration can follow a straightforward sequence: extract files, create a MySQL database, import SQL, configure new connection settings, set the document root, restore HTTPS, and verify routes and public pages.

The project is no longer dependent on a single live copy at one hosting location.

---

# What changed for the visitor

The visitor does not need to know anything about backups or hosting changes. Opening the legacy address automatically results in a permanent redirect to the current resource.

---

# Verified result

- complete website files archived;
- archive downloaded locally;
- `tar.gz` extracted successfully;
- extracted project tree verified;
- current website version present in the backup;
- complete MySQL database exported;
- `CREATE TABLE` confirmed in SQL;
- `INSERT INTO` confirmed in SQL;
- relevant hosting information preserved;
- SSL information preserved;
- relevant service documentation preserved;
- DNS configuration left unchanged;
- existing `.htaccess` inspected before modification;
- temporary `302` redirect implemented and tested;
- destination confirmed by an actual browser transition;
- permanent `301` enabled only after successful verification;
- original files and database were not deleted;
- backup files are not published to GitHub.

---

# Main artifacts of the day

```text
complete file backup  → .tar.gz
complete DB backup    → .sql
extracted copy        → website project tree
technical records     → hosting and SSL information
root .htaccess        → HTTP 301 redirect
```

Account identifiers, database/server identifiers, organization details and the real redirect destination are intentionally omitted.

---

# Technologies and skills practiced

- emergency web-project backup;
- TAR/GZIP;
- archive verification by extraction;
- phpMyAdmin;
- complete MySQL/SQL export;
- verification of `CREATE TABLE` and `INSERT INTO`;
- separation of file and database backups;
- Apache `.htaccess`;
- `mod_rewrite`;
- HTTP 302 Temporary Redirect;
- HTTP 301 Permanent Redirect;
- safe production-change sequencing;
- separation of DNS and HTTP responsibilities;
- migration readiness;
- independent-backup principle.

---

# Main achievement of the day

Before Day 28, the working project still depended on continued access to the current hosting environment.

After Day 28:

```text
project preserved
      +
backup verified
      +
database preserved and verified
      +
technical configuration documented
      +
visitors redirected to the current resource
```

This was not simply a file download. It was a controlled procedure for safely retiring the old public endpoint without losing the development results.

---

# Day 28 score

## 5/5

The maximum score is justified because backups were completed before public behavior was changed, both files and database were preserved and verified, unnecessary DNS/mail changes were avoided, the redirect was tested as temporary before becoming permanent, and the resulting recovery package is suitable as the basis for future restoration or migration.

**Day 28 result: 5/5 — a complete and verified emergency recovery package was created, followed by a safely tested permanent redirect of the legacy public endpoint.**
