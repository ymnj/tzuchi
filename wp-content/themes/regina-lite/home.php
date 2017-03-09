<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package regina-lite
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
                if( have_posts() ):
                    while( have_posts() ):
                        the_post();
                        do_action('mtl_inside_loop_before');
                        get_template_part( 'template-parts/content', get_post_format() );
                        do_action('mtl_inside_loop_after');
                    endwhile;
                else:
                    get_template_part( 'template-parts/content', 'none' );
                endif;
                do_action('mtl_after_content_above_footer');
                ?>
            </div><!--.col-lg-8-->
        </section><!--#blog.archive-->
        <?php get_sidebar(); ?>
    </div><!--.row-->
</div><!--.container-->
<?php get_footer(); ?>