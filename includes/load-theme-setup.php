<?php
/**
 * Functions used to load the Theme Setup admin page
 *
 * @brief Functions used to load the theme setup library to add a page and
 *  manage demo content.
 *
 * @package Theme_of_the_Crop_Base_Theme
 */
include_once( get_template_directory() . '/lib/totc-theme-setup/totc-theme-setup.php' );

add_action( 'admin_menu', 'totc_theme_setup_add_menu_page' );
add_action( 'wp_ajax_totc-theme-setup', 'totc_theme_setup_handle_ajax_requests' );
add_action( 'wp_ajax_nopriv_totc-theme-setup', 'totc_theme_setup_handle_nopriv_ajax_requests' );

function totcbase_theme_setup_strings( $strings ) {

	$strings['lib.url_base'] = get_template_directory_uri() . '/lib/totc-theme-setup';
	$strings['page.title'] = esc_html__( 'Theme Setup', 'totcbase' );
	$strings['page.menu.title'] = esc_html__( 'Theme Setup', 'totcbase' );
	$strings['page.no.access'] = esc_html__( 'You do not have sufficient permissions to access this page.', 'totcbase' );
	$strings['page.demo.section'] = esc_html__( 'Demo Content', 'totcbase' );
	$strings['page.demo.install_plugin'] = esc_html__( 'Install', 'totcbase' );
	$strings['page.demo.install_plugin.no_permission'] = esc_html__( 'You must install this plugin before you can add demo content, but you do not have permission to install plugins. Please contact your web administrator for assistance.', 'totcbase' );
	$strings['page.demo.activate_plugin'] = esc_html__( 'Activate Plugin', 'totcbase' );
	$strings['page.demo.activate_plugin.no_permission'] = esc_html__( 'You must activate this plugin before you can add demo content, but you do not have permission to activate plugins. Please contact your web administrator for assistance.', 'totcbase' );
	$strings['page.demo.install_demo'] = esc_html__( 'Install Demo Content', 'totcbase' );
	$strings['page.demo.install_demo.no_permission'] = esc_html__( 'You do not have permission to install demo content. Please contact your web administrator for assistance.', 'totcbase' );
	$strings['page.demo.view_demo'] = esc_html__( 'View Demo', 'totcbase' );
	$strings['page.documentation.section'] = esc_html__( 'Documentation & Support', 'totcbase' );
	$strings['page.documentation.help'] = esc_html__( 'Help Documentation', 'totcbase' );
	$strings['page.documentation.help.url'] = 'http://doc.themeofthecrop.com/themes/totcbase?utm_source=Theme&utm_medium=Theme%20Help&utm_campaign=TotcBase';
	$strings['page.documentation.help.description'] = esc_html__( 'Read the help guide for this theme', 'totcbase' );
	$strings['page.documentation.support'] = esc_html__( 'Support', 'totcbase' );
	$strings['page.documentation.support.url'] = 'https://themeofthecrop.com/contact/';
	$strings['page.documentation.support.description'] = sprintf( esc_html__( 'Get %1$sone-on-one support%2$s if you are having trouble or need customizations done.', 'totcbase' ), '<a href="https://themeofthecrop.com/contact/">', '</a>' );
	$strings['page.documentation.demo'] = esc_html__( 'Theme Demo', 'totcbase' );
	$strings['page.documentation.demo.url'] = 'http://demo.themeofthecrop.com/totcbase';
	$strings['page.documentation.demo.description'] = esc_html__( 'View an online demo of this theme', 'totcbase' );
	$strings['ajax.installing'] = esc_html__( 'Installing', 'totcbase' );
	$strings['ajax.error.nopriv'] = esc_html__( 'You have been logged out. Please login again before continuing.', 'totcbase' );
	$strings['ajax.error.unknown'] = esc_html__( 'An unexpected error occur. Please reload the page and try again.', 'totcbase' );
	$strings['ajax.error.route_unknown'] = esc_html__( 'Your request could not be processed. Please reload the page and try again', 'totcbase' );

	return $strings;
}
add_filter( 'totc_theme_setup_strings', 'totcbase_theme_setup_strings' );

function totcbase_theme_setup_demos( $demos ) {

	include_once( get_template_directory() . '/lib/totc-theme-setup/includes/Demo.class.php' );
	include_once( get_template_directory() . '/lib/totc-theme-setup/includes/Demo.food-and-drink-menu.class.php' );
	include_once( get_template_directory() . '/lib/totc-theme-setup/includes/Demo.restaurant-reservations.class.php' );
	include_once( get_template_directory() . '/lib/totc-theme-setup/includes/Demo.business-profile.class.php' );
	include_once( get_template_directory() . '/lib/totc-theme-setup/includes/Demo.good-reviews-wp.class.php' );
	include_once( get_template_directory() . '/lib/totc-theme-setup/includes/Demo.event-organiser.class.php' );

	// Food and Drink Menu
	$demos[] = new totcThemeSetupDemoFoodAndDrinkMenu(
		array(
			'title' => esc_html__( 'Food and Drink Menu', 'totcbase' ),
			'strings' => array(
				'menu.title' => _x( 'Demo Menu', 'This phrase is used in the Food and Drink Menu demo content installed from the Theme Setup page.', 'totcbase' ),
				'section.starters' => _x( 'Starters', 'This phrase is used in the Food and Drink Menu demo content installed from the Theme Setup page.', 'totcbase' ),
				'section.entrees' => _x( 'Entrees', 'This phrase is used in the Food and Drink Menu demo content installed from the Theme Setup page.', 'totcbase' ),
				'section.desserts' => _x( 'Desserts', 'This phrase is used in the Food and Drink Menu demo content installed from the Theme Setup page.', 'totcbase' ),
				'item.title' => _x( 'Demo Menu Dish %s', 'This phrase is used in the Food and Drink Menu demo content installed from the Theme Setup page.', 'totcbase' ),
				'item.description' => _x( 'A delicious dish made of the finest, carefully selected ingredients.', 'This phrase is used in the Food and Drink Menu demo content installed from the Theme Setup page.', 'totcbase' ),
				'item.price' => _x( '$12.99', 'This phrase is used in the Food and Drink Menu demo content installed from the Theme Setup page.', 'totcbase' ),
			),
		)
	);

	$demos[] = new totcThemeSetupDemoRestaurantReservations(
		array(
			'title' => esc_html__( 'Restaurant Reservations', 'totcbase' ),
			'strings' => array(
				'post.content' => _x( 'This is a demo of the Restaurant Reservations booking form', 'This phrase is used in the Restaurant Reservations demo content installed from the Theme Setup page.', 'totcbase' ),
				'post.title' => _x( 'Booking Form Demo', 'This phrase is used in the Restaurant Reservations demo content installed from the Theme Setup page.', 'totcbase' ),
			),
		)
	);

	$demos[] = new totcThemeSetupDemoBusinessProfile(
		array(
			'title' => esc_html__( 'Business Profile', 'totcbase' ),
			'strings' => array(
				'title' => _x( 'Contact Card Demo', 'This phrase is used in the Restaurant Reservations demo content installed from the Theme Setup page.', 'totcbase' ),
				'address' => _x( "1600 Amphitheatre Parkway\nMountain View, CA 94043", 'This phrase is used in the Restaurant Reservations demo content installed from the Theme Setup page.', 'totcbase' ),
				'phone' => _x( '(123) 456-7890', 'This phrase is used in the Restaurant Reservations demo content installed from the Theme Setup page.', 'totcbase' ),
				'email' => _x( 'contact@example.com', 'This phrase is used in the Restaurant Reservations demo content installed from the Theme Setup page.', 'totcbase' ),
			),
		)
	);

	$demos[] = new totcThemeSetupDemoGoodReviewsForWordPress(
		array(
			'title' => esc_html__( 'Good Reviews for WordPress', 'totcbase' ),
			'strings' => array(
				'page.title' => _x( 'Good Reviews Demo', 'This phrase is used in the Good Reviews for WordPress demo content installed from the Theme Setup page.', 'totcbase' ),
				'post.content' => _x( "This is a fabulous review! We were so excited by this website that we just had to go back for more. We've been three times now!", 'This phrase is used in the Good Reviews for WordPress demo content installed from the Theme Setup page.', 'totcbase' ),
				'post.title' => _x( 'Reviewer Name %s', 'This phrase is used in the Good Reviews for WordPress demo content installed from the Theme Setup page.', 'totcbase' ),
				'post.review_url' => _x( 'http://example.com', 'This phrase is used in the Good Reviews for WordPress demo content installed from the Theme Setup page.', 'totcbase' ),
				'post.reviewer_org' => _x( 'Critic Magazine', 'This phrase is used in the Good Reviews for WordPress demo content installed from the Theme Setup page.', 'totcbase' ),
				'post.reviewer_url' => _x( 'http://example.com', 'This phrase is used in the Good Reviews for WordPress demo content installed from the Theme Setup page.', 'totcbase' ),
			),
		)
	);

	$demos[] = new totcThemeSetupDemoEventOrganiser(
		array(
			'title' => esc_html__( 'Event Organiser', 'totcbase' ),
			'strings' => array(
				'calendar.title' => _x( 'Event Calendar Demo', 'This phrase is used in the Restaurant Reservations demo content installed from the Theme Setup page.', 'totcbase' ),
				'event.title' => _x( 'Demo Event %s', 'This phrase is used in the Restaurant Reservations demo content installed from the Theme Setup page.', 'totcbase' ),
				'event.content' => _x( 'This is a sample event created with the Event Organiser plugin.', 'This phrase is used in the Restaurant Reservations demo content installed from the Theme Setup page.', 'totcbase' ),
			),
		)
	);

	return $demos;
}
add_filter( 'totc_theme_setup_demo_handlers', 'totcbase_theme_setup_demos' );
