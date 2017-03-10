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
		'theme-license' => esc_html__( 'Theme License', 'totcbase' ),
		'enter-key' => esc_html__( 'Enter your theme license key.', 'totcbase' ),
		'license-key' => esc_html__( 'License Key', 'totcbase' ),
		'license-action' => esc_html__( 'License Action', 'totcbase' ),
		'deactivate-license' => esc_html__( 'Deactivate License', 'totcbase' ),
		'activate-license' => esc_html__( 'Activate License', 'totcbase' ),
		'status-unknown' => esc_html__( 'License status is unknown.', 'totcbase' ),
		'renew' => esc_html__( 'Renew?', 'totcbase' ),
		'unlimited' => esc_html__( 'unlimited', 'totcbase' ),
		'license-key-is-active' => esc_html__( 'License key is active.', 'totcbase' ),
		'expires%s' => esc_html__( 'Expires %s.', 'totcbase' ),
		'%1$s/%2$-sites' => esc_html__( 'You have %1$s / %2$s sites activated.', 'totcbase' ),
		'license-key-expired-%s' => esc_html__( 'License key expired %s.', 'totcbase' ),
		'license-key-expired' => esc_html__( 'License key has expired.', 'totcbase' ),
		'license-keys-do-not-match' => esc_html__( 'License keys do not match.', 'totcbase' ),
		'license-is-inactive' => esc_html__( 'License is inactive.', 'totcbase' ),
		'license-key-is-disabled' => esc_html__( 'License key is disabled.', 'totcbase' ),
		'site-is-inactive' => esc_html__( 'Site is inactive.', 'totcbase' ),
		'license-status-unknown' => esc_html__( 'License status is unknown.', 'totcbase' ),
		'update-notice' => esc_html__( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'totcbase' ),
		'update-available' => esc_html__('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4$s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'totcbase' )
	)

);
