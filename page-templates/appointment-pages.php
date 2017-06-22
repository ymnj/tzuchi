<?php
/*
Template Name: Accounts & Appointment Page
*/
get_header(); 

?>

  <div class="container content-wrap appointment-page-container">
    <?php 
    if( have_posts() ):
      while( have_posts() ): the_post(); ?>
      <div class="row">
        <div class="col-sm-12">
          <?php the_title( '<h1 class="appointment-page-title">', '</h1>' ); ?> 
          <div class="appointment-page-content">
           <p><?php the_content()?></p>
          </div>  
        </div>
      </div>
      <?php endwhile; 
    endif;?>
  </div>

<?php get_footer(); ?>