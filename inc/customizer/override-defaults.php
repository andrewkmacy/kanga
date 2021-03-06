<?php
/**
 * Override default customizer panels, sections, settings or controls.
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

/**
 * Override Sections
 */
$wp_customize->get_section( 'title_tagline' )->priority = 5;

/**
 * Override Settings
 */
$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
$wp_customize->get_setting( 'custom_logo' )->transport      = 'refresh';

/**
 * Override Controls
 */
$wp_customize->get_control( 'custom_logo' )->priority      = 5;
$wp_customize->get_control( 'blogname' )->priority         = 7;
$wp_customize->get_control( 'blogdescription' )->priority  = 10;
$wp_customize->get_control( 'header_textcolor' )->priority = 9;
$wp_customize->get_control( 'site_icon' )->priority        = 6;

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'            => '.main-header-bar .site-title a,  .ast-small-footer-wrap .ast-footer-site-title',
			'container_inclusive' => false,
			'render_callback'     => array( 'Kanga_Customizer_Partials', 'render_partial_site_title' ),
		)
	);
}

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'            => '.main-header-bar .site-description',
			'container_inclusive' => false,
			'render_callback'     => array( 'Kanga_Customizer_Partials', 'render_partial_site_tagline' ),
		)
	);
}



