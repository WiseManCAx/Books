<?php
/*
Plugin Name: Format endpoint
Plugin URI: http://example.com/
Description: Add a /format/ endpoint to all URLs
Version: 1.0
Author: Ozh
Author URI: http://wrox.com
*/


// Add permalink structure and flush on plugin activation
register_activation_hook( __FILE__, 'boj_ep_activate' );
function boj_ep_activate() {
    boj_ep_add_rules();
    flush_rewrite_rules();
}

// Flush on plugin deactivation
register_deactivation_hook( __FILE__, 'boj_ep_deactivate' );
function boj_ep_deactivate(){
    flush_rewrite_rules();
}


// Add the endpoint rewrite rules
add_filter( 'init', 'boj_ep_add_rules' );
function boj_ep_add_rules() {
    add_rewrite_endpoint( 'format', EP_ALL );
}

// Handle the custom format display if needed
add_filter( 'template_redirect', 'boj_ep_template_redirect' );
function boj_ep_template_redirect() {
    switch( get_query_var( 'format' ) ) {
        case 'qr':
            boj_ep_display_qr();
            exit;
        case 'json':
            if( is_singular() ) {
                boj_ep_display_json();
                exit;
            }
    }
}

// Display JSON information about the post
function boj_ep_display_json() {
    global $post;
    header('Content-type: application/json');
    echo json_encode( $post );
    exit;
}

// Display a QR code
function boj_ep_display_qr() {
    // get current location and strip /format/qr/ from the URL
    $url = ( is_ssl() ? 'https://' : 'http://' )
        . $_SERVER['HTTP_HOST']
        . preg_replace( '!/format/qr/$!', '/', $_SERVER['REQUEST_URI'] );
    
    // encode URL so it can be used for the QR code query
    $url = urlencode( $url );
    
    // Google QR code URL:
    $qr = "http://chart.apis.google.com/chart?chs=150x150&cht=qr&chl="
        . $url . "&chld=L|0";
    
    // Get the image generated by Google
    $image = wp_remote_retrieve_body( wp_remote_get( $qr ) );

    // Display QR code image
    header( 'Content-Type: image/png' );
    echo $image;
    exit;
}