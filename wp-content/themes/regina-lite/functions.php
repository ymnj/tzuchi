<?php
/**
 * regina-lite functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package regina-lite
 */

if ( ! function_exists( 'regina_lite_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function regina_lite_setup() {
		/**
		 *    Require Once
		 */
		require_once( 'inc/components/nav-walker/class.mt-nav-walker.php' );
		require_once( 'inc/components/pagination/class.mt-pagination.php' );
		require_once( 'inc/components/author-box/class.mt-author-box.php' );
		require_once( 'inc/components/breadcrumb/class.mt-breadcrumb.php' );
		require_once( 'inc/components/entry-meta/class.mt-entry-meta.php' );
		require_once( 'inc/components/related-posts/class.mt-related-posts.php' );
		require_once( 'inc/components/contact-bar/class.mt-contact-bar.php' );
		require_once( 'inc/customizer/customizer.php' );

		require_once( 'inc/template-tags.php' );
		require_once( 'inc/extras.php' );
		require_once( 'inc/customizer/customizer.php' );
		require_once( 'inc/jetpack.php' );

		require_once( 'widgets/widget-contact.php' );
		require_once( 'widgets/widget-address.php' );

		// TGMPA
		require_once( 'inc/tgmpa/tgm-plugin-activation.php' );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on regina-lite, use a find and replace
		 * to change 'regina-lite' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'regina-lite', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 *    Custom Header
		 */
		$custom_header_args = array(
			'default-image' => get_template_directory_uri() . '/layout/images/home/slide-1.jpg',
			'width'         => '1920',
			'height'        => '560',
		);
		add_theme_support( 'custom-header', $custom_header_args );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary Menu', 'regina-lite' ),
			'secondary' => esc_html__( 'Secondary Menu', 'regina-lite' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Add image sizes
		 * @link http://codex.wordpress.org/Function_Reference/add_image_size
		 */
		add_image_size( 'regina-lite-blog', 750, 419, true );
		add_image_size( 'regina-lite-related-posts', 230, 231, true );
		add_image_size( 'regina-lite-homepage-blog-posts', 250, 250, true );
		add_image_size( 'regina-lite-slider-image-sizes', 1682, 560, true );
	}

	add_action( 'after_setup_theme', 'regina_lite_setup' );
endif; // regina_lite_setup

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function regina_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'regina_lite_content_width', 750 );
}

add_action( 'after_setup_theme', 'regina_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function regina_lite_widgets_init() {
	// Blog Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'regina-lite' ),
		'id'            => 'blog-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );

	// Footer Sidebar 1
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 1', 'regina-lite' ),
		'id'            => 'footer-sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6><small>',
		'after_title'   => '</small></h6>',
	) );

	// Footer Sidebar 2
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 2', 'regina-lite' ),
		'id'            => 'footer-sidebar-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6><small>',
		'after_title'   => '</small></h6>',
	) );

	// Footer Sidebar 3
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 3', 'regina-lite' ),
		'id'            => 'footer-sidebar-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6><small>',
		'after_title'   => '</small></h6>',
	) );

	// Footer Sidebar 4
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 4', 'regina-lite' ),
		'id'            => 'footer-sidebar-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6><small>',
		'after_title'   => '</small></h6>',
	) );
}

add_action( 'widgets_init', 'regina_lite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function regina_lite_scripts() {

	$enable_site_lazyload = get_theme_mod( 'regina_lite_enable_site_lazyload', 1 );
	$preloader_enabled    = get_theme_mod( 'regina_lite_enable_site_preloader', 1 );

	// Google Fonts
	$google_fonts_args = array(
		'family' => 'Lato:400,700%7CMontserrat:400,700',
	);

	// WP Register Style
	wp_register_style( 'google-fonts', add_query_arg( $google_fonts_args, "//fonts.googleapis.com/css" ), array(), null );

	// WP Enqueue Style
	wp_enqueue_style( 'bxslider-css', get_template_directory_uri() . '/layout/css/bxslider.min.css', array(), 'all' );
	wp_enqueue_style( 'regina-lite-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'regina-lite-main-css', get_template_directory_uri() . '/layout/css/styles.min.css', array(), '', 'all' );
	wp_enqueue_style( 'regina-lite-bootstrap', get_template_directory_uri() . '/layout/css/bootstrap.min.css', array(), '', 'all' );
	wp_enqueue_style( 'regina-lite-mobile', get_template_directory_uri() . '/layout/css/mobile.min.css', array(), '', 'all' );

	wp_enqueue_style( 'regina-lite-owl-carousel', get_template_directory_uri() . '/layout/css/owl-carousel.css', array(), '', 'all' );
	wp_enqueue_style( 'regina-lite-owl-theme', get_template_directory_uri() . '/layout/css/owl-theme.css', array(), '', 'all' );

	wp_enqueue_style( 'google-fonts' );

	// WP Enqueue Script
	if ( $preloader_enabled == 1 ) {
		wp_enqueue_script( 'pace-min-js', get_template_directory_uri() . '/layout/js/plugins/pace/pace.min.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'regina-lite-preloader', get_template_directory_uri() . '/layout/js/preloader.min.js', array(
			'jquery',
			'pace-min-js',
		), '', false );
		wp_enqueue_style( 'regina-lite-pace', get_template_directory_uri() . '/layout/css/pace.min.css', array(), '', 'all' );
	}


	wp_enqueue_script( 'regina-lite-jquery.bxslider.min', get_template_directory_uri() . '/layout/js/plugins/bxslider/bxslider.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'regina-lite-owl-carousel-min', get_template_directory_uri() . '/layout/js/plugins/owl-carousel/owl-carousel.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'regina-lite-scripts', get_template_directory_uri() . '/layout/js/plugins.js', array(
		'jquery',
		'regina-lite-owl-carousel-min',
	), '', true );

	if ( $enable_site_lazyload == 1 ) {
		wp_enqueue_script( 'regina-lite-jquery.lazyload.min', get_template_directory_uri() . '/layout/js/plugins/lazyload/lazyload.min.js', array( 'jquery' ), '', true );
	}

	wp_enqueue_script( 'regina-lite-jquery.waypoints.min', get_template_directory_uri() . '/layout/js/plugins/waypoints/waypoints.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'regina-lite-navigation', get_template_directory_uri() . '/layout/js/plugins/navigation/navigation.min.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'regina-lite-skip-link-focus-fix', get_template_directory_uri() . '/layout/js/plugins/skip-link-focus-fix/skip-link-focus-fix.js', array( 'jquery' ), '20130115', true );
	wp_enqueue_script( 'regina-lite-custom', get_template_directory_uri() . '/layout/js/custom.min.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'regina_lite_scripts' );

#
#  Move comment field to bottom
#
add_filter( 'comment_form_fields', 'regina_lite_move_comment_field_to_bottom' );
function regina_lite_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}