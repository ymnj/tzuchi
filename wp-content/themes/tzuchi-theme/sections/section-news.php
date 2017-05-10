<div class="container content-wrap news-section">
	<div class="row">
		<div class="col-md-7 col-xs-12 latest-post-wrap">
			<?php 
				$args = array( 'numberposts' => 1, 'post_status'=>"publish",'post_type'=>"post",'orderby'=>"post_date");
					$post_array = get_posts( $args );
					foreach($post_array as $post) : ?>
					
					<header class="section-title text-center">
						<h1>Latest News</h1>
					</header>
					<article class="front-page-news">
						<figure class="post-img">
							<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail();
							} else { ?>
							<img src="<?php bloginfo('template_directory'); ?>/layout/images/default_featured_image.png" alt="<?php the_title(); ?>" />
							<?php } ?>
						</figure>

						<header>
							<h2><?php echo $post->post_name ?></h2>
						</header>
						<p class="post-date"><?php echo mysql2date('F j, Y', $post->post_date) ?></p>
						<section>
							<p class="post-content"><?php echo substr($post->post_content, 0, 1300) . "..." ?></p>
						</section>
						<p class="read-full-post text-center">
							<a href="<?php the_permalink(); ?>">Read More</a>
						</p>
					</article>
			<?php endforeach ?>
		</div>
		<div class="col-md-5 col-xs-12 services-sidebar-wrap">
			<header class="section-title text-center"><h1>Services</h1></header>
			<div class="services-flex-wrap">
				<div id="services-carousel" class="carousel slide" data-ride="carousel">

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
				    <div class="item active">
				      <img src="<?php bloginfo('template_directory'); ?>/layout/images/tcm-services-banner1.jpg">
				    </div>
				    <div class="item">
				      <img src="<?php bloginfo('template_directory'); ?>/layout/images/tcm-services-banner2.jpg">
				    </div>
				  </div>

				  <!-- Controls -->
				  <a class="left carousel-control" href="#services-carousel" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#services-carousel" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
			</div>
		</div>
	</div>
</div>