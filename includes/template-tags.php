<?php
/**
 * Custom template tags for this theme.
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

/**
 * Print the logo
 *
 * @since 0.1.0
 */
function totcbase_print_logo( $logo_setting = 'site_logo', $scale_setting = 'site_logo_scale' ) {

	$logo_url = wp_get_attachment_url( get_theme_mod( $logo_setting ) );
	if ( !$logo_url ) {
		return;
	}

	$scale = get_theme_mod( $scale_setting, 100 );
	$scale = $scale == 100 ? '' : ' style="max-width: ' . absint( $scale ) . 'px"';
	?>

	<img src="<?php echo esc_url( $logo_url ); ?>" class="logo-image" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"<?php echo $scale; ?>>

	<?php
}

/**
 * Print the footer logo
 *
 * @since 0.1
 */
function totcbase_print_footer_logo() {
	totcbase_print_logo( 'footer_logo', 'footer_logo_scale' );
}

/**
 * Retrieve the URL for an attachment image
 *
 * @since 0.1
 */
function totcbase_get_attachment_img_src_url( $attachment_id, $size ) {
	$img = wp_get_attachment_image_src( $attachment_id, $size );
	return $img[0];
}

/**
 * Print the phone number from their Business Profile
 *
 * @since 0.1.0
 */
function totcbase_print_phone() {
	if ( function_exists( 'bpwfwp_print_contact_card' ) ) {
		echo bpwfwp_print_contact_card(
			array(
				'show_name'                 => false,
				'show_address'              => false,
				'show_get_directions'       => false,
				'show_phone'                => true,
				'show_contact'              => false,
				'show_opening_hours'        => false,
				'show_opening_hours_brief'  => false,
				'show_map'                  => false,
				'show_booking_link'         => false,
			)
		);
	}
}

/**
 * Check if a setting in exists in their business profile
 *
 * @since 0.1.0
 */
function totcbase_bp_setting_exists( $setting ) {

	global $bpfwp_controller;
	if ( !isset( $bpfwp_controller ) ) {
		return false;
	}

	$setting = $bpfwp_controller->settings->get_setting( $setting );
	return !empty( $setting );
}

/**
 * Check if a setting exists in restaurant reservations
 *
 * @since 0.1.0
 */
function totcbase_rtb_setting_exists( $setting ) {

	global $rtb_controller;
	if ( !isset( $rtb_controller ) ) {
		return false;
	}

	$setting = $rtb_controller->settings->get_setting( $setting );
	return !empty( $setting );
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * Helper function taken from _s: https://github.com/Automattic/_s/
 *
 * @return bool
 * @since 0.1.0
 */
function totcbase_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'totcbase_categories' ) ) ) {
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );
		$all_the_cool_cats = count( $all_the_cool_cats );
		set_transient( 'totcbase_categories', $all_the_cool_cats );
	}
	return $all_the_cool_cats > 1;
}

/**
 * Flush out the transients used in totcbase_categorized_blog.
 */
function totcbase_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'totcbase_categories' );
}
add_action( 'edit_category', 'totcbase_category_transient_flusher' );
add_action( 'save_post',     'totcbase_category_transient_flusher' );

/**
 * Check if a menu has two columns
 *
 * @since 0.1
 */
function totcbase_menu_has_two_cols( $id = 0 ) {
	$id = $id ? $id : get_the_ID();
	$has_two_cols = get_post_meta( get_the_ID(), 'fdm_menu_column_two', true );

	return !empty( $has_two_cols );
}

/**
 * Wrapper for the_posts_navigation which defines the locale strings in one
 * place.
 *
 * @since 0.1
 */
function totcbase_the_posts_navigation() {
	the_posts_navigation(
		array(
			'prev_text' => esc_html__( '&larr; Older posts', 'totcbase' ),
			'next_text' => esc_html__( 'Newer posts &rarr;', 'totcbase' ),
		)
	);
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 0.1
 */
function totcbase_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		sprintf( esc_html__( 'Updated on %s', 'totcbase' ), get_the_modified_date() )
	);

	echo '<span class="posted-on">' . $time_string . '</span>';
}

/**
 * Prints HTML with meta information for the post author
 *
 * @since 0.1
 */
function totcbase_posted_by() {

	if ( !is_multi_author() ) {
		return '';
	}

	$byline = sprintf(
		esc_html_x( 'By %s', 'post author', 'totcbase' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>';
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 *
 * @since 0.1
 */
function totcbase_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'totcbase' ) );
		if ( $categories_list && totcbase_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'totcbase' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'totcbase' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'totcbase' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'totcbase' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'totcbase' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
