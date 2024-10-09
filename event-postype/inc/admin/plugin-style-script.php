<?php
function plugin_admin_style() {
    $version = '1.0.0';
    wp_enqueue_style( 'persian-datepicker', WF_URL . 'assets/css/persian-datepicker.min.css', array(), $version );
    wp_enqueue_style( 'admin', WF_URL . 'assets/css/admin.css', array(), $version );
    wp_enqueue_script( 'persian-date', WF_URL . 'assets/js/persian-date.min.js', array(), $version, true );
    wp_enqueue_script( 'persian-datepicker', WF_URL . 'assets/js/persian-datepicker.min.js', array(), $version, true );
    wp_enqueue_script( 'admin', WF_URL . 'assets/js/admin.js', array(), $version, true );
}
add_action('admin_enqueue_scripts', 'plugin_admin_style');












