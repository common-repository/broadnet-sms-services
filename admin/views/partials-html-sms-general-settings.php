<div class="settings-content">
	<h3><?php echo __( 'Demo Account Setup Information', 'broadnet-sms-services' ); ?></h3>
	<!-- <br> -->
	<div class="section sms_box">
	  	<p><span class="red-note">Note: </span>For testing use below demo account's Request URL, Source Number (sid) & Access Key in form of input fields. Fill demo details in below SMS general settings and test.</p>
	  	<table class="sms-demo-crd">
	  		<tr>
		  		<th><?php echo __( 'Request Url', 'broadnet-sms-services' ); ?></th>
		  		<td><?php echo "http://104.156.253.108:8008/websmpp/websms"; ?></td>
		  	</tr>
		  	<tr>
			  <th><?php echo __( 'Source Number (sid)', 'broadnet-sms-services' ); ?></th>
			  <td><?php echo "VKaps"; ?></td>
		  	</tr>
		  	<tr>
			  	<th><?php echo __( 'Access key', 'broadnet-sms-services' ); ?></th>
			  	<td><?php echo "YSEwWybXxipos7W"; ?></td>
		  	</tr>
	  	</table>
	  	<p>For getting yours account associated Request Url, Source Number (sid) and Access key, Kindly contact Broadnet SMS Services's support at <a href="mailto:noc@broadnet.me">noc@broadnet.me</a></p>
	</div>
	<br>
	<h3><?php echo __( 'SMS general settings', 'broadnet-sms-services' ); ?></h3>
	<div class="sms_box">
		<form action="options.php" method="post" enctype="multipart/form-data">
	      	<?php
	      		settings_fields( 'sms-general-settings-group' );
	      		do_settings_sections( 'sms-general-settings-group' );
	      	?>
	      	<table class="settings_table wc-sms-general form-table">
	      		<tbody>
	      			<tr>
				   		<th><label><?php echo __( 'Request URL', 'broadnet-sms-services' ); ?></label></th>
				   		<td>
				   			<input type="text" name="api_request_url" id="api_request_url" value="<?php echo esc_html(get_option("api_request_url")); ?>">
				   		</td>
				   	</tr>
	      			<tr>
				   		<th><label><?php echo __( 'Source Number (sid)', 'broadnet-sms-services' ); ?></label></th>
				   		<td>
				   			<input type="text" name="s_id" value="<?php echo esc_html(get_option("s_id")); ?>">
				   		</td>
				   	</tr>
	      			<tr>
				   		<th><label><?php echo __( 'Access key', 'broadnet-sms-services' ); ?></label></th>
				   		<td>
				   			<input type="text" name="access_key" id="access_key" value="<?php echo esc_html(get_option("access_key")); ?>">
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