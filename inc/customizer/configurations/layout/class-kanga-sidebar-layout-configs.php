<?php
/**
 * Bottom Footer Options for Kanga Theme.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Sidebar_Layout_Configs' ) ) {

	/**
	 * Register Kanga Sidebar Layout Configurations.
	 */
	class Kanga_Sidebar_Layout_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga Sidebar Layout Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Default Sidebar Position
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[site-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-sidebars',
					'default'  => kanga_get_option( 'site-sidebar-layout' ),
					'priority' => 5,
					'title'    => __( 'Default Layout', 'kanga' ),
					'choices'  => array(
						'no-sidebar'    => __( 'No Sidebar', 'kanga' ),
						'left-sidebar'  => __( 'Left Sidebar', 'kanga' ),
						'right-sidebar' => __( 'Right Sidebar', 'kanga' ),
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[single-page-sidebar-layout-divider]',
					'type'     => 'control',
					'control'  => 'ast-divider',
					'section'  => 'section-sidebars',
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: Page
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[single-page-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-sidebars',
					'default'  => kanga_get_option( 'single-page-sidebar-layout' ),
					'priority' => 5,
					'title'    => __( 'Pages', 'kanga' ),
					'choices'  => array(
						'default'       => __( 'Default', 'kanga' ),
						'no-sidebar'    => __( 'No Sidebar', 'kanga' ),
						'left-sidebar'  => __( 'Left Sidebar', 'kanga' ),
						'right-sidebar' => __( 'Right Sidebar', 'kanga' ),
					),
				),

				/**
				 * Option: Blog Post
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[single-post-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => kanga_get_option( 'single-post-sidebar-layout' ),
					'section'  => 'section-sidebars',
					'priority' => 5,
					'title'    => __( 'Blog Posts', 'kanga' ),
					'choices'  => array(
						'default'       => __( 'Default', 'kanga' ),
						'no-sidebar'    => __( 'No Sidebar', 'kanga' ),
						'left-sidebar'  => __( 'Left Sidebar', 'kanga' ),
						'right-sidebar' => __( 'Right Sidebar', 'kanga' ),
					),
				),

				/**
				 * Option: Blog Post Archive
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[archive-post-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => kanga_get_option( 'archive-post-sidebar-layout' ),
					'section'  => 'section-sidebars',
					'priority' => 5,
					'title'    => __( 'Archives', 'kanga' ),
					'choices'  => array(
						'default'       => __( 'Default', 'kanga' ),
						'no-sidebar'    => __( 'No Sidebar', 'kanga' ),
						'left-sidebar'  => __( 'Left Sidebar', 'kanga' ),
						'right-sidebar' => __( 'Right Sidebar', 'kanga' ),
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[divider-section-sidebar-width]',
					'type'     => 'control',
					'section'  => 'section-sidebars',
					'control'  => 'ast-divider',
					'priority' => 10,
					'settings' => array(),
				),

				/**
				 * Option: Primary Content Width
				 */
				array(
					'name'        => KANGA_THEME_SETTINGS . '[site-sidebar-width]',
					'type'        => 'control',
					'control'     => 'ast-slider',
					'default'     => 30,
					'section'     => 'section-sidebars',
					'priority'    => 15,
					'title'       => __( 'Sidebar Width', 'kanga' ),
					'suffix'      => '%',
					'input_attrs' => array(
						'min'  => 15,
						'step' => 1,
						'max'  => 50,
					),
				),

				array(
					'name'     => KANGA_THEME_SETTINGS . '[site-sidebar-width-description]',
					'type'     => 'control',
					'control'  => 'ast-description',
					'section'  => 'section-sidebars',
					'priority' => 15,
					'title'    => '',
					'help'     => __( 'Sidebar width will apply only when one of the above sidebar is set.', 'kanga' ),
					'settings' => array(),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}


new Kanga_Sidebar_Layout_Configs();





