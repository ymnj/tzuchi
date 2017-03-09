<?php
/**
 *  The template for dispalying the Testimonials on Home page.
 *
 * @package    WordPress
 * @subpackage regina-lite
 */
?>
<?php
// Get Theme Mod for Testimonials Panel
$testimonials_general_image1           = get_theme_mod( 'regina_lite_testimonials_general_image1', get_template_directory_uri() . '/layout/images/home/testimonial-1.jpg' );
$testimonials_general_image2           = get_theme_mod( 'regina_lite_testimonials_general_image2', get_template_directory_uri() . '/layout/images/home/testimonial-2.jpg' );
$testimonials_general_image3           = get_theme_mod( 'regina_lite_testimonials_general_image3', get_template_directory_uri() . '/layout/images/home/testimonial-3.jpg' );
$testimonials_general_image4           = get_theme_mod( 'regina_lite_testimonials_general_image4', get_template_directory_uri() . '/layout/images/home/testimonial-4.jpg' );
$testimonials_testimonial1_description = get_theme_mod( 'regina_lite_testimonials_testimonial1_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ) );
$testimonials_testimonial1_image       = get_theme_mod( 'regina_lite_testimonials_testimonial1_image', get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' );
$testimonials_testimonial1_name        = get_theme_mod( 'regina_lite_testimonials_testimonial1_name', __( 'Jenny Royal', 'regina-lite' ) );
$testimonials_testimonial1_position    = get_theme_mod( 'regina_lite_testimonials_testimonial1_position', __( 'Manager @ REQ', 'regina-lite' ) );
$testimonials_testimonial2_description = get_theme_mod( 'regina_lite_testimonials_testimonial2_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ) );
$testimonials_testimonial2_image       = get_theme_mod( 'regina_lite_testimonials_testimonial2_image', get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' );
$testimonials_testimonial2_name        = get_theme_mod( 'regina_lite_testimonials_testimonial2_name', __( 'Jenny Royal', 'regina-lite' ) );
$testimonials_testimonial2_position    = get_theme_mod( 'regina_lite_testimonials_testimonial2_position', __( 'Manager @ REQ', 'regina-lite' ) );
$testimonials_testimonial3_description = get_theme_mod( 'regina_lite_testimonials_testimonial3_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ) );
$testimonials_testimonial3_image       = get_theme_mod( 'regina_lite_testimonials_testimonial3_image', get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' );
$testimonials_testimonial3_name        = get_theme_mod( 'regina_lite_testimonials_testimonial3_name', __( 'Jenny Royal', 'regina-lite' ) );
$testimonials_testimonial3_position    = get_theme_mod( 'regina_lite_testimonials_testimonial3_position', __( 'Manager @ REQ', 'regina-lite' ) );
$testimonials_testimonial4_description = get_theme_mod( 'regina_lite_testimonials_testimonial4_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ) );
$testimonials_testimonial4_image       = get_theme_mod( 'regina_lite_testimonials_testimonial4_image', get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' );
$testimonials_testimonial4_name        = get_theme_mod( 'regina_lite_testimonials_testimonial4_name', __( 'Jenny Royal', 'regina-lite' ) );
$testimonials_testimonial4_position    = get_theme_mod( 'regina_lite_testimonials_testimonial4_position', __( 'Manager @ REQ', 'regina-lite' ) );
$testimonials_testimonial5_description = get_theme_mod( 'regina_lite_testimonials_testimonial5_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ) );
$testimonials_testimonial5_image       = get_theme_mod( 'regina_lite_testimonials_testimonial5_image', get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' );
$testimonials_testimonial5_name        = get_theme_mod( 'regina_lite_testimonials_testimonial5_name', __( 'Jenny Royal', 'regina-lite' ) );
$testimonials_testimonial5_position    = get_theme_mod( 'regina_lite_testimonials_testimonial5_position', __( 'Manager @ REQ', 'regina-lite' ) );

$image_id_1 = regina_lite_get_attachment_id( $testimonials_testimonial1_image );
// get image meta by ID
$image_meta_1 = get_post_meta( $image_id_1 );

$image_id_2 = regina_lite_get_attachment_id( $testimonials_testimonial2_image );
// get image meta by ID
$image_meta_2 = get_post_meta( $image_id_2 );

$image_id_3 = regina_lite_get_attachment_id( $testimonials_testimonial3_image );
// get image meta by ID
$image_meta_3 = get_post_meta( $image_id_3 );

$image_id_4 = regina_lite_get_attachment_id( $testimonials_testimonial4_image );
// get image meta by ID
$image_meta_4 = get_post_meta( $image_id_4 );

$image_id_general_1 = regina_lite_get_attachment_id( $testimonials_general_image1 );
// get image meta by ID
$image_meta_general_1 = get_post_meta( $image_id_general_1 );

$image_id_general_2 = regina_lite_get_attachment_id( $testimonials_general_image2 );
// get image meta by ID
$image_meta_general_2 = get_post_meta( $image_id_general_2 );

$image_id_general_3 = regina_lite_get_attachment_id( $testimonials_general_image3 );
// get image meta by ID
$image_meta_general_3 = get_post_meta( $image_id_general_3 );

$image_id_general_4 = regina_lite_get_attachment_id( $testimonials_general_image4 );
// get image meta by ID
$image_meta_general_4 = get_post_meta( $image_id_general_4 );


?>
<section id="home-testimonials">
	<div class="testimonials">
		<span class="icon nc-icon-glyph ui-2_chat-round-content"></span>
		<div id="testimonials-slider">
			<ul class="bxslider">
				<?php if ( $testimonials_testimonial1_description || $testimonials_testimonial1_image || $testimonials_testimonial1_name || $testimonials_testimonial1_position ): ?>
					<li>
						<?php if ( $testimonials_testimonial1_description ): ?>
							<p class="quote"><?php echo esc_html( $testimonials_testimonial1_description ); ?></p>
						<?php endif; ?>
						<?php if ( $testimonials_testimonial1_image ): ?>
							<img src="<?php echo esc_url( $testimonials_testimonial1_image ); ?>" alt="<?php echo esc_attr( $image_meta_1['_wp_attachment_image_alt']['0'] ); ?>" width="90">
						<?php endif; ?>
						<?php if ( $testimonials_testimonial1_name ): ?>
							<h5 class="name"><?php echo esc_html( $testimonials_testimonial1_name ); ?></h5>
						<?php endif ?>
						<?php if ( $testimonials_testimonial1_position ): ?>
							<p class="position"><?php echo esc_html( $testimonials_testimonial1_position ); ?></p>
						<?php endif; ?>
					</li>
				<?php endif; ?>
				<?php if ( $testimonials_testimonial2_description || $testimonials_testimonial2_image || $testimonials_testimonial2_name || $testimonials_testimonial2_position ): ?>
					<li>
						<?php if ( $testimonials_testimonial2_description ): ?>
							<p class="quote"><?php echo esc_html( $testimonials_testimonial2_description ); ?></p>
						<?php endif; ?>
						<?php if ( $testimonials_testimonial2_image ): ?>
							<img src="<?php echo esc_url( $testimonials_testimonial2_image ); ?>" alt="<?php echo esc_attr( $image_meta_2['_wp_attachment_image_alt']['0'] ); ?>" width="90">
						<?php endif; ?>
						<?php if ( $testimonials_testimonial2_name ): ?>
							<h5 class="name"><?php echo esc_html( $testimonials_testimonial2_name ); ?></h5>
						<?php endif ?>
						<?php if ( $testimonials_testimonial2_position ): ?>
							<p class="position"><?php echo esc_html( $testimonials_testimonial2_position ); ?></p>
						<?php endif; ?>
					</li>
				<?php endif; ?>
				<?php if ( $testimonials_testimonial3_description || $testimonials_testimonial3_image || $testimonials_testimonial3_name || $testimonials_testimonial3_position ): ?>
					<li>
						<?php if ( $testimonials_testimonial3_description ): ?>
							<p class="quote"><?php echo esc_html( $testimonials_testimonial3_description ); ?></p>
						<?php endif; ?>
						<?php if ( $testimonials_testimonial3_image ): ?>
							<img src="<?php echo esc_url( $testimonials_testimonial3_image ); ?>" alt="<?php echo esc_attr( $image_meta_3['_wp_attachment_image_alt']['0'] ); ?>" width="90">
						<?php endif; ?>
						<?php if ( $testimonials_testimonial3_name ): ?>
							<h5 class="name"><?php echo esc_html( $testimonials_testimonial3_name ); ?></h5>
						<?php endif ?>
						<?php if ( $testimonials_testimonial3_position ): ?>
							<p class="position"><?php echo esc_html( $testimonials_testimonial3_position ); ?></p>
						<?php endif; ?>
					</li>
				<?php endif; ?>
				<?php if ( $testimonials_testimonial4_description || $testimonials_testimonial4_image || $testimonials_testimonial4_name || $testimonials_testimonial4_position ): ?>
					<li>
						<?php if ( $testimonials_testimonial4_description ): ?>
							<p class="quote"><?php echo esc_html( $testimonials_testimonial4_description ); ?></p>
						<?php endif; ?>
						<?php if ( $testimonials_testimonial4_image ): ?>
							<img src="<?php echo esc_url( $testimonials_testimonial4_image ); ?>" alt="<?php echo esc_attr( $image_meta_4['_wp_attachment_image_alt']['0'] ); ?>" width="90">
						<?php endif; ?>
						<?php if ( $testimonials_testimonial4_name ): ?>
							<h5 class="name"><?php echo esc_html( $testimonials_testimonial4_name ); ?></h5>
						<?php endif ?>
						<?php if ( $testimonials_testimonial4_position ): ?>
							<p class="position"><?php echo esc_html( $testimonials_testimonial4_position ); ?></p>
						<?php endif; ?>
					</li>
				<?php endif; ?>
				<?php if ( $testimonials_testimonial5_description || $testimonials_testimonial5_image || $testimonials_testimonial5_name || $testimonials_testimonial5_position ): ?>
					<li>
						<?php if ( $testimonials_testimonial5_description ): ?>
							<p class="quote"><?php echo esc_html( $testimonials_testimonial5_description ); ?></p>
						<?php endif; ?>
						<?php if ( $testimonials_testimonial5_image ): ?>
							<img src="<?php echo esc_url( $testimonials_testimonial5_image ); ?>" alt="<?php if ( $testimonials_testimonial5_name ): echo esc_attr( $testimonials_testimonial5_name ); endif; ?>" title="<?php if ( $testimonials_testimonial5_name ): echo esc_attr( $testimonials_testimonial5_name ); endif; ?>" width="90">
						<?php endif; ?>
						<?php if ( $testimonials_testimonial5_name ): ?>
							<h5 class="name"><?php echo esc_html( $testimonials_testimonial5_name ); ?></h5>
						<?php endif ?>
						<?php if ( $testimonials_testimonial5_position ): ?>
							<p class="position"><?php echo esc_html( $testimonials_testimonial5_position ); ?></p>
						<?php endif; ?>
					</li>
				<?php endif; ?>
			</ul>
		</div><!--#testimonials-slider-->
	</div><!--.testimonials-->
	<ul class="images">
		<?php if ( $testimonials_general_image1 ): ?>
			<li>
				<img src="<?php echo esc_url( $testimonials_general_image1 ); ?>" data-original="<?php echo esc_url( $testimonials_general_image1 ); ?>" alt="<?php echo esc_attr( $image_meta_general_1['_wp_attachment_image_alt']['0'] ); ?>" class="lazy">
			</li>
		<?php endif; ?>
		<?php if ( $testimonials_general_image2 ): ?>
			<li>
				<img src="<?php echo esc_url( $testimonials_general_image2 ); ?>" data-original="<?php echo esc_url( $testimonials_general_image2 ); ?>" alt="<?php echo esc_attr( $image_meta_general_2['_wp_attachment_image_alt']['0'] ); ?>" class="lazy">
			</li>
		<?php endif; ?>
		<?php if ( $testimonials_general_image3 ): ?>
			<li>
				<img src="<?php echo esc_url( $testimonials_general_image3 ); ?>" data-original="<?php echo esc_url( $testimonials_general_image3 ); ?>" alt="<?php echo esc_attr( $image_meta_general_3['_wp_attachment_image_alt']['0'] ); ?>" class="lazy">
			</li>
		<?php endif; ?>
		<?php if ( $testimonials_general_image4 ): ?>
			<li>
				<img src="<?php echo esc_url( $testimonials_general_image4 ); ?>" data-original="<?php echo esc_url( $testimonials_general_image4 ); ?>" alt="<?php echo esc_attr( $image_meta_general_4['_wp_attachment_image_alt']['0'] ); ?>" class="lazy">
			</li>
		<?php endif; ?>
	</ul>
	<div class="clear"></div>
</section><!--#home-testimonials-->