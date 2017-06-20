
<?php 

  /* Template Name: News Page */ 

  get_header();

?>

  <div class="container content-wrap news-page-container">
    <div class="row">
      <?php 

      	$currentPage = get_query_var("paged");

      	$args = array( 'post_type' => 'post',
      								 'posts_per_page' => 1,
      								 'paged' => $currentPage
      								);

				// the query
				$the_query = new WP_Query( $args ); ?>

				<?php if ( $the_query->have_posts() ) : ?>

					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="col-sm-10 col-sm-offset-1">
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
	              <a href="<?php the_permalink(); ?>"><?php echo comments_number('No comment(s)'); ?></a>
								<a href=<?php echo get_permalink($post->ID) ?>>Read More</a>
	            </div>
						</div> <!-- END COL -->
						
					<?php endwhile; ?><!-- end of the loop -->
					<div class="col-sm-10 col-sm-offset-1">
						<div class="posts-pag text-center">
							<?php 
							echo paginate_links(array(
								'total' 		=> $the_query->max_num_pages,
								'prev_text' => __('Newer'),
								'next_text' => __('Older'),
							));
							?>
						</div>
					</div>
					<!-- pagination here -->
					<?php wp_reset_postdata(); ?>

				<?php else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
    </div>

    
  </div>

<?php get_footer(); ?>