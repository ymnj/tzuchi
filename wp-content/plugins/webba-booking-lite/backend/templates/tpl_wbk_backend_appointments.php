<!-- Webba Booking backend options page template --> 
<?php
    // check if accessed directly
    if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="wrap">
 	<h2 class="wbk_panel_title"><?php  echo __( 'Appointments', 'wbk' ); ?>
    <a style="text-decoration:none;" href="http://webba-booking.com/documentation/working-with-appointments" target="_blank"><span class="dashicons dashicons-editor-help"></span></a>
    </h2>
    <div class="notice notice-warning is-dismissible"><p>Please, note that Email notifications, PayPal and CSV export elements are for demo purpose only. To unlock notifications, payment and csv-export features, please, upgrade to Premium version. <a rel="noopener" href="https://codecanyon.net/item/appointment-booking-for-wordpress-webba-booking/13843131?ref=WebbaPlugins" target="_blank">Upgrade now</a>. </p>
    <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
    </div>

        <?php        
            $table = new WBK_Appointments_Table();
            $html = $table->render();
            echo $html;
        ?>                                            
</div>
