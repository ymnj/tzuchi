<?php
// check if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
class WBK_Frontend_Booking {
	public function __construct() {
		// add shortcode
		add_shortcode( 'webba_booking' , array( $this, 'shotrcodeBooking' ) ); 
 		// init scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts') );
		// param process
		add_action ('wp_loaded', array( $this, 'paramProcessing' ) );
	} 
	public function paramProcessing() {
		// check if called as payment result
	    if( isset( $_GET['pp_aprove'] ) ){
	    	if ( $_GET['pp_aprove'] == 'true' ){
	    		if ( isset( $_GET['paymentId'] ) && isset( $_GET['PayerID'] ) ){
	    			$paymentId = $_GET['paymentId'];
	    			$PayerID = $_GET['PayerID'];
	    			$paypal = new WBK_PayPal();
	    			$init_result = $paypal->init( false );
	    			if ( $init_result === FALSE ){   				    				 
	    			 	wp_redirect( get_permalink() . '?paypal_status=2'  );
					 	exit;
	    			} else {
	    				$execResult = $paypal->executePayment( $paymentId, $PayerID );
	    				if( $execResult === false ){
	    					wp_redirect( get_permalink() . '?paypal_status=3' );
							exit;
	    				} else {
	    					wp_redirect( get_permalink() . '?paypal_status=1' );
							exit;
	    				}
	    			}
	    		} else {  			 
		   			wp_redirect( get_permalink() . '?paypal_status=4' );
					exit;
	    		}
	    	} elseif( $_GET['pp_aprove'] == 'false' ) {
				if( isset( $_GET['cancel_token'] ) ){
					$cancel_token =  $_GET['cancel_token'];
					$cancel_token = str_replace('"', '', $cancel_token );
					$cancel_token = str_replace('<', '', $cancel_token );
					$cancel_token = str_replace('\'', '', $cancel_token );
					$cancel_token = str_replace('>', '', $cancel_token );
					$cancel_token = str_replace('/', '', $cancel_token );
					$cancel_token = str_replace('\\',  '', $cancel_token );
					 
					WBK_Db_Utils::clearPaymentIdByToken( $cancel_token );
					
				}



				wp_redirect( get_permalink() . '?paypal_status=5' );
				exit;
	    	}
		} 
 	}
	public function render( $template, $data ){
		// load and output view template
		ob_start();
        ob_implicit_flush(0);
		try {
             include  dirname(__FILE__) . '/../templates/tpl_wbk_frontend_' . $template . '.php';
        } catch (Exception $e) {
        	ob_end_clean();
            throw $e;
        }
        return ob_get_clean();
	}
	public function shotrcodeBooking( $attr ) {
		extract( shortcode_atts( array( 'service' => '0' ), $attr ) );
		extract( shortcode_atts( array( 'category' => '0' ), $attr ) );

		$data = array();
		$data[0] = $service;
		$data[1] = $category;
		return $this->render( 'booking_ui', $data );
	}
	public function enqueueScripts() {
		if( $this->has_shortcode( 'webba_booking' ) ) {
			wp_enqueue_script( 'wbk-validator', plugins_url( '../common/wbk-validator.js', dirname( __FILE__ ) ), array( 'jquery', 'jquery-ui-core', 'jquery-effects-core' ) );   

			if( get_option('wbk_phone_mask', 'enabled') == 'enabled' ){
				wp_enqueue_script( 'jquery-maskedinput', plugins_url( '../common/jquery.maskedinput.min.js', dirname( __FILE__ ) ), array( 'jquery', 'jquery-ui-core', 'jquery-effects-core' ) );  
			} elseif( get_option('wbk_phone_mask', 'enabled') == 'enabled_mask_plugin' ){
				wp_enqueue_script( 'jquery-maskedinput', plugins_url( '../common/jquery.mask.js', dirname( __FILE__ ) ), array( 'jquery', 'jquery-ui-core', 'jquery-effects-core' ) );  
			}		
			wp_enqueue_script( 'jquery-effects-fade' ); 
			if( get_option( 'wbk_jquery_nc', 'disabled' ) == 'disabled' ){
			    wp_enqueue_script( 'wbk-frontend', plugins_url( 'js/wbk-frontend.js', dirname( __FILE__ ) ), array( 'jquery', 'jquery-ui-core', 'jquery-effects-core' ) );	 
			} elseif( get_option( 'wbk_jquery_nc', 'disabled' ) == 'enabled' ){
				wp_enqueue_script( 'wbk-frontend', plugins_url( 'js/wbk-frontend-nc.js', dirname( __FILE__ ) ), array( 'jquery', 'jquery-ui-core', 'jquery-effects-core' ) );	 
			}
		    wp_enqueue_script( 'picker', plugins_url( 'js/picker.js', dirname( __FILE__ ) ), array( 'jquery', 'jquery-ui-core', 'jquery-effects-core' ) );
		    wp_enqueue_script( 'picker-date', plugins_url( 'js/picker.date.js', dirname( __FILE__ ) ), array( 'jquery', 'jquery-ui-core', 'jquery-effects-core' ) );
		    wp_enqueue_script( 'picker-legacy', plugins_url( 'js/legacy.js', dirname( __FILE__ ) ), array( 'jquery', 'jquery-ui-core', 'jquery-effects-core' ) );

	 		wp_enqueue_style( 'picker-default', plugins_url( 'css/default.css', dirname( __FILE__ ) ) );
	 		wp_enqueue_style( 'picker-default-date', plugins_url( 'css/default.date.css', dirname( __FILE__ ) ) );
	 		wp_enqueue_style( 'wbk-frontend-style-custom', plugins_url( 'css/wbk-frontend-custom-style.css', dirname( __FILE__ ) ) );
	 		wp_enqueue_style( 'wbk-frontend-style', plugins_url( 'css/wbk-frontend-default-style.css', dirname( __FILE__ ) ) );
	 		$startOfWeek = get_option( 'wbk_start_of_week', 'monday' );
	 		if ( $startOfWeek == 'monday' ){
	 			$startOfWeek = true;
	 		} else{
	 			$startOfWeek = false;
	 		}
	 		$select_date_extended_label = get_option( 'wbk_date_extended_label', '' );
	 		if ( $select_date_extended_label ==  '' ) {
	 			$select_date_extended_label = __( 'Book an appointment on or after', 'wbk' );
	 		}
	 		$select_date_basic_label = get_option( 'wbk_date_basic_label', '' );
	 		if ( $select_date_basic_label ==  '' ) {
	 			$select_date_basic_label = __( 'Book appointment on', 'wbk' );
	 		}	 	 
	 		$select_slots_label = get_option( 'wbk_slots_label', '' );
	 		if ( $select_slots_label ==  '' ) {
	 			$select_slots_label = __( 'Available time slots', 'wbk' );
	 		}
			$thanks_message = get_option( 'wbk_book_thanks_message', '' );
	 		if ( $thanks_message ==  '' ) {
	 			$thanks_message =  __( 'Thanks for booking appointment', 'wbk' );	
	 		}
	 		$select_date_placeholder = get_option( 'wbk_date_input_placeholder', '' );
	 		if ( $select_date_placeholder == '' ){
	 			$select_date_placeholder =  __( 'date...', 'wbk' );
	 		}
			// Localize the script with new data
			$translation_array = array(
				'mode' => get_option( 'wbk_mode', 'extended' ),		
				'phonemask' => get_option( 'wbk_phone_mask', 'enabled' ),
				'phoneformat' => get_option( 'wbk_phone_format', '(999) 999-9999' ),	
				'ajaxurl' => admin_url( 'admin-ajax.php'),
				'selectdatestart' => $select_date_extended_label,
				'selectdatestartbasic' => $select_date_basic_label,
				'selecttime' => $select_slots_label, 
				'selectdate' => $select_date_placeholder,			
				'thanksforbooking' =>  $thanks_message,
				'january' => __( 'January', 'wbk' ),
				'february' => __( 'February', 'wbk' ),
				'march' => __( 'March', 'wbk' ),
				'april' => __( 'April', 'wbk' ),
				'may' => __( 'May', 'wbk' ),
				'june' => __( 'June', 'wbk' ),
				'july' => __( 'July', 'wbk' ),
				'august' => __( 'August', 'wbk' ),
				'september' => __( 'September', 'wbk' ),
				'october' => __( 'October', 'wbk' ),
				'november' => __( 'November', 'wbk' ),
				'december' => __( 'December', 'wbk' ),
				'jan' =>  __( 'Jan', 'wbk' ),  
				'feb' =>  __( 'Feb', 'wbk' ),  
				'mar' =>  __( 'Mar', 'wbk' ),  
				'apr' =>  __( 'Apr', 'wbk' ),  
				'mays' =>  __( 'May', 'wbk' ), 
				'jun' =>  __( 'Jun', 'wbk' ), 
				'jul' =>  __( 'Jul', 'wbk' ), 
				'aug' =>  __( 'Aug', 'wbk' ), 
				'sep' =>  __( 'Sep', 'wbk' ), 
				'oct' =>  __( 'Oct', 'wbk' ), 
				'nov' =>  __( 'Nov', 'wbk' ), 
				'dec' =>  __( 'Dec', 'wbk' ), 
				'sunday' =>  __( 'Sunday', 'wbk' ), 
				'monday' =>  __( 'Monday', 'wbk' ), 
				'tuesday' =>  __( 'Tuesday', 'wbk' ), 
				'wednesday' =>  __( 'Wednesday', 'wbk' ), 
				'thursday' =>  __( 'Thursday', 'wbk' ), 
				'friday' =>  __( 'Friday', 'wbk' ), 
				'saturday' =>  __( 'Saturday', 'wbk' ), 
				'sun' =>  __( 'Sun', 'wbk' ), 
				'mon' =>  __( 'Mon', 'wbk' ), 
				'tue' =>  __( 'Tue', 'wbk' ), 
				'wed' =>  __( 'Wed', 'wbk' ), 
				'thu' =>  __( 'Thu', 'wbk' ), 
				'fri' =>  __( 'Fri', 'wbk' ), 
				'sat' =>  __( 'Sat', 'wbk' ), 
				'today' =>  __( 'Today', 'wbk' ), 
				'clear' =>  __( 'Clear', 'wbk' ), 
				'close' =>  __( 'Close', 'wbk' ),
				'startofweek' => $startOfWeek,
				'nextmonth' => __( 'Next month', 'wbk' ),
				'prevmonth'=> __( 'Previous  month', 'wbk' ),
				'hide_form' => get_option( 'wbk_hide_from_on_booking', 'disabled' ),
				'booked_text' => get_option( 'wbk_booked_text',  'Booked' ),
				'show_booked'  => get_option( 'wbk_show_booked_slots', 'disabled' ),
				'multi_booking'  => get_option( 'wbk_multi_booking', 'disabled' ),
				'checkout'  => get_option( 'wbk_checkout_button_text', 'Checkout' )

			);                                                 
			wp_localize_script( 'wbk-frontend', 'wbkl10n', $translation_array );
	 	}
	}
	// check if post has shortcode
	private function has_shortcode( $shortcode = '' ) {     
	    if( get_option('wbk_check_short_code', 'disabled') == 'disabled' ){
	    	return true;
	    }
	    $post_to_check = get_post(get_the_ID()); 
	    if ( !$post_to_check ) {
	    	return false;
	    }    
	    $found = false;
	    if ( !$shortcode ) {
	        return $found;
	    }
	    if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {
 	        $found = true;
	    }
 	    return $found;
	}
}
?>