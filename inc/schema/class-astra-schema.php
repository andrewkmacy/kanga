<?php
/**
 * Schema markup.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 2.1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Kanga Schema Markup.
 *
 * @since 2.1.3
 */
class Kanga_Schema {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->include_schemas();

		add_action( 'wp', array( $this, 'setup_schema' ) );
	}

	/**
	 * Setup schema
	 *
	 * @since 2.1.3
	 */
	public function setup_schema() { }

	/**
	 * Include schema files.
	 *
	 * @since 2.1.3
	 */
	private function include_schemas() {
		require_once ASTRA_THEME_DIR . 'inc/schema/class-kanga-creativework-schema.php';
		require_once ASTRA_THEME_DIR . 'inc/schema/class-kanga-wpheader-schema.php';
		require_once ASTRA_THEME_DIR . 'inc/schema/class-kanga-wpfooter-schema.php';
		require_once ASTRA_THEME_DIR . 'inc/schema/class-kanga-wpsidebar-schema.php';
		require_once ASTRA_THEME_DIR . 'inc/schema/class-kanga-person-schema.php';
		require_once ASTRA_THEME_DIR . 'inc/schema/class-kanga-organization-schema.php';
		require_once ASTRA_THEME_DIR . 'inc/schema/class-kanga-site-navigation-schema.php';
		require_once ASTRA_THEME_DIR . 'inc/schema/class-kanga-breadcrumb-schema.php';
	}

	/**
	 * Enabled schema
	 *
	 * @since 2.1.3
	 */
	protected function schema_enabled() {
		return apply_filters( 'kanga_schema_enabled', true );
	}

}

new Kanga_Schema();
