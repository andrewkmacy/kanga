<?php
/**
 * Breadcrumbs Options for Kanga theme.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Kanga 1.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Breadcrumbs_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Breadcrumbs_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga-Breadcrumbs Settings.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.7.0
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$breadcrumb_source_list = apply_filters(
				'kanga_breadcrumb_source_list',
				array(
					'default' => __( 'Default', 'kanga' ),
				),
				'breadcrumb-list'
			);

			$_configs = array(

				/*
				 * Breadcrumb
				 */
				array(
					'name'               => 'section-breadcrumb',
					'type'               => 'section',
					'priority'           => 20,
					'title'              => __( 'Breadcrumb', 'kanga' ),
					'description_hidden' => true,
					'description'        => $this->section_get_description(
						array(
							'description' => '<p><b>' . __( 'Helpful Information', 'kanga' ) . '</b></p>',
							'links'       => array(
								array(
									'text'  => __( 'Breadcrumb Overview', 'kanga' ) . ' &#187;',
									'attrs' => array(
										'href' => kanga_get_pro_url( 'https://wpkanga.com/docs/add-breadcrumbs-with-kanga/', 'customizer', 'sidebar', 'helpful-information' ),
									),
								),
							),
						)
					),
				),

				/**
				 * Option: Breadcrumb Position
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[breadcrumb-position]',
					'default'  => 'none',
					'section'  => 'section-breadcrumb',
					'title'    => __( 'Position', 'kanga' ),
					'type'     => 'control',
					'control'  => 'select',
					'priority' => 5,
					'choices'  => array(
						'none'                      => __( 'None', 'kanga' ),
						'kanga_masthead_content'    => __( 'Inside Header', 'kanga' ),
						'kanga_header_markup_after' => __( 'After Header', 'kanga' ),
						'kanga_entry_top'           => __( 'Before Title', 'kanga' ),
					),
					'partial'  => array(
						'selector'            => '.ast-breadcrumbs-wrapper .ast-breadcrumbs .trail-items',
						'container_inclusive' => false,
					),
				),

				/**
				 * Option: Breadcrumb Source
				 */
				array(
					'name'            => KANGA_THEME_SETTINGS . '[select-breadcrumb-source]',
					'default'         => 'default',
					'section'         => 'section-breadcrumb',
					'required'        => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'title'           => __( 'Breadcrumb Source', 'kanga' ),
					'type'            => 'control',
					'control'         => 'select',
					'priority'        => 10,
					'choices'         => $breadcrumb_source_list,
					'active_callback' => array( $this, 'is_third_party_breadcrumb_active' ),
				),

				/**
				 * Option: Breadcrumb Separator
				 */
				array(
					'name'            => KANGA_THEME_SETTINGS . '[breadcrumb-separator]',
					'type'            => 'control',
					'control'         => 'text',
					'section'         => 'section-breadcrumb',
					'default'         => kanga_get_option( 'breadcrumb-separator' ) ? kanga_get_option( 'breadcrumb-separator' ) : '\00bb',
					'required'        => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'priority'        => 15,
					'title'           => __( 'Separator', 'kanga' ),
					'active_callback' => array( $this, 'is_selected_breadcrumb_active' ),
				),

				/**
				 * Option: Disable Breadcrumb on Categories
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[breadcrumb-disable-home-page]',
					'default'  => kanga_get_option( 'breadcrumb-disable-home-page' ),
					'type'     => 'control',
					'section'  => 'section-breadcrumb',
					'required' => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'title'    => __( 'Disable on Home Page?', 'kanga' ),
					'priority' => 25,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Disable Breadcrumb on Categories
				 */
				array(
					'name'        => KANGA_THEME_SETTINGS . '[breadcrumb-disable-blog-posts-page]',
					'default'     => kanga_get_option( 'breadcrumb-disable-blog-posts-page' ),
					'type'        => 'control',
					'section'     => 'section-breadcrumb',
					'description' => __( 'Latest posts page or when any page is selected as blog page', 'kanga' ),
					'required'    => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'title'       => __( 'Disable on Blog / Posts Page?', 'kanga' ),
					'priority'    => 25,
					'control'     => 'checkbox',
				),

				/**
				 * Option: Disable Breadcrumb on Search
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[breadcrumb-disable-search]',
					'default'  => kanga_get_option( 'breadcrumb-disable-search' ),
					'type'     => 'control',
					'section'  => 'section-breadcrumb',
					'required' => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'title'    => __( 'Disable on Search?', 'kanga' ),
					'priority' => 30,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Disable Breadcrumb on Archive
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[breadcrumb-disable-archive]',
					'default'  => kanga_get_option( 'breadcrumb-disable-archive' ),
					'type'     => 'control',
					'section'  => 'section-breadcrumb',
					'required' => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'title'    => __( 'Disable on Archive?', 'kanga' ),
					'priority' => 35,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Disable Breadcrumb on Single Page
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[breadcrumb-disable-single-page]',
					'default'  => kanga_get_option( 'breadcrumb-disable-single-page' ),
					'type'     => 'control',
					'section'  => 'section-breadcrumb',
					'required' => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'title'    => __( 'Disable on Single Page?', 'kanga' ),
					'priority' => 40,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Disable Breadcrumb on Single Post
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[breadcrumb-disable-single-post]',
					'default'  => kanga_get_option( 'breadcrumb-disable-single-post' ),
					'type'     => 'control',
					'section'  => 'section-breadcrumb',
					'required' => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'title'    => __( 'Disable on Single Post?', 'kanga' ),
					'priority' => 45,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Disable Breadcrumb on Singular
				 */
				array(
					'name'        => KANGA_THEME_SETTINGS . '[breadcrumb-disable-singular]',
					'default'     => kanga_get_option( 'breadcrumb-disable-singular' ),
					'type'        => 'control',
					'section'     => 'section-breadcrumb',
					'description' => __( 'All Pages, All Posts, All Attachments', 'kanga' ),
					'required'    => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'title'       => __( 'Disable on Singular?', 'kanga' ),
					'priority'    => 50,
					'control'     => 'checkbox',
				),

				/**
				 * Option: Disable Breadcrumb on 404 Page
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[breadcrumb-disable-404-page]',
					'default'  => kanga_get_option( 'breadcrumb-disable-404-page' ),
					'type'     => 'control',
					'section'  => 'section-breadcrumb',
					'required' => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'title'    => __( 'Disable on 404 Page?', 'kanga' ),
					'priority' => 55,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Breadcrumb Alignment
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[breadcrumb-alignment]',
					'default'   => 'left',
					'section'   => 'section-breadcrumb',
					'transport' => 'postMessage',
					'required'  => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'title'     => __( 'Alignment', 'kanga' ),
					'type'      => 'control',
					'control'   => 'select',
					'priority'  => 65,
					'choices'   => array(
						'left'   => __( 'Left', 'kanga' ),
						'center' => __( 'Center', 'kanga' ),
						'right'  => __( 'Right', 'kanga' ),
					),
				),

				/**
				 * Option: Breadcrumb Spacing
				 */
				array(
					'name'           => KANGA_THEME_SETTINGS . '[breadcrumb-spacing]',
					'default'        => kanga_get_option( 'breadcrumb-spacing' ),
					'type'           => 'control',
					'transport'      => 'postMessage',
					'control'        => 'ast-responsive-spacing',
					'priority'       => 70,
					'title'          => __( 'Spacing', 'kanga' ),
					'linked_choices' => true,
					'unit_choices'   => array( 'px', 'em', '%' ),
					'choices'        => array(
						'top'    => __( 'Top', 'kanga' ),
						'right'  => __( 'Right', 'kanga' ),
						'bottom' => __( 'Bottom', 'kanga' ),
						'left'   => __( 'Left', 'kanga' ),
					),
					'required'       => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'section'        => 'section-breadcrumb',
				),
			);

			return array_merge( $configurations, $_configs );

		}

		/**
		 * Is third-party breadcrumb active.
		 * Decide if the Source option should be visible depending on third party plugins.
		 *
		 * @return boolean  True - If the option should be displayed, False - If the option should be hidden.
		 */
		public function is_third_party_breadcrumb_active() {

			// Check if breadcrumb is turned on from WPSEO option.
			$breadcrumb_enable = is_callable( 'WPSEO_Options::get' ) ? WPSEO_Options::get( 'breadcrumbs-enable' ) : false;
			$wpseo_option      = get_option( 'wpseo_internallinks' ) ? get_option( 'wpseo_internallinks' ) : $breadcrumb_enable;
			if ( ! is_array( $wpseo_option ) ) {
				unset( $wpseo_option );
				$wpseo_option = array(
					'breadcrumbs-enable' => $breadcrumb_enable,
				);
			}

			if ( function_exists( 'yoast_breadcrumb' ) && true === $wpseo_option['breadcrumbs-enable'] ) {
				// Check if breadcrumb is turned on from SEO Yoast plugin.
				return true;
			} elseif ( function_exists( 'bcn_display' ) ) {
				// Check if breadcrumb is turned on from Breadcrumb NavXT plugin.
				return true;
			} elseif ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
				// Check if breadcrumb is turned on from Rank Math plugin.
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Is selected third-party breadcrumb active.
		 * Decide if the Separator option should be visible depending on third party plugins.
		 *
		 * @return boolean  True - If the option should be displayed, False - If the option should be hidden.
		 */
		public function is_selected_breadcrumb_active() {

			// Check if breadcrumb is turned on from WPSEO option.
			$selected_breadcrumb_source = kanga_get_option( 'select-breadcrumb-source' );
			$breadcrumb_enable          = is_callable( 'WPSEO_Options::get' ) ? WPSEO_Options::get( 'breadcrumbs-enable' ) : false;
			$wpseo_option               = get_option( 'wpseo_internallinks' ) ? get_option( 'wpseo_internallinks' ) : $breadcrumb_enable;
			if ( ! is_array( $wpseo_option ) ) {

				unset( $wpseo_option );
				$wpseo_option = array(
					'breadcrumbs-enable' => $breadcrumb_enable,
				);
			}

			if ( function_exists( 'yoast_breadcrumb' ) && true === $wpseo_option['breadcrumbs-enable'] && 'yoast-seo-breadcrumbs' === $selected_breadcrumb_source ) {
				// Check if breadcrumb is turned on from SEO Yoast plugin.
				return false;
			} elseif ( function_exists( 'bcn_display' ) && 'breadcrumb-navxt' === $selected_breadcrumb_source ) {
				// Check if breadcrumb is turned on from Breadcrumb NavXT plugin.
				return false;
			} elseif ( function_exists( 'rank_math_the_breadcrumbs' ) && 'rank-math' === $selected_breadcrumb_source ) {
				// Check if breadcrumb is turned on from Rank Math plugin.
				return false;
			} else {
				return true;
			}
		}
	}
}

new Kanga_Breadcrumbs_Configs();
