<?php

/**
 * Slider  options
 * @param null
 * @return array $ample_business_slider_option
 *
 */
if (!function_exists('ample_business_slider_option')) :
    function ample_business_slider_option()
    {
        $ample_business_slider_option = array(
            'show' => esc_html__('Show', 'ample-business'),
            'hide' => esc_html__('Hide', 'ample-business')
        );
        return apply_filters('ample_business_slider_option', $ample_business_slider_option);
    }
endif;