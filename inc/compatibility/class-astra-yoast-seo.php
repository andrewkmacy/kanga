<?php
/**
 * Yoast SEO Compatibility File.
 *
 * @package Kanga
 */

/**
 * Kanga Yoast SEO Compatibility
 *
 * @since 2.1.2
 */
class Kanga_Yoast_SEO {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'wpseo_sitemap_exclude_post_type', array( $this, 'sitemap_exclude_post_type' ), 10, 2 );
	}

	/**
	 * Exclude One Content Type From Yoast SEO Sitemap
	 *
	 * @param  string $value value.
	 * @param  string $post_type Post Type.
	 * @since 2.1.2
	 */
	public function sitemap_exclude_post_type( $value, $post_type ) {
		if ( 'kanga-advanced-hook' === $post_type ) {
			return true;
		}
	}

}

/**
 * Kicking this off by object
 */
new Kanga_Yoast_SEO();
