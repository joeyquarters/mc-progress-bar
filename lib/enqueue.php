<?php
/**
 * Enqueue styles, scripts, etc.
 */

/**
 * Add our styles if the user hasn't elected to disable them
 */
function mc_pb_should_enqueue_styles(){

	$options = get_option('mc_pb_settings');

	// If the option isn't set, enqueue our styles
	if (!isset($options['mc_pb_disable_styles'])){
		add_action( 'wp_enqueue_scripts', 'mc_pb_enqueue_styles' );
	}

}
mc_pb_should_enqueue_styles();

/**
 * Styles to enqueue. Called from an action hook
 */
function mc_pb_enqueue_styles() {
	wp_enqueue_style( 'mc-pb-styles', MC_PB_PLUGIN_URL . '/assets/mc-progress.css' );
}