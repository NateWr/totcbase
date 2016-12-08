<?php
/**
 * Theme of the Crop Base Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since 0.1
 */
function totcbase_setup() {

	totcbase_load_context();

	load_theme_textdomain( 'totcbase', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'event-organiser' );
	add_theme_support( 'theme-painter', totcbase_load_theme_painter() );
	add_theme_support( 'business-profile', array(
		'disable_append_to_content' => true,
		'disable_styles' => true,
	) );
	add_theme_support( 'totc-layout-control', array(
		'components' => array(
			'content-block',
			'posts-reviews',
			'posts-menus',
			'posts-pages',
			'opening-hours',
			'map',
			'booking-form',
			'recent-posts',
			'upcoming-events',
			'locations',
			'gallery',
		),
	) );

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'totcbase' ),
			'social'  => esc_html__( 'Social Profiles', 'totcbase' ),
		)
	);

	include_once( 'lib/updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'totcbase_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 * @since 0.1
 */
function totcbase_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'totcbase_content_width', 600 );
}
add_action( 'after_setup_theme', 'totcbase_content_width', 0 );

/**
 * Load files required to integrate with Typecase
 *
 * This requires an early hook priority on `after_setup_theme` so it gets
 * a separate load chain
 *
 * @since 0.1
 */
function totcbase_load_typecase() {
	include_once( 'includes/integrations/typecase.php' );
}
add_action( 'after_setup_theme', 'totcbase_load_typecase', -1 );

/**
 * Load files when required for a given context
 *
 * @since 0.1
 */
function totcbase_load_context() {
	add_action( 'get_header', 'totcbase_load_frontend' );
	add_action( 'init', 'totcbase_load_customizer' );
	add_action( 'widgets_init', 'totcbase_load_widgets' );
	add_action( 'init', 'totcbase_load_init', 5 );
}

/**
 * Load files required to render the frontend
 *
 * @since 0.1
 */
function totcbase_load_frontend() {
	include_once( 'includes/load-frontend.php' );
	include_once( 'lib/WAI-ARIA-Walker_Nav_Menu/aria-walker-nav-menu.php' );
	include_once( 'includes/template-tags.php' );
	include_once( 'includes/integrations/business-profile.php' );
	include_once( 'includes/integrations/food-and-drink-menu.php' );
	include_once( 'includes/integrations/event-organiser.php' );
	include_once( 'includes/integrations/ninja-forms.php' );
}

/**
 * Load files required by the customizer
 *
 * @since 0.1
 */
function totcbase_load_customizer() {
	include_once( 'includes/load-customizer.php' );
	include_once( 'includes/template-tags.php' );
}

/**
 * Load files handling widgets
 *
 * @since 0.1
 */
function totcbase_load_widgets() {
	include_once( 'includes/widgets/totc-recent-posts.php' );

	unregister_widget( 'WP_Widget_Recent_Posts' );
	register_widget( 'Totc_Widget_Recent_Posts' );

	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'totcbase' ),
		'id'            => 'primary',
		'description'   => esc_html__( 'This sidebar will appear beside most pages and posts', 'totcbase' ),
	) );
}

/**
 * Load files required globally that need to run during the `init` hook
 *
 * @since 0.1
 */
function totcbase_load_init() {
	include_once( 'includes/load-theme-setup.php' );
	include_once( 'includes/integrations/food-and-drink-menu.php' );
	include_once( 'includes/load-plugin-installer.php' );
}

/**
 * Load files required to work with the theme-painter lib and return
 * $args for get_theme_support().
 *
 * @since 0.1
 */
function totcbase_load_theme_painter() {
	include_once( 'lib/theme-painter/theme-painter.php' );
	include_once( 'includes/integrations/theme-painter.php' );

	return totcbase_get_theme_painter_args();
}
