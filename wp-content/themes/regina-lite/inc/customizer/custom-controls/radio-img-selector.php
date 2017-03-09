<?php


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Early exit if the class already exists
if ( class_exists( 'regina_lite_Layout_Picker_Custom_Control' ) ) {
    return;
}

class regina_lite_Layout_Picker_Custom_Control extends WP_Customize_Control {


    public function enqueue() {
        wp_enqueue_script( 'jquery-ui-button' );
        wp_enqueue_style( 'rl-radio-image', get_template_directory_uri() .'/inc/customizer/assets/css/radio-img/style.css' );
    }

    public function render_content() {

        if ( empty( $this->choices ) ) {
            return;
        }

        $name = '_customize-radio-'.$this->id;

        ?>
        <span class="customize-control-title">
			<?php echo esc_attr( $this->label ); ?>
            <?php if ( ! empty( $this->description ) ) : ?>

                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php endif; ?>
		</span>
        <div id="input_<?php echo $this->id; ?>" class="image">
            <?php foreach ( $this->choices as $value => $label ) : ?>
				<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id.esc_attr( $value ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
					<label for="<?php echo $this->id.esc_attr( $value ); ?>">
						<img src="<?php echo esc_html( $label ); ?>">
					</label>
				</input>
			<?php endforeach; ?>
        </div>
        <script>jQuery(document).ready(function($) { $( '[id="input_<?php echo $this->id; ?>"]' ).buttonset(); });</script>
        <?php
    }

}
