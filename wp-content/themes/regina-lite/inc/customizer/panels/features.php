<?php
// Set Panel ID
$panel_id = 'regina_lite_features_panel';

// Set Prefix
$prefix = 'regina_lite';

/***********************************************/
/************** FEATURES ***********************/
/***********************************************/
$wp_customize->add_panel( $panel_id,
    array(
        'priority'          => 51,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => esc_html__( 'Our Services', 'regina-lite' ),
        'description'       => esc_html__( 'Control everything related to the Services section from this panel. Custom Colors & Icons are a PRO feature only.', 'regina-lite')
     )
);


/***********************************************/
/**************** BOX **************************/
/***********************************************/
$wp_customize->add_section( $prefix . '_top_box' ,
    array(
        'title'       => esc_html__( 'Blue Box on Hero Image', 'regina-lite' ),
        'description' => esc_html__( 'Use this section for your main call-to-action text.', 'regina-lite'),
        'panel'       => $panel_id
    )
);

/* Show this section? */
$wp_customize->add_setting( $prefix . '_top_box_show',
    array(
        'sanitize_callback' => $prefix . '_sanitize_checkbox',
        'default'           => 1
    )
);
$wp_customize->add_control(
    $prefix.'_top_box_show',
    array(
        'type'          => 'checkbox',
        'label'         => esc_html__( 'Show the blue box?', 'regina-lite' ),
        'section'       => $prefix . '_top_box',
    )
);

/* Title */
$wp_customize->add_setting($prefix . '_top_box_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'We help people, like you.', 'regina-lite' ),

    )
);
$wp_customize->add_control(
    $prefix.'_top_box_title',
    array(
        'label'         => esc_html__('Title:', 'regina-lite'),
        'section'       => $prefix.'_top_box',
    )
);

/* Description */
$wp_customize->add_setting($prefix.'_top_box_description',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Our team of specialists is ready to help you. Book an appointment now!', 'regina-lite' ),

    )
);
$wp_customize->add_control(
    $prefix.'_top_box_description',
    array(
        'label'         => esc_html__('Description:', 'regina-lite'),
        'section'       => $prefix.'_top_box',
        'type'          => 'textarea'
    )
);

$wp_customize->add_setting( $prefix.'_top_box_bookappointmenturl',
    array(
        'sanitize_callback' => 'esc_url',
        'default'           => esc_url('#')
    )
);

$wp_customize->add_control( $prefix.'_top_box_bookappointmenturl',
    array(
        'label'         => esc_html__( 'Book Aappointment URL:', 'regina-lite' ),
        'description'   => esc_html__( 'Tip: Use full URLs here instead of relative ones.', 'regina-lite'),
        'section'       => $prefix.'_top_box',
        'settings'      => $prefix.'_top_box_bookappointmenturl',
    )
);

/***********************************************/
/************ GENERAL SECTION ******************/
/***********************************************/
$wp_customize->add_section( $prefix.'_features_general' ,
    array(
        'title'       => esc_html__( 'General', 'regina-lite' ),
        'description'   => esc_html__( 'Control general settings for this section.', 'regina-lite'),
        'panel'       => $panel_id
    )
);

/* Show this section? */
$wp_customize->add_setting( $prefix.'_subheader_features_show',
    array(
        'sanitize_callback' => $prefix.'_sanitize_checkbox',
        'default'           => 1
    )
);
$wp_customize->add_control(
    $prefix.'_subheader_features_show',
    array(
        'type'          => 'checkbox',
        'label'         => esc_html__('Show this section?', 'regina-lite'),
        'section'       => $prefix.'_features_general',
    )
);

/* Title */
$wp_customize->add_setting($prefix.'_features_general_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Our Services', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_features_general_title',
    array(
        'label'         => esc_html__('Title:', 'regina-lite'),
        'section'       => $prefix.'_features_general',
    )
);

/* Description */
$wp_customize->add_setting($prefix.'_features_general_description',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'We offer various services lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_features_general_description',
    array(
        'label'         => esc_html__('Description:', 'regina-lite'),
        'section'       => $prefix.'_features_general',
        'type'          => 'textarea'
    )
);

/* Button Text */
$wp_customize->add_setting($prefix.'_features_general_button_text',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Our Services', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_features_general_button_text',
    array(
        'label'         => esc_html__('Button Text:', 'regina-lite'),
        'section'       => $prefix.'_features_general',
    )
);

/* Button URL */
$wp_customize->add_setting( $prefix.'_features_general_button_url',
    array(
        'sanitize_callback' => 'esc_url_raw',
        'default'           => esc_url( '#' )
    )
);
$wp_customize->add_control( $prefix.'_features_general_button_url',
    array(
        'label'         => esc_html__( 'Button URL:', 'regina-lite' ),
        'section'       => $prefix.'_features_general',
        'settings'      => $prefix.'_features_general_button_url',
    )
);

/***********************************************/
/************ FEATURE 1 SECTION ****************/
/***********************************************/
$wp_customize->add_section( $prefix.'_features_feature1' ,
    array(
        'title'       => esc_html__( 'Feature #1', 'regina-lite' ),
        'panel'       => $panel_id
    )
);

/* Title */
$wp_customize->add_setting($prefix.'_features_feature1_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Free Support', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_features_feature1_title',
    array(
        'label'         => esc_html__('Title:', 'regina-lite'),
        'section'       => $prefix.'_features_feature1',
    )
);

/* Description */
$wp_customize->add_setting($prefix.'_features_feature1_description',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_features_feature1_description',
    array(
        'label'         => esc_html__('Description:', 'regina-lite'),
        'section'       => $prefix.'_features_feature1',
        'type'          => 'textarea'
    )
);

$wp_customize->add_setting( $prefix.'_features_feature1_buttonurl',
    array(
        'sanitize_callback' => 'esc_url',
        'default'           => esc_url('#')
    )
);
$wp_customize->add_control( $prefix.'_features_feature1_buttonurl',
    array(
        'label'         => esc_html__( 'Button URL:', 'regina-lite' ),
        'section'       => $prefix.'_features_feature1',
        'settings'      => $prefix.'_features_feature1_buttonurl',
    )
);

/***********************************************/
/************ FEATURE 2 SECTION ****************/
/***********************************************/
$wp_customize->add_section( $prefix.'_features_feature2' ,
    array(
        'title'       => esc_html__( 'Feature #2', 'regina-lite' ),
        'panel'       => $panel_id
    )
);

/* Title */
$wp_customize->add_setting($prefix.'_features_feature2_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Medical Care', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_features_feature2_title',
    array(
        'label'         => esc_html__('Title:', 'regina-lite'),
        'section'       => $prefix.'_features_feature2',
    )
);

/* Description */
$wp_customize->add_setting($prefix.'_features_feature2_description',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_features_feature2_description',
    array(
        'label'         => esc_html__('Description:', 'regina-lite'),
        'section'       => $prefix.'_features_feature2',
        'type'          => 'textarea'
    )
);

$wp_customize->add_setting( $prefix.'_features_feature2_buttonurl',
    array(
        'sanitize_callback' => 'esc_url',
        'default'           => esc_url('#')
    )
);
$wp_customize->add_control( $prefix.'_features_feature2_buttonurl',
    array(
        'label'         => esc_html__( 'Button URL:', 'regina-lite' ),
        'section'       => $prefix.'_features_feature2',
        'settings'      => $prefix.'_features_feature2_buttonurl',
    )
);

/***********************************************/
/************ FEATURE 3 SECTION ****************/
/***********************************************/
$wp_customize->add_section( $prefix.'_features_feature3' ,
    array(
        'title'       => esc_html__( 'Feature #3', 'regina-lite' ),
        'panel'       => $panel_id
    )
);

/* Title */
$wp_customize->add_setting($prefix.'_features_feature3_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Life Care', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_features_feature3_title',
    array(
        'label'         => esc_html__('Title:', 'regina-lite'),
        'section'       => $prefix.'_features_feature3',
    )
);

/* Description */
$wp_customize->add_setting($prefix.'_features_feature3_description',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_features_feature3_description',
    array(
        'label'         => esc_html__('Description:', 'regina-lite'),
        'section'       => $prefix.'_features_feature3',
        'type'          => 'textarea'
    )
);

$wp_customize->add_setting( $prefix.'_features_feature3_buttonurl',
    array(
        'sanitize_callback' => 'esc_url',
        'default'           => esc_url('#')
    )
);
$wp_customize->add_control( $prefix.'_features_feature3_buttonurl',
    array(
        'label'         => esc_html__( 'Button URL:', 'regina-lite' ),
        'section'       => $prefix.'_features_feature3',
        'settings'      => $prefix.'_features_feature3_buttonurl',
    )
);

/***********************************************/
/************ FEATURE 4 SECTION ****************/
/***********************************************/
$wp_customize->add_section( $prefix.'_features_feature4' ,
    array(
        'title'       => esc_html__( 'Feature #4', 'regina-lite' ),
        'panel'       => $panel_id
    )
);

/* Title */
$wp_customize->add_setting($prefix.'_features_feature4_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Nervous System', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_features_feature4_title',
    array(
        'label'         => esc_html__('Title:', 'regina-lite'),
        'section'       => $prefix.'_features_feature4',
    )
);

/* Description */
$wp_customize->add_setting($prefix.'_features_feature4_description',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_features_feature4_description',
    array(
        'label'         => esc_html__('Description:', 'regina-lite'),
        'section'       => $prefix.'_features_feature4',
        'type'          => 'textarea'
    )
);

$wp_customize->add_setting( $prefix.'_features_feature4_buttonurl',
    array(
        'sanitize_callback' => 'esc_url',
        'default'           => esc_url('#')
    )
);
$wp_customize->add_control( $prefix.'_features_feature4_buttonurl',
    array(
        'label'         => esc_html__( 'Button URL:', 'regina-lite' ),
        'section'       => $prefix.'_features_feature4',
        'settings'      => $prefix.'_features_feature4_buttonurl',
    )
);