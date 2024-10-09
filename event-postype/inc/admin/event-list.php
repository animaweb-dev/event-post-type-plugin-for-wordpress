<?php
// show date and location of events in admin event list
function custom_columns($columns)
{
    return array_merge(
        $columns,
        array(
            'eventdate' => __('Event Date'),
            'location' => __('location'),
        )
    );
}
add_filter('manage_event_posts_columns', 'custom_columns');

function display_custom_columns($column, $post_id)
{
    switch ($column) {
        case 'eventdate':
            echo get_post_meta($post_id, 'event_date', true);
            break;
        case 'location':
            echo get_post_meta($post_id, 'event_location', true);
            break;
    }
}
add_action('manage_event_posts_custom_column', 'display_custom_columns', 10, 2);