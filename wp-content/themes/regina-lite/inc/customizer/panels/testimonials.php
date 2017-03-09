<?php
// Set Panel ID
$panel_id = 'regina_lite_testimonials_panel';

// Set Prefix
$prefix = 'regina_lite';

/***********************************************/
/****************** OUR TEAM *******************/
/***********************************************/
$wp_customize->add_panel( $panel_id,
    array(
        'priority'          => 53,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => esc_html__( 'Testimonials', 'regina-lite' ),
        'description'       => esc_html__( 'Control all the Testimonial Section settings from this panel. Adding more testimonials is possible only in the PRO version of Regina.', 'regina-lite' ),
    )
);

/***********************************************/
/************ GENERAL SECTION *******************/
/***********************************************/
$wp_customize->add_section( $prefix.'_testimonials_general' ,
    array(
        'title'       => esc_html__( 'General', 'regina-lite' ),
        'panel' => $panel_id,
        //'description' => esc_html__( 'General Section description.', 'regina-lite' ),

    )
);

/* Show this section? */
$wp_customize->add_setting( $prefix.'_testimonials_general_show',
    array(
        'sanitize_callback' => $prefix.'_sanitize_checkbox',
        'default'           => 1
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_general_show',
    array(
        'type'          => 'checkbox',
        'label'         => esc_html__('Show this section?', 'regina-lite'),
        //'description'   => esc_html__('Testimonials Show description.', 'regina-lite'),
        'section'       => $prefix.'_testimonials_general',
    )
);

/* Image #1 */
$wp_customize->add_setting( 
        $prefix . '_testimonials_general_image1', 
        array( 
            'default' => get_template_directory_uri() . '/layout/images/home/testimonial-1.jpg', 
            'sanitize_callback' => 'esc_url_raw' 
            ) 
        );

$wp_customize->add_control( new WP_Customize_Image_Control( 
    $wp_customize, $prefix . '_testimonials_general_image1', 
        array(
            'label'    => __( 'Image #1:', 'regina-lite' ),
            'section'  => $prefix.'_testimonials_general',
            'settings' => $prefix . '_testimonials_general_image1',
        ) 
    ) 
);

/* Image #2 */
$wp_customize->add_setting( $prefix . '_testimonials_general_image2', array( 'default' => get_template_directory_uri() . '/layout/images/home/testimonial-2.jpg', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_testimonials_general_image2', array(
    'label'    => __( 'Image #2:', 'regina-lite' ),
    'section'  => $prefix.'_testimonials_general',
    'settings' => $prefix . '_testimonials_general_image2',
) ) );

/* Image #3 */
$wp_customize->add_setting( $prefix . '_testimonials_general_image3', array( 'default' => get_template_directory_uri() . '/layout/images/home/testimonial-3.jpg', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_testimonials_general_image3', array(
    'label'    => __( 'Image #3:', 'regina-lite' ),
    'section'  => $prefix.'_testimonials_general',
    'settings' => $prefix . '_testimonials_general_image3',
) ) );

/* Image #4 */
$wp_customize->add_setting( $prefix . '_testimonials_general_image4', array( 'default' => get_template_directory_uri() . '/layout/images/home/testimonial-4.jpg', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_testimonials_general_image4', array(
    'label'    => __( 'Image #4:', 'regina-lite' ),
    'section'  => $prefix.'_testimonials_general',
    'settings' => $prefix . '_testimonials_general_image4',
) ) );

/***********************************************/
/************ TESTIMONIAL #1 SECTION ***********/
/***********************************************/
$wp_customize->add_section( $prefix.'_testimonials_testimonial1' ,
    array(
        'title'       => esc_html__( 'Testimonial #1', 'regina-lite' ),
        'description' => esc_html__( 'Testimonial #1 Section description.', 'regina-lite' ),
        'panel'       => $panel_id
    )
);

/* Description */
$wp_customize->add_setting($prefix.'_testimonials_testimonial1_description',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial1_description',
    array(
        'label'         => esc_html__('Description:', 'regina-lite'),
        //'description'   => esc_html__('Description description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial1',
        'type'			=> 'textarea'
    )
);

/* Image */
$wp_customize->add_setting( $prefix . '_testimonials_testimonial1_image', array( 'default' => get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_testimonials_testimonial1_image', array(
    'label'    => __( 'Image:', 'regina-lite' ),
    'section'  => $prefix.'_testimonials_testimonial1',
    'settings' => $prefix . '_testimonials_testimonial1_image',
) ) );

/* Name */
$wp_customize->add_setting($prefix.'_testimonials_testimonial1_name',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Jenny Royal', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial1_name',
    array(
        'label'         => esc_html__('Name:', 'regina-lite'),
        //'description'   => esc_html__('Name description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial1'
    )
);

/* Position */
$wp_customize->add_setting($prefix.'_testimonials_testimonial1_position',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Manager @ REQ', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial1_position',
    array(
        'label'         => esc_html__('Position:', 'regina-lite'),
        //'description'   => esc_html__('Position description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial1'
    )
);

/***********************************************/
/************ TESTIMONIAL #2 SECTION ***********/
/***********************************************/
$wp_customize->add_section( $prefix.'_testimonials_testimonial2' ,
    array(
        'title'       => esc_html__( 'Testimonial #2', 'regina-lite' ),
        //'description' => esc_html__( 'Testimonial #2 Section description.', 'regina-lite' ),
        'panel'       => $panel_id
    )
);

/* Description */
$wp_customize->add_setting($prefix.'_testimonials_testimonial2_description',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial2_description',
    array(
        'label'         => esc_html__('Description:', 'regina-lite'),
        //'description'   => esc_html__('Description description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial2',
        'type'			=> 'textarea'
    )
);

/* Image */
$wp_customize->add_setting( $prefix . '_testimonials_testimonial2_image', array( 'default' => get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_testimonials_testimonial2_image', array(
    'label'    => __( 'Image:', 'regina-lite' ),
    'section'  => $prefix.'_testimonials_testimonial2',
    'settings' => $prefix . '_testimonials_testimonial2_image',
) ) );

/* Name */
$wp_customize->add_setting($prefix.'_testimonials_testimonial2_name',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Jenny Royal', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial2_name',
    array(
        'label'         => esc_html__('Name:', 'regina-lite'),
        //'description'   => esc_html__('Name description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial2'
    )
);

/* Position */
$wp_customize->add_setting($prefix.'_testimonials_testimonial2_position',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Manager @ REQ', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial2_position',
    array(
        'label'         => esc_html__('Position:', 'regina-lite'),
        //'description'   => esc_html__('Position description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial2'
    )
);

/***********************************************/
/************ TESTIMONIAL #3 SECTION ***********/
/***********************************************/
$wp_customize->add_section( $prefix.'_testimonials_testimonial3' ,
    array(
        'title'       => esc_html__( 'Testimonial #3', 'regina-lite' ),
        //'description' => esc_html__( 'Testimonial #3 Section description.', 'regina-lite' ),
        'panel'       => $panel_id
    )
);

/* Description */
$wp_customize->add_setting($prefix.'_testimonials_testimonial3_description',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial3_description',
    array(
        'label'         => esc_html__('Description:', 'regina-lite'),
        //'description'   => esc_html__('Description description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial3',
        'type'          => 'textarea'
    )
);

/* Image */
$wp_customize->add_setting( $prefix . '_testimonials_testimonial3_image', array( 'default' => get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_testimonials_testimonial3_image', array(
    'label'    => __( 'Image:', 'regina-lite' ),
    'section'  => $prefix.'_testimonials_testimonial3',
    'settings' => $prefix . '_testimonials_testimonial3_image',
) ) );

/* Name */
$wp_customize->add_setting($prefix.'_testimonials_testimonial3_name',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Jenny Royal', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial3_name',
    array(
        'label'         => esc_html__('Name:', 'regina-lite'),
        //'description'   => esc_html__('Name description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial3'
    )
);

/* Position */
$wp_customize->add_setting($prefix.'_testimonials_testimonial3_position',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Manager @ REQ', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial3_position',
    array(
        'label'         => esc_html__('Position:', 'regina-lite'),
        //'description'   => esc_html__('Position description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial3'
    )
);

/***********************************************/
/************ TESTIMONIAL #4 SECTION ***********/
/***********************************************/
$wp_customize->add_section( $prefix.'_testimonials_testimonial4' ,
    array(
        'title'       => esc_html__( 'Testimonial #4', 'regina-lite' ),
        //'description' => esc_html__( 'Testimonial #4 Section description.', 'regina-lite' ),
        'panel'       => $panel_id
    )
);

/* Description */
$wp_customize->add_setting($prefix.'_testimonials_testimonial4_description',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial4_description',
    array(
        'label'         => esc_html__('Description:', 'regina-lite'),
        //'description'   => esc_html__('Description description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial4',
        'type'          => 'textarea'
    )
);

/* Image */
$wp_customize->add_setting( $prefix . '_testimonials_testimonial4_image', array( 'default' => get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_testimonials_testimonial4_image', array(
    'label'    => __( 'Image:', 'regina-lite' ),
    'section'  => $prefix.'_testimonials_testimonial4',
    'settings' => $prefix . '_testimonials_testimonial4_image',
) ) );

/* Name */
$wp_customize->add_setting($prefix.'_testimonials_testimonial4_name',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Jenny Royal', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial4_name',
    array(
        'label'         => esc_html__('Name:', 'regina-lite'),
        //'description'   => esc_html__('Name description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial4'
    )
);

/* Position */
$wp_customize->add_setting($prefix.'_testimonials_testimonial4_position',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Manager @ REQ', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial4_position',
    array(
        'label'         => esc_html__('Position:', 'regina-lite'),
        //'description'   => esc_html__('Position description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial4'
    )
);

/***********************************************/
/************ TESTIMONIAL #5 SECTION ***********/
/***********************************************/
$wp_customize->add_section( $prefix.'_testimonials_testimonial5' ,
    array(
        'title'       => esc_html__( 'Testimonial #5', 'regina-lite' ),
        //'description' => esc_html__( 'Testimonial #5 Section description.', 'regina-lite' ),
        'panel'       => $panel_id
    )
);

/* Description */
$wp_customize->add_setting($prefix.'_testimonials_testimonial5_description',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial5_description',
    array(
        'label'         => esc_html__('Description:', 'regina-lite'),
        //'description'   => esc_html__('Description description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial5',
        'type'          => 'textarea'
    )
);

/* Image */
$wp_customize->add_setting( $prefix . '_testimonials_testimonial5_image', array( 'default' => get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_testimonials_testimonial5_image', array(
    'label'    => __( 'Image:', 'regina-lite' ),
    'section'  => $prefix.'_testimonials_testimonial5',
    'settings' => $prefix . '_testimonials_testimonial5_image',
) ) );

/* Name */
$wp_customize->add_setting($prefix.'_testimonials_testimonial5_name',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Jenny Royal', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial5_name',
    array(
        'label'         => esc_html__('Name:', 'regina-lite'),
        //'description'   => esc_html__('Name description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial5'
    )
);

/* Position */
$wp_customize->add_setting($prefix.'_testimonials_testimonial5_position',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Manager @ REQ', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_testimonials_testimonial5_position',
    array(
        'label'         => esc_html__('Position:', 'regina-lite'),
        //'description'   => esc_html__('Position description.','regina-lite'),
        'section'       => $prefix.'_testimonials_testimonial5'
    )
);