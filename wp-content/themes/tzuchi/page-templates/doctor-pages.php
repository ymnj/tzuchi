
<?php 

	/* Template Name: Doctors Page */ 

	get_header();

?>

	<div class="container content-wrap doctors-page-container">
		<?php 
		if( have_posts() ):
			while( have_posts() ): the_post(); ?>
			<div class="row">
				<div class="col-sm-3">
				<?php the_post_thumbnail('large', ['class' => 'doctor-profile-image img-responsive']); ?>
				</div>
				<div class="col-sm-9">
					<?php the_title( '<h1 class="doctor-name-header">', '</h1>' ); ?>	
					<div class="doctor-bio">
						<?php the_content()?>		
					</div>	
				</div>
			</div>
			<?php endwhile; 
		endif;
	?>
	</div>

<?php get_footer(); ?>