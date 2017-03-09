<div class="nav-menu-search">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'regina-lite' ); ?></span>
		<input id="search" type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'regina-lite' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="icon">
			<?php _e('Go', 'regina-lite'); ?>
			<span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'regina-lite' ); ?></span>
		</button>
	</form>
</div>
