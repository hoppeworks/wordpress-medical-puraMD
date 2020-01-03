<?php

	$construction_realestate_hi_first_color = get_theme_mod('construction_realestate_hi_first_color');

	$custom_css ='';
	/*------------------------------ Global First Color -----------*/

	if($construction_realestate_hi_first_color != false){
		$custom_css .='input[type="submit"], .slide-button a, .main-menu-navigation, .primary-navigation ul ul a:hover, .primary-navigation ul ul a:focus, #comments input[type="submit"].submit, #sidebar input[type="submit"], #sidebar .tagcloud a:hover, .footer-wp .tagcloud a:hover, a.button, .copyright-wrapper, .footer-wp input[type="submit"], .pagination a:hover, .pagination .current, .woocommerce span.onsale, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, nav.woocommerce-MyAccount-navigation ul li , #comments a.comment-reply-link{';
				$custom_css .='background-color: '.esc_html($construction_realestate_hi_first_color).';';
		$custom_css .='}';
	}
	if($construction_realestate_hi_first_color != false){
		$custom_css .='a, p.logged-in-as a, p.f_para, #header .socialbox i:hover, #sidebar .textwidget p a, span.posted_in a, #sidebar .widget_calendar tbody a, .cat-box ul.post-categories a:hover, span.entry-date a:hover, span.entry-author a:hover, .footer-wp h3, .footer-wp li a:hover, #about h2, .woocommerce-message::before, .woocommerce-account .woocommerce-MyAccount-content a, .woocommerce-info a, td.product-name a, a.shipping-calculator-button, .textwidget p a{';
				$custom_css .='color: '.esc_html($construction_realestate_hi_first_color).';';
		$custom_css .='}';
	}
	if($construction_realestate_hi_first_color != false){
		$custom_css .='.slide-button a, #comments input[type="submit"].submit, a.button{';
				$custom_css .='border-color: '.esc_html($construction_realestate_hi_first_color).';';
		$custom_css .='}';
	}
	if($construction_realestate_hi_first_color != false){
		$custom_css .='.woocommerce-message{';
				$custom_css .='border-top-color: '.esc_html($construction_realestate_hi_first_color).';';
		$custom_css .='}';
	}
	if($construction_realestate_hi_first_color != false){
		$custom_css .='.footer-wp h3{';
				$custom_css .='border-bottom-color: '.esc_html($construction_realestate_hi_first_color).';';
		$custom_css .='}';
	}
