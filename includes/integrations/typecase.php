<?php
/**
 * Functions used to integrate with the Typecase plugin
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

/**
 * CSS selectors for text styled with the accent font
 *
 * @since 0.1
 */
function totcbase_typecase_get_accent_font_selector() {

	$selectors = array(
		'',
	);

	return join( ',', apply_filters( 'totcbase_typecase_accent_font_selector', $selectors ) );
}

/**
 * Retrieve settings array for Typecase support
 *
 * @since 0.1
 */
function totcbase_typecase_get_settings() {

	$args = array(
		'simple' => array(
			array(
				'label' => esc_html__( 'Base Font', 'totcbase' ),
				'selector' => join( ',', apply_filters( 'totcbase_typecase_base_font_selector', array( 'html', 'body' ) ) ),
				'default' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
			),
			array(
				'label' => esc_html__( 'Accent Font', 'totcbase' ),
				'selector' => totcbase_typecase_get_accent_font_selector(),
				'default' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
			),
		)
	);

	return apply_filters( 'totcbase_typecase_settings', $args );
}

/**
 * Dequeue default fonts if they're overridden by typecase
 *
 * @since 0.1
 */
function totcbase_typecase_dequeue_default_fonts() {

	$font_locations = get_theme_support( 'typecase' );

	if ( empty( $font_locations ) || !is_array( $font_locations ) || empty( $font_locations[0] ) ) {
		return;
	}

	$fonts = get_option( 'typecase_fonts' );

	if ( empty( $fonts ) ) {
		return;
	}

	$load_base_font = true;
	$load_accent_font = true;
	foreach( $font_locations[0]['simple'] as $font_location ) {

		$slug = sanitize_title( $font_location['label'] );
		$font = get_theme_mod( $slug, $font_location['default'] );

		if ( empty( $font ) || $font == $font_location['default'] ) {
			continue;
		}

		if ( $font_location['default'] == '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif' ) {
			$load_base_font = false;
		} elseif ( $font_location['default'] == '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif' ) {
			$load_accent_font = false;
		}
	}

	if ( $load_base_font && $load_accent_font ) {
		return;
	}

	if ( !$load_base_font && !$load_accent_font ) {
		add_filter( 'totcbase_font_uri', 'totcbase_font_uri_empty' );
	} elseif( !$load_base_font ) {
		add_filter( 'totcbase_font_uri', 'totcbase_font_uri_no_base_font' );
	} elseif( !$load_accent_font ) {
		add_filter( 'totcbase_font_uri', 'totcbase_font_uri_no_accent_font' );
	}
}
add_action( 'wp_enqueue_scripts', 'totcbase_typecase_dequeue_default_fonts', 1 );

/**
 * Return an empty font URI to prevent loading the default fonts
 *
 * @param string $url The URL to the font definitions
 * @since 0.1
 */
function totcbase_font_uri_empty( $url ) {
	return '';
}

/**
 * Return a font URI that does not include the base font
 *
 * @param string $url The URL to the font definitions
 * @since 0.1
 */
function totcbase_font_uri_no_base_font( $url ) {
	return '';
}

/**
 * Return a font URI that does not include the accent font
 *
 * @param string $url The URL to the font definitions
 * @since 0.1
 */
function totcbase_font_uri_no_accent_font( $url ) {
	return '';
}

// Add theme support
add_theme_support( 'typecase', totcbase_typecase_get_settings() );
