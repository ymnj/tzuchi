<!-- Webba Booking backend options page template --> 
<?php
    // check if accessed directly
    if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="wrap">

 	<h2 class="wbk_panel_title"><?php  echo __( 'Email templates', 'wbk' ); ?>
    <a style="text-decoration:none;" href="http://webba-booking.com/documentation/email-templates/" target="_blank"><span class="dashicons dashicons-editor-help"></span></a>

    </h2>
    <div class="notice notice-warning is-dismissible"><p>Please, note that Email notifications, PayPal and CSV export elements are for demo purpose only. To unlock notifications, payment and csv-export features, please, upgrade to Premium version. <a  rel="noopener"  href="https://codecanyon.net/item/appointment-booking-for-wordpress-webba-booking/13843131?ref=WebbaPlugins" target="_blank">Upgrade now</a>. </p>
    <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
    </div>
    
        <?php        
        	$args = array(
            	'media_buttons' => true,
            	'editor_height' => 300
            );
			echo '<div style="display:none;">';
            wp_editor( '', 'wbk-blank', $args );
            echo '</div>';
	 
            $table = new WBK_Email_Templates_Table();
            $html = $table->render();
            echo $html;
        ?>                                            
</div>

 