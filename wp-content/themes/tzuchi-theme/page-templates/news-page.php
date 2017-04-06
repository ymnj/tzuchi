
<?php 

	/* Template Name: News Page */ 

	get_header();

?>

	<div class="container content-wrap news-page-container">
		<?php 
		if( have_posts() ):
			while( have_posts() ): the_post(); ?>
				
				<div class="row">
					<div class="col-xs-12">
						Header
					</div>
					<div class="col-xs-12">
						<?php the_content()?>		
					</div>
				</div>
			<?php endwhile; 
		endif;
	?>
	</div>

<?php get_footer(); ?>

