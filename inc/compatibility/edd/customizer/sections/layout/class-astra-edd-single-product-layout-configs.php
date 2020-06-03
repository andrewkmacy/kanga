<?php
/**
 * Easy Digital Downloads Options for Kanga Theme.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Edd_Single_Product_Layout_Configs' ) ) {


	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Edd_Single_Product_Layout_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga-Easy Digital Downloads Shop Cart Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.5.5
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Cart upsells
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[disable-edd-single-product-nav]',
					'section'  => 'section-edd-single',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => kanga_get_option( 'disable-edd-single-product-nav' ),
					'title'    => __( 'Disable Product Navigation', 'kanga' ),
					'priority' => 10,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Kanga_Edd_Single_Product_Layout_Configs();
