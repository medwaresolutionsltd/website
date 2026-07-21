# Medware Solutions Ltd — Website

Static marketing site for Medware Solutions Ltd, a healthcare infrastructure development, biomedical engineering and healthcare ICT company based in Nairobi, Kenya.

## Pages

- `index.html` — homepage: full-bleed photo hero, services summary, partner marquee, about, contact (map/address card plus a mailto-based message form)
- `services.html` — service catalog across three disciplines: Healthcare Infrastructure Development, Biomedical Engineering Services, Healthcare ICT
- `products.html` — product overview: two cards (Healthcare ICT, Medical Gas Systems) linking to their dedicated pages
- `healthcare-ict.html` — Healthcare ICT product line detail page, including a link through to the Visocall IP subcategory page
- `medical-gas-systems.html` — Medical Gas Systems product line detail page
- `visocall-ip-nurse-call.html` — Visocall IP nurse call devices subcategory: video overview plus a 12-item component grid (SWI9, SM-S, ST-TOUCH, KMT, PAT, ZTD-B, BT-B, SM-B, ARAT-P-IO, LM-IO, ZTB-IO, RAT-IO)
- `projects.html` — completed project case studies by discipline

## Navigation

Every page shares the same header: Home, then Products / Services / Projects each with a hover dropdown linking to their sub-pages or same-page anchor sections (`#infrastructure`, `#biomedical`, `#ict`), followed by Partners / About Us / Contact and a "Request a consultation" button. On screens ≤760px the dropdowns render as a static indented list instead of a hover flyout.

## Structure

No build step. Each page is a self-contained HTML file with inline CSS and a shared design system (CSS custom properties for brand colors, Montserrat/Inter fonts, common header/footer chrome). Images live in `assets/images/`, with Visocall component photos under `assets/images/visocall/`.

The homepage contact form has no backend — submitting it opens the visitor's email client with a pre-filled message addressed to `info@medwaresol.com`.

## Deployment

Plain static files — serve `website/` directly from any static host, no build required.
