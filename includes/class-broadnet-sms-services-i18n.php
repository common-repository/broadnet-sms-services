<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.broadnet.me
 * @since      0.0.2
 *
 * @package    Woocommerce_Sms_Services
 * @subpackage Woocommerce_Sms_Services/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.0.2
 * @package    Woocommerce_Sms_Services
 * @subpackage Woocommerce_Sms_Services/includes
 * @author     Rohit <rohit@vkaps.com>
 */
class Woocommerce_Sms_Services_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.0.2
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'broadnet-sms-services',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
