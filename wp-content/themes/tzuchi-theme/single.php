<?php
/**
 *  The template for displaying all single posts.
 *
 */
	get_header();
?>

	<div class="container content-wrap single-post-container">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<!-- Post content -->
			<div class="row">
				<div class="col-xs-12">
					<article class="single-post-wrap">
						<figure class="post-img">
							<img src="<?php echo get_the_post_thumbnail_url( $post->ID ); ?>"/>	
						</figure>

						<header>
							<h2><?php echo $post->post_name ?></h2>
						</header>
						<p class="post-date"><?php echo mysql2date('F m, Y', $post->post_date) ?></p>
						<section>
							<p class="post-content"><?php echo $post->post_content ?></p>
						</section>
						
					</article>
				</div>
			</div>

		<?php endwhile; ?>
                        
    <?php else : ?>
    <!-- No POST -->                    
    	<article class="no-posts">
        <h1>No Posts Were Found</h1>
      </article>
    <?php endif; ?>
	</div>

<?php get_footer(); ?>