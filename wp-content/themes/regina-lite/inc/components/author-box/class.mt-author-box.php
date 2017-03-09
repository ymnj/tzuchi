<?php
/**
 * Class MTL_Related_Posts_Output
 *
 * This file does the social sharing handling for the Muscle Core Lite Framework
 *
 * @author		Cristian Raiber
 * @copyright	(c) Copyright by Macho Themes
 * @link		http://www.machothemes.com
 * @package 	Muscle Core Lite
 * @since		Version 1.0.0
 */
// @todo: make the order of the boxed changeable
if( !function_exists( 'CallAuthorBoxClassMTL' ) ) {
    /**
     *
     * Gets called only if the "display social media options" option is checked
     * in the back-end
     *
     * @since   1.0.0
     *
     */
    function CallAuthorBoxClassMTL()
    {
        $display_author_box = get_theme_mod('regina_lite_enable_author_box_blog_posts', 1);
        if ( $display_author_box == 1 ) {
            // instantiate the class & load everything else
            MTL_Author_Box_Output::getInstance();
        }
    }
    add_action('wp_loaded', 'CallAuthorBoxClassMTL');
}
if( !class_exists( 'MTL_Author_Box_Output' ) ) {
    /**
     * Class MTL_Author_Box_Output
     */
    class MTL_Author_Box_Output {
        /**
         * @var Singleton The reference to *Singleton* instance of this class
         */
        private static $instance;
        /**
         *
         */
        protected function __construct() {
            add_action( 'mtl_single_after_content', array( $this, 'output_author_box' ), 4);
        }
        /**
         * Returns the *Singleton* instance of this class.
         *
         * @return Singleton The *Singleton* instance.
         */
        public static function getInstance()
        {
            if (null === static::$instance) {
                static::$instance = new static();
            }
            return static::$instance;
        }
        /**
         * Private clone method to prevent cloning of the instance of the
         * *Singleton* instance.
         *
         * @return void
         */
        private function __clone()
        {
        }
        /**
         * Private unserialize method to prevent unserializing of the *Singleton*
         * instance.
         *
         * @return void
         */
        private function __wakeup()
        {
        }
        /**
         * Simple function that renders the Author Box Mark-up HTML code
         *
         * @return string
         */
        function output_author_box() {
            echo '<div id="post-author">';
                echo '<div class="row">';
                    echo '<div class="col-xs-2">';
                        echo get_avatar( get_the_author_meta( 'user_email' ), 100 );
                    echo '</div><!--/.col-xs-2-->';
                    echo '<div class="col-xs-10">';
                        echo '<div class="content">';
                            echo '<h3>'. esc_html( get_the_author() ) .'</h3>';
                            if(  get_the_author_meta( 'description' )  ) {
                                echo '<p>'. esc_html( get_the_author_meta( 'description' ) ) .'</p>';
                            }
                        echo '</div><!--/.content-->';
                    echo '</div><!--/.col-xs-10-->';
                echo '</div><!--/.row-->';
            echo '</div><!--/#post-author-->';
        }
    }
}