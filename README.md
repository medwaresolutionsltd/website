# Medware Solutions Ltd — Website

Static marketing site for Medware Solutions Ltd, a healthcare infrastructure development, biomedical engineering and healthcare ICT company based in Nairobi, Kenya.

## Pages

- `index.html` — homepage: hero, services summary, partner marquee, about, contact
- `services.html` — service catalog across three disciplines: Healthcare Infrastructure Development, Biomedical Engineering Services, Healthcare ICT
- `products.html` — browsable product catalog with category filtering (Infrastructure Equipment, Medical Gas Systems, Healthcare ICT, Spares & Accessories)
- `projects.html` — completed project case studies by discipline

## Structure

No build step. Each page is a self-contained HTML file with inline CSS and a shared design system (CSS custom properties for brand colors, Montserrat/Inter fonts, common header/footer chrome). Images live in `assets/images/`.

## Deployment

Plain static files — serve `website/` directly from any static host, no build required.
