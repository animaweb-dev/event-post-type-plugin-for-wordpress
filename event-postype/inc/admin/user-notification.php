<?php
add_action('transition_post_status', 'user_event_notification', 10, 3);
function user_event_notification( $new_status, $old_status, $post ) {
    if ( 'publish' == $new_status && get_post_type( $post ) == 'event' ) {
        $post = get_post($post_id);
        $subject = " new event : ".$post->post_title."";
        $users = get_users( array( 'role__in' => array('subscriber' ) ) );
        foreach( $users as $user ) {
            $message = "Hi ".$user->display_name.",
            new event to come, \"".$post->post_title."\".
            More info: ".get_permalink( $post_id )."";
            wp_mail( $user->user_email,$subject, $message);
        }
    }
}



