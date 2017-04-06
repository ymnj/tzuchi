<div class="container content-wrap news-section">
	<div class="row">
		<div class="col-md-7 latest-post-wrap">
			<?php 
				$args = array( 'numberposts' => 1, 'post_status'=>"publish",'post_type'=>"post",'orderby'=>"post_date");
					$post_array = get_posts( $args );
					foreach($post_array as $post) : ?>
					<h1>Latest News</h1>
					<article class="front-page-news">
						<figure class="post-img">
							<img src="<?php echo get_the_post_thumbnail_url( $post->ID ); ?>"/>		
						</figure>

						<header>
							<h2><?php echo $post->post_name ?></h2>
						</header>
						<p class="post-date"><?php echo mysql2date('F m, Y', $post->post_date) ?></p>
						<section>
							<p class="post-content"><?php echo substr($post->post_content, 0, 500) . "..." ?></p>
						</section>
						<p class="read-full-post text-center">
							<a href="<?php the_permalink(); ?>">Read More</a>
						</p>
					</article>
			<?php endforeach ?>
		</div>
		<div class="col-md-5 services-sidebar-wrap">
			<h1>Services</h1>
			<div class="services-flex-wrap">
				<div id="services-carousel" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
			    <div class="item active">
			      <img src="http://localhost/tzuchi/wp-content/uploads/2017/04/TCM-in-Burnaby-Hospital_front-window_Page_1-1.jpg" alt="...">
			    </div>
			    <div class="item">
			      <img src="http://tzuchicanada.org/tcmc/wp-content/uploads/2017/02/TCM-in-Burnaby-Hospital_front-window_Page_2.jpg" alt="...">
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














				<!-- <figure>
					<img src="http://localhost/tzuchi/wp-content/uploads/2017/04/TCM-in-Burnaby-Hospital_front-window_Page_1-1.jpg">
				</figure> -->
				<!-- <figure>
					<img src="http://tzuchicanada.org/tcmc/wp-content/uploads/2017/02/TCM-in-Burnaby-Hospital_front-window_Page_2.jpg">
				</figure> -->
			</div>
		</div>
	</div>
</div>