jQuery(document).ready(function($) {
	/*$('#upload_user_avatar_button').click(function() {
		
        tb_show('Upload image', 'media-upload.php?referer=teacher&type=image&TB_iframe=true&post_id=0', false);
        return false;
    });
	
	window.send_to_editor = function(html) {
    var image_url = $('img',html).attr('src');
    $('#smgt_user_avatar_url').val(image_url);
    tb_remove();
	$('#upload_user_avatar_preview img').attr('src',image_url);
	}
	$('#upload_user_cover_button').click(function() {
		
       tb_show('Upload image', 'media-upload.php?referer=teacher&type=image&TB_iframe=true&post_id=0', false);
        window.send_to_editor = function(html) {
		var image_url = $('img',html).attr('src');
		$('#smgt_user_cover_url').val(image_url);
		tb_remove();
		$('#upload_user_cover_preview img').attr('src',image_url);
		}
		return false;
    });
	*/
	var file_frame;
	


	 jQuery('#upload_user_avatar_button').click(function( event ){
			
		    event.preventDefault();

		    // If the media frame already exists, reopen it.
		    if ( file_frame ) {
		      file_frame.open();
		      return;
		    }

		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: jQuery( this ).data( 'uploader_title' ),
		      button: {
		        text: jQuery( this ).data( 'uploader_button_text' ),
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });

		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		     // alert(attachment.url);
		      jQuery("#hmgt_user_avatar_url").val(attachment.url);
		      $('#upload_user_avatar_preview img').attr('src',attachment.url);
		      // Do something with attachment.id and/or attachment.url here
		    });

		    // Finally, open the modal
		    file_frame.open();
		  });
	
	
	
		  jQuery('.upload_user_cover_button').click(function( event ){

		    event.preventDefault();

		    // If the media frame already exists, reopen it.
		    if ( file_frame ) {
		      file_frame.open();
		      return;
		    }

		    // Create the media frame.
		    file_frame = wp.media.frames.file_frame = wp.media({
		      title: jQuery( this ).data( 'uploader_title' ),
		      button: {
		        text: jQuery( this ).data( 'uploader_button_text' ),
		      },
		      multiple: false  // Set to true to allow multiple files to be selected
		    });

		    // When an image is selected, run a callback.
		    file_frame.on( 'select', function() {
		      // We set multiple to false so only get one image from the uploader
		      attachment = file_frame.state().get('selection').first().toJSON();
		     // alert(attachment.url);
		      jQuery("#hmgt_hospital_background_image").val(attachment.url);
		      $('#upload_hospital_cover_preview img').attr('src',attachment.url);
		      // Do something with attachment.id and/or attachment.url here
		    });

		    // Finally, open the modal
		    file_frame.open();
		  });
	
});