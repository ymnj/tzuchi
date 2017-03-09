<?php


function regina_lite_customize_register( $wp_customize ) {

	$prefix = 'regina_lite';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';


	/**********************************************/
	/*************** INIT ************************/
	/**********************************************/

	# Include Custom Controls
	require get_template_directory() . '/inc/customizer/custom-controls/pro-controls-selector.php';
	require get_template_directory() . '/inc/customizer/custom-controls/radio-img-selector.php';
	require get_template_directory() . '/inc/customizer/custom-controls/slider-selector.php';

	#
	# Main Upsell features
	#

	$wp_customize->add_section( $prefix . '_custom_icons', array(
		'title'    => __( 'Custom Icons', 'regina-lite' ),
		'priority' => 202,
		'panel' => 'regina_lite_features_panel'
	) );

	$wp_customize->add_setting( $prefix . '_custom_icons', array(
		'sanitize_callback' => $prefix . '_sanitize_pro_version',
	) );

	$wp_customize->add_control( new Regina_Lite_Upsell_Render_Panel(
			$wp_customize,
			$prefix . '_custom_icons',
			array(
				'section' => $prefix . '_custom_icons',
				'choices' => array(
					'title' => __( 'Regina PRO comes bundled with over 700 premium icons. You can also upload your own custom icons.', 'regina-lite'),
					'show_demo_button' => true,
					'show_pro_button' => true
				),
			)
		)
	);


	$wp_customize->add_section( $prefix . '_color_controls', array(
		'title'    => __( 'Color Controls', 'regina-lite' ),
		'priority' => 0,
		'panel' => 'regina_lite_panel_general'
	) );

	$wp_customize->add_setting( $prefix . '_color_controls', array(
		'sanitize_callback' => $prefix . '_sanitize_pro_version',
	) );

	$wp_customize->add_control( new Regina_Lite_Upsell_Render_Panel(
			$wp_customize,
			$prefix . '_color_controls',
			array(
				'section' => $prefix . '_color_controls',
				'choices' => array(
					'title' => __( 'Color controls are available in the PRO version of Regina. Make it look the way you want to.', 'regina-lite'),
					'show_demo_button' => true,
					'show_pro_button' => true
				),
			)
		)
	);



	$wp_customize->add_section( $prefix . '_dropdown_menus', array(
		'title'    => __( 'Dropdown Menus', 'regina-lite' ),
		'priority' => 202,
		'panel' => 'nav_menus'
	) );

	$wp_customize->add_setting( $prefix . '_dropdown_menus', array(
		'sanitize_callback' => $prefix . '_sanitize_pro_version',
	) );

	$wp_customize->add_control( new Regina_Lite_Upsell_Render_Panel(
			$wp_customize,
			$prefix . '_dropdown_menus',
			array(
				'section' => $prefix . '_dropdown_menus',
				'choices' => array(
					'title' => __( 'Regina PRO supports 3rd level drop-down menus. It also comes bundled with 3 different header layouts.', 'regina-lite'),
					'show_demo_button' => true,
					'show_pro_button' => true
				),
			)
		)
	);







	#
	# END Up Sell Features
	#

	/* General Site Panel */
	require_once get_template_directory() . '/inc/customizer/panels/site.php';

	/* Features Panel */
	require_once get_template_directory() . '/inc/customizer/panels/features.php';

	/* Blog Panel */
	require_once get_template_directory() . '/inc/customizer/panels/blog.php';

	/* Advanced Panel */
	require_once get_template_directory() . '/inc/customizer/panels/advanced.php';

	/* Our Team Panel */
	require_once get_template_directory() . '/inc/customizer/panels/our-team.php';

	/* Testimonials Panel */
	require_once get_template_directory() . '/inc/customizer/panels/testimonials.php';

	/* Speak Panel */
	require_once get_template_directory() . '/inc/customizer/panels/speak.php';

	/* Latest News */
	require_once get_template_directory() . '/inc/customizer/panels/news.php';

}

add_action( 'customize_register', 'regina_lite_customize_register' );

if ( ! function_exists( 'regina_lite_sanitize_number' ) ) {
	/**
	 * Simple function used to sanitize numbers
	 *
	 * @param $input
	 *
	 * @return mixed
	 */
	function regina_lite_sanitize_number( $input ) {
		return force_balance_tags( $input );
	}
}

if ( ! function_exists( 'regina_lite_sanitize_file_url' ) ) {
	/**
	 * Function to sanitize file URLS
	 *
	 * Used mostly for sanitizing image field types
	 *
	 * @param $url
	 *
	 * @return string
	 */
	function regina_lite_sanitize_file_url( $url ) {

		$output = '';

		$filetype = wp_check_filetype( $url );
		if ( $filetype["ext"] ) {
			$output = esc_url( $url );
		}

		return $output;
	}
}


if ( ! function_exists( 'regina_lite_sanitize_radio_buttons' ) ) {
	/**
	 * Simple function to validate choices from radio buttons
	 *
	 * @param $input
	 *
	 * @return string
	 */
	function regina_lite_sanitize_radio_buttons( $input, $setting ) {

		global $wp_customize;

		$control = $wp_customize->get_control( $setting->id );

		if ( array_key_exists( $input, $control->choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
}

if ( ! function_exists( 'regina_lite_sanitize_checkbox' ) ) {
	/**
	 * Function to sanitize checkboxes
	 *
	 * @param $value
	 *
	 * @return int
	 */
	function regina_lite_sanitize_checkbox( $value ) {
		if ( $value == 1 ) {
			return 1;
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'regina_lite_sanitize_pro_version' ) ) {

	function regina_lite_sanitize_pro_version( $input ) {
		return force_balance_tags( $input );
	}
}

if ( ! function_exists( 'regina_lite_customizer_js_load' ) ) {
	/**
	 * Function to load JS into the customizer
	 */
	function regina_lite_customizer_js_load() {

		// Customizer JS
		wp_enqueue_script( 'rl-customizer-script', get_template_directory_uri() . '/inc/customizer/assets/js/customizer.js', array(
			'jquery',
			'customize-controls',
		), '1.0', true );

		add_action( 'customize_controls_enqueue_scripts', 'regina_lite_customizer_js_load' );
	}
}

if ( ! function_exists( 'regina_lite_customizer_preview_js' ) ) {
	/**
	 * Function to load JS into the customizer preview
	 */
	function regina_lite_customizer_preview_js() {
		// Customizer preview JS
		wp_enqueue_script( 'rl-customizer-script', get_template_directory_uri() . '/inc/customizer/assets/js/customizer.js', array( 'customize-preview' ), '1.0', true );
		wp_enqueue_script( 'regina-lite-upsell', get_template_directory_uri() . '/inc/customizer/assets/js/upsell/upsell.js', array( 'jquery' ), '1.0', true );
	}

	add_action( 'customize_preview_init', 'regina_lite_customizer_preview_js' );
}


if ( ! function_exists( 'regina_lite_customizer_css_load' ) ) {
	/**
	 * Function to load CSS into the customizer
	 */
	function regina_lite_customizer_css_load() {
		wp_enqueue_style( 'mt-customizer-css', get_template_directory_uri() . '/inc/customizer/assets/css/pro/pro-version.css' );

	}

	add_action( 'customize_controls_print_styles', 'regina_lite_customizer_css_load' );
}
