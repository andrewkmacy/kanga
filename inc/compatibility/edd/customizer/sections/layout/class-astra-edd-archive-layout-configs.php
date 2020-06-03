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

if ( ! class_exists( 'Kanga_Edd_Archive_Layout_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Edd_Archive_Layout_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga-Easy Digital Downloads Shop Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.5.5
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Shop Columns
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[edd-archive-grids]',
					'type'        => 'control',
					'control'     => 'ast-responsive-slider',
					'section'     => 'section-edd-archive',
					'default'     => array(
						'desktop' => 4,
						'tablet'  => 3,
						'mobile'  => 2,
					),
					'priority'    => 10,
					'title'       => __( 'Archive Columns', 'kanga' ),
					'input_attrs' => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 6,
					),
				),

				/**
				 * Option: EDD Archive Post Meta
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]',
					'type'     => 'control',
					'control'  => 'ast-sortable',
					'section'  => 'section-edd-archive',
					'default'  => kanga_get_option( 'edd-archive-product-structure' ),
					'priority' => 30,
					'title'    => __( 'Product Structure', 'kanga' ),
					'choices'  => array(
						'image'      => __( 'Image', 'kanga' ),
						'category'   => __( 'Category', 'kanga' ),
						'title'      => __( 'Title', 'kanga' ),
						'price'      => __( 'Price', 'kanga' ),
						'short_desc' => __( 'Short Description', 'kanga' ),
						'add_cart'   => __( 'Add To Cart', 'kanga' ),
					),
				),

				/**
				 * Option: Add to Cart button text
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-archive-add-to-cart-button-text]',
					'type'     => 'control',
					'control'  => 'text',
					'section'  => 'section-edd-archive',
					'default'  => kanga_get_option( 'edd-archive-add-to-cart-button-text' ),
					'required' => array( ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]', 'contains', 'add_cart' ),
					'priority' => 31,
					'title'    => __( 'Cart Button Text', 'kanga' ),
				),

				/**
				 * Option: Variable product button
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-archive-variable-button]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-edd-archive',
					'default'  => kanga_get_option( 'edd-archive-variable-button' ),
					'required' => array( ASTRA_THEME_SETTINGS . '[edd-archive-product-structure]', 'contains', 'add_cart' ),
					'priority' => 31,
					'title'    => __( 'Variable Product Button', 'kanga' ),
					'choices'  => array(
						'button'  => __( 'Button', 'kanga' ),
						'options' => __( 'Options', 'kanga' ),
					),
				),

				/**
				 * Option: Variable product button text
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-archive-variable-button-text]',
					'type'     => 'control',
					'control'  => 'text',
					'section'  => 'section-edd-archive',
					'default'  => kanga_get_option( 'edd-archive-variable-button-text' ),
					'required' => array( ASTRA_THEME_SETTINGS . '[edd-archive-variable-button]', '==', 'button' ),
					'priority' => 31,
					'title'    => __( 'Variable Product Button Text', 'kanga' ),
				),

				/**
				 * Option: Easy Digital Downloads Shop Archive Content Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-archive-width-divider]',
					'type'     => 'control',
					'control'  => 'ast-divider',
					'section'  => 'section-edd-archive',
					'priority' => 220,
					'settings' => array(),
				),

				/**
				 * Option: Archive Content Width
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[edd-archive-width]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-edd-archive',
					'default'  => kanga_get_option( 'edd-archive-width' ),
					'priority' => 220,
					'title'    => __( 'Archive Content Width', 'kanga' ),
					'choices'  => array(
						'default' => __( 'Default', 'kanga' ),
						'custom'  => __( 'Custom', 'kanga' ),
					),
				),

				/**
				 * Option: Enter Width
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[edd-archive-max-width]',
					'type'        => 'control',
					'control'     => 'ast-slider',
					'section'     => 'section-edd-archive',
					'default'     => 1200,
					'priority'    => 225,
					'required'    => array( ASTRA_THEME_SETTINGS . '[edd-archive-width]', '===', 'custom' ),
					'title'       => __( 'Custom Width', 'kanga' ),
					'transport'   => 'postMessage',
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}

new Kanga_Edd_Archive_Layout_Configs();

