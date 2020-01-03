<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* This function use for 
* Display Giftcard fields on singal Product page
*/	

add_action( 'woocommerce_single_product_summary', 'phoen_giftcard_add_custom_fields', 20 );

function phoen_giftcard_add_custom_fields() {
	
	global $woocommerce, $post, $product;
	
	$phoen_product_make_giftcard_enable = get_post_meta( $post->ID, '_product_make_giftcard', true );

	if($product->get_type() ==  "gift_card" &&  $phoen_product_make_giftcard_enable=='yes')
	{
		
		$phoen_giftcard_settings = get_option('phoe_giftcard_value');
		
		$enable_custom_giftcard_plugin=isset($phoen_giftcard_settings['enable_custom_giftcard_plugin'])?$phoen_giftcard_settings['enable_custom_giftcard_plugin']:'';
		
		$current_user = wp_get_current_user();
		
		$phoen_user_email =  $current_user->user_email;
		
		$user_firstname = $current_user->user_firstname;
		
		$user_lastname = $current_user->user_lastname;
		
		$phoen_user_name=($user_firstname." ".$user_lastname);
		
		$phoen_current_date = new DateTime();
		
		$phoen_expirey_month = isset($phoen_giftcard_settings['phoen_gift_coupan_expirey_month'])?$phoen_giftcard_settings['phoen_gift_coupan_expirey_month']:'' ;
		
		if($phoen_expirey_month!='' && $phoen_expirey_month!='0')
		{
			
			$phoen_gift_card_exp_date=("+".$phoen_expirey_month . "Months");
			
			$phoen_gift_card_exp_date = date("d-m-Y",strtotime($phoen_gift_card_exp_date)); 
			
		}else if($phoen_expirey_month=='0') {
			
			$phoen_gift_card_exp_date=date("d-m-Y"); 
			
		}
		
		   ?>
		<form class="cart gift_card_cart" method="post" enctype='multipart/form-data'>
		
			<?php wp_nonce_field('phoen_gift_card_action', 'phoen_gift_card_nonse_fields'); ?>
			
			<div class="phoen_giftcard_head">
		   
				<input type="hidden"   id="phoen_gift_card_prod_id" name="phoen_gift_card_prod_id" value="<?php echo esc_attr($post->ID) ; ?>">
				
				<input type="hidden"   id="phoen_gift_card_form" name="phoen_gift_card_form" value="<?php echo esc_attr($phoen_user_name) ; ?>">
				
				<input type="hidden" id="phoen_gift_card_email_from" name="phoen_gift_card_email_from" value="<?php echo esc_attr($phoen_user_email) ; ?>">
				
				<input type="hidden" id="phoen_gift_card_expiry_date" name="phoen_gift_card_expiry_date" value="<?php echo esc_attr($phoen_gift_card_exp_date) ; ?>">
				
				<div class="phoen_gift_cart_product">

					<div class="phoeniixx_red_points_div">
						
						<div class="phoeniixx_rewd_min_max_div">
						
							<?php
							$get_price = get_post_meta ( $product->get_id(), '_product_giftcard_prices' );
							
							$phoen_currency_symbol=get_woocommerce_currency_symbol();
							
							$phoen_first_price=$get_price[0];
							
							$phoen_first_price_val = $phoen_first_price[0];
							
							$phoen_first_price_val_pri =($phoen_currency_symbol.$phoen_first_price_val);
							
							?>							
							
							<div class="phoen_select_amount">
							
								<label><?php _e('Select Gift Card Amount','phoen-gift-card'); ?></label>
								
								<ul name="phoen_gift_amount_ul" class="phoen_gift_amount_cls">
								
									<?php
									
									$get_price = get_post_meta ( $product->get_id(), '_product_giftcard_prices' );
							
									$phoen_currency_symbol=get_woocommerce_currency_symbol();
									
									if($get_price!='')
									{
										$phoen_first_price=$get_price[0];
							
										$phoen_first_price_val = min($phoen_first_price);
									}
									$phoen_product_price_val = get_post_meta( $post->ID, '_product_giftcard_prices', true);
									if(!empty($phoen_product_price_val))
									{
										sort($phoen_product_price_val);
										$phoe_array_arrlength = count($phoen_product_price_val);
										for($phoen_gift_key = 0; $phoen_gift_key < $phoe_array_arrlength; $phoen_gift_key++) {
										
											?>
													
												<li  class="phoen_pric" data-wc-price="<?php echo esc_attr($phoen_currency_symbol.$phoen_product_price_val[$phoen_gift_key]) ; ?>" value="<?php echo esc_attr($phoen_product_price_val[$phoen_gift_key]) ; ?>"><?php echo esc_attr($phoen_currency_symbol.$phoen_product_price_val[$phoen_gift_key]) ; ?></li>
												
											<?php
											
										
										}
									}
								
									$phoen_first_price_val_pri =($phoen_currency_symbol.'0');
									
									?>
									
								</ul>
								
								<input type="hidden" name="phoen_gift_amount" value="<?php echo esc_attr($phoen_first_price_val_pri) ; ?>" class="phoen_hidden_text_val">
								
							</div>
						
							<div class="phoen_recent_emaol">
								
								<div class="phoen_recent_inp">
								
									<input type="text"  id="phoen_gift_card_to" name="phoen_gift_card_to" value="" required placeholder="<?php _e('To','phoen-gift-card'); ?>">
									
								</div>
								
								<div class="phoen_recent_inp">
								
									<input type="email"   id="phoen_gift_card_email_to" name="phoen_gift_card_email_to" value="" required placeholder="<?php _e("Receiver's Email",'phoen-gift-card'); ?>">
									
								</div>
							
							</div>	
						
						</div>	
						
					</div>
					
				</div>
			
			   <input type="number" step="1" min="1" name="quantity" value="1" title="Qty" class="input-text qty text"/> 
			   
			   <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
			
			</div>
		
		</form>
			<?php
	
	}  
}

/**
* Change product add to cart button
* Text url on shop page
*/	

add_filter( 'woocommerce_loop_add_to_cart_link', 'phoen_gift_card_replacing_add_to_cart_button', 10, 2 );

function phoen_gift_card_replacing_add_to_cart_button( $button, $product  ) {
	
	$change_ids = $product->get_id();
	
	$phoen_product_make_giftcard_enable = get_post_meta( $change_ids, '_product_make_giftcard', true );
	
	if($phoen_product_make_giftcard_enable=='yes')
	{
		if ( $product ) { // if there's a product proceed
		
			$change_id = $product->get_id();
			
			$button_text = __("Select Options", "woocommerce");
			
			$button = '<a class="button" href="'.get_permalink($change_id).'">' . $button_text . '</a>';
			
		}
		
	}
	
	return $button;
}

/**
* Set Custom Price of product 
* to purches 
*/	

add_action( 'woocommerce_before_calculate_totals', 'phoen_giftcard_add_custom_price' );

function phoen_giftcard_add_custom_price($cart_object ) {
			
	$old_price1='';
		
	foreach ( $cart_object->cart_contents as $key => $value ) {  
	
		$pheon_pro_id = isset($value['phoen_gift_card_prod_id'])?$value['phoen_gift_card_prod_id']:'';
		
		$phoen_product_make_giftcard_enable = get_post_meta( $pheon_pro_id, '_product_make_giftcard', true );
		
		if($phoen_product_make_giftcard_enable=='yes')
		{
	
			$phoen_gift_amount= isset($value['phoen_gift_amount'])?$value['phoen_gift_amount']:'';
			
			if($phoen_gift_amount!='')
			{
	
				$phoen_data =$phoen_gift_amount;
				
				$value['data']->set_price($phoen_data); 
				
			}
	
		}	 
		
	}
	
}
 
/**
* Get item data to display on cart page
*  after checkout on product column
*/	

add_filter( 'woocommerce_get_item_data',  'phoen_gift_card_get_items_data' , 10, 2 );
 
function phoen_gift_card_get_items_data( $other_data, $cart_item_data ) {
	
	$cart_item_datas = isset($cart_item_data['gift_name'])?$cart_item_data['gift_name']:'';
	
	if($cart_item_datas!='')
	{
		
		echo "<br/>"." Name To : ".$cart_item_data['gift_name'];
		
		echo "<br/>"." Email To: ".$cart_item_data['gift_email'];	
		
	}

	return $other_data; 
		
}

/**
* handle add to cart
*  in cart
*/	

function phoen_giftcard_woocommerce_add_to_cart_handler( $adding_to_cart_get_type, $adding_to_cart ) { 

	global $woocommerce;

	$phoen_gift_card_prod_id = ( isset( $_POST['phoen_gift_card_prod_id'] ) ? sanitize_text_field( $_POST['phoen_gift_card_prod_id'] ) : "" );
	
	$phoen_product_make_giftcard_enable = get_post_meta( $phoen_gift_card_prod_id, '_product_make_giftcard', true );
	
	$phoen_giftcard_settings = get_option('phoe_giftcard_value');
	
	$enable_custom_giftcard_plugin=isset($phoen_giftcard_settings['enable_custom_giftcard_plugin'])?$phoen_giftcard_settings['enable_custom_giftcard_plugin']:'';
	
	if($phoen_product_make_giftcard_enable=='yes')
	{
		if(wp_verify_nonce($_REQUEST['phoen_gift_card_nonse_fields'], 'phoen_gift_card_action')){

			$phoen_gift_card_form = ( isset( $_POST['phoen_gift_card_form'] ) ? sanitize_text_field( $_POST['phoen_gift_card_form'] ) : "" );
			
			$phoen_gift_card_email_from = ( isset( $_POST['phoen_gift_card_email_from'] ) ? sanitize_text_field( $_POST['phoen_gift_card_email_from'] ) : "" );
			
			$phoen_gift_card_prod_id = ( isset( $_POST['phoen_gift_card_prod_id'] ) ? sanitize_text_field( $_POST['phoen_gift_card_prod_id'] ) : "" );
			
			$phoen_gift_amount = ( isset( $_POST['phoen_gift_amount'] ) ? sanitize_text_field( $_POST['phoen_gift_amount'] ) : "" );
			
			$phoen_gift_card_description = ( isset( $_POST['phoen_gift_card_description'] ) ? sanitize_text_field( $_POST['phoen_gift_card_description'] ) : "" );
			
			$phoen_gift_card_expiry_date = ( isset( $_POST['phoen_gift_card_expiry_date'] ) ? sanitize_text_field( $_POST['phoen_gift_card_expiry_date'] ) : "" );
			
			$phoen_gift_card_user_name = ( isset( $_POST['phoen_gift_card_to'] ) ? sanitize_text_field( $_POST['phoen_gift_card_to'] ) : "" );
			
			$quantity = ( isset( $_POST['quantity'] ) ? sanitize_text_field( $_POST['quantity'] ) : "" );
			
			$phoen_gift_card_user_email_dara = ( isset( $_POST['phoen_gift_card_email_to'] ) ? sanitize_text_field( $_POST['phoen_gift_card_email_to'] ) : "" );
			
			if($phoen_gift_amount=='')
			{
				$get_price = get_post_meta ( $phoen_gift_card_prod_id, '_product_giftcard_prices' );
				
				if($get_price!='')
				{
					$phoen_first_price=$get_price[0];
					$phoen_gift_amount = min($phoen_first_price);
					
				}
			}
			$item_data = array( 
				
				'gift_name'=>$phoen_gift_card_user_name,
				
				'gift_email'=>$phoen_gift_card_user_email_dara,
				
				'phoen_gift_card_description'=>$phoen_gift_card_description,
				
				'phoen_gift_card_form'=>$phoen_gift_card_form,
				
				'phoen_gift_card_email_from'=>$phoen_gift_card_email_from,
				
				'phoen_gift_card_expiry_date'=>$phoen_gift_card_expiry_date,
				
				'phoen_gift_amount'=>$phoen_gift_amount,
				
				'phoen_gift_card_prod_id'=>$phoen_gift_card_prod_id,
					
			);
				
			for ( $i = 0; $i < $quantity; $i ++ ) {
			
				//fixing warning with no price values
				update_post_meta($phoen_gift_card_prod_id, '_price', $phoen_gift_amount);
                
				WC()->cart->add_to_cart( $phoen_gift_card_prod_id, 1, 0, array(), $item_data );
			}
			
		}
		
	}	
	// exit();
	
		return $adding_to_cart_get_type; 
}
	 
// add the filter 
add_filter( 'woocommerce_add_to_cart_handler', 'phoen_giftcard_woocommerce_add_to_cart_handler', 10, 2 ); 

/**
* remove outher product
*  in cart
*/	

add_action( 'woocommerce_add_to_cart', 'phoen_gift_check_product_added_to_cart', 10, 6 );

function phoen_gift_check_product_added_to_cart($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data) {

	$phoen_product_make_giftcard_enable = get_post_meta( $product_id, '_product_make_giftcard', true );
	
	
	if($phoen_product_make_giftcard_enable=='yes')
	{
		foreach( WC()->cart->get_cart() as $key => $item ){
		  
			$phoen_gift_card_prod_id = isset($item['phoen_gift_card_prod_id'])?$item['phoen_gift_card_prod_id']:'';
			
			$phoen_gift_email = isset($item['gift_email'])?$item['gift_email']:'';
			
			if($phoen_gift_email=='')
			{
				
				WC()->cart->remove_cart_item($key);
			}
		   
		}
		
	}

	foreach( WC()->cart->get_cart() as $keys => $item ){
	
		$phoen_gift_email = isset($item['gift_email'])?$item['gift_email']:'';
		
		$phoen_keys_val='';
		
		if($phoen_gift_email!='')
		{
			$phoen_keys_val=$keys;
		}
		
		if($phoen_keys_val!='')
		{
			if($phoen_keys_val!=$keys)
			{
				WC()->cart->remove_cart_item($keys);
			}
		}
	
	}
	
}

/**
* this function use for  
* return user Coupon price
*/	

function phoen_giftcard_user_totle_amounts(){
	
	global $woocommerce;
	
	$argsm    = array('posts_per_page' => -1, 'post_type' => 'shop_order','post_status'=>array_keys(wc_get_order_statuses()));

	$products_order = get_posts( $argsm ); 
	
	$current_user = wp_get_current_user();

	$curr=get_woocommerce_currency_symbol();
	
	$phoen_gift_posts_data = get_posts(array(
	
			'post_type'   => 'phoen_gift_card',
			
			'post_status' => 'publish',
			
			'posts_per_page' => -1,
				
		)
		
	);
	
	$total_used_amount='';
	
	foreach($phoen_gift_posts_data as $keys=>$phoen_gift_posts_val){
		
		$phoen_gift_posts_id = $phoen_gift_posts_val->ID;
		
		$phoen_gift_post_titles =$phoen_gift_posts_val->post_title;
		
		$phoen_get_meta_data = get_post_meta( $phoen_gift_posts_id, 'phoen_gift_card_meta_data', true );
		
		$phoen_apply_title = isset($_POST['phoen_apply_gift_coupon_val'])?$_POST['phoen_apply_gift_coupon_val']:'';
		
		if($phoen_gift_post_titles==$phoen_apply_title)
		{
			$phoen_gift_post_titless =$phoen_gift_posts_val->post_title;
			
			$phoen_gift_posts_ids = $phoen_gift_posts_val->ID;
			
			$phoen_gift_card_amount_used = get_post_meta($phoen_gift_posts_ids, "phoen_gift_card_amount_used", true); 
			
			$phoen_gift_card_card_totle_amount=get_post_meta($phoen_gift_posts_ids, "phoen_gift_card_card_totle_amount",true); 
			
			$phoen_giftcard_meta = get_post_meta($phoen_gift_posts_ids, "phoen_gift_card_side_box_meta",true); 
			
			$phoen_select_status = isset( $phoen_giftcard_meta[ 'phoen_select_status' ] ) ? $phoen_giftcard_meta[ 'phoen_select_status' ] : '';
			
			if($phoen_select_status=='active' || $phoen_select_status=='')
			{
				if($phoen_gift_card_amount_used!='')
				{
					$total_used_amounts=($phoen_gift_card_card_totle_amount-$phoen_gift_card_amount_used);
					
					if ($total_used_amounts <= 0)
					{
						
					   $total_used_amount="";
					   
					}else{
						
						$total_used_amount=($phoen_gift_card_card_totle_amount-$phoen_gift_card_amount_used);
					}
					
				}else{
					
					$total_used_amount=get_post_meta($phoen_gift_posts_ids, "phoen_gift_card_card_totle_amount",true); 
					
				}
			
			}else{
				
				$total_used_amount="deactive";
				
			}
		}
	
	}
	
	return $total_used_amount;	
}

/**
* save data
* in order meta hook
*/	

add_action( 'woocommerce_add_order_item_meta',  'phoen_giftcard_order_item_meta' , 10, 2 );
 
function phoen_giftcard_order_item_meta($item_id,$values) 
{
	if(isset($values['phoen_gift_card_prod_id'])){
		
		$product_id = $values['phoen_gift_card_prod_id'];
		
		$phoen_product_make_giftcard_enable = get_post_meta( $product_id, '_product_make_giftcard', true );
		
		if($phoen_product_make_giftcard_enable=='yes')
		{
			
			if($values['gift_name']!='')
			{
				
				$phoen_upload_img = $values['phoen_upload_img'];
			
				wc_add_order_item_meta( $item_id,'Name To', $values['gift_name'] );

				wc_add_order_item_meta( $item_id,'Email To', $values['gift_email'] );
				
				if($values['phoen_gift_card_description']!='')
				{
					wc_add_order_item_meta( $item_id,'Gift Card Note', $values['phoen_gift_card_description'] );
				}
				
				if($values['phoen_gift_card_expiry_date']!='')
				{
					wc_add_order_item_meta( $item_id,'Gift Card Expiry Date', $values['phoen_gift_card_expiry_date'] );
				}
				
				update_post_meta($item_id,'name_to',$values['gift_name']);
				
				update_post_meta($item_id,'email_to',$values['gift_email']);
				
				update_post_meta($item_id,'phoen_gift_card_description',$values['phoen_gift_card_description']);
				
				update_post_meta($item_id,'phoen_gift_card_expiry_date',$values['phoen_gift_card_expiry_date']);
				
			}
			
		}	
	}
} 

/**
* save data in post meta
* when click on checkout in order page
*/	

add_action( 'woocommerce_checkout_order_processed', 'phoen_giftcard_click_on_checkout_action',  1, 1  );	

function phoen_giftcard_click_on_checkout_action( $order_id ){
	
	global $woocommerce;
	
	if($order_id!='')
	{
	
		$order = new WC_Order( $order_id );
		
		$items = $order->get_items();
		
		foreach ( $items as $item ) {
			
			$product_id = $item['product_id'];
		
		} 
		
		$order_for_status = wc_get_order($order_id);
		
		$phoen_order_status = $order_for_status->get_status();

		$current_user = wp_get_current_user();
		
		$cur_email = $current_user->user_email;
		
		$user_id = $current_user->ID;
		
		$user_firstname = $current_user->user_firstname;
		
		$user_lastname =  $current_user->user_lastname;
		
		$user_name =($user_firstname." ".$user_lastname);

		$phoen_product_make_giftcard_enable = get_post_meta( $product_id, '_product_make_giftcard', true );
			
		if($phoen_product_make_giftcard_enable=='yes')
		{
		
			$order_detail=get_post_meta($order_id);
			
			$phoen_gift_card_amount= $order_detail['_order_total'][0];
			
			$phoen_complited_date= $order_detail['_completed_date'][0];
			
			$phoen_gift_card_email_from= $order_detail['_billing_email'][0];
			
			$phoen_billing_first_name= $order_detail['_billing_first_name'][0];
			
			$phoen_billing_last_name= $order_detail['_billing_last_name'][0];
			
			$phoen_gift_card_form=($phoen_billing_first_name." ".$phoen_billing_last_name);
			
			$orders = new WC_Order( $order_id );
			
			$phoen_points_items = $orders->get_items();
			
			$phoen_array=array();
		
			foreach($phoen_points_items as $key=>$phoen_datas)
			{
				$item_id = $phoen_datas['order_item_id'];
				
				$pheon_item_id = $phoen_datas->get_id();
				
				$gift_name= get_post_meta($pheon_item_id,'name_to',true);
				
				$gift_email = get_post_meta($pheon_item_id,'email_to',true);
				
				$phoen_gift_card_description = get_post_meta($pheon_item_id,'phoen_gift_card_description',true);
				
				$phoen_gift_card_description=isset($phoen_gift_card_description)?$phoen_gift_card_description:'';
				
				$phoen_gift_card_expiry_date = get_post_meta($pheon_item_id,'phoen_gift_card_expiry_date',true);
				
				$phoen_gift_card_expiry_date=isset($phoen_gift_card_expiry_date)?$phoen_gift_card_expiry_date:'';
				
				$phoen_upload_img = get_post_meta($pheon_item_id,'phoen_upload_img',true);
				
				$item_total = $phoen_datas->get_subtotal();
				
				$product_name = $phoen_datas->get_name();
				
				$item_quantity = $phoen_datas->get_quantity(); 
				
				$length = 10;
				
				$characters = '0123456789';
				
				$charactersLength = strlen($characters);
				
				$randomString = '';
				
				for ($i = 0; $i < $length; $i++) {
					
					$randomString .= $characters[rand(0, $charactersLength - 1)];
					
				}
				
				$phoen_post_gift_card_data = array(
		
					  'post_title'    => $randomString,
					  
					  'post_status'   => 'publish',
					  
					  'post_author'   => 1,
					  
					  'post_type'     =>'phoen_gift_card',
					  
					  'comment_status' => 'open'
				 
				);
		
				$phoen_gift_card_id = wp_insert_post( $phoen_post_gift_card_data );
				
				$phoen_gift_card_meta_val = array(
					
					'phoen_gift_card_description'=>$phoen_gift_card_description,
					
					'phoen_gift_card_to'=>$gift_name,
					
					'phoen_gift_card_email_to'=>$gift_email,
					
					'phoen_gift_card_form'=>$phoen_gift_card_form,
					
					'phoen_gift_card_email_from'=>$phoen_gift_card_email_from,
					
					'phoen_gift_card_amount'=>$item_total,
					
					'phoen_gift_card_balance'=>$item_total,
					
					'phoen_gift_card_expiry_date'=>$phoen_gift_card_expiry_date,
					
					'phoen_gift_card_coupon_title'=>$randomString,
					
					'phoen_upload_img'=>$phoen_upload_img,
					
					'order_status'=>$phoen_order_status,
					
					'order_id'=>$order_id,
					
					'product_name'=>$product_name,
					
					'item_quantity'=>$item_quantity
				
				);
				
				update_post_meta($phoen_gift_card_id, "phoen_gift_card_meta_data", $phoen_gift_card_meta_val); 
				
				update_post_meta($phoen_gift_card_id, "phoen_gift_card_card_totle_amount", $item_total); 
			
			}
		
		}
			
		$order_detail=get_post_meta($order_id);
		
		$cart_discount = $order_detail['_cart_discount'][0];
		
		$cart_discount_tax = $order_detail['_cart_discount_tax'][0];
		
		$used_discount_amount =($cart_discount);
		
		$used_discount_amount_val =($cart_discount);
		
		$coupons_data = $order->get_items( 'coupon' );
		
		$phoen_reward_coupon_name='';	
			
		if (!empty($coupons_data)) {
			
			foreach ( $coupons_data as $item_id => $item_data ) {
			
				$phoen_reward_coupon_name = $item_data['name'];
			
			}
			
			$phoen_gift_posts_data = get_posts(array(
			
					'post_type'   => 'phoen_gift_card',
					
					'post_status' => 'publish',
					
					'posts_per_page' => -1,
				
				)
				
			);
			
			foreach($phoen_gift_posts_data as $keys=>$phoen_gift_posts_val){
				
				$phoen_gift_posts_id = $phoen_gift_posts_val->ID;
				
				$phoen_gift_post_titles = strtolower($phoen_gift_posts_val->post_title);
				$phoen_reward_coupon_name;
				
				if($phoen_gift_post_titles==$phoen_reward_coupon_name)
				{
					
					$phoen_gift_post_titless =$phoen_gift_posts_val->post_title;
					
					$phoen_gift_posts_ids = $phoen_gift_posts_val->ID;
					
					$phoen_get_meta_data = get_post_meta( $phoen_gift_posts_ids, 'phoen_gift_card_meta_data', true );
					
					$phoen_gift_card_amount = isset($phoen_get_meta_data['phoen_gift_card_amount'])?$phoen_get_meta_data['phoen_gift_card_amount']:'';
					
					$phoen_gift_card_expiry_date = isset($phoen_get_meta_data['phoen_gift_card_expiry_date'])?$phoen_get_meta_data['phoen_gift_card_expiry_date']:'';
					
					$phoen_coupan = get_post_meta($phoen_gift_posts_ids, "phoen_gift_card_amount_used",true); 
					
					if(empty($phoen_coupan))
					{
						update_post_meta($phoen_gift_posts_ids, "phoen_gift_card_amount_used", $used_discount_amount); 
						
						$totle_left_amount = $phoen_gift_card_amount;
						
					}else{
						
						$used_discount_amount = $phoen_coupan+$used_discount_amount;
						
						$totle_left_amount = $phoen_gift_card_amount-$phoen_coupan;
						
						update_post_meta($phoen_gift_posts_ids, "phoen_gift_card_amount_used", $used_discount_amount); 
						
					}
				
				}
				
			}
			
			if($phoen_gift_post_titless!='')
			{
				$dt = new DateTime();
				
				$phoen_order_dare = $dt->format('d-m-Y H:i:s');
				
				$phoen_customer_data=array(
				
						'order_id'=>$order_id,
						
						'user_id'=>$user_id,
						
						'user_email_id'=>$cur_email,
						
						'coupon_code'=>$phoen_gift_post_titless,
						
						'coupon_id'=>$phoen_gift_posts_ids,
						
						'use_amount'=>$used_discount_amount,
						
						'expiry_date'=>$phoen_gift_card_expiry_date,
						
						'order_date'=>$phoen_order_dare,
						
						'user_name'=>$user_name,
						
						'order_status'=>$phoen_order_status,
						
						'used_discount_amount_val'=>$used_discount_amount_val,
						
						'totale_left_amount'=>$totle_left_amount
						
				);
				
				update_post_meta($order_id, "phoen_gift_card_customer_report", $phoen_customer_data);
				
			}
		
			
		}
		
	}	
	
}

/**
* Add Coupon text Fields Before Cart Table
* To Apply Coupon
*/	

add_action( 'woocommerce_before_cart', 'phoen_gift_cart_action_woocommerce_before_cal_table', 10, 0);

function phoen_gift_cart_action_woocommerce_before_cal_table() {
	
	if(is_cart()){
	
		global $woocommerce, $post;
		
		$phoen_gift_posts_data = get_posts(array(
		
				'post_type'   => 'phoen_gift_card',
				
				'post_status' => 'publish',
				
				'posts_per_page' => -1,
				
			)
			
		);
			
		$phoen_apply_gift_coupon_val = ( isset( $_POST['phoen_apply_gift_coupon_val'] ) ? sanitize_text_field( $_POST['phoen_apply_gift_coupon_val'] ) : "" );
		
		$phoen_gift_post_titless='';
		
		foreach($phoen_gift_posts_data as $keys=>$phoen_gift_posts_val){
			
			$phoen_gift_posts_id = $phoen_gift_posts_val->ID;
			
			$phoen_gift_post_titles =$phoen_gift_posts_val->post_title;
			
			if($phoen_gift_post_titles==$phoen_apply_gift_coupon_val)
			{
				
				$phoen_gift_post_titless =$phoen_gift_posts_val->post_title;
				
			}

		}

		if(isset($_POST['phoen_apply_giftcard'])) 
		{
			
			if($phoen_apply_gift_coupon_val=='')
			{

				wc_print_notice( __( 'Please enter a coupon code..', 'woocommerce' ), 'error' );
				
			}else{
				
				if($phoen_gift_post_titless=='')
				{
					$mers = "Coupon "."'".$phoen_apply_gift_coupon_val."'"." does not exist!";
					
					wc_print_notice( __($mers, 'woocommerce' ), 'error' );
				}
			}
			
			$phoen_gift_card_amount = phoen_giftcard_user_totle_amounts();
			
			if ($phoen_gift_card_amount=='')
			{
				
			  wc_print_notice( __( 'You Have No Balance.', 'woocommerce' ), 'error' );
			   
			}
			
			if($phoen_gift_card_amount=='deactive')
			{
					$mersss = "Your Coupon "."'".$phoen_apply_gift_coupon_val."'"." is Deactivated!";
					
					wc_print_notice( __($mersss, 'woocommerce' ), 'error' );
			
			}
			
		}
			
			$phoen_gift_placeholder_text=  __( 'Gift Card', 'phoen-gift-card' );
			
			$phoen_gift_button_text= __( 'Apply Gift Card Coupon', 'phoen-gift-card' ); 
			
			?>
			
			<div class="phoen_apply_gift_coupon">
			
				<form method="post" action="">
				
					<?php  wp_nonce_field('phoen_gift_coupon_action', 'phoen_gift_coupon_name_fields'); ?>
					
					<input type="text" name="phoen_apply_gift_coupon_val" placeholder="<?php echo esc_attr($phoen_gift_placeholder_text) ;  ?>" class="input-text" id="phoen_apply_gift_coupon_val" value=""  />
					
					<input type="submit" class="button" name="phoen_apply_giftcard" value="<?php echo esc_attr($phoen_gift_button_text ); ?>" />
				
				</form>
			
			</div>

			<?php

	}
}

add_action('wp_head','phoen_gift_card_apply_action');

function phoen_gift_card_apply_action(){
	if (isset( $_POST['phoen_gift_coupon_name_fields'] ) && wp_verify_nonce( $_POST['phoen_gift_coupon_name_fields'], 'phoen_gift_coupon_action' )) {
		
		if(isset( $_POST['phoen_apply_giftcard']))
		{
			if(isset( $_POST['phoen_apply_gift_coupon_val']))
			{
			
				$phoen_gift_card_amount = phoen_giftcard_user_totle_amounts();
				
				if($phoen_gift_card_amount!='' && $phoen_gift_card_amount!='deactive')
				{
					add_action('woocommerce_after_calculate_totals', 'phoen_gift_cart_woo_add_cart_fee');
				}

			}
		}
	}
}


/**
* Add Coupon text Fields on chackout Page 
* To Apply Coupon
*/	

function phoen_apply_coupon_on_checkout_page() {
	
	global $woocommerce, $product;
	
	$phoen_gift_posts_data = get_posts(array(
	
			'post_type'   => 'phoen_gift_card',
			
			'post_status' => 'publish',
			
			'posts_per_page' => -1,
			
		)
		
	);
		
	$phoen_apply_gift_coupon_val = ( isset( $_POST['phoen_apply_gift_coupon_val'] ) ? sanitize_text_field( $_POST['phoen_apply_gift_coupon_val'] ) : "" );
	
	$phoen_gift_post_titless='';
	
	foreach($phoen_gift_posts_data as $keys=>$phoen_gift_posts_val){
		
		$phoen_gift_posts_id = $phoen_gift_posts_val->ID;
		
		$phoen_gift_post_titles =$phoen_gift_posts_val->post_title;
		
		if($phoen_gift_post_titles==$phoen_apply_gift_coupon_val)
		{
			
			$phoen_gift_post_titless =$phoen_gift_posts_val->post_title;
			
		}

	}
		
	if(isset( $_POST['phoen_apply_giftcard_cart']))
	{
		
		if($phoen_apply_gift_coupon_val=='')
		{

			wc_print_notice( __( 'Please enter a coupon code.', 'woocommerce' ), 'error' );
			
		}else{
			
			if($phoen_gift_post_titless=='')
			{
				$mers = "Coupon "."'".$phoen_apply_gift_coupon_val."'"." does not exist!";
				wc_print_notice( __($mers, 'woocommerce' ), 'error' );
			}
		}
		
		$phoen_gift_card_amount = phoen_giftcard_user_totle_amounts();
		
		if ($phoen_gift_card_amount=='')
		{
			
		  wc_print_notice( __( 'You Have No Balance.', 'woocommerce' ), 'error' );
		   
		}
		
		if($phoen_gift_card_amount=='deactive')
		{
			$mersss = "Your Coupon "."'".$phoen_apply_gift_coupon_val."'"." is Deactivated!";
			
			wc_print_notice( __($mersss, 'woocommerce' ), 'error' );
		}
		
	}
	
	$phoen_gift_placeholder_text=  __( 'Gift Card', 'phoen-gift-card' );
	
	$phoen_gift_button_text= __( 'Apply Gift Card Coupon', 'phoen-gift-card' ); 
	
	?>
	
	<div class="phoen_apply_gift_coupon">
	
		<form method="post" action="">
		
			<?php  wp_nonce_field('phoen_gift_coupon_chackout_action', 'phoen_gift_coupon_chackout_name_fields'); ?>
		
			<input type="text" name="phoen_apply_gift_coupon_val" placeholder="<?php echo esc_attr($phoen_gift_placeholder_text) ; ?>" class="input-text" id="phoen_apply_gift_coupon_val" value=""  />
			
			<input type="submit" class="button" name="phoen_apply_giftcard_cart" value="<?php echo esc_attr($phoen_gift_button_text) ;  ?>" />
		
		</form>
	
	</div>

	<?php

}

add_action( 'woocommerce_before_checkout_form', 'phoen_apply_coupon_on_checkout_page', 10 ); 

if (isset( $_POST['phoen_gift_coupon_chackout_name_fields'] ) && wp_verify_nonce( $_POST['phoen_gift_coupon_chackout_name_fields'], 'phoen_gift_coupon_chackout_action' )) {	
	
	if(isset( $_POST['phoen_apply_giftcard_cart']))
	{	
	
		if(isset( $_POST['phoen_apply_gift_coupon_val']))
		{
		
			$phoen_gift_card_amount = phoen_giftcard_user_totle_amounts();
				
			if($phoen_gift_card_amount!='' && $phoen_gift_card_amount!='deactive')
			{
				//add_action('woocommerce_calculate_totals', 'phoen_gift_cart_woo_add_cart_fee');
				add_action( 'woocommerce_after_calculate_totals', 'phoen_gift_cart_woo_add_cart_fee', 30 );
			}
		}
		
	}
}

/**
* This Function is use for 
*  Apply Coupon
*/	

function phoen_gift_cart_woo_add_cart_fee() {

	global $woocommerce;
  
	$phoen_gift_posts_data = get_posts(array(
	
			'post_type'   => 'phoen_gift_card',
			
			'post_status' => 'publish',
			
			'posts_per_page' => -1,
			
		)
		
	);
	
	$phoen_apply_gift_coupon_val = ( isset( $_POST['phoen_apply_gift_coupon_val'] ) ? sanitize_text_field( $_POST['phoen_apply_gift_coupon_val'] ) : "" );
	
	if($phoen_apply_gift_coupon_val!='')
	{
		
		$phoen_gift_post_title='';
		
		foreach($phoen_gift_posts_data as $keys=>$phoen_gift_posts_val){
			
			$phoen_gift_posts_id = $phoen_gift_posts_val->ID;
			
			$phoen_gift_post_titles =$phoen_gift_posts_val->post_title;
			
			$phoen_get_meta_data = get_post_meta( $phoen_gift_posts_id, 'phoen_gift_card_meta_data', true );
			
			if($phoen_gift_post_titles==$phoen_apply_gift_coupon_val)
			{
				
				$phoen_gift_post_title =$phoen_gift_posts_val->post_title;
				
				$phoen_gift_card_expiry_date = isset($phoen_get_meta_data['phoen_gift_card_expiry_date'])?$phoen_get_meta_data['phoen_gift_card_expiry_date']:'';
				
			}
			
		}
		
		$phoen_get_cou = get_option('gift_cart_coupon_options');
		
		$phoen_gift_card_amount = phoen_giftcard_user_totle_amounts();
		
		if($phoen_gift_post_title!='')
		{
			
			$coupon_code =$phoen_gift_post_title;
			
			if($phoen_gift_card_amount!='' && $phoen_gift_card_amount!='deactive'){
			   
				$amount = $phoen_gift_card_amount;
				
				$discount_type = 'fixed_cart'; // Type: fixed_cart, percent, fixed_product, percent_product
						
					$coupon = array(
					
						'post_title' => $coupon_code,
						
						'post_content' => '',
						
						'post_status' => 'publish',
						
						'post_author' => 1,
						
						'post_type'        => 'shop_coupon'
						
					);
									   
					$new_coupon_id = wp_insert_post( $coupon );
							   
				// Add meta
				update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
				
				update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
				
				update_post_meta( $new_coupon_id, 'individual_use', 'no' );
				
				update_post_meta( $new_coupon_id, 'product_ids', '' );
				
				update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
				
				update_post_meta( $new_coupon_id, 'usage_limit', '' );
				
				update_post_meta( $new_coupon_id, 'expiry_date', $phoen_gift_card_expiry_date );
				
				update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
				
				update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
			   
				// your coupon code here

				if ( $woocommerce->cart->has_discount( $coupon_code ) ) return;
			   
				$woocommerce->cart->add_discount( $coupon_code );
				
				update_option('gift_cart_coupon_options','apply_coupone_add');
				
			}else{
				
				WC()->cart->remove_coupon( $coupon_code );
				
			}
		}
	}
	
}
?>