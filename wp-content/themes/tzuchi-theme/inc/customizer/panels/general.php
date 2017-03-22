<?php 

	/***********************************************/
	/************ MAIN BACKGROUND COLOR******************/
	/***********************************************/

	$wp_customize->add_section('general_section', array(
		'title' => esc_html__('General', 'tzuchi-theme' ),
		'priority' => 10,
		'description' => 'Edit general site options'
	));

	$wp_customize->add_setting('site_color', array(
		'default' => __('#eee', 'tzuchi-theme')
	));

	$wp_customize->add_control('site_color', array(
		'label'    => __( esc_html__('Main Background Color'), 'tzuchi-theme' ),
		'section'  => 'general_section'
	));

	/***********************************************/
	/************ NAVIGATION COLOR ******************/
	/*********************************red**************/

	$wp_customize->add_setting('nav_color', array(
		'default' => __('#fff', 'tzuchi-theme')
	));

	$wp_customize->add_control('nav_color', array(
		'label'    => __( esc_html__('Main Navigation Color'), 'tzuchi-theme' ),
		'section'  => 'general_section'
	));

?>

