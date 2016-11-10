<?php
/**
 * Display the social profiles menu
 *
 * @brief Loads the menu assigned to the social profiles slot with the
 *  appropriate settings.
 *
 * @package Theme_of_the_Crop_Base_Theme
 */
if ( has_nav_menu( 'social' ) ) {
	wp_nav_menu(
		array(
			'theme_location'  => 'social',
			'container_class' => 'totcbase-social-menu social-icons',
			'depth'           => 1,
			'link_before'     => '<span class="screen-reader-text">',
			'link_after'      => '</span>',
		)
	);
}
