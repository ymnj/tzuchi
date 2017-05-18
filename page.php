<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 */
get_header(); ?>

	<div class="container content-wrap default-page-container">
<<<<<<< HEAD
		
=======
		<?php 
    if( have_posts() ):
      while( have_posts() ): the_post(); ?>
    
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <?php the_title( '<h1 class="about-page-title">', '</h1>' ); ?> 
          <div class="about-content">
           <p><?php the_content()?></p>
          </div>  
        </div>
      </div>
      <?php endwhile; 
    endif;
  ?>
>>>>>>> d1230aa317a1d4d004842151a0d5b4a27411b441
	</div>

<?php get_footer(); ?>