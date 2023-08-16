<?php
/**
 * The default Theme Options
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */


/*-----------------------------------------------------------------------------------*/
/*	Initialize the options before anything else.
/*-----------------------------------------------------------------------------------*/

add_action( 'admin_init', 'wpl_theme_options', 1 );

/*-----------------------------------------------------------------------------------*/
/*	Build the custom settings & update OptionTree.
/*-----------------------------------------------------------------------------------*/
if (!function_exists('wpl_theme_options')) {

	function wpl_theme_options() {

		/*-----------------------------------------------------------
			Get a copy of the saved settings array.
		-----------------------------------------------------------*/

		$saved_settings = get_option( 'option_tree_settings', array() );


		/*-----------------------------------------------------------
			Custom settings array that will eventually be  passes
			to the OptionTree Settings API Class.
		-----------------------------------------------------------*/

		$custom_settings = array(
			'contextual_help' => array(

				'content'       => array(
					array(
						'id'        => 'general_help',
						'title'     => 'General',
						'content'   => '<p>Help content goes here!</p>'
					)
				),

				'sidebar'       => '<p>Sidebar content goes here!</p>',
			),

			'sections'        => array(


				/*-----------------------------------------------------------
					General Settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'General settings', 'benevolence-wpl' ),
					'id'          => 'general_settings'
				),


				/*-----------------------------------------------------------
					Toolbar Settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Toolbar settings', 'benevolence-wpl' ),
					'id'          => 'toolbar_settings'
				),


				/*-----------------------------------------------------------
					Home Page Settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Home page settings', 'benevolence-wpl' ),
					'id'          => 'home_page_settings'
				),


				/*-----------------------------------------------------------
					Slider settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Slider settings', 'benevolence-wpl' ),
					'id'          => 'slider_settings'
				),


				/*-----------------------------------------------------------
					Causes settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Causes settings', 'benevolence-wpl' ),
					'id'          => 'causes_settings'
				),


				/*-----------------------------------------------------------
					Blog settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Blog settings', 'benevolence-wpl' ),
					'id'          => 'blog_settings'
				),


				/*-----------------------------------------------------------
					Events settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Events settings', 'benevolence-wpl' ),
					'id'          => 'events_settings'
				),


				/*-----------------------------------------------------------
					Staff settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Staff settings', 'benevolence-wpl' ),
					'id'          => 'staff_settings'
				),


				/*-----------------------------------------------------------
					Documents settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Documents settings', 'benevolence-wpl' ),
					'id'          => 'documents_settings'
				),


				/*-----------------------------------------------------------
					Projects settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Projects settings', 'benevolence-wpl' ),
					'id'          => 'projects_settings'
				),


				/*-----------------------------------------------------------
					Gallery settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Gallery settings', 'benevolence-wpl' ),
					'id'          => 'gallery_settings'
				),


				/*-----------------------------------------------------------
					Sermons settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Sermons settings', 'benevolence-wpl' ),
					'id'          => 'sermons_settings'
				),


				/*-----------------------------------------------------------
					Ministries settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Ministries settings', 'benevolence-wpl' ),
					'id'          => 'ministries_settings'
				),


				/*-----------------------------------------------------------
					Sponsors settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Sponsors settings', 'benevolence-wpl' ),
					'id'          => 'sponsors_settings'
				),


				/*-----------------------------------------------------------
					Payment settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'Payment settings', 'benevolence-wpl' ),
					'id'          => 'payment_settings'
				),

				/*-----------------------------------------------------------
					User Settings
				-----------------------------------------------------------*/

				array(
					'title'       => __('User Pages', 'benevolence-wpl'),
					'id'          => 'user_settings'
				),

				/*-----------------------------------------------------------
					Email settings for payments
				-----------------------------------------------------------*/

				array(
					'title'       => __('Email Templates', 'benevolence-wpl'),
					'id'          => 'email_settings'
				),

				/*-----------------------------------------------------------
					Google Maps settings
				-----------------------------------------------------------*/

				array(
					'title'       => __( 'API Settings', 'benevolence-wpl' ),
					'id'          => 'api_settings'
				)

			),

			'settings'        => array(

				/*-----------------------------------------------------------
					General Settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Logo Image', 'benevolence-wpl' ),
					'id'          => 'wpl_logo',
					'type'        => 'upload',
					'desc'        => __( 'Upload your own logo.', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Custom Cascading Style Sheets', 'benevolence-wpl' ),
					'id'          => 'wpl_css',
					'type'        => 'css',
					'desc'        => __( 'Add custom CSS to your theme.', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '10',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Google Analytics Tracking Code', 'benevolence-wpl' ),
					'id'          => 'wpl_google_analytics_tracking_code',
					'type'        => 'textarea-simple',
					'desc'        => __( 'Insert the complete tracking script from analytics.google.com', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '8',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Breadcrumb', 'benevolence-wpl' ),
					'id'          => 'wpl_breadcrumbs',
					'type'        => 'on-off',
					'desc'        => __( 'Activate or deactivate the breadcrumb', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Shopping cart', 'benevolence-wpl' ),
					'id'          => 'wpl_woo_cart',
					'type'        => 'on-off',
					'desc'        => __( 'Activate or deactivate the shopping cart. WooCommerce plugin is required', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),
				array(
					'label'       => __( 'Donate Text', 'benevolence-wpl' ),
					'id'          => 'wpl_donete_text',
					'type'        => 'text',
					'desc'        => __( 'Add text for donation button', 'benevolence-wpl' ),
					'std'         => __( 'Make a Donation!', 'benevolence-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Donate Link', 'benevolence-wpl' ),
					'id'          => 'wpl_donete_link',
					'type'        => 'text',
					'desc'        => __( 'Add the donate link', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Display share buttons on pages', 'benevolence-wpl' ),
					'id'          => 'wpl_pages_share',
					'type'        => 'on-off',
					'desc'        => __( 'Do you want social sharing buttons to be displayed on pages?', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Submenu on child page', 'benevolence-wpl' ),
					'id'          => 'wpl_menu_child',
					'type'        => 'on-off',
					'desc'        => __( 'Activate or deactivate the menu on pages.', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => __( 'Footer Content', 'benevolence-wpl' ),
					'id'          => 'wpl_copyright',
					'type'        => 'text',
					'desc'        => __( 'Enter the copyright notice displayed in the footer of the website.<br><br>Use <code>{{year}}</code> as a placeholder for the current year.', 'benevolence-wpl' ),
					'std'         => __( 'Copyright &copy; {{year}}. All rights reserved.', 'benevolence-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),


				/*-----------------------------------------------------------
					Toolbar Settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Social Network Navigation', 'benevolence-wpl' ),
					'id'          => 'social_media_share',
					'type'        => 'list-item',
					'desc'        => __( 'Press the <strong>Add New</strong> button in order to add social media links.', 'benevolence-wpl' ),
					'settings'    => array(
						array(
							'label'       => __( 'Service Name', 'benevolence-wpl' ),
							'id'          => 'wpl_share_item_name',
							'type'        => 'text',
							'desc'        => __( 'The name of the social network site, for example: "Facebook"', 'benevolence-wpl' ),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						),
						array(
							'label'       => __( 'URL', 'benevolence-wpl' ),
							'id'          => 'wpl_share_item_url',
							'type'        => 'text',
							'desc'        => __( 'Enter the URL of the social network site, for example: http://www.facebook.com/wplookthemes', 'benevolence-wpl' ),
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						),
						array(
							'label'       => __( 'Icon', 'benevolence-wpl' ),
							'id'          => 'wpl_share_item_icon',
							'type'        => 'text',
							'desc'        => __( '<strong>NOTICE</strong>: Choose one item from tne next list: fab fa-facebook-f, <br />fab fa-twitter, etc. For more options acccess: https://fontawesome.com/icons?d=gallery&m=free', 'benevolence-wpl' ),
							'std'         => 'fab fa-',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						),
					),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'toolbar_settings'
				),
				array(
					'label'       => __( 'Phone Number', 'benevolence-wpl' ),
					'id'          => 'wpl_phone_number',
					'type'        => 'text',
					'desc'        => __( 'Add a phone Number', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'toolbar_settings'
				),

				array(
					'label'       => __( 'RSS Link', 'benevolence-wpl' ),
					'id'          => 'wpl_rss_link',
					'type'        => 'text',
					'desc'        => __( 'Add the RSS link or Feedburner RSS Link', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'toolbar_settings'
				),

				array(
					'label'       => __( 'Contact page Link', 'benevolence-wpl' ),
					'id'          => 'wpl_contact_page_link',
					'type'        => 'custom-post-type-select',
					'desc'        => __( 'Select the contact page', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'toolbar_settings'
				),

				array(
					'label'       => __( 'Search Button', 'benevolence-wpl' ),
					'id'          => 'wpl_search_button',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the search option in the toolbar', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'toolbar_settings'
				),


				/*-----------------------------------------------------------
					Home Page Settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'First home page widget area', 'benevolence-wpl' ),
					'id'          => 'wpl_first_front_widget_size',
					'type'        => 'select',
					'desc'        => __( 'Set the size for first home page widget area', 'benevolence-wpl' ),
					'choices'     => array(
						array(
							'label'       => __( '25%', 'benevolence-wpl' ),
							'value'       => 'grid_3'
						),
						array(
							'label'       => __( '50%', 'benevolence-wpl' ),
							'value'       => 'grid_6'
						),
						array(
							'label'       => __( '75%', 'benevolence-wpl' ),
							'value'       => 'grid_9'
						),
						array(
							'label'       => __( '100%', 'benevolence-wpl' ),
							'value'       => 'grid_12'
						),
					),
					'std'         => 'grid_9',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'home_page_settings'
				),

				array(
					'label'       => __( 'Second home page widget area', 'benevolence-wpl' ),
					'id'          => 'wpl_second_front_widget_size',
					'type'        => 'select',
					'desc'        => __( 'Set the size for second home page widget area', 'benevolence-wpl' ),
					'choices'     => array(
						array(
							'label'       => __( '25%', 'benevolence-wpl' ),
							'value'       => 'grid_3'
						),
						array(
							'label'       => __( '50%', 'benevolence-wpl' ),
							'value'       => 'grid_6'
						),
						array(
							'label'       => __( '75%', 'benevolence-wpl' ),
							'value'       => 'grid_9'
						),
						array(
							'label'       => __( '100%', 'benevolence-wpl' ),
							'value'       => 'grid_12'
						),
					),
					'std'         => 'grid_3',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'home_page_settings'
				),

				array(
					'label'       => __( 'Third home page widget area', 'benevolence-wpl' ),
					'id'          => 'wpl_third_front_widget_size',
					'type'        => 'select',
					'desc'        => __( 'Set the size for third home page widget area', 'benevolence-wpl' ),
					'choices'     => array(
						array(
							'label'       => __( '25%', 'benevolence-wpl' ),
							'value'       => 'grid_3'
						),
						array(
							'label'       => __( '50%', 'benevolence-wpl' ),
							'value'       => 'grid_6'
						),
						array(
							'label'       => __( '75%', 'benevolence-wpl' ),
							'value'       => 'grid_9'
						),
						array(
							'label'       => __( '100%', 'benevolence-wpl' ),
							'value'       => 'grid_12'
						),
					),
					'std'         => 'grid_12',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'home_page_settings'
				),

				array(
					'label'       => __( 'Fourth home page widget area', 'benevolence-wpl' ),
					'id'          => 'wpl_forth_front_widget_size',
					'type'        => 'select',
					'desc'        => __( 'Set the size for fourth home page widget area', 'benevolence-wpl' ),
					'choices'     => array(
						array(
							'label'       => __( '25%', 'benevolence-wpl' ),
							'value'       => 'grid_3'
						),
						array(
							'label'       => __( '50%', 'benevolence-wpl' ),
							'value'       => 'grid_6'
						),
						array(
							'label'       => __( '75%', 'benevolence-wpl' ),
							'value'       => 'grid_9'
						),
						array(
							'label'       => __( '100%', 'benevolence-wpl' ),
							'value'       => 'grid_12'
						),
					),
					'std'         => 'grid_6',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'home_page_settings'
				),

				array(
					'label'       => __( 'Fifth home page widget area size', 'benevolence-wpl' ),
					'id'          => 'wpl_fifth_front_widget_size',
					'type'        => 'select',
					'desc'        => __( 'Set the size for fifth home page widget area', 'benevolence-wpl' ),
					'choices'     => array(
						array(
							'label'       => __( '25%', 'benevolence-wpl' ),
							'value'       => 'grid_3'
						),
						array(
							'label'       => __( '50%', 'benevolence-wpl' ),
							'value'       => 'grid_6'
						),
						array(
							'label'       => __( '75%', 'benevolence-wpl' ),
							'value'       => 'grid_9'
						),
						array(
							'label'       => __( '100%', 'benevolence-wpl' ),
							'value'       => 'grid_12'
						),
					),
					'std'         => 'grid_6',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'home_page_settings'
				),

				array(
					'label'       => __( 'Sixth home page widget area size', 'benevolence-wpl' ),
					'id'          => 'wpl_sixth_front_widget_size',
					'type'        => 'select',
					'desc'        => __( 'Set the size for sixth home page widget area', 'benevolence-wpl' ),
					'choices'     => array(
						array(
							'label'       => __( '25%', 'benevolence-wpl' ),
							'value'       => 'grid_3'
						),
						array(
							'label'       => __( '50%', 'benevolence-wpl' ),
							'value'       => 'grid_6'
						),
						array(
							'label'       => __( '75%', 'benevolence-wpl' ),
							'value'       => 'grid_9'
						),
						array(
							'label'       => __( '100%', 'benevolence-wpl' ),
							'value'       => 'grid_12'
						),
					),
					'std'         => 'grid_12',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'home_page_settings'
				),

				/*-----------------------------------------------------------
					Sliders settings
				-----------------------------------------------------------*/
				array(
					'label'       => __( 'Custom Post Type Slider', 'benevolence-wpl' ),
					'id'          => 'wpl_cpt_slider',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Slider', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'slider_settings'
				),

				array(
					'label'       => __( 'Order the Slider by:', 'benevolence-wpl' ),
					'id'          => 'wpl_cpt_slider_order_by',
					'type'        => 'select',
					'desc'        => __( 'Order the slider by: Post Date or Post Menu Order (Go to Slides -> Quick Edit -> Set the Order)', 'benevolence-wpl' ),
					'choices'     => array(
						array(
							'label'       => __( 'Post Date', 'benevolence-wpl' ),
							'value'       => 'date'
						),
						array(
							'label'       => __( 'Post Menu Order', 'benevolence-wpl' ),
							'value'       => 'menu_order'
						),
					),
					'std'         => 'date',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'slider_settings'
				),

				array(
					'label'       => __( 'Revolution Slider', 'benevolence-wpl' ),
					'id'          => 'wpl_rev_slider',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Revolution Slider. Revolution Slider is not included in the theme. You can buy it from here: http://bit.ly/1eD7aE1', 'benevolence-wpl' ),
					'std'         => 'off',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'slider_settings'
				),

				array(
					'label'       => __( 'Revolution Slider Alias', 'benevolence-wpl' ),
					'id'          => 'wpl_slider_revolution',
					'type'        => 'text',
					'desc'        => __( 'Revolution Slider Alias. If you have installed the revolution slider Plugin, add the Slider Alias here. From this example [rev_slider test] you need to add only the word test.', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'class'       => '',
					'taxonomy'    => '',
					'condition'   => 'wpl_rev_slider:is(on)',
					'section'     => 'slider_settings'
				),


				/*-----------------------------------------------------------
					Causes settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Causes', 'benevolence-wpl' ),
					'id'          => 'wpl_cpt_causes',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Causes', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'causes_settings'
				),

				array(
					'label'       => __( 'Custom Post Type Pledges', 'benevolence-wpl' ),
					'id'          => 'wpl_cpt_pledges',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Pledges', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'causes_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_causes_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'cause',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'causes_settings'
				),

				array(
					'label'       => __( 'URL Rewrite name', 'benevolence-wpl' ),
					'id'          => 'wpl_causes_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'benevolence-wpl' ),
					'std'         => __( 'Causes', 'benevolence-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'causes_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_causes_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'causes-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'causes_settings'
				),

				array(
					'label'       => __( 'Excerpt limit for list template', 'benevolence-wpl' ),
					'id'          => 'wpl_cause_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for causes excerpt.', 'benevolence-wpl' ),
					'std'         => '35',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'causes_settings'
				),

				array(
					'label'       => __( 'Excerpt limit for grid template', 'benevolence-wpl' ),
					'id'          => 'wpl_cause_grid_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for causes excerpt.', 'benevolence-wpl' ),
					'std'         => '20',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'causes_settings'
				),

				array(
					'label'       => __( 'Number of causes per page', 'benevolence-wpl' ),
					'id'          => 'wpl_cause_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many causes do you want to display on causes template.', 'benevolence-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'causes_settings'
				),

				array(
					'label'       => __( 'Taxonomy Template', 'benevolence-wpl' ),
					'id'          => 'wpl_cause_taxonomy_template',
					'type'        => 'select',
					'desc'        => __( 'Select the template you want to use for categories.', 'benevolence-wpl' ),
					'choices'     => array(
						array(
							'label'       => __( 'List', 'benevolence-wpl' ),
							'value'       => 'list'
						),
						array(
							'label'       => __( 'Grid', 'benevolence-wpl' ),
							'value'       => 'grid'
						),

					),
					'std'         => 'list',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'causes_settings'
				),


				/*-----------------------------------------------------------
					Blog settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Excerpt limit for list template', 'benevolence-wpl' ),
					'id'          => 'wpl_blog_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for blog excerpt.', 'benevolence-wpl' ),
					'std'         => '35',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Excerpt limit for grid template', 'benevolence-wpl' ),
					'id'          => 'wpl_blog_grid_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for blog excerpt.', 'benevolence-wpl' ),
					'std'         => '20',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Number of news per page', 'benevolence-wpl' ),
					'id'          => 'wpl_blog_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many cause do you want to display on blog template.', 'benevolence-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				// Single post settimgs
				array(
					'label'       => __( 'Featured image on single post', 'benevolence-wpl' ),
					'id'          => 'wpl_featured_image_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the Featured image on single post', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Date on single post', 'benevolence-wpl' ),
					'id'          => 'wpl_date_single_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the date on single post', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Author on single post', 'benevolence-wpl' ),
					'id'          => 'wpl_author_single_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the author on single post', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Category on single post', 'benevolence-wpl' ),
					'id'          => 'wpl_category_single_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the category on single post', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				// Blog post settings
				array(
					'label'       => __( 'Date on blog post', 'benevolence-wpl' ),
					'id'          => 'wpl_date_blog_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the date on blog post.', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),

				array(
					'label'       => __( 'Author on Blog post', 'benevolence-wpl' ),
					'id'          => 'wpl_author_blog_post',
					'type'        => 'on-off',
					'desc'        => __( 'Activate/Deactivated the author on blog post.', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'blog_settings'
				),


				/*-----------------------------------------------------------
					Events settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Events', 'benevolence-wpl' ),
					'id'          => 'wpl_cpt_events',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Events', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_events_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'events',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),

				array(
					'label'       => __( 'URL Rewrite name', 'benevolence-wpl' ),
					'id'          => 'wpl_events_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'benevolence-wpl' ),
					'std'         => __( 'Events', 'benevolence-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),

				array(
					'label'       => 'Category URL Rewrite',
					'id'          => 'wpl_events_category_url_rewrite',
					'type'        => 'text',
					'desc'        => '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes',
					'std'         => 'events-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),

				array(
					'label'       => __( 'Excerpt limit', 'benevolence-wpl' ),
					'id'          => 'wpl_events_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for upcoming and past events excerpt.', 'benevolence-wpl' ),
					'std'         => '40',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),

				array(
					'label'       => __( 'Pagination', 'benevolence-wpl' ),
					'id'          => 'wpl_events_pagination',
					'type'        => 'on-off',
					'desc'        => __( 'If pagination is enabled, the standard system of displaying events by month will be disabled, and replaced with a list of events. The number of months of events displayed will still be controlled by the Duration field. This works well on sites with few events, split over multiple months. This setting applies only to archive and category pages.', 'benevolence-wpl' ),
					'std'         => 'off',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),

				array(
					'label'       => __( 'Events per page', 'benevolence-wpl' ),
					'id'          => 'wpl_events_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'The number of events to display per page. This setting applies only to archive and category pages.', 'benevolence-wpl' ),
					'std'         => '10',
					'min_max_step'=> '5,25,1',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => 'wpl_events_pagination:is(on)',
					'section'     => 'events_settings'
				),

				array(
					'label'       => __( 'Duration', 'benevolence-wpl' ),
					'id'          => 'wpl_events_duration',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Select how many months of events this page will display. This setting applies only to archive and category pages.', 'benevolence-wpl' ),
					'std'         => 9,
					'min_max_step'=> '3,24,1',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),

				array(
					'label'       => __( 'Calendar language', 'benevolence-wpl' ),
					'id'          => 'wpl_events_calendar_language',
					'type'        => 'select',
					'choices'     => array(
						array(
							'value'       => 'ar-ma',
							'label'       => __( 'Arabic (Morocco)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'ar-sa',
							'label'       => __( 'Arabic (Saudi Arabia)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'ar-tn',
							'label'       => __( 'Arabic (Tunisia)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'ar',
							'label'       => __( 'Arabic (Standard)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'bg',
							'label'       => __( 'Bulgarian', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'ca',
							'label'       => __( 'Catalan', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'cs',
							'label'       => __( 'Czech', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'da',
							'label'       => __( 'Danish', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'de-at',
							'label'       => __( 'German (Austria)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'de',
							'label'       => __( 'German (Standard)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'el',
							'label'       => __( 'Greek', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'en-au',
							'label'       => __( 'English (Australia)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'en-ca',
							'label'       => __( 'English (Canada)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'en-gb',
							'label'       => __( 'English (United Kingdom)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'en-ie',
							'label'       => __( 'English (Ireland)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'en-nz',
							'label'       => __( 'English (New Zealand)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'en',
							'label'       => __( 'English (Standard)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'es',
							'label'       => __( 'Spanish', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'eu',
							'label'       => __( 'Basque', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'fa',
							'label'       => __( 'Farsi', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'fi',
							'label'       => __( 'Finnish', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'fr-ca',
							'label'       => __( 'French (Canada)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'fr-ch',
							'label'       => __( 'French (Switzerland)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'fr',
							'label'       => __( 'French (Standard)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'gl',
							'label'       => __( 'Galician', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'he',
							'label'       => __( 'Hebrew', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'hi',
							'label'       => __( 'Hindi', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'hr',
							'label'       => __( 'Croatian', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'hu',
							'label'       => __( 'Hungarian', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'id',
							'label'       => __( 'Indonesian', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'is',
							'label'       => __( 'Icelandic', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'it',
							'label'       => __( 'Italian', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'ja',
							'label'       => __( 'Japanese', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'ko',
							'label'       => __( 'Korean', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'lb',
							'label'       => __( 'Luxembourgish', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'lt',
							'label'       => __( 'Lithuanian', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'lv',
							'label'       => __( 'Latvian', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'nb',
							'label'       => __( 'Norwegian (Bokmål)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'nl',
							'label'       => __( 'Dutch', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'pl',
							'label'       => __( 'Polish', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'pt-br',
							'label'       => __( 'Portugese (Brazil)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'pt',
							'label'       => __( 'Portugese (Portugal)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'ro',
							'label'       => __( 'Romanian', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'ru',
							'label'       => __( 'Russian', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'sk',
							'label'       => __( 'Slovak', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'sl',
							'label'       => __( 'Slovenian', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'sr-cyrl',
							'label'       => __( 'Serbian (Cyrillic)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'sr',
							'label'       => __( 'Serbian (Latin)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'sv',
							'label'       => __( 'Swedish', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'th',
							'label'       => __( 'Thai', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'tr',
							'label'       => __( 'Turkish', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'uk',
							'label'       => __( 'Ukrainian', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'vi',
							'label'       => __( 'Vietnamese', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'zh-cn',
							'label'       => __( 'Chinese (PRC)', 'benevolence-wpl' ),
						),
						array(
							'value'       => 'zh-tw',
							'label'       => __( 'Chinese (Taiwan)', 'benevolence-wpl' ),
						),
					),
					'desc'        => __( 'Display the times in the Google Calendar and Events Calendar page templates in a format appropriate for a specified language and region.', 'benevolence-wpl' ),
					'std'         => 'en',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),


				/*-----------------------------------------------------------
					Staff settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Staff', 'benevolence-wpl' ),
					'id'          => 'wpl_cpt_staff',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Staff', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_staff_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'staff',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'URL Rewrite Name', 'benevolence-wpl' ),
					'id'          => 'wpl_staff_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'benevolence-wpl' ),
					'std'         => __( 'Staff', 'benevolence-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_staff_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'staff-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),

				array(
					'label'       => __( 'Number of staff per page', 'benevolence-wpl' ),
					'id'          => 'wpl_staff_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many staff members do you want to display on staff template.', 'benevolence-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'staff_settings'
				),


				/*-----------------------------------------------------------
					Documents settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Documents', 'benevolence-wpl' ),
					'id'          => 'wpl_cpt_documents',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Publications', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'documents_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_documents_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'document',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'documents_settings'
				),

				array(
					'label'       => __( 'URL Rewrite Name', 'benevolence-wpl' ),
					'id'          => 'wpl_documents_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'benevolence-wpl' ),
					'std'         => __( 'Documents', 'benevolence-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'documents_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_documents_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'document-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'documents_settings'
				),

				array(
					'label'       => __( 'Excerpt limit for list template', 'benevolence-wpl' ),
					'id'          => 'wpl_docs_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for documents excerpt.', 'benevolence-wpl' ),
					'std'         => '35',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'documents_settings'
				),

				array(
					'label'       => __( 'Excerpt limit for grid template', 'benevolence-wpl' ),
					'id'          => 'wpl_docs_grid_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for documents excerpt.', 'benevolence-wpl' ),
					'std'         => '20',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'documents_settings'
				),

				array(
					'label'       => __( 'Number of documents per page', 'benevolence-wpl' ),
					'id'          => 'wpl_docs_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many documents do you want to display on document template.', 'benevolence-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'documents_settings'
				),

				array(
					'label'       => __( 'Taxonomy Template', 'benevolence-wpl' ),
					'id'          => 'wpl_docs_taxonomy_template',
					'type'        => 'select',
					'desc'        => __( 'Select the template you want to use for categories.', 'benevolence-wpl' ),
					'choices'     => array(
						array(
							'label'       => __( 'Grid', 'benevolence-wpl' ),
							'value'       => 'grid'
						),
						array(
							'label'       => __( 'List', 'benevolence-wpl' ),
							'value'       => 'list'
						),
					),
					'std'         => 'grid',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'documents_settings'
				),

				/*-----------------------------------------------------------
					Project settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Projects', 'benevolence-wpl' ),
					'id'          => 'wpl_cpt_projects',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Projects', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_projects_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'project',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),

				array(
					'label'       => __( 'URL Rewrite Name', 'benevolence-wpl' ),
					'id'          => 'wpl_projects_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'benevolence-wpl' ),
					'std'         => __( 'Projects', 'benevolence-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_projects_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'projects-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),

				array(
					'label'       => __( 'Display project status box', 'benevolence-wpl' ),
					'id'          => 'wpl_projects_project_status_display',
					'type'        => 'on-off',
					'desc'        => __( 'Whether to display or hide the project status box on single project pages, including the project status, project start and end dates and sharing options.', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),

				array(
					'label'       => __('Projects - List Template', 'benevolence-wpl'),
					'id'          => 'wpl_projects_info',
					'type'        => 'textblock-titled',
					'desc'        => __('Settings for Projects - List Template', 'benevolence-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),


				array(
					'label'       => __( 'Excerpt limit for list template', 'benevolence-wpl' ),
					'id'          => 'wpl_projects_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for project excerpt.', 'benevolence-wpl' ),
					'std'         => '35',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),

				array(
					'label'       => __( 'Display/hide the author on list template', 'benevolence-wpl' ),
					'id'          => 'wpl_projects_author_list',
					'type'        => 'on-off',
					'desc'        => __( 'Display or hide the Author on list template', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),

				array(
					'label'       => __( 'Display/hide the date on list template', 'benevolence-wpl' ),
					'id'          => 'wpl_projects_date_list',
					'type'        => 'on-off',
					'desc'        => __( 'Display or hide the Date on list template', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),

				array(
					'label'       => __( 'Display/hide author on list template', 'benevolence-wpl' ),
					'id'          => 'wpl_projects_author_list',
					'type'        => 'on-off',
					'desc'        => __( 'Display or hide the Author on list template', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),

				array(
					'label'       => __( 'Excerpt limit for widget text and grid template', 'benevolence-wpl' ),
					'id'          => 'wpl_projects_widget_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for project excerpt.', 'benevolence-wpl' ),
					'std'         => '20',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),

				array(
					'label'       => __( 'Number of projects per page', 'benevolence-wpl' ),
					'id'          => 'wpl_projects_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many projects do you want to display on project template.', 'benevolence-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),

				array(
					'label'       => __( 'Taxonomy Template', 'benevolence-wpl' ),
					'id'          => 'wpl_projects_taxonomy_template',
					'type'        => 'select',
					'desc'        => __( 'Select the template you want to use for categories.', 'benevolence-wpl' ),
					'choices'     => array(
						array(
							'label'       => __( 'List', 'benevolence-wpl' ),
							'value'       => 'list'
						),
						array(
							'label'       => __( 'Grid', 'benevolence-wpl' ),
							'value'       => 'grid'
						),

					),
					'std'         => 'list',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'projects_settings'
				),


				/*-----------------------------------------------------------
					Gallery settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Gallery', 'benevolence-wpl' ),
					'id'          => 'wpl_cpt_galleries',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Gallery', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_gallery_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'gallery',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'URL Rewrite Name', 'benevolence-wpl' ),
					'id'          => 'wpl_gallery_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'benevolence-wpl' ),
					'std'         => __( 'Galleries', 'benevolence-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_gallery_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'gallery-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => __( 'Number of galleries per page', 'benevolence-wpl' ),
					'id'          => 'wpl_galleries_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many galleries do you want to display on gallery template.', 'benevolence-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),


				/*-----------------------------------------------------------
					Sermons settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Sermons', 'benevolence-wpl' ),
					'id'          => 'wpl_cpt_sermons',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Sermons', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sermons_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_sermons_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'sermon',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sermons_settings'
				),

				array(
					'label'       => __( 'URL Rewrite Name', 'benevolence-wpl' ),
					'id'          => 'wpl_sermon_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'benevolence-wpl' ),
					'std'         => __( 'Sermons', 'benevolence-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sermons_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_sermon_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'sermon-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sermons_settings'
				),

				array(
					'label'       => __( 'Excerpt limit for list template', 'benevolence-wpl' ),
					'id'          => 'wpl_sermon_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for excerpt.', 'benevolence-wpl' ),
					'std'         => '35',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sermons_settings'
				),

				array(
					'label'       => __( 'Excerpt limit for grid template', 'benevolence-wpl' ),
					'id'          => 'wpl_sermon_grid_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for excerpt.', 'benevolence-wpl' ),
					'std'         => '20',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sermons_settings'
				),

				array(
					'label'       => __( 'Number of sermons per page', 'benevolence-wpl' ),
					'id'          => 'wpl_sermon_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many sermons do you want to display on sermon template.', 'benevolence-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sermons_settings'
				),

				array(
					'label'       => __( 'Taxonomy Template', 'benevolence-wpl' ),
					'id'          => 'wpl_sermon_taxonomy_template',
					'type'        => 'select',
					'desc'        => __( 'Select the template you want to use for categories.', 'benevolence-wpl' ),
					'choices'     => array(
						array(
							'label'       => __( 'List', 'benevolence-wpl' ),
							'value'       => 'list'
						),
						array(
							'label'       => __( 'Grid', 'benevolence-wpl' ),
							'value'       => 'grid'
						),
					),
					'std'         => 'list',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sermons_settings'
				),

				/*-----------------------------------------------------------
					Ministries settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Ministries', 'benevolence-wpl' ),
					'id'          => 'wpl_cpt_ministry',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Ministries', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'ministries_settings'
				),

				array(
					'label'       => __( 'URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_ministries_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'ministry',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'ministries_settings'
				),

				array(
					'label'       => __( 'URL Rewrite Name', 'benevolence-wpl' ),
					'id'          => 'wpl_ministries_url_rewrite_name',
					'type'        => 'text',
					'desc'        => __( 'The URL Rewrite name will appear in the rootline/breadcrumb', 'benevolence-wpl' ),
					'std'         => __( 'Ministries', 'benevolence-wpl' ),
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'ministries_settings'
				),

				array(
					'label'       => __( 'Category URL Rewrite', 'benevolence-wpl' ),
					'id'          => 'wpl_ministries_category_url_rewrite',
					'type'        => 'text',
					'desc'        => __( '<strong>NOTE:</strong> After changing this field go to Settings > Permalinks > Save Changes', 'benevolence-wpl' ),
					'std'         => 'ministries-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'ministries_settings'
				),

				array(
					'label'       => __( 'Excerpt limit for list template', 'benevolence-wpl' ),
					'id'          => 'wpl_ministries_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for ministry excerpt.', 'benevolence-wpl' ),
					'std'         => '35',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'ministries_settings'
				),

				array(
					'label'       => __( 'Excerpt limit for widget text', 'benevolence-wpl' ),
					'id'          => 'wpl_ministries_widget_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many words do you want to display for ministries excerpt.', 'benevolence-wpl' ),
					'std'         => '20',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'ministries_settings'
				),

				array(
					'label'       => __( 'Number of ministries per page', 'benevolence-wpl' ),
					'id'          => 'wpl_ministries_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many items do you want to display on ministries template.', 'benevolence-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'ministries_settings'
				),



				/*-----------------------------------------------------------
					Sponsors settings
				-----------------------------------------------------------*/

				array(
					'label'       => __( 'Custom Post Type Sponsors', 'benevolence-wpl' ),
					'id'          => 'wpl_cpt_sponsors',
					'type'        => 'on-off',
					'desc'        => __( 'Activate the Custom Post Type Sponsors', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),

				array(
					'label'       => __( 'Number of Sponsor to display', 'benevolence-wpl' ),
					'id'          => 'wpl_sponsors_per_page',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Set how many sponsors do you want to display.', 'benevolence-wpl' ),
					'std'         => '10',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'sponsors_settings'
				),


				/*-----------------------------------------------------------
					Payment settings
				-----------------------------------------------------------*/

				array(
					'label'       => '',
					'id'          => 'wpl_payment_settings_description',
					'type'        => 'textblock',
					'desc'        => sprintf( __( 'Enter your credentials for the PayPal and Stripe APIs here. To create keys, follow instructions in the <a href="%s" target="_blank">WPlook Themes documentation</a>.', 'benevolence-wpl' ), 'https://wplook.com/docs/benevolence/theme-options-benevolence/payment-settings/' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'payment_settings'
				),

				/* PAYPAL SETTINGS */

				array(
					'label'       => __( 'PayPal', 'benevolence-wpl' ),
					'id'          => 'wpl_payment_settings_tab_paypal',
					'type'        => 'tab',
					'section'     => 'payment_settings'
				),

				array(
					'label'       => __( 'Enable PayPal', 'benevolence-wpl' ),
					'id'          => 'wpl_activate_paypal',
					'type'        => 'on-off',
					'desc'        => __( 'Enable and configure below to allow your site to accept donations through PayPal.', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'payment_settings'
				),

				array(
					'label'       => __( 'API Username', 'benevolence-wpl' ),
					'id'          => 'wpl_pp_api_username',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => 'wpl_activate_paypal:is(on)',
					'section'     => 'payment_settings'
				),

				array(
					'label'       => __( 'API Password', 'benevolence-wpl' ),
					'id'          => 'wpl_pp_api_password',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => 'wpl_activate_paypal:is(on)',
					'section'     => 'payment_settings'
				),

				array(
					'label'       => __( 'API Signature', 'benevolence-wpl' ),
					'id'          => 'wpl_pp_api_signature',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => 'wpl_activate_paypal:is(on)',
					'section'     => 'payment_settings'
				),

				array(
					'label'       => __( 'Success Page', 'benevolence-wpl' ),
					'id'          => 'wpl_pp_return_page',
					'type'        => 'custom-post-type-select',
					'desc'        => __( 'Select the page where the user will be redirected to after a successful donation. This page <strong>must</strong> use the <strong>PayPal Thank You!</strong> page template.', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => 'wpl_activate_paypal:is(on)',
					'section'     => 'payment_settings'
				),

				array(
					'label'       => __( 'Failure Page', 'benevolence-wpl' ),
					'id'          => 'wpl_pp_return_cancel',
					'type'        => 'custom-post-type-select',
					'desc'        => __( 'Select the page where the user will be redirected to after a failed or cancelled donation. This page doesn\'t have to use a specific page template.', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => 'wpl_activate_paypal:is(on)',
					'section'     => 'payment_settings'
				),

				/* STRIPE SETTINGS */

				array(
					'label'       => __( 'Stripe', 'benevolence-wpl' ),
					'id'          => 'wpl_payment_settings_tab_stripe',
					'type'        => 'tab',
					'section'     => 'payment_settings'
				),

				array(
					'label'       => __('Enable Stripe', 'benevolence-wpl'),
					'id'          => 'wpl_activate_cc_payment',
					'type'        => 'on-off',
					'desc'        => __( 'Enable and configure below to allow your site to accept donations through Stripe, allowing users to put in their debit or credit card details directly on your site, before using Stripe to complete the payment.', 'benevolence-wpl' ),
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'payment_settings'
				),

				array(
					'label'       => __('Live Secret Key', 'benevolence-wpl'),
					'id'          => 'wpl_cc_secret_key',
					'type'        => 'text',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'payment_settings',
					'condition'   => 'wpl_activate_cc_payment:is(on)',
				),
				array(
					'label'       => __('Live Publishable Key', 'benevolence-wpl'),
					'id'          => 'wpl_cc_publishable_key',
					'type'        => 'text',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'payment_settings',
					'condition'   => 'wpl_activate_cc_payment:is(on)',
				),
				array(
					'label'       => __('Processing Page', 'benevolence-wpl'),
					'id'          => 'wpl_stripe_process_page',
					'type'        => 'custom-post-type-select',
					'desc'        => __( 'Select the page where the user will be redirected to after a successful donation. This page <strong>must</strong> use the <strong>Stripe Thank You!</strong> page template.', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => 'wpl_activate_cc_payment:is(on)',
					'section'     => 'payment_settings'
				),

				/* SITE SETTINGS */

				array(
					'label'       => __( 'Site Settings', 'benevolence-wpl' ),
					'id'          => 'wpl_payment_settings_tab_site',
					'type'        => 'tab',
					'section'     => 'payment_settings'
				),

				array(
					'label'       => __( 'Minimum Donation Amount', 'benevolence-wpl' ),
					'id'          => 'wpl_min_amount',
					'type'        => 'numeric-slider',
					'desc'        => __( 'Enter the minimum donation amount for the Custom Amount box on Cause pages.', 'benevolence-wpl' ),
					'std'         => '5',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'payment_settings'
				),

				array(
					'label'       => __( 'Currency Code', 'benevolence-wpl' ),
					'id'          => 'wpl_curency_code',
					'type'        => 'text',
					'desc'        => __( 'Select the currency code for your country, such as USD, EUR or CAD.', 'benevolence-wpl' ),
					'std'         => 'USD',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'payment_settings'
				),

				/*-----------------------------------------------------------
					User settings
				-----------------------------------------------------------*/
				array(
					'label'       => __('Register Page','benevolence-wpl'),
					'id'          => 'wpl_register_link',
					'type'        => 'custom-post-type-select',
					'desc'        => __('Select register page','benevolence-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => '',
					'section'     => 'user_settings'
				),
				array(
					'label'       => __('Login Page','benevolence-wpl'),
					'id'          => 'wpl_login_link',
					'type'        => 'custom-post-type-select',
					'desc'        => __('Select Login page','benevolence-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => '',
					'section'     => 'user_settings'
				),
				array(
					'label'       => __('Subscriptions Page','benevolence-wpl'),
					'id'          => 'wpl_subscriptions_link',
					'type'        => 'custom-post-type-select',
					'desc'        => __('Select Subscriptions page','benevolence-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => '',
					'section'     => 'user_settings'
				),
				array(
					'label'       => __('Donations Page','benevolence-wpl'),
					'id'          => 'wpl_donations_link',
					'type'        => 'custom-post-type-select',
					'desc'        => __('Select donations page','benevolence-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => '',
					'section'     => 'user_settings'
				),


				/*-----------------------------------------------------------
					Email setting
				-----------------------------------------------------------*/
				array(
					'label'       => __('Email Variables', 'benevolence-wpl'),
					'id'          => 'wpl_email_vars',
					'type'        => 'textblock-titled',
					'desc'        => __('
							<p>Use these variables in the email content to automatically replace them with data relevant to the transaction.</p>
							<p>First Name - <code>{{ wpl_first_name }}</code></p>
							<p>Last Name - <code>{{ wpl_last_name }}</code></p>
							<p>Donation Amount - <code>{{ wpl_total }}</code></p>
							<p>Curency Code - <code>{{ wpl_curency_code }}</code></p>
							<p>Cause URL - <code>{{ wpl_url_cause }}</code></p>
							<p>Cause Title - <code>{{ wpl_title_cause }}</code></p>
							<p>Customer ID - <code>{{ wpl_customer }}</code></p>
							<p>Payment ID - <code>{{ wpl_charge_id }}</code></p>
							<p>Site Name - <code>{{ wpl_blog_name }}</code></p>
						', 'benevolence-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'email_settings'
				),

				array(
					'label'       => __('User email title','benevolence-wpl'),
					'id'          => 'wpl_email_title_to_user',
					'type'        => 'text',
					'desc'        => __('The title of the email sent to the user upon a successful payment.','benevolence-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => '',
					'section'     => 'email_settings'
				),
				array(
					'label'       => __('User email message','benevolence-wpl'),
					'id'          => 'wpl_email_message_to_user',
					'type'        => 'textarea',
					'desc'        => __('The content of the email sent to the user upon a successful payment.','benevolence-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => '',
					'section'     => 'email_settings'
				),
				array(
					'label'       => __('Admin email title','benevolence-wpl'),
					'id'          => 'wpl_email_title_to_admin',
					'type'        => 'text',
					'desc'        => __('The title of the email sent to the site administrator upon a successful payment.','benevolence-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => '',
					'section'     => 'email_settings'
				),
				array(
					'label'       => __('Admin email message','benevolence-wpl'),
					'id'          => 'wpl_email_message_to_admin',
					'type'        => 'textarea',
					'desc'        => __('The content of the email sent to the site administrator upon a successful payment.','benevolence-wpl'),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'condition'   => '',
					'section'     => 'email_settings'
				),


				/*-----------------------------------------------------------
					API settings
				-----------------------------------------------------------*/

				array(
					'label'       => '',
					'id'          => 'wpl_api_settings_description',
					'type'        => 'textblock',
					'desc'        => sprintf( __( 'Enter your credentials for the Google Maps API and the Google Calendar API here. To create keys, follow instructions in the <a href="%s" target="_blank">WPlook Themes documentation</a>.', 'benevolence-wpl' ), 'https://wplook.com/docs/benevolence/theme-options-benevolence/api-settings/' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'api_settings'
				),

				array(
					'label'       => __( 'Google Maps API', 'benevolence-wpl' ),
					'id'          => 'wpl_api_settings_google_maps_tab',
					'type'        => 'tab',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'api_settings'
				),

				array(
					'label'       => '',
					'id'          => 'wpl_api_settings_google_maps_description',
					'type'        => 'textblock',
					'desc'        => __( 'The Google Maps API is used for displaying maps on events pages.', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'api_settings'
				),

				array(
					'label'       => __( 'Browser key', 'benevolence-wpl' ),
					'id'          => 'wpl_maps_api_browser_key',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'api_settings'
				),

				array(
					'label'       => __( 'Server key', 'benevolence-wpl' ),
					'id'          => 'wpl_maps_api_server_key',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'api_settings'
				),

				array(
					'label'       => __( 'Google Calendar API', 'benevolence-wpl' ),
					'id'          => 'wpl_api_settings_google_calendar_tab',
					'type'        => 'tab',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'api_settings'
				),

				array(
					'label'       => '',
					'id'          => 'wpl_api_settings_google_calendar_description',
					'type'        => 'textblock',
					'desc'        => __( 'The Google Calendar API is used for displaying the calendar on the Google Calendar page template and the list of events in the Google Calendar widget.', 'benevolence-wpl' ),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'api_settings'
				),

				array(
					'label'       => __( 'Google Calendar API key', 'benevolence-wpl' ),
					'id'          => 'wpl_api_settings_google_calendar_key',
					'type'        => 'text',
					'desc'        => '',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'api_settings'
				),


			)
		);
		/* settings are not the same update the DB */
		if ( $saved_settings !== $custom_settings ) {
			update_option( 'option_tree_settings', $custom_settings );
		}
	}
}
