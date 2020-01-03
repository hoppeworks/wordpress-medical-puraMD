<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  Key should be exactly the same as in
 *  he class product_type
 */	

add_filter( 'product_type_selector', 'phoen_add_gift_card_type' );

function phoen_add_gift_card_type ( $type ) {
	
	$type[ 'gift_card' ] = __( 'Gift Card', 'phoen-gift-card' );
	
	return $type;
}

/**
 *  Key should be exactly the same as in
 *  he class product_type
 */	
 
add_filter( 'woocommerce_product_data_tabs', 'phoen_gift_card_tab' );

 function phoen_gift_card_tab( $tabs) {
	 
	$tabs['gift_card'] = array(
	
		'label'	 => __( 'Gift Card', 'phoen-gift-card' ),
		
		'target' => 'gift_card_options',
		
		'class'  => ('show_if_gift_card'),
		
	);
	
	return $tabs;
}

add_action( 'product_type_options', 'phoen_gift_custom_product_type_options' );

function phoen_gift_custom_product_type_options($options){
	
	$options['virtual']['wrapper_class'] = 'show_if_simple show_if_simple_rental_p';
	
	return $options;
}

/**
 *  Dont forget to change the id in the div with
 *  your target of your product tab
 */	
	
add_action( 'woocommerce_product_data_panels', 'phoen_gift_card_options_product_tab_content' );

function phoen_gift_card_options_product_tab_content() {
	
	?>
	<div id='gift_card_options' class='panel woocommerce_options_panel'>
	
		<div class='options_group'>
		
			<?php
			
			global $woocommerce, $post, $product;
			  
			$phoen_product_make_giftcard_enable = get_post_meta( $post->ID, '_product_make_giftcard', true );
		
			$product_id = $post->ID;
			
			$phoen_product_make_giftcard_enable = isset($phoen_product_make_giftcard_enable)?$phoen_product_make_giftcard_enable:'';
			
			$phoen_product_price_val = get_post_meta( $product_id, '_product_giftcard_prices', true);
			
			$product_type = new WC_Product( $product_id );
			
		  ?>
			<input type="hidden" value="<?php echo $post->ID ; ?>" class="phoen_pro_id">
			
			<p class="form-field">
			
				<label for="phoen_reword"><?php _e( 'Enable gift card product', 'phoen-gift-card' ); ?></label>
				
				<input type="checkbox" step="any" name="phoen_product_make_giftcard" value="yes" <?php if($phoen_product_make_giftcard_enable=='yes'){echo "checked" ; } ?>>
				
			</p>
			
			<div class="phoeniixx_range_html_content_div">
			
				<?php
				
				if(!empty($phoen_product_price_val))
				{
				
					sort($phoen_product_price_val);
					
					$phoe_array_arrlength = count($phoen_product_price_val);
					
					for($phoen_gift_key = 0; $phoen_gift_key < $phoe_array_arrlength; $phoen_gift_key++) {
					
						?>
						
							<div class="phoeniixx_red_points_div">
							
								<input type="hidden" name="phoen_product_amount" value="<?php echo esc_attr($phoen_product_price_val[$phoen_gift_key]) ; ?>" class="phoen_array">
								
								<span><?php echo esc_attr($phoen_product_price_val[$phoen_gift_key]) ; ?></span>
								
								<button name="remove_b" class="phoe_remove_range_disc_div button" data-index="<?php echo esc_attr($phoen_product_price_val[$phoen_gift_key]); ?>"><?php _e( 'x', 'phoen-gift-card' ); ?></button>
							
							</div>
						
						<?php
						
					}
					
				}	
				?>
				
			</div>
			
			<div class="phoen_card_point_main_inp">
			
				<label for="phoen_reword"><?php _e( 'Add gift amount ', 'phoen-gift-card' ); ?></label>
				
				<input type="number" min="0" class="example-default-value" id="example-textarea" style="width: 100px;" name="phoen_product_amount_giftcard">
				
			</div>
			
			<div class="phoe_bk_add_btn">
			
				<input type="button" value="<?php _e( 'Add', 'phoen-gift-card' ); ?>" class="phoe_range_add_disc_more button">
			
			</div>
			
		</div>
		
	</div>
	
	<?php
}

/**
 *  save product pannal data 
 *  to enable product giftcard
 */	

add_action( 'woocommerce_process_product_meta', 'phoen_save_gift_card_options_field' );

function phoen_save_gift_card_options_field( $post_id ) {

	$phoen_product_make_giftcard = ( isset( $_POST['phoen_product_make_giftcard'] ) ? sanitize_text_field( $_POST['phoen_product_make_giftcard'] ) : "" );
	
	update_post_meta( $post_id, '_product_make_giftcard', $phoen_product_make_giftcard);
	
	$phoen_product_price_val = get_post_meta( $post_id, '_product_giftcard_prices', true);
	
	if(empty($phoen_product_price_val))
	{
		update_post_meta( $post_id, '_product_giftcard_prices', array('10','20'));	
		
	}
}
	
/**
 *  Ajax for update custom product price
 *  to dispay on product 
 */	

add_action( 'wp_ajax_phoen_gift_price_display_on_product', 'phoen_gift_price_display_on_product' );

add_action( 'wp_ajax_nopriv_phoen_gift_price_display_on_product', 'phoen_gift_price_display_on_product' );

function phoen_gift_price_display_on_product()
{
	
	$phoen_product_price = ( isset( $_POST['gift_car_price'] ) ? sanitize_text_field( $_POST['gift_car_price'] ) : "" );
	 
	$product_id = ( isset( $_POST['product_id'] ) ? sanitize_text_field( $_POST['product_id'] ) : "" );
	
	$phoen_array = ( isset( $_POST['phoen_array'] ) ? sanitize_text_field( $_POST['phoen_array'] ) : "" );
	
	$phoen_product_price_val = get_post_meta( $product_id, '_product_giftcard_prices', true);
	
	if(empty($phoen_product_price_val))
	{
		update_post_meta( $product_id, '_product_giftcard_prices', array($phoen_product_price));
		
	}else{
		
		if($phoen_product_price!='')
		{
			$phoen_product_price=array($phoen_product_price);
			
			$phoen_save_price_from = array_merge($phoen_product_price_val,$phoen_product_price);
			
			update_post_meta( $product_id, '_product_giftcard_prices', $phoen_save_price_from);
			
		}else{
			
			if($phoen_array!='')
			{
				
				$phoen_product_price_val = get_post_meta( $product_id, '_product_giftcard_prices', true);
				
				$phoen_save_price_from = array_diff($phoen_product_price_val, array($phoen_array));
				
				update_post_meta( $product_id, '_product_giftcard_prices', $phoen_save_price_from);
				
			}
			
		}
	
	}
	echo "sucess";
	die();
}
?>