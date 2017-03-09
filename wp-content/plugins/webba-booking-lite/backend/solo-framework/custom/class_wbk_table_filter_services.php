<?php
// Solo Framework table filter class
if ( ! defined( 'ABSPATH' ) ) exit;
class WBKTableFilterServices extends SLFTableFilter {
	public function __construct( $title, $field ) {
  		parent::__construct( $title, $field );
   	}
    public function valid(){
        return TRUE;
    }
    public function  set( $value ){
        $this->services = array();
        if( !is_array($value ) ){
            $this->services = array(-1);
            return FALSE;          
        }	   	
        foreach ( $value as $item ) {
           if ( !is_numeric( $item ) ){
               $this->services = array(-1);
               return FALSE;
           } else {
               $this->services[] = $item;
           }
        }
		return TRUE;
    }
    public function setDefault(){
    	 $this->services = array(-1);
    }
    public function render(){
        global $current_user;
        $arrIds = WBK_Db_Utils::getServices();
	    $html = '<div class="slf-filter-container">';
        $html .= '<span class="slf-filter-title">' . $this->title .'</span>';	
        $html .= '<select  multiple="multiple"  data-field="' . $this->field . '" class="slf_filter" id="wbk_filter_services_control" >';  
         foreach ( $arrIds as $id ) {
        // check access
        if ( !in_array( 'administrator', $current_user->roles ) ) {
          if ( !WBK_Validator::checkAccessToService( $id ) ) {
                    continue;
          }     
        }
        $service = new WBK_Service();
        if ( !$service->setId( $id ) ) {  
          continue;
        }
        if ( !$service->load() ) {  
          continue;
        }
        $html .= '<option value="'. $id . '">' . $service->getName() . '</option>';
      }
      $html .= '</select>';
      $html .='</div>';
      return $html;
    }
    public function getSql(){
        global $current_user;
        $str_arr = array();
        foreach ( $this->services as $service ) {
            if( is_numeric( $service ) ){
                 // check access
                if ( $service != -1 ){
                    if ( !in_array( 'administrator', $current_user->roles ) ) {
                        if ( !WBK_Validator::checkAccessToService( $service ) ) {
                                continue;
                        }
                    }  
                }
                $str_arr[] = 'service_id=' .$service;
            }
        }       
        $result = '(' . implode( ' OR ', $str_arr ) . ')';        
        if ( $result == '()' ){
            $result = ' id = -1 ';
        }
	  	return $result;    	
    }
}
