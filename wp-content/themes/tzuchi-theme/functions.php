<?php 

/******************* STYLESHEET *******************/

function main_styles(){
	wp_register_style( 'main_styles', get_template_directory_uri() . '/style.css');
	wp_enqueue_style( 'main_styles' );
}

add_action( 'wp_enqueue_scripts', 'main_styles' );

// Customizer styles
require_once get_template_directory() . '/inc/customizer/customizer_styles.php';

/******************* MENU *******************/

// Register Custom Navigation Walker
require_once('wp-bootstrap-navwalker.php');

add_theme_support('menus');

function register_my_menu() {
  register_nav_menu('navigation-menu',__( 'Navigation Menu' ));
}
add_action( 'init', 'register_my_menu' );


/******************* CUSTOMIZER *******************/
function create_customizer($wp_customize){

// General Panel
require_once get_template_directory() . '/inc/customizer/panels/general.php';
// Team Members Panel
require_once get_template_directory() . '/inc/customizer/panels/team_members.php';
}


add_action( 'customize_register', 'create_customizer');


?>