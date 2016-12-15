<?php
/**
 * Theme of the Crop Base Theme Theme Customizer.
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 0.1
 */
function totcbase_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_section( 'title_tagline' )->title = esc_html__( 'Logo, Site Title and Tagline', 'totcbase' );

	// Footer
	$wp_customize->add_section(
		'footer',
		array(
			'capability' => 'edit_theme_options',
			'title'      => __( 'Footer', 'totcbase' ),
		)
	);

	$wp_customize->add_setting(
		'copyright',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'copyright',
		array(
			'label'          => __( 'Copyright', 'totcbase' ),
			'section'        => 'footer',
			'type'           => 'text',
		)
	);

	// Add a notice about theme fonts if the Typecase plugin isn't active
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( !is_plugin_active( 'typecase/typecase.php' ) ) {
		include_once( 'customizer/WP_Customize_Notice_Control.php' );

		$wp_customize->add_section(
			'totcbase_typecase_placeholder',
			array(
				'title'      => __( 'Theme Fonts', 'totcbase' ),
				'priority'   => 30,
			)
		);

		$wp_customize->add_control(
			new TotcBase_WP_Customize_Notice_Control(
				$wp_customize,
				'totcbase_typecase_placeholder',
				array(
					'label'     => __( 'Install Typecase', 'totcbase' ),
					'section'   => 'totcbase_typecase_placeholder',
					'settings'   => array(),
					'content'   => sprintf(
						// Translators: 1 and 2 wrap a link to install the plugin. 3 and 4 wrap a link to documentation on this.
						__( 'Install and activate the %1$sTypecase plugin%2$s if you would like to change the fonts used on your site. %3$sLearn more%4$s', 'totcbase' ),
						'<a href="' . esc_url( admin_url( 'plugin-install.php?tab=plugin-information&plugin=typecase' ) ) . '" target="_blank">',
						'</a>',
						'<a href="http://doc.themeofthecrop.com/themes/totcbase/user/faq#typecase" target="_blank">',
						'</a>'
					),
				)
			)
		);
	}
}
add_action( 'customize_register', 'totcbase_customize_register' );

/**
 * Load assets to handle the customizer control panel
 *
 * @since 0.1.0
 */
function totcbase_customizer_enqueue_control_assets() {

	// Maybe load minified scripts
	$min = SCRIPT_DEBUG ? '' : 'min.';

	wp_enqueue_style( 'totcbase-customizer-control', get_template_directory_uri() . '/assets/css/customizer-control.' . $min . 'css', '0.1.0' );
	wp_enqueue_script( 'totcbase-customizer-control', get_template_directory_uri() . '/assets/js/customizer-control.' . $min . 'js', array( 'customize-controls' ), '0.1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'totcbase_customizer_enqueue_control_assets' );
