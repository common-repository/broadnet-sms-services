<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.broadnet.me
 * @since      0.0.2
 *
 * @package    Woocommerce_Sms_Services
 * @subpackage Woocommerce_Sms_Services/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.0.2
 * @package    Woocommerce_Sms_Services
 * @subpackage Woocommerce_Sms_Services/includes
 * @author     Rohit <rohit@vkaps.com>
 */
class Woocommerce_Sms_Services_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    0.0.2
	 */
	public static function activate() {
        
        /*SET DEFAULT VALUE OF SMS TEMPLATES*/
        add_option( 'text_message_admin_template', '{site_title}: Order #{order_id} switched to {order_status}.' );
        add_option( 'default_sms_template', 'Your order #{order_id} on {site_title} is now {order_status}.' );
        add_option( 'pending_order_sms_template', 'Your order #{order_id} on {site_title} is now Pending.' );
        add_option( 'processing_order_sms_template', 'Your order #{order_id} on {site_title} is now Processing.' );
        add_option( 'on_hold_order_sms_template', 'Your order #{order_id} on {site_title} is now On Hold.' );
        add_option( 'completed_order_sms_template', 'Your order #{order_id} on {site_title} is now Completed.' );
        add_option( 'cancelled_order_sms_template', 'Your order #{order_id} on {site_title} is now Cancelled.' );
        add_option( 'refunded_order_sms_template', 'Your order #{order_id} on {site_title} is now Refunded.' );
     
	}



}
