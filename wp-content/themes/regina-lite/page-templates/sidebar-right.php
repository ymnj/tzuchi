<?php
/**
 *	Template name: Page with sidebar on the right
 *
 *	The template for displaying Custom Page Template with sidebar on the right.
 *
 *	@package regina-lite
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
                        get_template_part( 'template-parts/content', 'page' );
                    endwhile;
                endif;
                ?>
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