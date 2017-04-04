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

			//This function returns the member number of all valid members with a name.
			function get_member_nums($arr){
				$nums = array();
				foreach($arr as $key => $value) {
					$nums[] = filter_var($key, FILTER_SANITIZE_NUMBER_INT);
				}
				return $nums;
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
			//$valid_members is an array of numbers created from VALID members that have a name. Use $valid_members to loop through and display valid member information.
			$valid_members = get_member_nums($names);

?>


	<div class="container content-wrap team-page-container">

		<div class="team-header text-center">
			<h1><?php echo get_theme_mod('meet_team_header', 'This is a default header'); ?></h1>
			<p><?php echo get_theme_mod('meet_team_paragraph', 'This is a default paragraph'); ?></p>
		</div>

		<div class="members-grid-wrapper">
			<?php foreach ($valid_members as $key => $value): ?>
				<div class="single-member text-center">
					<a href="<?php echo get_page_link(get_theme_mod("team_members_number" . $value . "_link")) ?>">
						<div class="link-wrap">
							<img src="<?php image_check($images["team_members_number" . $value . "_image"]); ?>" alt="">
							<h2 class="member-name"><?php echo get_theme_mod("team_members_number". $value . "_name", 'Default Name'); ?></h2>
							<p class="member-training"><?php echo get_theme_mod('team_members_number' .  $value .'_training', 'Test Trainings'); ?></p>
						</div> <!-- LINK WRAP -->
					</a> 
				</div>
			<?php endforeach; ?>
		</div>

	

	</div>

<?php get_footer(); ?>