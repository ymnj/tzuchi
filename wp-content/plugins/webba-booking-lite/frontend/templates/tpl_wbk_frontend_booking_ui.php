<?php
    // check if accessed directly
    if ( ! defined( 'ABSPATH' ) ) exit;
 	if( isset( $_GET['paypal_status'] ) ){
?>
		<div class="wbk-outer-container">
			<div class="wbk-inner-container">
				<div class="wbk-frontend-row">
					<div class="wbk-col-12-12"> 
						<div class="wbk-details-sub-title"><?php echo get_option( 'wbk_payment_result_title', __( 'Payment status', 'wbk' ) ); ?></div>
					</div>
					<div class="wbk-col-12-12"> 
						<?php
							if( $_GET['paypal_status'] == 1 ){
							?>
								<div class="wbk-input-label"><?php echo get_option( 'wbk_payment_success_message', __( 'Payment completed.') ); ?></div>
						<?php
						    }
						?>
						<?php
							if( $_GET['paypal_status'] == 5 ){
							?>
								<div class="wbk-input-label"><?php echo get_option( 'wbk_payment_cancel_message', __( 'Payment canceled.') ); ?></div>
						<?php
						    }
						?>
						<?php
							if( $_GET['paypal_status'] == 2 ){
							?>
								<div class="wbk-input-label">Error 102</div>
						<?php
						    }
						?>
						<?php
							if( $_GET['paypal_status'] == 3 ){
							?>
								<div class="wbk-input-label">Error 103</div>
						<?php
						    }
						?>
						<?php
							if( $_GET['paypal_status'] == 4 ){
							?>
								<div class="wbk-input-label">Error 104</div>
						<?php
						    }
						?>
					</div>
				</div>
			</div>
		</div>

<?php
		return;
	}
?>
<?php
 	if( isset( $_GET['order_payment'] ) ){
 		$order_payment =  $_GET['order_payment'];

		$order_payment = str_replace('"', '', $order_payment );
		$order_payment = str_replace('<', '', $order_payment );
		$order_payment = str_replace('\'', '', $order_payment );
		$order_payment = str_replace('>', '', $order_payment );
		$order_payment = str_replace('/', '', $order_payment );
		$order_payment = str_replace('\\',  '', $order_payment );

 		$appointment_id = WBK_Db_Utils::getAppointmentIdByToken( $order_payment );
 		if( $appointment_id === false ){
 		} else {
 				$service_id = WBK_Db_Utils::getServiceIdByAppointmentId( $appointment_id );
 				$valid = true;
 				$appointment = new WBK_Appointment();
				if ( !$appointment->setId( $appointment_id ) ) {
					$valid = false;
				}
				if ( !$appointment->load() ) {
					$valid = false;
				}
				$service = new WBK_Service();
				if ( !$service->setId( $service_id ) ) {
					$valid = false;
				}
				if ( !$service->load() ) {
					$valid = false;
				}
				$appointment_status = WBK_Db_Utils::getStatusByAppointmentId( $appointment_id );
				if(  $appointment_status != 'paid' && $appointment_status != 'paid_approved' ){			
					$title = get_option( 'wbk_appointment_information', __( 'Appointment on #dt', 'wbk' ) );
					$time_format = WBK_Date_Time_Utils::getTimeFormat();
					$date_format = WBK_Date_Time_Utils::getDateFormat();
					$time = $appointment->getTime();			
						
					$title = str_replace( '#name', $appointment->getName(), $title );
					$title = str_replace( '#service', $service->getName(), $title );
					$title = str_replace( '#date', date_i18n( $date_format, $time ), $title );
					$title = str_replace( '#time', date_i18n( $time_format, $time ), $title );
					$title = str_replace( '#dt', date_i18n( $date_format, $time ) . ' ' .  date_i18n( $time_format, $time ), $title );
	 
					$title .= WBK_PayPal::renderPaymentMethods( $service_id, array( $appointment_id ) );
				} else {
					$title = get_option( 'wbk_nothing_to_pay_message', __( 'There are no bookings available for payment.', 'wbk' ) );
				}
 				if( $valid == true ){
			?>
					<div class="wbk-outer-container">
						<div class="wbk-inner-container">
							<div class="wbk-frontend-row">
								<div class="wbk-col-12-12">
								 	<?php echo $title; ?>
								</div>
							</div>
							<div class="wbk-frontend-row" id="wbk-payment">
							</div>
						</div>
					</div> 
					<?php
					return;
			}
 		}
?>
<?php
	}					
?>
<?php
 	if( isset( $_GET['cancelation'] ) ){	 	

 	 		$cancelation =  $_GET['cancelation'];
			$cancelation = str_replace('"', '', $cancelation );
			$cancelation = str_replace('<', '', $cancelation );
			$cancelation = str_replace('\'', '', $cancelation );
			$cancelation = str_replace('>', '', $cancelation );
			$cancelation = str_replace('/', '', $cancelation );
			$cancelation = str_replace('\\',  '', $cancelation );

			$appointment_id = WBK_Db_Utils::getAppointmentIdByToken( $cancelation );
	 		if( $appointment_id === false ){
				$valid = false; 			
	 		} else {
 				$service_id = WBK_Db_Utils::getServiceIdByAppointmentId( $appointment_id );
 				$valid = true;
 				$appointment = new WBK_Appointment();
				if ( !$appointment->setId( $appointment_id ) ) {
					$valid = false;
				}
				if ( !$appointment->load() ) {
					$valid = false;
				}
				$service = new WBK_Service();
				if ( !$service->setId( $service_id ) ) {
					$valid = false;
				}
				if ( !$service->load() ) {
					$valid = false;
				}
				 			
				$title = get_option( 'wbk_appointment_information', __( 'Appointment on #dt', 'wbk' ) );
				$time_format = WBK_Date_Time_Utils::getTimeFormat();
				$date_format = WBK_Date_Time_Utils::getDateFormat();
				$time = $appointment->getTime();			
						
				$title = str_replace( '#name', $appointment->getName(), $title );
				$title = str_replace( '#service', $service->getName(), $title );
				$title = str_replace( '#date', date_i18n( $date_format, $time ), $title );
				$title = str_replace( '#time', date_i18n( $time_format, $time ), $title );
				$title = str_replace( '#dt', date_i18n( $date_format, $time ) . ' ' .  date_i18n( $time_format, $time ), $title );
	 			
	 			$appointment_status = WBK_Db_Utils::getStatusByAppointmentId( $appointment_id );

				if( $appointment_status == 'paid' || $appointment_status == 'paid_approved' ){	
					$title .= '<p>' . get_option( 'wbk_booking_couldnt_be_canceled', __( 'Paid booking couldn\'t be canceled.', 'wbk' ) ) . '</p>';
					$content = '';
				} else {
					 
					$content = '<label class="wbk-input-label" for="wbk-customer_email">'. get_option( 'wbk_booking_cancel_email_label', __( 'Please, enter your email to confirm cancelation', 'wbk' ) ).'</label>';	
					$content .= '<input name="wbk-email" class="wbk-input wbk-width-100 wbk-mb-10" id="wbk-customer_email" type="text">';
					$content .= '<input class="wbk-button wbk-width-100 wbk-mt-10-mb-10" id="wbk-cancel_booked_appointment" data-appointment="'. $cancelation .'" value="' . get_option( 'wbk_cancel_button_text', __( 'Cancel booking', 'wbk' ) ) . '" type="button">';
				}			
			}  
 				if( $valid == true ){
			?>
					<div class="wbk-outer-container">
						<div class="wbk-inner-container">
							<div class="wbk-frontend-row">
								<div class="wbk-col-12-12">
								 	<?php echo $title . $content; ?>
								</div>
							</div>
							<div class="wbk-frontend-row" id="wbk-cancel-result">
							</div>
						</div>
					</div> 
					<?php
					return;
				}
 	}
?>

<div class="wbk-outer-container">
	<div class="wbk-inner-container">
 	<img src=<?php echo get_site_url() . '/wp-content/plugins/webba-booking/frontend/images/loading.svg' ?> style="display:block;width:0px;height:0px;">
		<div class="wbk-frontend-row" id="wbk-service-container" >
			<div class="wbk-col-12-12" >		
				 <?php 			
				 	if ( $data[0] <> 0 ){
				 		echo '<input type="hidden" id="wbk-service-id" value="' . $data[0] . '" />';	 	 		
				 	} else {
				 					 		 
					 	$label = get_option( 'wbk_service_label', 'Select service' );
				 	 
						echo  '<label class="wbk-input-label">' . $label . '</label>';
				 		echo '<select class="wbk-select wbk-input" id="wbk-service-id">'; 
				 		echo '<option value="0" selected="selected">' . __( 'select...', 'wbk' ) . '</option>';

						if( $data[1] == 0 ){
					 		$arrIds = WBK_Db_Utils::getServices();
				 		} else {
					 		$arrIds = WBK_Db_Utils::getServicesInCategory( $data[1] );
				 		}
				 		
				 		foreach ( $arrIds as $id ) {
				 			$service = new WBK_Service();
				 			if ( !$service->setId( $id ) ) {  
				 				continue;
				 			}
				 			if ( !$service->load() ) {  
				 				continue;
				 			}
				 			echo '<option value="' . $service->getId() . '" >' . $service->getName() . '</option>';
				 		}
				 		echo '</select>';
				 	}
				 ?>
			</div>
			<?php 
				echo WBK_Date_Time_Utils::renderBHDisabilitiesFull();
				// add get parameters
				$html_get  = '<script type=\'text/javascript\'>';
      			$html_get .= 'var wbk_get_converted = {';
				foreach ( $_GET as $key => $value ) {
					$value = urldecode($value);
					$key = urldecode($key);
			 		
			 		$value = str_replace('"', '', $value);
			 		$key = str_replace('"', '', $key);

			 		$value = str_replace('\'', '', $value);
			 		$key = str_replace('\'', '', $key);

			 		$value = str_replace('/', '', $value);
			 		$key = str_replace('/', '', $key);

			 		$value = str_replace('\\', '', $value);
			 		$key = str_replace('\\', '', $key);
				
					$value = sanitize_text_field($value);
					$key = sanitize_text_field($key);
					
					if ( $key != 'action' && $key != 'time' && $key != 'service' && $key != 'step' ){

					}

					$html_get .= '"'.$key.'"'. ':"' . $value . '",';			  						 
				}  					
				$html_get .= '"blank":"blank"';
  				$html_get .= '};</script>';
  				echo $html_get;
			?>

		</div>
		<div class="wbk-frontend-row" id="wbk-date-container">	
		</div> 
		<div class="wbk-frontend-row" id="wbk-time-container">
		</div>
		<div class="wbk-frontend-row" id="wbk-slots-container">				 
		</div>
		<div class="wbk-frontend-row" id="wbk-booking-form-container">		 
		</div>
		<div class="wbk-frontend-row" id="wbk-booking-done">
		</div>
		<div class="wbk-frontend-row" id="wbk-payment">
		</div>
	</div>	
</div>