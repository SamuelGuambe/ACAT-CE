<?php
/**
 * Headerdata
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */


/*-----------------------------------------------------------------------------------*/
/*	Include CSS
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'wpl_css_include' ) ) {

	function wpl_css_include () {

		// Vendors
		wp_enqueue_style( 'benevolence-vendors', get_template_directory_uri() . '/assets/styles/vendors.min.css',array(), wp_get_theme()->get('Version') );

		// Google Fonts
		wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic');


		/*-----------------------------------------------------------
			FullCalendar
		-----------------------------------------------------------*/
		wp_register_style( 'fullcalendar', get_template_directory_uri().'/inc/fullcalendar/fullcalendar.min.css' );

		if ( is_page_template('template-events-calendar.php') || is_page_template('template-google-calendar.php')) {
			wp_enqueue_style( 'fullcalendar' );
		}

		/*-----------------------------------------------------------
			Loads our main stylesheet.
		-----------------------------------------------------------*/

		wp_enqueue_style( 'benevolence-style', get_stylesheet_uri(), array(),wp_get_theme()->get('Version') );

	}
	add_action( 'wp_enqueue_scripts', 'wpl_css_include' );
}

/*-----------------------------------------------------------------------------------*/
/*	Include Java Scripts
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_scripts_include' ) ) {

	function wpl_scripts_include() {

		/*-----------------------------------------------------------
			Include jQuery
		-----------------------------------------------------------*/

		wp_enqueue_script('jquery');

		/*-----------------------------------------------------------
			Include Google Maps
		-----------------------------------------------------------*/
		if ( is_singular('post_events') || is_singular('post_ministries') ) {
			$maps_api_key = ot_get_option( 'wpl_maps_api_browser_key' );

			if( !empty( $maps_api_key ) ) {
				wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=' . $maps_api_key );
			} else {
				wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp' );
			}

			wp_enqueue_script( 'wplook-google-maps', get_template_directory_uri() . '/assets/javascripts/google-maps.js', array( 'jquery', 'google-maps-api' ), false, true );
		}

		/*-----------------------------------------------------------
	    	Base custom scripts
	    -----------------------------------------------------------*/

		wp_register_script( 'base', get_template_directory_uri().'/assets/javascripts/base.js', array( 'jquery' ), '', true );

		wp_localize_script( 'base', 'i18n', array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' )
		) );
		wp_enqueue_script( 'base' );


		/*-----------------------------------------------------------
			stickUp
		-----------------------------------------------------------*/

		wp_enqueue_script( 'stickUp', get_template_directory_uri().'/assets/javascripts/stickUp.min.js', '', '', 'footer' );


		/*-----------------------------------------------------------
			FlexSlider
		-----------------------------------------------------------*/

		wp_enqueue_script( 'flexslider', get_template_directory_uri().'/assets/javascripts/jquery.flexslider.js', '', '', 'footer' );


		/*-----------------------------------------------------------
			Owl Carousel
		-----------------------------------------------------------*/

		wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri().'/assets/javascripts/owl.carousel.min.js', '', '', 'footer' );


		/*-----------------------------------------------------------
			meanMenu
		-----------------------------------------------------------*/

		wp_enqueue_script( 'meanmenu', get_template_directory_uri().'/assets/javascripts/jquery.meanmenu.js', '', '', 'footer' );

		/*-----------------------------------------------------------
			Masonry
		-----------------------------------------------------------*/

		wp_enqueue_script( 'masonry', get_template_directory_uri().'/assets/javascripts/masonry.pkgd.min.js', '', '', 'footer' );

		/*-----------------------------------------------------------
			Image Loaded
		-----------------------------------------------------------*/

		wp_enqueue_script( 'imagesloaded', get_template_directory_uri().'/assets/javascripts/imageloaded.js', '', '', 'footer' );

		/*-----------------------------------------------------------
			Fitvids
		-----------------------------------------------------------*/

		wp_enqueue_script( 'fitvids', get_template_directory_uri().'/assets/javascripts/jquery.fitvids.js', '', '', 'footer' );

		/*-----------------------------------------------------------
			Moment, FullCalendar, Google Calendar
		-----------------------------------------------------------*/
		wp_register_script( 'moment', get_template_directory_uri().'/inc/fullcalendar/lib/moment.min.js', '', '', 'footer' );
		wp_register_script( 'fullcalendar', get_template_directory_uri().'/inc/fullcalendar/fullcalendar.min.js', array( 'moment', 'jquery' ), '', 'footer' );
		wp_register_script( 'fullcalendar-locale', get_template_directory_uri().'/inc/fullcalendar/locale-all.js', array( 'fullcalendar' ), '', 'footer' );
		wp_register_script( 'gcal', get_template_directory_uri().'/inc/fullcalendar/gcal.js', array( 'fullcalendar' ), '', 'footer' );

		if ( is_page_template('template-events-calendar.php') ||  is_page_template('template-google-calendar.php')) {
			wp_enqueue_script( 'moment' );
			wp_enqueue_script( 'fullcalendar' );
			wp_enqueue_script( 'fullcalendar-locale' );
			wp_enqueue_script( 'gcal' );
		}

		/*-----------------------------------------------------------
			Stripe JS
		-----------------------------------------------------------*/

		if ( ot_get_option('wpl_activate_cc_payment') == 'on' && (class_exists( 'WooCommerce' ) && !is_checkout()) ) {
			wp_enqueue_script( 'stripe', 'https://js.stripe.com/v2/', 'jquery', '', 'footer' );
		}

		/*-----------------------------------------------------------
			Comment reply script
		-----------------------------------------------------------*/
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}


	}

	add_action('wp_enqueue_scripts', 'wpl_scripts_include');
}

if( !function_exists( 'wpl_admin_scripts_include' ) ) {

	function wpl_admin_scripts_include( $hook ) {

		wp_enqueue_script( 'benevolence-wpl-admin-js', get_template_directory_uri() . '/assets/javascripts/admin.js', array( 'jquery' ), false, true );

		wp_enqueue_style( 'benevolence-wpl-admin-css', get_template_directory_uri() . '/assets/styles/admin.css' );
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		if( $hook == 'widgets.php' || $hook == 'customize.php' ) {
			wp_enqueue_style( 'wp-color-picker' );
    		wp_enqueue_script( 'wp-color-picker' );
    		wp_register_script('upload_media_widget', get_template_directory_uri().'/assets/javascripts/upload-media.min.js', array( 'jquery','media-upload','thickbox' ), false, true );
    		wp_enqueue_script('upload_media_widget');
		}

	}

	add_action( 'admin_enqueue_scripts', 'wpl_admin_scripts_include' );

}
