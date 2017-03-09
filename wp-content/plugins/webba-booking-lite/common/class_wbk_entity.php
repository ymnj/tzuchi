<?php
//WBK database entity class
// check if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
// include validator class
require_once  dirname(__FILE__) . '/class_wbk_validator.php';
class WBK_Entity {
	// entity id
	protected $id;
	// entity name
	protected $name;
 	
 	// entity description 
	protected $description;
	// table name
	protected $table_name;
	// errors array
	protected $error_messages;
	public function __construct() {
		$this->error_messages = array();
	}
	// set id
	public function setId( $value ) {
 
		if ( WBK_Validator::checkInteger( $value, 1, 9999999 ) ){
			$this->id = $value;
			return true;
		} else {
			array_push( $this->error_messages, __( 'incorrect id', 'wbk' ) );
			return false;
		} 
	}
	// get id
	public function getId() {
		return absint( $this->id );
	}
	// set name
	public function setName( $value ) {
		$value = sanitize_text_field ( $value );
		if ( WBK_Validator::checkStringSize( $value, 0, 128 ) ){
			$this->name = $value;
			return true;
		} else {
			array_push( $this->error_messages, __( 'incorrect name', 'wbk' ) );
			return false;
		} 
	}
	// get name
	public function getName () {
		$value = sanitize_text_field( $this->name );
		return  $value;
	}
	// set description
	public function setDescription( $value ) {
		$value = sanitize_text_field ( $value );
		if ( WBK_Validator::checkStringSize( $value, 0, 1024 ) ){
			$this->description = $value;
			return true;
		} else {
			array_push( $this->error_messages, __( 'incorrect description', 'wbk' ) );
			return false;
		} 
	}
	// get description
	public function getDescription () {
		$value = sanitize_text_field( $this->description );
		return $value;
	}
	 // load row by id
	public function load () {
		global $wpdb;
		if ( !isset( $this->id ) ) {
			return false;
		}
		$result = $wpdb->get_row( $wpdb->prepare( " SELECT * FROM $this->table_name WHERE id = %d ", $this->id ) );
		if ( $result == NULL ) {
			return false;
		}
		if ( !$this->setName( $result->name ) ) {
			
			return false;
		}
		if ( !$this->setDescription( $result->description ) ) {
			return false;
		}
		return $result;
	}
	
	// check name duplicate
	protected function nameDuplicate() {
		global $wpdb;
		$count = $wpdb->get_var( $wpdb->prepare( " SELECT COUNT(*) FROM $this->table_name WHERE name = %s AND id <> %d ", $this->getName(), $this->getId() ) );
		if ( $count > 0 ){
			return false;
		
		} else {
			return true;
		}
	}
	// update entity
	public function update() {
		if ( !$this->nameDuplicate() ) {
			return false;
		}
		global $wpdb;
		if ( !isset( $this->id ) ) {
			return false;
		}
		if ( $wpdb->update( 
				$this->table_name, 
			
				array( 
			
					'name' => $this->getName(),	 
			
					'description' => $this->getDescription()	 
				), 
				array( 'id' => $this->getId() ), 
				
				array( 
			
					'%s',	 
					'%s'	 
				), 
				array( '%d' ) 
			) === false ) {
			return false;
		} else {
			return true;
		}
	}
	// delete entity from database
	public function delete() {
		global $wpdb;
		$result = $wpdb->query( $wpdb->prepare( "DELETE FROM $this->table_name WHERE id = %d", $this->getId() ) );
  
  		return $result;
	}
}