<?php
/**
 * Template for Single post
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.0.0
 */

?>

<div <?php kanga_blog_layout_class( 'single-layout-1' ); ?>>

	<?php kanga_single_header_before(); ?>

	<header class="entry-header <?php kanga_entry_header_class(); ?>">

		<?php kanga_single_header_top(); ?>

		<?php kanga_blog_post_thumbnail_and_title_order(); ?>

		<?php kanga_single_header_bottom(); ?>

	</header><!-- .entry-header -->

	<?php kanga_single_header_after(); ?>

	<div class="entry-content clear" 
	<?php
				echo kanga_attr(
					'article-entry-content-single-layout',
					array(
						'class' => '',
					)
				);
				?>
	>

		<?php kanga_entry_content_before(); ?>

		<?php the_content(); ?>

		<?php
			kanga_edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'kanga' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>

		<?php kanga_entry_content_after(); ?>

		<?php
			wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . esc_html( kanga_default_strings( 'string-single-page-links-before', false ) ),
					'after'       => '</div>',
					'link_before' => '<span class="page-link">',
					'link_after'  => '</span>',
				)
			);
			?>
	</div><!-- .entry-content .clear -->
</div>
