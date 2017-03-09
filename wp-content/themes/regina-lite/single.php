<?php
/**
 *  The template for displaying all single posts.
 *
 *  @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 *  @package regina-lite
 */
?>
<?php get_header(); ?>
<?php get_template_part( 'sections/section', 'page-header' ); ?>
<div class="container">
    <div class="row">
        <?php get_template_part( 'sections/section', 'breadcrumb' ); ?>
        <div id="blog" class="single">
            <div class="col-md-8">
                <?php
                if( have_posts() ):
                    while( have_posts() ):
                        the_post();
                        get_template_part( 'template-parts/content', 'single' );
                    endwhile;
                endif;
                ?>
                <?php do_action( 'mtl_single_after_content_loop' ); ?>
                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
            </div><!--.col-lg-8-->
        </div><!--#blog.archive-->
        <?php get_sidebar(); ?>
    </div><!--.row-->
</div><!--.container-->
<?php get_footer(); ?>