<?php 
//Theme Mod Team Members

	$mods = get_theme_mods();

	//This function will take the mods array and return the first four doctors with keys containing the search $term.
	function first_four($arr, $term){
		$filtered = array_filter($arr, function($k) use ($term){
		return	strpos($k, $term);
		}, ARRAY_FILTER_USE_KEY);
		return array_slice($filtered, 0, 4);
	};

	//This function takes the array of images and checks if they exist. If it is NULL, then it returns the default image string.
	function image_check($image, $arr){
		if (array_key_exists($image, $arr)){
			echo $arr[$image];
		} else {
			echo get_template_directory_uri() . "/layout/images/member-default.jpg";
		}
	};

	$team_general_title = get_theme_mod('team_members_general_title', 'Our teammates take care to everyone!');
	$team_general_description = get_theme_mod('team_members_general_description', 'We provide the great healers (TCM doctors) to truly work for people, with pain and sickness in mind.');
	$names = first_four($mods, 'name');
	$training = first_four($mods, 'training');
	$images = first_four($mods, 'image');
	$links = first_four($mods, 'training')
?>	

<div class="container content-wrap team-section">
	<div class="intro-header text-center">
		<h1><?php echo $team_general_title; ?></h1>
		<p><?php echo $team_general_description; ?></p>
	</div>
	<div class="row">
		<?php for ($i = 1; $i <= 4; $i++): ?>
		<div class="section-member">
			<a href="<?php echo get_page_link(get_theme_mod("team_members_number" . $i . "_link", '7')) ?>">
				<div class="link-wrap">
					<img src="<?php image_check("team_members_number" . $i . "_image", $images); ?>">
					<div class="member-box text-center">
						<h2 class="section-member-name"><?php echo get_theme_mod("team_members_number". $i . "_name", 'Default Name'); ?></h2>
						<p class="section-member-training"><?php echo get_theme_mod('team_members_number' .  $i .'_training', 'Test Trainings'); ?></p>
					</div>
				</div>		<!-- END LINK WRAP -->
			</a>
		</div>
		<?php endfor; ?>
	</div> <!-- END ROW -->

	<p class="meet-our-team-more text-center">
		<a href="<?php echo get_page_link(7); ?>">Meet our team</a>
	</p>

</div>