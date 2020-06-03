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

if ( ! class_exists( 'Kanga_Blog_Single_Layout_Configs' ) ) {

	/**
	 * Register Blog Single Layout Configurations.
	 */
	class Kanga_Blog_Single_Layout_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Blog Single Layout Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Single Post Content Width
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[blog-single-width]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-blog-single',
					'default'  => kanga_get_option( 'blog-single-width' ),
					'priority' => 5,
					'title'    => __( 'Content Width', 'kanga' ),
					'choices'  => array(
						'default' => __( 'Default', 'kanga' ),
						'custom'  => __( 'Custom', 'kanga' ),
					),
					'partial'  => array(
						'selector'            => '.ast-single-post .site-content .ast-container .content-area .entry-title',
						'container_inclusive' => false,
					),
				),

				/**
				 * Option: Enter Width
				 */
				array(
					'name'        => KANGA_THEME_SETTINGS . '[blog-single-max-width]',
					'type'        => 'control',
					'control'     => 'ast-slider',
					'section'     => 'section-blog-single',
					'transport'   => 'postMessage',
					'default'     => 1200,
					'required'    => array( KANGA_THEME_SETTINGS . '[blog-single-width]', '===', 'custom' ),
					'priority'    => 5,
					'title'       => __( 'Custom Width', 'kanga' ),
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[ast-styling-section-blog-single-width]',
					'type'     => 'control',
					'control'  => 'ast-divider',
					'section'  => 'section-blog-single',
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: Display Post Structure
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[blog-single-post-structure]',
					'type'     => 'control',
					'control'  => 'ast-sortable',
					'section'  => 'section-blog-single',
					'default'  => kanga_get_option( 'blog-single-post-structure' ),
					'priority' => 5,
					'title'    => __( 'Structure', 'kanga' ),
					'choices'  => array(
						'single-image'      => __( 'Featured Image', 'kanga' ),
						'single-title-meta' => __( 'Title & Blog Meta', 'kanga' ),
					),
				),

				/**
				 * Option: Single Post Meta
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[blog-single-meta]',
					'type'     => 'control',
					'control'  => 'ast-sortable',
					'default'  => kanga_get_option( 'blog-single-meta' ),
					'required' => array( KANGA_THEME_SETTINGS . '[blog-single-post-structure]', 'contains', 'single-title-meta' ),
					'section'  => 'section-blog-single',
					'priority' => 5,
					'title'    => __( 'Meta', 'kanga' ),
					'choices'  => array(
						'comments' => __( 'Comments', 'kanga' ),
						'category' => __( 'Category', 'kanga' ),
						'author'   => __( 'Author', 'kanga' ),
						'date'     => __( 'Publish Date', 'kanga' ),
						'tag'      => __( 'Tag', 'kanga' ),
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new Kanga_Blog_Single_Layout_Configs();





