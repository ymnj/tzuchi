
<?php 

	/* Template Name: Doctors Page */ 

	get_header();

?>

	<div class="container content-wrap doctors-page-container">
		<?php 
		if( have_posts() ):
			while( have_posts() ): the_post(); ?>
		
			<div class="row">
				<div class="col-sm-12 col-md-3">
					<figure>
            <?php if ( has_post_thumbnail() ) {
            the_post_thumbnail();
            } else { ?>
            <img class="doctor-profile-image" src="<?php bloginfo('template_directory'); ?>/assets/images/member_default.jpg" alt="<?php the_title(); ?>" />
            <?php } ?>
			    </figure>
				</div>
				<div class="col-sm-12 col-md-9">
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