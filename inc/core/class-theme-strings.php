<?php
/**
 * Kanga Theme Strings
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
 * Default Strings
 */
if ( ! function_exists( 'kanga_default_strings' ) ) {

	/**
	 * Default Strings
	 *
	 * @since 1.0.0
	 * @param  string  $key  String key.
	 * @param  boolean $echo Print string.
	 * @return mixed        Return string or nothing.
	 */
	function kanga_default_strings( $key, $echo = true ) {

		$defaults = apply_filters(
			'kanga_default_strings',
			array(

				// Header.
				'string-header-skip-link'                => __( 'Skip to content', 'kanga' ),

				// 404 Page Strings.
				'string-404-sub-title'                   => __( 'It looks like the link pointing here was faulty. Maybe try searching?', 'kanga' ),

				// Search Page Strings.
				'string-search-nothing-found'            => __( 'Nothing Found', 'kanga' ),
				'string-search-nothing-found-message'    => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'kanga' ),
				'string-full-width-search-message'       => __( 'Start typing and press enter to search', 'kanga' ),
				'string-full-width-search-placeholder'   => __( 'Search &hellip;', 'kanga' ),
				'string-header-cover-search-placeholder' => __( 'Search &hellip;', 'kanga' ),
				'string-search-input-placeholder'        => __( 'Search &hellip;', 'kanga' ),

				// Comment Template Strings.
				'string-comment-reply-link'              => __( 'Reply', 'kanga' ),
				'string-comment-edit-link'               => __( 'Edit', 'kanga' ),
				'string-comment-awaiting-moderation'     => __( 'Your comment is awaiting moderation.', 'kanga' ),
				'string-comment-title-reply'             => __( 'Leave a Comment', 'kanga' ),
				'string-comment-cancel-reply-link'       => __( 'Cancel Reply', 'kanga' ),
				'string-comment-label-submit'            => __( 'Post Comment &raquo;', 'kanga' ),
				'string-comment-label-message'           => __( 'Type here..', 'kanga' ),
				'string-comment-label-name'              => __( 'Name*', 'kanga' ),
				'string-comment-label-email'             => __( 'Email*', 'kanga' ),
				'string-comment-label-website'           => __( 'Website', 'kanga' ),
				'string-comment-closed'                  => __( 'Comments are closed.', 'kanga' ),
				'string-comment-navigation-title'        => __( 'Comment navigation', 'kanga' ),
				'string-comment-navigation-next'         => __( 'Newer Comments', 'kanga' ),
				'string-comment-navigation-previous'     => __( 'Older Comments', 'kanga' ),

				// Blog Default Strings.
				'string-blog-page-links-before'          => __( 'Pages:', 'kanga' ),
				'string-blog-meta-author-by'             => __( 'By ', 'kanga' ),
				'string-blog-meta-leave-a-comment'       => __( 'Leave a Comment', 'kanga' ),
				'string-blog-meta-one-comment'           => __( '1 Comment', 'kanga' ),
				'string-blog-meta-multiple-comment'      => __( '% Comments', 'kanga' ),
				'string-blog-navigation-next'            => __( 'Next Page', 'kanga' ) . ' <span class="ast-right-arrow">&rarr;</span>',
				'string-blog-navigation-previous'        => '<span class="ast-left-arrow">&larr;</span> ' . __( 'Previous Page', 'kanga' ),

				// Single Post Default Strings.
				'string-single-page-links-before'        => __( 'Pages:', 'kanga' ),
				/* translators: 1: Post type label */
				'string-single-navigation-next'          => __( 'Next %s', 'kanga' ) . ' <span class="ast-right-arrow">&rarr;</span>',
				/* translators: 1: Post type label */
				'string-single-navigation-previous'      => '<span class="ast-left-arrow">&larr;</span> ' . __( 'Previous %s', 'kanga' ),

				// Content None.
				'string-content-nothing-found-message'   => __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'kanga' ),

			)
		);

		if ( is_rtl() ) {
			$defaults['string-blog-navigation-next']     = __( 'Next Page', 'kanga' ) . ' <span class="ast-left-arrow">&larr;</span>';
			$defaults['string-blog-navigation-previous'] = '<span class="ast-right-arrow">&rarr;</span> ' . __( 'Previous Page', 'kanga' );

			/* translators: 1: Post type label */
			$defaults['string-single-navigation-next'] = __( 'Next %s', 'kanga' ) . ' <span class="ast-left-arrow">&larr;</span>';
			/* translators: 1: Post type label */
			$defaults['string-single-navigation-previous'] = '<span class="ast-right-arrow">&rarr;</span> ' . __( 'Previous %s', 'kanga' );
		}

		$output = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';

		/**
		 * Print or return
		 */
		if ( $echo ) {
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $output;
		}
	}
}
