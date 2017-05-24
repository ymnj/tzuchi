
<div class="content-wrap news-section">
	<div class="container">
		<div class="row">
			<article class="col-xs-12 col-md-7 front-page-news">
				<?php 
					$args = array( 'numberposts' => 1, 'post_status'=>"publish",'post_type'=>"post",'orderby'=>"post_date");
						$post_array = get_posts( $args );
						foreach($post_array as $post) : ?>
							<figure class="post-img">
								<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail();
								} else { ?>
								<img src="<?php bloginfo('template_directory'); ?>/assets/images/default_featured_image.png" alt="<?php the_title(); ?>" />
								<?php } ?>
							</figure>

							<div class="post-text-wrap">
								<header>
									<h2><?php echo $post->post_title ?></h2>
								</header>
								<p class="post-date"><?php echo mysql2date('F j, Y', $post->post_date) ?></p>
								<section>
									<p class="post-content"><?php echo substr($post->post_content, 0, 1100) . "..." ?></p>
								</section>
								<p class="read-full-post text-center">
									<a href="<?php the_permalink(); ?>">Read More</a>
								</p>
							</div>
				<?php endforeach ?>
			</article>
			<div class="col-xs-12 col-xs-offset-0 
									col-sm-8 col-sm-offset-2
									col-md-5 col-md-offset-0 services-sidebar-wrap">
				<div class="services-flex-wrap">
					<div id="services-carousel" class="carousel-fade" data-ride="carousel">
					  <div class="carousel-inner" role="listbox">
					    <div class="item active">
					      <img src="<?php bloginfo('template_directory'); ?>/layout/images/tcm-services-banner1.jpg">
					    </div>
					    <div class="item">
					      <img src="<?php bloginfo('template_directory'); ?>/layout/images/tcm-services-banner2.jpg">
					    </div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>