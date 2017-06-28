<?php 


function reset_mytheme_options() { 
    remove_theme_mods();
}
add_action( 'after_switch_theme', 'reset_mytheme_options' );

add_theme_support( 'post-thumbnails' );

/******************* ASSETS *******************/

function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');

function main_assets(){
	global $post;
	
	if ( is_page() && $post->post_parent > 0 ) { 
		wp_register_style( 'doctor_page_styles', get_template_directory_uri() . '/page-templates/doctor_page_styles.css');
		wp_enqueue_style( 'doctor_page_styles' );
	} else {
		wp_register_style( 'main_styles', get_template_directory_uri() . '/style.css');
		wp_enqueue_style( 'main_styles' );
	}

  // wp_deregister_script('jquery');
  // wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), null, true);
  wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(), array( 'jquery' ), true);
  wp_enqueue_script('countTo',  get_template_directory_uri() . '/assets/js/jquery.countTo.js', array( 'jquery' ), NULL, true );
  wp_enqueue_script( 'circliful-js', get_template_directory_uri() . '/assets/js/jquery.circliful.min.js', array( 'jquery' ), NULL, true );
  
  wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main-js.js', array( 'jquery' ), NULL, true );

}

add_action( 'wp_enqueue_scripts', 'main_assets' );

// Customizer styles
require_once get_template_directory() . '/inc/customizer/customizer_styles.php';

/******************* MENU *******************/

// Register Custom Navigation Walker
require_once('wp-bootstrap-navwalker.php');

function register_my_menu() {
  register_nav_menu('navigation-menu',__( 'Navigation Menu' ));
}
add_action( 'init', 'register_my_menu' );



/******************* WIDGET *******************/
/**
 * Register our sidebars and widgetized areas.
 *
 */
function footer_widget_init() {

  register_sidebar( array(
    'name'          => 'Footer Menu',
    'id'            => 'footer_bottom',
    'before_widget' => '<div class="footer-nav-col col-xs-6 col-sm-3">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="footer-title">',
    'after_title'   => '</h2>',
  ) );

}
add_action( 'widgets_init', 'footer_widget_init' );



/******************* CUSTOMIZER *******************/
function create_customizer($wp_customize){


// General Panel
require_once get_template_directory() . '/inc/customizer/panels/general_panel_cust.php';
// Team Members Panel
require_once get_template_directory() . '/inc/customizer/panels/team_members_panel_cust.php';

require_once get_template_directory() . '/inc/customizer/panels/footer_panel_cust.php';

require_once get_template_directory() . '/inc/customizer/panels/carousel_panel_cust.php';
}

add_action( 'customize_register', 'create_customizer');


/******************* POSTS *******************/

//Excerpt function
function get_excerpt($limit, $source = null){

    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    return $excerpt;
}








?>


