
	<div class="footer-container">
		<footer id="footer">
			<div class="container">
				<?php if (function_exists('dynamic_sidebar')) dynamic_sidebar('footer_bottom'); ?>
			</div>
		</footer>
		<footer id="sub-footer" class="text-center">
			<p><?php echo get_theme_mod('subfooter_text', 'TZU CHI MEDICAL CENTRE OF TRADITIONAL CHINESE MEDICINE CANADA FOUNDATION © Copyright 2017 All Rights Reserved.')?><p>
		</footer>
	</div>
	</div><!--END MAIN FLEX WRAP-->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

<?php wp_footer(); ?>


