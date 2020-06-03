<?php
/**
 * Content Spacing Options for our theme.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Kanga 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Woo_Shop_Sidebar_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Woo_Shop_Sidebar_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga-WooCommerce Shop Sidebar Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Divider
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[single-product-sidebar-layout-divider]',
					'section'  => 'section-sidebars',
					'type'     => 'control',
					'control'  => 'ast-divider',
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: Shop Page
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[woocommerce-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-sidebars',
					'default'  => kanga_get_option( 'woocommerce-sidebar-layout' ),
					'priority' => 5,
					'title'    => __( 'WooCommerce', 'kanga' ),
					'choices'  => array(
						'default'       => __( 'Default', 'kanga' ),
						'no-sidebar'    => __( 'No Sidebar', 'kanga' ),
						'left-sidebar'  => __( 'Left Sidebar', 'kanga' ),
						'right-sidebar' => __( 'Right Sidebar', 'kanga' ),
					),
				),

				/**
				 * Option: Single Product
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[single-product-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => kanga_get_option( 'single-product-sidebar-layout' ),
					'section'  => 'section-sidebars',
					'priority' => 5,
					'title'    => __( 'Single Product', 'kanga' ),
					'choices'  => array(
						'default'       => __( 'Default', 'kanga' ),
						'no-sidebar'    => __( 'No Sidebar', 'kanga' ),
						'left-sidebar'  => __( 'Left Sidebar', 'kanga' ),
						'right-sidebar' => __( 'Right Sidebar', 'kanga' ),
					),
				),
			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new Kanga_Woo_Shop_Sidebar_Configs();



