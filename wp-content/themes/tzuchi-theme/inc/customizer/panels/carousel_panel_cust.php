<?php 

	/***********************************************/
	/******************* CAROUSEL ******************/
	/***********************************************/

	$wp_customize->add_section('carousel_section', array(
		'title' => esc_html__('Carousel', 'tzuchi-theme' ),
		'priority' => 10,
		'description' => 'Edit images in Carousel'
	));

	$wp_customize->add_setting('carousel_banner_1', array(
		'default' => ''
	));

	$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'carousel_banner_1',
           array(
	           'label'      => __( 'Image 1', 'tzuchi-theme' ),
	           'section'    => 'carousel_section',
	           'settings'   => 'carousel_banner_1'
           )
       )
   );

	$wp_customize->add_setting('carousel_banner_2', array(
		'default' => ''
	));

	$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'carousel_banner_2',
           array(
	           'label'      => __( 'Image 1', 'tzuchi-theme' ),
	           'section'    => 'carousel_section',
	           'settings'   => 'carousel_banner_2'
           )
       )
   );

	$wp_customize->add_setting('carousel_banner_3', array(
		'default' => ''
	));

	$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'carousel_banner_3',
           array(
	           'label'      => __( 'Image 1', 'tzuchi-theme' ),
	           'section'    => 'carousel_section',
	           'settings'   => 'carousel_banner_3'
           )
       )
   );

?>
