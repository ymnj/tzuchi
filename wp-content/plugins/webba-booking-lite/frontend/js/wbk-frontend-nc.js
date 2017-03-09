// WEBBA Booking frontent scripts
// step count
var wbk_total_steps;
var wbkjQ = jQuery.noConflict();
 
// onload function
wbkjQ(function ($) {
	if( wbkjQ('.wbk-payment-init').length > 0 ){
 		wbk_set_payment_events();
	}
 	if( wbkjQ('#wbk-cancel_booked_appointment' ).length > 0 ){
 		wbk_cancel_booked_appointment_events();
	}
 
 
	if( wbkjQ('#wbk-service-id').length == 0 ){
	    return;
    }
	var service_id = wbkjQ('#wbk-service-id').val();
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
		wbkjQ('#timeselect_row').remove();
	}

});
// since 3.0.8
function wbk_cancel_booking(){
	wbkjQ('#wbk-slots-container, #wbk-time-container, #wbk-booking-form-container').fadeOut( 'fast', function(){
		wbkjQ('#wbk-time-container').html('');
		wbkjQ('#wbk-booking-form-container').html('');
		wbkjQ('#wbk-slots-container').html('');
		wbkjQ('#wbk-date').val(wbkl10n.selectdate);		
		wbkjQ('html, body').animate({
        	scrollTop: wbkjQ('#wbk-date-container').offset().top - 120
   		}, 1000);

	});
	wbkjQ('#wbk-to-checkout').fadeOut('fast'); 
}
// clear set date
function wbk_clearSetDate() {
	wbkjQ('#wbk-date-container').html('');
}
// clear timeslots
function wbk_clearTimeslots() {
	wbkjQ('#wbk-slots-container').html('');
}
// clear form
function wbk_clearForm() {
	wbkjQ('#wbk-booking-form-container').html('');
}
// clear results
function wbk_clearDone() {
	wbkjQ('#wbk-booking-done').html('');
	wbkjQ('#wbk-payment').html('');
}
// set service event
function wbk_setServiceEvent() {
	wbkjQ('#wbk-service-id').change(function() {
		wbk_clearSetDate();
		wbk_clearSetTime();
		wbk_clearForm();
		wbk_clearDone();
		wbk_clearTimeslots();
		wbk_clearForm();
		var service_id = wbkjQ('#wbk-service-id').val();
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
	wbkjQ('#wbk-time-container').html('');
	wbkjQ('#wbk-to-checkout').fadeOut( function(){
		wbkjQ('#wbk-to-checkout').remove();
	});
}
// render time set
function wbk_renderTimeSet() {
	var service = wbkjQ('#wbk-service-id').val();
	var data = {
		'action' : 'wbk-render-days',
		'step' : wbk_total_steps,
 		'service' : service
 	};
	wbkjQ('#wbk-time-container').html('<div class="wbk-loading"></div>');
 	wbkjQ.post( wbkl10n.ajaxurl, data, function(response) {
 		wbkjQ('#wbk-time-container').attr('style', 'display:none !important');
 		if ( response == -1 ){
			wbkjQ('#wbk-time-container').html('error');
 		} else {
			wbkjQ('#wbk-time-container').html(response);
 		}
		wbkjQ('#wbk-time-container').fadeIn('slow');
		wbkjQ('#wbk-search_time_btn').focus();
		wbkjQ('html, body').animate({
        	scrollTop: wbkjQ('#wbk-time-container').offset().top - 120
   		}, 1000);
   		wbkjQ( '[id^=wbk-day]' ).change(function() {
			var day = wbkjQ(this).attr('id');
			day = day.substring(8, day.length);
			if( wbkjQ(this).is(':checked') ) {
				wbkjQ('#wbk-time_'+day).attr("disabled", false);
 	        } else {
				wbkjQ('#wbk-time_'+day).attr("disabled", true);
 	        }
		});
   		wbkjQ('#wbk-search_time_btn').click(function() {
			 wbk_searchTime();
		});
	});
}
// render date input
function wbk_renderSetDate( scroll ) {
	wbkjQ('#wbk-date-container').css( 'display', 'none');
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
	wbkjQ('#wbk-date-container').attr('style', 'display:none !important');
	var sep_html = '<hr class="wbk-separator"/>';
	if ( wbkjQ('#wbk-service-id').attr('type') == 'hidden' ){
		sep_html = '';
	}
	if ( wbkl10n.mode == 'extended' ){
		wbkjQ('#wbk-date-container').html( sep_html + '<div class="wbk-col-12-12"><label class="wbk-input-label">' + wbkl10n.selectdatestart + '</label><input value="' + wbkl10n.selectdate + '" type="text" class="wbk-input" id="wbk-date" /></div>');
	} else {
		wbkjQ('#wbk-date-container').html(  sep_html + '<div class="wbk-col-12-12"><label class="wbk-input-label">' + wbkl10n.selectdatestartbasic + '</label><input value="' + wbkl10n.selectdate + '" type="text" class="wbk-input" id="wbk-date" /></div>');
 	}
	wbkjQ('#wbk-date-container').fadeIn('slow');
	var selected_service_id = wbkjQ('#wbk-service-id').val();

 	var disability_result = [];
 
    if ( wbk_disabled_days[selected_service_id] != '' ){
		var day_disabilities_all = wbk_disabled_days[selected_service_id].split(';');
	 	var index;
		for (index = 0; index < day_disabilities_all.length; index++ ) {   	 
	    	var disablity_current_day = day_disabilities_all[index].split(',');
			disability_result.push(disablity_current_day);
		} 
    }

	var date_input = wbkjQ('#wbk-date').pickadate({
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
			    wbkjQ(document.activeElement).blur();
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
		wbkjQ('html, body').animate({
	       	scrollTop: wbkjQ('#wbk-date-container').offset().top - 120
	   	}, 1000);
	}
}
// search time
function wbk_searchTime() {
	wbk_clearForm();
	wbk_clearDone();
	if ( wbkl10n.mode == 'extended' ) {
	    var days = wbkjQ( '.wbk-checkbox:checked' ).map(function() {
	    	return wbkjQ( this ).val();
	    }).get();
	    var times = wbkjQ( '.wbk-time_after:enabled' ).map(function() {
	    	return wbkjQ( this ).val();
	    }).get();
	    if ( days == '' ) {
	    	return;
	    }
	} else {
		days = '';
		times = '';
	}
    var service = wbkjQ('#wbk-service-id').val();
    var date = wbkjQ('[name=wbk-date_submit]').val();
    if ( date == '' ){
    	wbkjQ('#wbk-date').addClass('wbk-input-error');
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
  
	wbkjQ('#wbk-slots-container').html('<div class="wbk-loading"></div>');
    wbkjQ.post( wbkl10n.ajaxurl, data, function(response) {
    	if ( response == 0 || response == -1 || response == -2 || response == -3 || response == -4 || response == -4 || response == -6 || response == -7){
     		wbkjQ('#wbk-slots-container').html('error');
     	} else {
    		wbkjQ('#wbk-slots-container').attr('style', 'display:none !important');
			wbkjQ('#wbk-slots-container').html( response );
			wbkjQ('#wbk-slots-container').fadeIn('slow');
    		wbkjQ('html, body').animate({ scrollTop: wbkjQ('#wbk-slots-container').offset().top - 120 }, 1000);
			wbk_setTimeslotEvent();
			if ( wbkl10n.mode == 'extended' ){
				wbkjQ('#wbk-show_more_btn').click(function() {
					wbkjQ('.wbk-cancel-button').fadeOut( function(){
						wbkjQ(this).remove();
					});
					
					wbk_showMore();
				});
			} else {
				wbkjQ('#wbk-service-id').focus();
			}
			wbkjQ('.wbk-cancel-button').click(function() {
				wbk_cancel_booking();
			});
    	}
    });
}
// search time show more callback
function wbk_showMore() {
    var days = wbkjQ( '.wbk-checkbox:checked' ).map(function() {
    	return wbkjQ( this ).val();
    }).get();
    var times = wbkjQ( '.wbk-time_after:enabled' ).map(function() {
    	return wbkjQ( this ).val();
    }).get();
    if ( days == '' ) {
    	return;
    }
    var service = wbkjQ('#wbk-service-id').val();
    var date = wbkjQ('#wbk-show-more-start').val();
    var data = {
		'action' : 'wbk_search_time',
		'days': days,
		'times': times,
		'service': service,
		'date': date
 	};
	wbkjQ('#wbk-show_more_container').html('<div class="wbk-loading"></div>');
   wbkjQ.post( wbkl10n.ajaxurl, data, function(response) {
    	if (response == 0 || response == -1){
			wbkjQ('#wbk-more-container').html('error');
    	} else {

      		wbkjQ('#wbk-show_more_container').remove();
      		wbkjQ('html, body').animate({ scrollTop: wbkjQ('.wbk-more-container').last().offset().top - 120 }, 1000);
			wbkjQ('.wbk-more-container').last().attr('style', 'display:none !important');
			wbkjQ('.wbk-more-container').last().html(response);
			wbkjQ('.wbk-more-container').eq(-2).fadeIn('slow');
			wbk_setTimeslotEvent();
			wbkjQ('.wbk-cancel-button').click(function() {
				wbk_cancel_booking();
			});
			wbkjQ('#wbk-show_more_btn').click(function() {
				wbk_showMore();
			});
   	}
   });
}
// set timeslot button event
function wbk_setTimeslotEvent(){
	 
	wbk_clearDone();
	wbkjQ('[id^=wbk-timeslot-btn_]').unbind('click');
	wbkjQ('[id^=wbk-timeslot-btn_]').click(function() {
	 
		// multi booking mode start
		if( wbkl10n.multi_booking == 'enabled' ){
			wbkjQ('#wbk-booking-form-container').fadeOut( function(){
				wbkjQ('#wbk-booking-form-container').html('');
			});
			wbkjQ(this).toggleClass('wbk-slot-active-button');
			var selected_cnt = wbkjQ('.wbk-slot-active-button').not('#wbk-to-checkout').length;
			 
			if( selected_cnt > 0){

				var zindex = parseInt( wbk_find_highest_zindex('div') ) + 1;
				if( wbkjQ('#wbk-to-checkout').length == 0) {
					wbkjQ( 'body' ).prepend( '<input type="button" id="wbk-to-checkout" style="display:none;" class="wbk-button wbk-slot-active-button" value="'+ wbkl10n.checkout +'" >' );
					wbkjQ('#wbk-to-checkout').css('z-index', zindex);
				}
				wbkjQ('#wbk-to-checkout').fadeIn('slow');
				wbkjQ('#wbk-to-checkout').unbind('click');
				wbkjQ('#wbk-to-checkout').click(function() {
					
					
					var times = [];
					wbkjQ('.wbk-slot-active-button').not('#wbk-to-checkout').each(function() {
						var btn_id = wbkjQ(this).attr('id');
						var time = btn_id.substring(17, btn_id.length);
						times.push(time);
					});

					var service = wbkjQ('#wbk-service-id').val();
					var data = {
						'action' : 'wbk_render_booking_form',
						'time': times,
						'service': service,
						'step' : wbk_total_steps 
				 	};
					wbkjQ.each( wbk_get_converted, function( key, value ) {
						if ( key != 'action' && key != 'time' && key != 'service' && key != 'step' ){
						 	data[key] = value;
						}
			 		}); 
			 		 
					// begin render booking form for multiple slots **********************************************************************************************
					wbkjQ('.wbk-cancel-button').fadeOut( function(){
						wbkjQ(this).remove();
										});
					wbk_clearDone();
					wbkjQ('#wbk-booking-form-container').html('<div class="wbk-loading"></div>');
					wbkjQ('html, body').animate({ scrollTop: wbkjQ('#wbk-booking-form-container').last().offset().top - 120 }, 1000);

					// request form rendering and binding events	**********************************************************************************************				
					wbkjQ.post( wbkl10n.ajaxurl, data, function(response) { 
						wbkjQ('#wbk-booking-form-container').attr('style', 'display:none !important');
				    	if (response == 0 || response == -1){
							wbkjQ('#wbk-booking-form-container').html('error');
				    	} else {
							wbkjQ('#wbk-booking-form-container').html(response);
							wbkjQ('.wbk-cancel-button').click(function() {
								wbk_cancel_booking();
							}); 
				    		if ( wbkl10n.phonemask == 'enabled' ||  wbkl10n.phonemask == 'enabled_mask_plugin' ){
				    			wbkjQ('[name="wbk-phone"]').mask(wbkl10n.phoneformat);
				    		}
							wbkjQ('.wbk-checkbox-label').not('.wbk-dayofweek-label').each(function() {
								wbkjQ(this).replaceWith( '<label class="wbk-checkbox-label">' + wbkjQ(this).html() + '</label>' );
							});
							wbkjQ('.wbk-checkbox-label').not('.wbk-dayofweek-label').click(function() {
			 					if ( !wbkjQ(this).siblings('.wbk-checkbox').prop('checked') ){
			 				 		wbkjQ(this).siblings('.wbk-checkbox').prop('checked',true);
			 					} else {
			 					 	wbkjQ(this).siblings('.wbk-checkbox').prop('checked',false);
				 				}
							});
							wbkjQ('#wbk-booking-form-container').fadeIn('slow');
				    		wbkjQ( 'input' ).focus(function() {
								wbkjQ( this ).removeClass('wbk-input-error');
							});
				    		// assign book click
				    		wbkjQ('#wbk-book_appointment').click(function() {
								var al = wbkjQ('[name="wbk-acceptance"]').length;
				 				if ( al == 1 ){
				 					if( !wbkjQ ('[name="wbk-acceptance"]').attr('checked')) {
				 						wbkjQ('.wbk-acceptance-error').css('display','inline');
				 						wbkjQ('.wbk-acceptance-error').css('color','red');
				 						return;
				 					} else {
				 						wbkjQ('.wbk-acceptance-error').css('display','none');
				 					}
				  				}
								var name = wbkjQ.trim( wbkjQ( '[name="wbk-name"]' ).val() );
								var email = wbkjQ.trim( wbkjQ( '[name="wbk-email"]' ).val() );
								var phone = wbkjQ.trim( wbkjQ( '[name="wbk-phone"]' ).val() );
								var desc =  wbkjQ.trim( wbkjQ( '[name="wbk-comment"]' ).val() );
								var quantity_length = wbkjQ( '[name="wbk-book-quantity"]' ).length;
								var quantity = -1;
								if ( quantity_length == 0 ){
									quantity = 1;
								} else {
									quantity =  wbkjQ.trim( wbkjQ( '[name="wbk-book-quantity"]' ).val() );
								}
								var error_status = 0;
								if ( !wbkCheckString( name, 3, 128 ) ){
					 				error_status = 1;
				 	 				wbkjQ( '[name="wbk-name"]' ).addClass('wbk-input-error');
					 			}
					 			if ( !wbkCheckEmail( email ) ){
					 				error_status = 1;
					 				wbkjQ( '[name="wbk-email"]' ).addClass('wbk-input-error');
					 			}
					 			if ( !wbkCheckString( phone, 3, 30 ) ){
					 				error_status = 1;
					 				wbkjQ( '[name="wbk-phone"]' ).addClass('wbk-input-error');
					 			}
					 			if ( !wbkCheckString( desc, 0, 255 ) ){
					 				error_status = 1;
					 				wbkjQ( '[name="wbk-comment"]' ).addClass('wbk-input-error');
					 			}
					 			if ( !wbkCheckIntegerMinMax( quantity, 1, 1000000 ) ){
					 				error_status = 1;
					 			}
					 			// validate custom fields (text)
								wbkjQ('.wbk-text[aria-required="true"]').each(function() {
								    var value =  wbkjQ( this ).val();
									if ( !wbkCheckString( value, 1, 128 ) ){
					 					error_status = 1;
					 					wbkjQ( this ).addClass('wbk-input-error');
					 				}
								});
					 			// validate custom fields (select)
								wbkjQ('.wbk-select[aria-required="true"]').each(function() {
								    var value =  wbkjQ( this ).val();
								    var first_value  = wbkjQ(this).find('option:eq(0)').html();
								    if ( value == first_value ){
								    	error_status = 1;
					 					wbkjQ( this ).addClass('wbk-input-error');
								    }
								});
					 			// validate custom fields (emails)
								wbkjQ('.wbk-email-custom[aria-required="true"]').each(function() {
								    var value =  wbkjQ( this ).val();
									if ( !wbkCheckEmail( value, 1, 128 ) ){
					 					error_status = 1;
					 					wbkjQ( this ).addClass('wbk-input-error');
					 				}
								});
								var extra_value = '';
								// custom fields values (text)
								wbkjQ('.wbk-text, .wbk-email-custom').not('#wbk-name,#wbk-email,#wbk-phone').each(function() {
									var label = wbkjQ('label[for="' + wbkjQ( this ).attr('id') + '"]').html();
									extra_value += label + ': ';
				 			 		extra_value += wbkjQ( this ).val() + '###';
								});
								// custom fields values (checkbox)
								wbkjQ('.wbk-checkbox-custom.wpcf7-checkbox').each(function() {
									var label = wbkjQ('label[for="' + wbkjQ( this ).attr('id') + '"]').html();
									extra_value += label + ': ';
									wbkjQ(this).children('span').each(function() {
								 		wbkjQ(this).children('input:checked').each(function() {
								 			extra_value += wbkjQ(this).val() + ' ';
										});
									});
									extra_value += '###';
								});
								// custom fields values (select)
								wbkjQ('.wbk-select').not('#wbk-book-quantity, #wbk-service-id').each(function() {
									// select validation (since 2.1.6)
									var label = wbkjQ('label[for="' + wbkjQ( this ).attr('id') + '"]').html();
									extra_value += label + ': ';
				 			 		extra_value += wbkjQ( this ).val() + '###';
								});
								// secondary names, emails
								var secondary_data = [];
								wbkjQ('[id^="wbk-secondary-name"]').each(function() {
									var name_p = wbkjQ(this).val();
									var name_id = wbkjQ(this).attr('id');
									if ( wbkCheckString( name, 1, 128 ) ){
										var arr = name_id.split( '_' );
										var id2 = 'wbk-secondary-email_' + arr[1];
										email_p = wbkjQ('#' + id2).val();

										var person = new Object();
										person.name = name_p;
										person.email = email_p;
										secondary_data.push(person);
									}
								});
					 			if ( error_status == 1 ) {
					 				wbkjQ('html, body').animate({ scrollTop: wbkjQ('#wbk-booking-form-container').last().offset().top - 120 }, 1000);
					 				return;
					 			}
					 			wbkjQ('#wbk-booking-done').html( '<div class="wbk-loading"></div>');
								wbkjQ('#wbk-booking-form-container').fadeOut('slow', function() {
				    				wbkjQ('#wbk-booking-form-container').html('');
				    				wbkjQ('#wbk-booking-form-container').fadeIn();
									wbkjQ('html, body').animate({
								        							scrollTop: wbkjQ('#wbk-booking-done').offset().top - 120
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
				 			 	

				                 
				 			 	wbkjQ.post( wbkl10n.ajaxurl, data, function(response) {
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


											wbkjQ('#wbk-booking-done').html( '<div class="wbk-details-sub-title wbk-mb-20">' + response + '</div>' );
					                        if ( wbkl10n.hide_form == 'enabled' ){                   	
						                        wbkjQ('#wbk-slots-container, #wbk-time-container, #wbk-date-container, #wbk-service-container' ).fadeOut( 'fast', function(){
						                        	wbkjQ('#wbk-slots-container, #wbk-time-container, #wbk-date-container, #wbk-service-container').html('');
						                        	wbkjQ('html, body').animate({
					        							scrollTop: wbkjQ('#wbk-booking-done').offset().top - 120
					   								}, 1000);
						                        });
					                    	} else {

					                    		wbkjQ('.wbk-slot-active-button').not('#wbk-to-checkout').each(function () {
						                    		var avail_container_cnt = wbkjQ(this).siblings('.wbk-slot-available').length;
						                    		if ( avail_container_cnt == 1 ){
						                    			// decrease available count
						                    			var current_avail = parseInt( wbkjQ(this).siblings('.wbk-slot-available').find('.wbk-abailable-container').html() );
						                    			current_avail = current_avail - quantity;
						                    			if( current_avail == 0 ){                   				
					                                         	if( wbkl10n.show_booked == 'disabled' ){
																	wbkjQ(this).parent().parent().fadeOut( 'fast', function(){
						                    							wbkjQ(this).parent().parent().remove();
					                                        		});
					                                         	} else{
					                                         		wbkjQ(this).siblings('.wbk-slot-available').find('.wbk-abailable-container').html(current_avail);
					                                         		wbkjQ(this).replaceWith('<input value="' + wbkl10n.booked_text +'" class="wbk-slot-button wbk-slot-booked" type="button">');
					                                         	}
						                    			} else {
															 wbkjQ(this).siblings('.wbk-slot-available').find('.wbk-abailable-container').html(current_avail);
						                    			}
						                    		} else {
						                    			if( wbkl10n.show_booked == 'disabled' ){
															wbkjQ(this).parent().fadeOut( 'fast', function(){
						                    					wbkjQ(this).parent().remove();
					                                        });
														} else {
															wbkjQ(this).replaceWith('<input value="' + wbkl10n.booked_text +'" class="wbk-slot-button wbk-slot-booked" type="button">');
					                                    }
						                    		}
						                    	});
					                    	}

											if( typeof wbk_on_booking === 'function' ) {
												 
											   wbk_on_booking( service, time, name, email, phone, desc, quantity );  
											}
											wbk_set_payment_events();

									
									} else {
										wbkjQ('html, body').animate({
				        							scrollTop: wbkjQ('#wbk-booking-done').offset().top
				   								}, 1000);
										wbkjQ('#wbk-booking-done').html('Something went wrong, please try again.');
									}
									wbkjQ('#wbk-slots-container').show('slide');
				 			 	});
							});
						};
					}); 



				});	 
			} else { 		 
				wbkjQ('#wbk-to-checkout').fadeOut('slow');
			}
 			return;
		}
		// multi booking mode end
		// get time from id
		wbkjQ('.wbk-slot-button').removeClass('wbk-slot-active-button');
		wbkjQ(this).addClass('wbk-slot-active-button');
		wbkjQ('.wbk-cancel-button').fadeOut( function(){
			wbkjQ(this).remove();
		});
		wbk_clearDone();
		var btn_id = wbkjQ(this).attr('id');
		var time = btn_id.substring(17, btn_id.length);
		var service = wbkjQ('#wbk-service-id').val();
		var availale_count = wbkjQ(this).attr('data-available');
		var max_available = 0;                   

	    var data = {
			'action' : 'wbk_render_booking_form',
			'time': time,
			'service': service,
			'step' : wbk_total_steps 
	 	};
		wbkjQ.each( wbk_get_converted, function( key, value ) {
			 if ( key != 'action' && key != 'time' && key != 'service' && key != 'step' ){
			 	data[key] = value;
			 }
 		});
		wbkjQ('#wbk-booking-form-container').html('<div class="wbk-loading"></div>');
		wbkjQ('html, body').animate({ scrollTop: wbkjQ('#wbk-booking-form-container').last().offset().top - 120 }, 1000);
	 		 	wbkjQ.post( wbkl10n.ajaxurl, data, function(response) {

			wbkjQ('#wbk-booking-form-container').attr('style', 'display:none !important');
	    	if (response == 0 || response == -1){
				wbkjQ('#wbk-booking-form-container').html('error');
	    	} else {
			wbkjQ('#wbk-booking-form-container').html(response);

			wbkjQ('.wbk-cancel-button').click(function() {
				wbk_cancel_booking();
			}); 
    		if ( wbkl10n.phonemask == 'enabled' ||  wbkl10n.phonemask == 'enabled_mask_plugin' ){
    			wbkjQ('[name="wbk-phone"]').mask(wbkl10n.phoneformat);
    		}
			wbkjQ('.wbk-checkbox-label').not('.wbk-dayofweek-label').each(function() {
				wbkjQ(this).replaceWith( '<label class="wbk-checkbox-label">' + wbkjQ(this).html() + '</label>' );
			});

			wbkjQ('.wbk-checkbox-label').not('.wbk-dayofweek-label').click(function() {
 				if ( !wbkjQ(this).siblings('.wbk-checkbox').prop('checked') ){
 				 	wbkjQ(this).siblings('.wbk-checkbox').prop('checked',true);
 				} else {
 				 	wbkjQ(this).siblings('.wbk-checkbox').prop('checked',false);
 				}
			});
			wbkjQ('#wbk-booking-form-container').fadeIn('slow');
    		wbkjQ( 'input' ).focus(function() {
				wbkjQ( this ).removeClass('wbk-input-error');
			});
			wbkjQ('#wbk-book_appointment').click(function() {
				var al = wbkjQ('[name="wbk-acceptance"]').length;
 				if ( al == 1 ){
 					if( !wbkjQ ('[name="wbk-acceptance"]').attr('checked')) {
 						wbkjQ('.wbk-acceptance-error').css('display','inline');
 						wbkjQ('.wbk-acceptance-error').css('color','red');
 						return;
 					} else {
 						wbkjQ('.wbk-acceptance-error').css('display','none');
 					}
  				}
				var name = wbkjQ.trim( wbkjQ( '[name="wbk-name"]' ).val() );
				var email = wbkjQ.trim( wbkjQ( '[name="wbk-email"]' ).val() );
				var phone = wbkjQ.trim( wbkjQ( '[name="wbk-phone"]' ).val() );
				var desc =  wbkjQ.trim( wbkjQ( '[name="wbk-comment"]' ).val() );
				var quantity_length = wbkjQ( '[name="wbk-book-quantity"]' ).length;
				var quantity = -1;
				if ( quantity_length == 0 ){
					quantity = 1;
				} else {
					quantity =  wbkjQ.trim( wbkjQ( '[name="wbk-book-quantity"]' ).val() );
				}
				var error_status = 0;
				if ( !wbkCheckString( name, 3, 128 ) ){
	 				error_status = 1;
 	 				wbkjQ( '[name="wbk-name"]' ).addClass('wbk-input-error');
	 			}
	 			if ( !wbkCheckEmail( email ) ){
	 				error_status = 1;
	 				wbkjQ( '[name="wbk-email"]' ).addClass('wbk-input-error');
	 			}
	 			if ( !wbkCheckString( phone, 3, 30 ) ){
	 				error_status = 1;
	 				wbkjQ( '[name="wbk-phone"]' ).addClass('wbk-input-error');
	 			}
	 			if ( !wbkCheckString( desc, 0, 255 ) ){
	 				error_status = 1;
	 				wbkjQ( '[name="wbk-comment"]' ).addClass('wbk-input-error');
	 			}
	 			if ( !wbkCheckIntegerMinMax( quantity, 1, 1000000 ) ){
	 				error_status = 1;
	 			}
	 			// validate custom fields (text)
				wbkjQ('.wbk-text[aria-required="true"]').each(function() {
				    var value =  wbkjQ( this ).val();
					if ( !wbkCheckString( value, 1, 128 ) ){
	 					error_status = 1;
	 					wbkjQ( this ).addClass('wbk-input-error');
	 				}
				});
	 			// validate custom fields (select)
				wbkjQ('.wbk-select[aria-required="true"]').each(function() {
				    var value =  wbkjQ( this ).val();
				    var first_value  = wbkjQ(this).find('option:eq(0)').html();
				    if ( value == first_value ){
				    	error_status = 1;
	 					wbkjQ( this ).addClass('wbk-input-error');
				    }
				});
	 			// validate custom fields (emails)
				wbkjQ('.wbk-email-custom[aria-required="true"]').each(function() {
				    var value =  wbkjQ( this ).val();
					if ( !wbkCheckEmail( value, 1, 128 ) ){
	 					error_status = 1;
	 					wbkjQ( this ).addClass('wbk-input-error');
	 				}
				});


				var extra_value = '';
				// custom fields values (text)
				wbkjQ('.wbk-text, .wbk-email-custom').not('#wbk-name,#wbk-email,#wbk-phone').each(function() {
					var label = wbkjQ('label[for="' + wbkjQ( this ).attr('id') + '"]').html();
					extra_value += label + ': ';
 			 		extra_value += wbkjQ( this ).val() + '###';
				});
				// custom fields values (checkbox)
				wbkjQ('.wbk-checkbox-custom.wpcf7-checkbox').each(function() {
					var label = wbkjQ('label[for="' + wbkjQ( this ).attr('id') + '"]').html();
					extra_value += label + ': ';
					wbkjQ(this).children('span').each(function() {
				 		wbkjQ(this).children('input:checked').each(function() {
				 			extra_value += wbkjQ(this).val() + ' ';
						});
					});
					extra_value += '###';
				});
				// custom fields values (select)
				wbkjQ('.wbk-select').not('#wbk-book-quantity, #wbk-service-id').each(function() {
					// select validation (since 2.1.6)
					var label = wbkjQ('label[for="' + wbkjQ( this ).attr('id') + '"]').html();
					extra_value += label + ': ';
 			 		extra_value += wbkjQ( this ).val() + '###';
				});

				// secondary names, emails
				var secondary_data = [];
				wbkjQ('[id^="wbk-secondary-name"]').each(function() {
					var name_p = wbkjQ(this).val();
					var name_id = wbkjQ(this).attr('id');
					if ( wbkCheckString( name, 1, 128 ) ){
						var arr = name_id.split( '_' );
						var id2 = 'wbk-secondary-email_' + arr[1];
						email_p = wbkjQ('#' + id2).val();

						var person = new Object();
						person.name = name_p;
						person.email = email_p;
						secondary_data.push(person);
					}
				});

	 			if ( error_status == 1 ) {
	 				wbkjQ('html, body').animate({ scrollTop: wbkjQ('#wbk-booking-form-container').last().offset().top - 120 }, 1000);
	 				return;
	 			}
	 			wbkjQ('#wbk-booking-done').html( '<div class="wbk-loading"></div>');
				wbkjQ('#wbk-booking-form-container').fadeOut('slow', function() {
    				wbkjQ('#wbk-booking-form-container').html('');
    				wbkjQ('#wbk-booking-form-container').fadeIn();
					wbkjQ('html, body').animate({
				        							scrollTop: wbkjQ('#wbk-booking-done').offset().top - 120
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
                 
 			 	wbkjQ.post( wbkl10n.ajaxurl, data, function(response) {
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
							wbkjQ('#wbk-booking-done').html( '<div class="wbk-details-sub-title wbk-mb-20">' + response + '</div>' );
	                        if ( wbkl10n.hide_form == 'enabled' ){                   	
		                        wbkjQ('#wbk-slots-container, #wbk-time-container, #wbk-date-container, #wbk-service-container' ).fadeOut( 'fast', function(){
		                        	wbkjQ('#wbk-slots-container, #wbk-time-container, #wbk-date-container, #wbk-service-container').html('');
		                        	wbkjQ('html, body').animate({
	        							scrollTop: wbkjQ('#wbk-booking-done').offset().top - 120
	   								}, 1000);
		                        });
	                    	} else {
	                    		var avail_container_cnt = wbkjQ('.wbk-slot-active-button').siblings('.wbk-slot-available').length;
	                    		if ( avail_container_cnt == 1 ){
	                    			// decrease available count
	                    			var current_avail = parseInt( wbkjQ('.wbk-slot-active-button').siblings('.wbk-slot-available').find('.wbk-abailable-container').html() );
	                    			 
	                    			current_avail = current_avail - quantity;
	                    			 
	                    			if( current_avail == 0 ){       

                                         	if( wbkl10n.show_booked == 'disabled' ){
												wbkjQ('.wbk-slot-active-button').parent().fadeOut( 'fast', function(){
	                    							wbkjQ('.wbk-slot-active-button').parent().remove();
                                        		});
                                         	} else{
                                         		wbkjQ('.wbk-slot-active-button').siblings('.wbk-slot-available').find('.wbk-abailable-container').html(current_avail);
                                         		wbkjQ('.wbk-slot-active-button').replaceWith('<input value="' + wbkl10n.booked_text +'" class="wbk-slot-button wbk-slobooked" type="button">');												
                                         	}
	                    			} else {
										wbkjQ('.wbk-slot-active-button').siblings('.wbk-slot-available').find('.wbk-abailable-container').html(current_avail);
	                    			}
	                    		} else {
	                    			if( wbkl10n.show_booked == 'disabled' ){
										wbkjQ('.wbk-slot-active-button').parent().fadeOut( 'fast', function(){
	                    					wbkjQ('.wbk-slot-active-button').parent().remove();
                                        });
									} else {
										wbkjQ('.wbk-slot-active-button').replaceWith('<input value="' + wbkl10n.booked_text +'" class="wbk-slot-button wbk-slot-booked" type="button">');
                                    }
	                    		}

	                    	}
							if( typeof wbk_on_booking === 'function' ) {
							
							   wbk_on_booking( service, time, name, email, phone, desc, quantity );  
							}
							wbk_set_payment_events();

					
					} else {
						wbkjQ('html, body').animate({
        							scrollTop: wbkjQ('#wbk-booking-done').offset().top
   								}, 1000);
						wbkjQ('#wbk-booking-done').html('Something went wrong, please try again.');
					}
					wbkjQ('#wbk-slots-container').show('slide');
 			 	});
			});
    	}
    });

	});
}
function wbk_cancel_booked_appointment_events(){
	wbkjQ('#wbk-cancel_booked_appointment').click(function() {
		var app_token = wbkjQ(this).attr('data-appointment');
		var email = wbkjQ.trim( wbkjQ( '#wbk-customer_email' ).val() );
		wbkjQ( '#wbk-customer_email' ).val(email); 
		if ( !wbkCheckEmail( email ) ){
			wbkjQ( '#wbk-customer_email' ).addClass('wbk-input-error');
	 	} else {
		    var data = {
				'action' : 'wbk_cancel_appointment',
				'app_token':  app_token,
				'email': email
		 	};
		 	wbkjQ('#wbk-cancel-result').html('<div class="wbk-loading"></div>');
			wbkjQ('#wbk-cancel_booked_appointment')
			wbkjQ('#wbk-cancel_booked_appointment').prop('disabled', true);
		 	wbkjQ.post( wbkl10n.ajaxurl, data, function(response) {
		 		response = wbkjQ.parseJSON( response );
		 		wbkjQ('#wbk-cancel-result').html( response.message );
			  	if( response.status == 0 ){
			  		wbkjQ('#wbk-cancel_booked_appointment').prop('disabled', false );
			  	}
			  	 
		 	});

	 	}
	});
}
function wbk_set_payment_events(){
	wbkjQ('.wbk-payment-init').click(function() {
	    wbkjQ('#wbk-payment').html('<div class="wbk-loading"></div>');
		wbkjQ('html, body').animate({ scrollTop: wbkjQ('#wbk-payment').last().offset().top - 120 }, 1000);
		 

	    var data = {
			'action' : 'wbk_prepare_payment',
			'app_id': wbkjQ(this).attr('data-app-id'),
			'method': wbkjQ(this).attr('data-method')
	 	};
	 	wbkjQ.post( wbkl10n.ajaxurl, data, function(response) {
            wbkjQ('#wbk-payment').fadeOut('fast', function(){
				wbkjQ('#wbk-payment').html(response);
				wbkjQ('#wbk-payment').fadeIn('slow');		
				wbkjQ( '.wbk-approval-link' ).click(function() {
					window.location.href = wbkjQ(this).attr('data-link');
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