<div id="main-carousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="<?php echo get_theme_mod('carousel_banner_1', get_template_directory_uri() . "/layout/images/banner1.jpg") ?>" alt="...">
    </div>
    <div class="item">
      <img src="<?php echo get_theme_mod('carousel_banner_1', get_template_directory_uri() . "/layout/images/banner2.jpg")  ?>" alt="...">
    </div>
    <div class="item">
      <img src="<?php echo get_theme_mod('carousel_banner_1', get_template_directory_uri() . "/layout/images/banner3.jpg") ?>" alt="...">
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


