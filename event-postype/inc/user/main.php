<?php

//styles and script needed in front
function event_plugin_script_style() {
    $version = '1.0.0';
    wp_enqueue_style( 'bootstrap.min', WF_URL . 'assets/css/bootstrap.min.css', array(), $version );
    wp_enqueue_style( 'base', WF_URL . 'assets/css/base.css', array(), $version );
    wp_enqueue_style( 'plugin-taxonomy', WF_URL . 'assets/css/plugin-taxonomy.css', array(), $version );
    wp_enqueue_style( 'plugin-single', WF_URL . 'assets/css/plugin-single.css', array(), $version );

// js files========================================================================
    wp_enqueue_script( 'jquery-3.min', WF_URL . 'assets/js/jquery-3.6.0.min.js', array(), $version, true );
	wp_enqueue_script( 'mixitup.min', WF_URL . 'assets/js/mixitup.min.js', array(), $version, true);
	wp_enqueue_script( 'plugin-main', WF_URL . 'assets/js/plugin-main.js', array(), $version, true);


// comment reply
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
}
}
add_action( 'wp_enqueue_scripts', 'event_plugin_script_style' );

//calling custom templates for archive/event-type taxonomy/single event
add_filter( 'template_include', 'my_plugin_templates' );
function my_plugin_templates( $template ) {
    $post_type = 'event';
    $taxonomy = 'event-type';
    if ( is_post_type_archive( $post_type ) && file_exists( WF_DIR . "templates/archive-$post_type.php" ) ){
        $template = WF_DIR . "templates/archive-$post_type.php";
    }
    if ( is_singular( $post_type ) && file_exists( WF_DIR . "templates/single-$post_type.php" ) ){
        $template = WF_DIR . "templates/single-$post_type.php";
    }
    if ( is_tax( $taxonomy ) && file_exists( WF_DIR . "templates/taxonomy-$taxonomy.php" ) ){
        $template = WF_DIR . "templates/taxonomy-$taxonomy.php";
    }
    return $template;
}



//build the rest api
add_action( 'rest_api_init', 'register_event_rest_route' );
function register_event_rest_route(){
	register_rest_route(
		'custom/v2',
		'/event',
		array(
			'methods' => 'GET',
			'callback' => 'get_events',
		)
	);
}
function get_events() {
    $events = array();
    $args = array(
        'post_type' => 'event',
        'nopaging' => true,
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $event_type='';
            $terms = get_the_terms( get_the_ID() , 'event-type' );
            foreach ( $terms as $term ) {
                $event_type = $term->name;
            }
            $events_data = array(
                'title' => get_the_title(),
                'date' => get_post_meta(get_the_ID(),'event_date',true),
                'location' => get_post_meta(get_the_ID(),'event_location',true),
                'event-type' => $event_type,
                'content' => get_the_content(),
            );
            $events[] = $events_data;
        }
        wp_reset_postdata();
    }
    return rest_ensure_response( $events );
    }