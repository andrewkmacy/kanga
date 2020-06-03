<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Kanga
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( kanga_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php kanga_primary_class(); ?>>

		<?php kanga_primary_content_top(); ?>

		<?php kanga_archive_header(); ?>

		<?php kanga_content_loop(); ?>		

		<?php kanga_pagination(); ?>

		<?php kanga_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( kanga_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
