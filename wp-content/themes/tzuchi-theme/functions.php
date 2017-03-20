<?php 
// Register Custom Navigation Walker
require_once('wp-bootstrap-navwalker.php');

add_theme_support('menus');

function register_my_menu() {
  register_nav_menu('navigation-menu',__( 'Navigation Menu' ));
}
add_action( 'init', 'register_my_menu' );


add_action( 'customize_register', 'create_customizer');
function create_customizer($wp_customize){

	/**********************************************************/
	/****************** TEAM MEMEBERS PANEL *******************/
	/**********************************************************/
	$panel_id = 'team_members_panel';

	$wp_customize->add_panel( $panel_id, array(
 	'priority'       => 10,
  'capability'     => 'edit_theme_options',
  'theme_supports' => '',
  'title'          => __('Team Members', 'tzuchi-theme'),
  'description'    => __('Options to add a team member', 'tzuchi-theme'),
	));

	/***********************************************/
	/************ GENERAL SECTION ******************/
	/***********************************************/

	// Title
	$wp_customize->add_section('team_members_general', array(
		'title' => esc_html__('General', 'tzuchi-theme' ),
		'priority' => 10,
		'panel' => $panel_id
	));

	$wp_customize->add_setting('team_members_general_title', array(
		'default' => __('Heading title', 'tzuchi-theme')
	));

	$wp_customize->add_control('team_members_general_title', array(
		'label'    => __( esc_html__('Title:'), 'tzuchi-theme' ),
		'section'  => 'team_members_general'
	));

	//Description
	$wp_customize->add_setting('team_members_general_description', array(
		'default' => __('Heading description', 'tzuchi-theme')
	));

	$wp_customize->add_control('team_members_general_description', array(
		'label'   => __( esc_html__('Description:'), 'tzuchi-theme'),
		'section' =>	'team_members_general'
	));


	/**********************************************************/
	/****************** TEAM MEMEBER 1 *******************/
	/**********************************************************/

	$wp_customize->add_section('team_members_number1', array(
		'title' 	 => __("Team Memember #1", 'tzuchi-theme'),
		'priority' => 20,
		'description' => __('Team member #1 information', 'tzuchi-theme'),
		'panel'  => $panel_id
	));

	//Name
	$wp_customize->add_setting('team_members_number1_name', array(
		'default'   => 'Name'
	));

	$wp_customize->add_control('team_members_number1_name', array(
		'label'   => __( esc_html__('Name'), 'tzuchi-theme'),
		'section' => 'team_members_number1'
	));

	//Training
	$wp_customize->add_setting('team_members_number1_training', array(
		'default' => "Training qualifications"
	));

	$wp_customize->add_control('team_members_number1_training', array(
		'label'   => __( esc_html__('Training'), 'tzuchi-theme'),
		'section' => 'team_members_number1'
	));

	//Description
	$wp_customize->add_setting('team_members_number1_description', array(
		'default' => 'Description'
	));

	$wp_customize->add_control('team_members_number1_description', array(
		'label'   => __( esc_html__('Description'), 'tzuchi-theme'),
		'type'		=> 'textarea',
		'section' => 'team_members_number1'
	));

	//Image
	$wp_customize->add_setting('team_members_number1_image', array(
		'default' => get_template_directory_uri() . '/layout/images/member-default.jpg'
	));

	$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'team_members_number1_image',
           array(
	           'label'      => __( 'Image', 'tzuchi-theme' ),
	           'section'    => 'team_members_number1',
	           'settings'   => 'team_members_number1_image'
           )
       )
   );













}








?>