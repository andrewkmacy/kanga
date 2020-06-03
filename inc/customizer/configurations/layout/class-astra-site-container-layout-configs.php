<?php
/**
 * General Options for Kanga Theme.
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



if ( ! class_exists( 'Kanga_Site_Container_Layout_Configs' ) ) {

	/**
	 * Register Kanga Site Container Layout Customizer Configurations.
	 */
	class Kanga_Site_Container_Layout_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga Site Container Layout Customizer Configurations.
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
					'name'     => ASTRA_THEME_SETTINGS . '[site-content-layout-divider]',
					'type'     => 'control',
					'control'  => 'ast-divider',
					'section'  => 'section-container-layout',
					'priority' => 50,
					'settings' => array(),
				),

				/**
				 * Option: Single Page Content Layout
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[site-content-layout]',
					'type'     => 'control',
					'default'  => kanga_get_option( 'site-content-layout' ),
					'control'  => 'select',
					'section'  => 'section-container-layout',
					'priority' => 50,
					'title'    => __( 'Layout', 'kanga' ),
					'choices'  => array(
						'boxed-container'         => __( 'Boxed', 'kanga' ),
						'content-boxed-container' => __( 'Content Boxed', 'kanga' ),
						'plain-container'         => __( 'Full Width / Contained', 'kanga' ),
						'page-builder'            => __( 'Full Width / Stretched', 'kanga' ),
					),
				),

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-page-content-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => kanga_get_option( 'single-page-content-layout' ),
					'section'  => 'section-container-layout',
					'title'    => __( 'Page Layout', 'kanga' ),
					'priority' => 55,
					'choices'  => array(
						'default'                 => __( 'Default', 'kanga' ),
						'boxed-container'         => __( 'Boxed', 'kanga' ),
						'content-boxed-container' => __( 'Content Boxed', 'kanga' ),
						'plain-container'         => __( 'Full Width / Contained', 'kanga' ),
						'page-builder'            => __( 'Full Width / Stretched', 'kanga' ),
					),
				),

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[single-post-content-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => kanga_get_option( 'single-post-content-layout' ),
					'section'  => 'section-container-layout',
					'priority' => 60,
					'title'    => __( 'Blog Post Layout', 'kanga' ),
					'choices'  => array(
						'default'                 => __( 'Default', 'kanga' ),
						'boxed-container'         => __( 'Boxed', 'kanga' ),
						'content-boxed-container' => __( 'Content Boxed', 'kanga' ),
						'plain-container'         => __( 'Full Width / Contained', 'kanga' ),
						'page-builder'            => __( 'Full Width / Stretched', 'kanga' ),
					),
				),

				/**
				 * Option: Archive Post Content Layout
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[archive-post-content-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => kanga_get_option( 'archive-post-content-layout' ),
					'section'  => 'section-container-layout',
					'priority' => 65,
					'title'    => __( 'Archives Layout', 'kanga' ),
					'choices'  => array(
						'default'                 => __( 'Default', 'kanga' ),
						'boxed-container'         => __( 'Boxed', 'kanga' ),
						'content-boxed-container' => __( 'Content Boxed', 'kanga' ),
						'plain-container'         => __( 'Full Width / Contained', 'kanga' ),
						'page-builder'            => __( 'Full Width / Stretched', 'kanga' ),
					),
				),

				/**
				 * Option: Body Background
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[site-layout-outside-bg-obj-responsive]',
					'type'      => 'control',
					'control'   => 'ast-responsive-background',
					'default'   => kanga_get_option( 'site-layout-outside-bg-obj-responsive' ),
					'section'   => 'section-colors-body',
					'transport' => 'postMessage',
					'priority'  => 25,
					'title'     => __( 'Background', 'kanga' ),
				),

			);

			$configurations = array_merge( $configurations, $_configs );

			// Learn More link if Kanga Pro is not activated.
			if ( ! defined( 'ASTRA_EXT_VER' ) ) {

				$config = array(

					/**
					 * Option: Divider
					 */

					array(
						'name'     => ASTRA_THEME_SETTINGS . '[ast-container-more-feature-divider]',
						'type'     => 'control',
						'default'  => kanga_get_option( 'site-content-layout' ),
						'control'  => 'ast-divider',
						'section'  => 'section-container-layout',
						'priority' => 999,
						'settings' => array(),
					),

					array(
						'name'     => ASTRA_THEME_SETTINGS . '[ast-container-more-feature-description]',
						'type'     => 'control',
						'control'  => 'ast-description',
						'section'  => 'section-container-layout',
						'priority' => 999,
						'title'    => '',
						'help'     => '<p>' . __( 'More Options Available in Kanga Pro!', 'kanga' ) . '</p><a href="' . kanga_get_pro_url( 'https://wpkanga.com/pro/', 'customizer', 'learn-more', 'upgrade-to-pro' ) . '" class="button button-secondary"  target="_blank" rel="noopener">' . __( 'Learn More', 'kanga' ) . '</a>',
						'settings' => array(),
					),
				);

				$configurations = array_merge( $configurations, $config );
			}

			return $configurations;
		}
	}
}


new Kanga_Site_Container_Layout_Configs();




