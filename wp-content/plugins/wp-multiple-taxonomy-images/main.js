jQuery(document).ready(function ($) {
    var placeholder_img = cvti_options.placeholder; 
    var btn_add = cvti_options.btn_add;
    var btn_remove = cvti_options.btn_remove;
     
    function empty_field(){
        return '<div class="cvti-container">'+ 
                '<img  class="cvti-image" src="' + placeholder_img + '"  style="max-width: 100px; width: auto; height: auto"/><br>'+  
		'<input type="hidden" class="cvti_post_image" name="cvti_post_image[]" value="" />'+
                '<span class="cvti-title"></span> - '+
                '<span class="cvti-shape"></span><br>'+
		'<button class="cvti_upload_button button">' + btn_add + '</button>'+
                '<button class="cvti_remove_button button" style="display:none;">' + btn_remove  + '</button>'+
             '</div>';
        
    } 
     
    $('.cvti_more_button').click(function(event){
        $('#cvti_bottom').before($('<div />',{'class': 'form-field cvti-form-field'}).html(empty_field()));
         event.preventDefault();
    });
    
    $('.cvti_more_tr_button').click(function(event){
        $('#cvti_bottom').before($('<tr />',{'class': 'form-field cvti-form-field'})
                .html('<th scope="row" valign="top"></th><td>' + empty_field() +'</td></tr>'));
         event.preventDefault();
    });
    
    $('.cvti_less_button').click(function(event){
       $('#cvti_bottom').prev('.cvti-form-field').remove();
        event.preventDefault();
    });
    
    $( "body" ).on( "click", ".cvti_upload_button",function (event) {
        var upload_button = $(this);
        var parent = upload_button.closest( '.cvti-container' );
        
        
        var frame;
        event.preventDefault();
        if (frame) {
            frame.open();
            return;
        }
        frame = wp.media();
        frame.on("select", function () {
            // Grab the selected attachment.
            var attachment = frame.state().get("selection").first();
            frame.close();
            
            $('.cvti_post_image',parent).val(attachment.attributes.url);
            $('.cvti-image',parent).attr('src',attachment.attributes.url);
            $('.cvti-title',parent).html(attachment.attributes.title);
            $('.cvti-shape',parent).html(attachment.attributes.width+' x '+attachment.attributes.height);
            upload_button.next().show();
            
        });
        frame.open();
    });
    
     $( "body" ).on( "click", ".cvti_remove_button",function (event) {
        event.preventDefault();
        var remove_button = $(this);
        var parent = remove_button.closest( '.cvti-container' );
        remove_button.hide();
        $('.cvti_post_image',parent).val("");
        $('.cvti-image',parent).attr('src',placeholder_img);
        $('.cvti-title',parent).empty();
        $('.cvti-shape',parent).empty();
    });
});