<?php
/**
 * Functions used to integrate with the theme-painter library
 *
 * @package Theme_of_the_Crop_Base_Theme
 */
function totcbase_get_theme_painter_args() {

	$args = array(

		// URL path to the theme-painter library
		'lib_url' => get_template_directory_uri() . '/lib/theme-painter',

		// The handle of the stylesheet to add inline styles to
		'stylesheet' => 'totcbase',

		'sections' => array(

			'general' => array(
				'title' => esc_html__( 'Theme Colors', 'totcbase' ),
				'priority' => 20,
				'colors' => array(
					'background' => array(
						'label' => esc_html__( 'Background Color', 'totcbase' ),
						'description' => esc_html__( 'The primary background color on your site.', 'totcbase' ),
						'selectors' => array(
							totcbase_tp( 'background' ),
						),
						'attributes' => array(
							'background',
						),
						'default' => '#fff',
					),
					'accent' =>array(
						'label' => esc_html__( 'Accent Color', 'totcbase' ),
						'description' => esc_html__( 'A dominant offset color used throughout the theme for links, buttons and other attention-grabbing items.', 'totcbase' ),
						'selectors' => array(
							totcbase_tp( 'accent' ),
						),
						'attributes' => array(
							'color',
						),
						'default' => '#69d',
					),
					'accent-lift' =>array(
						'label' => esc_html__( 'Accent Hover Color', 'totcbase' ),
						'description' => esc_html__( 'A lighter shade of the Accent Color used for hover effects.', 'totcbase' ),
						'selectors' => array(
							totcbase_tp( 'accent-lift' ),
						),
						'attributes' => array(
							'color',
						),
						'default' => '#8bd',
					),
					'text' => array(
						'label' => esc_html__( 'Text Color', 'totcbase' ),
						'description' => esc_html__( 'The main text color. This should stand out clearly from the Background Color so it is easy to read.', 'totcbase' ),
						'selectors' => array(
							totcbase_tp( 'text' ),
						),
						'attributes' => array(
							'color',
						),
						'default' => '#222',
					),
					'text-light' => array(
						'label' => esc_html__( 'Light Text Color', 'totcbase' ),
						'description' => esc_html__( 'A shade used for text that should be less prominent. Often a lighter shade of the Text Color.', 'totcbase' ),
						'selectors' => totcbase_tp( 'text-light' ),
						'attributes' => 'color',
						'default' => '#777',
					),
				),
			),
		),
	);

	return apply_filters( 'totcbase_theme_painter_args', $args );
}

/**
 * Get the requested selectors
 *
 * @since 0.1
 */
function totcbase_tp( $color ) {

	$background_is_dark = theme_painter_is_color_dark( get_theme_mod( 'theme_painter_setting_background', '#fff'  ) );

	set_theme_mod( 'is_dark_background', $background_is_dark );

	$selectors = array();

	switch( $color ) {

		case 'background' :

			$selectors[] = 'html';
			$selectors[] = 'body';
			break;

		case 'accent' :

			$selectors[] = 'a';
			break;

		case 'accent-lift' :

			$selectors[] = 'a:hover';
			$selectors[] = 'a:focus';
			break;

		case 'text' :

			$selectors[] = 'body';
			break;

		case 'text-light' :

			// $selectors[] = '';
			break;

	}

	return join( ',', $selectors );
}

/**
 * Add a body class if any styles need to be adjusted to compensate for
 * color selectons
 *
 * @since 0.1
 */
function totcbase_theme_painter_add_body_class( $classes ) {

	$background_color = get_theme_mod( 'theme_painter_setting_background', '#fff'  );
	if ( $background_color != '#fff' ) {
		$classes[] = get_theme_mod( 'is_dark_background', false ) ? 'totcbase-bg-dark' : 'totcbase-bg-light';
	}

	return $classes;
}
add_filter( 'body_class', 'totcbase_theme_painter_add_body_class' );
