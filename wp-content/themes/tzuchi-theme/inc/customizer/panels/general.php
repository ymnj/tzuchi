<?php 

	/***********************************************/
	/************ BACKGROUND ******************/
	/***********************************************/

	$wp_customize->add_section('site_color', array(
		'title' => esc_html__('General', 'tzuchi-theme' ),
		'priority' => 10,
		'description' => 'Edit general site options'
	));

	$wp_customize->add_setting('site_color', array(
		'default' => __('#eee', 'tzuchi-theme')
	));

	$wp_customize->add_control('site_color', array(
		'label'    => __( esc_html__('Main Background'), 'tzuchi-theme' ),
		'section'  => 'site_color'
	));

?>

