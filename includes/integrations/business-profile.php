<?php
/**
 * Functions used to integrate with the Business Profile plugin
 *
 * @package    Theme_of_the_Crop_Base_Theme
 */

/**
 * Print a location map if an address exists
 *
 *  @since 1.1
 */
function totcbase_bp_maybe_print_map( $location = false ) {

	if ( function_exists( 'bpwfwp_print_map' ) ) {
		bpwfwp_print_map( $location );
	}
}

/**
 * Adjust the location archive title
 *
 * @since 1.1
 */
function totcbase_bp_location_archive_title( $title ) {
	if ( !is_post_type_archive( 'location' ) ) {
		return $title;
	}

	return post_type_archive_title( '', false );

}
add_filter( 'get_the_archive_title', 'totcbase_bp_location_archive_title' );

/**
 * Wrapper for bpfwp_setting() for safely retrieving settings
 *
 * @since 0.1
 */
function totcbase_bp_setting( $setting, $location = false ) {
    if ( !function_exists( 'bpfwp_setting' ) ) {
        return '';
    }
    return bpfwp_setting( $setting, $location );
}
