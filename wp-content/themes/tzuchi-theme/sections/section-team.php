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
	// function image_check($image, $arr){
	// 	if (array_key_exists($image, $arr)){
	// 		echo $arr[$image];
	// 	} else {
	// 		echo get_template_directory_uri() . "/layout/images/member-default.jpg";
	// 	}
	// };

	// This gets the first four declared team members from the customizer and displays them on the front page. Default placeholders will be displayed if customize information has not been supplied yet.
	$team_general_title = get_theme_mod('team_members_general_title', 'Our teammates take care to everyone!');
	$team_general_description = get_theme_mod('team_members_general_description', 'We provide the great healers (TCM doctors) to truly work for people, with pain and sickness in mind.');
	// $links = first_four($mods, 'training');

	// Placeholder Teammates for front page

	$default_teammembers = array(
		array('name' => 'Dr. Sam Chen',
					'edu'  => 'R.Ac, R.TCM.P',
					'img'  =>  get_template_directory_uri() . "/assets/images/dr-chen.jpg"),
	  array('name' => 'Dr. Aldred Man',
	  			'edu'  => 'RN. RPN, R.TCM.P, R.Ac',
	  			'img'  =>  get_template_directory_uri() . "/assets/images/dr-wen.jpg"),
	  array('name' => 'Dr. John Situ',
	  			'edu'  => 'R.TCM.P',
	  			'img'  =>  get_template_directory_uri() . "/assets/images/dr-suto.jpg"),
	  array('name' => 'Dr. Claire Kao',
	  			'edu'  => 'DR. TCM',
	  			'img'  =>  get_template_directory_uri() . "/assets/images/dr-kao.jpg")
	);

?>	


<pre>
	<?php echo get_theme_mod("team_members_number1_name");
	var_dump($mods);

	?>
</pre>


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
					<img src="<?php echo get_theme_mod("team_members_number". $i . "_image", $default_teammembers[$i - 1]['img']); ?>">
					<div class="member-box text-center">
						<h2 class="section-member-name"><?php echo get_theme_mod("team_members_number". $i . "_name", $default_teammembers[$i - 1]['name'] ); ?></h2>
						<p class="section-member-training"><?php echo get_theme_mod('team_members_number' .  $i .'_training',  $default_teammembers[$i - 1]['edu'] ); ?></p>
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