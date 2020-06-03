<?php
/**
 * Easy Digital Downloads Sidebar Options for our theme.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Kanga 1.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Edd_Sidebar_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Edd_Sidebar_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga Easy Digital Downloads Sidebar Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.5.5
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-product-sidebar-layout-divider]',
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
					'name'     => ASTRA_THEME_SETTINGS . '[edd-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-sidebars',
					'default'  => kanga_get_option( 'edd-sidebar-layout' ),
					'priority' => 5,
					'title'    => __( 'Easy Digital Downloads', 'kanga' ),
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
					'name'     => ASTRA_THEME_SETTINGS . '[edd-single-product-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => kanga_get_option( 'edd-single-product-sidebar-layout' ),
					'section'  => 'section-sidebars',
					'priority' => 5,
					'title'    => __( 'EDD Single Product', 'kanga' ),
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

new Kanga_Edd_Sidebar_Configs();



