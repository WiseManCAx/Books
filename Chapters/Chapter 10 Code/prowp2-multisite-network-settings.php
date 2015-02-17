<?php
/*
Plugin Name: ProWP2 Network Settings Example
Plugin URI: http://strangework.com/wordpress-plugins
Description: This is a plugin demonstrating the Multisite Network WordPress Settings
Version: 1.0
Author: Brad Williams
Author URI: http://strangework.com
License: GPLv2
*/

add_action( 'init', 'prowp_network_settings_menu' );

function prowp_network_settings_menu() {
	
	if ( is_multisite() ) { 
		
		//Multisite is enabled so add menu to Network Admin
		add_action( 'network_admin_menu', 'prowp_add_network_settings_menu' );

	} else {
		
		//Multisite is NOT enabled so add menu to WordPress Admin
		add_action( 'admin_menu', 'prowp_add_network_settings_menu' );

	}

}

function prowp_add_network_settings_menu() {
	
	//add settings menu
	add_menu_page( 'Network Options Page', 'Network Options', 'manage_options', 'prowp-network-settings', 'prowp_network_settings' );

}

//generate the settings page
function prowp_network_settings() {
	?>
	<div class="wrap" >
		<div id="icon-options-general" class="icon32"></div>
		<h2>Network Settings</h2>
		<form method="post">
			<?php 
			//load option values
			$network_settings = get_site_option( 'prowp_network_settings' ); 
			$api_key = $network_settings['api_key'];
			$holiday = $network_settings['holiday'];
			$rage_mode = ( ! empty( $network_settings['rage_mode'] ) ) ? $network_settings['rage_mode'] : '';
			
			//create nonce hidden field for security
			wp_nonce_field( 'save-network-settings', 'prowp-network-plugin' );
			?>
			<table class="form-table">
				<tr valign="top"><th scope="row">API Key:</th>
					<td><input type="text" name="network_settings[api_key]" value="<?php echo esc_attr( $api_key ); ?>" /></td>
				</tr>
				<tr valign="top"><th scope="row">Network Holiday</th>
					<td>
                        <select name="network_settings[holiday]">
                            <option value="halloween" <?php selected( $holiday, 'halloween' ); ?> >Halloween</option>
							<option value="christmas" <?php selected( $holiday, 'christmas' ); ?> >Christmas</option>
							<option value="april_fools" <?php selected( $holiday, 'april_fools' ); ?> >April Fools</option>
                        </select>
					</td>
				</tr>
				<tr valign="top"><th scope="row">Rage Mode:</th>
					<td><input type="checkbox" name="network_settings[rage_mode]" <?php checked( $rage_mode, 'on' ); ?> /> Enabled</td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" class="button-primary" name="network_settings_save" value="Save Settings" />
			</p>
		</form>
	</div>
	<?php
}

add_action( 'admin_init', 'prowp_save_network_settings' );

//save the option values
function prowp_save_network_settings() {
	
	//if network settings are being saved, process it
	if ( isset( $_POST['network_settings'] ) ) {
		
		//check nonce for security
		check_admin_referer( 'save-network-settings', 'prowp-network-plugin' );
		
		//store option values in a variable
		$network_settings = $_POST['network_settings'];
		
		//use array map function to sanitize option values
		$network_settings = array_map( 'sanitize_text_field', $network_settings );
		
		//save option values
		update_site_option( 'prowp_network_settings', $network_settings );
		
	}
		
}