<?php

/**
 * The form to be loaded on the plugin's admin page
*/
if( current_user_can( 'edit_users' ) ) {		

	// Generate a custom nonce value.
	$nds_add_meta_nonce = wp_create_nonce( 'nds_add_user_meta_form_nonce' ); 
?>	
<div class="settings-content">
	<?php _e('<h3>SMS text message settings</h3>', $this->plugin_name );?>
	<div class="sms_box">
	<form id="send_message" class="send_message" method="post"  action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"> 
		<input type="hidden" name="action" value="nds_form_response">
		<input type="hidden" name="nds_add_user_meta_nonce" value="<?php echo $nds_add_meta_nonce ?>" />	
      	<table class="settings_table form-table">
      		<tbody>
      			<tr>
			   		<th><label><?php echo __( 'Test message', 'broadnet-sms-services' ); ?></label></th>
			   		<td>
			   			<select name="message">
			   				<option value=""><?php echo __( 'Choose message', 'broadnet-sms-services' ); ?></option>
			   				<option value="This message is only for testing purpose."><?php echo __( 'Dummy test message', 'broadnet-sms-services' ); ?></option>
			   				

			   			</select>
			   			<input type="text" class="contact_filed" name="phone_number" placeholder="Enter a Phone number with Country code to send" >
			   			<button id="sendMsgBtn" type="submit" class=""><?php echo __( 'Send Text SMS', 'broadnet-sms-services' ); ?></button>
			   		</td>
			   	</tr>
			</tbody>
		</table>
	</form>	
	<form action="options.php" method="post" enctype="multipart/form-data">
      	<?php
      		settings_fields( 'sms-template-settings-group' );
      		do_settings_sections( 'sms-template-settings-group' );
      	?>
      	<table class="settings_table form-table">
      		<tbody>
      			<tr>
			   		<th><label><?php echo __( 'Text message for admin(s)', 'broadnet-sms-services' ); ?></label></th>
			   		<td>
			   			<textarea id="tags" class="template-text input_field" name="text_message_admin_template"><?php echo esc_html(get_option("text_message_admin_template")); ?></textarea>
			   			<span><?php echo __( 'This is the text message that admin(s) will receive any time the order status is changed.', 'broadnet-sms-services' ); ?></span>
			   		</td>
			   	</tr>

			<tr>
			   		<th><label><?php echo __( 'Default customer SMS', 'broadnet-sms-services' ); ?></label></th>
			   		<td>
			   			<textarea class="input_field" name="default_sms_template"><?php echo esc_html(get_option("default_sms_template")); ?></textarea>
			   			<span><?php echo __( 'This is the default message that customer receive each time the status of the order changes.', 'broadnet-sms-services' ); ?></span>
			   		</td>
			   	</tr>

			   	<tr>
			   		<th><label><?php echo __( 'Pending Payment', 'broadnet-sms-services' ); ?></label></th>
			   		<td>
			   			<textarea class="input_field" name="pending_order_sms_template" ><?php echo esc_html(get_option("pending_order_sms_template")); ?></textarea>
			   			
			   		</td>
			   	</tr>

			   	<tr>
			   		<th><label><?php echo __( 'Processing', 'broadnet-sms-services' ); ?></label></th>
			   		<td>
			   			<textarea class="input_field" name="processing_order_sms_template"><?php echo esc_html(get_option("processing_order_sms_template")); ?></textarea>
			   			
			   		</td>
			   	</tr>

			   	<tr>
			   		<th><label><?php echo __( 'On Hold', 'broadnet-sms-services' ); ?></label></th>
			   		<td>
			   			<textarea class="input_field" name="on_hold_order_sms_template"><?php echo esc_html(get_option("on_hold_order_sms_template")); ?></textarea>
			   			
			   		</td>
			   	</tr>

			   	<tr>
			   		<th><label><?php echo __( 'Completed', 'broadnet-sms-services' ); ?></label></th>
			   		<td>
			   			<textarea class="input_field" name="completed_order_sms_template"><?php echo esc_html(get_option("completed_order_sms_template")); ?></textarea>
			   			
			   		</td>
			   	</tr> 
				
				<tr>
			   		<th><label><?php echo __( 'Cancelled', 'broadnet-sms-services' ); ?></label></th>
			   		<td>
			   			<textarea class="input_field" name="cancelled_order_sms_template"><?php echo esc_html(get_option("cancelled_order_sms_template")); ?></textarea>
			   			
			   		</td>
			   	</tr> 

			   	<tr>
			   		<th><label><?php echo __( 'Refunded', 'broadnet-sms-services' ); ?></label></th>
			   		<td>
			   			<textarea class="input_field" name="refunded_order_sms_template"><?php echo esc_html(get_option("refunded_order_sms_template")); ?></textarea>
			   			
			   		</td>
			   	</tr> 
			   	<tr>
			   		<th>
			   			<?php submit_button(); ?>
			   		</th>
			   	</tr>
			</tbody>
	   	</table>
  	</form>
  </div>
</div>
<?php    
}else { ?>
	<p> <?php __("You are not authorized to perform this operation.", $this->plugin_name) ?> </p>
<?php   
}