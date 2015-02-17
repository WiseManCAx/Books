<?php
/*
Plugin Name: ProWP2 Settings Example
Plugin URI: http://strangework.com/wordpress-plugins
Description: This is a plugin demonstrating the WordPress Settings API
Version: 1.0
Author: Brad Williams
Author URI: http://strangework.com
License: GPLv2
*/

// create custom plugin settings menu
add_action( 'admin_menu', 'prowp_create_menu' );

function prowp_create_menu() {
	
    //create new top-level menu
    add_menu_page( 'Halloween Plugin Page', 'Halloween Plugin', 'manage_options', 'prowp_main_menu', 'prowp_settings_page', plugins_url( '/images/wordpress.png', __FILE__ ) );

    //call register settings function
    add_action( 'admin_init', 'prowp_register_settings' );
	
}

function prowp_register_settings() {
	
    //register our settings
    register_setting( 'prowp-settings-group', 'prowp_options', 'prowp_sanitize_options' );
	
}

function prowp_sanitize_options( $input ) {

    $input['option_name'] = sanitize_text_field( $input['option_name'] );
    $input['option_email'] = sanitize_email( $input['option_email'] );
    $input['option_url'] = esc_url( $input['option_url'] );

    return $input;

}


function prowp_settings_page() {
?>
	<div class="wrap">
	<h2>Halloween Plugin Options</h2>

	<form method="post" action="options.php">
		<?php settings_fields( 'prowp-settings-group' ); ?>
		<?php $prowp_options = get_option( 'prowp_options' ); ?>
		<table class="form-table">
			<tr valign="top">
			<th scope="row">Name</th>
			<td><input type="text" name="prowp_options[option_name]" value="<?php echo esc_attr( $prowp_options['option_name'] ); ?>" /></td>
			</tr>

			<tr valign="top">
			<th scope="row">Email</th>
			<td><input type="text" name="prowp_options[option_email]" value="<?php echo esc_attr( $prowp_options['option_email'] ); ?>" /></td>
			</tr>

			<tr valign="top">
			<th scope="row">URL</th>
			<td><input type="text" name="prowp_options[option_url]" value="<?php echo esc_url( $prowp_options['option_url'] ); ?>" /></td>
			</tr>
		</table>

		<p class="submit">
			<input type="submit" class="button-primary"	value="Save Changes" />
		</p>

	</form>
	</div>
<?php 
}

