<?php
class Regina_Lite_Widget_Address extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct( 'regina_lite_address', __( '[MT] - Address', 'regina-lite' ), array( 'description' => __( '[MT] - Address description.', 'regina-lite' ) ) );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( !empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
        }

        echo '<span class="nc-icon-glyph location_pin white" style="float:left;"></span>';

        if( !empty( $instance['address'] ) ) {
            echo '<p style="float:left; margin:-7px 0 0 10px;">';
            echo $instance['address'];
            echo '</p>';
        }

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '[MT] - Address', 'regina-lite' );
        $address = ! empty( $instance['address'] ) ? $instance['address'] : __( 'Medplus<br /> 33 Farlane Street<br /> Keilor East<br /> VIC 3033, New York<br />', 'regina-lite' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'regina-lite' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address:', 'regina-lite' ); ?></label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>"><?php if( !empty( $address ) ): echo $address; endif; ?></textarea>
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['address'] = ( !empty( $new_instance['address'] ) ) ? $new_instance['address'] : '';

        return $instance;
    }

}

function regina_lite_register_widget_address () {
    register_widget( 'Regina_Lite_Widget_Address' );
}
add_action( 'widgets_init', 'regina_lite_register_widget_address' );
?>