<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

$theme = wp_get_theme( 'totcbase' );

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://themeofthecrop.com', // Site where EDD is hosted
		'item_name' => 'TotcBase', // Name of theme
		'theme_slug' => 'totcbase', // Theme slug
		'version' => $theme->get( 'Version' ), // The current version of this theme
		'author' => 'Theme of the Crop', // The author of this theme
		'download_id' => 13087, // Optional, used for generating a license renewal link
		'renew_url' => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license' => __( 'Theme License', 'totcbase' ),
		'enter-key' => __( 'Enter your theme license key.', 'totcbase' ),
		'license-key' => __( 'License Key', 'totcbase' ),
		'license-action' => __( 'License Action', 'totcbase' ),
		'deactivate-license' => __( 'Deactivate License', 'totcbase' ),
		'activate-license' => __( 'Activate License', 'totcbase' ),
		'status-unknown' => __( 'License status is unknown.', 'totcbase' ),
		'renew' => __( 'Renew?', 'totcbase' ),
		'unlimited' => __( 'unlimited', 'totcbase' ),
		'license-key-is-active' => __( 'License key is active.', 'totcbase' ),
		'expires%s' => __( 'Expires %s.', 'totcbase' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'totcbase' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'totcbase' ),
		'license-key-expired' => __( 'License key has expired.', 'totcbase' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'totcbase' ),
		'license-is-inactive' => __( 'License is inactive.', 'totcbase' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'totcbase' ),
		'site-is-inactive' => __( 'Site is inactive.', 'totcbase' ),
		'license-status-unknown' => __( 'License status is unknown.', 'totcbase' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'totcbase' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4$s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'totcbase' )
	)

);
