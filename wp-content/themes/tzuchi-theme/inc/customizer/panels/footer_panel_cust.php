<?php 

	/***********************************************/
	/****************** FOOTER PANEL ***************/
	/***********************************************/

	$panel_id = 'footer_panel';

	$wp_customize->add_panel( $panel_id, array(
 	'priority'       => 12,
  'capability'     => 'edit_theme_options',
  'theme_supports' => '',
  'title'          => __('Footer', 'tzuchi-theme'),
  'description'    => __('Footer Options', 'tzuchi-thme'),
	));


	// COLUMN ONE

	$wp_customize->add_section('footer_col_one', array(
		'title' => esc_html__('First Column', 'tzuchi-theme' ),
		'priority' => 10,
		'description' => 'Edit first column in footer',
		'panel' => $panel_id
	));

	$wp_customize->add_setting('heading_title_1', array(
		'default' => __('Menu', 'tzuchi-theme')
	));

	$wp_customize->add_control('heading_title_1', array(
		'label'    => __( esc_html__('Column one Heading Title'), 'tzuchi-theme' ),
		'section'  => 'footer_col_one'
	));

	// COLUMN TWO

	$wp_customize->add_section('footer_col_two', array(
		'title' => esc_html__('Second Column', 'tzuchi-theme' ),
		'priority' => 11,
		'description' => 'Edit second column in footer',
		'panel' => $panel_id
	));

	$wp_customize->add_setting('heading_title_2', array(
		'default' => __('Clinic Address', 'tzuchi-theme')
	));

	$wp_customize->add_control('heading_title_2', array(
		'label'    => __( esc_html__('Column two Heading Title'), 'tzuchi-theme' ),
		'section'  => 'footer_col_two'
	));

	//COLUMN THREE

	$wp_customize->add_section('footer_col_three', array(
		'title' => esc_html__('Third Column', 'tzuchi-theme' ),
		'priority' => 12,
		'description' => 'Edit third column in footer',
		'panel' => $panel_id
	));

	$wp_customize->add_setting('heading_title_3', array(
		'default' => __('Contact', 'tzuchi-theme')
	));

	$wp_customize->add_control('heading_title_3', array(
		'label'    => __( esc_html__('Column three Heading Title'), 'tzuchi-theme' ),
		'section'  => 'footer_col_three'
	));

	// //COLUMN FOUR

	$wp_customize->add_section('footer_col_four', array(
		'title' => esc_html__('Fourth Column', 'tzuchi-theme' ),
		'priority' => 13,
		'description' => 'Edit fourth column in footer',
		'panel' => $panel_id
	));

	$wp_customize->add_setting('heading_title_4', array(
		'default' => __('Office Address', 'tzuchi-theme')
	));

	$wp_customize->add_control('heading_title_4', array(
		'label'    => __( esc_html__('Column four Heading Title'), 'tzuchi-theme' ),
		'section'  => 'footer_col_four'
	));


?>
