
<?php 

	/* Template Name: News Page */ 

	get_header();

?>

	<div class="container content-wrap news-page-container">
		<?php
		global $post;
		$args = array( 'posts_per_page' => 3 );
		$lastposts = get_posts( $args );
		foreach ( $lastposts as $post ) :
		  setup_postdata( $post ); ?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php the_content(); ?>
		<?php endforeach; 
		wp_reset_postdata(); ?>	
			

	</div>

<?php get_footer(); ?>

