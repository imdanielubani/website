# AL.GLOBAL OIL SH.A — Corporate Website

Corporate website for **AL.GLOBAL OIL SH.A**, an Albanian petroleum and hydrocarbons company established in Tirana in 2016.

Built with **Laravel 12**, **Blade**, **Tailwind CSS 4**, **Vite**, **Alpine.js** and **GSAP**. The site runs without a database: page content lives in Blade templates and configuration files, news articles in a version-controlled content file, and form submissions are emailed to the company and written to a log.

> The site is configured **not to be indexed by search engines** (see [Search engine visibility](#search-engine-visibility)).

---

## Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Environment variables](#environment-variables)
- [Development](#development)
- [Testing](#testing)
- [Deployment](#deployment)
- [Project structure](#project-structure)
- [Editing content](#editing-content)
- [Replacing images](#replacing-images)
- [Forms](#forms)
- [Motion and accessibility](#motion-and-accessibility)
- [Security](#security)
- [Search engine visibility](#search-engine-visibility)

---

## Requirements

- PHP 8.2+ with the standard Laravel extensions (`mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `fileinfo`)
- Composer 2
- Node.js 20+ and npm

No database server is required.

## Installation

```bash
git clone https://github.com/imdanielubani/website.git
cd website

composer install
npm install

cp .env.example .env
php artisan key:generate

npm run build
php artisan serve
```

Open http://127.0.0.1:8000.

On XAMPP/Apache, point the virtual host's document root at the `public/` directory.

## Environment variables

| Variable | Purpose |
| --- | --- |
| `APP_NAME` | Site name, used in emails. Default `"AL.GLOBAL OIL SH.A"`. |
| `APP_ENV` / `APP_DEBUG` | Use `production` and `false` on the live server. |
| `APP_URL` | Full public URL, e.g. `https://www.example.al`. Used for canonical and Open Graph URLs. |
| `SESSION_DRIVER`, `CACHE_STORE` | `file` (no database needed). |
| `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_SCHEME` | Outgoing mail for form notifications. With `MAIL_MAILER=log`, emails are written to `storage/logs/laravel.log`. |
| `MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME` | Sender of form notification emails. |
| `INQUIRY_RECIPIENT` | Inbox that receives contact and business inquiries. Default `info@alglobaloilsha.com`. |
| `COMPANY_EMAIL` | Public email shown on the site, in structured data and on the letterhead. Default `info@alglobaloilsha.com`. |
| `SITE_NOINDEX` | `true` (default) keeps search engines out. |

Never commit `.env`; it contains secrets.

## Development

```bash
npm run dev          # Vite dev server with hot reload
php artisan serve    # Laravel on http://127.0.0.1:8000
```

## Testing

```bash
php artisan test
```

Feature tests cover every page (status, SEO metadata, single `<h1>`), noindex headers, the custom 404 page, image library integrity, news publishing rules, and validation, delivery, honeypot and rate limiting of both forms.

## Deployment

```bash
composer install --no-dev --optimize-autoloader
npm ci && npm run build

php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Checklist:

1. Set `APP_ENV=production`, `APP_DEBUG=false` and the correct `APP_URL`.
2. Configure SMTP (or another mail transport) and `INQUIRY_RECIPIENT`, then submit a test inquiry.
3. Make `storage/` and `bootstrap/cache/` writable by the web server.
4. Serve over HTTPS and point the document root to `public/`.
5. Built assets in `public/build` are fingerprinted, so they can be cached long-term by the web server or CDN.

After changing `.env` or configuration on a server using `config:cache`, run `php artisan config:cache` again.

## Project structure

```
app/
  Content/            NewsArticle value object and NewsRepository
  Http/Controllers/   Home, Page, News, Contact and Inquiry controllers
  Http/Middleware/    NoIndex (X-Robots-Tag header)
  Http/Requests/      Form validation for contact and business inquiries
  Mail/               InquiryReceived notification
  Support/            InquiryDispatcher (log + email delivery)
config/
  company.php         Company facts, addresses, phones, licences
  images.php          Image library (keys, files, sizes, alt text)
  navigation.php      Header, mega menu, mobile menu and footer links
  site.php            Noindex switch and inquiry recipient
resources/
  content/news.php    News articles
  css/app.css         Design tokens and component styles
  js/                 Alpine components, GSAP animations, page transitions, icons
  views/
    components/       Layout, header, footer, cookie consent, buttons, sections, forms
    pages/            One template per page (including news/ and legal/)
    errors/           404, 419, 429 and 500 pages
    emails/           Inquiry notification email
public/images/
  brand/              Logo files
  photos/             Optimised WebP photography
routes/web.php        Named routes
tests/Feature/        Feature tests
```

## Editing content

- **Company details** (address, phones, NUIS, licences, email): `config/company.php`. Changes appear site-wide: header, footer, contact page, structured data.
- **Navigation**: `config/navigation.php`.
- **Page copy**: the matching template in `resources/views/pages/`.
- **Design tokens** (colours, fonts, type scale): the `@theme` block at the top of `resources/css/app.css`.

### News articles

Articles are stored in `resources/content/news.php`. Each entry supports:

`title`, `slug`, `excerpt`, `content` (Markdown), `featured_image` (an image key), `category`, `author`, `published_at`, `is_published`, `seo_title`, `seo_description`, `is_sample`.

- An article is visible only when `is_published` is `true` and `published_at` is in the past, so drafts and scheduled posts can be stored safely.
- Categories are created automatically from the `category` field and get their own URL (`/news/category/{slug}`).
- The included articles are **sample content**, flagged with `is_sample => true`, which displays a notice on the site. Replace them with real company news before launch.

`App\Content\NewsRepository` is the only class that reads this file, so it can be replaced with a CMS or database source later without changing controllers or views.

### Placeholders

Content awaiting confirmation is wrapped in the `<x-confirm>` component, which renders a discreet dashed "to be confirmed" label. Search the templates for `x-confirm` to find every placeholder.

## Replacing images

All photographs are registered in `config/images.php`:

```php
'refinery-river' => ['file' => 'refinery-river', 'w' => 2000, 'h' => 1335, 'alt' => '...'],
```

Each key maps to two files in `public/images/photos/`:

- `{file}-lg.webp`, around 1920–2000 px wide
- `{file}-sm.webp`, 960 px wide

To replace a photo, export both sizes as WebP with the same file names, update `w`/`h` to the large image's dimensions, and update the `alt` text. Templates reference images by key through the `<x-img key="..." />` component, which handles `srcset`, lazy loading and dimensions to prevent layout shift.

Current photography is stock imagery used under the Unsplash License and should ideally be replaced with the company's own photographs of its people and locations.

An A4 letterhead is in the same folder as a 300 dpi image (`letterhead-a4.png`) and as an editable Word document (`letterhead-a4.docx`) with the branding in the header and footer and a letter template in the body. Logo files are in `public/images/brand/`: SVG (`logo-on-light.svg`, `logo-on-dark.svg`, `logo-mark.svg`) and high-resolution PNG (`logo-on-light.png` and `logo-on-dark.png` with transparent backgrounds, `logo-on-light-background.png`, `logo-on-dark-background.png`, and 1024px `logo-mark.png` / `logo-mark-accent.png`). The favicon is `public/favicon.svg`. The header and footer logo is the Blade component `resources/views/components/logo.blade.php`.

## Forms

| Form | URL | Fields |
| --- | --- | --- |
| Contact | `/contact` | Full name, company, email, phone, country, inquiry type (general, customer, supplier, careers, media), message |
| Supplier / Business inquiry | `/business-inquiry` | Company, contact person, email, phone, country, inquiry type, product requirements, estimated quantity, message |

Every submission is:

1. Validated server-side (`app/Http/Requests`), with CSRF protection, a consent checkbox and a hidden honeypot field.
2. Rate limited to 3 per minute and 15 per hour per IP address.
3. Written to `storage/logs/inquiries-YYYY-MM-DD.log` (kept 90 days) as a backup record.
4. Emailed to `INQUIRY_RECIPIENT` with the reply-to address set to the sender.

Inquiry types can be preselected by URL, e.g. `/contact?type=careers` or `/business-inquiry?type=supply`.

## Motion and accessibility

Animations are declared with data attributes in templates and implemented in `resources/js/animations.js` using GSAP and ScrollTrigger:

| Attribute | Effect |
| --- | --- |
| `data-hero` | Hero image settles, heading lines rise, supporting items fade in |
| `data-split` | Heading revealed line by line |
| `data-reveal` | Fade and rise (`up`, `fade` or `clip` for image mask reveals) |
| `data-stagger` | Children revealed in sequence |
| `data-parallax="10"` | Subtle image parallax |
| `data-marquee` | Scroll-linked horizontal text band |
| `data-count` | Count-up for verified figures only |

- All motion is disabled when the visitor prefers reduced motion.
- Content is fully visible in the HTML; hidden start states are applied only by JavaScript.
- There is no scroll-jacking. Page transitions only intercept plain left-clicks on internal links, and browser history works normally.
- The site includes skip-to-content, visible focus states, a keyboard-accessible mega menu, a focus-trapped mobile menu, labelled form fields with linked error messages, and alt text for every image.

## Security

The site is hardened against common web attacks. Every protection is covered by the test suite (`tests/Feature/SecurityTest.php`, `FormsTest.php`).

| Threat | Protection |
| --- | --- |
| Exposure of private files (`.env`, logs, `.git`, sessions) | The web server document root must be `public/`. As a safety net, the root `.htaccess` denies everything outside `public/`, and `public/.htaccess` blocks hidden files, backups, logs and directory listings. |
| Cross-site scripting (XSS) | All output escaped by Blade; Markdown rendered with raw HTML stripped and unsafe links disabled; strict Content Security Policy with a per-request nonce (`app/Http/Middleware/SecurityHeaders.php`). |
| Clickjacking | `X-Frame-Options: DENY` and `frame-ancestors 'none'`. |
| Cross-site request forgery | Laravel CSRF tokens on every form. |
| Form spam and bots | Server-side validation, hidden honeypot field, encrypted time trap (`app/Rules/HumanSubmissionTime.php`) that rejects instant or replayed submissions, consent checkbox. |
| Brute force and flooding | Forms limited to 3 per minute and 15 per hour per IP; all pages limited to 120 requests per minute per IP. |
| Host header poisoning | Only the host in `APP_URL` is accepted outside local development. |
| Information leakage | Debug mode is forced off in production; `X-Powered-By` removed; custom error pages. |
| Session theft | HttpOnly, SameSite cookies; encrypted session data; secure-only cookies and HSTS over HTTPS. |
| MIME sniffing, referrer leaks, browser features | `X-Content-Type-Options`, `Referrer-Policy`, `Permissions-Policy`, `Cross-Origin-Opener-Policy` and `Cross-Origin-Resource-Policy`. |
| Vulnerable dependencies | Check regularly with `composer audit` and `npm audit`. |

A security contact is published at `/.well-known/security.txt` (renew its `Expires` date yearly).

### Production security checklist

1. Point the document root at `public/`, never the project folder.
2. `APP_ENV=production`, `APP_DEBUG=false`, correct `APP_URL` (used for trusted hosts).
3. Serve only over HTTPS and set `SESSION_SECURE_COOKIE=true`.
4. Generate a fresh `APP_KEY` on the server (`php artisan key:generate`) and never reuse the development key.
5. Hide server versions in the Apache configuration: `ServerTokens Prod` and `ServerSignature Off` (in PHP: `expose_php = Off`).
6. Make only `storage/` and `bootstrap/cache/` writable by the web server.
7. Keep PHP, Composer and npm dependencies updated; run `composer audit` and `npm audit` before each deployment.
8. If the site runs behind a proxy or CDN (e.g. Cloudflare), configure trusted proxies so rate limits see real visitor IPs.

## Search engine visibility

The site is intentionally hidden from search engines. Every page, error page, image, document and asset carries a noindex instruction:

- **HTTP header** `X-Robots-Tag: noindex, nofollow, noarchive, nosnippet, noimageindex`
  - on every Laravel response, including 404 and other error pages (`app/Http/Middleware/NoIndex.php`, registered globally in `bootstrap/app.php`);
  - on every file Apache serves directly from `public/`, such as photos, logos, the letterheads and built assets (`public/.htaccess`, requires `mod_headers`).
- **Meta tag** `<meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noimageindex">` on every page, including the self-contained 500 page.
- **`public/robots.txt`** allows Googlebot, Googlebot-Image and Bingbot to fetch pages so they can read the noindex instruction, and blocks all other crawlers. (Blocking Google in robots.txt would hide the noindex rule, and blocked URLs can still appear in results as bare links.)
- **No XML sitemap** is published.

On **Nginx**, `.htaccess` is ignored. Add this to the server block instead:

```nginx
add_header X-Robots-Tag "noindex, nofollow, noarchive, nosnippet, noimageindex" always;
```

After deployment, check a page and an image with `curl -I https://your-domain/` and `curl -I https://your-domain/favicon.svg`; both should show the `X-Robots-Tag` header. If any URL was indexed before these rules were live, request removal in Google Search Console (Removals).

To make the site public later: set `SITE_NOINDEX=false`, remove the header block from `public/.htaccess`, allow all crawlers in `public/robots.txt`, and add a sitemap.

SEO foundations are already in place for that moment: unique titles and descriptions, canonical URLs, Open Graph and Twitter cards, Organization, BreadcrumbList and Article structured data, semantic headings and descriptive URLs.
