<?php 
// Register Custom Navigation Walker
require_once('wp-bootstrap-navwalker.php');

add_theme_support('menus');

function register_my_menu() {
  register_nav_menu('navigation-menu',__( 'Navigation Menu' ));
}
add_action( 'init', 'register_my_menu' );

?>