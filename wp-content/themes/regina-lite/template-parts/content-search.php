<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package regina-lite
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
    <?php if( has_post_thumbnail() ): ?>
        <div class="image">
            <?php the_post_thumbnail( 'regina-lite-blog' ); ?>
        </div>
    <?php endif; ?>
    <h2 class="title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </h2>
    <?php do_action( 'mtl_entry_meta' ); ?>
    <div class="body">
        <?php the_excerpt(); ?>
    </div>
    <a href="<?php the_permalink(); ?>" title="<?php _e( 'Read more', 'regina-lite' ); ?>" class="read-more link small"><?php _e( 'Read more', 'regina-lite' ); ?> <span class="nc-icon-glyph arrows-1_bold-right"></span></a>
</article><!--.post-->