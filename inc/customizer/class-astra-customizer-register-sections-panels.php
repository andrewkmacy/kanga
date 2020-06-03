<?php
/**
 * Register customizer panels & sections.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Kanga_Customizer_Register_Sections_Panels' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Customizer_Register_Sections_Panels extends Kanga_Customizer_Config_Base {

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

				/**
				 * Layout Panel
				 */

				array(
					'name'     => 'panel-global',
					'type'     => 'panel',
					'priority' => 10,
					'title'    => __( 'Global', 'kanga' ),
				),

				array(
					'name'               => 'section-container-layout',
					'type'               => 'section',
					'priority'           => 17,
					'title'              => __( 'Container', 'kanga' ),
					'panel'              => 'panel-global',
					'description_hidden' => true,
					'description'        => $this->section_get_description(
						array(
							'description' => '<p><b>' . __( 'Helpful Information', 'kanga' ) . '</b></p>',
							'links'       => array(
								array(
									'text'  => __( 'Site Layout Overview', 'kanga' ) . ' &#187;',
									'attrs' => array(
										'href' => kanga_get_pro_url( 'https://wpkanga.com/docs/site-layout-overview/', 'customizer', 'site-layout', 'helpful-information' ),
									),
								),
								array(
									'text'  => __( 'Container Overview', 'kanga' ) . ' &#187;',
									'attrs' => array(
										'href' => kanga_get_pro_url( 'https://wpkanga.com/docs/container-overview/', 'customizer', 'container', 'helpful-information' ),
									),
								),
							),
						)
					),
				),

				/*
				 * Header section
				 *
				 * @since 1.4.0
				 */
				array(
					'name'     => 'panel-header-group',
					'type'     => 'panel',
					'priority' => 20,
					'title'    => __( 'Header', 'kanga' ),
				),

				/*
				 * Update the Site Identity section inside Layout -> Header
				 *
				 * @since 1.4.0
				 */
				array(
					'name'               => 'title_tagline',
					'type'               => 'section',
					'priority'           => 5,
					'title'              => __( 'Site Identity', 'kanga' ),
					'panel'              => 'panel-header-group',
					'description_hidden' => true,
					'description'        => $this->section_get_description(
						array(
							'description' => '<p><b>' . __( 'Helpful Information', 'kanga' ) . '</b></p>',
							'links'       => array(
								array(
									'text'  => __( 'Site Identity Overview', 'kanga' ) . ' &#187;',
									'attrs' => array(
										'href' => kanga_get_pro_url( 'https://wpkanga.com/docs/site-identity-free/', 'customizer', 'site-identity', 'helpful-information' ),
									),
								),
							),
						)
					),
				),

				/*
				 * Update the Primary Header section
				 *
				 * @since 1.4.0
				 */
				array(
					'name'               => 'section-header',
					'type'               => 'section',
					'priority'           => 15,
					'title'              => __( 'Primary Header', 'kanga' ),
					'panel'              => 'panel-header-group',
					'description_hidden' => true,
					'description'        => $this->section_get_description(
						array(
							'description' => '<p><b>' . __( 'Helpful Information', 'kanga' ) . '</b></p>',
							'links'       => array(
								array(
									'text'  => __( 'Primary Header Overview', 'kanga' ) . ' &#187;',
									'attrs' => array(
										'href' => kanga_get_pro_url( 'https://wpkanga.com/docs/header-overview/', 'customizer', 'primary-header', 'helpful-information' ),
									),
								),
							),
						)
					),
				),

				array(
					'name'     => 'section-primary-menu',
					'type'     => 'section',
					'priority' => 15,
					'title'    => __( 'Primary Menu', 'kanga' ),
					'panel'    => 'panel-header-group',
				),
				array(
					'name'     => 'section-footer-group',
					'type'     => 'section',
					'title'    => __( 'Footer', 'kanga' ),
					'priority' => 55,
				),

				array(
					'name'             => 'section-separator',
					'type'             => 'section',
					'priority'         => 70,
					'section_callback' => 'Kanga_WP_Customize_Separator',
				),

				/**
				 * Footer Widgets Section
				 */

				array(
					'name'     => 'section-footer-adv',
					'type'     => 'section',
					'title'    => __( 'Footer Widgets', 'kanga' ),
					'section'  => 'section-footer-group',
					'priority' => 5,
				),

				array(
					'name'               => 'section-footer-small',
					'type'               => 'section',
					'title'              => __( 'Footer Bar', 'kanga' ),
					'section'            => 'section-footer-group',
					'priority'           => 10,
					'description_hidden' => true,
					'description'        => $this->section_get_description(
						array(
							'description' => '<p><b>' . __( 'Helpful Information', 'kanga' ) . '</b></p>',
							'links'       => array(
								array(
									'text'  => __( 'Footer Bar Overview', 'kanga' ) . ' &#187;',
									'attrs' => array(
										'href' => kanga_get_pro_url( 'https://wpkanga.com/docs/footer-bar/', 'customizer', 'footer-bar', 'helpful-information' ),
									),
								),
							),
						)
					),
				),

				array(
					'name'     => 'section-blog-group',
					'type'     => 'section',
					'priority' => 40,
					'title'    => __( 'Blog', 'kanga' ),
				),
				array(
					'name'     => 'section-blog',
					'type'     => 'section',
					'priority' => 5,
					'title'    => __( 'Blog / Archive', 'kanga' ),
					'section'  => 'section-blog-group',
				),
				array(
					'name'     => 'section-blog-single',
					'type'     => 'section',
					'priority' => 10,
					'title'    => __( 'Single Post', 'kanga' ),
					'section'  => 'section-blog-group',
				),

				array(
					'name'               => 'section-sidebars',
					'type'               => 'section',
					'priority'           => 50,
					'title'              => __( 'Sidebar', 'kanga' ),
					'description_hidden' => true,
					'description'        => $this->section_get_description(
						array(
							'description' => '<p><b>' . __( 'Helpful Information', 'kanga' ) . '</b></p>',
							'links'       => array(
								array(
									'text'  => __( 'Sidebar Overview', 'kanga' ) . ' &#187;',
									'attrs' => array(
										'href' => kanga_get_pro_url( 'https://wpkanga.com/docs/sidebar-free/', 'customizer', 'sidebar', 'helpful-information' ),
									),
								),
							),
						)
					),
				),

				/**
				 * Colors Panel
				 */
				array(
					'name'               => 'section-colors-background',
					'type'               => 'section',
					'priority'           => 16,
					'title'              => __( 'Colors', 'kanga' ),
					'description_hidden' => true,
					'description'        => $this->section_get_description(
						array(
							'description' => '<p><b>' . __( 'Helpful Information', 'kanga' ) . '</b></p>',
							'links'       => array(
								array(
									'text'  => __( 'Colors & Background Overview', 'kanga' ) . ' &#187;',
									'attrs' => array(
										'href' => kanga_get_pro_url( 'https://wpkanga.com/docs/colors-background/', 'customizer', 'colors-background', 'helpful-information' ),
									),
								),
							),
						)
					),
					'panel'              => 'panel-global',
				),

				array(
					'name'     => 'section-colors-body',
					'type'     => 'section',
					'title'    => __( 'Base Colors', 'kanga' ),
					'panel'    => 'panel-global',
					'priority' => 1,
					'section'  => 'section-colors-background',
				),

				array(
					'name'     => 'section-footer-adv-color-bg',
					'type'     => 'section',
					'title'    => __( 'Footer Widgets', 'kanga' ),
					'panel'    => 'panel-colors-background',
					'priority' => 55,
				),

				/**
				 * Typography Panel
				 */
				array(
					'name'               => 'section-typography',
					'type'               => 'section',
					'title'              => __( 'Typography', 'kanga' ),
					'priority'           => 15,
					'description_hidden' => true,
					'description'        => $this->section_get_description(
						array(
							'description' => '<p><b>' . __( 'Helpful Information', 'kanga' ) . '</b></p>',
							'links'       => array(
								array(
									'text'  => __( 'Typography Overview', 'kanga' ) . ' &#187;',
									'attrs' => array(
										'href' => kanga_get_pro_url( 'https://wpkanga.com/docs/typography-free/', 'customizer', 'typography', 'helpful-information' ),
									),
								),
							),
						)
					),
					'panel'              => 'panel-global',
				),

				array(
					'name'     => 'section-body-typo',
					'type'     => 'section',
					'title'    => __( 'Base Typography', 'kanga' ),
					'section'  => 'section-typography',
					'priority' => 1,
					'panel'    => 'panel-global',
				),

				array(
					'name'     => 'section-content-typo',
					'type'     => 'section',
					'title'    => __( 'Headings', 'kanga' ),
					'section'  => 'section-typography',
					'priority' => 35,
					'panel'    => 'panel-global',
				),

				/**
				 * Buttons Section
				 */
				array(
					'name'     => 'section-buttons',
					'type'     => 'section',
					'priority' => 50,
					'title'    => __( 'Buttons', 'kanga' ),
					'panel'    => 'panel-global',
				),

				/**
				 * Header Buttons
				 */
				array(
					'name'     => 'section-header-button',
					'type'     => 'section',
					'priority' => 10,
					'title'    => __( 'Header Button', 'kanga' ),
					'section'  => 'section-buttons',
				),

				/**
				 * Header Button - Default
				 */
				array(
					'name'     => 'section-header-button-default',
					'type'     => 'section',
					'priority' => 10,
					'title'    => __( 'Primary Header Button', 'kanga' ),
					'section'  => 'section-header-button',
				),

				/**
				 * Header Button - Transparent
				 */
				array(
					'name'     => 'section-header-button-transparent',
					'type'     => 'section',
					'priority' => 10,
					'title'    => __( 'Transparent Header Button', 'kanga' ),
					'section'  => 'section-header-button',
				),

				/**
				 * Widget Areas Section
				 */
				array(
					'name'     => 'section-widget-areas',
					'type'     => 'section',
					'priority' => 55,
					'title'    => __( 'Widget Areas', 'kanga' ),
				),

			);

			return array_merge( $configurations, $configs );
		}
	}
}


/**
 * Kicking this off by calling 'get_instance()' method
 */
new Kanga_Customizer_Register_Sections_Panels();
