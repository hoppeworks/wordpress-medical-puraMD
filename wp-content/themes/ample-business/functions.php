<?php
/**
 * Bussiness agency functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bussiness_agency
 */

if ( ! function_exists( 'ample_business_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ample_business_setup() {
		/*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Bussiness agency, use a find and replace
         * to change 'ample_business' to the name of your theme in all the template files.
         */
		load_theme_textdomain( 'ample-business' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
		add_theme_support( 'title-tag' );

		/*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'ample-business' ),
			'social-link' => esc_html__('Social Link', 'ample-business'),

		) );

		/*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ample_business_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		/*for header image */

		$ample_business_args = array(
			'flex-width'    => true,
			'width'         => 980,
			'flex-height'    => true,
			'height'        => 200,
			'default-image' => get_template_directory_uri() . '/assets/images/header.png',
		);
		add_theme_support( 'custom-header', $ample_business_args );


		/**woo compatible*/
		add_theme_support( 'woocommerce' );

        /*add excert on page*/
        add_post_type_support( 'page', 'excerpt' );

		add_theme_support( 'align-wide' );


// woocommerce images popup code
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );

	}
endif;
add_action( 'after_setup_theme', 'ample_business_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ample_business_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ample_business_content_width', 640 );
}
add_action( 'after_setup_theme', 'ample_business_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ample_business_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ample-business' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ample-business' ),
		'before_widget' => '<section id="%1$s" class="widget  %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar(array(
		'name' => esc_html__('HomePage Widgets Area ', 'ample-business'),
		'id' => 'homepage_widgets',
		'description' => esc_html__('Add widgets here.', 'ample-business'),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => esc_html__('Footer Info Section', 'ample-business'),
		'id' => 'footerinfo',
		'description' => esc_html__('Add widgets here.', 'ample-business'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => esc_html__('Footer1 ', 'ample-business'),
		'id' => 'footer1',
		'description' => esc_html__('Add widgets here.', 'ample-business'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title footer-bottom-title">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => esc_html__('Footer2 ', 'ample-business'),
		'id' => 'footer2',
		'description' => esc_html__('Add widgets here.', 'ample-business'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title footer-bottom-title">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => esc_html__('Footer3 ', 'ample-business'),
		'id' => 'footer3',
		'description' => esc_html__('Add widgets here.', 'ample-business'),
		'before_widget' => '<section id="%1$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title footer-bottom-title">',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => esc_html__('Footer4 ', 'ample-business'),
		'id' => 'footer4',
		'description' => esc_html__('Add widgets here.', 'ample-business'),
		'before_widget' => '<section id="%1$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title footer-bottom-title">',
		'after_title' => '</h2>',
	));
}
add_action( 'widgets_init', 'ample_business_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ample_business_scripts() {

	
	wp_enqueue_style( 'owl.carousel', get_template_directory_uri().'/assets/css/owl.carousel.css' );
	wp_enqueue_style( 'owl.theme', get_template_directory_uri().'/assets/css/owl.theme.css' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css' );
	wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
	wp_enqueue_style('Font_Awesome');
	wp_enqueue_style( 'font-awesome',get_template_directory_uri().'/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'font-animate', get_template_directory_uri().'/assets/css/animate.css' );
	
	wp_enqueue_style( 'ample-business-style', get_stylesheet_uri() );
	wp_enqueue_style( 'ample-business-media', get_template_directory_uri().'/assets/css/media.css' );
	

	wp_enqueue_script( 'carousel.min', get_template_directory_uri().'/assets/js/owl.carousel.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'waypoints', get_template_directory_uri().'/assets/js/waypoints.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/assets/js/bootstrap.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'wow', get_template_directory_uri().'/assets/js/wow.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'jquery.isotope', get_template_directory_uri().'/assets/js/jquery.isotope.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'jquery.ticker', get_template_directory_uri().'/assets/js/jquery.ticker.min.js', array('jquery'), '20151215', false );
	wp_enqueue_script( 'sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js', array('jquery'), '4.5.0' );

	wp_enqueue_script( 'jquery.touchSwipe', get_template_directory_uri().'/assets/js/jquery.touchSwipe.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'ample-business-main', get_template_directory_uri().'/assets/js/main.js', array('jquery'), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ample_business_scripts' );


/**
 * define size of logo.
 */

if (!function_exists('ample_business_custom_logo_setup')) :
	function ample_business_custom_logo_setup()
	{
		add_theme_support('custom-logo', array(
			'height' => 90,
			'width' => 300,
			'flex-width' => true,
		));
	}

	add_action('after_setup_theme', 'ample_business_custom_logo_setup');
endif;


if (!function_exists('ample_business_widgets_backend_enqueue')) :
	function ample_business_widgets_backend_enqueue($hook)
	{
		if ('widgets.php' != $hook) {
			return;
		}

		wp_register_script('ample-business-custom-widgets', get_template_directory_uri() . '/assets/js/widgets.js', array('jquery'), true);
		wp_enqueue_media();
		wp_enqueue_script('ample-business-custom-widgets');

        
        wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/css/font-awesome.css' );
        wp_enqueue_style( 'ample-business-style-admin', get_template_directory_uri() . '/assets/css/repeater-admin.css');
	}

	add_action('admin_enqueue_scripts', 'ample_business_widgets_backend_enqueue');
endif;




if (!function_exists('ample_business_admin_css_enqueue_new_post')) :
	function ample_business_admin_css_enqueue_new_post($hook)
	{
		if ('post-new.php' != $hook) {
			return;
		}
		wp_enqueue_style('ample-business-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '2.0.0');
	}
	add_action('admin_enqueue_scripts', 'ample_business_admin_css_enqueue_new_post');
endif;



if (!function_exists('ample_business_admin_css_enqueue')) :
	function ample_business_admin_css_enqueue($hook)
	{
		if ('post.php' != $hook) {
			return;
		}
		wp_enqueue_style('ample-business-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '2.0.0');
		
		wp_enqueue_script('ample_business-custom-widgets');

	}
	add_action('admin_enqueue_scripts', 'ample_business_admin_css_enqueue');
endif;



/**
 * Admin Enqueue scripts
 */
if ( ! function_exists( 'ample_business_admin_scripts' ) ) {
    function ample_business_admin_scripts($hook) {

		wp_enqueue_script('ample_business-media-sort', get_template_directory_uri() . '/assets/js/sortable.js', array( 'jquery' ) );


		wp_enqueue_script('ample_business-media-repeater', get_template_directory_uri() . '/assets/js/repeater-admin.js', array( 'jquery', 'customize-controls' ) );

        wp_enqueue_style('at-ample-admin', get_template_directory_uri() . '/assets/css/at-admin-css.css', array(), '2.0.0');

    }
}
add_action('admin_enqueue_scripts', 'ample_business_admin_scripts');





/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/fileloader.php';

require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/library/breadcrumbs/breadcrumbs.php';



/*add custom body class for sidebar section*/




/*for sidebar adding options**/

function ample_business_names( $classes ) {
	// add 'class-name' to the $classes array
	$sidebardesignlayout = esc_attr( get_post_meta(get_the_ID(), 'ample_business_sidebar_layout', true) );
	if (is_singular() && $sidebardesignlayout != "default-sidebar")
	{
		$sidebardesignlayout = esc_attr( get_post_meta(get_the_ID(), 'ample_business_sidebar_layout', true) );

	} else
	{
		$sidebardesignlayout = esc_attr(ample_business_get_option('ample_business_sidebar_layout_option' ));
	}

	$classes[] = $sidebardesignlayout;
	return $classes;

}
add_filter( 'body_class', 'ample_business_names' );

/**
 * Load Dynamic css.
 */
$ample_business_dynamic_css_options = ample_business_get_option('ample_business_color_reset_option');

if ($ample_business_dynamic_css_options== "do-not-reset" || $dynamic_css_options == "") {

	include get_template_directory() . '/inc/hook/dynamic-style-css.php';

} elseif ($ample_business_dynamic_css_options == "reset-all") {
	do_action('ample_business_colors_reset');
}




/**
 * Run ajax request.
 */
if ( ! function_exists('ample_business_wp_pages_plucker') ) :

	/**
	 * Sending pages with ids
	 */
	function ample_business_wp_pages_plucker()
	{
		$pages = get_pages(
			array (
				'parent'  => 0, // replaces 'depth' => 1,
			)
		);

		$ids = wp_list_pluck( $pages, 'post_title', 'ID' );

		return wp_send_json($ids);
	}

endif;
add_action( 'wp_ajax_ample_business_wp_pages_plucker', 'ample_business_wp_pages_plucker' );
add_action( 'wp_ajax_nopriv_ample_business_wp_pages_plucker', 'ample_business_wp_pages_plucker' );

