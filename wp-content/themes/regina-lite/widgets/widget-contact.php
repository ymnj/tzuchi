<?php
class Regina_Lite_Widget_Contact extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct( 'regina_lite_contact', __( '[MT] - Contact', 'regina-lite' ), array( 'description' => __( '[MT] - Contact description.', 'regina-lite' ), ) );
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

        if( !empty( $instance['phone'] ) ) {
            echo '<p><span class="nc-icon-glyph tech_mobile-button white"></span>&nbsp;&nbsp; '. esc_html( $instance['phone'] ) .'</p>';
        }

        if( !empty( $instance['email'] ) ) {
            echo '<p><span class="nc-icon-glyph ui-1_email-83 white"></span>&nbsp;&nbsp; <a href="mailto: '. sanitize_email( $instance['email'] ) .'" title="'. sanitize_email( $instance['email'] ) .'">'. sanitize_email( $instance['email'] ) .'</a></p>';
        }

        if( !empty( $instance['facebook_link'] ) || !empty( $instance['twitter_link'] ) || !empty( $instance['linkedin_link'] ) || !empty( $instance['youtube_link'] ) ) {
            echo '<ul class="social-link-list">';
                if( !empty( $instance['facebook_link'] ) ) {
                    echo '<li><a href="'. esc_url( $instance['facebook_link'] ) .'" title="'. __( 'Facebook', 'regina-lite' ) .'" target="_blank"><span class="nc-icon-glyph socials-1_logo-facebook"></span></a></li>';
                }

                if( !empty( $instance['twitter_link'] ) ) {
                    echo '<li><a href="'. esc_url( $instance['twitter_link'] ) .'" title="'. __( 'Twitter', 'regina-lite' ) .'" target="_blank"><span class="nc-icon-glyph socials-1_logo-twitter"></span></a></li>';
                }

                if( !empty( $instance['linkedin_link'] ) ) {
                    echo '<li><a href="'. esc_url( $instance['linkedin_link'] ) .'" title="'. __( 'LinkedIn', 'regina-lite' ) .'" target="_blank"><span class="nc-icon-glyph socials-1_logo-linkedin"></span></a></li>';
                }

                if( !empty( $instance['youtube_link'] ) ) {
                    echo '<li><a href="'. esc_url( $instance['youtube_link'] ) .'" title="'. __( 'YouTube', 'regina-lite' ) .'" target="_blank"><span class="nc-icon-glyph socials-1_logo-youtube"></span></a></li>';
                }

            if( !empty( $instance['instagram_link'] ) ) {
                echo '<li><a href="'. esc_url( $instance['instagram_link'] ) .'" title="'. __( 'Instagram', 'regina-lite' ) .'" target="_blank"><span class="nc-icon-glyph socials-1_logo-instagram"></span></a></li>';
            }

            echo '</ul>';
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
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '[MT] - Contact', 'regina-lite' );
        $phone = !empty( $instance['phone'] ) ? $instance['phone'] : __( '(650) 652-8500', 'regina-lite' );
        $email = !empty( $instance['email'] ) ? $instance['email'] : __( 'contact@mediplus.com', 'regina-lite' );
        $facebook_link = !empty( $instance['facebook_link'] ) ? $instance['facebook_link'] : __( '#', 'regina-lite' );
        $twitter_link = !empty( $instance['twitter_link'] ) ? $instance['twitter_link'] : __( '#', 'regina-lite' );
        $linkedin_link = !empty( $instance['linkedin_link'] ) ? $instance['linkedin_link'] : __( '#', 'regina-lite' );
        $youtube_link = !empty( $instance['youtube_link'] ) ? $instance['youtube_link'] : __( '#', 'regina-lite' );
        $instagram_link = !empty( $instance['instagram_link'] ) ? $instance['instagram_link'] : __( '#', 'regina-lite' );

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'regina-lite' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone:', 'regina-lite' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'E-mail:', 'regina-lite' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'facebook_link' ); ?>"><?php _e( 'Facebook Link:', 'regina-lite' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'facebook_link' ); ?>" name="<?php echo $this->get_field_name( 'facebook_link' ); ?>" type="text" value="<?php echo esc_attr( $facebook_link ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'twitter_link' ); ?>"><?php _e( 'Twitter Link:', 'regina-lite' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'twitter_link' ); ?>" name="<?php echo $this->get_field_name( 'twitter_link' ); ?>" type="text" value="<?php echo esc_attr( $twitter_link ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'linkedin_link' ); ?>"><?php _e( 'LinkedIn Link:', 'regina-lite' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'linkedin_link' ); ?>" name="<?php echo $this->get_field_name( 'linkedin_link' ); ?>" type="text" value="<?php echo esc_attr( $linkedin_link ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'youtube_link' ); ?>"><?php _e( 'YouTube Link:', 'regina-lite' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'youtube_link' ); ?>" name="<?php echo $this->get_field_name( 'youtube_link' ); ?>" type="text" value="<?php echo esc_attr( $youtube_link ); ?>">
        </p>


        <p>
            <label for="<?php echo $this->get_field_id( 'instagram_link' ); ?>"><?php _e( 'Instagram Link:', 'regina-lite' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'instagram_link' ); ?>" name="<?php echo $this->get_field_name( 'instagram_link' ); ?>" type="text" value="<?php echo esc_attr( $instagram_link ); ?>">
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
        $instance['phone'] = ( !empty( $new_instance['phone'] ) ? $new_instance['phone'] : '' );
        $instance['email'] = ( !empty( $new_instance['email'] ) ? $new_instance['email'] : '' );
        $instance['facebook_link'] = ( !empty( $new_instance['facebook_link'] ) ? $new_instance['facebook_link'] : '' );
        $instance['twitter_link'] = ( !empty( $new_instance['twitter_link'] ) ? $new_instance['twitter_link'] : '' );
        $instance['linkedin_link'] = ( !empty( $new_instance['linkedin_link'] ) ? $new_instance['linkedin_link'] : '' );
        $instance['youtube_link'] = ( !empty( $new_instance['youtube_link'] ) ? $new_instance['youtube_link'] : '' );
        $instance['instagram_link'] = ( !empty( $new_instance['instagram_link'] ) ? $new_instance['instagram_link'] : '' );


        return $instance;
    }

}

function regina_lite_register_widget_contact () {
    register_widget( 'Regina_Lite_Widget_Contact' );
}
add_action( 'widgets_init', 'regina_lite_register_widget_contact' );
?>