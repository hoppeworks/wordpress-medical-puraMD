<?php

/**
 * Business Header Info Section
 *
 */
$wp_customize->add_section(
    'ample_business_comapny_info_section',
    array(
        'priority' => 6,
        'capability' => 'edit_theme_options',
        'title' => esc_html__('Company Info', 'ample-business'),
    )
);

$wp_customize->add_setting(
    'ample_business_info_header_section',
    array(
        'default' => $default['ample_business_info_header_section'],
        'sanitize_callback' => 'ample_business_sanitize_select',
    )
);

$hide_show_top_header_option = ample_business_slider_option();
$wp_customize->add_control(
    'ample_business_info_header_section',
    array(
        'type' => 'radio',
        'label' => esc_html__('Company Info Option', 'ample-business'),
        'description' => esc_html__('Show/hide Option for Company Info Section.', 'ample-business'),
        'section' => 'ample_business_comapny_info_section',
        'choices' => $hide_show_top_header_option,
        'priority' => 5
    )
);



/**
 * Field for icon location
 *
 */
$wp_customize->add_setting(
    'ample_business_info_header_section_location_icon',
    array(
        'default' => $default['ample_business_info_header_section_location_icon'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'ample_business_info_header_section_location_icon',
    array(
        'type' => 'text',
        'description' => esc_html__('Insert Font Awesome Icon For Location', 'ample-business'),
        'section' => 'ample_business_comapny_info_section',
        'priority' => 6
    )
);

/**
 * Field for Company Info Phone Number
 *
 */
$wp_customize->add_setting(
    'ample_business_info_header_location',
    array(
        'default' => $default['ample_business_info_header_location'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'ample_business_info_header_location',
    array(
        'type' => 'text',
        'label' => esc_html__('Address', 'ample-business'),
        'section' => 'ample_business_comapny_info_section',
        'priority' => 7
    )
);




/**
 * Field for Font Awesome Icon Icon
 *
 */
$wp_customize->add_setting(
    'ample_business_info_header_section_phone_number_icon',
    array(
        'default' => $default['ample_business_info_header_section_phone_number_icon'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'ample_business_info_header_section_phone_number_icon',
    array(
        'type' => 'text',
        'description' => esc_html__('Insert Font Awesome Icon For Phone', 'ample-business'),
        'section' => 'ample_business_comapny_info_section',
        'priority' => 8
    )
);

/**
 * Field for Company Info Phone Number
 *
 */
$wp_customize->add_setting(
    'ample_business_info_header_phone_no',
    array(
        'default' => $default['ample_business_info_header_phone_no'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'ample_business_info_header_phone_no',
    array(
        'type' => 'text',
        'label' => esc_html__('Phone Number', 'ample-business'),
        'section' => 'ample_business_comapny_info_section',
        'priority' => 9
    )
);

/**
 * Field for Fonsome Icon
 *
 */
$wp_customize->add_setting(
    'ample_business_email_icon',
    array(
        'default' => $default['ample_business_email_icon'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'ample_business_email_icon',
    array(
        'type' => 'text',
        'description' => esc_html__('Insert Font Awesome Icon Class For Email', 'ample-business'),
        'section' => 'ample_business_comapny_info_section',
        'priority' => 10
    )
);

/**
 * Field for Company Info Email Address
 *
 */
$wp_customize->add_setting(
    'ample_business_info_header_email',
    array(
        'default' => $default['ample_business_info_header_email'],
        'sanitize_callback' => 'sanitize_email',
    )
);
$wp_customize->add_control(
    'ample_business_info_header_email',
    array(
        'type' => 'email',
        'label' => esc_html__('Email Address', 'ample-business'),
        'section' => 'ample_business_comapny_info_section',
        'priority' => 11
    )
);

