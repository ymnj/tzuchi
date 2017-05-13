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
							<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail();
							} else { ?>
							<img src="<?php bloginfo('template_directory'); ?>/assets/images/default_featured_image.png" alt="<?php the_title(); ?>" />
							<?php } ?>
						</figure>
						<header>
							<h2><?php echo $post->post_name ?></h2>
						</header>
						<p class="post-date"><?php echo mysql2date('F m, Y', $post->post_date) ?></p>
						<section>
							<p class="post-content"><?php echo $post->post_content ?></p>
						</section>
						<!-- If comments are open or we have at least one comment, load up the comment template. -->
						<?php if ( comments_open() || get_comments_number() ) :
						     comments_template();
						 endif;
						 ?>

		
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