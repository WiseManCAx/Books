<?php
/*
Plugin Name: ProWP2 Custom Meta Box Plugin
Plugin URI: http://strangework.com/wordpress-plugins
Description: This is a plugin demonstrating meta boxes in WordPress
Version: 1.0
Author: Brad Williams
Author URI: http://strangework.com
License: GPLv2
*/

add_action( 'add_meta_boxes', 'prowp_meta_box_init' );

// meta box functions for adding the meta box and saving the data
function prowp_meta_box_init() {
    
    // create our custom meta box
    add_meta_box( 'prowp-meta', 'Product Information', 'prowp_meta_box', 'post', 'side', 'default' );
    
}

function prowp_meta_box( $post, $box ) {
    
    // retrieve the custom meta box values
    $prowp_featured = get_post_meta( $post->ID, '_prowp_type', true );
    $prowp_price = get_post_meta( $post->ID, '_prowp_price', true );

    //nonce for security
    wp_nonce_field( plugin_basename( __FILE__ ), 'prowp_save_meta_box' );
    
    // custom meta box form elements
    echo '<p>Price: <input type="text" name="prowp_price" value="'.esc_attr( $prowp_price ).'" size="5" /></p>';
    echo '<p>Type: 
        <select name="prowp_product_type" id="prowp_product_type">
           <option value="0" ' .selected( $prowp_featured, 'normal', false ). '>Normal</option>
            <option value="special" ' .selected( $prowp_featured, 'special', false ). '>Special</option>
            <option value="featured" ' .selected( $prowp_featured, 'featured', false ). '>Featured</option>
            <option value="clearance" ' .selected( $prowp_featured, 'clearance', false ). '>Clearance</option>
        </select></p>';
    
}

// hook to save our meta box data when the post is saved
add_action( 'save_post', 'prowp_save_meta_box' );

function prowp_save_meta_box( $post_id ) {
    
    // process form data if $_POST is set
    if( isset( $_POST['prowp_product_type'] ) ) {
	
		// if auto saving skip saving our meta box data
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return;

		//check nonce for security
		check_admin_referer( plugin_basename( __FILE__ ), 'prowp_save_meta_box' );
        
        // save the meta box data as post meta using the post ID as a unique prefix
        update_post_meta( $post_id, '_prowp_type', sanitize_text_field( $_POST['prowp_product_type'] ) );
        update_post_meta( $post_id, '_prowp_price', sanitize_text_field( $_POST['prowp_price'] ) );
        
    }
    
}
