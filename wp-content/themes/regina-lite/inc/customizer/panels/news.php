<?php


/***********************************************/
/************** Latest News  ***************/
/***********************************************/


$wp_customize->add_section( 'regina_lite_news_general', array(
		'title'    => esc_html__( 'Latest News', 'regina-lite' ),
		'description' => esc_html__( 'Latest News Section is displayed as a slider on the homepage. Controls from this section are applied to that slider.', 'regina-lite'),
		'priority' => 56,

	) );

/* Show this section? */
$wp_customize->add_setting( $prefix.'_latest_news_show',
	array(
		'sanitize_callback' => $prefix.'_sanitize_checkbox',
		'default'           => 1
	)
);
$wp_customize->add_control(
	$prefix.'_latest_news_show',
	array(
		'type'          => 'checkbox',
		'label'         => esc_html__('Show this section?', 'regina-lite'),
		'section'       => 'regina_lite_news_general',
	)
);


/* Section Title */
$wp_customize->add_setting( 'regina_lite_news_section_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => esc_html__( 'Latest news', 'regina-lite' ),
		'transport'         => 'postMessage',
	) );

$wp_customize->add_control( 'regina_lite_news_section_title', array(
		'label'    => esc_html__( 'Section title', 'regina-lite' ),
		'section'  => 'regina_lite_news_general',
	) );

/* Section Sub-Title */
$wp_customize->add_setting( 'regina_lite_news_section_sub_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => esc_html__( 'Straight from our blog', 'regina-lite' ),
		'transport'         => 'postMessage',
	) );

$wp_customize->add_control( 'regina_lite_news_section_sub_title', array(
		'label'    => esc_html__( 'Section sub-title', 'regina-lite' ),
		'section'  => 'regina_lite_news_general',
	) );

/* Number of post per slide */
$wp_customize->add_setting( 'regina_lite_news_section_no_posts_per_slide', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => 4,
		'transport'         => 'refresh',
	) );

$wp_customize->add_control( 'regina_lite_news_section_no_posts_per_slide', array(
		'label'   => esc_html__( 'Number of post per slide', 'regina-lite' ),
		'section' => 'regina_lite_news_general',
		'default' => 4,
	) );
$wp_customize->add_control( 'regina_lite_news_section_no_posts_per_slide', array(
		'type'    => 'select',
		'choices' => array(
			'1' => 1,
			'2' => 2,
			'4' => 4,
		),
		'label'   => esc_html__( 'Number of post per slide', 'regina-lite' ),
		'section' => 'regina_lite_news_general',
	) );