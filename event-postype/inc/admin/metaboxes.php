<?php

//create metaboxes for date and location of the event
add_action( 'add_meta_boxes', 'adding_custome_metaboxes',10,2 );
function adding_custome_metaboxes(){
    add_meta_box( 
        'event_date', 
        __( 'Event Date', 'event-postype' ), 
        'load_metabox_date',
        'event', 
        'normal', 
        'default', 
    );
    add_meta_box( 
        'event_location', 
        __( 'Event Location', 'event-postype' ), 
        'load_metabox_location',
        'event', 
        'normal', 
        'default', 
    );
}

//show meta datas
function load_metabox_date($post){
        wp_nonce_field( 'event_date_nonce', 'event_date_nonce' );
        $post_meta_date= get_post_meta($post->ID, 'event_date',true );

        echo '<input id="events_date" type="text" name="event_box_date" value=" '.$post_meta_date.'" >' ;
        // echo '<input id="events_date_int" type="hidden" name="event_box_date" value="" >' ;
}
function load_metabox_location($post){
        wp_nonce_field( 'event_location_nonce', 'event_location_nonce' );
        $post_meta_location= get_post_meta($post->ID, 'event_location',true );
        
        echo '<input type="text" name="event_box_location" value=" '.$post_meta_location.'" >' ;
}

// save metabox after validation
add_action( 'save_post', 'wp_metabox_save' );

// function for saving metabox info
function wp_metabox_save($post_id){
    // Check the nonce.
    if ( ! isset( $_POST['event_date_nonce'] ) || ! isset( $_POST['event_location_nonce'] ) ) {
        return;
    }
    // Check the nonce.
    if ( ! wp_verify_nonce( $_POST['event_date_nonce'], 'event_date_nonce' ) || ! wp_verify_nonce( $_POST['event_location_nonce'], 'event_location_nonce' ) ) {
        return;
    }
    // Check the autosave.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    }
    else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    // save metaboxes
    if(isset($_POST['event_box_date'])){
        // update meta in database
        $metabox_date = sanitize_text_field( $_POST['event_box_date'] );
        update_post_meta($post_id, 'event_date' , $metabox_date );
    }
    if(isset($_POST['event_box_location'])){
        // update meta in database
        $metabox_location = sanitize_text_field( $_POST['event_box_location'] );
        update_post_meta($post_id, 'event_location' , $metabox_location );
    }


}


