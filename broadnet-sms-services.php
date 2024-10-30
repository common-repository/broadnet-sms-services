<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.broadnet.me
 * @since             0.0.2
 * @package           Broadnet_Sms_Services
 *
 * @wordpress-plugin
 * Plugin Name:       Broadnet SMS Services
 * Plugin URI:        https://www.broadnet.me
 * Description:       This plugin is to send SMS notification to customers and administrator when orders status is changed using WooCommerce.
 * Version:           0.0.2
 * Author:            broadnet.me
 * Author URI:        https://www.broadnet.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       broadnet-sms-services
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 0.0.2 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOOCOMMERCE_SMS_SERVICES_VERSION', '0.0.2' );
define('WOOCOMMERCE_SMS_SERVICES_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-broadnet-sms-services-activator.php
 */
function activate_woocoomerce_sms_services() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-broadnet-sms-services-activator.php';
	Woocommerce_Sms_Services_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-broadnet-sms-services-deactivator.php
 */
function deactivate_woocoomerce_sms_services() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-broadnet-sms-services-deactivator.php';
	Woocommerce_Sms_Services_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocoomerce_sms_services' );
register_deactivation_hook( __FILE__, 'deactivate_woocoomerce_sms_services' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-broadnet-sms-services.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.2
 */
function run_woocoomerce_sms_services() {

	$plugin = new Woocommerce_Sms_Services();
	$plugin->run();

}
run_woocoomerce_sms_services();
