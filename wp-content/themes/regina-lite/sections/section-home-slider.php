<?php

$custom_header = get_custom_header();

$image = wp_get_attachment_image_url( $custom_header->attachment_id, 'regina-lite-slider-image-sizes' );

// get image meta by ID
$image_meta = get_post_meta( $image_id );


?>

<div id="home-slider" class="clear">
	<ul class="clear">
		<li>
			<img src="<?php echo esc_url( get_custom_header()->url ); ?>" alt="<?php echo esc_attr( $image_meta['_wp_attachment_image_alt']['0'] ); ?>">
		</li>
	</ul>
	<div class="clear"></div>
</div><!--/#home-slider.clear-->