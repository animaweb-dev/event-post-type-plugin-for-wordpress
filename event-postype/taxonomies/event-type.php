<?php


add_action( 'init', 'custom_taxonomy_event_type', 0 );    
function custom_taxonomy_event_type() {
   $labels = array(
       'name'                       => _x( 'Events type', 'Taxonomy General Name', 'event-postype' ),
       'singular_name'              => _x( 'Event type', 'Taxonomy Singular Name', '__' ),
       'menu_name'                  => __( 'Event type', '__' ),
       'all_items'                  => __( 'all Event types', 'event-postype' ),
       'parent_item'                => __( ' parent event type', 'event-postype' ),
       'parent_item_colon'          => __( ' parent event type', 'event-postype' ),
       'new_item_name'              => __( 'new event type ', 'event-postype' ),
       'add_new_item'               => __( ' add event type     ', 'event-postype' ),
       'edit_item'                  => __( 'edit event type    ', 'event-postype' ),
       'update_item'                => __( 'update event type', 'event-postype' ),
       'view_item'                  => __( 'show event type ', 'event-postype' ),
       'separate_items_with_commas' => __( 'separate with "," ', 'event-postype' ),
       'add_or_remove_items'        => __( 'add/remove event type', 'event-postype' ),
       'choose_from_most_used'      => __( 'select from most used', 'event-postype' ),
       'popular_items'              => __( 'popular event types', 'event-postype' ),
       'search_items'               => __( 'search event type', 'event-postype' ),
       'not_found'                  => __( ' not found', 'event-postype' ),
       'no_terms'                   => __( 'no terms  ', 'event-postype' ),
       'items_list'                 => __( ' event type list', 'event-postype' ),
       'items_list_navigation'      => __( 'event type list navigation', 'event-postype' ),
   );
   $args = array(
       'labels'                     => $labels,
       'hierarchical'               => true,
       'public'                     => true,
       'show_ui'                    => true,
       'show_admin_column'          => true,
       'show_in_nav_menus'          => true,
       'show_tagcloud'              => true,
       'rewrite'            => array( 'with_front'=> false ),
       'has_archive'         => true,
       'exclude_from_search' => false,
       'publicly_queryable'  => true,
       'show_in_rest' => true,
       'rest_base'             => 'event-type',
       'rest_controller_class' => 'WP_REST_Terms_Controller',
   );
   register_taxonomy( 'event-type', array( 'event' ), $args );
   }

