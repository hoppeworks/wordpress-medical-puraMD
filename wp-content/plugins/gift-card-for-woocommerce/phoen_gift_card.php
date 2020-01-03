<?php
/*
** Plugin Name: Gift Card For Woocommerce

** Plugin URI: https://www.phoeniixx.com/product/giftcard-for-woocommerce/

** Description: A gift card is the best gift because you can send it along with a message conveying your best wishes and the receiver can redeem them on any e-commerce website in exchange for a product of their choice against the value indicated on the card.

** Version: 1.2.8

** Author: phoeniixx

** Text Domain: phoen-gift-card

** Domain Path: /languages/

** Author URI: http://www.phoeniixx.com/

** License: GPLv2 or later

** License URI: http://www.gnu.org/licenses/gpl-2.0.html

** WC requires at least: 2.6.0

** WC tested up to: 3.8.0

**/  

if ( ! defined( 'ABSPATH' ) ) exit;

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	define('PHOENI_GIFT_CARD_ARBPRPLUGURL',plugins_url(  "/", __FILE__));
	
	define('PHOENI_GIFT_CARD_ARBPRPLUG_PATH',plugin_dir_path(  __FILE__));

	/**
    * This function use for enqueue 
    * css js on frontend and backend
    */	
	
	add_action('wp_head','phoen_gift_card_product_script_function');

	function phoen_gift_card_product_script_function(){
		
		if ( is_product() ){
			
			wp_enqueue_script( 'phoen_gift_custom_js1',PHOENI_GIFT_CARD_ARBPRPLUGURL. "assets/js/phoen_gift_card_custom1.js",array('jquery'), false,  true );

		}
		
		wp_enqueue_style( 'phoen_gift_frontend_css',PHOENI_GIFT_CARD_ARBPRPLUGURL. "assets/css/gift-card.css", false );
		
	}

	add_action('admin_head','phoen_giftcard_datepicker_ajax_admin_function');
	
	function phoen_giftcard_datepicker_ajax_admin_function(){
	
		$phoen_get_page = get_current_screen();
		
		$phoen_post_name = $phoen_get_page->post_type;
		
		if($phoen_post_name=='phoen_gift_card')
		{
	
			wp_enqueue_style( 'phoen_gift_datepick_css',PHOENI_GIFT_CARD_ARBPRPLUGURL. "assets/css/datetimepicker.css", false );
			
			wp_enqueue_script( 'phoen_gift_dateadmin_js',PHOENI_GIFT_CARD_ARBPRPLUGURL. "assets/js/phoen_datetimepic.js",array('jquery'), false,  true );
			
			wp_enqueue_script( 'phoen_gift_admin_js',PHOENI_GIFT_CARD_ARBPRPLUGURL. "assets/js/phoen_gift_card_admin.js",array('jquery'), false,  true );
			
		}

		wp_enqueue_script( 'phoen_gift_custom_js2',PHOENI_GIFT_CARD_ARBPRPLUGURL. "assets/js/phoen_gift_card_custom2.js",array('jquery'), false,  true );
		
		wp_localize_script('phoen_gift_custom_js2', 'gift_card_check', array('ajaxurl' =>  admin_url('admin-ajax.php')));
		
		wp_enqueue_style( 'phoen_gift_backend_css',PHOENI_GIFT_CARD_ARBPRPLUGURL. "assets/css/gift-card.css", false );
		
	} 
	
	$phoen_giftcard_settings = get_option('phoe_giftcard_value');
	
	$enable_giftcard_plugin=isset($phoen_giftcard_settings['enable_giftcard_plugin'])?$phoen_giftcard_settings['enable_giftcard_plugin']:'';
	
	if($enable_giftcard_plugin==1){
		
		add_action('init','phoen_add_all_gift_card_function');
		
		
	}
	/**
    * This function use for save custom meta box 
    * data in array using post meta
    */	
	
	function phoen_add_all_gift_card_function()
	{
		include_once(PHOENI_GIFT_CARD_ARBPRPLUG_PATH.'includes/phoen_product_giftcard.php');
		
		include_once(PHOENI_GIFT_CARD_ARBPRPLUG_PATH.'includes/phoen_giftcard_frontend.php');
		
		include_once(PHOENI_GIFT_CARD_ARBPRPLUG_PATH.'includes/phoen_giftcard_sidebar_meta_box.php');
		
	}
	
	$enable_myaccount_giftcard_plugin=isset($phoen_giftcard_settings['enable_myaccount_giftcard_plugin'])?$phoen_giftcard_settings['enable_myaccount_giftcard_plugin']:'';

	if($enable_giftcard_plugin == 1 && $enable_myaccount_giftcard_plugin=='1')
	{
		
		add_action('woocommerce_account_content','phoen_giftcard_custm_report');
	
	}
	
	add_action( 'init', 'phoen_gift_card_custom_post_type', 0 );
		
	add_filter( 'manage_edit-phoen_gift_card_columns', 'phoen_gift_my_columns_filter',10, 1 );
	
	add_action( 'manage_phoen_gift_card_posts_custom_column', 'phoen_gift_card_val_custom_columns', 2 );

	add_action( 'woocommerce_order_status_changed', 'phoen_gift_card_mail');
	
	/**
    * Add Custom Post Type 
    * For Gift Catd 
    */	

	function phoen_gift_card_custom_post_type() {
		
		register_post_type( 'phoen_gift_card',
			array(
				'labels' => array(
					'name'                => _x( 'Gift Cards', 'Gift Cards', 'phoen-gift-card' ),
					'singular_name'         => __( 'Gift Card', 'phoen-gift-card' ),
					'menu_name'             => _x( 'Gift Cards', 'Admin menu name', 'phoen-gift-card' ),
					'add_new'               => __( 'Add Gift Card', 'phoen-gift-card' ),
					'add_new_item'          => __( 'Add New Gift Card', 'phoen-gift-card' ),
					'edit'                  => __( 'Edit', 'phoen-gift-card' ),
					'edit_item'             => __( 'Edit Gift Card', 'phoen-gift-card' ),
					'new_item'              => __( 'New Gift Card', 'phoen-gift-card' ),
					'not_found_in_trash'    => __( 'No Gift Cards found in trash', 'phoen-gift-card' ),
					'parent'                => __( 'Parent Gift Card', 'phoen-gift-card' ),
					'search_items'          => __( 'Search Gift Cards', 'phoen-gift-card' ),
					'view'                  => __( 'View Gift Cards', 'phoen-gift-card' ),
					'view_item'             => __( 'View Gift Card', 'phoen-gift-card' ),
					'not_found'             => __( 'No Gift Cards found', 'phoen-gift-card' )
				),

				'public'                => true,
				'show_ui'             => true,
				'has_archive'           => true,
				'publicly_queryable'    => false,
				'exclude_from_search'   => false,
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'show_in_menu'          => true,
				'menu_position'      => 56,
				'hierarchical'          => false,
				'menu_icon'          => PHOENI_GIFT_CARD_ARBPRPLUGURL.'assets/images/aaa2.png',
				'supports'              => array( 'title', 'comments','thumbnail' )
			
			)
			
		);

	}
	
	

	/**
    * Change 
    * Table title
    */	

	function phoen_gift_my_columns_filter( $columns ) {
		
	   unset($new_columns['title']);
	   
	   unset($new_columns['date']);
	   
	   unset($new_columns['tags']);
	   
	   unset($new_columns['comments']);
	   
		$new_columns["cb"] = ("<input type=\"checkbox\" />");
		
		$new_columns["title"]       = __( 'Gift Card Number', 'phoen-gift-card' );
		
		$new_columns["gift_amount"]      = __( 'Amount', 'phoen-gift-card' );
		
		$new_columns["gift_amount_redeme"]  = __( 'Redeem', 'phoen-gift-card' );
		
		$new_columns["gift_balance"]     = __( 'Balance', 'phoen-gift-card' );
		
		$new_columns["gift_buyer"]       = __( 'Buyer Information', 'phoen-gift-card' );
		
		$new_columns["gift_recipient"]   = __( 'Recipient Information', 'phoen-gift-card' );
		
		$new_columns["gift_expiry_date"] = __( 'Gift Card Expiry Date', 'phoen-gift-card' );
		
		$new_columns["gift_stasus"] = __( 'Gift Card Status', 'phoen-gift-card' );
		
		$new_columns['date']        = __( 'Date', 'phoen-gift-card' ); 
		
		return  apply_filters( 'phoen_apply_gift_card', $new_columns);
	   
	}
	
	/**
    * activation time
    * update option
    */	
	
	register_activation_hook( __FILE__, 'phoe_gift_card_activation_func');
	
	function phoe_gift_card_activation_func() 	{
		
	
		$phoen_giftcard_settings = get_option('phoe_giftcard_value');
		
		if(empty($phoen_giftcard_settings)){
			
			
			$phoe_giftcard_values = array(
	
				'enable_giftcard_plugin'=>1,
				
				'enable_myaccount_giftcard_plugin'=>1,
				
				'phoen_gift_coupan_expirey_month'=>'0'
			
			);
			 
			update_option('phoe_giftcard_value',$phoe_giftcard_values);
	
		}		

	}
	
	/**
    * Add Admin Menu For
    * user details Settings
    */	
	
	add_action('admin_menu' , 'phoen_gift_card_user_detaisl'); 
	
	function phoen_gift_card_user_detaisl() {
		
		add_submenu_page('edit.php?post_type=phoen_gift_card', 'settings', __( 'Settings', 'phoen-gift-card' ), 'manage_options', 'settings', 'phoen_gift_card_user_settings');
		
	} 
	
	function phoen_gift_card_user_settings()
	{	
		include_once(PHOENI_GIFT_CARD_ARBPRPLUG_PATH.'includes/admin/phoen_gift_card_setting.php');
	}
	

	 /**
	 * change 
	 * placeholder of title
	 */
		
	function phoen_gift_card_change_title_text( $title ){
		
		 $screen = get_current_screen();
	  
		 if  ( 'phoen_gift_card' == $screen->post_type ) {
			 
			  $title = __( 'Enter gift card code here', 'phoen-gift-card' );
			  
		 }

		return $title;
	}
	  
	add_filter( 'enter_title_here', 'phoen_gift_card_change_title_text' );
		
	/**
	 * Create custom
	 * product type post class
	 */
	 
	add_action( 'plugins_loaded', 'phoen_gift_card_custom_product_post_type' );
	
	function phoen_gift_card_custom_product_post_type () {
		class WC_Product_Gift_Card extends WC_Product {
			public function __construct( $product ) {
				$this->product_type = 'gift_card'; // name of your custom product type
				$this->virtual = 'yes';
				parent::__construct( $product );
			
			}
		}
	}	 

	/**
	 *  Replace price html on
	 *  singal product page
	 */	

	function phoen_gift_card_change_product_price_display( $price,$product ) {
		
		 global $post, $product ;
		 
		if($product->get_type()=='gift_card'){
			
			$price ='';
			
			$phoen_product_make_giftcard_enable = get_post_meta( $post->ID, '_product_make_giftcard', true );

			if($phoen_product_make_giftcard_enable=='yes')
			{
				$phoe_currency_symbol=get_woocommerce_currency_symbol();
				
				$phoen_price_val=$phoe_currency_symbol."0";
				
				$get_price = get_post_meta ( $post->ID, '_product_giftcard_prices' );
				
				$get_price2 = get_post_meta ( $post->ID	, '_product_giftcard_prices' );
					
				if($get_price!='')
				{
					$phoen_first_price= $get_price[0];
					
					$phoen_first_price_val = min($phoen_first_price);
					
				}
				
				if($get_price2!='')
				{
					$phoen_end_price1 = $get_price2[0];  
					
					if(!empty($phoen_end_price1))
					{
						
						$phoen_end_price = max($phoen_end_price1);
					}
					
				}
				
				$price1 = wc_price($phoen_first_price_val);
				
				$price2 = wc_price($phoen_end_price);
				
				$pricec = $price1 ."-". $price2;
				if($phoen_first_price_val == $phoen_end_price){
					$price .=  '<span class="phoen_prosub_price-format">'.$price1.'</span>';  
				}else{
					$price .=  '<span class="phoen_prosub_price-format">'.$pricec.'</span>';  
				}
				
			}
		}
		return $price;
	}
	
	add_filter( 'woocommerce_get_price_html', 'phoen_gift_card_change_product_price_display' ,10,2);

	/**
	 *  This function use for
	 *  display a gift table data 
	 */	

	function phoen_gift_card_val_custom_columns( $column ) {
		
		global $post;
		
		$phoen_gift_price = "0.00";
		$phoen_gift_balance = "";
		$phoen_meta_data = get_post_meta( $post->ID, 'phoen_gift_card_meta_data', true );
		
		$phoen_meta_data_balances = get_post_meta($post->ID, "phoen_gift_card_amount_used",true); 
		
		$phoen_giftcard_meta = get_post_meta($post->ID, "phoen_gift_card_side_box_meta",true); 
		
		switch ( $column ) {

			// display a gift  gift_amount data in table 
			case 'gift_amount' :
			
			$phoen_gift_price = isset( $phoen_meta_data[ 'phoen_gift_card_amount' ])? $phoen_meta_data[ 'phoen_gift_card_amount' ] : '0';
			
			echo wc_price( $phoen_gift_price );
			
			break;
			  
			  // display a redeem amount data in table 
			  
			case 'gift_amount_redeme' :
			
			if($phoen_meta_data_balances=='')
			{
				$phoen_gift_price = "0.00";
			
			}else{ 
			
				$phoen_gift_price = $phoen_meta_data_balances;
			}
			
			echo wc_price( $phoen_gift_price );
			
			break;

			// display a gift  gift_balance data in table 
			
			case 'gift_balance' :

			$phoen_gift_card_balance = isset( $phoen_meta_data[ 'phoen_gift_card_balance' ] ) ? $phoen_meta_data[ 'phoen_gift_card_balance' ] : '0';
			  
			if($phoen_meta_data_balances!='')
			{
			  $phoen_gift_balance = (isset( $phoen_meta_data[ 'phoen_gift_card_amount' ]) && is_numeric($phoen_meta_data[ 'phoen_gift_card_amount' ])) ? $phoen_meta_data[ 'phoen_gift_card_amount' ] : '0';
			  
			  $phoen_gift_balance=($phoen_gift_balance-$phoen_meta_data_balances);
			  
			  if ($phoen_gift_balance < 0)
				{
				   $phoen_gift_balance="0.00";
				}
				
			}else{
				
			   $phoen_gift_balance =(isset( $phoen_meta_data[ 'phoen_gift_card_amount' ]) && is_numeric($phoen_meta_data[ 'phoen_gift_card_amount' ])) ? $phoen_meta_data[ 'phoen_gift_card_amount' ] : '0';
			   
			}
			
			echo wc_price( $phoen_gift_balance );
			
			break;
			
			// display a gift  gift_buyer name and email data in table 
			
			case 'gift_buyer' :
			
			echo '<div><strong>' . esc_html( isset( $phoen_meta_data[ 'phoen_gift_card_form' ] ) ? $phoen_meta_data[ 'phoen_gift_card_form' ] : '' ) . '</strong><br />';
			
			echo '<span>' . esc_html( isset( $phoen_meta_data[ 'phoen_gift_card_email_from' ] ) ? $phoen_meta_data[ 'phoen_gift_card_email_from' ] : '' ) . '</div>';
			
			break;
			  
			// display a gift  gift_recipient name and email data in table 
				
			case 'gift_recipient' :
			
			echo '<div><strong>' . esc_html( isset( $phoen_meta_data[ 'phoen_gift_card_to' ] ) ? $phoen_meta_data[ 'phoen_gift_card_to' ] : '' ) . '</strong><br />';
			
			echo '<span>' . esc_html( isset( $phoen_meta_data[ 'phoen_gift_card_email_to' ] ) ? $phoen_meta_data[ 'phoen_gift_card_email_to' ] : '' ) . '</span></div>';
			
			break;
		  
			// display a gift  gift_expiry_date in table 
		  
			case 'gift_expiry_date' :
			
			$phoen_current_date = new DateTime();
			
			$phoen_current_dates = $phoen_current_date->format('d-m-Y');
			
			$phoen_current_datess=strtotime($phoen_current_dates);
			
			$phoen_expiry_date = isset( $phoen_meta_data[ 'phoen_gift_card_expiry_date' ] ) ? $phoen_meta_data[ 'phoen_gift_card_expiry_date' ] : '';
			
			if($phoen_expiry_date!='')
			{
				$phoen_expiry_date=strtotime($phoen_expiry_date);
				
				if($phoen_expiry_date == $phoen_current_datess)
				{
					$expire=  __( 'Expire', 'phoen-gift-card' );
					
					echo esc_html($expire);
					
				}else{
					
					echo esc_html(date("d-m-Y ", $phoen_expiry_date));
					
				}
			
			}else{
				  echo '–';
			}
			  break;
		
			case 'gift_stasus' :
			
				$phoen_select_status = isset( $phoen_giftcard_meta[ 'phoen_select_status' ] ) ? $phoen_giftcard_meta[ 'phoen_select_status' ] : '';
				
				$phoen_gift_card_balance = isset( $phoen_meta_data[ 'phoen_gift_card_balance' ] ) ? $phoen_meta_data[ 'phoen_gift_card_balance' ] : '0';
				  
				if($phoen_meta_data_balances!='')
				{
				  $phoen_gift_balance = (isset( $phoen_meta_data[ 'phoen_gift_card_amount' ]) && is_numeric($phoen_meta_data[ 'phoen_gift_card_amount' ])) ? $phoen_meta_data[ 'phoen_gift_card_amount' ] : '0';
				  
				  $phoen_gift_balance=($phoen_gift_balance-$phoen_meta_data_balances);
				  
				  if ($phoen_gift_balance < 0)
					{
					   $phoen_gift_balance="0.00";
					}
					
				}else{
					
				   $phoen_gift_balance = (isset( $phoen_meta_data[ 'phoen_gift_card_amount' ]) && is_numeric($phoen_meta_data[ 'phoen_gift_card_amount' ])) ? $phoen_meta_data[ 'phoen_gift_card_amount' ] : '0';
				   
				}
			
			$phoen_current_date = new DateTime();
			
			$phoen_current_dates = $phoen_current_date->format('d-m-Y');
			
			$phoen_current_datess=strtotime($phoen_current_dates);
			
			$phoen_expiry_date = isset( $phoen_meta_data[ 'phoen_gift_card_expiry_date' ] ) ? $phoen_meta_data[ 'phoen_gift_card_expiry_date' ] : '';
			
			if($phoen_expiry_date!='')
			{
				$phoen_expiry_date=strtotime($phoen_expiry_date);
				
				if( $phoen_current_datess >= $phoen_expiry_date )
				{
					
					echo '<p class="phoen_status_deactive">Deactive</p>';
				
				}else{
					
					if(($phoen_select_status=='active' || $phoen_select_status=='') && $phoen_gift_balance=='0.00')
					{
						echo '<p class="phoen_status_active">Redeemed</p>';
						
					}else if(($phoen_select_status=='active' || $phoen_select_status=='')&& $phoen_gift_balance >'0'){
						
						echo '<p class="phoen_status_active">Active</p>';
						
					}else{
						
						echo '<p class="phoen_status_deactive">Deactive</p>';
					
					}
					
				}
			
			}
			
			
		  
			break;
		
		}

	}
	
	
	function phoen_gift_card_mail()
	{
		
		global $woocommerce;

		$phoen_gift_posts_data = get_posts(array(
		
				'post_type'   => 'phoen_gift_card',
				
				'post_status' => 'publish',
				
				'posts_per_page' => -1,
				
			)
			
		);
		
		if(!empty($phoen_gift_posts_data))
		{
				
			foreach($phoen_gift_posts_data as $keys=>$phoen_gift_posts_val){
				
				$phoen_gift_posts_id = $phoen_gift_posts_val->ID;
				
				$phoen_gift_post_titles =$phoen_gift_posts_val->post_title;
				
				$phoen_get_meta_data = get_post_meta( $phoen_gift_posts_id, 'phoen_gift_card_meta_data', true );
				
				$current_user = wp_get_current_user();
				
				$cur_email = $current_user->user_email;
				
				$user_id = $current_user->ID;
				
				$phoen_gift_card_email_to = isset($phoen_get_meta_data['phoen_gift_card_email_to'])?$phoen_get_meta_data['phoen_gift_card_email_to']:'';
				
				$order_id = isset($phoen_get_meta_data['order_id'])?$phoen_get_meta_data['order_id']:'';
			
				if($order_id!='')
				{
					$order_for_status = wc_get_order($order_id);
					
					$phoen_order_status = $order_for_status->get_status();
					
				}else{
					
					$phoen_order_status='';
					
				}
				
				$order_status = isset($phoen_get_meta_data['order_status'])?$phoen_get_meta_data['order_status']:'';
				
				$phoen_gift_price = (isset( $phoen_meta_data[ 'phoen_gift_card_amount' ]) && is_numeric($phoen_meta_data[ 'phoen_gift_card_amount' ])) ? $phoen_meta_data[ 'phoen_gift_card_amount' ] : '0';
				
				$phoen_gift_post_titles =$phoen_gift_posts_val->post_title;
				
				$phoen_gift_card_description = isset($phoen_get_meta_data['phoen_gift_card_description'])?$phoen_get_meta_data['phoen_gift_card_description']:'';
				
				$phoen_gift_card_to = isset($phoen_get_meta_data['phoen_gift_card_to'])?$phoen_get_meta_data['phoen_gift_card_to']:'';
				
				$phoen_gift_card_email_to = isset($phoen_get_meta_data['phoen_gift_card_email_to'])?$phoen_get_meta_data['phoen_gift_card_email_to']:'';
				
				$phoen_gift_card_form = isset($phoen_get_meta_data['phoen_gift_card_form'])?$phoen_get_meta_data['phoen_gift_card_form']:'';
				
				$phoen_gift_card_email_from = isset($phoen_get_meta_data['phoen_gift_card_email_from'])?$phoen_get_meta_data['phoen_gift_card_email_from']:'';
				
				$phoen_gift_card_balance = isset($phoen_get_meta_data['phoen_gift_card_balance'])?$phoen_get_meta_data['phoen_gift_card_balance']:'';
				
				$phoen_gift_card_expiry_date = isset($phoen_get_meta_data['phoen_gift_card_expiry_date'])?$phoen_get_meta_data['phoen_gift_card_expiry_date']:'';
				
				$phoen_gift_card_amount =(isset( $phoen_meta_data[ 'phoen_gift_card_amount' ]) && is_numeric($phoen_meta_data[ 'phoen_gift_card_amount' ])) ? $phoen_meta_data[ 'phoen_gift_card_amount' ] : '0';
				
				$phoen_meta_data_balances = get_post_meta($phoen_gift_posts_id, "phoen_gift_card_amount_used",true); 
				
				$phoen_gift_card_totle_amount=isset($phoen_totle_amount)?$phoen_totle_amount:'';
				
				$phoen_giftcard_meta = get_post_meta($phoen_gift_posts_id, "phoen_gift_card_side_box_meta",true);
				
				$product_name = isset($phoen_get_meta_data['product_name'])?$phoen_get_meta_data['product_name']:'';
				
				$item_quantity = isset($phoen_get_meta_data['item_quantity'])?$phoen_get_meta_data['item_quantity']:'';
			
				if($phoen_order_status=='completed')	
				{								
				
					$phopen_user_email_checked = get_post_meta( $order_id, 'email_send_checked', true);
					
					if($phopen_user_email_checked=='')
					{
					
						$phoen_gift_card_form_name_title=  __( 'Sender Name', 'phoen-gift-card' );
						
						$phoen_gift_card_email_from_title= __( 'Sender EmailID', 'phoen-gift-card' ); 
						
						$subject =  __( 'Gift Card For You', 'phoen-gift-card' );
						
						$phoen_amount_title =  __( 'Gift Card Amount', 'phoen-gift-card' ); 
						
						$phoen_expdate_title =  __( 'Gift Card Expiry Date', 'phoen-gift-card' ); 
						
						if($phoen_gift_card_expiry_date=='')
						{
							$phoen_gift_card_expiry_date='-';
						}
						
						$phoen_code_title =  __( 'Gift Card Code', 'phoen-gift-card' ); 
						
						$hoen_ticket_email_to = $phoen_gift_card_email_to;
						
						$phoe_currency_symbol=get_woocommerce_currency_symbol();
						
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

																			<h2 style="color:#557da1;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left"><span>'.$phoen_code_title.'</span>:- <span>'.$phoen_gift_post_titles.'</span></h2>
																		
																		<table cellspacing="0" cellpadding="6" border="1" style="width:100%;margin-bottom:40px;color:#737373;border:1px solid #e4e4e4" class="td">
																			<thead>
																				<tr>
																					<th style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px" scope="col" class="td">Product</th>
																					<th style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px" scope="col" class="td">Quantity</th>
																					<th style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px" scope="col" class="td">Amount</th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr class="order_item">
																					<td style="text-align:left;vertical-align:middle;border:1px solid #eee;word-wrap:break-word;color:#737373;padding:12px" class="td">'.$product_name.'<ul style="font-size:small;margin:1em 0 0;padding:0;list-style:none" class="wc-item-meta">
																						
																					</td>
																					<td style="text-align:left;vertical-align:middle;border:1px solid #eee;color:#737373;padding:12px" class="td">'.$item_quantity.'</td>
																					<td style="text-align:left;vertical-align:middle;border:1px solid #eee;color:#737373;padding:12px" class="td">
																						<span class="m_-9160465577541743080woocommerce-Price-amountamount">
																						<span class="m_-9160465577541743080woocommerce-Price-currencySymbol">'.$phoe_currency_symbol.'</span>'.$phoen_gift_card_amount.'</span>
																					</td>
																				</tr>
																			</tbody>
																			<tfoot>
							
																				<tr>
																					<th style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px" colspan="2" scope="row" class="td">'.$phoen_amount_title.'</th>
																					<td style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px" class="td"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">'.$phoe_currency_symbol.'</span>'.$phoen_gift_card_amount.'</span></td>
																				</tr>
																				<tr>
																					<th style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px" colspan="2" scope="row" class="td">'.$phoen_expdate_title.'</th>
																					<td style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px" class="td"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>'.$phoen_gift_card_expiry_date.'</span></td>
																				</tr>
																			</tfoot>
																		</table>
																		<table cellspacing="0" cellpadding="0" border="0" style="width:100%;vertical-align:top;margin-bottom:40px;padding:0" id="addresses">
																			<tbody>
																			<tr>
																				<td width="50%" valign="top" style="text-align:left;border:0;padding:0">
																					<h2 style="color:#557da1;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">From</h2>
																					<p style="margin:0 0 16px">'.$phoen_gift_card_form.'</p>
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
						
						update_post_meta( $order_id, 'email_send_checked',$order_status );
						
					}
					
				}	
				
			}
				
		}
		
	}
	
	/**
	 *  short code for display table data
	 *  on frontend
	 */	

	function phoen_giftcard_custm_report()
	{
		
		global $woocommerce;
		
		$phoen_gift_posts_data = get_posts(array(
		
				'post_type'   => 'phoen_gift_card',
				
				'post_status' => 'publish',
				
				'posts_per_page' => -1,
			
			)
			
		);
		
		?>
		<table class="form-table">
						
			<tbody>
			
					<tr class="phoen_gift_card">
					
						<th><label><?php _e('Code','phoen-gift-card'); ?> </label></th>
						
						<th><label><?php _e('Amount','phoen-gift-card'); ?> </label></th>
						
						<th><label><?php _e('Redeem','phoen-gift-card'); ?> </label></th>
						
						<th><label><?php _e('Balance','phoen-gift-card'); ?> </label></th>
						
						<th><label><?php _e('Order Status','phoen-gift-card'); ?> </label></th>
						
						<th><label><?php _e('Expiry Date','phoen-gift-card'); ?> </label></th>
						
					</tr>
				<?php
				 
				foreach($phoen_gift_posts_data as $keys=>$phoen_gift_posts_val){
					
					$phoen_gift_posts_id = $phoen_gift_posts_val->ID;
					
					$phoen_gift_post_titles =$phoen_gift_posts_val->post_title;
					
					$phoen_get_meta_data = get_post_meta( $phoen_gift_posts_id, 'phoen_gift_card_meta_data', true );
				
					$current_user = wp_get_current_user();
					
					$cur_email = $current_user->user_email;
					
					$user_id = $current_user->ID;
					
					$phoen_gift_card_email_to = isset($phoen_get_meta_data['phoen_gift_card_email_to'])?$phoen_get_meta_data['phoen_gift_card_email_to']:'';
					
					if($cur_email==$phoen_gift_card_email_to)
					{
				
						$order_id = isset($phoen_get_meta_data['order_id'])?$phoen_get_meta_data['order_id']:'';
						
						if($order_id!='')
						{
							$order_for_status = wc_get_order($order_id);
							
							$phoen_order_status = $order_for_status->get_status();
							
						}else{
							$phoen_order_status='';
						}
						
						$order_status = isset($phoen_get_meta_data['order_status'])?$phoen_get_meta_data['order_status']:'';
						
						$phoen_gift_price = isset( $phoen_meta_data[ 'phoen_gift_card_amount' ] ) ? $phoen_meta_data[ 'phoen_gift_card_amount' ] : '';
						
						$phoen_gift_post_titles =$phoen_gift_posts_val->post_title;
						
						$phoen_gift_card_description = isset($phoen_get_meta_data['phoen_gift_card_description'])?$phoen_get_meta_data['phoen_gift_card_description']:'';
						
						$phoen_gift_card_to = isset($phoen_get_meta_data['phoen_gift_card_to'])?$phoen_get_meta_data['phoen_gift_card_to']:'';
						
						$phoen_gift_card_email_to = isset($phoen_get_meta_data['phoen_gift_card_email_to'])?$phoen_get_meta_data['phoen_gift_card_email_to']:'';
						
						$phoen_gift_card_form = isset($phoen_get_meta_data['phoen_gift_card_form'])?$phoen_get_meta_data['phoen_gift_card_form']:'';
						
						$phoen_gift_card_email_from = isset($phoen_get_meta_data['phoen_gift_card_email_from'])?$phoen_get_meta_data['phoen_gift_card_email_from']:'';
						
						$phoen_gift_card_balance = isset($phoen_get_meta_data['phoen_gift_card_balance'])?$phoen_get_meta_data['phoen_gift_card_balance']:'';
						
						$phoen_gift_card_expiry_date = isset($phoen_get_meta_data['phoen_gift_card_expiry_date'])?$phoen_get_meta_data['phoen_gift_card_expiry_date']:'';
						
						$phoen_gift_card_amount = isset($phoen_get_meta_data['phoen_gift_card_amount'])?$phoen_get_meta_data['phoen_gift_card_amount']:'';
						
						$phoen_meta_data_balances = get_post_meta($phoen_gift_posts_id, "phoen_gift_card_amount_used",true); 
						
						$phoen_gift_card_totle_amount=isset($phoen_totle_amount)?$phoen_totle_amount:'';
						
						$phoen_giftcard_meta = get_post_meta($phoen_gift_posts_id, "phoen_gift_card_side_box_meta",true);
						
						if($order_status=='wc-completed' || $phoen_order_status=='completed')
						{								
							?>
		
							<tr class="phoen_gift_card">
								
								<td><?php echo esc_attr($phoen_gift_post_titles) ; ?> </td>
								
								<td><?php echo wc_price( $phoen_gift_card_amount ); ?> </td>
								
								<td><?php 
								
									if($phoen_meta_data_balances=='')
									{
										$phoen_gift_price = "0.00";
										
									}else{  
									
										$phoen_gift_price = $phoen_meta_data_balances;
									}  
									
									echo wc_price( $phoen_gift_price );

									?>	
								</td>
								
								<td>
									<?php
									if($phoen_meta_data_balances!='')
									{
									  $phoen_gift_card_amount=($phoen_gift_card_amount-$phoen_meta_data_balances);
									  
									  if ($phoen_gift_card_amount < 1)
										{
										   $phoen_gift_card_amount="0.00";
										}
									}else{
										
										$phoen_gift_card_amount = $phoen_gift_card_amount ;
									}
								
									echo wc_price( $phoen_gift_card_amount );
									?>	
								</td>
								
								<td>
									<?php
									$phoen_select_status = isset( $phoen_giftcard_meta[ 'phoen_select_status' ] ) ? $phoen_giftcard_meta[ 'phoen_select_status' ] : '';
									
										$phoen_current_date = new DateTime();
									
									$phoen_current_dates = $phoen_current_date->format('d-m-Y');
									
									$phoen_current_datess=strtotime($phoen_current_dates);
									
									if($phoen_gift_card_expiry_date!='')
									{
										$phoen_gift_card_expiry_date=strtotime($phoen_gift_card_expiry_date);
										
										if($phoen_current_datess >= $phoen_gift_card_expiry_date)
										{
											
											echo '<p class="phoen_status_deactive">Deactive</p>';
											
										}else{
												
											if(($phoen_select_status=='active' || $phoen_select_status=='') && $phoen_gift_card_amount=='0.00')
											{
												echo '<p class="phoen_status_active">Redeemed</p>';
												
											}else if(($phoen_select_status=='active' || $phoen_select_status=='')&& $phoen_gift_card_amount >'0'){
												
												echo '<p class="phoen_status_active">Active</p>';
												
											}else{
												
												echo '<p class="phoen_status_deactive">Deactive</p>';
											
											}
											
											
										}
									}
									
									
									?>	
								</td>
								
								<td>
									<?php
									$phoen_current_date = new DateTime();
									
									$phoen_current_dates = $phoen_current_date->format('d-m-Y');
								
									$phoen_current_datess=strtotime($phoen_current_dates);
									
									if($phoen_gift_card_expiry_date!='')
									{
										if($phoen_gift_card_expiry_date==$phoen_current_datess)
										{
											$expire=  __( 'Expire', 'phoen-gift-card' );
				
											echo esc_html($expire);
											
										}else{
											
											echo esc_html(date("d-m-Y ", $phoen_gift_card_expiry_date));
											
										}
									
									}else{
										  echo '–';
									}
									?>	
								</td>
								
							</tr>
								
							<?php
						
						}	
						
					}
				
				}
				
				?>
				
			</tbody>
						
		</table>
					<?php	
	}
}else{
		
	add_action('admin_notices', 'phoen_giftcard_wwoo_admin_notice');

	function phoen_giftcard_wwoo_admin_notice() {
		
		global $current_user ;
			
			$user_id = $current_user->ID;
			
			/* Check that the user hasn't already clicked to ignore the message */
		
		if ( ! get_user_meta($user_id, 'phoen_gift_ignore_notice') ) {
			
			echo '<div class="error"><p>'; 
			
			printf(__('Woocommerce Gift Card could not detect an active Woocommerce plugin. Make sure you have activated it. | <a href="%1$s">Hide Notice</a>'), '?phoen_rewpts_gft_nag_ignore=0');
			
			echo "</p></div>";
		}
	}

	add_action('admin_init', 'phoen_rewpts_gft_nag_ignore');

	function phoen_rewpts_gft_nag_ignore() {
		
		global $current_user;
			
			$user_id = $current_user->ID;
			
			/* If user clicks to ignore the notice, add that to their user meta */
			
			if ( isset($_GET['phoen_rewpts_gft_nag_ignore']) && '0' == $_GET['phoen_rewpts_gft_nag_ignore'] ) {
				
				add_user_meta($user_id, 'phoen_gift_ignore_notice', 'true', true);
			}
	}

}
?>
