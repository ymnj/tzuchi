<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TCMC – TZU CHI MEDICAL CENTRE OF TRADITIONAL CHINESE MEDICINE CANADA FOUNDATION</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <?php wp_head() ?>
</head>
<body>
  
  <div class="main-flex-wrap">
  <!-- Navigation -->
  <nav class="navbar navbar-default" role="navigation">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/tzuchi">
                <img src="<?php bloginfo('template_directory'); ?>/layout/images/brand-logo.png" title="" alt="" />
              </a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <?php
            wp_nav_menu( array(
                'menu'              => 'Main Navigation',
                'theme_location'    => 'navigation-menu',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'myNavbar',
                'menu_class'        => 'nav navbar-nav navbar-right',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker())
            );
        ?>
      </div>
      <!-- /.container -->
  </nav>

