<?php
/**
 * Functions used to integrate with the Event Organiser plugin
 *
 * @package Theme_of_the_Crop_Base_Theme
 */
/**
 * Modify the events archive page title
 *
 * @since 0.1
 */
function totcbase_eo_set_archive_title( $title ) {

	if ( is_post_type_archive( 'event' ) ) {
		return post_type_archive_title( '', false );
	} else if ( is_tax( 'event-category' ) || is_tax( 'event-tag' ) ) {
		return single_term_title( esc_html__( 'Events: ', 'totcbase' ), false);
	} else if ( is_tax( 'event-venue' ) ) {
		return single_term_title( '', false );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'totcbase_eo_set_archive_title' );

/**
 * Output a brief representation of an event date
 *
 * This wrapper prints out a single date or a date range if the event
 * recurs. Expects to be called during the loop.
 *
 * @param bool $show_occurrence_date Whether or not to show the date range or
 *  a single occurrence for recurring events. Default: show a date range
 * @since 0.1
 */
function totcbase_eo_format_brief_date( $show_occurrence_date = false ) {

	if ( !function_exists( 'eo_format_event_occurrence' ) || !function_exists( 'eo_recurs' ) || !function_exists( 'eo_get_schedule_start' ) || !function_exists( 'eo_get_schedule_last' ) ) {
		return '';
	}

	if ( eo_recurs() && !$show_occurrence_date ) {
		return sprintf( esc_html_x( '%1$s&mdash;%2$s', 'Brief format of start and end dates of recurring events.', 'totcbase' ), eo_get_schedule_start( get_option( 'date_format' ) ), eo_get_schedule_last( get_option( 'date_format' ) ) );
	}

	return eo_format_event_occurrence();
}

/**
 * Wrapper for the eo_recurs() function
 *
 * @since 0.1
 */
function totcbase_eo_recurs() {
	return function_exists( 'eo_recurs' ) && eo_recurs();
}

/**
 * Compile a description for a recurring event's timeline.
 *
 * This returns a string representing the start and end date if the event
 * still has recurrences in the future. Otherwise it will return a string
 * saying the event is finished.
 *
 * @since 0.1
 */
function totcbase_eo_get_recurrence_description() {

	if ( !function_exists( 'eo_get_next_occurrence' ) || !function_exists( 'eo_get_event_datetime_format' ) || !function_exists( 'eo_get_schedule_start' ) || !function_exists( 'eo_get_schedule_last' ) ) {
		return '';
	}

	$next = eo_get_next_occurrence( eo_get_event_datetime_format() );

	if ( $next ) {
		$start_date = eo_get_schedule_start( get_option( 'date_format' ) );
		$last_date = eo_get_schedule_last( get_option( 'date_format' ) );
		$next = '<span class="next-occurrence">' . $next . '</span>';

		return sprintf( esc_html__( 'This event will run from %1$s to %2$s. It will happen next on %3$s.', 'totcbase' ), $start_date, $last_date, $next );
	}

	return sprintf( esc_html__( 'This event finished on %s', 'totcbase' ), eo_get_schedule_last( get_option( 'date_format' ) ) );
}

/**
 * Wrapper for the eo_format_event_occurrence() function
 *
 * @since 0.1
 */
function totcbase_eo_format_event_occurrence() {
	return function_exists( 'eo_format_event_occurrence' ) ? eo_format_event_occurrence() : '';
}

/**
 * Output a venue map
 *
 * This wrapper prints the eo_get_venue_map() output after checking to make
 * sure that a venue exists.
 *
 * @since 0.1
 */
function totcbase_eo_maybe_print_venue_map( $venue = 0, $map_args = array() ) {

	if ( !function_exists( 'eo_get_venue' ) || !function_exists( 'eo_get_venue_map' ) || !function_exists( 'eo_venue_has_latlng' ) ) {
		return '';
	}

	if ( !is_int( $venue ) || !$venue ) {
		$venue = eo_get_venue();
	}

	if ( $venue && eo_venue_has_latlng( $venue ) ) {
		return eo_get_venue_map( $venue, $map_args );
	}

	return '';
}

/**
 * Wrapper for the eo_get_venue() function
 *
 * @since 0.1
 */
function totcbase_eo_get_venue() {
	return function_exists( 'eo_get_venue' ) ? eo_get_venue() : '';
}

/**
 * Wrapper for the eo_get_venue_link() function
 *
 * @since 0.1
 */
function totcbase_eo_get_venue_link() {
	return function_exists( 'eo_venue_link' ) ? eo_get_venue_link() : '';
}

/**
 * Wrapper for the eo_venue_name() function
 *
 * @since 0.1
 */
function totcbase_eo_venue_name() {
 	if ( function_exists( 'eo_venue_name' ) ) {
		eo_venue_name();
	} else {
		echo '';
	}
}

/**
 * Swap the language for older/later events
 *
 * The event archives are in ASC order rather than DSC order, so page 2
 * shows events later than page 1. For this reason, the language for
 * "next" and "prev" pages needs to be reversed.
 *
 * @since 0.1
 */
function totcbase_eo_the_posts_navigation() {
	the_posts_navigation(
		array(
			'next_text' => esc_html__( '&larr; Older events', 'totcbase' ),
			'prev_text' => esc_html__( 'Later events &rarr;', 'totcbase' ),
		)
	);
}
