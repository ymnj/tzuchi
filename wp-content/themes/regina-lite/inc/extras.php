<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package regina-lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function regina_lite_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}

add_filter( 'body_class', 'regina_lite_body_classes' );

if ( ! function_exists( 'regina_lite_breadcrumbs' ) ) {
	/**
	 * Render the breadcrumbs with help of class-breadcrumbs.php
	 *
	 * @return void
	 */
	function regina_lite_breadcrumbs() {
		$breadcrumbs = new Riba_Breadcrumbs();
		$breadcrumbs->get_breadcrumbs();
	}

	add_action( 'mtl_breadcrumbs', 'regina_lite_breadcrumbs' );
}

if ( ! function_exists( 'regina_lite_get_number_of_comments' ) ) {
	/**
	 * Simple function used to return the number of comments a post has.
	 */
	function regina_lite_get_number_of_comments( $post_id ) {
		$num_comments = get_comments_number( $post_id ); // get_comments_number returns only a numeric value
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = __( 'No Comments', 'regina-lite' );
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . __( ' Comments', 'regina-lite' );
			} else {
				$comments = __( '1 Comment', 'regina-lite' );
			}
			$write_comments = '<a href="' . get_comments_link() . '"><span class="nc-icon-outline ui-2_chat-round"></span>' . $comments . '</a>';
		} else {
			$write_comments = __( 'Comments are off for this post.', 'regina-lite' );
		}

		return $write_comments;
	}
}

if ( ! function_exists( 'regina_lite_content_nav' ) ) {
	/**
	 * Display navigation to next/previous pages when applicable
	 */
	add_action( 'mtl_single_after_content', 'regina_lite_content_nav', 2 );
	function regina_lite_content_nav() {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$nav_class = ( is_single() ) ? 'post-navigation clear' : 'paging-navigation clear';
		?>
		<nav role="navigation" id="post-navigation" class="<?php echo $nav_class; ?>">
			<?php if ( is_single() ) : // navigation links for single posts ?>

				<?php previous_post_link( '%link', '<span class="nc-icon-glyph arrows-1_bold-left"></span> %title' ); ?>
				<?php next_post_link( '%link', '%title <span class="nc-icon-glyph arrows-1_bold-right"></span>' ); ?>

			<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

				<?php if ( get_next_posts_link() ) : ?>
					<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'regina-lite' ) ); ?>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
					<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'regina-lite' ) ); ?>
				<?php endif; ?>

			<?php endif; ?>
			<div class="clear"></div>
		</nav><!-- #post-navigation -->
		<?php
	}
}


/**
 *  Comment
 */
function regina_lite_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			?>
			<li class="post pingback">
			<p><?php _e( 'Pingback:', 'regina-lite' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'regina-lite' ), ' ' ); ?></p>
			<?php
			break;
		default :
			?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

			<div id="comment-<?php comment_ID(); ?>" class="row">
				<div class="col-xs-2">
					<?php echo get_avatar( $comment, 100 ); ?>
				</div><!--.col-xs-1-->
				<div class="col-xs-10">
					<div class="content">
						<p class="name"><?php printf( __( '%s', 'regina-lite' ), sprintf( '%s', get_comment_author_link() ) ); ?></p>
						<p class="meta"><?php printf( __( '%1$s at %2$s', 'regina-lite' ), get_comment_date(), get_comment_time() ); ?></p>
						<?php comment_text(); ?>
						<?php
						if ( $comment->comment_approved == '0' ):
							_e( 'Your comment is awaiting moderation.', 'regina-lite' );
						endif;
						?>
						<?php comment_reply_link( array_merge( $args, array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
						) ) ); ?>
					</div>
				</div>
			</div><!--.row-->

			<?php
			break;
	endswitch;
}

#
#   Get the page ID of the page using the blog template
#
#   We can't rely on the name, maybe they'll name it something other than 'Blog' ?
#
if ( ! function_exists( 'regina_lite_get_page_id_by_template' ) ) {
	function regina_lite_get_page_id_by_template( $page_template = null ) {

		# default args array
		# page template defaults to blog-template.php
		$args = array(
			'post_type'  => 'page',
			'fields'     => 'ids',
			'nopaging'   => true,
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'page-templates/blog-template.php',
		);

		$pages                    = get_posts( $args );
		$pages_which_use_template = '';

		if ( is_array( $pages ) ) {
			foreach ( $pages as $page ) {
				$pages_which_use_template[] = $page;
			}
		} else if ( ! is_array( $pages ) ) {
			$pages_which_use_template = $pages;
		} else {
			$pages_which_use_template = '';
		}

		return $pages_which_use_template;

	}
}

/**
 *  Upsell
 */
if ( ! function_exists( 'regina_lite_prefix_upsell_notice' ) ) {
	/**
	 * Display upgrade notice on customizer page
	 *
	 * @since Riba Lite 1.0.3
	 */
	function regina_lite_prefix_upsell_notice() {

		// Enqueue the script
		wp_enqueue_script( 'regina-lite-customizer-upsell', get_template_directory_uri() . '/inc/customizer/assets/js/upsell/upsell.js', array(), '1.0.0', true );

		// Localize the script
		wp_localize_script( 'regina-lite-customizer-upsell', 'prefixL10n', array(
			# Upsell URL
			'prefixUpsellURL'   => esc_url( 'https://www.machothemes.com/themes/regina-pro/' ),
			'prefixUpsellLabel' => __( 'View PRO version', 'regina-lite' ),

		) );

	}

	add_action( 'customize_controls_enqueue_scripts', 'regina_lite_prefix_upsell_notice' );
}

#
# Custom Excerpt Length
#
function regina_lite_excerpt_length( $length ) {
	return 25;
}

add_filter( 'excerpt_length', 'regina_lite_excerpt_length', 999 );

#
# Custom Read More
#
function regina_lite_excerpt_more( $more ) {

	$return_string = '<div class="read-more-wrapper">';
	$return_string .= '<a class="link small" href="' . esc_url( get_the_permalink() ) . '" role="button">' . __( 'Read more', 'regina-lite' ) . '<span class="nc-icon-glyph arrows-1_bold-right"></span></a>';
	$return_string .= '</div>';


	return $return_string;

}

add_filter( 'excerpt_more', 'regina_lite_excerpt_more' );

if ( ! function_exists( 'regina_lite_get_attachment_id' ) ) {
	/**
	 * Get an attachment ID given a URL.
	 *
	 * @param string $url
	 *
	 * @return int Attachment ID on success, 0 on failure
	 */
	function regina_lite_get_attachment_id( $url ) {

		$attachment_id = 0;
		$dir           = wp_upload_dir();
		if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
			$file       = basename( $url );
			$query_args = array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'fields'      => 'ids',
				'meta_query'  => array(
					array(
						'value'   => $file,
						'compare' => 'LIKE',
						'key'     => '_wp_attachment_metadata',
					),
				),
			);
			$query      = new WP_Query( $query_args );
			if ( $query->have_posts() ) {
				foreach ( $query->posts as $post_id ) {
					$meta                = wp_get_attachment_metadata( $post_id );
					$original_file       = basename( $meta['file'] );
					$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
					if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
						$attachment_id = $post_id;
						break;
					}
				}
			}
		}

		return $attachment_id;
	}
}