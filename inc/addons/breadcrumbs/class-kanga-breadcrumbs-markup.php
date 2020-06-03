<?php
/**
 * Breadcrumbs for Kanga theme.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Kanga 1.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Kanga_Breadcrumbs_Markup' ) ) {

	/**
	 * Breadcrumbs Markup Initial Setup
	 *
	 * @since 1.8.0
	 */
	class Kanga_Breadcrumbs_Markup {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {

			add_action( 'wp', array( $this, 'kanga_breadcumb_template' ) );
		}

		/**
		 * Kanga Breadcrumbs Template
		 *
		 * Loads template based on the style option selected in options panel for Breadcrumbs.
		 *
		 * @since 1.8.0
		 *
		 * @return void
		 */
		public function kanga_breadcumb_template() {

			$breadcrumb_position = kanga_get_option( 'breadcrumb-position' );

			$breadcrumb_enabled = false;

			if ( is_singular() ) {
				$breadcrumb_enabled = get_post_meta( get_the_ID(), 'ast-breadcrumbs-content', true );
			}

			if ( 'disabled' !== $breadcrumb_enabled && $breadcrumb_position && 'none' !== $breadcrumb_position && ! ( ( is_home() || is_front_page() ) && ( 'kanga_entry_top' === $breadcrumb_position ) ) ) {
				if ( self::kanga_breadcrumb_rules() ) {
					if ( ( is_archive() || is_search() ) && 'kanga_entry_top' === $breadcrumb_position ) {
						add_action( 'kanga_before_archive_title', array( $this, 'kanga_hook_breadcrumb_position' ), 15 );
					} else {
						add_action( $breadcrumb_position, array( $this, 'kanga_hook_breadcrumb_position' ), 15 );
					}
				}
			}
		}

		/**
		 * Kanga Hook Breadcrumb Position
		 *
		 * Hook breadcrumb to position of selected option
		 *
		 * @since 1.8.0
		 *
		 * @return void
		 */
		public function kanga_hook_breadcrumb_position() {
			$breadcrumb_position = kanga_get_option( 'breadcrumb-position' );

			if ( $breadcrumb_position && 'kanga_header_markup_after' === $breadcrumb_position ) {
				echo '<div class="main-header-bar ast-header-breadcrumb">
							<div class="ast-container">';
			}
			kanga_get_breadcrumb();
			if ( $breadcrumb_position && 'kanga_header_markup_after' === $breadcrumb_position ) {
				echo '	</div>
					</div>';
			}
		}

		/**
		 * Kanga Breadcrumbs Rules
		 *
		 * Checks the rules defined for displaying Breadcrumb on different pages.
		 *
		 * @since 1.8.0
		 *
		 * @return boolean
		 */
		public static function kanga_breadcrumb_rules() {

			// Display Breadcrumb default true.
			$display_breadcrumb = true;

			if ( is_front_page() && '1' == kanga_get_option( 'breadcrumb-disable-home-page' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_home() && '1' == kanga_get_option( 'breadcrumb-disable-blog-posts-page' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_search() && '1' == kanga_get_option( 'breadcrumb-disable-search' ) ) {
				$display_breadcrumb = false;
			}

			if ( ( is_archive() ) && '1' == kanga_get_option( 'breadcrumb-disable-archive' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_page() && '1' == kanga_get_option( 'breadcrumb-disable-single-page' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_single() && '1' == kanga_get_option( 'breadcrumb-disable-single-post' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_singular() && '1' == kanga_get_option( 'breadcrumb-disable-singular' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_404() && '1' == kanga_get_option( 'breadcrumb-disable-404-page' ) ) {
				$display_breadcrumb = false;
			}

			return apply_filters( 'kanga_breadcrumb_enabled', $display_breadcrumb );
		}
	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Kanga_Breadcrumbs_Markup::get_instance();
