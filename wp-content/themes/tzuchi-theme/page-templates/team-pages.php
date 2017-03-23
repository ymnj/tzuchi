<?php 

	/* Template Name: Meet Our Team Page */ 

	get_header();

			$mods = get_theme_mods();

			//This function returns all the names that have been set. DOES NOT ALLOW EMPTY NAMES
			function get_names($arr, $term){
				$names = array_filter($arr, function($value, $key) use ($term){
					 return (strpos($key, $term) && trim($value));
				}, ARRAY_FILTER_USE_BOTH);
				return $names;
			}

			//This function returns all that have been set. ALLOW EMPTY STRING
			function get_mod_term($arr, $term){
				$training = array_filter($arr, function($key) use ($term){
					return strpos($key, $term);
				}, ARRAY_FILTER_USE_KEY);
				return $training;
			}

			function image_check($image){
				if (isset($image) && !empty($image)){
					echo $image;
				} else {
					echo get_template_directory_uri() . "/layout/images/member-default.jpg";
				}
			};

			$names = get_names($mods, 'name');
			$training = get_mod_term($mods, 'training');
			$images = get_mod_term($mods, 'image');

?>


	<div class="container team-page-container">

		<div class="team-header text-center">
			<h1><?php echo get_theme_mod('meet_team_header', 'This is a default header'); ?></h1>
			<p><?php echo get_theme_mod('meet_team_paragraph', 'This is a default paragraph'); ?></p>
		</div>

		<div class="members-grid-wrapper">
			<?php for ($i = 1; $i <= count($names); $i++): ?>
			<div class="single-member text-center">
				<img src="<?php image_check($images["team_members_number" . $i . "_image"]); ?>" alt="">
				<h2 class="member-name"><?php echo get_theme_mod("team_members_number". $i . "_name", 'Default Name'); ?></h2>
				<p class="member-training"><?php echo get_theme_mod('team_members_number' .  $i .'_training', 'Test Trainings'); ?></p>
			</div>
			<?php endfor; ?>
		</div>

	

	</div>

<?php get_footer(); ?>