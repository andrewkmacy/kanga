<?php
/**
 * WooCommerce Options for Kanga Theme.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Woo_Shop_Cart_Layout_Configs' ) ) {


	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Woo_Shop_Cart_Layout_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga-WooCommerce Shop Cart Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Cart upsells
				 *
				 * Enable Cross-sells - in the code it is refrenced as upsells rather than cross-sells.
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[enable-cart-upsells]',
					'section'  => 'section-woo-shop-cart',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => kanga_get_option( 'enable-cart-upsells' ),
					'title'    => __( 'Enable Cross-sells', 'kanga' ),
					'priority' => 10,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Kanga_Woo_Shop_Cart_Layout_Configs();
