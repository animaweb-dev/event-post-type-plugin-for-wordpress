<?php

/**
 * Registers the `event` post type.
 */
function event_init() {
	register_post_type(
		'event',
		[
			'labels'                => [
				'name'                  => __( 'Events', 'event-postype' ),
				'singular_name'         => __( 'Event', 'event-postype' ),
				'all_items'             => __( 'All Events', 'event-postype' ),
				'archives'              => __( 'Event Archives', 'event-postype' ),
				'attributes'            => __( 'Event Attributes', 'event-postype' ),
				'insert_into_item'      => __( 'Insert into Event', 'event-postype' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Event', 'event-postype' ),
				'featured_image'        => _x( 'Featured Image', 'event', 'event-postype' ),
				'set_featured_image'    => _x( 'Set featured image', 'event', 'event-postype' ),
				'remove_featured_image' => _x( 'Remove featured image', 'event', 'event-postype' ),
				'use_featured_image'    => _x( 'Use as featured image', 'event', 'event-postype' ),
				'filter_items_list'     => __( 'Filter Events list', 'event-postype' ),
				'items_list_navigation' => __( 'Events list navigation', 'event-postype' ),
				'items_list'            => __( 'Events list', 'event-postype' ),
				'new_item'              => __( 'New Event', 'event-postype' ),
				'add_new'               => __( 'Add New', 'event-postype' ),
				'add_new_item'          => __( 'Add New Event', 'event-postype' ),
				'edit_item'             => __( 'Edit Event', 'event-postype' ),
				'view_item'             => __( 'View Event', 'event-postype' ),
				'view_items'            => __( 'View Events', 'event-postype' ),
				'search_items'          => __( 'Search Events', 'event-postype' ),
				'not_found'             => __( 'No Events found', 'event-postype' ),
				'not_found_in_trash'    => __( 'No Events found in trash', 'event-postype' ),
				'parent_item_colon'     => __( 'Parent Event:', 'event-postype' ),
				'menu_name'             => __( 'Events', 'event-postype' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),                
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-calendar-alt',
			'show_in_rest'          => true,
			'rest_base'             => 'event',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'register_meta_box_cb' => 'adding_custome_metaboxes'

		]
	);

}

add_action( 'init', 'event_init' );

/**
 * Sets the post updated messages for the `event` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `event` post type.
 */
function event_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['event'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Event updated. <a target="_blank" href="%s">View Event</a>', 'event-postype' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'event-postype' ),
		3  => __( 'Custom field deleted.', 'event-postype' ),
		4  => __( 'Event updated.', 'event-postype' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Event restored to revision from %s', 'event-postype' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Event published. <a href="%s">View Event</a>', 'event-postype' ), esc_url( $permalink ) ),
		7  => __( 'Event saved.', 'event-postype' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Event submitted. <a target="_blank" href="%s">Preview Event</a>', 'event-postype' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Event</a>', 'event-postype' ), date_i18n( __( 'M j, Y @ G:i', 'event-postype' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Event draft updated. <a target="_blank" href="%s">Preview Event</a>', 'event-postype' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'event_updated_messages' );

/**
 * Sets the bulk post updated messages for the `event` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `event` post type.
 */
function event_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['event'] = [
		/* translators: %s: Number of Events. */
		'updated'   => _n( '%s Event updated.', '%s Events updated.', $bulk_counts['updated'], 'event-postype' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Event not updated, somebody is editing it.', 'event-postype' ) :
						/* translators: %s: Number of Events. */
						_n( '%s Event not updated, somebody is editing it.', '%s Events not updated, somebody is editing them.', $bulk_counts['locked'], 'event-postype' ),
		/* translators: %s: Number of Events. */
		'deleted'   => _n( '%s Event permanently deleted.', '%s Events permanently deleted.', $bulk_counts['deleted'], 'event-postype' ),
		/* translators: %s: Number of Events. */
		'trashed'   => _n( '%s Event moved to the Trash.', '%s Events moved to the Trash.', $bulk_counts['trashed'], 'event-postype' ),
		/* translators: %s: Number of Events. */
		'untrashed' => _n( '%s Event restored from the Trash.', '%s Events restored from the Trash.', $bulk_counts['untrashed'], 'event-postype' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'event_bulk_updated_messages', 10, 2 );
