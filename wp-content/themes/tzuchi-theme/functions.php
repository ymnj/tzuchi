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
		'default' => __('Name', 'tzuchi-theme')
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


/**********************************************************/
/****************** TEAM MEMEBER 2 *******************/
/**********************************************************/	

$wp_customize->add_section('team_members_number2', array(
	'title' 	 => __("Team Memember #2", 'tzuchi-theme'),
	'priority' => 20,
	'description' => __('Team member #2 information', 'tzuchi-theme'),
	'panel'  => $panel_id
));

//Name
$wp_customize->add_setting('team_members_number2_name', array(
	'default'   => 'Name'
));

$wp_customize->add_control('team_members_number2_name', array(
	'label'   => __( esc_html__('Name'), 'tzuchi-theme'),
	'section' => 'team_members_number2'
));

//Training
$wp_customize->add_setting('team_members_number2_training', array(
	'default' => "Training qualifications"
));

$wp_customize->add_control('team_members_number2_training', array(
	'label'   => __( esc_html__('Training'), 'tzuchi-theme'),
	'section' => 'team_members_number2'
));

//Description
$wp_customize->add_setting('team_members_number2_description', array(
	'default' => 'Description'
));

$wp_customize->add_control('team_members_number2_description', array(
	'label'   => __( esc_html__('Description'), 'tzuchi-theme'),
	'type'		=> 'textarea',
	'section' => 'team_members_number2'
));

//Image
$wp_customize->add_setting('team_members_number2_image', array(
	'default' => get_template_directory_uri() . '/layout/images/member-default.jpg'
));

$wp_customize->add_control(
     new WP_Customize_Image_Control(
         $wp_customize,
         'team_members_number2_image',
         array(
           'label'      => __( 'Image', 'tzuchi-theme' ),
           'section'    => 'team_members_number2',
           'settings'   => 'team_members_number2_image'
         )
     )
 );

/**********************************************************/
/****************** TEAM MEMEBER 3 *******************/
/**********************************************************/

$wp_customize->add_section('team_members_number3', array(
	'title' 	 => __("Team Memember #3", 'tzuchi-theme'),
	'priority' => 20,
	'description' => __('Team member #3 information', 'tzuchi-theme'),
	'panel'  => $panel_id
));

//Name
$wp_customize->add_setting('team_members_number3_name', array(
	'default'   => 'Name'
));

$wp_customize->add_control('team_members_number3_name', array(
	'label'   => __( esc_html__('Name'), 'tzuchi-theme'),
	'section' => 'team_members_number3'
));

//Training
$wp_customize->add_setting('team_members_number3_training', array(
	'default' => "Training qualifications"
));

$wp_customize->add_control('team_members_number3_training', array(
	'label'   => __( esc_html__('Training'), 'tzuchi-theme'),
	'section' => 'team_members_number3'
));

//Description
$wp_customize->add_setting('team_members_number3_description', array(
	'default' => 'Description'
));

$wp_customize->add_control('team_members_number3_description', array(
	'label'   => __( esc_html__('Description'), 'tzuchi-theme'),
	'type'		=> 'textarea',
	'section' => 'team_members_number3'
));

//Image
$wp_customize->add_setting('team_members_number3_image', array(
	'default' => get_template_directory_uri() . '/layout/images/member-default.jpg'
));

$wp_customize->add_control(
   new WP_Customize_Image_Control(
       $wp_customize,
       'team_members_number3_image',
       array(
         'label'      => __( 'Image', 'tzuchi-theme' ),
         'section'    => 'team_members_number3',
         'settings'   => 'team_members_number3_image'
       )
   )
);

/**********************************************************/
/****************** TEAM MEMEBER 4 *******************/
/**********************************************************/	

$wp_customize->add_section('team_members_number4', array(
	'title' 	 => __("Team Memember #4", 'tzuchi-theme'),
	'priority' => 20,
	'description' => __('Team member #4 information', 'tzuchi-theme'),
	'panel'  => $panel_id
));

//Name
$wp_customize->add_setting('team_members_number4_name', array(
	'default'   => 'Name'
));

$wp_customize->add_control('team_members_number4_name', array(
	'label'   => __( esc_html__('Name'), 'tzuchi-theme'),
	'section' => 'team_members_number4'
));

//Training
$wp_customize->add_setting('team_members_number4_training', array(
	'default' => "Training qualifications"
));

$wp_customize->add_control('team_members_number4_training', array(
	'label'   => __( esc_html__('Training'), 'tzuchi-theme'),
	'section' => 'team_members_number4'
));

//Description
$wp_customize->add_setting('team_members_number4_description', array(
	'default' => 'Description'
));

$wp_customize->add_control('team_members_number4_description', array(
	'label'   => __( esc_html__('Description'), 'tzuchi-theme'),
	'type'		=> 'textarea',
	'section' => 'team_members_number4'
));

//Image
$wp_customize->add_setting('team_members_number4_image', array(
	'default' => get_template_directory_uri() . '/layout/images/member-default.jpg'
));

$wp_customize->add_control(
   new WP_Customize_Image_Control(
       $wp_customize,
       'team_members_number4_image',
       array(
         'label'      => __( 'Image', 'tzuchi-theme' ),
         'section'    => 'team_members_number4',
         'settings'   => 'team_members_number4_image'
       )
   )
);

/**********************************************************/
/****************** TEAM MEMEBER 5 *******************/
/**********************************************************/	

$wp_customize->add_section('team_members_number5', array(
	'title' 	 => __("Team Memember #5", 'tzuchi-theme'),
	'priority' => 20,
	'description' => __('Team member #5 information', 'tzuchi-theme'),
	'panel'  => $panel_id
));

//Name
$wp_customize->add_setting('team_members_number5_name', array(
	'default'   => 'Name'
));

$wp_customize->add_control('team_members_number5_name', array(
	'label'   => __( esc_html__('Name'), 'tzuchi-theme'),
	'section' => 'team_members_number5'
));

//Training
$wp_customize->add_setting('team_members_number5_training', array(
	'default' => "Training qualifications"
));

$wp_customize->add_control('team_members_number5_training', array(
	'label'   => __( esc_html__('Training'), 'tzuchi-theme'),
	'section' => 'team_members_number5'
));

//Description
$wp_customize->add_setting('team_members_number5_description', array(
	'default' => 'Description'
));

$wp_customize->add_control('team_members_number5_description', array(
	'label'   => __( esc_html__('Description'), 'tzuchi-theme'),
	'type'		=> 'textarea',
	'section' => 'team_members_number5'
));

//Image
$wp_customize->add_setting('team_members_number5_image', array(
	'default' => get_template_directory_uri() . '/layout/images/member-default.jpg'
));

$wp_customize->add_control(
   new WP_Customize_Image_Control(
       $wp_customize,
       'team_members_number5_image',
       array(
         'label'      => __( 'Image', 'tzuchi-theme' ),
         'section'    => 'team_members_number5',
         'settings'   => 'team_members_number5_image'
       )
   )
);


/**********************************************************/
/****************** TEAM MEMEBER 6 *******************/
/**********************************************************/	

$wp_customize->add_section('team_members_number6', array(
	'title' 	 => __("Team Memember #6", 'tzuchi-theme'),
	'priority' => 20,
	'description' => __('Team member #6 information', 'tzuchi-theme'),
	'panel'  => $panel_id
));

//Name
$wp_customize->add_setting('team_members_number6_name', array(
	'default'   => 'Name'
));

$wp_customize->add_control('team_members_number6_name', array(
	'label'   => __( esc_html__('Name'), 'tzuchi-theme'),
	'section' => 'team_members_number6'
));

//Training
$wp_customize->add_setting('team_members_number6_training', array(
	'default' => "Training qualifications"
));

$wp_customize->add_control('team_members_number6_training', array(
	'label'   => __( esc_html__('Training'), 'tzuchi-theme'),
	'section' => 'team_members_number6'
));

//Description
$wp_customize->add_setting('team_members_number6_description', array(
	'default' => 'Description'
));

$wp_customize->add_control('team_members_number6_description', array(
	'label'   => __( esc_html__('Description'), 'tzuchi-theme'),
	'type'		=> 'textarea',
	'section' => 'team_members_number6'
));

//Image
$wp_customize->add_setting('team_members_number6_image', array(
	'default' => get_template_directory_uri() . '/layout/images/member-default.jpg'
));

$wp_customize->add_control(
   new WP_Customize_Image_Control(
       $wp_customize,
       'team_members_number6_image',
       array(
         'label'      => __( 'Image', 'tzuchi-theme' ),
         'section'    => 'team_members_number6',
         'settings'   => 'team_members_number6_image'
       )
   )
);







}








?>