<?php
//WBK service entity class
// check if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
class WBK_Service extends WBK_Entity {
	// e-mail for notifications for service
	protected $email;
	// duration of appointment for service
	protected $duration;
	// interval between appointments
	protected $interval;
	// business hours
	protected $business_hours;
	// users
	protected $users;
	// step
	protected $step;
	// form
	protected $form;
	// quantity
	protected $quantity;
	// price
	protected $price;
	// payment methods
	protected $payment_methods;
 	// notification template
 	protected $notification_template;
 	// reminder tamplate
 	protected $reminder_template;
 	// prepare time
 	protected $prepare_time;

	public function __construct() {
		parent::__construct();
		$this->table_name = 'wbk_services';
	}
	// set email
	public function setEmail( $value ) {
		$value = sanitize_email( $value );
		if ( WBK_Validator::checkEmail( $value ) ){
			$this->email = $value;
			return true;
		} else {
			array_push( $this->error_messages, __( 'incorrect email', 'wbk' ) );
			return false;
		} 
 
	} 
	// get email
	public function getEmail() {
		$value = sanitize_email( $this->email );
		return $value;
	}
	// set duration
	public function setDuration( $value ) {
		$value = absint( $value );
		if ( WBK_Validator::checkInteger( $value, 1, 1440 ) ){
			$this->duration = $value;
			return true;
		} else {
			array_push( $this->error_messages, __( 'incorrect duration', 'wbk' ) );
			return false;
		} 
	}
	// get duration
	public function getDuration() {
		return absint( $this->duration );
	}
	// set prepare_time
	public function setPrepareTime( $value ) {
		$value = absint( $value );
		if ( WBK_Validator::checkInteger( $value, 0, 360 ) ){
			$this->prepare_time = $value;
			return true;
		} else {
			array_push( $this->error_messages, __( 'incorrect prepare_time', 'wbk' ) );
			return false;
		} 
	}
	// get prepare time
	public function getPrepareTime() {
		return absint( $this->prepare_time );
	}

	// set step
	public function setStep( $value ) {
		$value = absint( $value );
		if ( WBK_Validator::checkInteger( $value, 1, 720 ) ){
			$this->step = $value;
			return true;
		} else {
			array_push( $this->error_messages, __( 'incorrect step', 'wbk' ) );
			return false;
		} 
	}
	// get step
	public function getStep() {
		return absint( $this->step );
	}
	// set quantity
	public function setQuantity( $value ) {
		$value = absint( $value );
		if ( WBK_Validator::checkInteger( $value, 1, 1000000 ) ){
			$this->quantity = $value;
			return true;
		} else {
			array_push( $this->error_messages, __( 'incorrect quantity', 'wbk' ) );
			return false;
		} 
	}
	// get quantity
	public function getQuantity() {
		return absint( $this->quantity );
	}
	// set price
	public function setPrice( $value ) {
		if ( WBK_Validator::checkPrice( $value ) ){
			$this->price = $value;
			return true;
		} else {
			array_push( $this->error_messages, __( 'incorrect price', 'wbk' ) );
			return false;
		} 
	}
	// get price
	public function getPrice() {
		return  $this->price;
	}

	// set interval
	public function setInterval( $value ) {
		$value = absint( $value );
		if ( WBK_Validator::checkInteger( $value, 0, 1440 ) ){
			$this->interval = $value;
			return true;
		} else {
			array_push( $this->error_messages, __( 'incorrect interval', 'wbk' ) );
			return false;
		} 
	}
	// get interval
	public function getInterval() {
		return absint( $this->interval );
	}
	// set business hours
	public function setBusinessHours( $value ) {
		$value = trim( $value );
		if ( $value == '' ) {
			return true;
		}
		if ( WBK_Validator::checkBusinessHours( $value ) ){
			$this->business_hours = $value;
			return true;
		} else {
			return false;
		}
	}
	// get business hours
	public function getBusinessHours() {
		return $this->business_hours;
	}
	// set users
	public function setUsers( $value ) {
		if ( $value == '' ){
			$this->users = '';
			return true;
		}
		$arr_items = explode( ';', $value );
 		foreach( $arr_items as $item ) {
			if ( !WBK_Validator::checkInteger( $item, 0, 9999999 ) ){
 				return false;
 			}
		}
		$this->users = $value;
		return true;
	}
	// get users
	public function getUsers() {
		return $this->users;
	}
    // set payment methods
	public function setPayementMethods( $value ) {
		if ( $value == '' ){
			$this->payment_methods = '';
			return true;
		}
		$arr_items = explode( ';', $value );
 		foreach( $arr_items as $item ) {
			if (  $item != 'paypal' && $item != 'paypal_cc' ){
 				return false;
 			}
		}
		$this->payment_methods = $value;
		return true;
	}
	// get users
	public function getPayementMethods() {
		return $this->payment_methods;
	}

	// set form
	public function setForm( $value ) {
		if ( !WBK_Validator::checkInteger( $value, 0, 9999999 ) ){
			return false;
		}		 
		$this->form = $value;
		return true;
	}
	// get form
	public function getForm() {
		return $this->form;
	}
	// set notification template
	public function setNotificationTemplate( $value ) {
		if ( !WBK_Validator::checkInteger( $value, 0, 9999999 ) ){
			return false;
		}		 
		$this->notification_template = $value;
		return true;
	}
	// get notification template
	public function getNotificationTemplate() {
		return $this->notification_template;
	}
	// set reminder template
	public function setReminderTemplate( $value ) {
		if ( !WBK_Validator::checkInteger( $value, 0, 9999999 ) ){
			return false;
		}		 
		$this->reminder_template = $value;
		return true;
	}
	// get reminder template
	public function getReminderTemplate() {
		return $this->reminder_template;
	}

	// load row from db and put class properties
	public function load () {
 
		$result = parent::load(); 
 		if ( !$result ) {
 			return false;
 		} 
 		if ( !$this->setEmail( $result->email ) ) {
			return false;
		}
 		if ( !$this->setDuration( $result->duration ) ) {
			return false;
		}
		if ( !$this->setInterval( $result->interval_between ) ) {
			return false;
		}
		if ( !$this->setStep( $result->step ) ) {
			return false;
		}
		if ( !$this->setBusinessHours( $result->business_hours ) ) {
			return false;
		}
		if ( !$this->setUsers( $result->users ) ) {
			return false;
		}
		if ( !$this->setForm( $result->form ) ) {
			return false;
		}
		if ( !$this->setQuantity( $result->quantity ) ) {
			return false;
		}
		if ( !$this->setPrice( $result->price ) ) {
			return false;
		}
		if ( !$this->setPayementMethods( $result->payment_methods ) ) {
			return false;
		}
		if ( !$this->setNotificationTemplate( $result->notification_template ) ) {
			return false;
		}
		if ( !$this->setReminderTemplate( $result->reminder_template ) ) {
			return false;
		}
		if ( !$this->setPrepareTime( $result->prepare_time ) ) {
			return false;
		}
		return true;
  	}
  	// update service
	public function update() {
		global $wpdb;
 
		if ( parent::update() === false ) {
			return false;
		}
  
		if ( $wpdb->update( 
				$this->table_name, 
			
				array( 
					'email' => $this->getEmail(),	 
					'duration' => $this->getDuration(), 
					'interval_between' => $this->getInterval(),
					'step' => $this->getStep(),
					'business_hours' => $this->getBusinessHours(),
					'users'	=> $this->getUsers(),
					'form'	=> $this->getForm(),
					'quantity' => $this->getQuantity(),
					'price' => $this->getPrice(),
					'payment_methods' =>$this->getPayementMethods(),
					'notification_template' => $this->getNotificationTemplate(),
					'reminder_template' => $this->getReminderTemplate(),
					'prepare_time' => $this->getPrepareTime()
				), 
				array( 'id' => $this->getId() ), 
				
				array( 
			
					'%s',	 
					'%d',	 
					'%d',
					'%d',
					'%s',
					'%s',
					'%d',	 
					'%d',
					'%f',
                    '%s',
                    '%d',
                    '%d',
                    '%d'
				), 
				array( '%d' ) 
			) === false ) {
			return false;
		} else {
			return true;
		}
	}
	
	// add service
	public function add() {
		global $wpdb;
  
		if ( $wpdb->insert( 
				$this->table_name, 
			
				array( 
					'name' => $this->getName(),
					'description' => $this->getDescription(),
					'email' => $this->getEmail(),	 
					'duration' => $this->getDuration(), 
					'step' => $this->getStep(),
					'interval_between' => $this->getInterval(),
					'business_hours' => $this->getBusinessHours(),
					'users'	=> $this->getUsers(),
					'form'	=> $this->getForm(),
					'quantity'	=> $this->getQuantity(),
					'price' => $this->getPrice(),
					'payment_methods' =>$this->getPayementMethods(),
					'notification_template' => $this->getNotificationTemplate(),
					'reminder_template' => $this->getReminderTemplate(),
					'prepare_time' => $this->getPrepareTime()
				), 
				 
				
				array( 
					'%s',					
					'%s',			
					'%s',	 
					'%d',	 
					'%d',
					'%d',
					'%s',
					'%s',
					'%d',
					'%d',
					'%f',
					'%s',
					'%d',
                    '%d',
                    '%d'
				) 
			) === false ) {
			return false;
		} else {
			$new_id = $wpdb->get_var( $wpdb->prepare( 'SELECT id FROM wbk_services where name = %s', $this->getName() ) );
			return $new_id;
		}
	}
	// delete service from database
	public function delete() {
		global $wpdb;
		$result = parent::delete();
		$wpdb->query( $wpdb->prepare( "DELETE FROM wbk_locked_time_slots WHERE service_id = %d", $this->getId() ) );
  		$wpdb->query( $wpdb->prepare( "DELETE FROM wbk_days_on_off WHERE service_id = %d", $this->getId() ) );
		$wpdb->query( $wpdb->prepare( "DELETE FROM wbk_appointments WHERE service_id = %d", $this->getId() ) );
  		return $result;
	}
}
?>