<?php get_header(); ?>
  
  <!-- Caraousel-->
  <?php get_template_part('/sections/section','carousel')?>

  <!-- Appointment Click to Action -->
  <?php get_template_part('/sections/section', 'appointment-cta'); ?>

	<!-- News Section -->
	<?php get_template_part('/sections/section', 'news'); ?>

  <!-- Circle Stats Section -->
  <?php get_template_part('/sections/section', 'stat') ?>

  <!-- Doctors Section -->
  <?php get_template_part('/sections/section', 'team') ?>

<?php get_footer() ?>
