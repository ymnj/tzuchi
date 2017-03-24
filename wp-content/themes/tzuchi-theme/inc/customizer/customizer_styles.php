<?php


function customize_css() {
?>
	<style>
    body, .team-section {
        background-color : <?php echo get_theme_mod('site_color'); ?>
    }
		
		.navbar {
			background-color : <?php echo get_theme_mod('nav_color'); ?>
		}

		#footer, #footer .footer-nav-col {
			background-color: <?php echo get_theme_mod('footer_background_color'); ?>
		}

		.footer-nav-col, footer .footer-nav-col a {
			color: <?php echo get_theme_mod('footer_text_color'); ?>
		}

	</style>
<?php
}

add_action( 'wp_head', 'customize_css' );