<?php
/**
 * @package Duena Woocommerce Compatibility Package
 * @version 1.0
 */

/*
Plugin Name: Duena Woocommerce Compatibility Package
Plugin URI: 
Description: This package helps you easly integrate Duena wordpress theme with Woocommerce plugin
Author: MjHead
Version: 0.1
Author URI: 
*/

@define( 'DWCP_PLUGIN_DIR', WP_PLUGIN_URL.'/duena-woocommerce-compatibility' );

/**
 * Check if WooCommerce is active, then do anything
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    
    //Remove default woocommerce content wrappers
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	//Add Duena compatible wrappers
	add_action('woocommerce_before_main_content', 'duena_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'duena_wrapper_end', 10);

	function duena_wrapper_start() {
	  echo '<div id="primary" class="span8 ' . esc_attr( of_get_option('blog_sidebar_pos') ) . '">';
		echo '<div id="content" class="site-content" role="main">';
	}

	function duena_wrapper_end() {
	    echo '</div><!-- #content -->';
	  echo '</div><!-- #primary -->';
	}

	add_action('woocommerce_before_shop_loop', 'duena_before_shop_loop_wrapper_start', 15);
	add_action('woocommerce_before_shop_loop', 'duena_before_shop_loop_wrapper_end', 35);

	function duena_before_shop_loop_wrapper_start() {
		echo '<div class="page_wrap">';
	}
	function duena_before_shop_loop_wrapper_end() {
		echo '</div>';
	}

	//Duena Additional CSS
	add_action( 'wp_enqueue_scripts', 'duena_compatible_css', 20 );
	function duena_compatible_css() {
		wp_enqueue_style( 'duena-compatible-css', DWCP_PLUGIN_DIR . '/custom-style.css', '1.0' );
	}

	add_theme_support( 'woocommerce' );

}

?>