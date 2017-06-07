<?php
/**
 * Defines our admin settings page
 * Adds a field for the MailChimp API key
 *
 * @package         Mc_Progress_Bar
 * @since           0.1.0
 */

/**
 * Define our sections, fields, and settings on admin_init
 */
add_action( 'admin_init', 'mc_pb_settings_init' );
function mc_pb_settings_init(){

	// Define our API settings section
	add_settings_section(
		'mc_pb_api_settings',
		'API Settings',
		'mc_pb_api_settings_render',
		'mc-pb-settings'
	);

	// Add API key field
	add_settings_field(
		'mc_pb_api_key',
		'API Key',
		'mc_pb_api_key_field_render',
		'mc-pb-settings',
		'mc_pb_api_settings'
	);
	register_setting( 'mc-pb-settings', 'mc_pb_api_key' );

}

/**
 * Callback function for our API settings section
 */
function mc_pb_api_settings_render(){
	echo 'Enter your MailChimp API credentials';
}

/**
 * Callback to render our API Key field
 */
function mc_pb_api_key_field_render(){
	echo '<input class="regular-text" type="text" name="mc_pb_api_key" id="mc_pb_api_key" value="' . get_option('mc_pb_api_key') . '">';
}

/**
 * Add a submenu settings page
 */
add_action( 'admin_menu','mc_pb_register_submenu_page' );
function mc_pb_register_submenu_page(){
	add_options_page(
		'MailChimp Progress Bar Settings',
		'MailChimp Progress Bar',
		'manage_options',
		'mc-pb-settings',
		'mc_pb_create_settings_page'
	);
}

/**
 * Create the page
 */
function mc_pb_create_settings_page(){
	?>
		<div class="wrap">
			<h1>MailChimp Progress Bar Settings</h1>

			<form method="post" action="options.php">
				<?php
				settings_fields( 'mc-pb-settings' );
				do_settings_sections( 'mc-pb-settings' );
				submit_button();
				?>
			</form>
		</div>
	<?php
}