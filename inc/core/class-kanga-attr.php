<?php
/**
 * Kanga Attributes Class.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.6.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Kanga_Attr' ) ) :

	/**
	 * Class Kanga_Attr
	 */
	class Kanga_Attr {

		/**
		 * Store Instance on Current Class.
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Initialuze the Class.
		 *
		 * @since 1.6.2
		 */
		private function __construct() {}

		/**
		 * Build list of attributes into a string and apply contextual filter on string.
		 *
		 * The contextual filter is of the form `kanga_attr_{context}_output`.
		 *
		 * @since 1.6.2
		 *
		 * @param string $context    The context, to build filter name.
		 * @param array  $attributes Optional. Extra attributes to merge with defaults.
		 * @param array  $args       Optional. Custom data to pass to filter.
		 * @return string String of HTML attributes and values.
		 */
		public function kanga_attr( $context, $attributes = array(), $args = array() ) {

			$attributes = $this->kanga_parse_attr( $context, $attributes, $args );

			$output = '';

			// Cycle through attributes, build tag attribute string.
			foreach ( $attributes as $key => $value ) {

				if ( ! $value ) {
					continue;
				}

				if ( true === $value ) {
					$output .= esc_html( $key ) . ' ';
				} else {
					$output .= sprintf( '%s="%s" ', esc_html( $key ), esc_attr( $value ) );
				}
			}

			$output = apply_filters( "kanga_attr_{$context}_output", $output, $attributes, $context, $args );

			return trim( $output );
		}

		/**
		 * Merge array of attributes with defaults, and apply contextual filter on array.
		 *
		 * The contextual filter is of the form `kanga_attr_{context}`.
		 *
		 * @since 1.6.2
		 *
		 * @param string $context    The context, to build filter name.
		 * @param array  $attributes Optional. Extra attributes to merge with defaults.
		 * @param array  $args       Optional. Custom data to pass to filter.
		 * @return array Merged and filtered attributes.
		 */
		public function kanga_parse_attr( $context, $attributes = array(), $args = array() ) {

			$defaults = array(
				'class' => sanitize_html_class( $context ),
			);

			$attributes = wp_parse_args( $attributes, $defaults );

			// Contextual filter.
			return apply_filters( "kanga_attr_{$context}", $attributes, $context, $args );
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kanga_Attr::get_instance();
