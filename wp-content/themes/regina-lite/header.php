<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- HTML5 Shiv -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/layout/js/plugins/html5shiv/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'mtl_before_header' ); ?>
<header id="header">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-sm-12">
				<div id="logo">
					<?php
					$img_logo  = get_theme_mod( 'regina_lite_img_logo' );
					$text_logo = get_theme_mod( 'regina_lite_text_logo', __( 'Regina Lite', 'regina-lite' ) );
					?>
					<a href="<?php echo esc_url( get_site_url() ); ?>" title="<?php echo esc_attr( $text_logo ); ?>">
						<?php if ( $img_logo ): ?>
							<img src="<?php echo esc_url( $img_logo ); ?>" alt="<?php esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php esc_attr( get_bloginfo( 'name' ) ); ?>" />
						<?php else: ?>
							<span class="logo-title"><?php echo esc_html( $text_logo ); ?></span>
						<?php endif; ?>
					</a>
				</div><!--#logo-->
				<button class="mobile-nav-btn hidden-lg"><span class="nc-icon-glyph ui-2_menu-bold"></span></button>
			</div><!--.col-lg-3-->
			<div class="col-lg-9 col-sm-12">
				<nav id="navigation">
					<ul class="main-menu">
						<?php
						wp_nav_menu( array(
							'theme_location'  => 'primary',
							'menu'            => '',
							'container'       => '',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => '',
							'menu_id'         => '',
							'items_wrap'      => '%3$s',
							'walker'          => new MTL_Extended_Menu_Walker(),
							'fallback_cb'     => 'MTL_Extended_Menu_Walker::fallback',
						) );
						?>
						<?php
						$book_appointment_button_label = get_theme_mod( 'regina_lite_book_appointment_button_label', __( 'Book Appointment', 'regina-lite' ) );
						$book_appointment_url          = get_theme_mod( 'regina_lite_contact_bar_bookappointmenturl', '#' );
						?>
						<?php if ( ! empty( $book_appointment_url ) ) { ?>
							<li class="hide-mobile">
								<a href="<?php echo $book_appointment_url; ?>" title="<?php echo esc_attr( $book_appointment_button_label ) ?>">
									<span class="nc-icon-glyph ui-1_bell-53"></span>
									<?php echo esc_attr( $book_appointment_button_label ); ?>
								</a></li>
						<?php } ?>
					</ul>
					<div class="nav-search-box hidden-xs hidden-sm hidden-md hidden-lg">
						<input type="text" placeholder="<?php _e( 'Search', 'regina-lite' ); ?>">
						<button class="search-btn"><span class="nc-icon-outline ui-1_zoom"></span></button>
					</div>
				</nav><!--#navigation-->
			</div><!--.col-lg-9-->
		</div><!--.row-->
	</div><!--.container-->
</header><!--#header-->

<?php
global $wp_customize;
$preloader_enabled = get_theme_mod( 'regina_lite_enable_site_preloader', 1 );

if ( ! isset( $wp_customize ) && $preloader_enabled == 1 ) { ?>

	<!-- Site Preloader -->
	<div id="page-loader">
		<div class="page-loader-inner">
			<div class="loader"></div>
		</div>
	</div>
	<!-- END Site Preloader -->
<?php } ?>
