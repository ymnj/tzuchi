<?php get_header(); ?>
  
  <!-- Caraousel-->
  <?php get_template_part('/sections/section','carousel')?>

	<!-- News Section -->
	<?php get_template_part('/sections/section', 'news'); ?>

  <!-- Doctors Section -->
  <?php get_template_part('/sections/section', 'team') ?>

<?php get_footer() ?>
