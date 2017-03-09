<?php
/**
 *  Template name: Blog Template
 *
 *  The template for displaying the Custom Page Template: Blog Template.
 *
 *  @package regina-lite
 */
?>
<?php get_header(); ?>
<?php get_template_part( 'sections/section', 'page-header' ); ?>
<div class="container">
    <div class="row">
        <?php get_template_part( 'sections/section', 'breadcrumb' ); ?>
        <section id="blog">
            <div class="col-md-8">
                <?php
                $post_query_args = array (
                    'post_type'                 => array( 'post' ),
                    'ignore_sticky_posts'       => false,
                    'cache_results'             => true,
                    'update_post_meta_cache'    => true,
                    'update_post_term_cache'    => true
                );

                $post_query = new WP_Query( $post_query_args );

                if( $post_query->have_posts() ) {
                    while( $post_query->have_posts() ) {
                        $post_query->the_post();
                        do_action('mtl_inside_loop_before');
                        get_template_part( 'template-parts/content', get_post_format() );
                        do_action('mtl_inside_loop_after');
                    }
                } else {
                    get_template_part( 'template-parts/content', 'none' );
                }

                wp_reset_postdata();

                do_action('mtl_after_content_above_footer');
                ?>
            </div><!--.col-lg-8-->
        </section><!--#blog.archive-->
        <?php get_sidebar(); ?>
    </div><!--.row-->
</div><!--.container-->
<?php get_footer(); ?>