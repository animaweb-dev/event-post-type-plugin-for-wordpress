<?php
/**
 * Plugin Name:     event postype
 * Plugin URI:      https://tnasr.com/tets-plugin
 * Description:     This plugin will create custom post type and taxonomy
 * Author:          alireza-tayefi
 * Author URI:      https://tnasr.com
 * Text Domain:     event-postype
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         event-postype
 */

 
// plugin files path & url 
define('WF_DIR', plugin_dir_path( __FILE__ ));
define('WF_URL', plugin_dir_url( __FILE__ ));
define('WF_INC', WF_DIR.'/inc/');

//update permalinks after activation
function event_plugin_activate() {
    // Flush rewrite rules
    flush_rewrite_rules();
}
register_activation_hook( WF_DIR, 'event_plugin_activate' );

//load string translate
add_action( 'init', 'event_load_textdomain' );
function event_load_textdomain() {
	load_plugin_textdomain( 'event-postype', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

// include post type
require('post-types/event.php');
// include taxonomy
require('taxonomies/event-type.php');
//include general codes
require('inc/user/main.php');


//admin files
if(is_admin()){
    // include metaboxes
    include WF_INC.'admin/plugin-style-script.php';
    include WF_INC.'admin/metaboxes.php';
    include WF_INC.'admin/event-list.php';
    include WF_INC.'admin/user-notification.php';
}






