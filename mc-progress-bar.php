<?php
/**
 * Plugin Name:     MailChimp Progress Bar
 * Description:     Create a progress bar that pulls from your MailChimp list members
 * Author:          Joey Nichols
 * Text Domain:     mc-progress-bar
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Mc_Progress_Bar
 */

define( 'MC_PB_VERSION', '0.1.0' );
define( 'MC_PB_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'MC_PB_PLUGIN_NAME', trim( dirname( MC_PB_PLUGIN_BASENAME ), '/' ) );
define( 'MC_PB_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );
define( 'MC_PB_PLUGIN_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) );

// Pull in Composer dependencies
require('vendor/autoload.php');

// Load plugin lib
require('lib/init.php');
