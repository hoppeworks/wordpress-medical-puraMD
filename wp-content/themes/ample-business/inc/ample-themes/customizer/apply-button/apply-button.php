<?php
/**
 * applybutton Info Section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'ample_business_applybutton_info_section',
    array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => esc_html__('Contact us Top Button Option', 'ample-business'),
    )
);


$wp_customize->add_setting(
    'ample_business_button',
    array(
        'default' => $default['ample_business_button'],
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'ample_business_button',
    array(
        'type' => 'text',
        'label' => esc_html__(' Button Text', 'ample-business'),
        'section' => 'ample_business_applybutton_info_section',
        'priority' => 8
    )
);

/**
 * Field for Get Started button Link
 *
 */
$wp_customize->add_setting(
    'ample_business_apply_button_link',
    array(
        'default' => $default['ample_business_apply_button_link'],
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'ample_business_apply_button_link',
    array(
        'type' => 'url',
        'label' => esc_html__('Button Text Link', 'ample-business'),
        'description' => esc_html__('Use full url link', 'ample-business'),
        'section' => 'ample_business_applybutton_info_section',
        'priority' => 9
    )
);


