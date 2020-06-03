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

if ( ! class_exists( 'Kanga_Woo_Shop_Single_Layout_Configs' ) ) {


	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Woo_Shop_Single_Layout_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga-WooCommerce Shop Single Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				* Option: Disable Breadcrumb
				*/
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-product-breadcrumb-disable]',
					'section'  => 'section-woo-shop-single',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => kanga_get_option( 'single-product-breadcrumb-disable' ),
					'title'    => __( 'Disable Breadcrumb', 'kanga' ),
					'priority' => 16,
				),

				/**
				 * Option: Disable Transparent Header on WooCommerce Product pages
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[transparent-header-disable-woo-products]',
					'default'  => kanga_get_option( 'transparent-header-disable-woo-products' ),
					'type'     => 'control',
					'section'  => 'section-transparent-header',
					'title'    => __( 'Disable on WooCommerce Product Pages?', 'kanga' ),
					'required' => array( ASTRA_THEME_SETTINGS . '[transparent-header-enable]', '==', '1' ),
					'priority' => 26,
					'control'  => 'checkbox',
				),
			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new Kanga_Woo_Shop_Single_Layout_Configs();


