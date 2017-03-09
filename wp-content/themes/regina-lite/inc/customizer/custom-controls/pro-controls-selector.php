<?php

/**
 * Class used to render "PRO panels"
 */
if ( ! class_exists( 'Regina_Lite_Upsell_Render_Panel' ) ) {

	class Regina_Lite_Upsell_Render_Panel extends WP_Customize_Control {

		public function render_content() {

			if ( $this->choices ) {

				echo '<div class="text-center">';

				foreach ( $this->choices as $key => $value ) {

					switch ( $key ) {

						case 'title':
							echo '<div class="pro-version-text">' . esc_attr( $value ) . '</div>';
							echo '<hr />';
						break;

						case 'show_pro_button':
							if ( $value == true ) {
								echo '<a href="https://www.machothemes.com/themes/regina-pro/" target="_blank" class="button button-primary regina-lite-upgrade">' . __( 'Get Pro', 'regina-lite' ) . '</a>';
							}
							break;

						case 'show_demo_button':
							if ( $value == true ) {
								echo '<a href="http://www.machothemes.com/demo/#Regina" target="_blank" class="button button-secondary regina-lite-upgrade">' . __( 'See live demo', 'regina-lite' ) . '</a>';
							}
						break;
					}

				} // foreach

				echo '</div><!--/.text-center-->';

			} // $this->choices
		} // function
	} // class
} // class exists