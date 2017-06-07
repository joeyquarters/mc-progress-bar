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

	// Register our settings key where we will store a
	// serialized array value to in the database
	register_setting( 'mc-pb-settings', 'mc_pb_settings' );

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

	// Add disable styles checkbox
	add_settings_field(
		'mc_pb_disable_styles',
		'Disable Styles',
		'mc_pb_disable_styles_field_render',
		'mc-pb-settings',
		'mc_pb_api_settings'
	);

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
	$options = get_option('mc_pb_settings');
	$input = '<input class="regular-text" type="text" name="mc_pb_settings[mc_pb_api_key]" id="mc_pb_api_key" value="' . $options['mc_pb_api_key'] . '">';
	$helper = '<p class="description">Not sure what this means? <a href="http://kb.mailchimp.com/integrations/api-integrations/about-api-keys" target="_blank">Get help finding your API key.</a></p>';
	echo $input . $helper;
}

/**
 * Callback to render our disable styles checkbox
 */
function mc_pb_disable_styles_field_render(){
	$options = get_option('mc_pb_settings');
	$is_checked = isset($options['mc_pb_disable_styles']) ? $options['mc_pb_disable_styles'] : null;
	$input = '<label for="mc_pb_disable_styles"><input class="code" type="checkbox" name="mc_pb_settings[mc_pb_disable_styles]" id="mc_pb_disable_styles" value="1" ' . checked($is_checked, 1, false) . '> Disable plugin styles</label>';
	$helper = '<p class="description">Check this if you want to disable the default plugin styles. Saves http request(s) and allows for easier styling.</p>';
	echo $input . $helper;
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
			<div class="card">
				<p>To use this plugin, you will need to find list ID's for your MailChimp lists. If you need assistance, please <a href="http://kb.mailchimp.com/lists/manage-contacts/find-your-list-id" target="_blank">refer to this help article</a>.</p>
				<p>The shortcodes available in this plugin are as follows:</p>
				<p><strong>Full Progress Bar</strong><code>[mc-progress-bar list_id='23fj23sj' goal="5000"]</code><p>
				<p><strong>Member Count</strong><code>[mc-pb-count]</code></p>
			</div>

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