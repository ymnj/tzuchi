<?php

    // Set prefix
    $prefix = 'regina_lite';

    // Set Panel ID
    $panel_id = $prefix.'_panel_general';

    // Change panel for Site Title & Tagline Section
    $site_title        = $wp_customize->get_section( 'title_tagline' );
    $site_title->panel = $panel_id;

    // Remove sections from customizer front-view
    $wp_customize->remove_section('colors');

    // Change panel for Background Image
    $site_title2        = $wp_customize->get_section( 'background_image' );
    $site_title2->panel = $panel_id;

	// Change panel for Header Image
	$site_title2        = $wp_customize->get_section( 'header_image' );
	$site_title2->panel = $panel_id;

    // Change panel for Static Front Page
    $site_title3        = $wp_customize->get_section( 'static_front_page' );
    $site_title3->panel = $panel_id;

    // Change priority for Site Title
    $site_title4           = $wp_customize->get_control( 'blogname' );
    $site_title4->priority = 15;

    // Change priority for Site Tagline
    $site_title5           = $wp_customize->get_control( 'blogdescription' );
    $site_title5->priority = 17;


    /***********************************************/
    /************** GENERAL OPTIONS  ***************/
    /***********************************************/


    $wp_customize->add_panel( $panel_id,
        array(
            'priority' => 29,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Theme Options', 'regina-lite' ),
            'description' => esc_html__('You can change the site layout in this area as well as your contact details (the ones displayed in the header & footer) ', 'regina-lite'),
        )
    );

    /***********************************************/
    /************** General Site Settings  ***************/
    /***********************************************/


    // upsell - section order
	$wp_customize->add_section( $prefix . '_order_section', array(
		'title'    => __( 'Section order', 'regina-lite' ),
		'priority' => 1,
		'panel' => $panel_id
	) );

	$wp_customize->add_setting( $prefix . '_order_section', array(
		'sanitize_callback' => $prefix . '_sanitize_pro_version',
	) );

	$wp_customize->add_control( new Regina_Lite_Upsell_Render_Panel(
		$wp_customize,
		$prefix . '_order_section',
		array(
		'section' => $prefix . '_order_section',
		'choices' => array(
			'title' => __( 'Drag & Drop section re-ordering is available in the PRO version of Regina.', 'regina-lite'),
			'show_demo_button' => true,
			'show_pro_button' => true
			),
	) ) );


	// upsell - google maps
	$wp_customize->add_section( $prefix . '_maps_section', array(
		'title'    => __( 'Google Maps', 'regina-lite' ),
		'priority' => 11,
		'panel' => $panel_id
	) );

	$wp_customize->add_setting( $prefix . '_maps_section', array(
		'sanitize_callback' => $prefix . '_sanitize_pro_version',
	) );

	$wp_customize->add_control( new Regina_Lite_Upsell_Render_Panel(
		$wp_customize,
		$prefix . '_maps_section',
		array(
		'section' => $prefix . '_maps_section',
		'choices' => array(
			'title' => __( 'Unlimited Google Maps are available in the PRO version of Regina. ', 'regina-lite'),
			'show_demo_button' => true,
			'show_pro_button' => true
		),
	) ) );


    /* Logo */
    $wp_customize->add_section( $prefix.'_general_section' ,
        array(
            'title'       => esc_html__( 'Logo', 'regina-lite' ),
            'priority'    => 2,
            'panel' 	  => $panel_id
        )
    );

    /* Company text logo */
    $wp_customize->add_setting($prefix.'_text_logo',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => esc_html__('Regina Lite', 'regina-lite'),
        )
    );

    $wp_customize->add_control(
        $prefix.'_text_logo',
        array(
            'label' 		=> esc_html__('Enter company name', 'regina-lite'),
            'description'   => esc_html__('This field is best used when you don\'t have a professional image logo', 'regina-lite'),
            'section' 		=> $prefix.'_general_section',
            'priority' 		=> 2
        )
    );

    /* Company Image Logo */
    $wp_customize->add_setting( $prefix . '_img_logo', array( 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_img_logo', array(
        'label'    => __( 'Company Image Logo:', 'regina-lite' ),
        'section'  => $prefix .'_general_section',
        'settings' => $prefix . '_img_logo'
    ) ) );

    /***********************************************/
    /************** Contact Details  ***************/
    /***********************************************/

    $wp_customize->add_section( $prefix.'_general_contact_section' ,
        array(
            'title'       => esc_html__( 'Contact Details', 'regina-lite' ),
            //'description' => esc_html__( 'These are the contact details displayed in the header & footer of the website.', 'regina-lite' ),
            'priority'    => 3,
            'panel' => $panel_id
        )
    );

	/* Facebook URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_facebook_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_url('https://www.facebook.com/machothemes/')
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_facebook_url',
		array(
			'label'   => esc_html__( 'Facebook URL', 'regina-lite' ),
			'description' => esc_html__('Will be displayed in the header contact bar.', 'regina-lite'),
			'section' => $prefix.'_general_contact_section',
			'settings'   => $prefix.'_contact_bar_facebook_url',
			'priority' => 10
		)
	);

	/* Twitter URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_twitter_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_html('#')
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_twitter_url',
		array(
			'label'   => esc_html__( 'Twitter URL', 'regina-lite' ),
			'description' => esc_html__('Will be displayed in the header contact bar.', 'regina-lite'),
			'section' => $prefix.'_general_contact_section',
			'settings'   => $prefix.'_contact_bar_twitter_url',
			'priority' => 10
		)
	);

	/* YouTube URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_youtube_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_html('#')
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_youtube_url',
		array(
			'label'   => esc_html__( 'YouTube URL', 'regina-lite' ),
			'description' => esc_html__('Will be displayed in the header contact bar.', 'regina-lite'),
			'section' => $prefix.'_general_contact_section',
			'settings'   => $prefix.'_contact_bar_youtube_url',
			'priority' => 10
		)
	);

	/* LinkedIN URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_linkedin_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_html('#')
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_linkedin_url',
		array(
			'label'   => esc_html__( 'LinkedIN URL', 'regina-lite' ),
			'description' => esc_html__('Will be displayed in the header contact bar.', 'regina-lite'),
			'section' => $prefix.'_general_contact_section',
			'settings'   => $prefix.'_contact_bar_linkedin_url',
			'priority' => 10
		)
	);

	/* Instagram URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_instagram_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_html('#')
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_instagram_url',
		array(
			'label'   => esc_html__( 'Instagram URL', 'regina-lite' ),
			'description' => esc_html__('Will be displayed in the header contact bar.', 'regina-lite'),
			'section' => $prefix.'_general_contact_section',
			'settings'   => $prefix.'_contact_bar_instagram_url',
			'priority' => 10
		)
	);


	/* email */
    $wp_customize->add_setting( $prefix.'_email',
        array(
            'sanitize_callback' => 'sanitize_email',
            'default' => __( 'contact@site.com', 'regina-lite' )
        )
    );

    $wp_customize->add_control( $prefix.'_email',
        array(
            'label'   => esc_html__( 'Email address', 'regina-lite' ),
            'description' => esc_html__('Will be displayed in the header & footer contact widget.', 'regina-lite'),
            'section' => $prefix.'_general_contact_section',
            'settings'   => $prefix.'_email',
            'priority' => 10
        )
    );


    /* phone number */
    $wp_customize->add_setting( $prefix.'_phone',
        array(
            'sanitize_callback' => $prefix.'_sanitize_number',
            'default' => '0 332 548 954'
        )
    );

    $wp_customize->add_control( $prefix.'_phone',
        array(
            'label'   => esc_html__( 'Phone number', 'regina-lite' ),
            'description' => esc_html__('Will be displayed in the header & footer contact widget.', 'regina-lite'),
            'section' => $prefix.'_general_contact_section',
            'settings'   => $prefix.'_phone',
            'priority' => 12
        )
    );

    /* Book Appointment URL */
    $wp_customize->add_setting( $prefix.'_contact_bar_bookappointmenturl',
        array(
            'sanitize_callback' => 'esc_url',
            'default' => '#'
        )
    );

    $wp_customize->add_control( $prefix.'_contact_bar_bookappointmenturl',
        array(
            'label'   => esc_html__( 'Book Appointment URL:', 'regina-lite' ),
            'description' => esc_html__('Enter the URL you want to use for the book appointment button.', 'regina-lite'),
            'section' => $prefix.'_general_contact_section',
            'settings'   => $prefix.'_contact_bar_bookappointmenturl',
            'priority' => 13
        )
    );

    /***********************************************/
    /************** Footer Details  ***************/
    /***********************************************/
    $wp_customize->add_section( $prefix.'_general_footer_section' ,
        array(
            'title'       => esc_html__( 'Footer Details', 'regina-lite' ),
            'description' => esc_html__( 'Change the footer copyright message from here. Note: no HTML allowed.', 'regina-lite'),
            'priority'    => 4,
            'panel' => $panel_id
        )
    );

    # Footer Copyright: Checkbox
    $wp_customize->add_setting( $prefix.'_footer_theme_copyright_enable',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );

    $wp_customize->add_control(
        $prefix.'_footer_theme_copyright_enable',
        array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Enable footer theme copyright message', 'regina-lite' ),
            'description' => esc_html__( 'This will display the theme name with a back-link to the site of the theme developers. Leave it if you wish to give credit where it\'s due', 'regina-lite' ),
            'section'   => $prefix.'_general_footer_section',
            'settings'   => $prefix.'_footer_theme_copyright_enable',
            'priority' => 10
        )
    );

    # Footer Copyrigt: Message
    $wp_customize->add_setting( $prefix.'_footer_copyright',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => esc_html__( '&copy; Copyright 2016. All Rights Reserved.', 'regina-lite' )
        )
    );

    $wp_customize->add_control(
	    $prefix.'_footer_copyright',
	        array(
	            'type'  => 'textarea',
	            'label'   => esc_html__( 'Footer Copyright.', 'regina-lite' ),
	            'description' => esc_html__('Will be displayed in the footer', 'regina-lite'),
	            'section' => $prefix.'_general_footer_section',
	            'settings'   => $prefix.'_footer_copyright',
	            'priority' => 11
	        )
    );
