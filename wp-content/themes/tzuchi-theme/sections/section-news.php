<div class="container-fluid content-wrap news-section">
	<div class="row">
		<div class="col-xs-7 latest-post-wrap">
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
							<p class="post-content"><?php echo $post->post_content ?></p>
						</section>
					</article>
			<?php endforeach ?>
		</div>

		<div class="col-xs-5 news-sidebar-wrap">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</div>
	</div>
</div>