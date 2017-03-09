// WEBBA Booking frontent scripts
// step count
var wbk_total_steps;
 
// onload function
jQuery(function ($) {
	if( jQuery('.wbk-payment-init').length > 0 ){
 		wbk_set_payment_events();
	}
 	if( jQuery('#wbk-cancel_booked_appointment' ).length > 0 ){
 		wbk_cancel_booked_appointment_events();
	}
 
 
	if( jQuery('#wbk-service-id').length == 0 ){
	    return;
    }
	var service_id = jQuery('#wbk-service-id').val();
	if ( wbkl10n.mode == 'extended' ){
		if ( service_id == 0 ) {
			wbk_total_steps = 4;
	 		wbk_setServiceEvent();
	 	} else {
	 		wbk_total_steps = 3;
	 		wbk_renderSetDate( false );
		}
	} else {
		if ( service_id == 0 ) {
			wbk_total_steps = 3;
	 		wbk_setServiceEvent();
	 	} else {
	 		wbk_total_steps = 2;
	 		wbk_renderSetDate( false );
		}
		jQuery('#timeselect_row').remove();
	}

});
// since 3.0.8
function wbk_cancel_booking(){
	jQuery('#wbk-slots-container, #wbk-time-container, #wbk-booking-form-container').fadeOut( 'fast', function(){
		jQuery('#wbk-time-container').html('');
		jQuery('#wbk-booking-form-container').html('');
		jQuery('#wbk-slots-container').html('');
		jQuery('#wbk-date').val(wbkl10n.selectdate);		
		jQuery('html, body').animate({
        	scrollTop: jQuery('#wbk-date-container').offset().top - 120
   		}, 1000);

	});
	jQuery('#wbk-to-checkout').fadeOut('fast'); 
}
// clear set date
function wbk_clearSetDate() {
	jQuery('#wbk-date-container').html('');
}
// clear timeslots
function wbk_clearTimeslots() {
	jQuery('#wbk-slots-container').html('');
}
// clear form
function wbk_clearForm() {
	jQuery('#wbk-booking-form-container').html('');
}
// clear results
function wbk_clearDone() {
	jQuery('#wbk-booking-done').html('');
	jQuery('#wbk-payment').html('');
}
// set service event
function wbk_setServiceEvent() {
	jQuery('#wbk-service-id').change(function() {
		wbk_clearSetDate();
		wbk_clearSetTime();
		wbk_clearForm();
		wbk_clearDone();
		wbk_clearTimeslots();
		wbk_clearForm();
		var service_id = jQuery('#wbk-service-id').val();
		if ( service_id != 0 ){
			wbk_renderSetDate( true );
		} else {
			wbk_clearSetDate();
			wbk_clearSetTime();
		}
	});
}
// clear set time
function wbk_clearSetTime() {
	jQuery('#wbk-time-container').html('');
	jQuery('#wbk-to-checkout').fadeOut( function(){
		jQuery('#wbk-to-checkout').remove();
	});
}
// render time set
function wbk_renderTimeSet() {
	var service = jQuery('#wbk-service-id').val();
	var data = {
		'action' : 'wbk-render-days',
		'step' : wbk_total_steps,
 		'service' : service
 	};
	jQuery('#wbk-time-container').html('<div class="wbk-loading"></div>');
 	jQuery.post( wbkl10n.ajaxurl, data, function(response) {
 		jQuery('#wbk-time-container').attr('style', 'display:none !important');
 		if ( response == -1 ){
			jQuery('#wbk-time-container').html('error');
 		} else {
			jQuery('#wbk-time-container').html(response);
 		}
		jQuery('#wbk-time-container').fadeIn('slow');
		jQuery('#wbk-search_time_btn').focus();
		jQuery('html, body').animate({
        	scrollTop: jQuery('#wbk-time-container').offset().top - 120
   		}, 1000);
   		jQuery( '[id^=wbk-day]' ).change(function() {
			var day = jQuery(this).attr('id');
			day = day.substring(8, day.length);
			if( jQuery(this).is(':checked') ) {
				jQuery('#wbk-time_'+day).attr("disabled", false);
 	        } else {
				jQuery('#wbk-time_'+day).attr("disabled", true);
 	        }
		});
   		jQuery('#wbk-search_time_btn').click(function() {
			 wbk_searchTime();
		});
	});
}
// render date input
function wbk_renderSetDate( scroll ) {
	jQuery('#wbk-date-container').css( 'display', 'none');
	if ( wbkl10n.mode == 'extended' ) {
		if ( wbk_total_steps  == 3 ){
			current_step = 1;
		} else {
			current_step = 2;
		}
	} else {
		if ( wbk_total_steps  == 3 ){
			current_step = 2;
		} else {
			current_step = 1;
		}
	}
	jQuery('#wbk-date-container').attr('style', 'display:none !important');
	var sep_html = '<hr class="wbk-separator"/>';
	if ( jQuery('#wbk-service-id').attr('type') == 'hidden' ){
		sep_html = '';
	}
	if ( wbkl10n.mode == 'extended' ){
		jQuery('#wbk-date-container').html( sep_html + '<div class="wbk-col-12-12"><label class="wbk-input-label">' + wbkl10n.selectdatestart + '</label><input value="' + wbkl10n.selectdate + '" type="text" class="wbk-input" id="wbk-date" /></div>');
	} else {
		jQuery('#wbk-date-container').html(  sep_html + '<div class="wbk-col-12-12"><label class="wbk-input-label">' + wbkl10n.selectdatestartbasic + '</label><input value="' + wbkl10n.selectdate + '" type="text" class="wbk-input" id="wbk-date" /></div>');
 	}
	jQuery('#wbk-date-container').fadeIn('slow');
	var selected_service_id = jQuery('#wbk-service-id').val();

 	var disability_result = [];
 
    if ( wbk_disabled_days[selected_service_id] != '' ){
		var day_disabilities_all = wbk_disabled_days[selected_service_id].split(';');
	 	var index;
		for (index = 0; index < day_disabilities_all.length; index++ ) {   	 
	    	var disablity_current_day = day_disabilities_all[index].split(',');
			disability_result.push(disablity_current_day);
		} 
    }

	var date_input = jQuery('#wbk-date').pickadate({
			min: true,
		    monthsFull: [ wbkl10n.january,
						  wbkl10n.february,
  						  wbkl10n.march,
						  wbkl10n.april,
						  wbkl10n.may,
						  wbkl10n.june,
						  wbkl10n.july,
						  wbkl10n.august,
						  wbkl10n.september,
						  wbkl10n.october,
						  wbkl10n.november,
						  wbkl10n.december
 	    				 ],
		    monthsShort: [ wbkl10n.jan,
						   wbkl10n.feb,
  						   wbkl10n.mar,
						   wbkl10n.apr,
						   wbkl10n.mays,
						   wbkl10n.jun,
						   wbkl10n.jul,
						   wbkl10n.aug,
						   wbkl10n.sep,
						   wbkl10n.oct,
						   wbkl10n.nov,
						   wbkl10n.dec
		    			 ],
		    weekdaysFull: [ wbkl10n.sunday,
						    wbkl10n.monday,
  						    wbkl10n.tuesday,
						    wbkl10n.wednesday,
						    wbkl10n.thursday,
						    wbkl10n.friday,
						    wbkl10n.saturday
  		     			  ],
		    weekdaysShort: [ wbkl10n.sun,
						     wbkl10n.mon,
  						     wbkl10n.tue,
						     wbkl10n.wed,
						     wbkl10n.thu,
						     wbkl10n.fri,
						     wbkl10n.sat
  		     			  ],
		    today:  wbkl10n.today,
		    clear:  wbkl10n.clear,
		    close:  wbkl10n.close,
		    firstDay:  wbkl10n.startofweek,
		    format: 'dd mmmm yyyy',
		    disable: disability_result,
		    labelMonthNext: wbkl10n.nextmonth,
		    labelMonthPrev: wbkl10n.prevmonth,
			formatSubmit: 'yyyy/mm/dd',
			hiddenPrefix: 'wbk-date',
			onClose: function(){
			    jQuery(document.activeElement).blur();
			},

			 
         	onSet: function( thingSet ) {
         		wbk_clearForm();
         		wbk_clearDone();
         		wbk_clearTimeslots();
         		if(typeof thingSet.select != 'undefined'){
         			if ( wbkl10n.mode == 'extended' ){
         				wbk_clearSetTime();
	   					wbk_renderTimeSet();
    				} else {
    					wbk_clearSetTime();
    					wbk_searchTime();
    				}
    			}
  			}
	});
	 

	if ( scroll == true ) {
		jQuery('html, body').animate({
	       	scrollTop: jQuery('#wbk-date-container').offset().top - 120
	   	}, 1000);
	}
}
// search time
function wbk_searchTime() {
	wbk_clearForm();
	wbk_clearDone();
	if ( wbkl10n.mode == 'extended' ) {
	    var days = jQuery( '.wbk-checkbox:checked' ).map(function() {
	    	return jQuery( this ).val();
	    }).get();
	    var times = jQuery( '.wbk-time_after:enabled' ).map(function() {
	    	return jQuery( this ).val();
	    }).get();
	    if ( days == '' ) {
	    	return;
	    }
	} else {
		days = '';
		times = '';
	}
    var service = jQuery('#wbk-service-id').val();
    var date = jQuery('[name=wbk-date_submit]').val();
    if ( date == '' ){
    	jQuery('#wbk-date').addClass('wbk-input-error');
    	return;
    }
    var offset = new Date().getTimezoneOffset();
    var data = {
		'action' : 'wbk_search_time',
		'days': days,
		'times': times,
		'service': service,
		'date': date,
 		'offset': offset
 	};
  
	jQuery('#wbk-slots-container').html('<div class="wbk-loading"></div>');
    jQuery.post( wbkl10n.ajaxurl, data, function(response) {
    	if ( response == 0 || response == -1 || response == -2 || response == -3 || response == -4 || response == -4 || response == -6 || response == -7){
     		jQuery('#wbk-slots-container').html('error');
     	} else {
    		jQuery('#wbk-slots-container').attr('style', 'display:none !important');
			jQuery('#wbk-slots-container').html( response );
			jQuery('#wbk-slots-container').fadeIn('slow');
    		jQuery('html, body').animate({ scrollTop: jQuery('#wbk-slots-container').offset().top - 120 }, 1000);
			wbk_setTimeslotEvent();
			if ( wbkl10n.mode == 'extended' ){
				jQuery('#wbk-show_more_btn').click(function() {
					jQuery('.wbk-cancel-button').fadeOut( function(){
						jQuery(this).remove();
					});
					
					wbk_showMore();
				});
			} else {
				jQuery('#wbk-service-id').focus();
			}
			jQuery('.wbk-cancel-button').click(function() {
				wbk_cancel_booking();
			});
    	}
    });
}
// search time show more callback
function wbk_showMore() {
    var days = jQuery( '.wbk-checkbox:checked' ).map(function() {
    	return jQuery( this ).val();
    }).get();
    var times = jQuery( '.wbk-time_after:enabled' ).map(function() {
    	return jQuery( this ).val();
    }).get();
    if ( days == '' ) {
    	return;
    }
    var service = jQuery('#wbk-service-id').val();
    var date = jQuery('#wbk-show-more-start').val();
    var data = {
		'action' : 'wbk_search_time',
		'days': days,
		'times': times,
		'service': service,
		'date': date
 	};
	jQuery('#wbk-show_more_container').html('<div class="wbk-loading"></div>');
   jQuery.post( wbkl10n.ajaxurl, data, function(response) {
    	if (response == 0 || response == -1){
			jQuery('#wbk-more-container').html('error');
    	} else {

      		jQuery('#wbk-show_more_container').remove();
      		jQuery('html, body').animate({ scrollTop: jQuery('.wbk-more-container').last().offset().top - 120 }, 1000);
			jQuery('.wbk-more-container').last().attr('style', 'display:none !important');
			jQuery('.wbk-more-container').last().html(response);
			jQuery('.wbk-more-container').eq(-2).fadeIn('slow');
			wbk_setTimeslotEvent();
			jQuery('.wbk-cancel-button').click(function() {
				wbk_cancel_booking();
			});
			jQuery('#wbk-show_more_btn').click(function() {
				wbk_showMore();
			});
   	}
   });
}
// set timeslot button event
function wbk_setTimeslotEvent(){
	 
	wbk_clearDone();
	jQuery('[id^=wbk-timeslot-btn_]').unbind('click');
	jQuery('[id^=wbk-timeslot-btn_]').click(function() {
	 
		// multi booking mode start
		if( wbkl10n.multi_booking == 'enabled' ){
			jQuery('#wbk-booking-form-container').fadeOut( function(){
				jQuery('#wbk-booking-form-container').html('');
			});
			jQuery(this).toggleClass('wbk-slot-active-button');
			var selected_cnt = jQuery('.wbk-slot-active-button').not('#wbk-to-checkout').length;
			 
			if( selected_cnt > 0){

				var zindex = parseInt( wbk_find_highest_zindex('div') ) + 1;
				if( jQuery('#wbk-to-checkout').length == 0) {
					jQuery( 'body' ).prepend( '<input type="button" id="wbk-to-checkout" style="display:none;" class="wbk-button wbk-slot-active-button" value="'+ wbkl10n.checkout +'" >' );
					jQuery('#wbk-to-checkout').css('z-index', zindex);
				}
				jQuery('#wbk-to-checkout').fadeIn('slow');
				jQuery('#wbk-to-checkout').unbind('click');
				jQuery('#wbk-to-checkout').click(function() {
					
					
					var times = [];
					jQuery('.wbk-slot-active-button').not('#wbk-to-checkout').each(function() {
						var btn_id = jQuery(this).attr('id');
						var time = btn_id.substring(17, btn_id.length);
						times.push(time);
					});

					var service = jQuery('#wbk-service-id').val();
					var data = {
						'action' : 'wbk_render_booking_form',
						'time': times,
						'service': service,
						'step' : wbk_total_steps 
				 	};
					jQuery.each( wbk_get_converted, function( key, value ) {
						if ( key != 'action' && key != 'time' && key != 'service' && key != 'step' ){
						 	data[key] = value;
						}
			 		}); 
			 		 
					// begin render booking form for multiple slots **********************************************************************************************
					jQuery('.wbk-cancel-button').fadeOut( function(){
						jQuery(this).remove();
										});
					wbk_clearDone();
					jQuery('#wbk-booking-form-container').html('<div class="wbk-loading"></div>');
					jQuery('html, body').animate({ scrollTop: jQuery('#wbk-booking-form-container').last().offset().top - 120 }, 1000);

					// request form rendering and binding events	**********************************************************************************************				
					jQuery.post( wbkl10n.ajaxurl, data, function(response) { 
						jQuery('#wbk-booking-form-container').attr('style', 'display:none !important');
				    	if (response == 0 || response == -1){
							jQuery('#wbk-booking-form-container').html('error');
				    	} else {
							jQuery('#wbk-booking-form-container').html(response);
							jQuery('.wbk-cancel-button').click(function() {
								wbk_cancel_booking();
							}); 
				    		if ( wbkl10n.phonemask == 'enabled' ||  wbkl10n.phonemask == 'enabled_mask_plugin' ){
				    			jQuery('[name="wbk-phone"]').mask(wbkl10n.phoneformat);
				    		}
							jQuery('.wbk-checkbox-label').not('.wbk-dayofweek-label').each(function() {
								jQuery(this).replaceWith( '<label class="wbk-checkbox-label">' + jQuery(this).html() + '</label>' );
							});
							jQuery('.wbk-checkbox-label').not('.wbk-dayofweek-label').click(function() {
			 					if ( !jQuery(this).siblings('.wbk-checkbox').prop('checked') ){
			 				 		jQuery(this).siblings('.wbk-checkbox').prop('checked',true);
			 					} else {
			 					 	jQuery(this).siblings('.wbk-checkbox').prop('checked',false);
				 				}
							});
							jQuery('#wbk-booking-form-container').fadeIn('slow');
				    		jQuery( 'input' ).focus(function() {
								jQuery( this ).removeClass('wbk-input-error');
							});
				    		// assign book click
				    		jQuery('#wbk-book_appointment').click(function() {
								var al = jQuery('[name="wbk-acceptance"]').length;
				 				if ( al == 1 ){
				 					if( !jQuery ('[name="wbk-acceptance"]').attr('checked')) {
				 						jQuery('.wbk-acceptance-error').css('display','inline');
				 						jQuery('.wbk-acceptance-error').css('color','red');
				 						return;
				 					} else {
				 						jQuery('.wbk-acceptance-error').css('display','none');
				 					}
				  				}
								var name = jQuery.trim( jQuery( '[name="wbk-name"]' ).val() );
								var email = jQuery.trim( jQuery( '[name="wbk-email"]' ).val() );
								var phone = jQuery.trim( jQuery( '[name="wbk-phone"]' ).val() );
								var desc =  jQuery.trim( jQuery( '[name="wbk-comment"]' ).val() );
								var quantity_length = jQuery( '[name="wbk-book-quantity"]' ).length;
								var quantity = -1;
								if ( quantity_length == 0 ){
									quantity = 1;
								} else {
									quantity =  jQuery.trim( jQuery( '[name="wbk-book-quantity"]' ).val() );
								}
								var error_status = 0;
								if ( !wbkCheckString( name, 3, 128 ) ){
					 				error_status = 1;
				 	 				jQuery( '[name="wbk-name"]' ).addClass('wbk-input-error');
					 			}
					 			if ( !wbkCheckEmail( email ) ){
					 				error_status = 1;
					 				jQuery( '[name="wbk-email"]' ).addClass('wbk-input-error');
					 			}
					 			if ( !wbkCheckString( phone, 3, 30 ) ){
					 				error_status = 1;
					 				jQuery( '[name="wbk-phone"]' ).addClass('wbk-input-error');
					 			}
					 			if ( !wbkCheckString( desc, 0, 255 ) ){
					 				error_status = 1;
					 				jQuery( '[name="wbk-comment"]' ).addClass('wbk-input-error');
					 			}
					 			if ( !wbkCheckIntegerMinMax( quantity, 1, 1000000 ) ){
					 				error_status = 1;
					 			}
					 			// validate custom fields (text)
								jQuery('.wbk-text[aria-required="true"]').each(function() {
								    var value =  jQuery( this ).val();
									if ( !wbkCheckString( value, 1, 128 ) ){
					 					error_status = 1;
					 					jQuery( this ).addClass('wbk-input-error');
					 				}
								});
					 			// validate custom fields (select)
								jQuery('.wbk-select[aria-required="true"]').each(function() {
								    var value =  jQuery( this ).val();
								    var first_value  = jQuery(this).find('option:eq(0)').html();
								    if ( value == first_value ){
								    	error_status = 1;
					 					jQuery( this ).addClass('wbk-input-error');
								    }
								});
					 			// validate custom fields (emails)
								jQuery('.wbk-email-custom[aria-required="true"]').each(function() {
								    var value =  jQuery( this ).val();
									if ( !wbkCheckEmail( value, 1, 128 ) ){
					 					error_status = 1;
					 					jQuery( this ).addClass('wbk-input-error');
					 				}
								});
								var extra_value = '';
								// custom fields values (text)
								jQuery('.wbk-text, .wbk-email-custom').not('#wbk-name,#wbk-email,#wbk-phone').each(function() {
									var label = jQuery('label[for="' + jQuery( this ).attr('id') + '"]').html();
									extra_value += label + ': ';
				 			 		extra_value += jQuery( this ).val() + '###';
								});
								// custom fields values (checkbox)
								jQuery('.wbk-checkbox-custom.wpcf7-checkbox').each(function() {
									var label = jQuery('label[for="' + jQuery( this ).attr('id') + '"]').html();
									extra_value += label + ': ';
									jQuery(this).children('span').each(function() {
								 		jQuery(this).children('input:checked').each(function() {
								 			extra_value += jQuery(this).val() + ' ';
										});
									});
									extra_value += '###';
								});
								// custom fields values (select)
								jQuery('.wbk-select').not('#wbk-book-quantity, #wbk-service-id').each(function() {
									// select validation (since 2.1.6)
									var label = jQuery('label[for="' + jQuery( this ).attr('id') + '"]').html();
									extra_value += label + ': ';
				 			 		extra_value += jQuery( this ).val() + '###';
								});
								// secondary names, emails
								var secondary_data = [];
								jQuery('[id^="wbk-secondary-name"]').each(function() {
									var name_p = jQuery(this).val();
									var name_id = jQuery(this).attr('id');
									if ( wbkCheckString( name, 1, 128 ) ){
										var arr = name_id.split( '_' );
										var id2 = 'wbk-secondary-email_' + arr[1];
										email_p = jQuery('#' + id2).val();

										var person = new Object();
										person.name = name_p;
										person.email = email_p;
										secondary_data.push(person);
									}
								});
					 			if ( error_status == 1 ) {
					 				jQuery('html, body').animate({ scrollTop: jQuery('#wbk-booking-form-container').last().offset().top - 120 }, 1000);
					 				return;
					 			}
					 			jQuery('#wbk-booking-done').html( '<div class="wbk-loading"></div>');
								jQuery('#wbk-booking-form-container').fadeOut('slow', function() {
				    				jQuery('#wbk-booking-form-container').html('');
				    				jQuery('#wbk-booking-form-container').fadeIn();
									jQuery('html, body').animate({
								        							scrollTop: jQuery('#wbk-booking-done').offset().top - 120
								   								}, 1000);
				  				});



							    var data = {
									'action' : 'wbk_book',
									'time': times,
									'service': service,
				 					'name': name,
				 					'email': email,
				 					'phone': phone,
				 					'desc': desc,
				 					'extra': extra_value,
				 					'quantity': quantity,
				 					'secondary_data': secondary_data
				 			 	};
				 			 	

				                 
				 			 	jQuery.post( wbkl10n.ajaxurl, data, function(response) {
				 			 		console.log(response);
									if ( response != -1 &&
				 						response != -2 &&
				 						response != -3 &&
				 						response != -4 &&
				 						response != -5 &&
				 						response != -6 &&
				 						response != -7 &&
				 						response != -8 &&
				 						response != -9 &&
				 						response != -10 &&
				 						response != -11 &&
				 						response != -12 &&
										response != -13
				 						) {


											jQuery('#wbk-booking-done').html( '<div class="wbk-details-sub-title wbk-mb-20">' + response + '</div>' );
					                        if ( wbkl10n.hide_form == 'enabled' ){                   	
						                        jQuery('#wbk-slots-container, #wbk-time-container, #wbk-date-container, #wbk-service-container' ).fadeOut( 'fast', function(){
						                        	jQuery('#wbk-slots-container, #wbk-time-container, #wbk-date-container, #wbk-service-container').html('');
						                        	jQuery('html, body').animate({
					        							scrollTop: jQuery('#wbk-booking-done').offset().top - 120
					   								}, 1000);
						                        });
					                    	} else {

					                    		jQuery('.wbk-slot-active-button').not('#wbk-to-checkout').each(function () {
						                    		var avail_container_cnt = jQuery(this).siblings('.wbk-slot-available').length;
						                    		if ( avail_container_cnt == 1 ){
						                    			// decrease available count
						                    			var current_avail = parseInt( jQuery(this).siblings('.wbk-slot-available').find('.wbk-abailable-container').html() );
						                    			current_avail = current_avail - quantity;
						                    			if( current_avail == 0 ){                   				
					                                         	if( wbkl10n.show_booked == 'disabled' ){
																	jQuery(this).parent().parent().fadeOut( 'fast', function(){
						                    							jQuery(this).parent().parent().remove();
					                                        		});
					                                         	} else{
					                                         		jQuery(this).siblings('.wbk-slot-available').find('.wbk-abailable-container').html(current_avail);
					                                         		jQuery(this).replaceWith('<input value="' + wbkl10n.booked_text +'" class="wbk-slot-button wbk-slot-booked" type="button">');
					                                         	}
						                    			} else {
															 jQuery(this).siblings('.wbk-slot-available').find('.wbk-abailable-container').html(current_avail);
						                    			}
						                    		} else {
						                    			if( wbkl10n.show_booked == 'disabled' ){
															jQuery(this).parent().fadeOut( 'fast', function(){
						                    					jQuery(this).parent().remove();
					                                        });
														} else {
															jQuery(this).replaceWith('<input value="' + wbkl10n.booked_text +'" class="wbk-slot-button wbk-slot-booked" type="button">');
					                                    }
						                    		}
						                    	});
					                    	}

											if( typeof wbk_on_booking === 'function' ) {
												 
											   wbk_on_booking( service, time, name, email, phone, desc, quantity );  
											}
											wbk_set_payment_events();

									
									} else {
										jQuery('html, body').animate({
				        							scrollTop: jQuery('#wbk-booking-done').offset().top
				   								}, 1000);
										jQuery('#wbk-booking-done').html('Something went wrong, please try again.');
									}
									jQuery('#wbk-slots-container').show('slide');
				 			 	});
							});
						};
					}); 



				});	 
			} else { 		 
				jQuery('#wbk-to-checkout').fadeOut('slow');
			}
 			return;
		}
		// multi booking mode end
		// get time from id
		jQuery('.wbk-slot-button').removeClass('wbk-slot-active-button');
		jQuery(this).addClass('wbk-slot-active-button');
		jQuery('.wbk-cancel-button').fadeOut( function(){
			jQuery(this).remove();
		});
		wbk_clearDone();
		var btn_id = jQuery(this).attr('id');
		var time = btn_id.substring(17, btn_id.length);
		var service = jQuery('#wbk-service-id').val();
		var availale_count = jQuery(this).attr('data-available');
		var max_available = 0;                   

	    var data = {
			'action' : 'wbk_render_booking_form',
			'time': time,
			'service': service,
			'step' : wbk_total_steps 
	 	};
		jQuery.each( wbk_get_converted, function( key, value ) {
			 if ( key != 'action' && key != 'time' && key != 'service' && key != 'step' ){
			 	data[key] = value;
			 }
 		});
		jQuery('#wbk-booking-form-container').html('<div class="wbk-loading"></div>');
		jQuery('html, body').animate({ scrollTop: jQuery('#wbk-booking-form-container').last().offset().top - 120 }, 1000);
	 		 	jQuery.post( wbkl10n.ajaxurl, data, function(response) {

			jQuery('#wbk-booking-form-container').attr('style', 'display:none !important');
	    	if (response == 0 || response == -1){
				jQuery('#wbk-booking-form-container').html('error');
	    	} else {
			jQuery('#wbk-booking-form-container').html(response);

			jQuery('.wbk-cancel-button').click(function() {
				wbk_cancel_booking();
			}); 
    		if ( wbkl10n.phonemask == 'enabled' ||  wbkl10n.phonemask == 'enabled_mask_plugin' ){
    			jQuery('[name="wbk-phone"]').mask(wbkl10n.phoneformat);
    		}
			jQuery('.wbk-checkbox-label').not('.wbk-dayofweek-label').each(function() {
				jQuery(this).replaceWith( '<label class="wbk-checkbox-label">' + jQuery(this).html() + '</label>' );
			});

			jQuery('.wbk-checkbox-label').not('.wbk-dayofweek-label').click(function() {
 				if ( !jQuery(this).siblings('.wbk-checkbox').prop('checked') ){
 				 	jQuery(this).siblings('.wbk-checkbox').prop('checked',true);
 				} else {
 				 	jQuery(this).siblings('.wbk-checkbox').prop('checked',false);
 				}
			});
			jQuery('#wbk-booking-form-container').fadeIn('slow');
    		jQuery( 'input' ).focus(function() {
				jQuery( this ).removeClass('wbk-input-error');
			});
			jQuery('#wbk-book_appointment').click(function() {
				var al = jQuery('[name="wbk-acceptance"]').length;
 				if ( al == 1 ){
 					if( !jQuery ('[name="wbk-acceptance"]').attr('checked')) {
 						jQuery('.wbk-acceptance-error').css('display','inline');
 						jQuery('.wbk-acceptance-error').css('color','red');
 						return;
 					} else {
 						jQuery('.wbk-acceptance-error').css('display','none');
 					}
  				}
				var name = jQuery.trim( jQuery( '[name="wbk-name"]' ).val() );
				var email = jQuery.trim( jQuery( '[name="wbk-email"]' ).val() );
				var phone = jQuery.trim( jQuery( '[name="wbk-phone"]' ).val() );
				var desc =  jQuery.trim( jQuery( '[name="wbk-comment"]' ).val() );
				var quantity_length = jQuery( '[name="wbk-book-quantity"]' ).length;
				var quantity = -1;
				if ( quantity_length == 0 ){
					quantity = 1;
				} else {
					quantity =  jQuery.trim( jQuery( '[name="wbk-book-quantity"]' ).val() );
				}
				var error_status = 0;
				if ( !wbkCheckString( name, 3, 128 ) ){
	 				error_status = 1;
 	 				jQuery( '[name="wbk-name"]' ).addClass('wbk-input-error');
	 			}
	 			if ( !wbkCheckEmail( email ) ){
	 				error_status = 1;
	 				jQuery( '[name="wbk-email"]' ).addClass('wbk-input-error');
	 			}
	 			if ( !wbkCheckString( phone, 3, 30 ) ){
	 				error_status = 1;
	 				jQuery( '[name="wbk-phone"]' ).addClass('wbk-input-error');
	 			}
	 			if ( !wbkCheckString( desc, 0, 255 ) ){
	 				error_status = 1;
	 				jQuery( '[name="wbk-comment"]' ).addClass('wbk-input-error');
	 			}
	 			if ( !wbkCheckIntegerMinMax( quantity, 1, 1000000 ) ){
	 				error_status = 1;
	 			}
	 			// validate custom fields (text)
				jQuery('.wbk-text[aria-required="true"]').each(function() {
				    var value =  jQuery( this ).val();
					if ( !wbkCheckString( value, 1, 128 ) ){
	 					error_status = 1;
	 					jQuery( this ).addClass('wbk-input-error');
	 				}
				});
	 			// validate custom fields (select)
				jQuery('.wbk-select[aria-required="true"]').each(function() {
				    var value =  jQuery( this ).val();
				    var first_value  = jQuery(this).find('option:eq(0)').html();
				    if ( value == first_value ){
				    	error_status = 1;
	 					jQuery( this ).addClass('wbk-input-error');
				    }
				});
	 			// validate custom fields (emails)
				jQuery('.wbk-email-custom[aria-required="true"]').each(function() {
				    var value =  jQuery( this ).val();
					if ( !wbkCheckEmail( value, 1, 128 ) ){
	 					error_status = 1;
	 					jQuery( this ).addClass('wbk-input-error');
	 				}
				});


				var extra_value = '';
				// custom fields values (text)
				jQuery('.wbk-text, .wbk-email-custom').not('#wbk-name,#wbk-email,#wbk-phone').each(function() {
					var label = jQuery('label[for="' + jQuery( this ).attr('id') + '"]').html();
					extra_value += label + ': ';
 			 		extra_value += jQuery( this ).val() + '###';
				});
				// custom fields values (checkbox)
				jQuery('.wbk-checkbox-custom.wpcf7-checkbox').each(function() {
					var label = jQuery('label[for="' + jQuery( this ).attr('id') + '"]').html();
					extra_value += label + ': ';
					jQuery(this).children('span').each(function() {
				 		jQuery(this).children('input:checked').each(function() {
				 			extra_value += jQuery(this).val() + ' ';
						});
					});
					extra_value += '###';
				});
				// custom fields values (select)
				jQuery('.wbk-select').not('#wbk-book-quantity, #wbk-service-id').each(function() {
					// select validation (since 2.1.6)
					var label = jQuery('label[for="' + jQuery( this ).attr('id') + '"]').html();
					extra_value += label + ': ';
 			 		extra_value += jQuery( this ).val() + '###';
				});

				// secondary names, emails
				var secondary_data = [];
				jQuery('[id^="wbk-secondary-name"]').each(function() {
					var name_p = jQuery(this).val();
					var name_id = jQuery(this).attr('id');
					if ( wbkCheckString( name, 1, 128 ) ){
						var arr = name_id.split( '_' );
						var id2 = 'wbk-secondary-email_' + arr[1];
						email_p = jQuery('#' + id2).val();

						var person = new Object();
						person.name = name_p;
						person.email = email_p;
						secondary_data.push(person);
					}
				});

	 			if ( error_status == 1 ) {
	 				jQuery('html, body').animate({ scrollTop: jQuery('#wbk-booking-form-container').last().offset().top - 120 }, 1000);
	 				return;
	 			}
	 			jQuery('#wbk-booking-done').html( '<div class="wbk-loading"></div>');
				jQuery('#wbk-booking-form-container').fadeOut('slow', function() {
    				jQuery('#wbk-booking-form-container').html('');
    				jQuery('#wbk-booking-form-container').fadeIn();
					jQuery('html, body').animate({
				        							scrollTop: jQuery('#wbk-booking-done').offset().top - 120
				   								}, 1000);
  				});


			    var data = {
					'action' : 'wbk_book',
					'time': time,
					'service': service,
 					'name': name,
 					'email': email,
 					'phone': phone,
 					'desc': desc,
 					'extra': extra_value,
 					'quantity': quantity,
 					'secondary_data': secondary_data
 			 	};
                 
 			 	jQuery.post( wbkl10n.ajaxurl, data, function(response) {
					if ( response != -1 &&
 						response != -2 &&
 						response != -3 &&
 						response != -4 &&
 						response != -5 &&
 						response != -6 &&
 						response != -7 &&
 						response != -8 &&
 						response != -9 &&
 						response != -10 &&
 						response != -11 &&
 						response != -12 &&
						response != -13
 						) {
							jQuery('#wbk-booking-done').html( '<div class="wbk-details-sub-title wbk-mb-20">' + response + '</div>' );
	                        if ( wbkl10n.hide_form == 'enabled' ){                   	
		                        jQuery('#wbk-slots-container, #wbk-time-container, #wbk-date-container, #wbk-service-container' ).fadeOut( 'fast', function(){
		                        	jQuery('#wbk-slots-container, #wbk-time-container, #wbk-date-container, #wbk-service-container').html('');
		                        	jQuery('html, body').animate({
	        							scrollTop: jQuery('#wbk-booking-done').offset().top - 120
	   								}, 1000);
		                        });
	                    	} else {
	                    		var avail_container_cnt = jQuery('.wbk-slot-active-button').siblings('.wbk-slot-available').length;
	                    		if ( avail_container_cnt == 1 ){
	                    			// decrease available count
	                    			var current_avail = parseInt( jQuery('.wbk-slot-active-button').siblings('.wbk-slot-available').find('.wbk-abailable-container').html() );
	                    			 
	                    			current_avail = current_avail - quantity;
	                    			 
	                    			if( current_avail == 0 ){       

                                         	if( wbkl10n.show_booked == 'disabled' ){
												jQuery('.wbk-slot-active-button').parent().fadeOut( 'fast', function(){
	                    							jQuery('.wbk-slot-active-button').parent().remove();
                                        		});
                                         	} else{
                                         		jQuery('.wbk-slot-active-button').siblings('.wbk-slot-available').find('.wbk-abailable-container').html(current_avail);
                                         		jQuery('.wbk-slot-active-button').replaceWith('<input value="' + wbkl10n.booked_text +'" class="wbk-slot-button wbk-slobooked" type="button">');												
                                         	}
	                    			} else {
										jQuery('.wbk-slot-active-button').siblings('.wbk-slot-available').find('.wbk-abailable-container').html(current_avail);
	                    			}
	                    		} else {
	                    			if( wbkl10n.show_booked == 'disabled' ){
										jQuery('.wbk-slot-active-button').parent().fadeOut( 'fast', function(){
	                    					jQuery('.wbk-slot-active-button').parent().remove();
                                        });
									} else {
										jQuery('.wbk-slot-active-button').replaceWith('<input value="' + wbkl10n.booked_text +'" class="wbk-slot-button wbk-slot-booked" type="button">');
                                    }
	                    		}

	                    	}
							if( typeof wbk_on_booking === 'function' ) {
							
							   wbk_on_booking( service, time, name, email, phone, desc, quantity );  
							}
							wbk_set_payment_events();

					
					} else {
						jQuery('html, body').animate({
        							scrollTop: jQuery('#wbk-booking-done').offset().top
   								}, 1000);
						jQuery('#wbk-booking-done').html('Something went wrong, please try again.');
					}
					jQuery('#wbk-slots-container').show('slide');
 			 	});
			});
    	}
    });

	});
}
function wbk_cancel_booked_appointment_events(){
	jQuery('#wbk-cancel_booked_appointment').click(function() {
		var app_token = jQuery(this).attr('data-appointment');
		var email = jQuery.trim( jQuery( '#wbk-customer_email' ).val() );
		jQuery( '#wbk-customer_email' ).val(email); 
		if ( !wbkCheckEmail( email ) ){
			jQuery( '#wbk-customer_email' ).addClass('wbk-input-error');
	 	} else {
		    var data = {
				'action' : 'wbk_cancel_appointment',
				'app_token':  app_token,
				'email': email
		 	};
		 	jQuery('#wbk-cancel-result').html('<div class="wbk-loading"></div>');
			jQuery('#wbk-cancel_booked_appointment')
			jQuery('#wbk-cancel_booked_appointment').prop('disabled', true);
		 	jQuery.post( wbkl10n.ajaxurl, data, function(response) {
		 		response = jQuery.parseJSON( response );
		 		jQuery('#wbk-cancel-result').html( response.message );
			  	if( response.status == 0 ){
			  		jQuery('#wbk-cancel_booked_appointment').prop('disabled', false );
			  	}
			  	 
		 	});

	 	}
	});
}
function wbk_set_payment_events(){
	jQuery('.wbk-payment-init').click(function() {
	    jQuery('#wbk-payment').html('<div class="wbk-loading"></div>');
		jQuery('html, body').animate({ scrollTop: jQuery('#wbk-payment').last().offset().top - 120 }, 1000);
		 

	    var data = {
			'action' : 'wbk_prepare_payment',
			'app_id': jQuery(this).attr('data-app-id'),
			'method': jQuery(this).attr('data-method')
	 	};
	 	jQuery.post( wbkl10n.ajaxurl, data, function(response) {
            jQuery('#wbk-payment').fadeOut('fast', function(){
				jQuery('#wbk-payment').html(response);
				jQuery('#wbk-payment').fadeIn('slow');		
				jQuery( '.wbk-approval-link' ).click(function() {
					window.location.href = jQuery(this).attr('data-link');
				});
            });		
	 	});
	});
}
function wbk_find_highest_zindex(elem){
  var elems = document.getElementsByTagName(elem);
  var highest = 0;
  for (var i = 0; i < elems.length; i++)
  {
    var zindex=document.defaultView.getComputedStyle(elems[i],null).getPropertyValue("z-index");
    if ((zindex > highest) && (zindex != 'auto'))
    {
      highest = zindex;
    }
  }
  return highest;
}