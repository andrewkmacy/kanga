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
 * Kanga CreativeWork Schema Markup.
 *
 * @since 2.1.3
 */
class Kanga_WPSideBar_Schema extends Kanga_Schema {

	/**
	 * Setup schema
	 *
	 * @since 2.1.3
	 */
	public function setup_schema() {

		if ( true !== $this->schema_enabled() ) {
			return false;
		}

		add_filter( 'kanga_attr_sidebar', array( $this, 'wpsidebar_Schema' ) );
	}

	/**
	 * Update Schema markup attribute.
	 *
	 * @param  array $attr An array of attributes.
	 *
	 * @return array       Updated embed markup.
	 */
	public function wpsidebar_Schema( $attr ) {
		$attr['itemtype']  = 'https://schema.org/WPSideBar';
		$attr['itemscope'] = 'itemscope';

		return $attr;
	}

	/**
	 * Enabled schema
	 *
	 * @since 2.1.3
	 */
	protected function schema_enabled() {
		return apply_filters( 'kanga_wpsidebar_schema_enabled', parent::schema_enabled() );
	}

}

new Kanga_WPSideBar_Schema();
