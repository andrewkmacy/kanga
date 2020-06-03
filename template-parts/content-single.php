<?php
/**
 * Template part for displaying single posts.
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
			'article-single',
			array(
				'id'    => 'post-' . get_the_id(),
				'class' => join( ' ', get_post_class() ),
			)
		);
		?>
>

	<?php kanga_entry_top(); ?>

	<?php kanga_entry_content_single(); ?>

	<?php kanga_entry_bottom(); ?>

</article><!-- #post-## -->

<?php kanga_entry_after(); ?>
