<?php
/**
 * Construction Realestate Theme Customizer
 * @package Construction Realestate
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function construction_realestate_customize_register( $wp_customize ) {

	//add home page setting pannel
	$wp_customize->add_panel( 'construction_realestate_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'construction-realestate' ),
	    'description' => __( 'Description of what this panel does.', 'construction-realestate' ),
	) );

	//layout setting
	$wp_customize->add_section( 'construction_realestate_option', array(
    	'title'      => __( 'Layout Settings', 'construction-realestate' ),
		'panel' => 'construction_realestate_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('construction_realestate_layout_options',array(
        'default' => __('Right Sidebar','construction-realestate'),
        'sanitize_callback' => 'construction_realestate_sanitize_choices'	        
	) );
	$wp_customize->add_control('construction_realestate_layout_options',
	    array(
	        'type' => 'radio',
	        'label' => __('Do you want this section','construction-realestate'),
	        'section' => 'construction_realestate_option',
	        'choices' => array(
	            'One Column' => __('One Column','construction-realestate'),
	            'Three Columns' => __('Three Columns','construction-realestate'),
	            'Four Columns' => __('Four Columns','construction-realestate'),
	            'Grid Layout' => __('Grid Layout','construction-realestate'),
	            'Left Sidebar' => __('Left Sidebar','construction-realestate'),
	            'Right Sidebar' => __('Right Sidebar','construction-realestate')
	        ),
	    )
    );

    $font_array = array(
		''                       => 'No Fonts',
		'Abril Fatface'          => 'Abril Fatface',
		'Acme'                   => 'Acme',
		'Anton'                  => 'Anton',
		'Architects Daughter'    => 'Architects Daughter',
		'Arimo'                  => 'Arimo',
		'Arsenal'                => 'Arsenal',
		'Arvo'                   => 'Arvo',
		'Alegreya'               => 'Alegreya',
		'Alfa Slab One'          => 'Alfa Slab One',
		'Averia Serif Libre'     => 'Averia Serif Libre',
		'Bangers'                => 'Bangers',
		'Boogaloo'               => 'Boogaloo',
		'Bad Script'             => 'Bad Script',
		'Bitter'                 => 'Bitter',
		'Bree Serif'             => 'Bree Serif',
		'BenchNine'              => 'BenchNine',
		'Cabin'                  => 'Cabin',
		'Cardo'                  => 'Cardo',
		'Courgette'              => 'Courgette',
		'Cherry Swash'           => 'Cherry Swash',
		'Cormorant Garamond'     => 'Cormorant Garamond',
		'Crimson Text'           => 'Crimson Text',
		'Cuprum'                 => 'Cuprum',
		'Cookie'                 => 'Cookie',
		'Chewy'                  => 'Chewy',
		'Days One'               => 'Days One',
		'Dosis'                  => 'Dosis',
		'Droid Sans'             => 'Droid Sans',
		'Economica'              => 'Economica',
		'Fredoka One'            => 'Fredoka One',
		'Fjalla One'             => 'Fjalla One', 
		'Francois One'           => 'Francois One',
		'Frank Ruhl Libre'       => 'Frank Ruhl Libre',
		'Gloria Hallelujah'      => 'Gloria Hallelujah',
		'Great Vibes'            => 'Great Vibes',
		'Handlee'                => 'Handlee',
		'Hammersmith One'        => 'Hammersmith One',
		'Inconsolata'            => 'Inconsolata',
		'Indie Flower'           => 'Indie Flower', 
		'IM Fell English SC'     => 'IM Fell English SC',
		'Julius Sans One'        => 'Julius Sans One',
		'Josefin Slab'           => 'Josefin Slab',
		'Josefin Sans'           => 'Josefin Sans',
		'Kanit'                  => 'Kanit', 
		'Lobster'                => 'Lobster',
		'Lato'                   => 'Lato',
		'Lora'                   => 'Lora',
		'Libre Baskerville'      => 'Libre Baskerville',
		'Lobster Two'            => 'Lobster Two', 
		'Merriweather'           => 'Merriweather',
		'Monda'                  => 'Monda', 
		'Montserrat'             => 'Montserrat',
		'Muli'                   => 'Muli', 
		'Marck Script'           => 'Marck Script', 
		'Noto Serif'             => 'Noto Serif', 
		'Open Sans'              => 'Open Sans', 
		'Overpass'               => 'Overpass',
		'Overpass Mono'          => 'Overpass Mono',
		'Oxygen'                 => 'Oxygen', 
		'Orbitron'               => 'Orbitron',
		'Patua One'              => 'Patua One',
		'Pacifico'               => 'Pacifico',
		'Padauk'                 => 'Padauk',
		'Playball'               => 'Playball',
		'Playfair Display'       => 'Playfair Display', 
		'PT Sans'                => 'PT Sans',
		'Philosopher'            => 'Philosopher',
		'Permanent Marker'       => 'Permanent Marker',
		'Poiret One'             => 'Poiret One',
		'Quicksand'              => 'Quicksand',
		'Quattrocento Sans'      => 'Quattrocento Sans',
		'Raleway'                => 'Raleway',
		'Rubik'                  => 'Rubik', 
		'Rokkitt'                => 'Rokkitt',
		'Russo One'              => 'Russo One',
		'Righteous'              => 'Righteous',
		'Slabo'                  => 'Slabo', 
		'Source Sans Pro'        => 'Source Sans Pro',
		'Shadows Into Light Two' => 'Shadows Into Light Two', 
		'Shadows Into Light'     => 'Shadows Into Light',
		'Sacramento'             => 'Sacramento',
		'Shrikhand'              => 'Shrikhand',
		'Tangerine'              => 'Tangerine',
		'Ubuntu'                 => 'Ubuntu',
		'VT323'                  => 'VT323',
		'Varela Round'           => 'Varela Round',
		'Vampiro One'            => 'Vampiro One',
		'Vollkorn'               => 'Vollkorn', 
		'Volkhov'                => 'Volkhov',
		'Yanone Kaffeesatz'      => 'Yanone Kaffeesatz'
	);

	//Typography
	$wp_customize->add_section('construction_realestate_typography', array(
		'title'    => __('Typography', 'construction-realestate'),
		'panel'    => 'construction_realestate_panel_id',
	));
	// This is Paragraph Color picker setting
	$wp_customize->add_setting('construction_realestate_paragraph_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'construction_realestate_paragraph_color', array(
		'label'    => __('Paragraph Color', 'construction-realestate'),
		'section'  => 'construction_realestate_typography',
		'settings' => 'construction_realestate_paragraph_color',
	)));
	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('construction_realestate_paragraph_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'construction_realestate_sanitize_choices',
	));
	$wp_customize->add_control(
		'construction_realestate_paragraph_font_family', array(
		'section' => 'construction_realestate_typography',
		'label'   => __('Paragraph Fonts', 'construction-realestate'),
		'type'    => 'select',
		'choices' => $font_array,
	));
	$wp_customize->add_setting('construction_realestate_paragraph_font_size', array(
		'default'           => '12px',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('construction_realestate_paragraph_font_size', array(
		'label'   => __('Paragraph Font Size', 'construction-realestate'),
		'section' => 'construction_realestate_typography',
		'setting' => 'construction_realestate_paragraph_font_size',
		'type'    => 'text',
	));
	// This is "a" Tag Color picker setting
	$wp_customize->add_setting('construction_realestate_atag_color', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'construction_realestate_atag_color', array(
		'label'    => __('"a" Tag Color', 'construction-realestate'),
		'section'  => 'construction_realestate_typography',
		'settings' => 'construction_realestate_atag_color',
	)));
	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('construction_realestate_atag_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'construction_realestate_sanitize_choices',
	));
	$wp_customize->add_control('construction_realestate_atag_font_family', array(
		'section' => 'construction_realestate_typography',
		'label'   => __('"a" Tag Fonts', 'construction-realestate'),
		'type'    => 'select',
		'choices' => $font_array,
	));
	// This is "a" Tag Color picker setting
	$wp_customize->add_setting('construction_realestate_li_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'construction_realestate_li_color', array(
		'label'    => __('"li" Tag Color', 'construction-realestate'),
		'section'  => 'construction_realestate_typography',
		'settings' => 'construction_realestate_li_color',
	)));
	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('construction_realestate_li_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'construction_realestate_sanitize_choices',
	));
	$wp_customize->add_control('construction_realestate_li_font_family', array(
		'section' => 'construction_realestate_typography',
		'label'   => __('"li" Tag Fonts', 'construction-realestate'),
		'type'    => 'select',
		'choices' => $font_array,
	));
	// This is H1 Color picker setting
	$wp_customize->add_setting('construction_realestate_h1_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'construction_realestate_h1_color', array(
		'label'    => __('H1 Color', 'construction-realestate'),
		'section'  => 'construction_realestate_typography',
		'settings' => 'construction_realestate_h1_color',
	)));
	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('construction_realestate_h1_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'construction_realestate_sanitize_choices',
	));
	$wp_customize->add_control('construction_realestate_h1_font_family', array(
			'section' => 'construction_realestate_typography',
			'label'   => __('H1 Fonts', 'construction-realestate'),
			'type'    => 'select',
			'choices' => $font_array,
	));
	//This is H1 FontSize setting
	$wp_customize->add_setting('construction_realestate_h1_font_size', array(
		'default'           => '50px',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('construction_realestate_h1_font_size', array(
		'label'   => __('H1 Font Size', 'construction-realestate'),
		'section' => 'construction_realestate_typography',
		'setting' => 'construction_realestate_h1_font_size',
		'type'    => 'text',
	));
	// This is H2 Color picker setting
	$wp_customize->add_setting('construction_realestate_h2_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'construction_realestate_h2_color', array(
		'label'    => __('h2 Color', 'construction-realestate'),
		'section'  => 'construction_realestate_typography',
		'settings' => 'construction_realestate_h2_color',
	)));
	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('construction_realestate_h2_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'construction_realestate_sanitize_choices',
	));
	$wp_customize->add_control('construction_realestate_h2_font_family', array(
		'section' => 'construction_realestate_typography',
		'label'   => __('h2 Fonts', 'construction-realestate'),
		'type'    => 'select',
		'choices' => $font_array,
	));
	//This is H2 FontSize setting
	$wp_customize->add_setting('construction_realestate_h2_font_size', array(
		'default'           => '45px',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('construction_realestate_h2_font_size', array(
		'label'   => __('h2 Font Size', 'construction-realestate'),
		'section' => 'construction_realestate_typography',
		'setting' => 'construction_realestate_h2_font_size',
		'type'    => 'text',
	));
	// This is H3 Color picker setting
	$wp_customize->add_setting('construction_realestate_h3_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'construction_realestate_h3_color', array(
		'label'    => __('h3 Color', 'construction-realestate'),
		'section'  => 'construction_realestate_typography',
		'settings' => 'construction_realestate_h3_color',
	)));
	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('construction_realestate_h3_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'construction_realestate_sanitize_choices',
	));
	$wp_customize->add_control('construction_realestate_h3_font_family', array(
		'section' => 'construction_realestate_typography',
		'label'   => __('h3 Fonts', 'construction-realestate'),
		'type'    => 'select',
		'choices' => $font_array,
	));
	//This is H3 FontSize setting
	$wp_customize->add_setting('construction_realestate_h3_font_size', array(
		'default'           => '36px',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('construction_realestate_h3_font_size', array(
		'label'   => __('h3 Font Size', 'construction-realestate'),
		'section' => 'construction_realestate_typography',
		'setting' => 'construction_realestate_h3_font_size',
		'type'    => 'text',
	));
	// This is H4 Color picker setting
	$wp_customize->add_setting('construction_realestate_h4_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'construction_realestate_h4_color', array(
		'label'    => __('h4 Color', 'construction-realestate'),
		'section'  => 'construction_realestate_typography',
		'settings' => 'construction_realestate_h4_color',
	)));
	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('construction_realestate_h4_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'construction_realestate_sanitize_choices',
	));
	$wp_customize->add_control('construction_realestate_h4_font_family', array(
		'section' => 'construction_realestate_typography',
		'label'   => __('h4 Fonts', 'construction-realestate'),
		'type'    => 'select',
		'choices' => $font_array,
	));
	//This is H4 FontSize setting
	$wp_customize->add_setting('construction_realestate_h4_font_size', array(
		'default'           => '30px',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('construction_realestate_h4_font_size', array(
		'label'   => __('h4 Font Size', 'construction-realestate'),
		'section' => 'construction_realestate_typography',
		'setting' => 'construction_realestate_h4_font_size',
		'type'    => 'text',
	));
	// This is H5 Color picker setting
	$wp_customize->add_setting('construction_realestate_h5_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'construction_realestate_h5_color', array(
		'label'    => __('h5 Color', 'construction-realestate'),
		'section'  => 'construction_realestate_typography',
		'settings' => 'construction_realestate_h5_color',
	)));
	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('construction_realestate_h5_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'construction_realestate_sanitize_choices',
	));
	$wp_customize->add_control(
		'construction_realestate_h5_font_family', array(
		'section' => 'construction_realestate_typography',
		'label'   => __('h5 Fonts', 'construction-realestate'),
		'type'    => 'select',
		'choices' => $font_array,
	));
	//This is H5 FontSize setting
	$wp_customize->add_setting('construction_realestate_h5_font_size', array(
		'default'           => '25px',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('construction_realestate_h5_font_size', array(
		'label'   => __('h5 Font Size', 'construction-realestate'),
		'section' => 'construction_realestate_typography',
		'setting' => 'construction_realestate_h5_font_size',
		'type'    => 'text',
	));
	// This is H6 Color picker setting
	$wp_customize->add_setting('construction_realestate_h6_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'construction_realestate_h6_color', array(
		'label'    => __('h6 Color', 'construction-realestate'),
		'section'  => 'construction_realestate_typography',
		'settings' => 'construction_realestate_h6_color',
	)));
	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('construction_realestate_h6_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'construction_realestate_sanitize_choices',
	));
	$wp_customize->add_control('construction_realestate_h6_font_family', array(
		'section' => 'construction_realestate_typography',
		'label'   => __('h6 Fonts', 'construction-realestate'),
		'type'    => 'select',
		'choices' => $font_array,
	));
	//This is H6 FontSize setting
	$wp_customize->add_setting('construction_realestate_h6_font_size', array(
		'default'           => '18px',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('construction_realestate_h6_font_size', array(
		'label'   => __('h6 Font Size', 'construction-realestate'),
		'section' => 'construction_realestate_typography',
		'setting' => 'construction_realestate_h6_font_size',
		'type'    => 'text',
	));

	//Global Color
	$wp_customize->add_section('construction_realestate_global_color', array(
		'title'    => __('Theme Color Option', 'construction-realestate'),
		'panel'    => 'construction_realestate_panel_id',
	));

	$wp_customize->add_setting('construction_realestate_hi_first_color', array(
		'default'           => '#0075b5',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'construction_realestate_hi_first_color', array(
		'label'    => __('Highlight Color', 'construction-realestate'),
		'section'  => 'construction_realestate_global_color',
		'settings' => 'construction_realestate_hi_first_color',
	)));

	//Blog Post Settings
	$wp_customize->add_section('construction_realestate_post_settings', array(
		'title'    => __('Post General Settings', 'construction-realestate'),
		'panel'    => 'construction_realestate_panel_id',
	));

	$wp_customize->add_setting('construction_realestate_metafields_date',array(
       'default' => 'true',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('construction_realestate_metafields_date',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Date ','construction-realestate'),
       'section' => 'construction_realestate_post_settings'
    ));

    $wp_customize->add_setting('construction_realestate_metafields_author',array(
       'default' => 'true',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('construction_realestate_metafields_author',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Author','construction-realestate'),
       'section' => 'construction_realestate_post_settings'
    ));

    $wp_customize->add_setting('construction_realestate_metafields_comment',array(
       'default' => 'true',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('construction_realestate_metafields_comment',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Comments','construction-realestate'),
       'section' => 'construction_realestate_post_settings'
    ));

    //Post excerpt
	$wp_customize->add_setting( 'construction_realestate_post_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'construction_realestate_post_excerpt_number', array(
		'label'       => esc_html__( 'Blog Post Content Limit','construction-realestate' ),
		'section'     => 'construction_realestate_post_settings',
		'type'        => 'number',
		'settings'    => 'construction_realestate_post_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Social Icons(topbar)
	$wp_customize->add_section('construction_realestate_topbar_header',array(
		'title'	=> __('Social Icon Section','construction-realestate'),
		'description'	=> __('Add Social Link here','construction-realestate'),
		'priority'	=> null,
		'panel' => 'construction_realestate_panel_id',
	));

	$wp_customize->add_setting('construction_realestate_cont_facebook',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('construction_realestate_cont_facebook',array(
		'label'	=> __('Add Facebook link','construction-realestate'),
		'section'	=> 'construction_realestate_topbar_header',
		'setting'	=> 'construction_realestate_cont_facebook',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('construction_realestate_cont_twitter',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('construction_realestate_cont_twitter',array(
		'label'	=> __('Add Twitter link','construction-realestate'),
		'section'	=> 'construction_realestate_topbar_header',
		'setting'	=> 'construction_realestate_cont_twitter',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('construction_realestate_google_plus',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('construction_realestate_google_plus',array(
		'label'	=> __('Add Google Plus link','construction-realestate'),
		'section'	=> 'construction_realestate_topbar_header',
		'setting'	=> 'construction_realestate_google_plus',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('construction_realestate_pinterest',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('construction_realestate_pinterest',array(
		'label'	=> __('Add Pintrest link','construction-realestate'),
		'section'	=> 'construction_realestate_topbar_header',
		'setting'	=> 'construction_realestate_pinterest',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('construction_realestate_tumblr',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('construction_realestate_tumblr',array(
		'label'	=> __('Add Tumblr link','construction-realestate'),
		'section'	=> 'construction_realestate_topbar_header',
		'setting'	=> 'construction_realestate_tumblr',
		'type'		=> 'url'
	));

	//Top Bar(topbar)
	$wp_customize->add_section('construction_realestate_contact',array(
		'title'	=> __('Contact Us','construction-realestate'),
		'description'	=> __('Add contact us here','construction-realestate'),
		'priority'	=> null,
		'panel' => 'construction_realestate_panel_id',
	));

	$wp_customize->add_setting('construction_realestate_location',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_realestate_location',array(
		'label'	=> __('Enter Street','construction-realestate'),
		'section'	=> 'construction_realestate_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('construction_realestate_location1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_realestate_location1',array(
		'label'	=> __('Enter City','construction-realestate'),
		'section'	=> 'construction_realestate_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('construction_realestate_time',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_realestate_time',array(
		'label'	=> __('Enter Time','construction-realestate'),
		'section'	=> 'construction_realestate_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('construction_realestate_time1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_realestate_time1',array(
		'label'	=> __('Enter Day','construction-realestate'),
		'section'	=> 'construction_realestate_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('construction_realestate_number',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_realestate_number',array(
		'label'	=> __('Enter Phone No 1.','construction-realestate'),
		'section'	=> 'construction_realestate_contact',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('construction_realestate_number1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_realestate_number1',array(
		'label'	=> __('Enter Phone No 2.','construction-realestate'),
		'section'	=> 'construction_realestate_contact',
		'type'		=> 'text'
	));

	//home page slider
	$wp_customize->add_section( 'construction_realestate_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'construction-realestate' ),
		'priority'   => null,
		'panel' => 'construction_realestate_panel_id'
	) );

	$wp_customize->add_setting('construction_realestate_slider_hide_show',array(
       	'default' => 'true',
       	'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('construction_realestate_slider_hide_show',array(
	   	'type' => 'checkbox',
	   	'label' => __('Show / Hide slider','construction-realestate'),
	   	'section' => 'construction_realestate_slidersettings',
	));

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'construction_realestate_slider' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'construction_realestate_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'construction_realestate_slider' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'construction-realestate' ),
			'section'  => 'construction_realestate_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//Slider excerpt
	$wp_customize->add_setting( 'construction_realestate_slider_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'construction_realestate_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Content Limit','construction-realestate' ),
		'section'     => 'construction_realestate_slidersettings',
		'type'        => 'number',
		'settings'    => 'construction_realestate_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//About
	$wp_customize->add_section('construction_realestate_about',array(
		'title'	=> __('About Us Section','construction-realestate'),
		'description'	=> __('Add About Us sections below.','construction-realestate'),
		'panel' => 'construction_realestate_panel_id',
	));

	$wp_customize->add_setting('construction_realestate_sec_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_realestate_sec_title',array(
		'label'	=> __('Title','construction-realestate'),
		'section'	=> 'construction_realestate_about',
		'type'		=> 'text'
	));

	$args = array('numberposts' => -1);
	$post_list = get_posts($args);
	$i = 0;
	$posts[]='Select';  
	foreach($post_list as $post){
		$posts[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('construction_realestate_about_post_setting',array(
		'default' =>'select post',
		'sanitize_callback' => 'construction_realestate_sanitize_choices',
	));
	$wp_customize->add_control('construction_realestate_about_post_setting',array(
		'type'    => 'select',
		'choices' => $posts,
		'label' => __('Select post','construction-realestate'),
		'section' => 'construction_realestate_about',
	));

	//About excerpt
	$wp_customize->add_setting( 'construction_realestate_about_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'construction_realestate_about_excerpt_number', array(
		'label'       => esc_html__( 'About Content Limit','construction-realestate' ),
		'section'     => 'construction_realestate_about',
		'type'        => 'number',
		'settings'    => 'construction_realestate_about_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );
	
	//footer text
	$wp_customize->add_section('construction_realestate_footer_section',array(
		'title'	=> __('Footer Text','construction-realestate'),
		'panel' => 'construction_realestate_panel_id'
	));

	$wp_customize->add_setting('footer_widget_areas',array(
        'default'           => '3',
        'sanitize_callback' => 'construction_realestate_sanitize_choices',
    ));
    $wp_customize->add_control('footer_widget_areas',array(
        'type'        => 'radio',
        'label'       => __('Footer widget area', 'construction-realestate'),
        'section'     => 'construction_realestate_footer_section',
        'description' => __('Select the number of widget areas you want in the footer. After that, go to Appearance > Widgets and add your widgets.', 'construction-realestate'),
        'choices' => array(
            '1'     => __('One', 'construction-realestate'),
            '2'     => __('Two', 'construction-realestate'),
            '3'     => __('Three', 'construction-realestate'),
            '4'     => __('Four', 'construction-realestate')
        ),
    ));
	
	$wp_customize->add_setting('construction_realestate_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_realestate_footer_copy',array(
		'label'	=> __('Copyright Text','construction-realestate'),
		'section'	=> 'construction_realestate_footer_section',
		'description'	=> __('Add some text for footer like copyright etc.','construction-realestate'),
		'type'		=> 'text'
	));

}
add_action( 'customize_register', 'construction_realestate_customize_register' );	

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Construction_Realestate_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Construction_Realestate_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(new Construction_Realestate_Customize_Section_Pro($manager,'example_1',array(
			'title'    => esc_html__( 'Real Estate Pro', 'construction-realestate' ),
			'pro_text' => esc_html__( 'Go Pro', 'construction-realestate' ),
			'pro_url'  => esc_url('https://www.buywptemplates.com/themes/premium-construction-real-estate-wordpress-theme/'),
			'priority'   => 1
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'construction-realestate-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'construction-realestate-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}

	//Footer widget areas
		function construction_realestate_sanitize_choices( $input ) {
		    $valid = array(
		        '1'     => __('One', 'construction-realestate'),
		        '2'     => __('Two', 'construction-realestate'),
		        '3'     => __('Three', 'construction-realestate'),
		        '4'     => __('Four', 'construction-realestate')
		    );
		    if ( array_key_exists( $input, $valid ) ) {
		        return $input;
		    } else {
		        return '';
		    }
		}
}

// Doing this customizer thang!
Construction_Realestate_Customize::get_instance();