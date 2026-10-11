=== SEO REST API – Meta Bridge ===
Contributors: seokraft
Tags: rest api, seo, headless, meta, api
Requires at least: 5.6
Tested up to: 6.8
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Write SEO meta over the WordPress REST API — works with Rank Math, Yoast SEO and All in One SEO. Perfect for headless WordPress and automation.

== Description ==

**SEO REST API – Meta Bridge** unlocks your SEO plugin's meta fields for the WordPress REST API.

By default, WordPress does not expose SEO meta (SEO title, meta description, focus keyword, canonical URL, Open Graph and Twitter fields) over the REST API, so an external app, a headless front-end or an automation workflow **cannot set them when it creates or updates a post through the API**. They come back empty and you have to re-enter every field by hand in wp-admin.

This lightweight plugin fixes that. It registers the SEO meta keys with `show_in_rest` enabled, so those fields become readable **and writable** through the standard `/wp/v2/posts` REST endpoint — no configuration, nothing to set up. Activate it and your SEO metadata flows in automatically.

= Works with =

* **Rank Math** — SEO title, description, focus keyword, canonical URL
* **Yoast SEO** — SEO title, meta description, focus keyword, canonical, Open Graph title/description/image, Twitter title/description
* **All in One SEO (AIOSEO)** — title, description, keywords, canonical, Open Graph and Twitter fields

= Ideal for =

* Headless WordPress (Next.js, Astro, Nuxt, Gatsby…)
* AI content and SEO tools that publish to WordPress
* n8n / Make / Zapier and custom automation workflows
* Any REST API integration that needs to write SEO metadata

= Secure by design =

The plugin only exposes existing meta keys for REST access. Writes are restricted to users who already have permission to edit the post (`edit_post`), so it never widens who can change your content. It makes no external requests, collects no data, adds no admin pages and stores nothing of its own.

= Not affiliated =

This plugin is not affiliated with or endorsed by Rank Math, Yoast SEO or All in One SEO. Those product names are trademarks of their respective owners and are used here only to describe compatibility.

== Installation ==

1. In your WordPress admin, go to **Plugins → Add New**.
2. Search for **"SEO REST API Meta Bridge"**.
3. Click **Install Now**, then **Activate**.

That's it — there is nothing to configure. The SEO meta fields are immediately available over the REST API.

Manual installation:

1. Upload the `seo-rest-api-meta` folder to `/wp-content/plugins/`.
2. Activate the plugin through the **Plugins** menu in WordPress.

== Frequently Asked Questions ==

= Why do I need this? =

The SEO plugins store their data as protected post meta that WordPress does not expose over REST by default. Without registering those keys for REST access, any post created through the API is published with empty SEO fields. This plugin registers them so they can be written via the API.

= Does it change anything on my site? =

No. It does not modify your content, your theme or your SEO plugin's behavior. It only makes the SEO meta fields accessible over the REST API for users who are already allowed to edit posts.

= Which SEO plugins are supported? =

Rank Math, Yoast SEO and All in One SEO. You only need to have one of them installed — the plugin registers the keys for whichever you use.

= Is it safe? Who can write these fields? =

Only users who can edit the target post. The plugin uses WordPress's own `edit_post` capability check for every field, so it does not grant new permissions to anyone.

= Does it work with custom post types or WooCommerce products? =

This version registers the fields for standard posts. Support for pages and custom post types is planned for a future release.

== Changelog ==

= 1.0.0 =
* Initial release. Registers Rank Math, Yoast SEO and All in One SEO meta fields for REST API read/write access.

== Upgrade Notice ==

= 1.0.0 =
Initial release.
