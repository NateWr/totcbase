<?php
/**
 * Functions used only on the frontend
 *
 * @brief These functions are only used on the frontend and so only need to be
 *  loaded for those requests.
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

/**
 * Enqueue the theme's assets
 *
 * @since 0.1
 */
function totcbase_enqueue_assets() {

	// Maybe load minified scripts/styles
	$min = SCRIPT_DEBUG ? '' : 'min.';

	// Auto-load the parent theme's style if a child theme is active
	if ( is_child_theme() ) {
		wp_enqueue_style( 'totcbase-parent', trailingslashit( get_template_directory_uri() ) . 'style.' . $min . 'css' );
	}

	// Enqueue active theme's CSS stylesheet
	add_filter( 'stylesheet_uri', 'totcbase_load_minified_stylesheet' );
	wp_enqueue_style( 'totcbase', get_stylesheet_uri() );

	$font_uri = apply_filters(
		/**
		* Filter the URL to load fonts. Modify this to load different
		* fonts, weights or subsets from Google.
		*
		* @since 0.1
		*
		* @param string $url The URL to the font definitions
		*/
		'totcbase_font_uri',
		''
	);
	if ( !empty( $font_uri ) ) {
		wp_enqueue_style( 'totcbase-fonts', $font_uri );
	}

	// Enqueue frontend script
	wp_enqueue_script( 'totcbase-js', get_template_directory_uri() . '/assets/js/frontend.' . $min . 'js', array( 'jquery' ), '0.1', true );

	// Load Picturefill to fix bugs with responsive images in Safari 8
	wp_enqueue_script( 'picturefill', get_template_directory_uri() . '/lib/picturefill/picturefill.' . $min . 'js', array(), '3.0.2', true );

	// Add comment reply script
	if ( is_singular() && function_exists( 'comments_open' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'totcbase_enqueue_assets' );

/**
 * Filter the stylesheet_uri to load the minified stylesheet if
 * SCRIPT_DEBUG is false
 *
 * @since 0.1
 */
function totcbase_load_minified_stylesheet( $uri ) {
	if ( is_child_theme() || SCRIPT_DEBUG ) {
		return $uri;
	} else {
		return substr( $uri, 0, -4 ) . '.min.css';
	}
}

/**
 * Dequeue styles from plugins we don't need in the footer
 *
 * @since 0.1
 */
function totcbase_dequeue_footer_assets() {
	wp_dequeue_style( 'gr-reviews' );
	wp_dequeue_style( 'rtb-booking-form' );
	wp_dequeue_style( 'fdm-css-base' );
	wp_dequeue_style( 'fdm-css-classic' );
	wp_dequeue_style( 'fdm-css-base-pro' );
}
add_action( 'wp_footer', 'totcbase_dequeue_footer_assets' );

/**
 * Add conditional classes to the <body> tag
 *
 * @since 0.1
 */
function totcbase_add_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( !is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if sidebar is not shown
	if ( ( is_front_page() && !is_home() ) ||
			is_page_template( 'page-full-width.php' ) ||
			!is_active_sidebar( 'primary' ) ||
			( get_post_type() == 'fdm-menu' && totcbase_menu_has_two_cols() ) ||
			( get_post_type() == 'event' && is_single() ) ||
			( get_post_type() == 'location' && is_single() )
		) {
		$classes[] = 'totcbase-primary-sidebar-inactive';
	}

	// Narrow content pages
	if ( is_home() ||
			is_page_template( 'page-narrow.php' ) ||
			is_page_template( 'page-narrow-no-sidebar.php' ) ||
			( get_post_type() == 'post' && is_single() ) ||
			( get_post_type() == 'post' && is_archive() ) ||
			( get_post_type() == 'event' && is_archive() )
		) {
		$classes[] = 'totcbase-narrow-content';
	}

	return $classes;
}
add_action( 'body_class', 'totcbase_add_body_classes' );

/**
 * Define a custom style for Google Maps
 *
 * Used to alter maps from Business Profile and Event Organiser.
 *
 * @since 0.1
 */
function totcbase_set_map_options( $opts ) {

	// Don't override styles set by any other code
	if ( empty( $opts['styles'] ) ) {
		$opts['styles'] = array(
			// array(
			// 	'stylers' => array(
			// 		array( 'hue' => get_theme_mod( 'theme_painter_setting_accent', '#9a8f45' ) )
			// 	)
			// ),
			array(
				'featureType' => 'water',
				'stylers' => array(
					array( 'hue' => '#0000ff' )
				)
			),
		);
	}

	return $opts;
}
add_filter( 'bpfwp_google_map_options', 'totcbase_set_map_options' );
add_filter( 'eventorganiser_venue_map_options', 'totcbase_set_map_options' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function totcbase_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'totcbase_pingback_header' );
