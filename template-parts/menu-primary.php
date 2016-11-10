<?php
/**
 * Display the primary navigation menu
 *
 * @brief Loads the menu assigned to the primary menu slot with the appropriate
 *  settings.
 *
 * @package Theme_of_the_Crop_Base_Theme
 */
wp_nav_menu(
	array(
		'theme_location'  => 'primary',
		'menu_id'         => 'primary-menu',
		'depth'           => 3,
	)
);
?>

<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
	<?php esc_attr_e( 'Browse', 'totcbase' ); ?>
</button>
