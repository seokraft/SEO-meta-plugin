<?php
/**
 * Plugin Name:       SEO REST API – Meta Bridge
 * Plugin URI:        https://seokraft.io/seo-rest-api-meta
 * Description:       Exposes SEO meta fields to the WordPress REST API so they can be written when publishing posts via the API. Works with Rank Math, Yoast SEO and All in One SEO — title, description, focus keyword, canonical, Open Graph and Twitter. Ideal for headless WordPress and automation tools.
 * Version:           1.0.0
 * Requires at least: 5.6
 * Requires PHP:      7.2
 * Author:            SeoKraft
 * Author URI:        https://seokraft.io
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       seo-rest-api-meta
 *
 * Not affiliated with or endorsed by Rank Math, Yoast SEO or All in One SEO.
 * Those product names are trademarks of their respective owners and are used
 * here only to describe compatibility.
 *
 * @package SeoRestApiMeta
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

/**
 * The SEO post-meta keys unlocked for REST API access, grouped by plugin.
 *
 * WordPress and these SEO plugins do not expose their meta over REST by
 * default, so an external client cannot set them when creating or updating a
 * post through the API. Registering each key with show_in_rest = true makes
 * them readable and writable via REST.
 *
 * @return string[] List of meta keys.
 */
function skmb_seo_meta_keys() {
	return array(
		// Rank Math.
		'rank_math_title',
		'rank_math_description',
		'rank_math_focus_keyword',
		'rank_math_canonical_url',

		// Yoast SEO.
		'_yoast_wpseo_title',
		'_yoast_wpseo_metadesc',
		'_yoast_wpseo_focuskw',
		'_yoast_wpseo_canonical',
		'_yoast_wpseo_opengraph-title',
		'_yoast_wpseo_opengraph-description',
		'_yoast_wpseo_opengraph-image',
		'_yoast_wpseo_twitter-title',
		'_yoast_wpseo_twitter-description',

		// All in One SEO.
		'_aioseo_title',
		'_aioseo_description',
		'_aioseo_keywords',
		'_aioseo_canonical_url',
		'_aioseo_og_title',
		'_aioseo_og_description',
		'_aioseo_og_image_url',
		'_aioseo_twitter_title',
		'_aioseo_twitter_description',
	);
}

/**
 * Register the SEO meta keys for REST API read/write access.
 *
 * Writes are restricted to users who can edit the target post, so exposing the
 * fields does not widen who is allowed to change them.
 *
 * @return void
 */
function skmb_register_seo_meta() {
	foreach ( skmb_seo_meta_keys() as $meta_key ) {
		register_post_meta(
			'post',
			$meta_key,
			array(
				'show_in_rest'  => true,
				'single'        => true,
				'type'          => 'string',
				'auth_callback' => function ( $allowed, $meta_key, $post_id ) {
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);
	}
}
add_action( 'init', 'skmb_register_seo_meta' );
