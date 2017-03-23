<?php 
//Theme Mod Team Members

	$mods = get_theme_mods();

	//This function will take the mods array and return the first four elements with keys containing the search $term.
	function first_four($arr, $term){
		$filtered = array_filter($arr, function($k) use ($term){
		return	strpos($k, $term);
		}, ARRAY_FILTER_USE_KEY);
		return array_slice($filtered, 0, 4);
	};

	//This function takes the array of images and checks if they exist. If it is NULL, then it returns the default image string.
	function image_check($image){
		if (isset($image)){
			echo $image;
		} else {
			echo get_template_directory_uri() . "/layout/images/member-default.jpg";
		}
	};

	$team_general_title = get_theme_mod('team_members_general_title', 'This is a default title');
	$team_general_description = get_theme_mod('team_members_general_description', 'This is a default description text');
	$names = first_four($mods, 'name');
	$training = first_four($mods, 'training');
	$images = first_four($mods, 'image');
?>	

<div class="container team-section">
	<div class="intro-header text-center">
		<h1><?php echo $team_general_title; ?></h1>

		<p><?php echo $team_general_description; ?></p>
	</div>

	<div class="row">
		<?php for ($i = 1; $i <= 4; $i++): ?>
		<div class="section-member col-lg-3 col-sm-6">
			<img src="<?php image_check($images["team_members_number" . $i . "_image"]); ?>">
			<div class="member-box">
				<div class="description text-center">
					<h1 class="section-member-name"><?php echo get_theme_mod("team_members_number". $i . "_name", 'Default Name'); ?></h1>
					<p class="section-member-training"><?php echo get_theme_mod('team_members_number' .  $i .'_training', 'Test Trainings'); ?></p>
				</div>
			</div>
		</div>
		<?php endfor; ?>
	</div> <!-- END ROW -->

	<p class="read-more text-center">
		<a href="<?php echo get_page_link(7); ?>">Meet our team</a>
	</p>

</div>