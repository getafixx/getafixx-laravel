# getafixx.com

The tracklist homepage for getafixx, plus a webhook endpoint that the
SoundCloud-to-Instagram Zapier automation posts to.

## How it fits together

1. Zapier trigger: **SoundCloud → New Track I Like**
2. Zapier action 1: **Instagram for Business → Create Photo Post** (posts the track artwork + caption to Instagram)
3. Zapier action 2: **Webhooks by Zapier → POST** to `https://your-domain.test/webhooks/soundcloud-track`
   - Header: `X-Webhook-Secret: <same value as SOUNDCLOUD_WEBHOOK_SECRET in .env>`
   - JSON body:
     ```json
     {
       "title": "{{track_title}}",
       "artwork_url": "{{artwork_url}}",
       "track_url": "{{permalink_url}}"
     }
     ```
4. That saves a `Track` row, which shows up on `/` (the homepage) automatically — nothing to redeploy or re-run.

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate

# SQLite needs no server setup:
touch database/database.sqlite

php artisan migrate

# Optional: seed a few fake tracks so the homepage isn't empty while you work on it
php artisan db:seed

php artisan serve
```

Visit http://localhost:8000 — you should see the tracklist (seeded fake
tracks if you ran `db:seed`, otherwise the real ones once the webhook has
been called at least once).

If any config file is missing something Laravel expects, regenerate the
framework's current defaults with:

```bash
php artisan config:publish --all
```

## Brand colors

The color tokens live at the top of `resources/views/tracks/index.blade.php`
in the `:root` block — swap the hex values there for the real getafixx.com
palette whenever you have them:

```css
--ink: #12141c;
--ink-raised: #1a1d29;
--paper: #eef0f4;
--paper-dim: #8a93a6;
--amber: #e8a33d;
--rust: #c8553d;
--hairline: #2a2e3d;
```

## Deploying

Any standard Laravel host works (Forge, Vapor, a plain VPS with nginx +
PHP-FPM, etc.). Point `getafixx.com`'s DNS at wherever you deploy, set the
same `.env` values (a real `DB_CONNECTION` if you move off SQLite, and
`SOUNDCLOUD_WEBHOOK_SECRET`), run migrations, and update the Zapier webhook
URL to the live domain.

## Security note

This repo was scaffolded and pushed by Claude using a GitHub personal
access token pasted directly into a chat session. That token is now
visible in the chat transcript — **revoke or rotate it** (Settings →
Developer settings → Fine-grained tokens) once you've confirmed the push
looks good, rather than leaving it live.
