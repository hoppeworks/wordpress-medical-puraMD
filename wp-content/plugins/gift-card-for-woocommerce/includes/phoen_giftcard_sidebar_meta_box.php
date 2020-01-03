<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *  This function is use for add custom meta box 
 *  to display on wp admin pannel
 */	

function phoen_giftcard_custom_meta_boxes() {
	
	add_meta_box( 'phoen_giftcard_first_section',  __('Gift Card Options','phoen-gift-card'), 'phoen_gift_card_first_metabox', 'phoen_gift_card','normal','core');
	
	add_meta_box('phoen_giftcard_second_section', __('Gift Card Status','phoen-gift-card'), 'phoen_gift_card_second_metabox', 'phoen_gift_card','side','core');

}

add_action('admin_init', 'phoen_giftcard_custom_meta_boxes' );


function remove_image_box() {
 
   remove_meta_box('postimagediv','phoen_gift_card','side');
 
}
add_action('do_meta_boxes', 'remove_image_box');
	
/**
 *  This function is use for add custom meta box 
 *  to display on wp admin pannel
 */		
	
function phoen_gift_card_first_metabox($post) {
		
	$phoen_gift_post_id='';	
	if (isset($_GET['action']) && isset($_GET['post'])) {

		$phoen_gift_post_id = isset($_GET['post'])?$_GET['post']:'';
		
		$phoen_get_meta_data = get_post_meta( $phoen_gift_post_id, 'phoen_gift_card_meta_data', true );
		
		$phoen_gift_card_amount_used = get_post_meta($phoen_gift_post_id, "phoen_gift_card_amount_used", true); 
	
		if($phoen_gift_card_amount_used!='')
		{
			$phoen_gift_balance = get_post_meta($phoen_gift_post_id, "phoen_gift_card_amount_used", true); 
			
		}else{
			
			$phoen_gift_balance = isset( $phoen_get_meta_data[ 'phoen_gift_card_amount' ] ) ? $phoen_get_meta_data[ 'phoen_gift_card_amount' ] : '';
			
		}
		
	}
	
	?>
	<div id="phoeniixx_gift_card_wrap_profile-page"  class=" phoeniixx_gift_card_profile_div">
	
		<?php  wp_nonce_field( 'phoen_gift_card'.$post->ID, 'phoen_giftcard_first_noncename'); 
		
			$phoen_title = get_the_title($post->ID);
		
		?>
		
		<table class="form-table">
			
			<tbody>	
	
				<tr class="phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Gift Amount','phoen-gift-card'); ?> </label>
						
					</th>
					
					<td>
					
						<input type="number" min="0" id="phoen_gift_card_amount" name="phoen_gift_card_amount" value="<?php echo esc_attr(isset($phoen_get_meta_data['phoen_gift_card_amount'])?$phoen_get_meta_data['phoen_gift_card_amount']:'' );  ?>">
						
						<input type="hidden" id="phoen_gift_card_balance" name="phoen_gift_card_balance" value="<?php echo esc_attr($phoen_gift_balance) ; ?>">
						
						<input type="hidden" id="phoen_gift_card_title" name="phoen_gift_card_title" value="<?php echo esc_attr($phoen_title) ; ?>">
					
					</td>
					
					
				</tr>
				
				<tr class="phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Gift Card Message','phoen-gift-card'); ?> </label>
						
					</th>
					
					<td>
					
						<textarea cols="22" rows="2"  id="phoen_gift_card_desc" name="phoen_gift_card_description"><?php echo esc_attr(isset($phoen_get_meta_data['phoen_gift_card_description'])?$phoen_get_meta_data['phoen_gift_card_description']:'' ); ?></textarea>
						
					</td>
					
				</tr>
				
				
				<tr class="phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Receiver Name','phoen-gift-card'); ?> </label>
						
						
					</th>
					
					<td>
					
						<input type="text"  id="phoen_gift_card_name_to" name="phoen_gift_card_name_to" value="<?php echo esc_attr(isset($phoen_get_meta_data['phoen_gift_card_to'])?$phoen_get_meta_data['phoen_gift_card_to']:'' ); ?>">
						
					</td>
					
					
				</tr>
				
				<tr class="phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Receiver Email','phoen-gift-card'); ?> </label>
						
					</th>
					
					<td>
					
						<input type="email"   id="phoen_gift_card_email_to" name="phoen_gift_card_email_to" value="<?php echo esc_attr(isset($phoen_get_meta_data['phoen_gift_card_email_to'])?$phoen_get_meta_data['phoen_gift_card_email_to']:''); ?>">
					
					</td>
					
					
				</tr>
				
				<tr class="phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Sender Name','phoen-gift-card'); ?> </label>
						
					</th>
					
					<td>
					
						<input type="text"   id="phoen_gift_card_name_form" name="phoen_gift_card_name_form" value="<?php echo esc_attr( isset($phoen_get_meta_data['phoen_gift_card_form'])?$phoen_get_meta_data['phoen_gift_card_form']:'' ); ?>">
						
					</td>
					
					
				</tr>
				
				<tr class="phoen-user-user-login-wrap">
		
					<th><label><?php _e('Sender Email','phoen-gift-card'); ?> </label></th>
					
					<td>
					
						<input type="email" id="phoen_gift_card_email_from" name="phoen_gift_card_email_from" value="<?php echo esc_attr( isset($phoen_get_meta_data['phoen_gift_card_email_from'])?$phoen_get_meta_data['phoen_gift_card_email_from']:'' ); ?>">
						
					</td>
					
				</tr>
				
				
				
				<tr class="phoen-user-user-login-wrap">
			
					<th><label><?php _e('Gift Card Expiry Date','phoen-gift-card'); ?> </label></th>
					
					<td>
					
						<input type="text"   class = "phoen_gift_expire_date" value="<?php echo esc_attr(isset($phoen_get_meta_data['phoen_gift_card_expiry_date'])?$phoen_get_meta_data['phoen_gift_card_expiry_date']:'' ); ?>" id="phoen_gift_card_expiry_date" name="phoen_gift_card_expiry_date">
						
					</td>
					
				</tr>
				
			</tbody>	
			
		</table>	
		
	</div>	
	
	<?php
	
	$cardd_created = get_post_meta($phoen_gift_post_id, "phoen_gift_card_card_created",true); 
	
	$phoen_giftcard_meta = get_post_meta($phoen_gift_post_id, "phoen_gift_card_side_box_meta",true); 
	
	$phoen_enable_email_auto_send = isset( $phoen_giftcard_meta[ 'phoen_enable_email_auto_send' ] ) ? $phoen_giftcard_meta[ 'phoen_enable_email_auto_send' ] : '';
		
	if($phoen_enable_email_auto_send=='1')
	{	
		
		$phoen_get_meta_data = get_post_meta( $phoen_gift_post_id, 'phoen_gift_card_meta_data', true );
		
		$phoen_gift_card_amount = isset( $phoen_get_meta_data[ 'phoen_gift_card_amount' ] ) ? $phoen_get_meta_data[ 'phoen_gift_card_amount' ] : '';
		
		$phoen_gift_card_title = isset( $phoen_get_meta_data[ 'phoen_gift_card_title' ] ) ? $phoen_get_meta_data[ 'phoen_gift_card_title' ] : '';
		
		$phoen_gift_card_description = isset( $phoen_get_meta_data[ 'phoen_gift_card_description' ] ) ? $phoen_get_meta_data[ 'phoen_gift_card_description' ] : '';
		
		$phoen_gift_card_name_to = isset( $phoen_get_meta_data[ 'phoen_gift_card_to' ] ) ? $phoen_get_meta_data[ 'phoen_gift_card_to' ] : '';
		
		$phoen_gift_card_email_to = isset( $phoen_get_meta_data[ 'phoen_gift_card_email_to' ] ) ? $phoen_get_meta_data[ 'phoen_gift_card_email_to' ] : '';
		
		$phoen_gift_card_name_form = isset( $phoen_get_meta_data[ 'phoen_gift_card_form' ] ) ? $phoen_get_meta_data[ 'phoen_gift_card_form' ] : '';
		
		$phoen_gift_card_email_from = isset( $phoen_get_meta_data[ 'phoen_gift_card_email_from' ] ) ? $phoen_get_meta_data[ 'phoen_gift_card_email_from' ] : '';
		
		$phoen_gift_card_expiry_date = isset( $phoen_get_meta_data[ 'phoen_gift_card_expiry_date' ] ) ? $phoen_get_meta_data[ 'phoen_gift_card_expiry_date' ] : '';
		
		if($phoen_gift_card_expiry_date=='')
		{
			$phoen_gift_card_expiry_date="-";
		}

		$phoen_gift_card_form_name_title=  __( 'Sender Name', 'phoen-gift-card' );
		
		$phoen_gift_card_email_from_title= __( 'Sender EmailID', 'phoen-gift-card' ); 
		
		$subject =  __( 'Gift Card For You', 'phoen-gift-card' );
		
		$phoen_amount_title =  __( 'Gift Card Amount', 'phoen-gift-card' ); 
		
		$phoen_expdate_title =  __( 'Gift Card Expiry Date', 'phoen-gift-card' ); 
		
		$phoen_code_title =  __( 'Gift Card Code', 'phoen-gift-card' ); 
		
		$hoen_ticket_email_to = $phoen_gift_card_email_to;
		
		$phoen_currency_symbol=get_woocommerce_currency_symbol();
		
		$headers = array('Content-Type: text/html; charset=UTF-8');
			
		$phoen_giftcard_msg = '<table width="600" cellspacing="0" cellpadding="0" border="0" style="background-color:#fdfdfd;border:1px solid #dcdcdc;border-radius:3px!important" id="template_container">
			<tbody>
				<tr>
					<td valign="top" align="center">					
						<table width="600" cellspacing="0" cellpadding="0" border="0" style="background-color:#557da1;border-radius:3px 3px 0 0!important;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif" id="template_header">
							<tbody>
								<tr>
									<td style="padding:36px 48px;display:block" id="header_wrapper">
										<h1 style="color:#ffffff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left">'.$subject.'</h1>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top" align="center">
											
						<table width="600" cellspacing="0" cellpadding="0" border="0" id="template_body"><tbody>
							<tr>
								<td valign="top" style="background-color:#fdfdfd" id="body_content">
															
									<table width="100%" cellspacing="0" cellpadding="20" border="0">
										<tbody>
											<tr>
												<td valign="top" style="padding:48px 48px 0">
													<div style="color:#737373;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left" id="body_content_inner">


															<p style="margin:0 0 16px">'.$phoen_gift_card_description.'</p>

															<h2 style="color:#557da1;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left"><span>'.$phoen_code_title.'</span>:- <span>'.$phoen_title.'</span></h2>
															
														<table cellspacing="0" cellpadding="6" border="1" style="width:100%;margin-bottom:40px;color:#737373;border:1px solid #e4e4e4" class="td">
										
															<tbody>
			
																<tr>
																	<th style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px" colspan="2" scope="row" class="td">'.$phoen_amount_title.'</th>
																	<td style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px" class="td"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.$phoen_currency_symbol.'</span>'.$phoen_gift_card_amount.'</span></td>
																</tr>
															</tbody>
															
															<tbody>
			
																<tr>
																	<th style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px" colspan="2" scope="row" class="td">'.$phoen_expdate_title.'</th>
																	<td style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px" class="td"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>'.$phoen_gift_card_expiry_date.'</span></td>
																</tr>
															</tbody>
															
														</table>
														<table cellspacing="0" cellpadding="0" border="0" style="width:100%;vertical-align:top;margin-bottom:40px;padding:0" id="addresses">
															<tbody>
															<tr>
																<td width="50%" valign="top" style="text-align:left;border:0;padding:0">
																	<h2 style="color:#557da1;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">From</h2>
																	<p style="margin:0 0 16px">'.$phoen_gift_card_name_form.'</p>
																	<p style="margin:0 0 16px">'.$phoen_gift_card_email_from.'</p>
																</td>
																</tr>
															</tbody>
														</table>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					</td>
				</tr>
			</tbody>
		</table>';

		wp_mail( $hoen_ticket_email_to, $subject,$phoen_giftcard_msg,$headers);
	
	}	
}

function phoen_gift_card_second_metabox($post) {
			
	$phoen_giftcard_meta = get_post_meta($post->ID, "phoen_gift_card_side_box_meta",true); 
	
	$phoen_enable_email_auto_send = isset( $phoen_giftcard_meta[ 'phoen_enable_email_auto_send' ] ) ? $phoen_giftcard_meta[ 'phoen_enable_email_auto_send' ] : '';
	
	$phoen_select_status = isset( $phoen_giftcard_meta[ 'phoen_select_status' ] ) ? $phoen_giftcard_meta[ 'phoen_select_status' ] : '';
	
	$phoen_upload_images_id = isset( $phoen_giftcard_meta[ 'phoen_upload_images_id' ] ) ? $phoen_giftcard_meta[ 'phoen_upload_images_id' ] : '';
	
	?>
	
	<div id="phoeniixx_gift_card_wrap_profile-page"  class=" phoeniixx_gift_card_profile_div">
	
		<?php wp_nonce_field( 'phoen_gift_card'.$post->ID, 'phoen_giftcard_second_noncename'); ?>
		
		<table class="form-table">
			
			<tbody>	

				<tr class="phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Gift Card Status','phoen-gift-card'); ?> </label>
						
					</th>
					
					<td>
					
						<select class="phoen_select_status" name="phoen_select_status">
						
							<option value="active" <?php if($phoen_select_status=="active" || $phoen_select_status==''){ echo "selected" ; }?> ><?php _e('Active','phoen-gift-card'); ?> </option>
							
							<option value="deactive" <?php if($phoen_select_status=="deactive"){ echo "selected" ; }?> ><?php _e('Deactive','phoen-gift-card'); ?> </option>
						
						</select>
						
					</td>
					
				</tr>
				
				<tr class="phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Enable To Send Email','phoen-gift-card'); ?> </label>
						
					</th>
					
					<td>
					
						<input type="checkbox"  name="phoen_enable_email_auto_send" id="phoen_enable_email_auto_send" value="1" <?php echo(isset($phoen_giftcard_meta['phoen_enable_email_auto_send']) && $phoen_giftcard_meta['phoen_enable_email_auto_send'] == '1')?'checked':'';?>>
					
					</td>
					
				</tr>
				
			</tbody>		
				
		</table>	
			
	</div>	
	
	<?php
}
	
/**
 *  This function is use for Save custom meta box data
 *  to display on wp admin pannel
 */		
function save_metabox_data($post_id) {
	
	if(isset($_POST['phoen_giftcard_first_noncename']))
	{
	
		if ( !wp_verify_nonce( $_POST['phoen_giftcard_first_noncename'], 'phoen_gift_card'.$post_id) || !wp_verify_nonce( $_POST['phoen_giftcard_second_noncename'], 'phoen_gift_card'.$post_id )) {
		return $post_id;
		}
	}
	$post = get_post($post_id);
	
	if ($post->post_type == 'phoen_gift_card') {
	
		$phoen_gift_card_description = ( isset( $_POST['phoen_gift_card_description'] ) ? sanitize_text_field( $_POST['phoen_gift_card_description'] ) : "" );
		
		$phoen_gift_card_name_to = ( isset( $_POST['phoen_gift_card_name_to'] ) ? sanitize_text_field( $_POST['phoen_gift_card_name_to'] ) : "" );
		
		$phoen_gift_card_email_to = ( isset( $_POST['phoen_gift_card_email_to'] ) ? sanitize_text_field( $_POST['phoen_gift_card_email_to'] ) : "" );
		
		$phoen_gift_card_name_form = ( isset( $_POST['phoen_gift_card_name_form'] ) ? sanitize_text_field( $_POST['phoen_gift_card_name_form'] ) : "" );
		
		$phoen_gift_card_email_from = ( isset( $_POST['phoen_gift_card_email_from'] ) ? sanitize_text_field( $_POST['phoen_gift_card_email_from'] ) : "" );
		
		$phoen_gift_card_amount = ( isset( $_POST['phoen_gift_card_amount'] ) ? sanitize_text_field( $_POST['phoen_gift_card_amount'] ) : "" );
		
		$phoen_gift_card_balance = ( isset( $_POST['phoen_gift_card_balance'] ) ? sanitize_text_field( $_POST['phoen_gift_card_balance'] ) : "" );
		
		$phoen_gift_card_expiry_date = ( isset( $_POST['phoen_gift_card_expiry_date'] ) ? sanitize_text_field( $_POST['phoen_gift_card_expiry_date'] ) : "" );
		
		$the_title=the_title();
		
		$phoen_gift_card_meta_val = array(
		
				'phoen_gift_card_description'=>$phoen_gift_card_description,
				
				'phoen_gift_card_to'=>$phoen_gift_card_name_to,
				
				'phoen_gift_card_email_to'=>$phoen_gift_card_email_to,
				
				'phoen_gift_card_form'=>$phoen_gift_card_name_form,
				
				'phoen_gift_card_email_from'=>$phoen_gift_card_email_from,
				
				'phoen_gift_card_amount'=>$phoen_gift_card_amount,
				
				'phoen_gift_card_balance'=>$phoen_gift_card_balance,
				
				'phoen_gift_card_expiry_date'=>$phoen_gift_card_expiry_date,
				
				'phoen_upload_img'=>'',
				
				'order_status'=>'wc-completed'
		
		);
	
		update_post_meta($post_id, "phoen_gift_card_meta_data", $phoen_gift_card_meta_val); 
		
		update_post_meta($post_id, "phoen_gift_card_card_totle_amount", $phoen_gift_card_amount); 
		
		$phoen_select_status = ( isset( $_POST['phoen_select_status'] ) ? sanitize_text_field( $_POST['phoen_select_status'] ) : "" );
		
		$phoen_enable_email_auto_send = ( isset( $_POST['phoen_enable_email_auto_send'] ) ? sanitize_text_field( $_POST['phoen_enable_email_auto_send'] ) : "" );
		
		$phoen_gift_arrray = array(
			
			'phoen_select_status'=>$phoen_select_status,
			
			'phoen_enable_email_auto_send'=>$phoen_enable_email_auto_send,
		
		);	
		
		update_post_meta($post_id, "phoen_gift_card_side_box_meta", $phoen_gift_arrray); 
		
	}
	
	return $post_id;
	
}
add_action("save_post", "save_metabox_data", 10, 3);
?>