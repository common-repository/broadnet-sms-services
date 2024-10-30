<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.broadnet.me
 * @since      0.0.2
 *
 * @package    Woocommerce_Sms_Services
 * @subpackage Woocommerce_Sms_Services/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woocommerce_Sms_Services
 * @subpackage Woocommerce_Sms_Services/public
 * @author     Rohit <rohit@vkaps.com>
 */
class Woocommerce_Sms_Services_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.2
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.2
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 * REF:  https://wp-kama.com/plugin/woocommerce/hook/woocommerce_order_status_(to)
	 * REF:  https://sarathlal.com/add-actions-based-woocommerce-order-status/
	 * @since    0.0.2
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		//check if woocommerce is acive
		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

			add_action('woocommerce_order_status_pending', array($this, 'sms_order_status_change_to_pending'), 10, 1);
		    add_action('woocommerce_order_status_processing', array($this, 'sms_order_status_change_to_processing'), 10, 1);
		    add_action( 'woocommerce_order_status_on-hold', array($this, 'sms_order_status_change_to_hold' ), 10, 1);

		    add_action( 'woocommerce_order_status_completed', array($this, 'sms_order_status_change_to_completed' ), 10, 1);
		   	add_action( 'woocommerce_order_status_cancelled', array($this, 'sms_order_status_change_to_cancelled' ), 10, 1);
		   	add_action( 'woocommerce_order_status_refunded', array($this, 'sms_order_status_change_to_refunded' ), 10, 1);

		    add_filter('woocoomerce_sms_message', array($this,'fiter_wc_sms_msg'), 10 , 2);
		}

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.0.2
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Sms_Services_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Sms_Services_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/broadnet-sms-services-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.0.2
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Sms_Services_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Sms_Services_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/broadnet-sms-services-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * sms order satus to pending after the checkout process
	 *
	*/
	public function sms_order_status_change_to_pending( $order_id ) {
			
		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'ORDER_STATUS_PENDING', null, 'heading');
		
		// log response
		$Result = $this->trigger_action($order_id, 'pendding');
		
		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'End', null , 'closing');
	}

	/**
	 * sms order satus to processing after the checkout process
	 *
	*/
	public function sms_order_status_change_to_processing($order_id){
		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'ORDER_STATUS_PROCESSING', null, 'heading');

		$Result = $this->trigger_action($order_id, 'processing');
		
		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'End', null , 'closing');
		
	}

	/**
	 * sms order satus to hold after the checkout process
	 *
	 */
	public function sms_order_status_change_to_hold($order_id){

		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'ORDER_STATUS_ON_HOLD', null, 'heading');
		
		$Result = $this->trigger_action($order_id, 'hold');
		
		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'End', null , 'closing');

	}

	/**
	 * sms order satus to completed after the checkout process
	 *
	 */
	public function sms_order_status_change_to_completed($order_id){

		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'ORDER_STATUS_COMPLETED', null, 'heading');
		
		$Result = $this->trigger_action($order_id, 'completed');
		
		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'End', null , 'closing');

	}

	/**
	 * sms order satus to cancelled after the checkout process
	 *
	 */
	public function sms_order_status_change_to_cancelled($order_id){

		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'ORDER_STATUS_CANCELLED', null, 'heading');
		
		$Result = $this->trigger_action($order_id, 'cancelled');
		
		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'End', null , 'closing');

	}

	/**
	 * sms order satus to cancelled after the checkout process
	 *
	 */
	public function sms_order_status_change_to_refunded($order_id){

		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'ORDER_STATUS_REFUNDED', null, 'heading');
		
		$Result = $this->trigger_action($order_id,'refunded');
		
		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'End', null , 'closing');

	}

	public function trigger_action($order_id,$status){

		$result = [];
		$order = wc_get_order( $order_id );
		// $phone = $order->get_billing_phone();
		switch ($status) {
			
			case 'pendding':
				$customer_message = get_option("pending_order_sms_template");
				$options = get_option('pending_payment');
				Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'Options', json_encode($options) , 'data');
				
				if(!empty($options)){
					$action_result = $this->sms_settings_action($order_id, $options, $customer_message);
				}
				break;

			case 'processing':
				
				$customer_message = get_option("processing_order_sms_template");
				$options = get_option('processing_payment');
				Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'Options', json_encode($options) , 'data');
				if(!empty($options)){
					$action_result = $this->sms_settings_action($order_id, $options, $customer_message);
				}
				
				break;

			case 'hold':
				$customer_message = get_option("on_hold_order_sms_template");
				$options = get_option('hold_payment');
				Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'Options', json_encode($options) , 'data');
				if(!empty($options)){
					$action_result = $this->sms_settings_action($order_id, $options, $customer_message);
				}

				break;	

			case 'completed':
				$customer_message = get_option("completed_order_sms_template");
				$options = get_option('completed_payment');
				Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'Options', json_encode($options) , 'data');
				if(!empty($options)){
					$action_result = $this->sms_settings_action($order_id, $options, $customer_message);
				}

				break;	

			case 'cancelled':
				$customer_message = get_option("cancelled_order_sms_template");
				$options = get_option('canceled_payment');
				Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'Options', json_encode($options) , 'data');
				
				if(!empty($options)){
					$action_result = $this->sms_settings_action($order_id, $options, $customer_message);
				}

				break;		

			case 'refunded':
				$customer_message = get_option("refunded_order_sms_template");
				$options = get_option('refunded_payment');
				Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'Options', json_encode($options) , 'data');
				if(!empty($options)){
					$action_result = $this->sms_settings_action($order_id, $options, $customer_message);
				}
				break;	

			case 'failed':
				$customer_message = get_option("failed_order_sms_template");
				$options = get_option('failed_payment');
				Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'Options', json_encode($options) , 'data');
				if(!empty($options)){
					$action_result = $this->sms_settings_action($order_id, $options, $customer_message);
				}
				
				break;	
			
		}

		return $action_result;
	}


	public function sms_settings_action( $order_id, $options, $customer_message ){
		
		$result = [];

		if(in_array('customer', $options)){
			
			$order = wc_get_order( $order_id );
			$customer_phone = $order->get_billing_phone();
			// log content
			$customer_message = apply_filters("woocoomerce_sms_message", $customer_message, $order_id);

			Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'CustomerMessage', $customer_message , 'data');
			$result[] = $this->sms_api_request($order_id, $customer_phone, $customer_message);
		}

		if(in_array('admin', $options)){
			$admin_id = 1;
    		$admin_phone = get_user_meta($admin_id,"billing_phone",true);		
			// log content
			$admin_msg_template = get_option("text_message_admin_template");
			$admin_message = apply_filters("woocoomerce_sms_message", $admin_msg_template, $order_id);
			Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'AdminMessage', $admin_message , 'data');
			$result[] = $this->sms_api_request($order_id, $admin_phone, $admin_message);
			
		}

		return $result;
	}
	

	static function fiter_wc_sms_msg ( $template, $order_id ) {
		$order = wc_get_order( $order_id );

		$template = str_replace('{site_title}', get_bloginfo( 'name' ), $template);
		$template = str_replace('{order_id}', $order->get_id() , $template);
		$template = str_replace('{order_status}', $order->get_status() , $template);
		return $template;
		
	}

	/**
	 * sms rest api method
	 *
	 */
	private function sms_api_request( $order_id ,$phone_number, $message ) {

		$wc_sms_request_url = get_option("api_request_url");
		$wc_sms_s_id = get_option("s_id");
		$wc_sms_access_token = get_option("access_key");
		

		$args   = array(
			'method'  => 'GET',
			'timeout' => 30,
			'body' => array(
				'sid' => $wc_sms_s_id,
				'mno' => $phone_number,
				'text' => esc_html($message),
				'accesskey' => $wc_sms_access_token,
				'type' => 1,
				'respformat' =>'json'
			)
		);

		//log sms url and body of api
		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'REQUEST_URL', $wc_sms_request_url , 'data');
		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'REQUEST_BODY', json_encode($args) , 'data');

		$response = wp_remote_get( $wc_sms_request_url, $args );
		$result = wp_remote_retrieve_body($response);

		//log sms url and body of api
		Woocommerce_Sms_Log_Public::_log('wc-order', $order_id, 'RESPONSE', json_encode($result) , 'data');
	
		return $result;

	}



	
}
