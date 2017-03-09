<?php
// Solo Framework table wbk custom field component
if ( ! defined( 'ABSPATH' ) ) exit;
class SLFTableWbkCustomField extends SLFTableComponent {
	public function __construct( $title, $name, $value, $data_source  ) {
		parent::__construct( $title, $name, $value, null );
	}
    public function renderCell(){
    	$result = array();
    	$pairs = explode('###', $this->value );
     	foreach ( $pairs as $pair ) {
     		if( $pair == '' ){
     			continue;
     		}
     		$arr_pair = explode( ':', $pair );
     		if ( count( $arr_pair ) != 2 ){
     			continue;
     		}
     		if( trim( $arr_pair[1] ) == '' ){
     			continue;
     		}
     		$result[] = $arr_pair[0] . ': ' . $arr_pair[1];    		
     	}
     	$result = implode( ', ', $result );
		return $result;
    }
    public function renderControl(){
    	$html = '<label class="slf_table_component_label" >' . $this->title . '</label>';
		$html .= '<input class="slf_table_component_input slf_table_component_custom_field" name="' . $this->name . '"   value="' . $this->value . '"  />';
		return $html;
    }
}
