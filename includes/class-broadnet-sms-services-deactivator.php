<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.broadnet.me
 * @since      0.0.2
 *
 * @package    Woocommerce_Sms_Services
 * @subpackage Woocommerce_Sms_Services/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      0.0.2
 * @package    Woocommerce_Sms_Services
 * @subpackage Woocommerce_Sms_Services/includes
 * @author     Rohit <rohit@vkaps.com>
 */
class Woocommerce_Sms_Services_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    0.0.2
	 */
	public static function deactivate() {
        /*DELETE GENERAL SETTINGS FIELDS*/
        delete_option('api_request_url' );
        delete_option('access_key' );
        delete_option('s_id' );
        
        /*SDELETE MS SETTINGS FIELDS*/
        delete_option('text_message_admin_template');
        delete_option('default_sms_template' );
        delete_option('pending_order_sms_template' );
        delete_option('processing_order_sms_template' );
        delete_option('on_hold_order_sms_template' );
        delete_option('completed_order_sms_template' );
        delete_option('cancelled_order_sms_template' );
        delete_option('refunded_order_sms_template' );
        // delete_option('failed_order_sms_template' );

        /*DELETE HOW-TO SETTINGS FIELDS*/
        delete_option('pending_payment' );
        delete_option('processing_payment' );
        delete_option('hold_payment' );
        delete_option('completed_payment' );
        delete_option('canceled_payment' );
        delete_option('refunded_payment' );
        delete_option('failed_payment' );
    }

}
