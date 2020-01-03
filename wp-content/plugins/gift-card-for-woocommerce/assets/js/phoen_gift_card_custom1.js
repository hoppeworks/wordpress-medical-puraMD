jQuery(document).ready(function()
{
	jQuery(this).closest('.phoeniixx_rewd_min_max_div').find('.phoen_gift_amount_cls li').addClass('active');
	 
	jQuery(".phoen_gift_amount_cls .phoen_pric:first").trigger('click');

});

 jQuery(document).on('click','.phoen_gift_amount_cls li',function(){
	
	jQuery(this).closest('.phoeniixx_rewd_min_max_div').find('.pho_symbol').hide();
	
	var selectVal = jQuery(this).attr('data-wc-price');
	
	
	
	jQuery(this).closest('.phoeniixx_rewd_min_max_div').find('.phoen_gift_amount_cls li').removeClass('active');
	
	jQuery(this).addClass('active');
	
	jQuery(this).closest('.phoeniixx_rewd_min_max_div').find('.phoen_price_add').html(selectVal);
	
	jQuery(this).closest('.phoeniixx_rewd_min_max_div').find('.phoen_hidden_text_val').val(selectVal);
			 
 });