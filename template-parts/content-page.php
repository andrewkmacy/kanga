<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kanga
 * @since 1.0.0
 */

?>

<?php kanga_entry_before(); ?>

<article 
	<?php
		echo kanga_attr(
			'article-page',
			array(
				'id'    => 'post-' . get_the_id(),
				'class' => join( ' ', get_post_class() ),
			)
		);
		?>
>

	<?php kanga_entry_top(); ?>

	<header class="entry-header <?php kanga_entry_header_class(); ?>">

		<?php kanga_get_post_thumbnail(); ?>

		<?php
		kanga_the_title(
			'<h1 class="entry-title" ' . kanga_attr(
				'article-title-content-page',
				array(
					'class' => '',
				)
			) . '>',
			'</h1>'
		);
		?>
	</header><!-- .entry-header -->

	<div class="entry-content clear" 
		<?php
				echo kanga_attr(
					'article-entry-content-page',
					array(
						'class' => '',
					)
				);
				?>
	>

		<?php kanga_entry_content_before(); ?>

		<?php the_content(); ?>

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

	<?php
		kanga_edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'kanga' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer><!-- .entry-footer -->'
		);
		?>

	<?php kanga_entry_bottom(); ?>

</article><!-- #post-## -->

<?php kanga_entry_after(); ?>
