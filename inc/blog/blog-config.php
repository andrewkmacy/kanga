<?php
/**
 * Blog Config File
 * Common Functions for Blog and Single Blog
 *
 * @package Kanga
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Common Functions for Blog and Single Blog
 *
 * @return  post meta
 */
if ( ! function_exists( 'kanga_get_post_meta' ) ) {

	/**
	 * Post meta
	 *
	 * @param  string $post_meta Post meta.
	 * @param  string $separator Separator.
	 * @return string            post meta markup.
	 */
	function kanga_get_post_meta( $post_meta, $separator = '/' ) {

		$output_str = '';
		$loop_count = 1;

		$separator = apply_filters( 'kanga_post_meta_separator', $separator );

		foreach ( $post_meta as $meta_value ) {

			switch ( $meta_value ) {

				case 'author':
					$author = get_the_author();
					if ( ! empty( $author ) ) {
						$output_str .= ( 1 != $loop_count && '' != $output_str ) ? ' ' . $separator . ' ' : '';
						$output_str .= esc_html( kanga_default_strings( 'string-blog-meta-author-by', false ) ) . kanga_post_author();
					}
					break;

				case 'date':
					$output_str .= ( 1 != $loop_count && '' != $output_str ) ? ' ' . $separator . ' ' : '';
					$output_str .= kanga_post_date();
					break;

				case 'category':
					$category = kanga_post_categories();
					if ( '' != $category ) {
						$output_str .= ( 1 != $loop_count && '' != $output_str ) ? ' ' . $separator . ' ' : '';
						$output_str .= $category;
					}
					break;

				case 'tag':
					$tags = kanga_post_tags();
					if ( '' != $tags ) {
						$output_str .= ( 1 != $loop_count && '' != $output_str ) ? ' ' . $separator . ' ' : '';
						$output_str .= $tags;
					}
					break;

				case 'comments':
					$comment = kanga_post_comments();
					if ( '' != $comment ) {
						$output_str .= ( 1 != $loop_count && '' != $output_str ) ? ' ' . $separator . ' ' : '';
						$output_str .= $comment;
					}
					break;
				default:
					$output_str = apply_filters( 'kanga_meta_case_' . $meta_value, $output_str, $loop_count, $separator );

			}

			$loop_count ++;
		}

		return $output_str;
	}
}

/**
 * Function to get Date of Post
 *
 * @since 1.0.0
 * @return html
 */
if ( ! function_exists( 'kanga_post_date' ) ) {

	/**
	 * Function to get Date of Post
	 *
	 * @return html                Markup.
	 */
	function kanga_post_date() {

		$output        = '';
		$format        = apply_filters( 'kanga_post_date_format', '' );
		$time_string   = esc_html( get_the_date( $format ) );
		$modified_date = esc_html( get_the_modified_date( $format ) );
		$posted_on     = sprintf(
			esc_html( '%s' ),
			$time_string
		);
		$modified_on   = sprintf(
			esc_html( '%s' ),
			$modified_date
		);
		$output       .= '<span class="posted-on">';
		$output       .= '<span class="published" itemprop="datePublished"> ' . $posted_on . '</span>';
		$output       .= '<span class="updated" itemprop="dateModified"> ' . $modified_on . '</span>';
		$output       .= '</span>';
		return apply_filters( 'kanga_post_date', $output );
	}
}

/**
 * Function to get Author of Post
 *
 * @since 1.0.0
 * @return html
 */
if ( ! function_exists( 'kanga_post_author' ) ) {

	/**
	 * Function to get Author of Post
	 *
	 * @param  string $output_filter Filter string.
	 * @return html                Markup.
	 */
	function kanga_post_author( $output_filter = '' ) {

		ob_start();

		echo '<span ';
			echo kanga_attr(
				'post-meta-author',
				array(
					'class' => 'posted-by vcard author',
				)
			);
		echo '>';
			// Translators: Author Name. ?>
			<a title="<?php printf( esc_attr__( 'View all posts by %1$s', 'kanga' ), get_the_author() ); ?>" 
				href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"
				<?php
					echo kanga_attr(
						'author-url',
						array(
							'class' => 'url fn n',
						)
					);
				?>
				>
				<span
				<?php
					echo kanga_attr(
						'author-name',
						array(
							'class' => 'author-name',
						)
					);
				?>
				><?php echo get_the_author(); ?></span>
			</a>
		</span>

		<?php

		$output = ob_get_clean();

		return apply_filters( 'kanga_post_author', $output, $output_filter );
	}
}

/**
 * Function to get Read More Link of Post
 *
 * @since 1.0.0
 * @return html
 */
if ( ! function_exists( 'kanga_post_link' ) ) {

	/**
	 * Function to get Read More Link of Post
	 *
	 * @param  string $output_filter Filter string.
	 * @return html                Markup.
	 */
	function kanga_post_link( $output_filter = '' ) {

		$enabled = apply_filters( 'kanga_post_link_enabled', '__return_true' );
		if ( ( is_admin() && ! wp_doing_ajax() ) || ! $enabled ) {
			return $output_filter;
		}

		$read_more_text    = apply_filters( 'kanga_post_read_more', __( 'Read More &raquo;', 'kanga' ) );
		$read_more_classes = apply_filters( 'kanga_post_read_more_class', array() );

		$post_link = sprintf(
			esc_html( '%s' ),
			'<a class="' . esc_attr( implode( ' ', $read_more_classes ) ) . '" href="' . esc_url( get_permalink() ) . '"> ' . the_title( '<span class="screen-reader-text">', '</span>', false ) . ' ' . $read_more_text . '</a>'
		);

		$output = ' &hellip;<p class="read-more"> ' . $post_link . '</p>';

		return apply_filters( 'kanga_post_link', $output, $output_filter );
	}
}
add_filter( 'excerpt_more', 'kanga_post_link', 1 );

/**
 * Function to get Number of Comments of Post
 *
 * @since 1.0.0
 * @return html
 */
if ( ! function_exists( 'kanga_post_comments' ) ) {

	/**
	 * Function to get Number of Comments of Post
	 *
	 * @param  string $output_filter Output filter.
	 * @return html                Markup.
	 */
	function kanga_post_comments( $output_filter = '' ) {

		$output = '';

		ob_start();
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			?>
			<span class="comments-link">
				<?php
				/**
				 * Get Comment Link
				 *
				 * @see kanga_default_strings()
				 */
				comments_popup_link( kanga_default_strings( 'string-blog-meta-leave-a-comment', false ), kanga_default_strings( 'string-blog-meta-one-comment', false ), kanga_default_strings( 'string-blog-meta-multiple-comment', false ) );
				?>
			</span>

			<?php
		}

		$output = ob_get_clean();

		return apply_filters( 'kanga_post_comments', $output, $output_filter );
	}
}

/**
 * Function to get Tags applied of Post
 *
 * @since 1.0.0
 * @return html
 */
if ( ! function_exists( 'kanga_post_tags' ) ) {

	/**
	 * Function to get Tags applied of Post
	 *
	 * @param  string $output_filter Output filter.
	 * @return html                Markup.
	 */
	function kanga_post_tags( $output_filter = '' ) {

		$output = '';

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'kanga' ) );

		if ( $tags_list ) {
			$output .= '<span class="tags-links">' . $tags_list . '</span>';
		}

		return apply_filters( 'kanga_post_tags', $output, $output_filter );
	}
}

/**
 * Function to get Categories of Post
 *
 * @since 1.0.0
 * @return html
 */
if ( ! function_exists( 'kanga_post_categories' ) ) {

	/**
	 * Function to get Categories applied of Post
	 *
	 * @param  string $output_filter Output filter.
	 * @return html                Markup.
	 */
	function kanga_post_categories( $output_filter = '' ) {

		$output = '';

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'kanga' ) );

		if ( $categories_list ) {
			$output .= '<span class="cat-links">' . $categories_list . '</span>';
		}

		return apply_filters( 'kanga_post_categories', $output, $output_filter );
	}
}

/**
 * Display classes for primary div
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'kanga_blog_layout_class' ) ) {

	/**
	 * Layout class
	 *
	 * @param  string $class Class.
	 */
	function kanga_blog_layout_class( $class = '' ) {

		// Separates classes with a single space, collates classes for body element.
		echo 'class="' . esc_attr( join( ' ', kanga_get_blog_layout_class( $class ) ) ) . '"';
	}
}

/**
 * Retrieve the classes for the body element as an array.
 *
 * @since 1.0.0
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
if ( ! function_exists( 'kanga_get_blog_layout_class' ) ) {

	/**
	 * Retrieve the classes for the body element as an array.
	 *
	 * @param string $class Class.
	 */
	function kanga_get_blog_layout_class( $class = '' ) {

		// array of class names.
		$classes = array();

		$post_format = get_post_format();
		if ( $post_format ) {
			$post_format = 'standard';
		}

		$classes[] = 'ast-post-format-' . $post_format;

		if ( ! has_post_thumbnail() || ! wp_get_attachment_image_src( get_post_thumbnail_id() ) ) {
			switch ( $post_format ) {

				case 'aside':
								$classes[] = 'ast-no-thumb';
					break;

				case 'image':
								$has_image = kanga_get_first_image_from_post();
					if ( empty( $has_image ) || is_single() ) {
						$classes[] = 'ast-no-thumb';
					}
					break;

				case 'video':
								$post_featured_data = kanga_get_video_from_post( get_the_ID() );
					if ( empty( $post_featured_data ) ) {
						$classes[] = 'ast-no-thumb';
					}
					break;

				case 'quote':
								$classes[] = 'ast-no-thumb';
					break;

				case 'link':
								$classes[] = 'ast-no-thumb';
					break;

				case 'gallery':
								$post_featured_data = get_post_gallery();
					if ( empty( $post_featured_data ) || is_single() ) {
						$classes[] = 'ast-no-thumb';
					}
					break;

				case 'audio':
								$has_audio = kanga_get_audios_from_post( get_the_ID() );
					if ( empty( $has_audio ) || is_single() ) {
						$classes[] = 'ast-no-thumb';
					} else {
						$classes[] = 'ast-embeded-audio';
					}
					break;

				case 'standard':
				default:
					if ( ! has_post_thumbnail() || ! wp_get_attachment_image_src( get_post_thumbnail_id() ) ) {
						$classes[] = 'ast-no-thumb';
					}
					break;
			}
		}

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		/**
		 * Filter primary div class names
		 */
		$classes = apply_filters( 'kanga_blog_layout_class', $classes, $class );

		$classes = array_map( 'sanitize_html_class', $classes );

		return array_unique( $classes );
	}
}

/**
 * Function to get Content Read More Link of Post
 *
 * @since 1.2.7
 * @return html
 */
if ( ! function_exists( 'kanga_the_content_more_link' ) ) {

	/**
	 * Filters the Read More link text.
	 *
	 * @param  string $more_link_element Read More link element.
	 * @param  string $more_link_text Read More text.
	 * @return html                Markup.
	 */
	function kanga_the_content_more_link( $more_link_element = '', $more_link_text = '' ) {

		$enabled = apply_filters( 'kanga_the_content_more_link_enabled', '__return_true' );
		if ( ( is_admin() && ! wp_doing_ajax() ) || ! $enabled ) {
			return $more_link_element;
		}

		$more_link_text    = apply_filters( 'kanga_the_content_more_string', __( 'Read More &raquo;', 'kanga' ) );
		$read_more_classes = apply_filters( 'kanga_the_content_more_link_class', array() );

		$post_link = sprintf(
			esc_html( '%s' ),
			'<a class="' . esc_attr( implode( ' ', $read_more_classes ) ) . '" href="' . esc_url( get_permalink() ) . '"> ' . the_title( '<span class="screen-reader-text">', '</span>', false ) . $more_link_text . '</a>'
		);

		$more_link_element = ' &hellip;<p class="ast-the-content-more-link"> ' . $post_link . '</p>';

		return apply_filters( 'kanga_the_content_more_link', $more_link_element, $more_link_text );
	}
}
add_filter( 'the_content_more_link', 'kanga_the_content_more_link', 10, 2 );
