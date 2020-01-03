var number = document.getElementById('example-textarea');

// Listen for input event on numInput.
number.onkeydown = function(e) {
    if(!((e.keyCode > 95 && e.keyCode < 106)
      || (e.keyCode > 47 && e.keyCode < 58) 
      || e.keyCode == 8)) {
        return false;
    }
}
jQuery(document).ready(function(){
					
	jQuery( '.show_if_simple_rental_p' ).show();

	jQuery('.phoeniixx_giftcart_custom_tab').click(function(){
		
			jQuery('.phoen_panel_options').show();
	});

	jQuery('.phoe_range_add_disc_more').click(function()
	{
		
		var phoen_gift_regester =  jQuery(".example-default-value").val();
		
		if(jQuery.isNumeric( phoen_gift_regester ) && phoen_gift_regester >= 1 ) {
		  
			var phoen_array =  jQuery(this).closest('.phoe_remove_range_disc_div').attr('data-index');
			
			var product_id =  jQuery(".phoen_pro_id").val();
		
			 jQuery.post(
			
				gift_card_check.ajaxurl, 
				{
					'action': 'phoen_gift_price_display_on_product',
					'gift_car_price': phoen_gift_regester,  
					'product_id': product_id,
					'phoen_array':phoen_array
					
				}, 
				function(response){
				
					if(response=='sucess')
					{
						 jQuery(".example-default-value").val("");
						 jQuery('.phoeniixx_range_html_content_div').append('<div class="phoeniixx_red_points_div"><span>'+phoen_gift_regester+'</span><button name="remove_b" class="phoe_remove_range_disc_div button">x</button></div>' );
					}
					
					
				}
			); 
		
		}else{
			
			 alert('please enter amount value only');
		}

	});

	jQuery('.phoe_remove_range_disc_div').click(function()
	{

			var phoen_gift_regester =  jQuery(".example-default-value").val();
			var phoen_array =  jQuery(this).closest('.phoe_remove_range_disc_div').attr('data-index');
			var product_id=  jQuery(".phoen_pro_id").val();
		
			 jQuery.post(
			
				gift_card_check.ajaxurl, 
				{
					'action': 'phoen_gift_price_display_on_product',
					'gift_car_price': phoen_gift_regester,  
					'product_id': product_id,
					'phoen_array':phoen_array
					
				}, 
				function(response){

					if(response=='sucess')
					{
						 jQuery(".example-default-value").val("");
					}
					
					
				}
			); 
		
	});		
	
	jQuery('.example-default-value').each(function() {
		var default_value = this.value;
		jQuery(this).focus(function() {
			if(this.value == default_value) {
				this.value = '';
			}
		});
		jQuery(this).blur(function() {
			if(this.value == '') {
				this.value = default_value;
			}
		});
	});
	
	/* jQuery('.phoe_range_add_disc_more').click(function(){
		
		var phoen_gift_regester =  jQuery(".example-default-value").val();
		
		
		if(jQuery.isNumeric( phoen_gift_regester ) && phoen_gift_regester >= 1) {
	
		  var span_val = jQuery('#example-textarea').val();
		
			jQuery('.phoeniixx_range_html_content_div').append('<div class="phoeniixx_red_points_div"><span>'+span_val+'</span><button name="remove_b" class="phoe_remove_range_disc_div button">x</button></div>' );
		}else{
			 alert('please enter amount value only');
		}	
	
	}); */

	jQuery(document).on('click','.phoe_remove_range_disc_div',function(){

		jQuery(this).parent('div').remove();

	}); 

});