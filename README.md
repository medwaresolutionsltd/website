# Medware Solutions Ltd — Website

Static marketing site for Medware Solutions Ltd, a healthcare infrastructure development, biomedical engineering and healthcare ICT company based in Nairobi, Kenya.

Live at **https://www.medwaresolutions.com**, the site's only domain: every canonical, share tag and the sitemap use it. Email stays on @medwaresol.com. Plain HTML, CSS and JavaScript with no build step and no server-side code, hosted as a **Render static site** (see Deployment). The contact form is sent by [Web3Forms](https://web3forms.com).

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
├── contact.html                  Contact page; its form is sent by Web3Forms
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
├── .htaccess                     Apache only (Render ignores it): same redirects, for a move to Apache hosting
├── .gitattributes                Line-ending rules (text vs binary files)
└── .gitignore                    OS/editor files kept out of git
```

Page URLs live in the root on purpose: moving or renaming a page breaks existing links and search rankings.

**Links use the file names.** Pages link to each other as `href="services.html"`, so the site works on any web server, including VS Code Live Server. The `.html` address is each page's one official URL and its canonical. Render also serves `/services` and `/index.html` (it can't redirect a path where a file exists); the canonical tags tell search engines which URL to index. Link to the homepage as `href="./"` (or `./#about`), and to the contact form as `contact.html`; the homepage has no `#contact` section.

**Blog.** The listing (`blogs.html`, then `blogs-2.html` … `blogs-4.html`) shows every article, newest first, 6 per page. Each article must have its own body text: 15 pages that shared one generic body under different titles were removed in October 2026. A few topics still have two articles (nurse call, medical gas copper pipes, biomedical engineering in Kenya); give each a clearly different angle or merge them.

## How the pages are built

- Each page is a self-contained HTML file with its CSS inline in a `<style>` block. The brand colours are CSS custom properties in `:root` (`--blue`, `--navy`, `--sky`, `--grey`, …), and the fonts are Montserrat and Inter from Google Fonts.
- The header, footer and design tokens are **repeated in every page**. A change to the nav, footer or colours has to be made in every HTML file, `404.html` included.
- **Navigation:** Home, then Products / Services / Projects, each with a hover dropdown to its sub-pages or section anchors. Then Partners, Blog, About Us, Contact and a "Request a consultation" button. At 760px wide and below, the dropdowns become an indented list.
- **Contact form:** `contact.html` sends the form to Web3Forms (`https://api.web3forms.com/submit`), which emails it to the inbox registered on the Web3Forms account; change the recipient in the Web3Forms dashboard, not in the code. The `access_key` in the form is public by design. A script sends it in the background and shows the result above the form; without JavaScript, Web3Forms shows its own confirmation page. A hidden `botcheck` box catches spam bots. Subjects arrive as "Website Contact: …" and the visitor's email (if given) is the reply-to address.
- **Visocall video:** the page shows a thumbnail (`images/visocall/video-poster.webp`), and the YouTube player only loads when the visitor clicks play.

## Search and sharing

Every page's `<head>` has, after the description:

- `<link rel="canonical">`: the page's own full URL (e.g. `https://www.medwaresolutions.com/services.html`; the homepage is `https://www.medwaresolutions.com/`)
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

Hosted on **Render as a static site**, deployed automatically from `main`. There's nothing to build: the publish directory is the repository root.

Render settings that live in the dashboard, not in this repo:

- **Redirects/Rewrites:** `/contact-us` → `/contact.html`, action **Redirect** (an old URL from the previous site). Add a rule here for any other old URL that Search Console reports as 404. Rules can't redirect the domain root or a path where a file exists.
- **Custom domains:** `www.medwaresolutions.com` plus the root `medwaresolutions.com`, which Render redirects to www. Turn off the `onrender.com` subdomain so the site has one address.
- **medwaresol.com** is not on Render. Its registrar forwards it with a **permanent (301) redirect without masking** to `https://www.medwaresolutions.com`. A "masked" or "framed" forward hides the site in an iframe and must not be used. The domain's MX (email) records stay as they are.
- **Custom 404:** Render serves `404.html` for missing pages.

**Local preview:** VS Code Live Server or any static server. The contact form works locally too, as it posts to Web3Forms.

**After deploying:** check the link previews with LinkedIn's [Post Inspector](https://www.linkedin.com/post-inspector/) or Facebook's [Sharing Debugger](https://developers.facebook.com/tools/debug/), and submit `sitemap.xml` in Google Search Console.
