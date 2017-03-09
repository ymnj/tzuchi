<?php
/**
 *  The template for dispalying the Our Team on Home page.
 *
 * @package    WordPress
 * @subpackage regina-lite
 */
?>
<?php
// Get Theme Mod for Our Team Panel
$ourteam_general_title           = get_theme_mod( 'regina_lite_ourteam_general_title', __( 'Our team can help you!', 'regina-lite' ) );
$ourteam_general_description     = get_theme_mod( 'regina_lite_ourteam_general_description', __( 'We offer various services lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ) );
$ourteam_teammember1_image       = get_theme_mod( 'regina_lite_ourteam_teammember1_image', get_template_directory_uri() . '/layout/images/team/team-member-1.jpg' );
$ourteam_teammember1_name        = get_theme_mod( 'regina_lite_ourteam_teammember1_name', __( 'Dr. Steve Leeson', 'regina-lite' ) );
$ourteam_teammember1_position    = get_theme_mod( 'regina_lite_ourteam_teammember1_position', __( 'Cardiac Clinic, Primary Healthcare', 'regina-lite' ) );
$ourteam_teammember1_description = get_theme_mod( 'regina_lite_ourteam_teammember1_description', __( 'Dr. Steve Leeson was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...', 'regina-lite' ) );
$ourteam_teammember1_buttonurl   = get_theme_mod( 'regina_lite_ourteam_teammember1_buttonurl', '#' );
$ourteam_teammember2_image       = get_theme_mod( 'regina_lite_ourteam_teammember2_image', get_template_directory_uri() . '/layout/images/team/team-member-2.jpg' );
$ourteam_teammember2_name        = get_theme_mod( 'regina_lite_ourteam_teammember2_name', __( 'Dr. Amanda Riss', 'regina-lite' ) );
$ourteam_teammember2_position    = get_theme_mod( 'regina_lite_ourteam_teammember2_position', __( 'Cardiac Clinic, Primary Healthcare', 'regina-lite' ) );
$ourteam_teammember2_description = get_theme_mod( 'regina_lite_ourteam_teammember2_description', __( 'Dr. Amanda Riss was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...', 'regina-lite' ) );
$ourteam_teammember2_buttonurl   = get_theme_mod( 'regina_lite_ourteam_teammember2_buttonurl', '#' );
$ourteam_teammember3_image       = get_theme_mod( 'regina_lite_ourteam_teammember3_image', get_template_directory_uri() . '/layout/images/team/team-member-3.jpg' );
$ourteam_teammember3_name        = get_theme_mod( 'regina_lite_ourteam_teammember3_name', __( 'Dr. Mick Harold', 'regina-lite' ) );
$ourteam_teammember3_position    = get_theme_mod( 'regina_lite_ourteam_teammember3_position', __( 'Cardiac Clinic, Primary Healthcare', 'regina-lite' ) );
$ourteam_teammember3_description = get_theme_mod( 'regina_lite_ourteam_teammember3_description', __( 'Dr. Mick Harold was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...', 'regina-lite' ) );
$ourteam_teammember3_buttonurl   = get_theme_mod( 'regina_lite_ourteam_teammember3_buttonurl', '#' );
$ourteam_teammember4_image       = get_theme_mod( 'regina_lite_ourteam_teammember4_image', get_template_directory_uri() . '/layout/images/team/team-member-4.jpg' );
$ourteam_teammember4_name        = get_theme_mod( 'regina_lite_ourteam_teammember4_name', __( 'Dr. Jenna Crew', 'regina-lite' ) );
$ourteam_teammember4_position    = get_theme_mod( 'regina_lite_ourteam_teammember4_position', __( 'Cardiac Clinic, Primary Healthcare', 'regina-lite' ) );
$ourteam_teammember4_description = get_theme_mod( 'regina_lite_ourteam_teammember4_description', __( 'Dr. Jenna Crew was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...', 'regina-lite' ) );
$ourteam_teammember4_buttonurl   = get_theme_mod( 'regina_lite_ourteam_teammember4_buttonurl', '#' );

$ourteam_teammembers = array(
	$ourteam_teammember1_image,
	$ourteam_teammember2_image,
	$ourteam_teammember3_image,
	$ourteam_teammember4_image,
);


foreach ( $ourteam_teammembers as $key => $ourteam_teammember ):
	if ( $ourteam_teammember ):
		$ourteam_members[] = $ourteam_teammember;
	endif;
endforeach;

if ( count( $ourteam_members ) == 1 ):
	$team_member_class = 'col-lg-12 col-sm-6';
elseif ( count( $ourteam_members ) == 2 ):
	$team_member_class = 'col-lg-6 col-sm-6';
elseif ( count( $ourteam_members ) == 3 ):
	$team_member_class = 'col-lg-4 col-sm-6';
elseif ( count( $ourteam_members ) == 4 ):
	$team_member_class = 'col-lg-3 col-sm-6';
endif;

// Image Meta
$image_id_1 = regina_lite_get_attachment_id( $ourteam_teammember1_image );
	// get image meta by ID
	$image_meta_1 = get_post_meta( $image_id_1 );

$image_id_2 = regina_lite_get_attachment_id( $ourteam_teammember2_image );
	// get image meta by ID
	$image_meta_2 = get_post_meta( $image_id_2 );

$image_id_3 = regina_lite_get_attachment_id( $ourteam_teammember3_image );
	// get image meta by ID
	$image_meta_3 = get_post_meta( $image_id_3 );

$image_id_4 = regina_lite_get_attachment_id( $ourteam_teammember4_image );
	// get image meta by ID
	$image_meta_4 = get_post_meta( $image_id_4 );


?>
<div class="clear"></div>
<div id="team-section-block" class="bg-block">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="section-info">
					<?php if ( $ourteam_general_title ): ?>
						<h2><?php echo esc_html( $ourteam_general_title ); ?></h2>
						<hr>
					<?php endif; ?>
					<?php if ( $ourteam_general_description ): ?>
						<p><?php echo esc_html( $ourteam_general_description ); ?></p>
					<?php endif; ?>
				</div><!--.section-info-->
			</div><!--.col-xs-12-->
			<section id="team-block">
				<?php if ( $ourteam_teammember1_image ): ?>
					<div class="<?php echo $team_member_class; ?>">
						<div class="team-member">
							<?php if ( $ourteam_teammember1_image ): ?>
								<img src="<?php echo esc_url( $ourteam_teammember1_image ); ?>" data-original="<?php echo esc_url( $ourteam_teammember1_image ); ?>" alt="<?php echo esc_attr( $image_meta_1['_wp_attachment_image_alt']['0'] ); ?>" class="lazy">
							<?php endif; ?>
							<?php if ( $ourteam_teammember1_name || $ourteam_teammember1_position ): ?>
								<div class="inner">
									<?php if ( $ourteam_teammember1_name ): ?>
										<h4 class="name"><?php echo esc_html( $ourteam_teammember1_name ); ?></h4>
									<?php endif; ?>
									<?php if ( $ourteam_teammember1_position ): ?>
										<p class="position">
											<small><?php echo esc_html( $ourteam_teammember1_position ); ?></small>
										</p>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ( $ourteam_teammember1_description || $ourteam_teammember1_buttonurl ): ?>
								<div class="hover">
									<?php if ( $ourteam_teammember1_description ): ?>
										<div class="description">
											<p><?php echo esc_html( $ourteam_teammember1_description ); ?></p>
										</div>
									<?php endif; ?>
									<?php if ( $ourteam_teammember1_buttonurl ): ?>
										<div class="read-more">
											<a href="<?php echo esc_url( $ourteam_teammember1_buttonurl ); ?>" class="button white outline"><?php _e( 'Read more', 'regina-lite' ); ?>
												<span class="nc-icon-glyph arrows-1_bold-right"></span></a>
										</div>
									<?php endif; ?>
								</div><!--.hover-->
							<?php endif; ?>
						</div><!--.team-member-->
					</div><!--.col-lg-3-->
				<?php endif; ?>
				<?php if ( $ourteam_teammember2_image ): ?>
					<div class="<?php echo $team_member_class; ?>">
						<div class="team-member">
							<?php if ( $ourteam_teammember2_image ): ?>
								<img src="<?php echo esc_url( $ourteam_teammember2_image ); ?>" data-original="<?php echo esc_url( $ourteam_teammember2_image ); ?>" alt="<?php echo esc_attr( $image_meta_2['_wp_attachment_image_alt']['0'] ); ?>" class="lazy">
							<?php endif; ?>
							<?php if ( $ourteam_teammember2_name || $ourteam_teammember2_position ): ?>
								<div class="inner">
									<?php if ( $ourteam_teammember2_name ): ?>
										<h4 class="name"><?php echo esc_html( $ourteam_teammember2_name ); ?></h4>
									<?php endif; ?>
									<?php if ( $ourteam_teammember2_position ): ?>
										<p class="position">
											<small><?php echo esc_html( $ourteam_teammember2_position ); ?></small>
										</p>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ( $ourteam_teammember2_description || $ourteam_teammember2_buttonurl ): ?>
								<div class="hover">
									<?php if ( $ourteam_teammember2_description ): ?>
										<div class="description">
											<p><?php echo esc_html( $ourteam_teammember2_description ); ?></p>
										</div>
									<?php endif; ?>
									<?php if ( $ourteam_teammember2_buttonurl ): ?>
										<div class="read-more">
											<a href="<?php echo esc_url( $ourteam_teammember2_buttonurl ); ?>" class="button white outline"><?php _e( 'Read more', 'regina-lite' ); ?>
												<span class="nc-icon-glyph arrows-1_bold-right"></span></a>
										</div>
									<?php endif; ?>
								</div><!--.hover-->
							<?php endif; ?>
						</div><!--.team-member-->
					</div><!--.col-lg-3-->
				<?php endif; ?>
				<?php if ( $ourteam_teammember3_image ): ?>
					<div class="<?php echo $team_member_class; ?>">
						<div class="team-member">
							<?php if ( $ourteam_teammember3_image ): ?>
								<img src="<?php echo esc_url( $ourteam_teammember3_image ); ?>" data-original="<?php echo esc_url( $ourteam_teammember3_image ); ?>" alt="<?php echo esc_attr( $image_meta_3['_wp_attachment_image_alt']['0'] ); ?>" class="lazy">
							<?php endif; ?>
							<?php if ( $ourteam_teammember3_name || $ourteam_teammember3_position ): ?>
								<div class="inner">
									<?php if ( $ourteam_teammember3_name ): ?>
										<h4 class="name"><?php echo esc_html( $ourteam_teammember3_name ); ?></h4>
									<?php endif; ?>
									<?php if ( $ourteam_teammember3_position ): ?>
										<p class="position">
											<small><?php echo esc_html( $ourteam_teammember3_position ); ?></small>
										</p>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ( $ourteam_teammember3_description || $ourteam_teammember3_buttonurl ): ?>
								<div class="hover">
									<?php if ( $ourteam_teammember3_description ): ?>
										<div class="description">
											<p><?php echo esc_html( $ourteam_teammember3_description ); ?></p>
										</div>
									<?php endif; ?>
									<?php if ( $ourteam_teammember3_buttonurl ): ?>
										<div class="read-more">
											<a href="<?php echo esc_url( $ourteam_teammember3_buttonurl ); ?>" class="button white outline"><?php _e( 'Read more', 'regina-lite' ); ?>
												<span class="nc-icon-glyph arrows-1_bold-right"></span></a>
										</div>
									<?php endif; ?>
								</div><!--.hover-->
							<?php endif; ?>
						</div><!--.team-member-->
					</div><!--.col-lg-3-->
				<?php endif; ?>
				<?php if ( $ourteam_teammember4_image ): ?>
					<div class="<?php echo $team_member_class; ?>">
						<div class="team-member">
							<?php if ( $ourteam_teammember4_image ): ?>
								<img src="<?php echo esc_url( $ourteam_teammember4_image ); ?>" data-original="<?php echo esc_url( $ourteam_teammember4_image ); ?>" alt="<?php echo esc_attr( $image_meta_4['_wp_attachment_image_alt']['0'] ); ?>"  class="lazy">
							<?php endif; ?>
							<?php if ( $ourteam_teammember4_name || $ourteam_teammember4_position ): ?>
								<div class="inner">
									<?php if ( $ourteam_teammember4_name ): ?>
										<h4 class="name"><?php echo esc_html( $ourteam_teammember4_name ); ?></h4>
									<?php endif; ?>
									<?php if ( $ourteam_teammember4_position ): ?>
										<p class="position">
											<small><?php echo esc_html( $ourteam_teammember4_position ); ?></small>
										</p>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ( $ourteam_teammember4_description || $ourteam_teammember4_buttonurl ): ?>
								<div class="hover">
									<?php if ( $ourteam_teammember4_description ): ?>
										<div class="description">
											<p><?php echo esc_html( $ourteam_teammember4_description ); ?></p>
										</div>
									<?php endif; ?>
									<?php if ( $ourteam_teammember4_buttonurl ): ?>
										<div class="read-more">
											<a href="<?php echo esc_url( $ourteam_teammember4_buttonurl ); ?>" class="button white outline"><?php _e( 'Read more', 'regina-lite' ); ?>
												<span class="nc-icon-glyph arrows-1_bold-right"></span></a>
										</div>
									<?php endif; ?>
								</div><!--.hover-->
							<?php endif; ?>
						</div><!--.team-member-->
					</div><!--.col-lg-3-->
				<?php endif; ?>
			</section><!--#team-block-->
		</div><!--.row-->
	</div><!--.container-->
</div><!--.bg-block-->