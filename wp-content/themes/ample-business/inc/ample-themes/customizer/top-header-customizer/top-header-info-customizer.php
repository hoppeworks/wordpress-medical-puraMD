<?php
/**
 * Business Header Info Section
 *
 */
$wp_customize->add_section(
    'ample_business_top_header_info_section',
    array(
        'priority' => 6,
        'capability' => 'edit_theme_options',
        'title' => esc_html__('Top Header Info', 'ample-business'),
    )
);

$wp_customize->add_setting(
    'ample_business_top_header_section',
    array(
        'default' => $default['ample_business_top_header_section'],
        'sanitize_callback' => 'ample_business_sanitize_select',
    )
);

$hide_show_top_header_option = ample_business_slider_option();
$wp_customize->add_control(
    'ample_business_top_header_section',
    array(
        'type' => 'radio',
        'label' => esc_html__('Top Header Info Option', 'ample-business'),
        'description' => esc_html__('Show/hide Option for Top Header Info Section.', 'ample-business'),
        'section' => 'ample_business_top_header_info_section',
        'choices' => $hide_show_top_header_option,
        'priority' => 5
    )
);




/**
 * Field for breaking
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'ample_business_notice',
    array(
        'default' => $default['ample_business_notice_title'],
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'ample_business_notice',
    array(
        'type' => 'text',
        'label' => esc_html__('Notice Title', 'ample-business'),
        'section' => 'ample_business_top_header_info_section',
        'priority' => 8
    )
);




/**
 * Dropdown available category for homepage slider
 *
 */


$wp_customize->add_setting(
    'ample_business_news_cat_id',
    array(
        'default' => $default['ample_business_news_cat_id'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(new ample_business_Customize_Category_Control(
        $wp_customize,
        'ample_business_news_cat_id',
        array(
            'label' => esc_html__('Notice Top Section', 'ample-business'),
            'description' => esc_html__('Select Category for top info Section', 'ample-business'),
            'section' => 'ample_business_top_header_info_section',
            'priority' => 8,

        )
    )
);
/**
 * Field for no of posts to display..
 *
 */
$wp_customize->add_setting(
    'ample_business_no_of_news',
    array(
        'default' => $default['ample_business_no_of_news'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'ample_business_no_of_news',
    array(
        'type' => 'number',
        'label' => esc_html__('No of posts', 'ample-business'),
        'section' => 'ample_business_top_header_info_section',
        'priority' => 10
    )
);


/**
 *   Show/Hide Social Link
 */
$wp_customize->add_setting(
    'ample_business_social_link_hide_option',
    array(
        'default' => $default['ample_business_social_link_hide_option'],
        'sanitize_callback' => 'ample_business_sanitize_checkbox',
    )
);
$wp_customize->add_control('ample_business_social_link_hide_option',
    array(
        'label' => esc_html__('Hide/Show Social Menu', 'ample-business'),
        'section' => 'ample_business_top_header_info_section',
        'type' => 'checkbox',
        'priority' => 10
    )
);