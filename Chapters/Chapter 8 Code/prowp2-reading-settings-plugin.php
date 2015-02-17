<?php
/*
Plugin Name: ProWP2 Reading Settings Example
Plugin URI: http://strangework.com/wordpress-plugins
Description: This is a plugin demonstrating adding options to an existing settings page
Version: 1.0
Author: Brad Williams
Author URI: http://strangework.com
License: GPLv2
*/

//execute our settings section function
add_action( 'admin_init', 'prowp_settings_init' );

function prowp_settings_init() {
	
    //create the new setting section on the Settings > Reading page
    add_settings_section( 'prowp_setting_section', 'Halloween Plugin Settings', 'prowp_setting_section', 'reading' );

    // register the individual setting options
    add_settings_field( 'prowp_setting_enable_id', 'Enable Halloween Feature?',	'prowp_setting_enabled', 'reading', 'prowp_setting_section' );
	
    add_settings_field( 'prowp_saved_setting_name_id', 'Your Name',	'prowp_setting_name', 'reading', 'prowp_setting_section' );

    // register the setting to store our array of values
    register_setting( 'reading', 'prowp_setting_values', 'prowp_sanitize_settings' );
	
}

function prowp_sanitize_settings( $input ) {
	
	$input['enabled'] = ( $input['enabled'] == 'on' ) ? 'on' : '';
	$input['name'] = sanitize_text_field( $input['name'] );
	
	return $input;
	
}

// settings section
function prowp_setting_section() {
    echo '<p>Configure the Halloween plugin options below</p>';
}

// create the enabled checkbox option to save the checkbox value
function prowp_setting_enabled() {
	
    //load plugin options
    $prowp_options = get_option( 'prowp_setting_values' );

    //display the checkbox form field
    echo '<input '.checked( $prowp_options['enabled'], 'on', false ).' name="prowp_setting_values[enabled]" type="checkbox" /> Enabled';

}

// create the text field setting to save the name
function prowp_setting_name() {

	//load the option value
    $prowp_options = get_option( 'prowp_setting_values' );

    //display the text form field
    echo '<input type="text" name="prowp_setting_values[name]" value="'.esc_attr( $prowp_options['name'] ).'" />';
	
}
