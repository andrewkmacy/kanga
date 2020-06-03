<?php
/**
 * Theme Hook Alliance hook stub list.
 *
 * @see  https://github.com/zamoose/themehookalliance
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
 * Themes and Plugins can check for kanga_hooks using current_theme_supports( 'kanga_hooks', $hook )
 * to determine whether a theme declares itself to support this specific hook type.
 *
 * Example:
 * <code>
 *      // Declare support for all hook types
 *      add_theme_support( 'kanga_hooks', array( 'all' ) );
 *
 *      // Declare support for certain hook types only
 *      add_theme_support( 'kanga_hooks', array( 'header', 'content', 'footer' ) );
 * </code>
 */
add_theme_support(
	'kanga_hooks',
	array(

		/**
		 * As a Theme developer, use the 'all' parameter, to declare support for all
		 * hook types.
		 * Please make sure you then actually reference all the hooks in this file,
		 * Plugin developers depend on it!
		 */
		'all',

		/**
		 * Themes can also choose to only support certain hook types.
		 * Please make sure you then actually reference all the hooks in this type
		 * family.
		 *
		 * When the 'all' parameter was set, specific hook types do not need to be
		 * added explicitly.
		 */
		'html',
		'body',
		'head',
		'header',
		'content',
		'entry',
		'comments',
		'sidebars',
		'sidebar',
		'footer',

	/**
	 * If/when WordPress Core implements similar methodology, Themes and Plugins
	 * will be able to check whether the version of THA supplied by the theme
	 * supports Core hooks.
	 */
	)
);

/**
 * Determines, whether the specific hook type is actually supported.
 *
 * Plugin developers should always check for the support of a <strong>specific</strong>
 * hook type before hooking a callback function to a hook of this type.
 *
 * Example:
 * <code>
 *      if ( current_theme_supports( 'kanga_hooks', 'header' ) )
 *          add_action( 'kanga_head_top', 'prefix_header_top' );
 * </code>
 *
 * @param bool  $bool true.
 * @param array $args The hook type being checked.
 * @param array $registered All registered hook types.
 *
 * @return bool
 */
function kanga_current_theme_supports( $bool, $args, $registered ) {
	return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
}
add_filter( 'current_theme_supports-kanga_hooks', 'kanga_current_theme_supports', 10, 3 );

/**
 * HTML <html> hook
 * Special case, useful for <DOCTYPE>, etc.
 * $kanga_supports[] = 'html;
 */
function kanga_html_before() {
	do_action( 'kanga_html_before' );
}
/**
 * HTML <body> hooks
 * $kanga_supports[] = 'body';
 */
function kanga_body_top() {
	do_action( 'kanga_body_top' );
}

/**
 * Body Bottom
 */
function kanga_body_bottom() {
	do_action( 'kanga_body_bottom' );
}

/**
 * HTML <head> hooks
 *
 * $kanga_supports[] = 'head';
 */
function kanga_head_top() {
	do_action( 'kanga_head_top' );
}

/**
 * Head Bottom
 */
function kanga_head_bottom() {
	do_action( 'kanga_head_bottom' );
}

/**
 * Semantic <header> hooks
 *
 * $kanga_supports[] = 'header';
 */
function kanga_header_before() {
	do_action( 'kanga_header_before' );
}

/**
 * Site Header
 */
function kanga_header() {
	do_action( 'kanga_header' );
}

/**
 * Masthead Top
 */
function kanga_masthead_top() {
	do_action( 'kanga_masthead_top' );
}

/**
 * Masthead
 */
function kanga_masthead() {
	do_action( 'kanga_masthead' );
}

/**
 * Masthead Bottom
 */
function kanga_masthead_bottom() {
	do_action( 'kanga_masthead_bottom' );
}

/**
 * Header After
 */
function kanga_header_after() {
	do_action( 'kanga_header_after' );
}

/**
 * Main Header bar top
 */
function kanga_main_header_bar_top() {
	do_action( 'kanga_main_header_bar_top' );
}

/**
 * Main Header bar bottom
 */
function kanga_main_header_bar_bottom() {
	do_action( 'kanga_main_header_bar_bottom' );
}

/**
 * Main Header Content
 */
function kanga_masthead_content() {
	do_action( 'kanga_masthead_content' );
}
/**
 * Main toggle button before
 */
function kanga_masthead_toggle_buttons_before() {
	do_action( 'kanga_masthead_toggle_buttons_before' );
}

/**
 * Main toggle buttons
 */
function kanga_masthead_toggle_buttons() {
	do_action( 'kanga_masthead_toggle_buttons' );
}

/**
 * Main toggle button after
 */
function kanga_masthead_toggle_buttons_after() {
	do_action( 'kanga_masthead_toggle_buttons_after' );
}

/**
 * Semantic <content> hooks
 *
 * $kanga_supports[] = 'content';
 */
function kanga_content_before() {
	do_action( 'kanga_content_before' );
}

/**
 * Content after
 */
function kanga_content_after() {
	do_action( 'kanga_content_after' );
}

/**
 * Content top
 */
function kanga_content_top() {
	do_action( 'kanga_content_top' );
}

/**
 * Content bottom
 */
function kanga_content_bottom() {
	do_action( 'kanga_content_bottom' );
}

/**
 * Content while before
 */
function kanga_content_while_before() {
	do_action( 'kanga_content_while_before' );
}

/**
 * Content loop
 */
function kanga_content_loop() {
	do_action( 'kanga_content_loop' );
}

/**
 * Conten Page Loop.
 *
 * Called from page.php
 */
function kanga_content_page_loop() {
	do_action( 'kanga_content_page_loop' );
}

/**
 * Content while after
 */
function kanga_content_while_after() {
	do_action( 'kanga_content_while_after' );
}

/**
 * Semantic <entry> hooks
 *
 * $kanga_supports[] = 'entry';
 */
function kanga_entry_before() {
	do_action( 'kanga_entry_before' );
}

/**
 * Entry after
 */
function kanga_entry_after() {
	do_action( 'kanga_entry_after' );
}

/**
 * Entry content before
 */
function kanga_entry_content_before() {
	do_action( 'kanga_entry_content_before' );
}

/**
 * Entry content after
 */
function kanga_entry_content_after() {
	do_action( 'kanga_entry_content_after' );
}

/**
 * Entry Top
 */
function kanga_entry_top() {
	do_action( 'kanga_entry_top' );
}

/**
 * Entry bottom
 */
function kanga_entry_bottom() {
	do_action( 'kanga_entry_bottom' );
}

/**
 * Single Post Header Before
 */
function kanga_single_header_before() {
	do_action( 'kanga_single_header_before' );
}

/**
 * Single Post Header After
 */
function kanga_single_header_after() {
	do_action( 'kanga_single_header_after' );
}

/**
 * Single Post Header Top
 */
function kanga_single_header_top() {
	do_action( 'kanga_single_header_top' );
}

/**
 * Single Post Header Bottom
 */
function kanga_single_header_bottom() {
	do_action( 'kanga_single_header_bottom' );
}

/**
 * Comments block hooks
 *
 * $kanga_supports[] = 'comments';
 */
function kanga_comments_before() {
	do_action( 'kanga_comments_before' );
}

/**
 * Comments after.
 */
function kanga_comments_after() {
	do_action( 'kanga_comments_after' );
}

/**
 * Semantic <sidebar> hooks
 *
 * $kanga_supports[] = 'sidebar';
 */
function kanga_sidebars_before() {
	do_action( 'kanga_sidebars_before' );
}

/**
 * Sidebars after
 */
function kanga_sidebars_after() {
	do_action( 'kanga_sidebars_after' );
}

/**
 * Semantic <footer> hooks
 *
 * $kanga_supports[] = 'footer';
 */
function kanga_footer() {
	do_action( 'kanga_footer' );
}

/**
 * Footer before
 */
function kanga_footer_before() {
	do_action( 'kanga_footer_before' );
}

/**
 * Footer after
 */
function kanga_footer_after() {
	do_action( 'kanga_footer_after' );
}

/**
 * Footer top
 */
function kanga_footer_content_top() {
	do_action( 'kanga_footer_content_top' );
}

/**
 * Footer
 */
function kanga_footer_content() {
	do_action( 'kanga_footer_content' );
}

/**
 * Footer bottom
 */
function kanga_footer_content_bottom() {
	do_action( 'kanga_footer_content_bottom' );
}

/**
 * Archive header
 */
function kanga_archive_header() {
	do_action( 'kanga_archive_header' );
}

/**
 * Pagination
 */
function kanga_pagination() {
	do_action( 'kanga_pagination' );
}

/**
 * Entry content single
 */
function kanga_entry_content_single() {
	do_action( 'kanga_entry_content_single' );
}

/**
 * 404
 */
function kanga_entry_content_404_page() {
	do_action( 'kanga_entry_content_404_page' );
}

/**
 * Entry content blog
 */
function kanga_entry_content_blog() {
	do_action( 'kanga_entry_content_blog' );
}

/**
 * Blog featured post section
 */
function kanga_blog_post_featured_format() {
	do_action( 'kanga_blog_post_featured_format' );
}

/**
 * Primary Content Top
 */
function kanga_primary_content_top() {
	do_action( 'kanga_primary_content_top' );
}

/**
 * Primary Content Bottom
 */
function kanga_primary_content_bottom() {
	do_action( 'kanga_primary_content_bottom' );
}

/**
 * 404 Page content template action.
 */
function kanga_404_content_template() {
	do_action( 'kanga_404_content_template' );
}

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Fire the wp_body_open action.
	 * Adds backward compatibility for WordPress versions < 5.2
	 *
	 * @since 1.8.7
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
