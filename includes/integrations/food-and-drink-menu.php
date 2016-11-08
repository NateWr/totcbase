<?php
/**
 * Functions used to integrate with the Food and Drink Menu plugin
 *
 * @package Theme_of_the_Crop_Base_Theme
 */
/**
 * Remove style-related settings for Food and Drink Menu
 *
 * @since 0.1
 */
function totcbase_fdm_remove_style_settings( $sap ) {
	unset( $sap->pages['food-and-drink-menu-settings']->sections['fdm-style-settings'] );
	unset( $sap->pages['food-and-drink-menu-settings']->sections['fdm-advanced-settings'] );

	return $sap;
}
add_filter( 'fdm_settings_page', 'totcbase_fdm_remove_style_settings', 200 );

/**
 * Remove Menu Section and Item Flag taxonomy archives on the frontend
 *
 * @since 0.1
 */
function totcbase_fdm_remove_taxonomy_frontend_urls( $args ) {
	$args['fdm-menu-section']['public'] = false;
	$args['fdm-menu-section']['show_ui'] = true;

	if ( isset( $args['fdm-menu-item-flag'] ) ) {
		$args['fdm-menu-item-flag']['public'] = false;
		$args['fdm-menu-item-flag']['show_ui'] = true;
	}

	return $args;
}
add_filter( 'fdm_menu_item_taxonomies', 'totcbase_fdm_remove_taxonomy_frontend_urls', 20 );

/**
 * Exclude menu item post type from search
 *
 * @since 0.1
 */
function totcbase_fdm_exclude_menu_item_from_search( $args ) {
	$args['exclude_from_search'] = true;

	return $args;
}
add_filter( 'fdm_menu_item_args', 'totcbase_fdm_exclude_menu_item_from_search' );

/**
 * Get the current version of Food and DRink Menu Pro, or false if it's not
 * active.
 *
 * @since 1.1.4
 */
function totcbase_fdmp_get_plugin_version() {

	if ( !defined( 'FDMP_PLUGIN_FNAME' ) ) {
		return false;
	}

	$fdmp = get_plugin_data( FDMP_PLUGIN_FPATH );
	return $fdmp['Version'];
}

/**
 * Initiate a call to load the item flag icon font when a menu is printed
 *
 * @param string $output HTML output of the menu
 * @param fdmViewMenu $menu Menu view object
 * @since 1.1.4
 */
function totcbase_fdmp_trigger_icon_font( $output, $menu ) {

	if ( is_plugin_active( 'food-and-drink-menu-pro/food-and-drink-menu-pro.php' ) ) {
		add_action( 'wp_footer', 'totcbase_fdmp_load_icon_font' );
	}

	return $output;
}
add_filter( 'fdm_menu_output', 'totcbase_fdmp_trigger_icon_font', 10, 2 );

/**
 * Enqueue the item flag icon font
 *
 * @since 1.1.4
 */
function totcbase_fdmp_load_icon_font() {

	?>
	<style type="text/css">
		@font-face {
			font-family: 'food-and-drink-menu-icons';
			src: url('<?php echo FDMP_PLUGIN_URL; ?>/assets/fonts/food-and-drink-menu-icons.eot?4zwtn9');
			src: url('<?php echo FDMP_PLUGIN_URL; ?>/assets/fonts/food-and-drink-menu-icons.eot?4zwtn9#iefix') format('embedded-opentype'),
				url('<?php echo FDMP_PLUGIN_URL; ?>/assets/fonts/food-and-drink-menu-icons.ttf?4zwtn9') format('truetype'),
				url('<?php echo FDMP_PLUGIN_URL; ?>/assets/fonts/food-and-drink-menu-icons.woff?4zwtn9') format('woff'),
				url('<?php echo FDMP_PLUGIN_URL; ?>/assets/fonts/food-and-drink-menu-icons.svg?4zwtn9#food-and-drink-menu-icons') format('svg');
			font-weight: normal;
			font-style: normal;
		}
	</style>
	<?php
}
