<?php get_header(); ?>

  <!-- Caraousel-->
  <div id="carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="<?php bloginfo('template_directory'); ?>/layout/images/cropped-group.jpg" alt="...">
      </div>
      <div class="item">
        <img src="<?php bloginfo('template_directory'); ?>/layout/images/cropped-group.jpg" alt="...">
      </div>
      <div class="item">
        <img src="<?php bloginfo('template_directory'); ?>/layout/images/cropped-group.jpg" alt="...">
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



  <?php get_footer() ?>






	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>