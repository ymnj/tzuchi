
<?php 

	/* Template Name: News Page */ 

	get_header();

?>

	<div class="container content-wrap news-page-container">
		<div class="row">
			<?php
			global $post;
			$args = array( 'posts_per_page' => 3 );
			$lastposts = get_posts( $args );
			foreach ( $lastposts as $post ) :
			  setup_postdata( $post ); ?>
				<div class="col-sm-8 col-sm-offset-2">
					<figure class="post-img">
						<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail();
						} else { ?>
						<img src="<?php bloginfo('template_directory'); ?>/assets/images/default_featured_image.png" alt="<?php the_title(); ?>" />
						<?php } ?>
					</figure>

					<?php the_date( 'F j, Y', '<p class="post-date">', '</p>', true ); ?>

					<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<p class="post-excerpt"><?php echo get_excerpt(120); ?></p>
					  <div class="post-footer">
					  	<span><?php the_author(); ?></span>
					  	 <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
					  	<span><?php echo comments_number('No comment(s)
'); ?></span>
					  </div>


				</div>
			<?php endforeach; 
			wp_reset_postdata(); ?>	
			
		</div>
	</div>

<?php get_footer(); ?>