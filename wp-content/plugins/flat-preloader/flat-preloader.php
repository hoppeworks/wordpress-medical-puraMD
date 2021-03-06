<?php
/*
Plugin Name: Flat Preloader
Plugin URI:  http://tatthien.com
Description: Create preloading page with many various styles
Version:     1.1.2
Author:      Tat Thien
Author URI:  http://tatthien.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: flat_preloader
Domain Path: /languages
*/

defined( 'ABSPATH' ) || die;

define( 'FLAT_PRELOADER_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'FLAT_PRELOADER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'FLAT_PRELOADER_VERSION', '1.1.2' );

require_once dirname( __FILE__ ) . '/flat-preloader-settings.php';

/**
 * Add scripts and styles for plugin settings
 *
 * @param void
 *
 * @return void
 */
function flat_preloader_add_admin_scripts() {
	wp_enqueue_style( 'flat-preloader-admin', untrailingslashit( FLAT_PRELOADER_PLUGIN_URL ) . '/assets/css/flat-preloader.css', array(), FLAT_PRELOADER_VERSION, 'all' );
}

add_action( 'admin_enqueue_scripts', 'flat_preloader_add_admin_scripts' );

/**
 * Add scripts and styles for front page
 *
 * @param void
 *
 * @return void
 */
function flat_preloader_add_public_scripts() {
	wp_enqueue_style( 'flat-preloader', untrailingslashit( FLAT_PRELOADER_PLUGIN_URL ) . '/assets/css/flat-preloader-public.css', array(), FLAT_PRELOADER_VERSION, 'all' );
	wp_enqueue_script( 'flat-preloader-js', untrailingslashit( FLAT_PRELOADER_PLUGIN_URL ) . '/assets/js/flat-preloader.js', array( 'jquery' ), FLAT_PRELOADER_VERSION, true );
}

add_action( 'wp_enqueue_scripts', 'flat_preloader_add_public_scripts' );

/**
 * Preloading shortcode
 *
 * @param void
 *
 * @return string $output
 */
function flat_preloader_output() {
	$style   = get_option( 'preloader-style' );
	$display = get_option( 'preloader-display' );

	if ( $display == 'home' && ( is_home() || is_front_page() ) ) {
		echo '<div id="flat-preloader-overlay"><img src="' . untrailingslashit( FLAT_PRELOADER_PLUGIN_URL ) . '/assets/images/' . $style . '"/></div>';
	} elseif ( $display == 'all' ) {
		echo '<div id="flat-preloader-overlay"><img src="' . untrailingslashit( FLAT_PRELOADER_PLUGIN_URL ) . '/assets/images/' . $style . '"/></div>';
	}
}

add_action( 'wp_head', 'flat_preloader_output', 1000 );

/**
 * Add custom classes to body
 *
 * @since 1.1.2
 *
 * @param array $classes The body classes.
 *
 * @return array $classes The body classes
 */
function flat_preloader_body_classes( $classes ) {
	$display = get_option( 'preloader-display' );

	if ( $display == 'home' && ( is_home() || is_front_page() ) ) {
		$classes[] = 'flat-preloader-active';
	} elseif ( $display == 'all' ) {
		$classes[] = 'flat-preloader-active';
	}

	return $classes;
}

add_filter( 'body_class', 'flat_preloader_body_classes' );

/**
 * Add plugin action links
 *
 * @param array $links
 *
 * @return array $links
 */
function flat_preloader_plugin_action_links( $links ) {
	$links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=flat-preloader') ) .'">' . esc_html__( 'Settings' ) . '</a>';
	return $links;
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'flat_preloader_plugin_action_links', 100 );

/**
 * Load plugin text domain
 *
 * @since 1.1
 */
function flat_preloader_load_text_domain() {
	load_plugin_textdomain( 'flat_preloader', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action( 'init', 'flat_preloader_load_text_domain' );