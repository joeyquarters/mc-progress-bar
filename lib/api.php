<?php
/**
 * Contains the code for API calls
 *
 * @package         Mc_Progress_Bar
 * @since           0.1.0
 */

use DrewM\MailChimp\MailChimp;

/**
 * Returns just the member count from the list information
 * @param  String $list_id The MailChimp list ID
 * @return Int             Number of members in the list
 */
function mc_pb_get_list_member_count($list_id){

	$list_info = mc_pb_get_list_information($list_id);

	if (!$list_info){
		return false;
	}

	if (isset($list_info['stats']) && isset($list_info['stats']['member_count'])){
		return $list_info['stats']['member_count'];
	}

}

/**
 * Sends an API call to MailChimp to get an array of list information
 * Requires API Key to be set in the settings page
 * Saves to a transient for 30 minutes
 * @param  String $list_id The MailChimp list ID
 * @return Array
 */
function mc_pb_get_list_information($list_id){

	if (!$list_id){
		error_log('Please add the MailChimp API key to the WordPress settings page.');
		return false;
	}

	// Get our API Key
	$options = get_option('mc_pb_settings');
	$api_key = $options['mc_pb_api_key'];

	// Build a transient name
	$transient_name = 'mc_pb_' . md5($api_key . $list_id);

	$transient = get_transient($transient_name);

	// Is it saved already? Return it!
	if (!empty($transient)){
		return $transient;
	}
	// Nope, make an API call
	else {
		$MailChimp = new MailChimp($api_key);

		// Call the API
		$response = $MailChimp->get("lists/$list_id");

		if ($MailChimp->success()){
			// Save the response to a transient
			set_transient($transient_name, $response, HOUR_IN_SECONDS * 0.5);

			return $response;
		}

	}


}