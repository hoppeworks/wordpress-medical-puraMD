<?php
/**
 * HomePage Settings Panel on customizer
 */
$wp_customize->add_panel(
    'ample_business_homepage_settings_panel',
    array(
        'priority' => 5,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__('HomePage Slider Settings', 'ample-business'),
    )
);

/*-------------------------------------------------------------------------------------------------*/
/**
 * Slider Section
 *
 */
$wp_customize->add_section(
    'ample_business_slider_section',
    array(
        'title' => esc_html__('Slider Section', 'ample-business'),
        'panel' => 'ample_business_homepage_settings_panel',
        'priority' => 6,
    )
);

/**
 * Show/Hide option for Homepage Slider Section
 *
 */

$wp_customize->add_setting(
    'ample_business_homepage_slider_option',
    array(
        'default' => $default['ample_business_homepage_slider_option'],
        'sanitize_callback' => 'ample_business_sanitize_select',
    )
);
$hide_show_option = ample_business_slider_option();
$wp_customize->add_control(
    'ample_business_homepage_slider_option',
    array(
        'type' => 'radio',
        'label' => esc_html__('Slider Option', 'ample-business'),
        'description' => esc_html__('Show/hide option for homepage Slider Section.', 'ample-business'),
        'section' => 'ample_business_slider_section',
        'choices' => $hide_show_option,
        'priority' => 7
    )
);


/**
 * List All Pages
 */
$slider_pages = array();
$slider_pages_obj = get_pages();
$slider_pages[''] = esc_html__('Select Page','ample-business');
foreach ($slider_pages_obj as $page) {
    $slider_pages[$page->ID] = $page->post_title;
}


/*repeter call */
$wp_customize->add_setting('ample_business_banner_all_sliders', array(
    'sanitize_callback' => 'ample_business_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'selectpage' => '',//field
            'button_text' => '',
            'button_url' => ''
        )
    ))
));

$wp_customize->add_control(new ample_business_Repeater_Controler($wp_customize, 'ample_business_banner_all_sliders', array(
        'label' =>esc_html__('Slider Settings Area', 'ample-business'),
        'section' => 'ample_business_slider_section',
        'settings' => 'ample_business_banner_all_sliders',
        'ample_business_box_label' =>esc_html__('Slider Settings Options', 'ample-business'),
        'ample_business_box_add_control' =>esc_html__('Add New Slider', 'ample-business'),
    ),
        array(
            'selectpage' => array(
                'type' => 'select',
                'label' =>esc_html__('Select Slider Page', 'ample-business'),
                'options' => $slider_pages//array
            ),
            'button_text' => array(
                'type' => 'text',
                'label' =>esc_html__('Enter Button Text', 'ample-business'),
                'default' => ''
            ),
            'button_url' => array(
                'type' => 'text',
                'label' => esc_html__('Enter Button Url', 'ample-business'),
                'default' => ''
            ),

        )
    )
);

	