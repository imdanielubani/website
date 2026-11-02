# Deploying to Hostbeak (cPanel)

A step-by-step checklist for publishing the AL.GLOBAL OIL SH.A website on a Hostbeak web hosting plan (cPanel). No database is required.

Throughout this guide:

- `CPANEL_USER` is your cPanel username (shown on the right of the cPanel home page).
- The project is installed in `/home/CPANEL_USER/alglobal` (outside `public_html`), so private files are never reachable from the web.
- Replace `alglobaloilsha.com` with your real domain if it differs.

---

## 1. Before you start (on your computer)

- [ ] **Confirm the plan includes SSH or Terminal.** Look for **Terminal** or **SSH Access** in cPanel, or ask Hostbeak support. Both methods below work; SSH is easier.
- [ ] **Point the domain to Hostbeak.** Set the domain's nameservers to the ones in your Hostbeak welcome email and wait until the domain opens your hosting.
- [ ] **Build the site locally.** From the project folder:

  ```powershell
  npm ci
  npm run build
  composer install --no-dev --optimize-autoloader
  ```

- [ ] **Create the upload package** (only if you will upload by File Manager instead of Git):

  ```powershell
  # Run from C:\xampp\htdocs\website. Leaves out development files and secrets.
  tar -a -c -f ..\alglobal-release.zip --exclude=node_modules --exclude=.git --exclude=.env --exclude=tests --exclude=OPEN-ITEMS.md --exclude="storage/logs/*.log" --exclude="storage/framework/sessions/*" --exclude="storage/framework/views/*.php" --exclude="database/*.sqlite" *
  ```

  The zip must contain `vendor/` and `public/build/`; they are not in Git.

- [ ] Run `composer install` (with dev packages) again afterwards if you want to keep running tests locally.

## 2. cPanel settings

- [ ] **PHP version:** open **Select PHP Version** (or **MultiPHP Manager**) and choose **PHP 8.3** (8.2 minimum) for the domain.
- [ ] **PHP extensions:** make sure these are enabled: `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `fileinfo`, `curl`, `dom`, `filter`, `session`. Enable `opcache` too, for speed.
- [ ] **SSL certificate:** open **SSL/TLS Status** and run **AutoSSL** for the domain and `www`. Then open **Domains** and turn on **Force HTTPS Redirect**.

## 3. Create the company mailbox (for the contact forms)

- [ ] **Email Accounts** → **Create** → `info@alglobaloilsha.com` with a strong password.
- [ ] **Email Deliverability** → for the domain, click **Repair** (or **Install the suggested record**) so **SPF** and **DKIM** are valid. Without them, form emails may land in spam.
- [ ] Note the SMTP details from **Email Accounts → Connect Devices**. They are normally:
  - Server: `mail.alglobaloilsha.com`
  - Port: `465` (SSL)
  - Username: `info@alglobaloilsha.com`

## 4. Upload the project

**Option A: SSH / Terminal with Git (recommended)**

- [ ] In **Terminal**:

  ```bash
  cd ~
  git clone https://github.com/imdanielubani/website.git alglobal
  ```

  If the repository is private, create a GitHub personal access token or deploy key first.

- [ ] Upload `vendor/` and `public/build/` from your computer, because they are not in Git. Either zip them and extract them into `~/alglobal` with File Manager, or install them on the server if Composer is available (`composer install --no-dev --optimize-autoloader`).

**Option B: File Manager (no SSH)**

- [ ] Open **File Manager**, go to `/home/CPANEL_USER`, create the folder `alglobal`, upload `alglobal-release.zip` into it and **Extract**.

## 5. Point the website at Laravel's `public` folder

**With Terminal (recommended):** replace `public_html` with a link to the app's public folder.

- [ ] Run:

  ```bash
  mv ~/public_html ~/public_html.old
  ln -s ~/alglobal/public ~/public_html
  ```

**Without Terminal:**

- [ ] Copy **everything inside** `alglobal/public/` (including `.htaccess`, `build/` and `images/`) into `public_html/`.
- [ ] Edit `public_html/index.php` and change the three paths, then tell Laravel where its public folder is:

  ```php
  if (file_exists($maintenance = __DIR__.'/../alglobal/storage/framework/maintenance.php')) {
      require $maintenance;
  }

  require __DIR__.'/../alglobal/vendor/autoload.php';

  $app = require_once __DIR__.'/../alglobal/bootstrap/app.php';
  $app->usePublicPath(__DIR__);

  $app->handleRequest(Request::capture());
  ```

- [ ] Remember that on every future update you must copy `public/` into `public_html/` again.

## 6. Configure the environment

- [ ] In `~/alglobal`, copy `.env.example` to `.env` and edit it with File Manager's editor:

  ```dotenv
  APP_NAME="AL.GLOBAL OIL SH.A"
  APP_ENV=production
  APP_DEBUG=false
  APP_URL=https://alglobaloilsha.com
  APP_TIMEZONE=Europe/Tirane

  MAIL_MAILER=smtp
  MAIL_SCHEME=smtps
  MAIL_HOST=mail.alglobaloilsha.com
  MAIL_PORT=465
  MAIL_USERNAME=info@alglobaloilsha.com
  MAIL_PASSWORD="your mailbox password"
  MAIL_FROM_ADDRESS="info@alglobaloilsha.com"
  MAIL_FROM_NAME="${APP_NAME}"

  INQUIRY_RECIPIENT="info@alglobaloilsha.com"
  INQUIRY_SEND_ACKNOWLEDGEMENT=true
  # Leave empty: no email address is shown on the website.
  COMPANY_EMAIL=
  SITE_NOINDEX=true
  SESSION_SECURE_COOKIE=true
  ```

- [ ] **Generate a new application key** (never reuse the one from your computer):

  ```bash
  cd ~/alglobal && php artisan key:generate --force
  ```

  Without Terminal, run `php artisan key:generate --show` on your computer and paste the result into `APP_KEY=` in the server's `.env`.

- [ ] **Permissions:** set `storage/` and `bootstrap/cache/` (and their subfolders) to `755`. If Laravel reports that it cannot write, use `775`. Never use `777`.

## 7. Optimise and test

- [ ] With Terminal, run:

  ```bash
  cd ~/alglobal
  php artisan config:cache
  php artisan view:cache
  php artisan route:cache
  php artisan inquiries:test-mail you@example.com
  ```

  Only use `route:cache` when the site is served from the domain root, as in step 5. The last command sends a test notification to `INQUIRY_RECIPIENT` and a test confirmation to the address you give. Check both inboxes, including spam.
- [ ] **Hostbeak does not run PHP 8.3 as the default `php` command?** If Artisan complains about the PHP version, run it with the full path or versioned binary Hostbeak provides (for example `/opt/cpanel/ea-php83/root/usr/bin/php artisan ...` or `ea-php83 artisan ...`). Ask support if unsure.

## 8. Check the live site

- [ ] `https://alglobaloilsha.com` and `https://alglobaloilsha.com/sq` load with images, fonts and animations.
- [ ] `http://` redirects to `https://`.
- [ ] Submit the **Contact** form and the **Business Inquiry** form. You should see the success message, the company inbox should receive the notification, and the address you entered should receive the branded confirmation.
- [ ] **Private files are blocked:** these must return 403 or 404, never a download:
  - `https://alglobaloilsha.com/.env`
  - `https://alglobaloilsha.com/storage/logs/laravel.log`
  - `https://alglobaloilsha.com/composer.json`
- [ ] **Security and noindex headers.** Run `curl -I https://alglobaloilsha.com` and `curl -I https://alglobaloilsha.com/favicon.svg`, or use https://securityheaders.com. Both should show `X-Robots-Tag: noindex…`, `Content-Security-Policy`, `Strict-Transport-Security` and `X-Frame-Options`.
- [ ] Errors show the branded error page, not a technical error page. If you see a technical error, check `APP_DEBUG=false` and `storage/logs/laravel.log`.
- [ ] On your phone, add the site to the home screen and check that the AL.GLOBAL icon appears.

## 9. Updating the site later

1. On your computer: make changes, run `npm run build` and the tests, commit and push.
2. On the server (Terminal): `cd ~/alglobal && git pull`, then upload the new `public/build/` folder (and `vendor/` if `composer.lock` changed).
3. Run `php artisan config:cache && php artisan view:cache && php artisan route:cache`.
4. Without Terminal: upload the changed files with File Manager, copy `public/` into `public_html/` again if you used that method, and delete the cached files in `bootstrap/cache/` (`config.php`, `routes-v7.php`, `services.php`, `packages.php`) so the changes take effect.

## Troubleshooting

| Symptom | Fix |
| --- | --- |
| Blank page or "500 Server Error" | Check `storage/logs/laravel.log`; usually a missing `vendor/` folder, a wrong PHP version or `storage/` not writable. |
| Page without styles | `public/build/` was not uploaded or `APP_URL` is wrong. Run `php artisan config:cache` after changing `.env`. |
| "Bad Request" or 400 on every page | `APP_URL` does not match the domain you are visiting (trusted hosts protection). Set it exactly, including `https://`, then re-cache. |
| Forms show success but no email arrives | Run `php artisan inquiries:test-mail`. Check `MAIL_*` values and that the From address is the same mailbox as `MAIL_USERNAME`. Check SPF/DKIM in Email Deliverability. Submissions are always saved in `storage/logs/inquiries-*.log`. |
| "Too many requests" during testing | The forms allow 3 submissions per minute per visitor. Wait a minute. |
| Home page shows 405 | Only happens with `route:cache` when the site runs from a subfolder. Run `php artisan route:clear`. |
