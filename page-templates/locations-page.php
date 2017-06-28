<?php
/*
Template Name: Locations Page
*/
get_header(); 

?>

  <div class="container content-wrap locations-page-container">
    <?php 
    if( have_posts() ):
      while( have_posts() ): the_post(); ?>
      <div class="row">
        <div class="col-sm-12">
          <?php the_title( '<h1 class="locations-page-title text-center">', '</h1>' ); ?> 
          <div class="locations-page-content">
            <!-- Location 1 -->
            <div class="row">
              <div class="col-sm-12 col-md-4 address-col">
                <h3>
                  <?php echo get_theme_mod("footer_col_two_item1", "Raven Song Community Health Centre") ?>
                </h3>
                <p>2450 Ontario St, Vancouver BC V5T 4T7</p>
              </div>
              <div class="col-sm-12 col-md-8 map-col">
                    
              </div>
            </div>
            <!-- Location 2 -->    
            <div class="row">
              <div class="col-sm-12 col-md-4 address-col">
                <h3>
                  <?php echo get_theme_mod("footer_col_two_item2", "Sumas First Nation Health Centre") ?>
                </h3>
                <p>Sumas Mountain Rd, Sumas Prairie BC V3G 3C1</p>
              </div>
              <div class="col-sm-12 col-md-8 map-col"></div>
            </div>
            <!-- Location 3 -->
            <div class="row">
              <div class="col-sm-12 col-md-4 address-col">
                <h3>
                  <?php echo get_theme_mod("footer_col_two_item3", "Helping Spirit Lodge Society") ?>
                </h3>
                <p>3965 Dumfries St,Vancouver BC V5N 5R3</p>
              </div>
              <div class="col-sm-12 col-md-8 map-col"></div>
            </div>
            <!-- Location 5 -->
            <div class="row">
              <div class="col-sm-12 col-md-4 address-col"></div>
              <div class="col-sm-12 col-md-8 map-col"></div>
            </div>
          </div>  
        </div>
      </div>
      <?php endwhile; 
    endif;?>
  </div>

<?php get_footer(); ?>