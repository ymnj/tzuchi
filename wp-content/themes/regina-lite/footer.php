<?php
    $widget_args = array(
        'before_title'  => '<h6><small>',
        'after_title'   => '</small></h6>'
    );

    $check_footer_theme_copyright_enable = get_theme_mod('regina_lite_footer_theme_copyright_enable', 1);
    $text_footer_theme_copyright_message = get_theme_mod('regina_lite_footer_copyright', esc_html__( '&copy; Copyright 2016. All Rights Reserved.', 'regina-lite' ) )

?>
<footer id="footer">
    <div class="container">
        <div class="row">
            <?php if( is_active_sidebar( 'footer-sidebar-1' ) ){ ?>
                <div class="col-sm-3 col-xs-12">
                    <?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
                </div><!--.col-sm-3-->
            <?php  } else { ?>
                <div class="col-sm-3 col-xs-12">
                    <?php the_widget( 'WP_Widget_Text', 'title=About Regina Lite&text=Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.', $widget_args ); ?>
                </div><!--/.col-sm-3-->
            <?php } ?>

            <?php if( is_active_sidebar( 'footer-sidebar-2' ) ) { ?>
                <div class="col-sm-3 col-xs-12">
                    <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
                </div><!--.col-sm-3-->
            <?php } else { ?>
                <div class="col-sm-3 col-xs-12">
                    <?php the_widget( 'WP_Widget_Meta', NULL, $widget_args ); ?>
                </div><!--.col-sm-3-->
            <?php } ?>

            <?php if( is_active_sidebar( 'footer-sidebar-3' ) ){ ?>
                <div class="col-sm-3 col-xs-12">
                    <?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
                </div><!--.col-lg-3-->
            <?php } else { ?>
                <div class="col-sm-3 col-xs-12">
                    <?php the_widget( 'Regina_Lite_Widget_Contact', 'title=Contact&phone=(650) 652-8500&email=contact@mediplus.com&facebook_link=#&twitter_link=#&linkedin_link=#&youtube_link=#&instagram_link=#', $widget_args ); ?>
                </div><!--.col-lg-3-->
            <?php } ?>

            <?php if( is_active_sidebar( 'footer-sidebar-4' ) ) { ?>
                <div class="col-sm-3 col-xs-12">
                    <?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
                </div><!--.col-lg-3-->
            <?php } else { ?>
                <div class="col-sm-3 col-xs-12">
                    <?php the_widget( 'Regina_Lite_Widget_Address', 'title=Address&address=Medplus<br />33 Farlane Street<br />Keilor East<br />VIC 3033, New York', $widget_args ); ?>
                </div><!--.col-lg-3-->
            <?php } ?>
            <a href="#" class="back-to-top"><span class="nc-icon-glyph arrows-1_bold-up"></span></a>
        </div><!--.row-->
    </div><!--.container-->
</footer><!--#footer-->

<footer id="sub-footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <?php
                    if( $check_footer_theme_copyright_enable == 1 ) {
                        echo sprintf( 'Theme: <a href="%s" target="_blank" rel="nofollow" title="Regina Lite">Regina Lite</a>', esc_url( 'http://www.machothemes.com/themes/regina-lite/' ) ) . ' &middot; ';
                        echo 'Built by: <a href="https://www.machothemes.com/" rel="dofollow" title="Professional Responsive WordPress Themes">Macho Themes</a> ';
                    }
                    if( $text_footer_theme_copyright_message ) {
                        echo $text_footer_theme_copyright_message;
                    }
                ?>
            </div>
        </div><!--.row-->
    </div><!--.container-->
</footer><!--#sub-footer-->
<?php wp_footer(); ?>
</body>
</html>
