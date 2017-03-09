<?php
// Webba Booking common ajax controller class
require_once 'class_wbk_business_hours.php';
// check if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
// define main frontend class
class WBK_Ajax_Controller {
	public function __construct() {
		// add action render service hours on frontend
		add_action( 'wp_ajax_wbk-render-days', array( $this, 'ajaxRenderDays') );
		add_action( 'wp_ajax_nopriv_wbk-render-days', array( $this,'ajaxRenderDays') );
		// add action search time slots on fronted
		add_action( 'wp_ajax_wbk_search_time', array( $this, 'ajaxSearchTime') );
		add_action( 'wp_ajax_nopriv_wbk_search_time', array( $this,'ajaxSearchTime') );
		// add action render time form
		add_action( 'wp_ajax_wbk_render_booking_form', array( $this, 'ajaxRenderBookingForm') );
		add_action( 'wp_ajax_nopriv_wbk_render_booking_form', array( $this, 'ajaxRenderBookingForm') );
		// add action for booking
		add_action( 'wp_ajax_wbk_book', array( $this, 'ajaxBook') );
		add_action( 'wp_ajax_nopriv_wbk_book', array( $this, 'ajaxBook') );
		// add action for payment prepare
		add_action( 'wp_ajax_wbk_prepare_payment', array( $this, 'ajaxPreparePayment') );
		add_action( 'wp_ajax_nopriv_wbk_prepare_payment', array( $this, 'ajaxPreparePayment') );
		// add action for payment delete
		add_action( 'wp_ajax_wbk_cancel_appointment', array( $this, 'ajaxCancelAppointment') );
		add_action( 'wp_ajax_nopriv_wbk_cancel_appointment', array( $this, 'ajaxCancelAppointment') );



	}
	// callback render service hours on frontend
	public function ajaxRenderDays() {
		date_default_timezone_set( 'UTC' );
		$total_steps = $_POST['step'];
		$service_id = $_POST['service'];
		if ( !WBK_Validator::checkInteger( $service_id, 1 , 999999 ) ) {
			echo -1;
			die();
			return;
		}
		if ( !WBK_Validator::checkInteger( $total_steps, 3 , 4 ) ) {
			echo -1;
			die();
			return;
		}
		if ( $total_steps == 3 ) {
			$step = 2;
		} else {
			$step = 3;
		}
		// initalize service object
	 	$this->service = new WBK_Service();
	 	if ( $this->service->setId( $service_id ) ){
	 		if ( !$this->service->load() ){
	 			echo -1;
	 			die();
	 			return;
	 		}
	 	} else {
	 		echo -1;
	 		die();
	 		return;
	 	}
		$business_hours = new WBK_Business_Hours();
 		$business_hours->load( $this->service->getBusinessHours() );
		$time_format = WBK_Date_Time_Utils::getTimeFormat();
		$select_hours_label = get_option( 'wbk_hours_label', '' );
		if ( $select_hours_label ==  '' ) {
			$select_hours_label = __( 'Suitable hours', 'wbk' );
		}
		$html = '<div class="wbk-col-12-12">';
		$html .= '<label class="wbk-input-label">' . $select_hours_label .' </label>';
		$html .= '<hr class="wbk-hours-separator">';
 		$unlocked_days_of_week = $business_hours->getLockedDaysOfWeek( $service_id );
		for ( $i = 1;  $i <= 7;  $i++ ) {
			$day_name = $business_hours->getDayName( $i );
			if ( $business_hours->isWorkday( $day_name ) ) {
				$html .= '<div class="wbk-frontend-row" >';
				$hours = $business_hours->getFullInterval( $day_name );
				$day_name_translated = $business_hours->getDayNameTranslated( $i );
				$select = '<select id="wbk-time_' . $day_name . '" class="wbk-input wbk-time_after">';
				for ( $time = $hours[0]; $time < $hours[1]; $time += 3600 ) {
					$time_temp = $time - 2;
					$select .= '<option value="' . $time_temp . '" >' .  __( 'from', 'wbk' ) . ' ' . date_i18n ( $time_format, $time ) . '</option>';
				}
				$select .= '</select>';
				$html .= '<div class="wbk-col-3-12 wbk-table-cell">
							<input type="checkbox" value="' . $day_name . '" class="wbk-checkbox" id="wbk-day_' . $day_name .  '" checked="checked"/>
							<label for="wbk-day_' . $day_name . '" class="wbk-checkbox-label wbk-dayofweek-label">' . $day_name_translated . '</label>
						  </div>';
				$html .= '<div class="wbk-col-9-12">' . $select . '</div>';
				$html .= '</div>';
			 	$html .= '<div class="wbk-clear"></div>';
			} else {
				if ( in_array( $i, $unlocked_days_of_week ) ) {
					$html .= '<div class="wbk-frontend-row" >';
					$hours = $business_hours->getFullInterval( $day_name );
					$day_name_translated = $business_hours->getDayNameTranslated( $i );
					$select = '<select id="wbk-time_' . $day_name . '" class="wbk-input wbk-time_after">';
					for ( $time = $hours[0]; $time < $hours[1]; $time += 3600 ) {
						$time_temp = $time - 2;
						$select .= '<option value="' . $time_temp . '" >' .  __( 'from', 'wbk' ) . ' ' . date_i18n ( $time_format, $time ) . '</option>';
					}
					$select .= '</select>';
					$html .= '<div class="wbk-col-3-12 wbk-table-cell">
								<input type="checkbox" value="' . $day_name . '" class="wbk-checkbox" id="wbk-day_' . $day_name .  '" checked="checked"/>
								<label for="wbk-day_' . $day_name . '" class="wbk-checkbox-label">' . $day_name_translated . '</label>
							  </div>';
					$html .= '<div class="wbk-col-9-12">' . $select . '</div>';
					$html .= '</div>';
				 	$html .= '<div class="wbk-clear"></div>';
				}
			}
		}
 		$html .= '<input type="button" class="wbk-button wbk-searchtime-btn"  id="wbk-search_time_btn" value="' . __( 'Search time slots', 'wbk' ) . '"  />';
 		$timezone = get_option( 'wbk_timezone', '' );
        if ( $timezone != '' ){
            date_default_timezone_set( $timezone );
        }
	 	echo '<hr class="wbk-separator"/>' . $html;
 	    die();
 	    return;
	}
	// callback search time slots
	public function ajaxSearchTime() {
		$service_id  = $_POST['service'];
		$date        = $_POST['date'];
		$days 	     = $_POST['days'];
		$times       = $_POST['times'];
		$offset 	 = $_POST['offset'];
		// check date variable: string date or int timestamp
		if ( !is_numeric( $date) ) {
			$day_to_render = strtotime( $date );
		} else {
			$day_to_render = $date;
		}
		if( !is_numeric( $offset ) ){
			$offset = 0;
		}
		// validation
		if ( get_option( 'wbk_mode', 'extended' ) == 'extended' ) {
			if ( !is_array( $days ) || !is_array( $times ) ) {
				echo -1;
				die();
				return;
			}
			if ( count( $days ) != count( $times ) ) {
				echo -2;
				die();
				return;
			}
			foreach ( $days as $day ) {
				if ( !WBK_Validator::checkDayofweek( $day ) ) {
					echo -3;
					die();
					return;
				}
			}
			foreach ( $times as $time ) {
				if ( !WBK_Validator::checkInteger( $time, 0, 1758537351 ) ) {
					echo -4;
					die();
					return;
				}
			}
		}
		if ( !WBK_Validator::checkInteger( $day_to_render, 0, 1758537351 ) ) {
				echo -5;
				die();
				return;
		}
		// end validation
 		$service_schedule = new WBK_Service_Schedule();
 		$service_schedule->setServiceId( $service_id );
 		if ( !$service_schedule->load() ) {
 			echo -6;
 			die();
 			return;
 		}
		$date_format = WBK_Date_Time_Utils::getDateFormat();
 		$i = 0;
 		if ( get_option( 'wbk_mode', 'extended' ) == 'extended' ) {
	 		$output_count = 2;
	 	} else {
	 		$output_count = 0;
	 	}
	 	$html = '';
 		while ( $i <= $output_count ) {
 			$day_status =  $service_schedule->getDayStatus( $day_to_render );
 			if ( $day_status == 1 ) {
				if ( get_option( 'wbk_mode', 'extended' ) == 'extended' ) {
	 				$day_name = strtolower( date( 'l', $day_to_render ) );
	 				$key = array_search( $day_name, $days );
	 				if ( $key === FALSE ) {
						$day_to_render = strtotime( 'tomorrow', $day_to_render );
	 					continue;
	 				} else {
	 					$time_after = $times[$key] + $day_to_render;
	 				}
	 			} else {
	 				$time_after = $day_to_render;
	 			}
 				$service_schedule->buildSchedule( $day_to_render );
	 			$day_title = date_i18n ( $date_format, $day_to_render );
	 			$day_slots = $service_schedule->renderDayFrontend( $time_after, $offset );
	 			if ( $day_slots != '' ) {
	 				$html .= '<div class="wbk-col-12-12">
								<div class="wbk-day-title">
									'. $day_title .'
								</div>
								<hr class="wbk-day-separator">
	  						  </div>';
					$html .= '<div class="wbk-col-12-12 wbk-text-center" >' . $day_slots . '</div>';
	 			}
	 			$i++;
 			}
			if ( get_option( 'wbk_mode', 'extended' ) == 'extended' ) {
	  			$day_to_render = strtotime( 'tomorrow', $day_to_render );
			} else {
	  			$i++;
			}
		}
		if ( get_option( 'wbk_mode', 'extended' ) == 'extended' ) {
			if ( $html != '' ) {
				$html .= '<div class="wbk-frontend-row" id="wbk-show_more_container">
							<input type="button" class="wbk-button"  id="wbk-show_more_btn" value="' . __( 'Show more', 'wbk' ) . '"  />
							<input type="hidden" id="wbk-show-more-start" value="' . $day_to_render . '">
						  </div>';
				$html .= '<div class="wbk-more-container"></div>';
			} else {
				$html = get_option( 'wbk_book_not_found_message',  'Unfortunately we were unable to meet your search criteria. Please change the criteria and try again.' );
			}
		} else {
			if ( $html == '' ) {
				$html = get_option( 'wbk_book_not_found_message',  'Unfortunately we were unable to meet your search criteria. Please change the criteria and try again.' );
			}
		}

		if ( get_option( 'wbk_show_cancel_button', 'disabled' ) == 'enabled' ){
			$html .= '<input class="wbk-button wbk-width-100 wbk-mt-10-mb-10 wbk-cancel-button"  value="' . get_option( 'wbk_cancel_button_text', __( 'Cancel', 'wbk' ) )  . '" type="button">';
		}

		
		echo $html;
		die();
		return;
	}
	public function ajaxRenderBookingForm() {
		$total_steps = $_POST['step'];
		$time = $_POST['time'];
		$service_id = $_POST['service'];
		if ( is_array( $time ) ){
			foreach ( $time as $time_this ) {
				if ( !WBK_Validator::checkInteger( $time_this, 0, 2758537351 ) ) {
					echo -1;
					die();
					return;
				}
			}
		} else {
			if ( !WBK_Validator::checkInteger( $time, 0, 2758537351 ) ) {
			echo -1;
			die();
			return;
		}
		}
		if ( !WBK_Validator::checkInteger( $total_steps, 2 , 4 ) ) {
			echo -1;
			die();
			return;
		}
		
		if ( get_option( 'wbk_mode', 'extended' ) == 'extended' ) {
			if ( $total_steps == 3 ) {
				$step = 3;
			} else {
				$step = 4;
			}
		} else {
			if ( $total_steps == 3 ) {
				$step = 3;
			} else {
				$step = 2;
			}
		}
		 
		$time_format = WBK_Date_Time_Utils::getTimeFormat();
		$date_format = WBK_Date_Time_Utils::getDateFormat();
		$service = new WBK_Service();
		if ( !$service->setId( $service_id ) ) {
			echo -1;
			die();
			return;
		}
		if ( !$service->load() ) {
			echo -6;
			die();
			return;
		}
		$form = $service->getForm();
	 	$form_label = get_option( 'wbk_form_label', '' );
	 	if ( $form_label ==  '' ) {
	 		$form_label = __( 'Fill in a form', 'wbk' );
	 	}

		$form_label = str_replace( '#service', $service->getName(), $form_label );
		if( is_array( $time ) ){
			$date_collect = array();
			$time_collect = array();
			$datetime_collect = array();
			foreach ( $time as $time_this ) {
				$date_collect[] = date_i18n( $date_format, $time_this );
				$time_collect[] = date_i18n( $time_format, $time_this );
				$datetime_collect[] = date_i18n( $date_format, $time_this ) . ' ' .  date_i18n( $time_format, $time_this );
			}
			$form_label = str_replace( '#date', implode(', ', $date_collect ), $form_label );
			$form_label = str_replace( '#time', implode(', ', $time_collect ), $form_label );
			$form_label = str_replace( '#dt', implode(', ', $datetime_collect ), $form_label );

 		} else {
			$form_label = str_replace( '#date', date_i18n( $date_format, $time ), $form_label );
			$form_label = str_replace( '#time', date_i18n( $time_format, $time ), $form_label );
			$form_label = str_replace( '#dt', date_i18n( $date_format, $time ) . ' ' .  date_i18n( $time_format, $time ), $form_label );

		}

		$html = '<div class="wbk-details-sub-title">' . $form_label . ' </div>';
		$html .= '<hr class="wbk-form-separator">';
		if ( $service->getQuantity() > 1 ) {
			$service_schedule = new WBK_Service_Schedule();
			$service_schedule->setServiceId( $service->getId() );

			if( is_array( $time ) ){
				$avail_count  = 1000000;
				foreach ( $time as $time_this ) {
					$current_avail  = $service_schedule->getAvailableCount( $time_this );
					if( $current_avail < $avail_count ){
						$avail_count = $current_avail;
					}
				}
			} else {
				$avail_count  = $service_schedule->getAvailableCount( $time );
			}		
			$html .= '<label for="wbk-quantity">' . get_option( 'wbk_book_items_quantity_label', '' ) . '</label>';
			$html .= '<select name="wbk-book-quantity" type="text" class="wbk-input wbk-width-100 wbk-mb-10" id="wbk-book-quantity">';
			for ( $i = 1; $i <= $avail_count; $i ++ ) {
				$html .= '<option value="' . $i . '" >' . $i . '</option>';
			}
			$html .= '</select>';
		}
		if ( $form == 0 ){
			$name_label = get_option( 'wbk_name_label', __( 'Name', 'wbk' ) );
			$email_label = get_option( 'wbk_email_label', __( 'Email', 'wbk' ) );
			$phone_label = get_option( 'wbk_phone_label', __( 'Phone', 'wbk' ) );
			$comment_label = get_option( 'wbk_comment_label', __( 'Comment', 'wbk' ) );
			if ( $name_label == '' ){
				$name_label =  __( 'Name', 'wbk' );
			}
			if ( $email_label == '' ){
				$email_label =  __( 'Email', 'wbk' );
			}
			if ( $phone_label == '' ){
				$phone_label =  __( 'Phone', 'wbk' );
			}
			if ( $comment_label == '' ){
				$comment_label =  __( 'Comment', 'wbk' );
			}	
			$html .= '<label class="wbk-input-label" for="wbk-customer_name">' .$name_label . '</label>';
			$html .= '<input name="wbk-name" type="text" class="wbk-input wbk-width-100 wbk-mb-10" id="wbk-customer_name" />';
			$html .= '<label class="wbk-input-label" for="wbk-customer_email">' . $email_label . '</label>';
			$html .= '<input name="wbk-email"  type="text" class="wbk-input wbk-width-100 wbk-mb-10" id="wbk-customer_email" />';
			$html .= '<label class="wbk-input-label" for="wbk-customer_phone">' . $phone_label . '</label>';
			$html .= '<input name="wbk-phone" type="text" class="wbk-input wbk-width-100 wbk-mb-10" id="wbk-customer_phone" />';
			$html .= '<label class="wbk-input-label" for="wbk-customer_desc">' . $comment_label . '</label>';
	 		$html .= '<textarea name="wbk-comment" rows="3" class="wbk-input wbk-textarea wbk-width-100 wbk-mb-10" id="wbk-customer_desc"></textarea> ';
		} else {
			$cf7_form = do_shortcode( '[contact-form-7 id="' . $form . '"]' );
			$cf7_form = str_replace('<p>', '', $cf7_form );
			$cf7_form = str_replace('</p>', '', $cf7_form );
			$cf7_form = str_replace('<label', '<label class="wbk-input-label" ', $cf7_form );
			$cf7_form = str_replace('type="checkbox"', 'type="checkbox" class="wbk-checkbox" ', $cf7_form );
			$cf7_form = str_replace('wbk-checkbox', ' wbk-checkbox wbk-checkbox-custom ', $cf7_form );
			$cf7_form = str_replace('wpcf7-list-item-label', 'wbk-checkbox-label', $cf7_form );
			$cf7_form = str_replace('wpcf7-list-item', 'wbk-checkbox-span-holder', $cf7_form );
			$cf7_form = str_replace('wpcf7-list-item-label', 'wbk-checkbox-label', $cf7_form );
			$cf7_form = str_replace( 'name="wbk-acceptance"',
									 'name="wbk-acceptance" value="1" id="wbk-acceptance" aria-invalid="false"><span class="wbk-checkbox-label"></span> <input type="hidden"',
									  $cf7_form );

			 

			$html .= $cf7_form;
		}
		$book_text = get_option( 'wbk_book_text_form', '');
		if ( $book_text == '' ){
			$book_text = __( 'Book', 'wbk' );
		}
        $html .= '<input type="button" class="wbk-button wbk-width-100 wbk-mt-10-mb-10" id="wbk-book_appointment" value="' . $book_text . '">';

        if ( get_option( 'wbk_show_cancel_button', 'disabled' ) == 'enabled' ){
			$html .= '<input class="wbk-button wbk-width-100 wbk-cancel-button"  value="' . get_option( 'wbk_cancel_button_text', __( 'Cancel', 'wbk' ) )  . '" type="button">';
		}
 	 	echo '<hr class="wbk-separator"/>' . $html;
		die();
		return;
	}
	public function ajaxBook() {
		global $wpdb;
		$name = sanitize_text_field( $_POST['name'] );
		$email = sanitize_text_field( $_POST['email'] );
		$phone = sanitize_text_field( $_POST['phone'] );
		$times = $_POST['time'] ;
		$desc = sanitize_text_field(  $_POST['desc'] );
		$extra = sanitize_text_field( $_POST['extra'] );
		$quantity = sanitize_text_field( $_POST['quantity']);
		$secondary_data = $_POST['secondary_data'];

		if( !is_array( $times ) ){
			$times = array( $times );
		}

		$appointment_ids = array();
		foreach ( $times as $time ) {
			if( !is_numeric( $time ) ){
				echo -9;
				die();
				return;
			}
			if( $time < time() ){
				echo -9;
				die();
				return;
			}
			if( !WBK_Validator::checkInteger( $quantity, 1, 1000000 ) ){
				echo -9;
				die();
				return;
			}
			$service_id = $_POST['service'];
			$day = strtotime( date( 'Y-m-d', $time ).' 00:00:00' );
			$service = new WBK_Service();
			if ( !$service->setId( $service_id ) ) {
				echo -6;
				die();
				return;
			}
			if ( !$service->load() ) {
				echo -6;
				die();
				return;
			}
			if( $service->getQuantity() == 1 ) {
				$count = $wpdb->get_var( $wpdb->prepare( 'SELECT COUNT(*) FROM wbk_appointments where service_id = %d and time = %d', $service_id, $time ) );
				if ( $count > 0 ) {
					echo -9;
					die();
					return;
				}
			} else {
				$service_schedule = new WBK_Service_Schedule();
				$service_schedule->setServiceId( $service->getId() );
				$avail_count  = $service_schedule->getAvailableCount( $time );
				if ( $quantity > $avail_count ){
					echo -13;
					die();
					return;
				}
			}
			$duration = $service->getDuration();
			$appointment = new WBK_Appointment();
			if ( !$appointment->setName( $name ) ){
				echo -1;
				die();
				return;
			}
			if ( !$appointment->setEmail( $email ) ){
				echo -2;
				die();
				return;
			}
			if ( !$appointment->setPhone( $phone ) ){
				echo -3;
				die();
				return;
			}
			if ( !$appointment->setTime( $time ) ){
				echo -4;
				die();
				return;
			}
			if ( !$appointment->setDay( $day ) ){
				echo -5;
				die();
				return;
			}
			if ( !$appointment->setService( $service_id ) ){
				echo -6;
				die();
				return;
			}
			if ( !$appointment->setDuration( $duration ) ){
				echo -7;
				die();
				return;
			}
			if ( !$appointment->setDescription( $desc ) ){
				echo -9;
				die();
				return;
			}
			if ( !$appointment->setExtra( $extra ) ){
				echo -9;
				die();
				return;
			}
			if ( !$appointment->setQuantity( $quantity ) ){
				echo -9;
				die();
				return;
			}
			$appointment_id = $appointment->add();
			if ( !$appointment_id ) {
				echo -8;
				die();
				return;
			}
			if( get_option( 'wbk_appointments_default_status', 'approved' ) == 'approved' ){
				WBK_Db_Utils::updateAppointmentStatus( $appointment_id, 'approved' );
			}
			$auto_lock = get_option( 'wbk_appointments_auto_lock', 'disabled' );
			if ( $auto_lock == 'enabled' ){
				WBK_Db_Utils::lockTimeSlotsOfOthersServices( $service_id, $appointment_id );
			}
			$appointment_ids[] = $appointment_id;
			$noifications = new WBK_Email_Notifications( $service_id, $appointment_id );
			$noifications->send( 'book' );
			// secondary names notifications
			if ( is_array( $secondary_data ) ){
				$noifications->sendToSecondary( $secondary_data );
			}
			$expiration_mode = get_option( 'wbk_appointments_delete_not_paid_mode', 'disabled' );
			if( $expiration_mode == 'on_booking' ){
				WBK_Db_Utils::setAppointmentsExpiration( $appointment_id );
			}
		 	
		}	 
		
		$thanks_message = get_option( 'wbk_book_thanks_message', '' );
	 	if ( $thanks_message ==  '' ) {
	 		$thanks_message =  __( 'Thanks for booking appointment', 'wbk' );	
	 	}



		echo $thanks_message . WBK_PayPal::renderPaymentMethods( $service_id, $appointment_ids );

		die();
		return;
	}
	public function ajaxPreparePayment() {	 
		$method = sanitize_text_field( $_POST['method'] );
		$app_ids = explode( ',', sanitize_text_field( $_POST['app_id'] ) );
		$referer = explode( '?' , wp_get_referer() ); 

		$pay_not_approved = get_option( 'wbk_appointments_allow_payments', 'disabled' );
		$appointment_ids = array();
		foreach ( $app_ids as  $appointment_id ) {
			$status =  WBK_Db_Utils::getStatusByAppointmentId( $appointment_id );		
			if( $status == 'paid' || $status == 'paid_approved' || ( $status == 'pending' && $pay_not_approved == 'enabled' )  ){
				continue;
			}	
			$appointment_ids[] = $appointment_id;
		}
		if( count( $appointment_ids) == 0 ){
			$html = get_option( 'wbk_nothing_to_pay_message', __ ( 'There are no bookings available for payment.', 'wbk' ) );
			echo $html;
			wp_die();
			return;
		}

		$paypal = new WBK_PayPal();
		if ( $paypal->init( $referer[0] ) === FALSE ){
			echo 'Payment method not supported.';
			wp_die();
			return;
		}
		
	 
		echo  $html;
		wp_die();
		return;
	}
	public function	ajaxCancelAppointment(){
		$email = $_POST['email'];
		$app_token = $_POST['app_token'];
		$app_token = str_replace('"', '', $app_token );
		$app_token = str_replace('<', '', $app_token );
		$app_token = str_replace('\'', '', $app_token );
		$app_token = str_replace('>', '', $app_token );
		$app_token = str_replace('/', '', $app_token );
		$app_token = str_replace('\\',  '', $app_token );
		if ( !WBK_Validator::checkEmail( $email ) ){
			echo get_option( 'wbk_booking_cancel_error_message', __( 'Unable to cancel booking, please check the email you\'ve entered.', 'wbk' ) );
			wp_die();
			return;
		}
		if( WBK_Db_Utils::deleteAppointmentByEmailTokenPair( $email, $app_token ) == true ){
			$result = array( 'status' => 1,
							 'message' => get_option( 'wbk_booking_canceled_message', __( 'Your appointment booking has been canceled.', 'wbk' ) ) );
			echo json_encode( $result );
		} else {
			$result = array( 'status' => 0,
							 'message' => get_option( 'wbk_booking_cancel_error_message', __( 'Unable to cancel booking, please check the email you\'ve entered.', 'wbk' ) ) );
			echo json_encode( $result );
		}
		wp_die();
		return;
	}
}
?>