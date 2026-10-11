# SEO REST API – Meta Bridge

Exposes SEO meta fields to the WordPress REST API so they can be written when publishing posts through the API. Works with **Rank Math**, **Yoast SEO** and **All in One SEO** — title, description, focus keyword, canonical URL, Open Graph and Twitter fields. Ideal for headless WordPress and automation tools.

## Why this exists

WordPress does not expose SEO-plugin meta (SEO title, meta description, focus keyword, canonical URL, Open Graph, Twitter) over the REST API by default. An external app, headless front-end, or automation workflow that creates or updates a post through `/wp/v2/posts` gets those fields back empty — there is no way to set them over the API without this.

This plugin registers the relevant meta keys with `show_in_rest` enabled, so they become readable **and writable** through the standard REST endpoint. Nothing to configure — activate it and the fields are available.

## What it does, exactly

The entire plugin is one file, under 100 lines: [`seo-rest-api-meta.php`](./seo-rest-api-meta.php). It calls WordPress's own `register_post_meta()` for a fixed list of known SEO-plugin meta keys (Rank Math / Yoast / AIOSEO), each with:

- `show_in_rest => true` — makes the field visible over the REST API.
- an `auth_callback` that requires `current_user_can('edit_post', $post_id)` — so exposing the field never widens who is allowed to change it. Only someone who could already edit that post in wp-admin can write it over the API.

That's it. No admin UI, no settings, no external requests, no data collection, nothing written to the database beyond what the SEO plugin already stores.

## Install

**From WordPress.org** (once published there): Plugins → Add New → search "SEO REST API Meta Bridge" → Install → Activate.

**Manual install:**
1. Download this repo as a ZIP (or just `seo-rest-api-meta.php`).
2. Upload the `seo-rest-api-meta` folder to `/wp-content/plugins/`.
3. Activate it from the Plugins menu.

## Supported fields

| Plugin | Fields |
|---|---|
| Rank Math | SEO title, description, focus keyword, canonical URL |
| Yoast SEO | SEO title, meta description, focus keyword, canonical, Open Graph title/description/image, Twitter title/description |
| All in One SEO | title, description, keywords, canonical, Open Graph title/description/image, Twitter title/description |

## License

GPLv2 or later — see [LICENSE](./LICENSE).

## Not affiliated

Not affiliated with or endorsed by Rank Math, Yoast SEO or All in One SEO. Those names are trademarks of their respective owners, used here only to describe compatibility.
