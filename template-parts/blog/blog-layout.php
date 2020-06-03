<?php
/**
 * Template for Blog
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.0.0
 */

?>
<div <?php kanga_blog_layout_class( 'blog-layout-1' ); ?>>

	<div class="post-content ast-col-md-12">

		<?php kanga_blog_post_thumbnail_and_title_order(); ?>

		<div class="entry-content clear"
			<?php
				echo kanga_attr(
					'article-entry-content-blog-layout',
					array(
						'class' => '',
					)
				);
				?>
		>

			<?php kanga_entry_content_before(); ?>

			<?php kanga_the_excerpt(); ?>

			<?php kanga_entry_content_after(); ?>

			<?php
				wp_link_pages(
					array(
						'before'      => '<div class="page-links">' . esc_html( kanga_default_strings( 'string-blog-page-links-before', false ) ),
						'after'       => '</div>',
						'link_before' => '<span class="page-link">',
						'link_after'  => '</span>',
					)
				);
				?>
		</div><!-- .entry-content .clear -->
	</div><!-- .post-content -->

</div> <!-- .blog-layout-1 -->
