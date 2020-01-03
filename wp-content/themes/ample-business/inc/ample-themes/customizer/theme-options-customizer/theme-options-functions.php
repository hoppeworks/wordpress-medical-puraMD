<?php
/**
 * Breadcrumb  display option options
 * @param null
 * @return array $ample_business_show_breadcrumb_option
 *
 */
if (!function_exists('ample_business_show_breadcrumb_option')) :
    function ample_business_show_breadcrumb_option()
    {
        $ample_business_show_breadcrumb_option = array(
            'enable' => esc_html__('Enable', 'ample-business'),
            'disable' => esc_html__('Disable', 'ample-business')
        );
        return apply_filters('ample_business_show_breadcrumb_option', $ample_business_show_breadcrumb_option);
    }
endif;


/**
 * Reset Option
 *
 *
 * @param null
 * @return array $ample_business_reset_option
 *
 */
if (!function_exists('ample_business_reset_option')) :
    function ample_business_reset_option()
    {
        $ample_business_reset_option = array(
            'do-not-reset' => esc_html__('Do Not Reset', 'ample-business'),
            'reset-all' => esc_html__('Reset All', 'ample-business'),
        );
        return apply_filters('ample_business_reset_option', $ample_business_reset_option);
    }
endif;



/**
 * Sanitize Multiple Category
 * =====================================
 */

if ( !function_exists('ample_business_sanitize_multiple_category') ) :

    function ample_business_sanitize_multiple_category( $values )
    {

        $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

        return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
    }

endif;
