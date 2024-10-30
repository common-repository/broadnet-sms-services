
<h3><?php echo __( 'SMS notifications for the following order status changes', 'broadnet-sms-services' ); ?></h3>
<form action="options.php" method="post" enctype="multipart/form-data">
	<?php
  		settings_fields( 'sms-notification-settings-group' );
  		do_settings_sections( 'sms-notification-settings-group' );

		$payment_options 		= get_option('pending_payment');
  		$processing_options 	= get_option('processing_payment');
  		$hold_options 			= get_option('hold_payment');
  		$completed_options 		= get_option('completed_payment');
  		$canceled_options 		= get_option('canceled_payment');
  		$refunded_options 		= get_option('refunded_payment');
  	?>
	<div class="order_process">
		<table>	
			<thead>
				<tr>
					<th><?php echo __( 'Order status', 'broadnet-sms-services' ); ?></th>
					<th><?php echo __( 'Customer', 'broadnet-sms-services' ); ?></th>
					<th><?php echo __( 'Admin', 'broadnet-sms-services' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<!-- Pending -->
				<tr>
					<td><?php echo __( 'Pending Payment', 'broadnet-sms-services' ); ?></td>
					<td>
						<input type="checkbox" name="pending_payment[]" value="customer" <?php echo (!empty($payment_options) && in_array('customer', $payment_options )) ? 'checked' : '' ?> >
					</td>
					<td>
						<input type="checkbox" name="pending_payment[]" value="admin" <?php echo (!empty($payment_options) && in_array('admin', $payment_options )) ? 'checked' : '' ?> >
					</td>
				</tr>

				<!-- processing_payment -->
				<tr>
					<td><?php echo __( 'Proccesing', 'broadnet-sms-services' ); ?></td>
					<td>
						<input type="checkbox" name="processing_payment[]" value="customer" <?php echo (!empty($processing_options) && in_array('customer', $processing_options )) ? 'checked' : '' ?> >
					</td>
					<td>
						<input type="checkbox" name="processing_payment[]" value="admin" <?php echo (!empty($processing_options) && in_array('admin', $processing_options )) ? 'checked' : '' ?> >
					</td>
				</tr>

				<!-- on hold -->
				<tr>
					<td><?php echo __( 'On Hold', 'broadnet-sms-services' ); ?></td>
					<td>
						<input type="checkbox" name="hold_payment[]" value="customer"<?php echo (!empty($hold_options) && in_array('customer', $hold_options )) ? 'checked' : '' ?> >
					</td>
					<td>
						<input type="checkbox" name="hold_payment[]" value="admin" <?php echo (!empty($hold_options) && in_array('admin', $hold_options )) ? 'checked' : '' ?> >
					</td>
				</tr>

				<!-- completed -->
				<tr>
					<td><?php echo __( 'Completed', 'broadnet-sms-services' ); ?></td>
					<td>
						<input type="checkbox" name="completed_payment[]" value="customer" <?php echo (!empty($completed_options) && in_array('customer', $completed_options )) ? 'checked' : '' ?> >
					</td>
					<td>
						<input  type="checkbox" name="completed_payment[]" value="admin" <?php echo (!empty($completed_options) && in_array('admin', $completed_options )) ? 'checked' : '' ?> >
					</td>
				</tr>

				<!-- cancel -->
				<tr>
					<td><?php echo __( 'Cancelled', 'broadnet-sms-services' ); ?></td>
					<td>
						<input type="checkbox" name="canceled_payment[]" value="customer" <?php echo (!empty($canceled_options) && in_array('customer', $canceled_options )) ? 'checked' : '' ?> >
					</td>
					<td>
						<input type="checkbox" name="canceled_payment[]" value="admin" <?php echo (!empty($canceled_options) && in_array('admin', $canceled_options )) ? 'checked' : '' ?> >
					</td>
				</tr>

				<!-- Refunded -->
				<tr>
					<td><?php echo __( 'Refunded', 'broadnet-sms-services' ); ?></td>
					<td>
						<input type="checkbox" name="refunded_payment[]" value="customer" <?php echo (!empty($refunded_options) && in_array('customer', $refunded_options )) ? 'checked' : '' ?> >
					</td>
					<td>
						<input type="checkbox" name="refunded_payment[]" value="admin" <?php echo (!empty($refunded_options) && in_array('admin', $refunded_options )) ? 'checked' : '' ?> >
					</td>
				</tr>

			</tbody>
		</table>
		
		<?php submit_button(); ?>

	</div>
</form>