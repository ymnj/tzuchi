<?php
/**
 *  Template part for displaying single posts.
 *
 *  @link https://codex.wordpress.org/Template_Hierarchy
 *
 *  @package regina-lite
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php do_action( 'mtl_single_before_content' ); ?>
    <?php if( has_post_thumbnail() ): ?>
        <div class="image">
            <?php the_post_thumbnail( 'regina-lite-blog' ); ?>
        </div>
    <?php endif; ?>
    <h2 class="title"><?php the_title(); ?></h2>
    <?php do_action( 'mtl_entry_meta' ); ?>
    <div class="body markup-format">
        <?php the_content(); ?>
        <?php
        wp_link_pages( array(
            'before'    => '<div class="link-pages">' . __( 'Pages:', 'regina-lite' ),
            'after'     => '</div><!--/.link-pages-->'
        ) );
        ?>
    </div><!--/.markup-format-->
    <?php do_action( 'mtl_single_after_content' ); ?>
</article><!--.post-->
<?php do_action( 'mtl_single_after_article' ); ?>