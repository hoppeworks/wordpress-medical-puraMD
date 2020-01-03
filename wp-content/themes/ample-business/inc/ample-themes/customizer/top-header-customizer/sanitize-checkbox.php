<?php
/**
 * Sanitize checkbox field
 *
 * @param $checked
 * @return Boolean
 */
if ( !function_exists('ample_business_sanitize_checkbox') ) :
    function ample_business_sanitize_checkbox( $checked ) {
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }
endif;


