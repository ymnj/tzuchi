<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Early exit if the class already exists
if ( class_exists( 'regina_lite_Controls_Slider_Control' ) ) {
    return;
}

class regina_lite_Controls_Slider_Control extends WP_Customize_Control {

    public $type = 'slider-selector';

    public function enqueue() {

        wp_enqueue_script( 'jquery-ui' );
        wp_enqueue_script( 'jquery-ui-slider' );
        wp_enqueue_style( 'rl-slider', get_template_directory_uri() . '/inc/customizer/assets/css/slider/style.css' );

    }

    public function render_content() { ?>
        <label>

			<span class="customize-control-title">
				<?php echo esc_attr( $this->label ); ?>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
			</span>

            <input type="text" class="rl-slider" id="input_<?php echo $this->id; ?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?>/>

        </label>

        <div id="slider_<?php echo $this->id; ?>" class="ss-slider"></div>
        <script>
            jQuery(document).ready(function($) {
                $( '[id="slider_<?php echo $this->id; ?>"]' ).slider({
                    value : <?php echo esc_attr( $this->value() ); ?>,
                    min   : <?php echo $this->choices['min']; ?>,
                    max   : <?php echo $this->choices['max']; ?>,
                    step  : <?php echo $this->choices['step']; ?>,
                    slide : function( event, ui ) { $( '[id="input_<?php echo $this->id; ?>"]' ).val(ui.value).keyup(); }
                });
                $( '[id="input_<?php echo $this->id; ?>"]' ).val( $( '[id="slider_<?php echo $this->id; ?>"]' ).slider( "value" ) );

                $( '[id="input_<?php echo $this->id; ?>"]' ).change(function() {
                    $( '[id="slider_<?php echo $this->id; ?>"]' ).slider({
                        value : $( this ).val()
                    });
                });

            });
        </script>
        <?php

    }
}
