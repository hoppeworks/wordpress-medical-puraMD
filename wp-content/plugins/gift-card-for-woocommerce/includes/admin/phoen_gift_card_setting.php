<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !current_user_can( 'manage_options' ) ){ die(); }

if ( ! empty( $_POST ) && wp_verify_nonce( ($_POST['phoen_giftcard_form_action_form_nonce_field']),'phoen_giftcard_form_action' ) ) {

	if(sanitize_text_field($_POST['phoen_giftcard_submit'] )){
		
	   $enable_giftcard_plugin = ( isset( $_POST['enable_giftcard_plugin'] ) ? sanitize_text_field( $_POST['enable_giftcard_plugin'] ) : "" );
	   
	   $enable_myaccount_giftcard_plugin = ( isset( $_POST['enable_myaccount_giftcard_plugin'] ) ? sanitize_text_field( $_POST['enable_myaccount_giftcard_plugin'] ) : "" );
	   
	  	$phoen_gift_coupan_expirey_month = ( isset( $_POST['phoen_gift_coupan_expirey_month'] ) ? sanitize_text_field( $_POST['phoen_gift_coupan_expirey_month'] ) : "" );

		$phoe_giftcard_values = array(
		
			'enable_giftcard_plugin'=>$enable_giftcard_plugin,
			
			'enable_myaccount_giftcard_plugin'=>$enable_myaccount_giftcard_plugin,
			
			'phoen_gift_coupan_expirey_month'=>$phoen_gift_coupan_expirey_month
		
		);
		
		update_option('phoe_giftcard_value',$phoe_giftcard_values);
	
	}
	
}

$phoen_giftcard_settings = get_option('phoe_giftcard_value');

$enable_giftcard_plugin=isset($phoen_giftcard_settings['enable_giftcard_plugin'])?$phoen_giftcard_settings['enable_giftcard_plugin']:'';

$enable_myaccount_giftcard_plugin=isset($phoen_giftcard_settings['enable_myaccount_giftcard_plugin'])?$phoen_giftcard_settings['enable_myaccount_giftcard_plugin']:'';

$phoen_expirey_month = isset($phoen_giftcard_settings['phoen_gift_coupan_expirey_month'])?$phoen_giftcard_settings['phoen_gift_coupan_expirey_month']:'' ;

 ?>
<div id="profile-page" class="wrap">
		
				<?php
					if(isset($_GET['tab']))
						
					{
						$tab = sanitize_text_field( $_GET['tab'] );
						
					}
					else
						
					{
						
						$tab="";
						
					}
					
				?>
				<h2> <?php _e(' Gift Card For Woocommerce','phoen-rewpts'); ?></h2>
				
				<?php $tab = (isset($_GET['tab']))?$_GET['tab']:'';?>
				
				<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
				
					<a class="nav-tab <?php if($tab == 'phoen_general_styling' || $tab == ''){ echo esc_html( "nav-tab-active" ); } ?>" href="?post_type=phoen_gift_card&page=settings&amp;tab=phoen_general_styling"><?php _e('Settings','phoen-rewpts'); ?></a>
					<a class="nav-tab <?php if($tab == 'phoen_gift_premium'){ echo esc_html( "nav-tab-active" ); } ?>" href="?post_type=phoen_gift_card&page=settings&amp;tab=phoen_gift_premium"><?php _e('Premium','phoen-rewpts'); ?></a>
				
					
				</h2>
				
			</div>
			<?php if($tab == 'phoen_general_styling'|| $tab == ''){ ?>
<div id="phoeniixx_phoe_gift_card_wrap_profile-page"  class=" phoeniixx_phoe_giftcard_wrap_profile_div">
	
	<h3><?php _e('General Settings','phoen-rewpts'); ?></h3>
	
	<form id="phoeniixx_phoe_giftcard_wrap_profile_form" action="" method="POST" enctype="multipart/form-data" >
	
		<?php wp_nonce_field( 'phoen_giftcard_form_action', 'phoen_giftcard_form_action_form_nonce_field' ); ?>
		
		<table class="form-table">
			
			<tbody>	
	
				<tr class="phoeniixx_phoe_gift_card_wrap phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Enable Gift Card','phoen-gift-card'); ?> </label>
						
					</th>
					
					<td>
					
						<input type="checkbox"  name="enable_giftcard_plugin" id="enable_giftcard_plugin" value="1" <?php echo esc_attr( (isset($phoen_giftcard_settings['enable_giftcard_plugin']) && $phoen_giftcard_settings['enable_giftcard_plugin'] == '1')?'checked':'');?>>
						
					</td>
					
				</tr>
				
				<tr class="phoeniixx_phoe_gift_card_wrap phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Enable Gift Card Details On My Account Page','phoen-gift-card'); ?> </label>
						
					</th>
					
					<td>
					
						<input type="checkbox"  name="enable_myaccount_giftcard_plugin" id="enable_myaccount_giftcard_plugin" value="1" <?php echo esc_attr((isset($phoen_giftcard_settings['enable_myaccount_giftcard_plugin']) && $phoen_giftcard_settings['enable_myaccount_giftcard_plugin'] == '1')?'checked':'' );?>>
						
					</td>
					
				</tr>
				
				<tr class="phoeniixx_phoe_gift_card_wrap phoen-user-user-login-wrap">
				
					<th>
						<label><?php _e('Coupon Expiry Month','phoen-gift-card'); ?></label>
					</th>
					
					<td>
					
						<input type="number" min="0" step="any" name="phoen_gift_coupan_expirey_month" class="phoen_gift_coupan_expirey_month" value="<?php echo esc_attr($phoen_expirey_month) ; ?>" > 
						
					</td>
					
				</tr>
				
				<tr class="phoeniixx_phoe_gift_card_wrap phoen-user-user-login-wrap">
				
					<td colspan="2">
					
						<input type="submit" value="<?php _e('Save','phoen-gift-card'); ?>" name="phoen_giftcard_submit" id="submit" class="button button-primary">
					
					</td>
					
				</tr>
				
			</tbody>
			
		</table>
		
	</form>
	
			</div><?php }else{
				include_once(plugin_dir_path(  __FILE__).'phoeniixx_premium_styling.php');
			}