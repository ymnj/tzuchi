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
          <div class="locations-page-content">
            <!-- Location 1 -->
            <div class="row">
              <div class="col-sm-12 col-md-4 address-col">
              
                <h3>
                <?php echo get_theme_mod("footer_col_two_item1", "Raven Song Community Health Centre") ?>
                </h3>
                <p>2450 Ontario St, Vancouver BC, V5T 4T7</p>
              </div>
              <div class="col-sm-12 col-md-8 map-col">
                <iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Raven%20Song%20Community%20Health%20Centre&key=AIzaSyDU64kblvG5hFtEVS1vtr7_THB1qHqUObQ" allowfullscreen></iframe>    
              </div>
            </div>
            <!-- Location 2 -->    
            <div class="row">
              <div class="col-sm-12 col-md-4 address-col">
                <h3>
                  <?php echo get_theme_mod("footer_col_two_item2", "Sumas First Nation Health Centre") ?>
                </h3>
                <p>Sumas Mountain Rd, Sumas Prairie, BC V3G 3C1</p>
              </div>
              <div class="col-sm-12 col-md-8 map-col">
                <iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Sumas%20First%20Nation%20Health%20Centre&key=AIzaSyDU64kblvG5hFtEVS1vtr7_THB1qHqUObQ" allowfullscreen></iframe>
              </div>
            </div>
            <!-- Location 3 -->
            <div class="row">
              <div class="col-sm-12 col-md-4 address-col">
                <h3>
                  <?php echo get_theme_mod("footer_col_two_item3", "Helping Spirit Lodge Society") ?>
                </h3>
                <p>3965 Dumfries St,Vancouver BC V5N 5R3</p>
              </div>
              <div class="col-sm-12 col-md-8 map-col">
                <iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=3965%20Dumfries%20St%2CVancouver%20BC%20V5N%205R3&key=AIzaSyDU64kblvG5hFtEVS1vtr7_THB1qHqUObQ" allowfullscreen></iframe>
              </div>
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