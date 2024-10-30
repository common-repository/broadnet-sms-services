<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.broadnet.me
 * @since      0.0.2
 *
 * @package    Woocommerce_Sms_Services
 * @subpackage Woocommerce_Sms_Services/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocommerce_Sms_Services
 * @subpackage Woocommerce_Sms_Services/admin
 * @author     Rohit <rohit@vkaps.com>
 */
class Woocommerce_Sms_Services_Admin {

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
	 *
	 * @since    0.0.2
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/broadnet-sms-services-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/broadnet-sms-services-admin.js', array( 'jquery' ), '1.5' , false );

	}

	public function register_mysettings() { 

		$args =  array(
	        'type' => 'string',
	        'sanitize_callback' => 'sanitize_text_field'
	    );
	    $arry_args =  array(
	        'type' => 'array'
	    );
		/*GENERAL SETTINGS FIELDS*/
		register_setting( 'sms-general-settings-group', 'api_request_url', $args);
		register_setting( 'sms-general-settings-group', 'access_key',$args);
		register_setting( 'sms-general-settings-group', 's_id', $args);
	  	
	  	/*SMS SETTINGS FIELDS*/
	  	register_setting( 'sms-template-settings-group', 'text_message_admin_template', $args);
	  	register_setting( 'sms-template-settings-group', 'default_sms_template',$args );
	  	register_setting( 'sms-template-settings-group', 'pending_order_sms_template',$args );
	  	register_setting( 'sms-template-settings-group', 'processing_order_sms_template', $args );
	  	register_setting( 'sms-template-settings-group', 'on_hold_order_sms_template', $args );
	  	register_setting( 'sms-template-settings-group', 'completed_order_sms_template', $args );
	  	register_setting( 'sms-template-settings-group', 'cancelled_order_sms_template', $args );
	  	register_setting( 'sms-template-settings-group', 'refunded_order_sms_template' , $args );

	  	/*HOW-TO SETTINGS FIELDS*/
	  	register_setting( 'sms-notification-settings-group', 'pending_payment', $arry_args);
		register_setting( 'sms-notification-settings-group', 'processing_payment', $arry_args );
		register_setting( 'sms-notification-settings-group', 'hold_payment',$arry_args);
		register_setting( 'sms-notification-settings-group', 'completed_payment', $arry_args );
		register_setting( 'sms-notification-settings-group', 'canceled_payment', $arry_args);
		register_setting( 'sms-notification-settings-group', 'refunded_payment', $arry_args);
		register_setting( 'sms-notification-settings-group', 'failed_payment', $arry_args);
	
	}
	public function my_admin_menu() {
	    add_menu_page( 'WooCommerce SMS', 'WooCommerce SMS', 'manage_options', 'broadnet-sms-services-settings', array($this, 'broadnet_sms_services_settings_page'), 'dashicons-tickets', 6  );
	   
	}

	public function broadnet_sms_services_settings_page(){ 

	   // check user capabilities
	  if ( ! current_user_can( 'manage_options' ) ) {
	    return;
	  }

	  	// Generate a custom nonce value.
		$nds_add_meta_nonce = wp_create_nonce( 'nds_add_user_meta_form_nonce' ); 
		$tab = ( isset($_GET['tab']) ) ? sanitize_text_field($_GET['tab']) : null;
	  	?>
	   	<div class="wrap">
		    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		    <!-- Here are our tabs -->
		    <nav class="nav-tab-wrapper">
		      	<a href="?page=broadnet-sms-services-settings" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>"><?php echo __( 'General Settings', 'broadnet-sms-services' ); ?></a>
		      	<a href="?page=broadnet-sms-services-settings&tab=sms_settings" class="nav-tab <?php if($tab==='sms_settings'):?>nav-tab-active<?php endif; ?>"><?php echo __( 'SMS Settings', 'broadnet-sms-services' ); ?></a>
		      	<a href="?page=broadnet-sms-services-settings&tab=sms_notifications" class="nav-tab <?php if($tab==='sms_notifications'):?>nav-tab-active<?php endif; ?>"><?php echo __( 'SMS Notifications', 'broadnet-sms-services' ); ?></a>
		    </nav>

		    <div class="tab-content">
		    	<?php 
			    	switch($tab) :
				      	case 'sms_settings':
				      		include_once( 'views/partials-html-sms-settings-form-view.php' );
				      	break;
				      	case 'sms_notifications':
				      		include_once( 'views/partials-html-how-to-settings.php' );
				      	break;
				     	default:
				        	include_once( 'views/partials-html-sms-general-settings.php' );

				        break;
			    	endswitch; 
			    ?>
		    </div>
	  	</div>
  <?php
	}
	
	public function send_text_sms() {
		
		if( isset( $_POST['nds_add_user_meta_nonce'] ) && wp_verify_nonce( $_POST['nds_add_user_meta_nonce'], 'nds_add_user_meta_form_nonce') ) {

			$message =  sanitize_text_field($_POST['message']);
			$phone_number =  sanitize_text_field($_POST['phone_number']);
			$phone_number = str_replace("+","", $phone_number);
			
			$result = $this->test_sms_api($phone_number, $message);
			if(empty($result)){
				wp_redirect( admin_url( '/admin.php?page=broadnet-sms-services-settings&tab=sms_settings' ) .'&success=false');
			}else{
				wp_redirect( admin_url( '/admin.php?page=broadnet-sms-services-settings&tab=sms_settings' ) .'&success=true');
			}
    		exit();
		}			
		else {
			wp_die( __( 'Invalid nonce specified', $this->plugin_name ), __( 'Error', $this->plugin_name ), array(
						'response' 	=> 403,
						'back_link' => 'admin.php?page=' . $this->plugin_name,

				) );
		}
	}


	private function test_sms_api( $phone_number ,$message ) {

		Woocommerce_Sms_Log_Public::_log('wc-test_sms', null, '----------------TEST_SMS_TRIGGER_START----------------', null , 'heading');

		$wc_sms_request_url = esc_html(get_option("api_request_url"));
		$wc_sms_access_token = esc_html(get_option("access_key"));
		$wc_sms_s_id = esc_html(get_option("s_id"));

		if(empty($wc_sms_request_url)){	
			wp_redirect( admin_url( '/admin.php?page=broadnet-sms-services-settings&tab=sms_settings' ) .'&success=false&error-code=401');
			exit();
		}

		if(empty($wc_sms_access_token)){	
			wp_redirect( admin_url( '/admin.php?page=broadnet-sms-services-settings&tab=sms_settings' ) .'&success=false&error-code=402');
			exit();
		}

		if(empty($wc_sms_s_id)){	
			wp_redirect( admin_url( '/admin.php?page=broadnet-sms-services-settings&tab=sms_settings' ) .'&success=false&error-code=403');
			exit();
		}

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
		Woocommerce_Sms_Log_Public::_log('wc-test_sms', null, 'REQUEST_URL', $wc_sms_request_url , 'data');
		Woocommerce_Sms_Log_Public::_log('wc-test_sms', null , 'REQUEST_BODY', json_encode($args) , 'data');

		$response = wp_remote_get( $wc_sms_request_url, $args );
		$result = wp_remote_retrieve_body($response);

		//log sms url and body of api
		Woocommerce_Sms_Log_Public::_log('wc-test_sms', null, 'RESPONSE', json_encode($result) , 'data');
		
		Woocommerce_Sms_Log_Public::_log('wc-test_sms', null, '----------------TEST_SMS_END----------------', null , 'heading');
		return $result;
	}

	//Display admin notices 
	public function wc_sms_plugin_admin_notice(){ 

		if(isset($_GET['success']) && $_GET['success'] == 'true'){

			$class = 'notice notice-success is-dismissible';
			$message = __( 'SMS message successfully sent to the Phone number.', 'broadnet-sms-services' );
			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
		}


		if(isset($_GET['success']) && $_GET['success'] == 'false'){
		   	$class = 'notice notice-error is-dismissible';
		   	$message = __( 'SMS message failed to send.', 'broadnet-sms-services' );
			if(isset($_GET['error-code'])){
				if($_GET['error-code'] == 401){$message = "Invalid Request URL. please check General Settings.";}
				if($_GET['error-code'] == 402){$message = "Invalid Source Number. please check General Settings.";}
				if($_GET['error-code'] == 403){$message = "Invalid Access key. please check General Settings.";}
			}
			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
		}		
    
	}

}
