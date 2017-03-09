<?php

    // Set Panel ID
    $panel_id = 'regina_lite_panel_blog';

    // Set prefix
    $prefix = 'regina_lite';

    /***********************************************/
    /************** BLOG OPTIONS  ***************/
    /***********************************************/


    $wp_customize->add_panel( $panel_id,
        array(
            'priority' => 57,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Single Post Options', 'regina-lite' ),
            'description' => esc_html__( 'Control various blog options from here. Most of the options from this panel refer to the blog single page view. If you\'re not familiar with that term, please perform a Google search.', 'regina-lite' ),
        )
    );

    /***********************************************/
    /************** Global Blog Settings  ***************/
    /***********************************************/

    $wp_customize->add_section( $prefix.'_blog_global_section' ,
        array(
            'title'       => esc_html__( 'Global', 'regina-lite' ),
            'description' => esc_html__( 'This section allows you to control how certain elements are displayed on the blog single page.', 'regina-lite' ),
            'panel' 	  => $panel_id
        )
    );

    /* Posted on on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_post_posted_on_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_post_posted_on_blog_posts',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Posted on meta on single blog post', 'regina-lite'),
            'description' => esc_html__('This will disable the posted on zone as well as the author name', 'regina-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );

    /* Post Category on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_post_category_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_post_category_blog_posts',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Category meta on single blog post', 'regina-lite'),
            'description' => esc_html__('This will disable the posted in zone.', 'regina-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );

    /* Post Tags on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_post_tags_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_post_tags_blog_posts',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Tags meta on single blog post', 'regina-lite'),
            'description' => esc_html__('This will disable the tagged with zone.', 'regina-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );

    /* Breadcrumbs on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_post_breadcrumbs',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );

    $wp_customize->add_control(
        $prefix.'_enable_post_breadcrumbs',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Breadcrumbs on single blog posts', 'regina-lite'),
            'description' => esc_html__('This will disable the breadcrumbs', 'regina-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );


    /* Author Info Box on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_author_box_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_author_box_blog_posts',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Author info box on single blog post', 'regina-lite'),
            'description' => esc_html__('Displayed right at the end of the post', 'regina-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );

    /*  related posts carousel */
    $wp_customize->add_setting( $prefix.'_enable_related_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_related_blog_posts',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Related posts carousel ?', 'regina-lite'),
            'description' => esc_html__('Displayed after the author box', 'regina-lite'),
            'section' => $prefix.'_blog_global_section',
        )
    );

    /***********************************************/
    /************** Breadcrumb Settings  ***************/
    /***********************************************/

    $wp_customize->add_section( $prefix.'_blog_breadcrumb_section' ,
        array(
            'title'       => esc_html__( 'Breadcrumbs', 'regina-lite' ),
            'description' => esc_html__( 'Various breadcrumb related settings, like: breadcrumb prefix, breadcrumb item separator & breadcrumb menu post category visibility setting.', 'regina-lite'),
            'panel' 	  => $panel_id
        )
    );

    /* BreadCrumb Menu:  post category */
    $wp_customize->add_setting($prefix.'_blog_breadcrumb_menu_post_category',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 0
        )
    );
    $wp_customize->add_control(
        $prefix.'_blog_breadcrumb_menu_post_category',
	        array(
	            'type' => 'checkbox',
	            'label' => esc_html__('Show post category ?', 'regina-lite'),
	            'description' => esc_html__('Show the post category in the breadcrumb ?', 'regina-lite'),
	            'section' => $prefix.'_blog_breadcrumb_section',
	        )
    );


    /***********************************************/
    /************** Related Blog Settings  ***************/
    /***********************************************/

    $wp_customize->add_section( $prefix.'_blog_related_section' ,
        array(
            'title'       => esc_html__( 'Related posts', 'regina-lite' ),
            'description' => esc_html__( 'Control various related posts settings from here. For a demo-like experience, we recommend you don\'t change these settings.', 'regina-lite'),
            'panel'       => $panel_id
        )
    );


    /*  related posts title */
    $wp_customize->add_setting( $prefix.'_enable_related_title_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_related_title_blog_posts',
            array(
                'type'  => 'checkbox',
                'label' => esc_html__('Show posts title in the carousel?', 'regina-lite'),
                'section' => $prefix.'_blog_related_section',
            )
    );

    /*  related posts date */
    $wp_customize->add_setting( $prefix.'_enable_related_date_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_related_date_blog_posts',
            array(
                'type'  => 'checkbox',
                'label' => esc_html__('Show posts date  ?', 'regina-lite'),
                'section' => $prefix.'_blog_related_section',
            )
    );


    /* Auto play carousel */
    $wp_customize->add_setting( $prefix.'_autoplay_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1,
        )
    );
    $wp_customize->add_control(
        $prefix.'_autoplay_blog_posts',
            array(
                'type'  => 'checkbox',
                'label' => esc_html__('Autoplay related carousel ?', 'regina-lite'),
                'section' => $prefix.'_blog_related_section',
            )
    );

    /* Number of related posts to display at once  */
    $wp_customize->add_setting( $prefix.'_howmany_blog_posts',
        array(
            'sanitize_callback' => 'absint',
            'default' => 3
        )
    );
    $wp_customize->add_control( new Regina_lite_Controls_Slider_Control($wp_customize,
        $prefix.'_howmany_blog_posts',
            array(
                'type' => 'slider-selector',
                'label' => esc_html__('How many blog posts to display in the carousel at once ?', 'regina-lite'),
                'description' => esc_html__('No more than 4 posts at once;', 'regina-lite'),
                'choices' => array(
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                ),
                'section' => $prefix.'_blog_related_section',
                'default' => 3
            )
        )
    );

    /* Display pagination ?  */
    $wp_customize->add_setting( $prefix.'_pagination_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 0
        )
    );
    $wp_customize->add_control(
            $prefix.'_pagination_blog_posts',
            array(
                'type'  => 'checkbox',
                'label' => esc_html__('Display pagination controls ?', 'regina-lite'),
                'description' => esc_html__('Will be displayed as navigation bullets', 'regina-lite'),
                'section' => $prefix.'_blog_related_section',
            )
    );
