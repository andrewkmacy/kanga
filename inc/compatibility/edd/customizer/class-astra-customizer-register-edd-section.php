<?php
/**
 * Register customizer panels & sections for Easy Digital Downloads.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Kanga_Customizer_Register_Edd_Section' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Customizer_Register_Edd_Section extends Kanga_Customizer_Config_Base {

		/**
		 * Register Panels and Sections for Customizer.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.5.5
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$configs = array(
				/**
				 * WooCommerce
				 */
				array(
					'name'     => 'section-edd-group',
					'type'     => 'section',
					'title'    => __( 'Easy Digital Downloads', 'kanga' ),
					'priority' => 60,
				),

				array(
					'name'     => 'section-edd-archive',
					'title'    => __( 'Product Archive', 'kanga' ),
					'type'     => 'section',
					'section'  => 'section-edd-group',
					'priority' => 10,
				),

				array(
					'name'     => 'section-edd-single',
					'type'     => 'section',
					'title'    => __( 'Single Product', 'kanga' ),
					'section'  => 'section-edd-group',
					'priority' => 15,
				),
			);

			return array_merge( $configurations, $configs );
		}
	}
}


new Kanga_Customizer_Register_Edd_Section();
