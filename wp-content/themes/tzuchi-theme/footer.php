<?php wp_footer(); ?>

	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="footer-nav-col col-lg-3">
					<?php wp_nav_menu( array(
							'menu'              => 'Navigation Menu',
              'theme_location'    => 'navigation-menu',
              'depth'             => 2,
              'container'         => 'ul'
					)); ?>
				</div>
				<div class="clinic-address-col col-lg-3">sdsd</div>
				<div class="contact-col col-lg-3">sdsd</div>
				<div class="office-address-col col-lg-3">sdsd</div>
			</div>
		</div>
	</footer>
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>


