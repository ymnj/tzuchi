<?php

class WBK_PayPal{
	protected 
	$apiContext;
	protected
	$currency;
	protected 
	$tax;
	protected
	$fee;
	protected
	$referer;
	protected
	$experience_profile_id;
	public function init( $referer ){
	    return FALSE;
	}     
    public function createPaymentPaypal( $item_name, $price, $quantity, $sku  ){
		return FASLE;   
    }
    public function createPayment( $method, $app_id  ){       
    	return -1;     
    }
	static function	renderPaymentMethods( $service_id, $appointment_ids ){
			$service = new WBK_Service();
	        if ( !$service->setId( $service_id ) ){
	            return 'Unable to access service: wrong service id.';      
	        }
	        if ( !$service->load() ){
	            return 'Unable to access service: load failed.';      
	        }
	        if ( $service->getPayementMethods() == '' ){
	        	return '';
	        }
	        $arr_items = explode( ';', $service->getPayementMethods() );
			$html = '';
			if( in_array( 'paypal', $arr_items) ){
				$html .= '<input class="wbk-button wbk-width-100 wbk-mt-10-mb-10 wbk-payment-init" data-method="paypal" data-app-id="'. implode(',',  $appointment_ids ) . '"  value="' . get_option( 'wbk_payment_pay_with_paypal_btn_text', __( 'Pay with PayPal', 'wbk' ) ) . '  " type="button">';
			}
			return $html;
	}
}
?>