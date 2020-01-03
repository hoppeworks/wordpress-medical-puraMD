<?php
if (!function_exists('ample_business_sidebar_layout')) :
    function ample_business_sidebar_layout()
    {
        $ample_business_sidebar_layout = array(
            'right-sidebar' => esc_html__('Right Sidebar', 'ample-business'),
            'left-sidebar' => esc_html__('Left Sidebar', 'ample-business'),
            'no-sidebar' => esc_html__('No Sidebar', 'ample-business'),
        );
        return apply_filters('ample_business_sidebar_layout', $ample_business_sidebar_layout);
    }
endif;

/**
 * Blog/Archive Description Option
 *
 * @since Business agency 1.0.0
 *
 *
 * 
 * @param null
 * @return array $ample_business_blog_excerpt
 *
 */
if (!function_exists('ample_business_blog_excerpt')) :
    function ample_business_blog_excerpt()
    {
        $ample_business_blog_excerpt = array(
            'excerpt' => esc_html__('Excerpt', 'ample-business'),
            'content' => esc_html__('Content', 'ample-business'),

        );
        return apply_filters('ample_business_blog_excerpt', $ample_business_blog_excerpt);
    }
endif;

/**
 * Show/Hide Feature Image  options
 *
 * @since Business agency 1.0.0
 *
 * @param null
 * @return array $ample_business_show_feature_image_option
 *
 */
if (!function_exists('ample_business_show_feature_image_option')) :
    function ample_business_show_feature_image_option()
    {
        $ample_business_show_feature_image_option = array(
            'show' => esc_html__('Show', 'ample-business'),
            'hide' => esc_html__('Hide', 'ample-business')
        );
        return apply_filters('ample_business_show_feature_image_option', $ample_business_show_feature_image_option);
    }
endif;
