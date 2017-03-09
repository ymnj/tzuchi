<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package regina-lite
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="image">
			<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_post_thumbnail( $post->ID, 'regina-lite-blog' ); ?></a>
		</div>
	<?php endif; ?>
	<h2 class="title">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	</h2>
	<?php do_action( 'mtl_entry_meta' ); ?>
	<div class="body">
		<?php the_excerpt(); ?>
	</div>
</article><!--.post-->