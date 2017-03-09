<?php
// Get Theme Mod for Speak Panel
$speak_general_title           = get_theme_mod( 'regina_lite_speak_general_title', __( 'Speak with our doctors', 'regina-lite' ) );
$speak_general_description     = get_theme_mod( 'regina_lite_speak_general_description', __( 'We offer various services lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ) );
$speak_general_buttonurl       = get_theme_mod( 'regina_lite_speak_general_buttonurl', '#' );
$book_appointment_button_label = get_theme_mod( 'regina_lite_book_appointment_button_label', __( 'Book Appointment', 'regina-lite' ) );
?>

<section id="speak-with-our-doctors" class="bg-block">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="section-info">
					<?php if ( $speak_general_title ): ?>
						<h2><?php echo esc_html( $speak_general_title ); ?></h2>
						<hr>
					<?php endif; ?>
					<?php if ( $speak_general_description ): ?>
						<p><?php echo esc_html( $speak_general_description ); ?></p>
					<?php endif; ?>
					<br>
					<?php if ( $speak_general_buttonurl ): ?>
						<a href="<?php echo esc_url( $speak_general_buttonurl ); ?>" class="button" title="<?php echo esc_attr( $book_appointment_button_label ); ?>"><?php echo esc_attr( $book_appointment_button_label ); ?>
							<span class="nc-icon-glyph arrows-1_bold-right"></span></a>
					<?php endif; ?>
				</div><!--.section-info-->
			</div><!--.col-xs-12-->
		</div><!--.row-->
	</div><!--.container-->
</section>