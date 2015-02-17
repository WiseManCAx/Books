<?php
/*
Plugin Name: ProWP2 Multsite Shortcode Example
Plugin URI: http://strangework.com/wordpress-plugins
Description: A shortcode to display posts from any site in your network
Version: 1.0
Author: Brad Williams
Author URI: http://strangework.com
License: GPLv2
*/

add_shortcode( 'show_network_posts', 'prowp_get_network_posts' );

function prowp_get_network_posts( $atts ) {
     extract( shortcode_atts( array(
	      'blog_id' => '1'
     ), $atts ) );
	 
	//verify Multisite is enabled
	if ( is_multisite() ) {
		
		//switch to blog ID 10
		switch_to_blog( absint( $blog_id ) );
		
		//create a custom loop
		$recent_posts = new WP_Query();
		$recent_posts->query( 'posts_per_page=5' );

		$site_posts = '';
		
		//star the custom loop
		while ( $recent_posts->have_posts() ) :
			$recent_posts->the_post();
		
			//store the recent posts in a variable
			$site_posts .= '<p><a href="'.get_permalink().'">'.get_the_title().'</a></p>';
		
		endwhile;
		
		//restore the current site
		restore_current_blog();
		
	}
	
	//return the posts
	return $site_posts;
	
}

?>
