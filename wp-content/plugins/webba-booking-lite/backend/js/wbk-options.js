// WEBBA Booking settings page scripts
// onload function
jQuery(function ($) {
    jQuery( '#tabs' ).tabs();
   	jQuery( '#wbk_holydays' ).datepick( {multiSelect: 999, monthsToShow: 3} );
   	jQuery('#wbk_button_background').minicolors();
	jQuery('#wbk_button_color').minicolors();	 
   	jQuery( '.wbk_customer_message_btn' ).on( 'click', function() {
	    var caretPos = document.getElementById( 'wbk_email_customer_book_message' ).selectionStart;
	    var textAreaTxt = jQuery( '#wbk_email_customer_book_message' ).val();
	    var txtToAdd = '#' + jQuery(this).attr('id');
	    var newCaretPos = caretPos + txtToAdd.length;
	    jQuery( '#wbk_email_customer_book_message' ).val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos) );
	    jQuery( '#wbk_email_customer_book_message' ).focus();
	    document.getElementById( 'wbk_email_customer_book_message' ).setSelectionRange(newCaretPos, newCaretPos);
	});
   	jQuery( '.wbk_email_editor_toggle' ).on( 'click', function() {
		jQuery(this).siblings('.wbk_email_editor_wrap').toggle('fast');
	});
});

 