
	<div class="footer-container">

		<footer id="footer">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar('footer_bottom'); ?>
					<div class="footer-nav-col col-xs-6 col-sm-3">
						<h2 class="footer-title"><?php echo get_theme_mod("heading_title_2", "Clinics") ?></h2>	
						<ul>
							<li><a href=<?php echo get_theme_mod('footer_col_two_item1_link', get_site_url() . '/locations' ) ?>><?php echo get_theme_mod("footer_col_two_item1", "Raven Song Community Health Centre") ?></a></li>
							<li><a href=<?php echo get_theme_mod('footer_col_two_item1_link', get_site_url() . '/locations' ) ?>><?php echo get_theme_mod("footer_col_two_item2", "Sumas First Nation Health Centre") ?></a></li>
							<li><a href=<?php echo get_theme_mod('footer_col_two_item1_link', get_site_url() . '/locations' ) ?>><?php echo get_theme_mod("footer_col_two_item3", "Helping Spirit Lodge Society") ?></a></li>
							<li><a href=<?php echo get_theme_mod('footer_col_two_item1_link', get_site_url() . '/locations' ) ?>><?php echo get_theme_mod("footer_col_two_item4") ?></a></li>
						</ul>	
					</div>
					<div class="footer-nav-col col-xs-6 col-sm-3">
						<h2 class="footer-title"><?php echo get_theme_mod("heading_title_3", "Contact") ?></h2>
						<ul>
							<li><?php echo get_theme_mod("footer_col_three_item1", "778 990 8262") ?></li>
							<li><?php echo get_theme_mod("footer_col_three_item2", "tcmcrsg@gmail.com") ?></li>
							<li><?php echo get_theme_mod("footer_col_three_item3") ?></li>
							<li><?php echo get_theme_mod("footer_col_three_item4") ?></li>
						</ul>	
					</div>
					<div class="footer-nav-col col-xs-6 col-sm-3">
						<h2 class="footer-title"><?php echo get_theme_mod("heading_title_4", "Office") ?></h2>
						<ul>
							<li><?php echo get_theme_mod("footer_col_four_item1", "TZU CHI CANADA") ?></li>
							<li><?php echo get_theme_mod("footer_col_four_item2", "8850, Osler street") ?></li>
							<li><?php echo get_theme_mod("footer_col_four_item3", "Vancouver, BC") ?></li>
							<li><?php echo get_theme_mod("footer_col_four_item4") ?></li>
						</ul>
					</div>		
				</div>
			</div>
		</footer>
		<footer id="sub-footer" class="text-center">
			<p><?php echo get_theme_mod('subfooter_text', 'TZU CHI MEDICAL CENTRE OF TRADITIONAL CHINESE MEDICINE CANADA FOUNDATION © Copyright 2017 All Rights Reserved.')?><p>
		</footer>
	</div>
	</div><!--END MAIN FLEX WRAP-->
	<?php wp_footer(); ?>
</body>
</html>

