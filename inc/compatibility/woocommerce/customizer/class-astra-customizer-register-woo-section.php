<?php
/**
 * Register customizer panels & sections fro Woocommerce.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.1.0
 * @since       1.4.6 Chnaged to using Kanga_Customizer API
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Kanga_Customizer_Register_Woo_Section' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Customizer_Register_Woo_Section extends Kanga_Customizer_Config_Base {

		/**
		 * Register Panels and Sections for Customizer.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$configs = array(

				array(
					'name'     => 'section-woo-general',
					'title'    => __( 'General', 'kanga' ),
					'type'     => 'section',
					'priority' => 10,
					'panel'    => 'woocommerce',
				),
				array(
					'name'     => 'section-woo-shop',
					'title'    => __( 'Shop', 'kanga' ),
					'type'     => 'section',
					'priority' => 20,
					'panel'    => 'woocommerce',
				),

				array(
					'name'     => 'section-woo-shop-single',
					'type'     => 'section',
					'title'    => __( 'Single Product', 'kanga' ),
					'priority' => 12,
					'panel'    => 'woocommerce',
				),

				array(
					'name'     => 'section-woo-shop-cart',
					'type'     => 'section',
					'title'    => __( 'Cart', 'kanga' ),
					'priority' => 20,
					'panel'    => 'woocommerce',
				),
			);

			return array_merge( $configurations, $configs );
		}
	}
}


new Kanga_Customizer_Register_Woo_Section();
