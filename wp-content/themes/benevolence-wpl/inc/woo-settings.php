<?php
/**
 * WooCommerce Custom Functions
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.1
 * @version 4.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*-----------------------------------------------------------------------------------*/
/*	Initiate WooCommerce
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'woocommerce' );

/*-----------------------------------------------------------------------------------*/
/*	Add gallery support
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );


/*-----------------------------------------------------------------------------------*/
/*	Remove WooCommerce Shop Title
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_remove_woo_page_title' ) ) {

	function wpl_remove_woo_page_title() {
		return false;
	}
	add_filter('woocommerce_show_page_title', 'wpl_remove_woo_page_title');

}


/*-----------------------------------------------------------------------------------*/
/*	Change number or products per row to 3
/*-----------------------------------------------------------------------------------*/

if (!function_exists('loop_columns')) {

	function loop_columns() {
		return 3; // 3 products per row
	}

}
add_filter('loop_shop_columns', 'loop_columns');

/*-----------------------------------------------------------------------------------*/
/*	WooCommerce - Wrap star rating in a container
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_woocommerce_star_rating_container' ) ) {

	function wplook_woocommerce_star_rating_container( $rating_html, $rating ) {
		return '<div class="star-rating-container">' . $rating_html . '</div>';
	}

	add_filter( 'woocommerce_product_get_rating_html', 'wplook_woocommerce_star_rating_container', 100, 2 );

}

/*-----------------------------------------------------------------------------------*/
/*	Change the amount of items per page in the WC loop to 12
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_woocommerce_loop_items' ) ) {

	function wplook_woocommerce_loop_items() {
		return 12;
	}

	add_filter( 'loop_shop_per_page', 'wplook_woocommerce_loop_items' );

}

/*-----------------------------------------------------------------------------------*/
/*	Change the amount of products per column in the WC related
/*  products loop to 3
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_woocommerce_loop_related_columns' ) ) {

	function wplook_woocommerce_loop_related_columns() {
		return 3;
	}

	add_filter( 'woocommerce_related_products_columns', 'wplook_woocommerce_loop_related_columns' );

}

/*-----------------------------------------------------------------------------------*/
/*	Change the amount of related products in WC to 3
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_woocommerce_loop_related_products' ) ) {

	function wplook_woocommerce_loop_related_products( $args ) {

		$custom_args = array(
			'posts_per_page' => 3,
		);

		return array_merge( $args, $custom_args );
	}

	add_filter( 'woocommerce_related_products_args', 'wplook_woocommerce_loop_related_products' );

}

?>
