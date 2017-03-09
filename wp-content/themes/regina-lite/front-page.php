<?php
/**
 *  The template for displaying the Front Page.
 *
 * @package regina-lite
 */
?>
<?php get_header(); ?>
<?php
if ( 'page' == get_option( 'show_on_front' ) ):
	if ( is_page_template( 'page-templates/blog-template.php' ) ):
		get_template_part( 'page-templates/blog', 'template' );
	elseif ( is_page_template( 'page-templates/sidebar-left.php' ) ):
		get_template_part( 'page-templates/sidebar', 'left' );
	elseif ( is_page_template( 'page-templates/sidebar-right.php' ) ):
		get_template_part( 'page-templates/sidebar', 'right' );
	else:
		get_template_part( 'page' );
	endif;
else:
	// Get Theme Mod
	$subheader_features_show   = get_theme_mod( 'regina_lite_subheader_features_show', 1 );
	$ourteam_general_show      = get_theme_mod( 'regina_lite_ourteam_general_show', 1 );
	$testimonials_general_show = get_theme_mod( 'regina_lite_testimonials_general_show', 1 );
	$speak_general_show        = get_theme_mod( 'regina_lite_speak_general_show', 1 );
	$blog_news_general_show    = get_theme_mod( 'regina_lite_news_general_show', 1 );

	get_template_part( 'sections/section', 'home-slider' );

	if ( $subheader_features_show == 1 ):
		get_template_part( 'sections/section', 'home-features' );
	endif;

	if ( $ourteam_general_show == 1 ):
		get_template_part( 'sections/section', 'home-our-team' );
	endif;

	if ( $testimonials_general_show == 1 ):
		get_template_part( 'sections/section', 'home-testimonials' );
	endif;

	if ( $speak_general_show == 1 ):
		get_template_part( 'sections/section', 'home-speak' );
	endif;

	if ( $blog_news_general_show == 1 ):
		get_template_part( 'sections/section', 'news' );
	endif;

endif;
?>
<?php get_footer(); ?>