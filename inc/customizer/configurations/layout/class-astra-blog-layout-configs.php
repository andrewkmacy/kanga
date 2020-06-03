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

if ( ! class_exists( 'Kanga_Blog_Layout_Configs' ) ) {

	/**
	 * Register Blog Layout Customizer Configurations.
	 */
	class Kanga_Blog_Layout_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Blog Layout Customizer Configurations.
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
					'name'     => KANGA_THEME_SETTINGS . '[ast-styling-section-blog-width]',
					'type'     => 'control',
					'control'  => 'ast-divider',
					'section'  => 'section-blog',
					'priority' => 60,
					'settings' => array(),
				),

				/**
				 * Option: Blog Content Width
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[blog-width]',
					'default'  => kanga_get_option( 'blog-width' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-blog',
					'priority' => 50,
					'title'    => __( 'Content Width', 'kanga' ),
					'choices'  => array(
						'default' => __( 'Default', 'kanga' ),
						'custom'  => __( 'Custom', 'kanga' ),
					),
				),

				/**
				 * Option: Enter Width
				 */
				array(
					'name'        => KANGA_THEME_SETTINGS . '[blog-max-width]',
					'type'        => 'control',
					'control'     => 'ast-slider',
					'section'     => 'section-blog',
					'transport'   => 'postMessage',
					'default'     => 1200,
					'priority'    => 50,
					'required'    => array( KANGA_THEME_SETTINGS . '[blog-width]', '===', 'custom' ),
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
					'name'     => KANGA_THEME_SETTINGS . '[ast-styling-section-blog-width-end]',
					'type'     => 'control',
					'control'  => 'ast-divider',
					'section'  => 'section-blog',
					'priority' => 50,
					'settings' => array(),
				),

				/**
				 * Option: Blog Post Content
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[blog-post-content]',
					'section'  => 'section-blog',
					'title'    => __( 'Post Content', 'kanga' ),
					'default'  => kanga_get_option( 'blog-post-content' ),
					'type'     => 'control',
					'control'  => 'select',
					'priority' => 75,
					'choices'  => array(
						'full-content' => __( 'Full Content', 'kanga' ),
						'excerpt'      => __( 'Excerpt', 'kanga' ),
					),
				),

				/**
				 * Option: Display Post Structure
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[blog-post-structure]',
					'default'  => kanga_get_option( 'blog-post-structure' ),
					'type'     => 'control',
					'control'  => 'ast-sortable',
					'section'  => 'section-blog',
					'priority' => 50,
					'title'    => __( 'Post Structure', 'kanga' ),
					'choices'  => array(
						'image'      => __( 'Featured Image', 'kanga' ),
						'title-meta' => __( 'Title & Blog Meta', 'kanga' ),
					),
				),

				/**
				 * Option: Display Post Meta
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[blog-meta]',
					'type'     => 'control',
					'control'  => 'ast-sortable',
					'section'  => 'section-blog',
					'default'  => kanga_get_option( 'blog-meta' ),
					'priority' => 50,
					'required' => array( KANGA_THEME_SETTINGS . '[blog-post-structure]', 'contains', 'title-meta' ),
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


new Kanga_Blog_Layout_Configs();





