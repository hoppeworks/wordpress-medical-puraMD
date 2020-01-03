<?php
/**
 * Business agency default theme options.
 *
 * 
 * @subpackage Business agency
 */

if ( !function_exists('ample_business_get_default_theme_options' ) ) :

    /**
     * Get default theme options.
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function ample_business_get_default_theme_options()
    {

        $default = array();

        // Homepage Slider Section
        $default['ample_business_homepage_slider_option'] = 'hide';
        $default['ample_business_slider_cat_id'] = 0;
        $default['ample_business_no_of_slider'] = 3;
        $default['ample_business_slider_get_started_txt'] = esc_html__('Get Started!', 'ample-business');
        $default['ample_business_slider_get_started_link'] = '#';

        // footer copyright.
        $default['ample_business_copyright'] = esc_html__('Copyright Text', 'ample-business');

        // Home Page Top header Info.
        $default['ample_business_top_header_section'] = 'hide';
        $default['ample_business_notice_title']= esc_html__('Notice', 'ample-business');
        $default['ample_business_news_cat_id']='';
        $default['ample_business_no_of_news']=5;
        $default['ample_business_social_link_hide_option'] = 1;

        $default['ample_business_button']=esc_html__('Contact Us', 'ample-business');
        $default['ample_business_apply_button_link']='';

        // Blog.
        $default['ample_business_sidebar_layout_option'] = 'right-sidebar';
        $default['ample_business_blog_title_option'] = esc_html__('Latest Blog', 'ample-business');
        $default['ample_business_blog_excerpt_option'] = 'excerpt';
        $default['ample_business_description_length_option'] = 40;
        $default['ample_business_exclude_cat_blog_archive_option'] = '';
        

        // Details page.
        $default['ample_business_show_feature_image_single_option'] = 'show';

        // Color Option.
        $default['ample_business_primary_color'] = '#F88C00';
       
        $default['ample_business_top_header_background_color'] = '#0e0f10';
        $default['ample_business_top_footer_background_color'] = '#444444';
        $default['ample_business_bottom_footer_background_color'] = '#444444';
        $default['ample_business_front_page_hide_option'] = 0;
        $default['ample_business_breadcrumb_setting_option'] = 'enable';
        $default['ample_business_post_search_placeholder_option'] = esc_html__('Search', 'ample-business');
        $default['ample_business_hide_breadcrumb_front_page_option'] = 0;
        $default['ample_business_color_reset_option'] = 'do-not-reset';

        //company info
       $default['ample_business_info_header_section']='hide';
       $default['ample_business_info_header_section_location_icon']='fa-home';
        $default['ample_business_info_header_location']='';
        $default['ample_business_info_header_section_phone_number_icon']='fa-phone';
        $default['ample_business_info_header_phone_no']='';
        $default['ample_business_email_icon']='fa-envelope-o';
        $default['ample_business_info_header_email']='';



        // Pass through filter.
        $default = apply_filters( 'ample_business_get_default_theme_options', $default );
        return $default;
    }
endif;
