<?php 


// function reset_mytheme_options() { 
//     remove_theme_mods();
// }
// add_action( 'after_switch_theme', 'reset_mytheme_options' );

add_theme_support( 'post-thumbnails' );


/******************* STYLESHEET *******************/

function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');

function main_styles(){
	global $post;
	
	if ( is_page() && $post->post_parent > 0 ) { 
		wp_register_style( 'doctor_page_styles', get_template_directory_uri() . '/page-templates/doctor_page_styles.css');
		wp_enqueue_style( 'doctor_page_styles' );
	} else {
		wp_register_style( 'main_styles', get_template_directory_uri() . '/style.css');
		wp_enqueue_style( 'main_styles' );
	}
}

add_action( 'wp_enqueue_scripts', 'main_styles' );

// Customizer styles
require_once get_template_directory() . '/inc/customizer/customizer_styles.php';

/******************* MENU *******************/

// Register Custom Navigation Walker
require_once('wp-bootstrap-navwalker.php');

function register_my_menu() {
  register_nav_menu('navigation-menu',__( 'Navigation Menu' ));
  // register_nav_menu('footer-nav-menu',__( 'Footer Nav' ));
}
add_action( 'init', 'register_my_menu' );

/******************* WIDGET *******************/
/**
 * Register our sidebars and widgetized areas.
 *
 */
function footer_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer Bottom Sidebar',
		'id'            => 'footer_bottom',
		'before_widget' => '<div class="footer-nav-col col-lg-3">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'footer_widgets_init' );


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


?>