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


				/***********************************************/
				/****************** COLORS ***************/
				/***********************************************/

				// Background Color
				$wp_customize->add_section('footer_background_color', array(
					'title' => esc_html__('Background Color', 'tzuchi-theme' ),
					'priority' => 9,
					'description' => 'Edit Footer Background Color',
					'panel' => $panel_id
				));

				$wp_customize->add_setting('footer_background_color', array(
					'default' => __('darkgrey', 'tzuchi-theme')
				));

				$wp_customize->add_control('footer_background_color', array(
					'label'    => __( esc_html__('Background Color'), 'tzuchi-theme' ),
					'section'    => 'footer_background_color'
				));

				// Text Color
				$wp_customize->add_section('footer_text_color', array(
					'title' => esc_html__('Text Color', 'tzuchi-theme' ),
					'priority' => 10,
					'description' => 'Edit Footer Text Color',
					'panel' => $panel_id
				));

				$wp_customize->add_setting('footer_text_color', array(
					'default' => __('#000', 'tzuchi-theme')
				));

				$wp_customize->add_control('footer_text_color', array(
					'label'    => __( esc_html__('Text Color'), 'tzuchi-theme' ),
					'section'    => 'footer_text_color'
				));




					/***********************************************/
					/****************** PANEL ONE ***************/
					/***********************************************/

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

					/***********************************************/
					/****************** PANEL TWO ***************/
					/***********************************************/

					$wp_customize->add_section('footer_col_two', array(
						'title' => esc_html__('Second Column', 'tzuchi-theme' ),
						'priority' => 11,
						'description' => 'Edit second column in footer',
						'panel' => $panel_id
					));

					//HEADING TITLE
					$wp_customize->add_setting('heading_title_2', array(
						'default' => __('Clinic Address', 'tzuchi-theme')
					));

					$wp_customize->add_control('heading_title_2', array(
						'label'    => __( esc_html__('Column two Heading Title'), 'tzuchi-theme' ),
						'section'  => 'footer_col_two'
					));

					//CLINIC ONE
					$wp_customize->add_setting('link_1', array(
						'default' => __('Raven Song Community Health Centre', 'tzuchi-theme')
					));

					$wp_customize->add_control('link_1', array(
						'label'    => __( esc_html__('Link #1'), 'tzuchi-theme' ),
						'section'  => 'footer_col_two'
					));

					/***********************************************/
					/****************** PANEL THREE ***************/
					/***********************************************/

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

					/***********************************************/
					/****************** PANEL FOUR ***************/
					/***********************************************/

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




					/***********************************************/
					/****************** SUB PANEL ***************/
					/***********************************************/

					$wp_customize->add_section('sub_footer', array(
						'title' => esc_html__('Sub Footer', 'tzuchi-theme' ),
						'priority' => 13,
						'description' => 'Edit Subfooter text and Color',
						'panel' => $panel_id
					));

					//Subfooter Text
					$wp_customize->add_setting('subfooter_text', array(
						'default' => __('TZU CHI MEDICAL CENTRE OF TRADITIONAL CHINESE MEDICINE CANADA FOUNDATION © Copyright 2016. All Rights Reserved.', 'tzuchi-theme')
					));

					$wp_customize->add_control('subfooter_text', array(
						'label'    => __( esc_html__('Subfooter text'), 'tzuchi-theme' ),
						'section'  => 'sub_footer'
					));

					//Subfooter Background Color
					$wp_customize->add_setting('subfooter_bg_color', array(
						'default' => __('#404546', 'tzuchi-theme')
					));

					$wp_customize->add_control('subfooter_bg_color', array(
						'label'    => __( esc_html__('Subfooter Background Color'), 'tzuchi-theme' ),
						'section'  => 'sub_footer'
					));

					//Subfooter Text Color
					$wp_customize->add_setting('subfooter_text_color', array(
						'default' => __('grey', 'tzuchi-theme')
					));

					$wp_customize->add_control('subfooter_text_color', array(
						'label'    => __( esc_html__('Subfooter Text Color'), 'tzuchi-theme' ),
						'section'  => 'sub_footer'
					));
?>
