# Medware Solutions Ltd — Website

Static marketing site for Medware Solutions Ltd, a healthcare infrastructure development, biomedical engineering and healthcare ICT company based in Nairobi, Kenya.

Live at **https://www.medwaresol.com**. Plain HTML, CSS and JavaScript with no build step. The only server-side code is `mailer.php`, which sends the contact form.

## Folder structure

```
.
├── index.html                    Homepage: hero slider, services summary, partner marquee, about
├── services.html                 Service catalogue (#infrastructure, #biomedical, #ict)
├── products.html                 Product overview → the two product line pages
├── healthcare-ict.html           Healthcare ICT product line
├── medical-gas-systems.html      Medical Gas Systems product line
├── <product>.html                Product detail pages: visocall-ip-nurse-call, fire-alarm-panels,
│                                 building-management-systems, queue-management-kiosks, medware-cmms,
│                                 medical-gas-pipeline, oxygen-generating-plants, vacuum-medical-air,
│                                 pneumatic-tube-systems
├── projects.html                 Completed projects by discipline (#infrastructure, #biomedical, #ict)
├── contact.html                  Contact page; its form posts to mailer.php
├── mailer.php                    Sends the contact form by email, then redirects back to contact.html
├── blogs.html, blogs-2…4.html    Blog listing (6 articles per page, newest first)
├── <article>.html                Blog articles, one file each (e.g. medical-vacuum-air-plants.html)
├── 404.html                      "Page not found" page (uses root-relative /paths)
│
├── assets/
│   ├── css/motion.css            Shared animations: hero entrance, scroll reveals, card hovers, menus
│   ├── js/motion.js              Mobile menu, scroll reveals, clickable cards, section sub-nav
│   └── images/
│       ├── brand/                Medware logo, homepage hero photo, share image, app icons
│       ├── services/             Photos for each service on services.html / homepage
│       ├── products/             Product line photos (nurse call, medical gas)
│       ├── projects/<project>/   Project gallery photos, e.g. projects/tenwek/tenwek-1.webp
│       ├── logos/                Partner and client logos (homepage marquee)
│       └── visocall/             Visocall device photos + the video thumbnail
│
├── favicon.ico                   Browser tab icon (must stay in the root)
├── robots.txt                    Allows all crawlers, points to the sitemap
├── sitemap.xml                   List of pages for search engines
├── .htaccess                     Apache: custom 404 page, old extensionless URLs, blocks .log files
├── .gitattributes                Line-ending rules (text vs binary files)
└── .gitignore                    OS/editor files kept out of git
```

Page URLs live in the root on purpose: moving or renaming a page breaks existing links and search rankings.

**Links use the file names.** Pages link to each other as `href="services.html"`, so the site works on any web server, including VS Code Live Server. Extensionless URLs such as `/services` still work on the live Apache host through `.htaccess`, but don't write new links that way: they fail everywhere else with "Cannot GET /services".

**Blog.** The listing (`blogs.html`, then `blogs-2.html` … `blogs-4.html`) shows every article, newest first, 6 per page. Each article must have its own body text: 15 pages that shared one generic body under different titles were removed in October 2026. A few topics still have two articles (nurse call, medical gas copper pipes, biomedical engineering in Kenya); give each a clearly different angle or merge them.

## How the pages are built

- Each page is a self-contained HTML file with its CSS inline in a `<style>` block. The brand colours are CSS custom properties in `:root` (`--blue`, `--navy`, `--sky`, `--grey`, …), and the fonts are Montserrat and Inter from Google Fonts.
- The header, footer and design tokens are **repeated in every page**. A change to the nav, footer or colours has to be made in every HTML file, `404.html` included.
- **Navigation:** Home, then Products / Services / Projects, each with a hover dropdown to its sub-pages or section anchors. Then Partners, Blog, About Us, Contact and a "Request a consultation" button. At 760px wide and below, the dropdowns become an indented list.
- **Contact form:** `contact.html` posts to `mailer.php`, which emails the enquiry to `ict@medwaresol.com` and redirects back with `?status=success` or `?status=error`. It needs a host with PHP and working outgoing mail. If sending fails, the visitor sees an error; nothing is stored on the server.
- **Visocall video:** the page shows a thumbnail (`images/visocall/video-poster.webp`), and the YouTube player only loads when the visitor clicks play.

## Search and sharing

Every page's `<head>` has, after the description:

- `<link rel="canonical">`: the page's own full URL (e.g. `https://www.medwaresol.com/services.html`; the homepage is `https://www.medwaresol.com/`)
- Open Graph and Twitter tags: title, description and `brand/og-image.jpg` (1200×630), for link previews on WhatsApp, LinkedIn, Facebook and X
- favicon and app icons, and `theme-color`

`index.html` also has a `LocalBusiness` JSON-LD block with the company name, address, phone numbers, email, map coordinates and service area. **Update it if any contact details change**; they also appear in the visible contact section.

## Common tasks

### Adding or replacing an image

1. **Resize before adding.** Photos straight from a phone are 3–5 MB, which is more than the whole rest of the site put together. Aim for:
   - photos: about **1200–1600 px** on the long side
   - logos: about **130 px** tall
2. **Save as WebP** at quality about 80 (e.g. with [Squoosh](https://squoosh.app)). Most images end up at 20–150 KB.
3. **Put it in the right folder**, named in lowercase-with-hyphens after what it shows (e.g. `services/oxygen-plant.webp`, `projects/tenwek/tenwek-5.webp`).
4. **Write the `<img>` tag** with `alt` text, the image's real `width` and `height`, and `loading="lazy"` unless it's at the top of the page:

   ```html
   <img src="assets/images/services/oxygen-plant.webp" alt="On-site oxygen generating plant"
        width="1200" height="801" loading="lazy">
   ```

   The width and height stop the page jumping while images load. CSS still controls the displayed size.

### Adding a page

1. Copy the closest existing page and change the `<title>`, meta description and content.
2. In the `<head>`, update the canonical URL, `og:title`, `og:description` and `og:url` **to the new page's own values**. A copied page keeps the original's tags, and a canonical pointing at another page tells Google not to index this one.
3. Add the page to the nav in **every** page's header if it belongs there.
4. Add a `<url>` entry to `sitemap.xml`, using the same URL as the canonical.
5. For a blog article, add its card at the top of the grid in `blogs.html`. Each listing page holds 6 cards, so move the last card of each page to the top of the next, and add a new `blogs-N.html` (plus its link in every page's pagination) when the last page is full.

## Deployment

Upload the whole folder to an **Apache host with PHP** (cPanel hosting, for example). There's nothing to build.

- **Why Apache:** `.htaccess` provides the custom 404 page and keeps old extensionless URLs working, and `mailer.php` needs PHP with outgoing mail. The pages themselves work on any host.
- **Site at the domain root:** `.htaccess` and `404.html` use paths from the root (`/404.html`, `/assets/...`). In a local sub-folder such as `localhost/projects/website/` the pages work, but a missing URL shows Apache's default error page.
- **Local preview:** VS Code Live Server (or any static server) is enough for the pages. Two things need Apache with PHP, e.g. XAMPP: the contact form, and the custom 404 page. On XAMPP the form reports an error unless SMTP is configured; that's expected.
- **After deploying:** check the link previews with LinkedIn's [Post Inspector](https://www.linkedin.com/post-inspector/) or Facebook's [Sharing Debugger](https://developers.facebook.com/tools/debug/), and submit `sitemap.xml` in Google Search Console.
