<?php
//=============================================================
// Color reset
//=============================================================
if ( ! function_exists( 'ample_business_reset_colors' ) ) :

    function ample_business_reset_colors($data) {

        set_theme_mod('ample_business_top_header_background_color','#0e0f10');

        set_theme_mod('ample_business_top_footer_background_color','#1A1E21');

        set_theme_mod('ample_business_bottom_footer_background_color','#444444');

        set_theme_mod('ample_business_primary_color','#ef4a2b');

        set_theme_mod('ample_business_color_reset_option','do-not-reset');

    }

endif;
add_action( 'ample_business_colors_reset','ample_business_reset_colors', 10 );

