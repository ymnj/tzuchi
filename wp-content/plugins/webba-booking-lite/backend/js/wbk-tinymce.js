(function() {
    tinymce.PluginManager.add( 'wbk_tinynce', function( editor, url ) {
        editor.addButton( 'wbk_service_name_button', {
            text: 'Service Name',
            icon: false,
            onclick: function() {
                var content = '#service_name';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_customer_name_button', {
            text: 'Customer Name',
            icon: false,
            onclick: function() {
                var content = '#customer_name';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_appointment_day_button', {
            text: 'Booking date',
            icon: false,
            onclick: function() {
                var content = '#appointment_day';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_appointment_time_button', {
            text: 'Booking time',
            icon: false,
            onclick: function() {
                var content = '#appointment_time';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_appointment_id_button', {
            text: 'Appointment ID',
            icon: false,
            onclick: function() {
                var content = '#appointment_id';
                editor.insertContent( content );
            }
        }); 
        editor.addButton( 'wbk_customer_phone_button', {
            text: 'Customer phone',
            icon: false,
            onclick: function() {
                var content = '#customer_phone';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_customer_email_button', {
            text: 'Customer email',
            icon: false,
            onclick: function() {
                var content = '#customer_email';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_customer_comment_button', {
            text: 'Customer comment',
            icon: false,
            onclick: function() {
                var content = '#customer_comment';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_customer_custom_button', {
            text: 'Custom data',
            icon: false,
            onclick: function() {
                var content = '#customer_custom';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_items_count', {
            text: 'Items count',
            icon: false,
            onclick: function() {
                var content = '#items_count';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_total_amount', { 
            text: 'Total amount',
            icon: false,
            onclick: function() {
                var content = '#total_amount';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_payment_link', {
            text: 'Payment link',
            icon: false,
            onclick: function() {
                var content = '#payment_link';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_cancel_link', {
            text: 'Cancel link',
            icon: false,
            onclick: function() {
                var content = '#cancel_link';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_tomorrow_agenda', {
            text: 'Agenda for tomorrow',
            icon: false,
            onclick: function() {
                var content = '#tomorrow_agenda';
                editor.insertContent( content );
            }
        });
        editor.addButton( 'wbk_group_customer', {
            text: 'Group customer name',
            icon: false,
            onclick: function() {
                var content = '#group_customer_name';
                editor.insertContent( content );
            }
        });
    });
})();