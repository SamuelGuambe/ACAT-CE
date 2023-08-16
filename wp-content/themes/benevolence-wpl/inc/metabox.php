<?php
/**
 * The default Meta Box Settings
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 5.0
 */


/*-----------------------------------------------------------
	Metabox for Default Page
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_page_meta_box' ) ) {

	function wpl_page_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Page Options', 'benevolence-wpl' ),
			'id'         => 'page_meta_box',
			'post_types' => ['page'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Header image', 'benevolence-wpl' ),
					'id'   => $prefix . 'header_image',
					'desc' => esc_html__( 'The image will be displayed in the header of the page, the required dimensions:  (1680 x 275)', 'benevolence-wpl' ),
				],
				[
					'type'    => 'select',
					'name'    => esc_html__( 'Sidebar Options', 'benevolence-wpl' ),
					'id'      => $prefix . 'sidebar_option',
					'desc'    => esc_html__( 'Display or hide the sidebar on this page', 'benevolence-wpl' ),
					'options' => [
						'on'     => esc_html__( 'On', 'benevolence-wpl' ),
						'off'     => esc_html__( 'Off', 'benevolence-wpl' ),
					],
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_page_meta_box' );
}


/*-----------------------------------------------------------
	Metabox for Documents
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_documents_meta_box' ) ) {

	function wpl_documents_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Document Options', 'benevolence-wpl' ),
			'id'         => 'documents_meta_box',
			'post_types' => ['post_documents'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Header image', 'benevolence-wpl' ),
					'id'   => $prefix . 'header_image',
					'desc' => esc_html__( 'The image will be displayed in the header of the page, the required dimensions:  (1680 x 275)', 'benevolence-wpl' ),
				],
				[
					'type' => 'file_input',
					'name' => esc_html__( 'File', 'benevolence-wpl' ),
					'id'   => $prefix . 'document_file',
					'desc' => esc_html__( 'Upload the file. (The file must have the .pdf extension.', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'File size', 'benevolence-wpl' ),
					'id'   => $prefix . 'document_file_size',
					'desc' => esc_html__( 'The file size. (For ex: 1.45MB)', 'benevolence-wpl' ),
				],
				[
					'type'    => 'select_advanced',
					'name'    => esc_html__( 'Share Buttons', 'benevolence-wpl' ),
					'id'      => $prefix . 'share_buttons',
					'desc'    => esc_html__( 'Activate or deactivate Share Buttons', 'benevolence-wpl' ),
					'options' => [
						'on'  => esc_html__( 'On', 'benevolence-wpl' ),
						'off' => esc_html__( 'Off', 'benevolence-wpl' ),
					],
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_documents_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Posts
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_blog_meta_box' ) ) {

	function wpl_blog_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Post Options', 'benevolence-wpl' ),
			'id'         => 'blog_meta_box',
			'post_types' => ['post'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Header image', 'benevolence-wpl' ),
					'id'   => $prefix . 'header_image',
					'desc' => esc_html__( 'The image will be displayed in the header of the page, the required dimensions:  (1680 x 275)', 'benevolence-wpl' ),
				],
				[
					'type'    => 'select_advanced',
					'name'    => esc_html__( 'Share Buttons', 'benevolence-wpl' ),
					'id'      => $prefix . 'share_buttons',
					'desc'    => esc_html__( 'Activate or deactivate Share Buttons', 'benevolence-wpl' ),
					'options' => [
						'on'  => esc_html__( 'On', 'benevolence-wpl' ),
						'off' => esc_html__( 'Off', 'benevolence-wpl' ),
					],
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_blog_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Causes
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_causes_meta_box' ) ) {

	function wpl_causes_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Cause Options', 'benevolence-wpl' ),
			'id'         => 'causes_meta_box',
			'post_types' => ['post_causes'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Header image', 'benevolence-wpl' ),
					'id'   => $prefix . 'header_image',
					'desc' => esc_html__( 'The image will be displayed in the header of the page, the required dimensions:  (1680 x 275)', 'benevolence-wpl' ),
				],
				[
					'type'    => 'select',
					'name'    => esc_html__( 'Donation Button', 'benevolence-wpl' ),
					'id'      => $prefix . 'donation_box_cause',
					'desc'    => esc_html__( 'Activate or deactivate the donation button for this cause.', 'benevolence-wpl' ),
					'options' => [
						'on'  => esc_html__( 'On', 'benevolence-wpl' ),
						'off' => esc_html__( 'Off', 'benevolence-wpl' ),
					],
				],
				[
					'type'    => 'select',
					'name'    => esc_html__( 'Information box', 'benevolence-wpl' ),
					'id'      => $prefix . 'donation_info_box',
					'desc'    => esc_html__( 'Activate or deactivate the information box for this cause.', 'benevolence-wpl' ),
					'options' => [
						'on'  => esc_html__( 'On', 'benevolence-wpl' ),
						'off' => esc_html__( 'Off', 'benevolence-wpl' ),
					],
				],
				[
					'type'    => 'select',
					'name'    => esc_html__( 'Cause Status', 'benevolence-wpl' ),
					'id'      => $prefix . 'cause_status',
					'desc'    => esc_html__( 'Choose the Cause status', 'benevolence-wpl' ),
					'options' => [
						'none'     => esc_html__( 'None', 'benevolence-wpl' ),
						'active'   => esc_html__( 'Active', 'benevolence-wpl' ),
						'complete' => esc_html__( 'Complete', 'benevolence-wpl' ),
					],
					'std'     => 'none',
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Goal Amount', 'benevolence-wpl' ),
					'id'   => $prefix . 'goal_amount',
					'desc' => esc_html__( 'The amount that should be accumulated for this cause', 'benevolence-wpl' ),
				],
				[
					'type' => 'date',
					'name' => esc_html__( 'End Date', 'benevolence-wpl' ),
					'id'   => $prefix . 'cause_end_date',
					'desc' => esc_html__( 'End date', 'benevolence-wpl' ),
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_causes_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Projects
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_projects_meta_box' ) ) {

	function wpl_projects_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Project Options', 'benevolence-wpl' ),
			'id'         => 'projects_meta_box',
			'post_types' => ['post_projects'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Header image', 'benevolence-wpl' ),
					'id'   => $prefix . 'header_image',
					'desc' => esc_html__( 'The image will be displayed in the header of the page, the required dimensions:  (1680 x 275)', 'benevolence-wpl' ),
				],
				[
					'type'    => 'select',
					'name'    => esc_html__( 'Project Status', 'benevolence-wpl' ),
					'id'      => $prefix . 'project_status',
					'desc'    => esc_html__( 'Choose the Project status', 'benevolence-wpl' ),
					'options' => [
						'none'     => esc_html__( 'None', 'benevolence-wpl' ),
						'active'   => esc_html__( 'Active', 'benevolence-wpl' ),
						'complete' => esc_html__( 'Complete', 'benevolence-wpl' ),
					],
					'std'     => 'none',
				],
				[
					'type' => 'date',
					'name' => esc_html__( 'Start Date', 'benevolence-wpl' ),
					'id'   => $prefix . 'project_start_date',
					'desc' => esc_html__( 'Start date', 'benevolence-wpl' ),
				],
				[
					'type' => 'date',
					'name' => esc_html__( 'End Date', 'benevolence-wpl' ),
					'id'   => $prefix . 'project_end_date',
					'desc' => esc_html__( 'End date', 'benevolence-wpl' ),
				],
			],

		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_projects_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Slider
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_sliders_meta_box' ) ) {

	function wpl_sliders_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Slider Options', 'benevolence-wpl' ),
			'id'         => 'sliders_meta_box',
			'post_types' => ['post_sliders'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'text',
					'name' => esc_html__( 'Button Text', 'benevolence-wpl' ),
					'id'   => $prefix . 'slider_button_text',
					'desc' => esc_html__( 'The text which will be displayed on the button', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Button URL', 'benevolence-wpl' ),
					'id'   => $prefix . 'slider_button_url',
					'desc' => esc_html__( 'The page to which the button and slide will link', 'benevolence-wpl' ),
				],
				[
					'type'    => 'select',
					'name'    => esc_html__( 'Button target', 'benevolence-wpl' ),
					'id'      => $prefix . 'slider_button_target',
					'desc'    => esc_html__( 'Should the button URL be opened in a new browser window?', 'benevolence-wpl' ),
					'options' => [
						'on'  => esc_html__( 'Yes', 'benevolence-wpl' ),
						'off' => esc_html__( 'No', 'benevolence-wpl' ),
					],
					'std'     => 'off',
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_sliders_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Gallery
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_gallery_meta_box' ) ) {

	function wpl_gallery_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Gallery Options', 'benevolence-wpl' ),
			'id'         => 'gallery_meta_box',
			'post_types' => ['post_gallery'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Header image', 'benevolence-wpl' ),
					'id'   => $prefix . 'header_image',
					'desc' => esc_html__( 'The image will be displayed in the header of the page, the required dimensions:  (1680 x 275)', 'benevolence-wpl' ),
				],
				[
					'name'   => esc_html__('Gallery', 'benevolence-wpl'), // Optional
					'id'     => $prefix . 'cpt_gallery',
					'type'   => 'group',
					'desc'   => esc_html__('Press the Add button in order to add images to gallery.', 'benevolence-wpl'), // Optional
					'clone'  => true,
					'sort_clone' => true,
					'collapsible' => true,
					'save_state'  => true,
					'group_title' => array( 'field' => $prefix .'cpt_image_caption' ),
					'fields'     => [
						[
							'type' => 'text',
							'name' => esc_html__( 'Caption', 'benevolence-wpl' ),
							'id'   => $prefix . 'cpt_image_caption',
							'desc' => esc_html__( 'Image caption', 'benevolence-wpl' ),
						],
						[
							'type' => 'file_input',
							'name' => esc_html__( 'Gallery Image', 'benevolence-wpl' ),
							'id'   => $prefix . 'cpt_image',
							'desc' => esc_html__( 'The required dimensions:  (1200 x 800 px)', 'benevolence-wpl' ),
						],

					],
				],
				[
					'type'    => 'select_advanced',
					'name'    => esc_html__( 'Sidebar Option', 'benevolence-wpl' ),
					'id'      => $prefix . 'sidebar_option',
					'desc'    => esc_html__( 'Should the button URL be opened in a new browser window?', 'benevolence-wpl' ),
					'options' => [
						'on'  => esc_html__( 'On', 'benevolence-wpl' ),
						'off' => esc_html__( 'Off', 'benevolence-wpl' ),
					],
					'std'     => 'on',
				],
				[
					'type'    => 'select_advanced',
					'name'    => esc_html__( 'Share Buttons', 'benevolence-wpl' ),
					'id'      => $prefix . 'share_buttons',
					'desc'    => esc_html__( 'Activate or deactivate Share Buttons', 'benevolence-wpl' ),
					'options' => [
						'on'  => esc_html__( 'On', 'benevolence-wpl' ),
						'off' => esc_html__( 'Off', 'benevolence-wpl' ),
					],
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_gallery_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Pledges
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_pledge_meta_box' ) ) {

	function wpl_pledge_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Pledge Options', 'benevolence-wpl' ),
			'id'         => 'pledge_meta_box',
			'post_types' => ['post_pledges'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type'       => 'post',
					'name'       => esc_html__( 'Choose the cause', 'benevolence-wpl' ),
					'id'         => $prefix . 'pledge_cause',
					'desc'       => esc_html__( 'Choose the cause', 'benevolence-wpl' ),
					'post_type'  => 'post_causes',
					'field_type' => 'select_advanced',
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Transaction ID/Token', 'benevolence-wpl' ),
					'id'   => $prefix . 'pledge_transaction_id',
					'desc' => esc_html__( 'Add the transaction ID', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'First name', 'benevolence-wpl' ),
					'id'   => $prefix . 'pledge_first_name',
					'desc' => esc_html__( 'Add the first name', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Last name', 'benevolence-wpl' ),
					'id'   => $prefix . 'pledge_last_name',
					'desc' => esc_html__( 'Add the last name', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Country', 'benevolence-wpl' ),
					'id'   => $prefix . 'pledge_country',
					'desc' => esc_html__( 'Add the Postal Code/Country', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Email', 'benevolence-wpl' ),
					'id'   => $prefix . 'pledge_email',
					'desc' => esc_html__( 'Add the Email address', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Donation Amount', 'benevolence-wpl' ),
					'id'   => $prefix . 'pledge_donation_amount',
					'desc' => esc_html__( 'Add the Donation Amount', 'benevolence-wpl' ),
				],
				[
					'type'    => 'select',
					'name'    => esc_html__( 'Payment Source', 'benevolence-wpl' ),
					'id'      => $prefix . 'pledge_payment_source',
					'desc'    => esc_html__( 'Choose the pledge payment source', 'benevolence-wpl' ),
					'options' => [
						'manual'     => esc_html__( 'Manual', 'benevolence-wpl' ),
						'paypal'     => esc_html__( 'PayPal', 'benevolence-wpl' ),
						'stripe'     => esc_html__( 'Stripe', 'benevolence-wpl' ),
						'bank_transfer' => esc_html__( 'Bank Transfer', 'benevolence-wpl' ),
						'check_cash' => esc_html__( 'Check/Cash', 'benevolence-wpl' ),
					],
				],
				[
					'type'    => 'select',
					'name'    => esc_html__( 'Payment Status', 'benevolence-wpl' ),
					'id'      => $prefix . 'pledge_payment_Status',
					'desc'    => esc_html__( 'Choose the pledge payment status', 'benevolence-wpl' ),
					'options' => [
						'Completed' => esc_html__( 'Completed', 'benevolence-wpl' ),
						'Refunded'  => esc_html__( 'Refunded', 'benevolence-wpl' ),
						'Canceled'  => esc_html__( 'Canceled', 'benevolence-wpl' ),
					],
				],
				[
					'type'    => 'select',
					'name'    => esc_html__( 'Anonymous Donation', 'benevolence-wpl' ),
					'id'      => $prefix . 'pledge_anonymous',
					'desc'    => esc_html__( 'If enabled, the donation will be hidden from public donation lists.', 'benevolence-wpl' ),
					'options' => [
						'on' => esc_html__( 'Yes', 'benevolence-wpl' ),
						'off'  => esc_html__( 'No', 'benevolence-wpl' ),
					],
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_pledge_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Calendar Template
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_page_calendar_meta_box' ) ) {

	function wpl_page_calendar_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Calendar Options', 'benevolence-wpl' ),
			'id'         => 'page_calendar_meta_box',
			'post_types' => ['page'],
			'context'    => 'normal',
			'autosave'   => true,
			'visible' => array( 'page_template', 'template-events-calendar.php' ),
			'fields'     => [
				[
					'type' => 'color',
					'name' => esc_html__( 'Event Color', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_color',
					'desc' => esc_html__( 'The default color of the events in the calendar. If an event has it\'s own custom color set, the event will override this setting.', 'benevolence-wpl' ),
					'std'  => '#ff9900',
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_page_calendar_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Google Calendar Template
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_page_google_calendar_meta_box' ) ) {

	function wpl_page_google_calendar_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Google Calendar Options', 'benevolence-wpl' ),
			'id'         => 'page_google_calendar_meta_box',
			'post_types' => ['page'],
			'context'    => 'normal',
			'autosave'   => true,
			'visible' => array( 'page_template', 'template-google-calendar.php' ),
			'fields'     => [
				[
					'type' => 'color',
					'name' => esc_html__( 'Event Color', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_color',
					'desc' => esc_html__( 'The default color of the events in the calendar. If an event has it\'s own custom color set, the event will override this setting.', 'benevolence-wpl' ),
					'std'  => '#ff9900',
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Google Calendar ID', 'benevolence-wpl' ),
					'id'   => $prefix . 'google_calendar',
					'desc' => esc_html__( 'Add your Google Calendar ID. Read the theme documentation (wplook.com/docs) for more information.', 'benevolence-wpl' ),
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_page_google_calendar_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Upcoming Events Template
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_page_upcoming_events_meta_box' ) ) {

	function wpl_page_upcoming_events_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Events Display Options', 'benevolence-wpl' ),
			'id'         => 'page_upcoming_events_meta_box',
			'post_types' => ['page'],
			'context'    => 'normal',
			'autosave'   => true,
			'visible' => ['page_template', ['template-events-upcoming.php']],
			'fields'     => [
				[
					'type'    => 'select',
					'name'    => esc_html__( 'Pagination', 'benevolence-wpl' ),
					'id'      => $prefix . 'events_pagination',
					'desc'    => esc_html__( 'If pagination is enabled, the standard system of displaying events by month will be disabled, and replaced with a list of events. The number of months of events displayed will still be controlled by the Duration field. This works well on sites with few events, split over multiple months.', 'benevolence-wpl' ),
					'options' => [
						'on' => esc_html__( 'On', 'benevolence-wpl' ),
						'off'  => esc_html__( 'Off', 'benevolence-wpl' ),

					],
					'std'  => 'off',
				],
				[
					'type' => 'slider',
					'name' => esc_html__( 'Events per page', 'charity-wpl' ),
					'id'   => $prefix . 'events_per_page',
					'desc' => esc_html__( 'The number of events to display per page.', 'charity-wpl' ),
					'std'  => 10,
					'js_options' => array(
						'min'   => 5,
						'max'   => 25,
						'step'  => 1,
					),
					'visible' => ['wpl_events_pagination', '=', 'on'],
				],
				[
					'type' => 'slider',
					'name' => esc_html__( 'Duration', 'charity-wpl' ),
					'id'   => $prefix . 'events_duration',
					'desc' => esc_html__( 'Select how many months of events this page will display.', 'charity-wpl' ),
					'std'  => 12,
					'js_options' => array(
						'min'   => 3,
						'max'   => 240,
						'step'  => 1,
					),
					'visible' => ['wpl_events_pagination', '=', 'on'],
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_page_upcoming_events_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for past Events Template
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_page_past_events_meta_box' ) ) {

	function wpl_page_past_events_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Events Display Options', 'benevolence-wpl' ),
			'id'         => 'page_past_events_meta_box',
			'post_types' => ['page'],
			'context'    => 'normal',
			'autosave'   => true,
			'visible' => ['page_template', ['template-events-past.php']],
			'fields'     => [
				[
					'type'    => 'select_advanced',
					'name'    => esc_html__( 'Pagination', 'benevolence-wpl' ),
					'id'      => $prefix . 'events_pagination',
					'desc'    => esc_html__( 'If pagination is enabled, the standard system of displaying events by month will be disabled, and replaced with a list of events. The number of months of events displayed will still be controlled by the Duration field. This works well on sites with few events, split over multiple months.', 'benevolence-wpl' ),
					'options' => [
						'on' => esc_html__( 'On', 'benevolence-wpl' ),
						'off'  => esc_html__( 'Off', 'benevolence-wpl' ),

					],
					'std'  => 'off',
				],
				[
					'type' => 'slider',
					'name' => esc_html__( 'Events per page', 'charity-wpl' ),
					'id'   => $prefix . 'events_per_page',
					'desc' => esc_html__( 'The number of events to display per page.', 'charity-wpl' ),
					'std'  => 10,
					'js_options' => array(
						'min'   => 5,
						'max'   => 25,
						'step'  => 1,
					),
					'visible' => array( 'wpl_events_pagination', '=', 'on' ),
				],
				[
					'type' => 'slider',
					'name' => esc_html__( 'Duration', 'charity-wpl' ),
					'id'   => $prefix . 'events_duration',
					'desc' => esc_html__( 'Select how many months of events this page will display.', 'charity-wpl' ),
					'std'  => 12,
					'js_options' => array(
						'min'   => 3,
						'max'   => 240,
						'step'  => 1,
					),
					'visible' => array( 'wpl_events_pagination', '=', 'on' ),
				],


			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_page_past_events_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Upcoming Events Template
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_page_upcoming_events_meta_box' ) ) {

	function wpl_page_upcoming_events_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Events Display Options', 'benevolence-wpl' ),
			'id'         => 'page_upcoming_events_meta_box',
			'post_types' => ['page'],
			'context'    => 'normal',
			'autosave'   => true,
			'visible' => ['page_template', ['template-events-upcoming.php']],
			'fields'     => [
				[
					'type'    => 'select_advanced',
					'name'    => esc_html__( 'Pagination', 'benevolence-wpl' ),
					'id'      => $prefix . 'events_pagination',
					'desc'    => esc_html__( 'If pagination is enabled, the standard system of displaying events by month will be disabled, and replaced with a list of events. The number of months of events displayed will still be controlled by the Duration field. This works well on sites with few events, split over multiple months.', 'benevolence-wpl' ),
					'options' => [
						'on' => esc_html__( 'On', 'benevolence-wpl' ),
						'off'  => esc_html__( 'Off', 'benevolence-wpl' ),

					],
					'std'  => 'off',
				],
				[
					'type' => 'slider',
					'name' => esc_html__( 'Events per page', 'charity-wpl' ),
					'id'   => $prefix . 'events_per_page',
					'desc' => esc_html__( 'The number of events to display per page.', 'charity-wpl' ),
					'std'  => 10,
					'js_options' => array(
						'min'   => 5,
						'max'   => 25,
						'step'  => 1,
					),
					'visible' => ['wpl_events_pagination', '=', 'on'],
				],
				[
					'type' => 'slider',
					'name' => esc_html__( 'Duration', 'charity-wpl' ),
					'id'   => $prefix . 'events_duration',
					'desc' => esc_html__( 'Select how many months of events this page will display.', 'charity-wpl' ),
					'std'  => 12,
					'js_options' => array(
						'min'   => 3,
						'max'   => 240,
						'step'  => 1,
					),
					'visible' => ['wpl_events_pagination', '=', 'on'],
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_page_upcoming_events_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Events
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_events_meta_box' ) ) {

	function wpl_events_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Events Options', 'benevolence-wpl' ),
			'id'         => 'events_meta_box',
			'post_types' => ['post_events'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Header image', 'benevolence-wpl' ),
					'id'   => $prefix . 'header_image',
					'desc' => esc_html__( 'Optional! The image will be displayed in the header of the page, the required dimensions:  (1680 x 275)', 'benevolence-wpl' ),
				],
				[
					'type' => 'datetime',
					'name' => esc_html__( 'Start date and time', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_start',
					'desc' => esc_html__( 'The date and time of the start of the event, in the "YYYY-MM-DD HH:MM" format.', 'benevolence-wpl' ),
				],
				[
					'type' => 'datetime',
					'name' => esc_html__( 'End date and time', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_end',
					'desc' => esc_html__( 'he date and time of the end of the event, in the "YYYY-MM-DD HH:MM" format.', 'benevolence-wpl' ),
				],
				[
					'type'    => 'select_advanced',
					'name'    => esc_html__( 'Recurring event', 'benevolence-wpl' ),
					'id'      => $prefix . 'event_recurring_bool',
					'desc'    => esc_html__( 'Is this a recurring event?', 'benevolence-wpl' ),
					'options' => [
						'on'  => esc_html__( 'On', 'benevolence-wpl' ),
						'off' => esc_html__( 'Off', 'benevolence-wpl' ),
					],
					'std'     => 'off',
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Repeat every x days', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_recurring_repeat_every',
					'desc' => esc_html__( 'Required. Every how many days to repeat this event. For example, if you set the event to begin repeating from Tuesday 16/02/2029, to repeat every two days, it will repeat on Tuesday 16th, Thursday 18th, Saturday 20th and so on, until and including your repeat until date. The date set in start date and time will also be displayed as a separate event, so you do not need to include it in begin repeating from.', 'benevolence-wpl' ),
					'visible' => array( 'wpl_event_recurring_bool', '=', 'on' ),
					'class' => 'rwmb-special-color',
				],
				[
					'type' => 'datetime',
					'name' => esc_html__( 'Begin repeating from', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_recurring_repeat_from',
					'desc' => esc_html__( 'Required. The first date on which this event should repeat (for example, a week after the set event date).', 'benevolence-wpl' ),
					'visible' => array( 'wpl_event_recurring_bool', '=', 'on' ),
					'class' => 'rwmb-special-color',
				],
				[
					'type' => 'datetime',
					'name' => esc_html__( 'Repeat until', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_recurring_repeat_until',
					'desc' => esc_html__( 'Required. The last date on which this event should repeat.', 'benevolence-wpl' ),
					'visible' => array( 'wpl_event_recurring_bool', '=', 'on' ),
					'class' => 'rwmb-special-color',
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Event Ticket Service', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_service_name',
					'desc' => esc_html__( 'Add the event service name. For Example Facebook, Eventbrite.', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Event Ticket Service URL', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_service_url',
					'desc' => esc_html__( 'Add the event service url. Ex: Add the link to your Facebook or Eventbrite event page.', 'benevolence-wpl' ),
				],
				[
					'type' => 'color',
					'name' => esc_html__( 'Event Color', 'benevolence-wpl' ),
					'id'   => $prefix . 'single_event_color',
					'desc' => esc_html__( 'Select the event color for calendar. Keep it blank if you want to use the default event color.', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Event Location', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_location',
					'desc' => esc_html__( 'A user-friendly name of the building where the event will take place.', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Event Address', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_address',
					'desc' => esc_html__( 'User-friendly address of the event which will be displayed above the map in the information panel. Consider including some directions or a description of your event location to make it easier to find.', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Event Google Maps Location', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_google_maps',
					'desc' => esc_html__( 'Maps are displayed using Google Maps, so check your location is displayed correctly there before pasting it in here. Remember to include your Google Maps API key on the Theme Options page for maps to be displayed correctly.', 'benevolence-wpl' ),
				],
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Pin Map Icon', 'benevolence-wpl' ),
					'id'   => $prefix . 'event_pin_map_icon',
					'desc' => esc_html__( 'Upload an image of a pin for the map. Recommended image size: ~32x32px.', 'benevolence-wpl' ),
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_events_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Ministries
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_ministries_meta_box' ) ) {

	function wpl_ministries_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Ministry Options', 'benevolence-wpl' ),
			'id'         => 'ministries_meta_box',
			'post_types' => ['post_ministries'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Header image', 'benevolence-wpl' ),
					'id'   => $prefix . 'header_image',
					'desc' => esc_html__( 'Optional! The image will be displayed in the header of the page, the required dimensions:  (1680 x 275)', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'When the ministry will take place', 'benevolence-wpl' ),
					'id'   => $prefix . 'when',
					'desc' => esc_html__( 'Ex: Every Sunday', 'benevolence-wpl' ),
				],
				[
					'type' => 'time',
					'name' => esc_html__( 'Start Time', 'benevolence-wpl' ),
					'id'   => $prefix . 'ministry_time',
					'desc' => esc_html__( 'Insert the event time. Use 24h time format. Ex: 21:00', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Ministry Location', 'benevolence-wpl' ),
					'id'   => $prefix . 'ministry_location',
					'desc' => esc_html__( 'A user-friendly name of the building where the ministry will take place.', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Ministry Address', 'benevolence-wpl' ),
					'id'   => $prefix . 'ministry_address',
					'desc' => esc_html__( 'User-friendly address of the ministry which will be displayed above the map in the information panel. Consider including some directions or a description of your ministry location to make it easier to find.', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Ministry Google Maps Location', 'benevolence-wpl' ),
					'id'   => $prefix . 'ministry_google_maps',
					'desc' => esc_html__( 'Maps are dispayed using Google Maps, so check your location is displayed correctly there before pasting it in here. Remember to include your Google Maps API key on the Theme Options  page for maps to be displayed correctly.', 'benevolence-wpl' ),
				],
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Pin Map Icon', 'benevolence-wpl' ),
					'id'   => $prefix . 'ministry_pin_map_icon',
					'desc' => esc_html__( 'Upload an image of a pin for the map. Recommended image size: ~32x32px.', 'benevolence-wpl' ),
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_ministries_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Staff
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_staff_meta_box' ) ) {

	function wpl_staff_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Staff Options', 'benevolence-wpl' ),
			'id'         => 'staff_meta_box',
			'post_types' => ['post_staff'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Header image', 'benevolence-wpl' ),
					'id'   => $prefix . 'header_image',
					'desc' => esc_html__( 'Optional! The image will be displayed in the header of the page, the required dimensions:  (1680 x 275)', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Position', 'benevolence-wpl' ),
					'id'   => $prefix . 'candidate_position',
					'desc' => esc_html__( 'Candidate position, (ex: CEO/Co-Founder)', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Phone', 'benevolence-wpl' ),
					'id'   => $prefix . 'candidate_phone',
					'desc' => esc_html__( 'Candidate phone number', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Email', 'benevolence-wpl' ),
					'id'   => $prefix . 'candidate_email',
					'desc' => esc_html__( 'Candidate email address', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Blog URL', 'benevolence-wpl' ),
					'id'   => $prefix . 'candidate_blog',
					'desc' => esc_html__( 'Candidate Blog URL', 'benevolence-wpl' ),
				],
				[
					'name'   => esc_html__('Social Network links', 'benevolence-wpl'), // Optional
					'id'     => 'candidate_share',
					'type'   => 'group',
					'desc'   => esc_html__('Press the Add button in order to add social media links.', 'benevolence-wpl'), // Optional
					'clone'  => true,
					'sort_clone' => true,
					'collapsible' => true,
					'save_state'  => true,
					'group_title' => array( 'field' => $prefix .'share_item_name' ),
					'fields'     => [
						[
							'type' => 'text',
							'name' => esc_html__( 'Service Name', 'benevolence-wpl' ),
							'id'   => $prefix . 'share_item_name',
							'desc' => esc_html__( 'The name of the social network site, for example: "Facebook"', 'benevolence-wpl' ),
						],
						[
							'type' => 'text',
							'name' => esc_html__( 'URL', 'benevolence-wpl' ),
							'id'   => $prefix . 'share_item_url',
							'desc' => esc_html__( 'Enter the URL of the social network site, for example: http://www.facebook.com/wplookthemes', 'benevolence-wpl' ),
						],
						[
							'type' => 'text',
							'name' => esc_html__( 'Font Awesome Icon', 'benevolence-wpl' ),
							'id'   => $prefix . 'share_item_icon',
							'desc' => esc_html__( 'NOTICE: Choose one item from tne next list: fab fa-facebook-f, fab fa-twitter, etc. For more options acccess: https://fontawesome.com/icons?d=gallery&m=free', 'benevolence-wpl' ),
						],

					],
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_staff_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Sermons
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_sermons_meta_box' ) ) {

	function wpl_sermons_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Sermons Media Options', 'benevolence-wpl' ),
			'id'         => 'sermons_meta_box',
			'post_types' => ['post_sermons'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Header image', 'benevolence-wpl' ),
					'id'   => $prefix . 'header_image',
					'desc' => esc_html__( 'Optional! The image will be displayed in the header of the page, the required dimensions:  (1680 x 275)', 'benevolence-wpl' ),
				],
				[
					'name'   => esc_html__('Gallery', 'benevolence-wpl'), // Optional
					'id'     => $prefix . 'cpt_gallery',
					'type'   => 'group',
					'desc'   => esc_html__('Press the Add button in order to add images.', 'benevolence-wpl'), // Optional
					'clone'  => true,
					'sort_clone' => true,
					'collapsible' => true,
					//'save_state'  => true,
					'group_title' => array( 'field' => $prefix .'cpt_image_caption' ),
					'fields'     => [
						[
							'type' => 'text',
							'name' => esc_html__( 'Caption', 'benevolence-wpl' ),
							'id'   => $prefix . 'cpt_image_caption',
							'desc' => esc_html__( 'Image caption', 'benevolence-wpl' ),
						],
						[
							'type' => 'file_input',
							'name' => esc_html__( 'Gallery Image', 'benevolence-wpl' ),
							'id'   => $prefix . 'cpt_image',
							'desc' => esc_html__( 'The required dimensions:  (1200 x 800 px)', 'benevolence-wpl' ),
						],
					],
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'OLD Video URL', 'benevolence-wpl' ),
					'id'   => $prefix . 'cpt_video',
					'desc' => esc_html__( 'This field will be deprecated in the next versions. Keep this field Blank.', 'benevolence-wpl' ),
				],
				[
					'name'   => esc_html__('Video', 'benevolence-wpl'), // Optional
					'id'     => $prefix . 'cpt_video_sermons',
					'type'   => 'group',
					'desc'   => esc_html__('Press the Add button in order to add videos.', 'benevolence-wpl'), // Optional
					'clone'  => true,
					'sort_clone' => true,
					'collapsible' => true,
					'save_state'  => true,
					'group_title' => array( 'field' => $prefix .'cpt_video_title' ),
					'fields'     => [
						[
							'type' => 'text',
							'name' => esc_html__( 'Add Video Title', 'benevolence-wpl' ),
							'id'   => $prefix . 'cpt_video_title',
							'desc' => esc_html__( 'Add video Title', 'benevolence-wpl' ),
						],
						[
							'type' => 'text',
							'name' => esc_html__( 'Add Video URL', 'benevolence-wpl' ),
							'id'   => $prefix . 'cpt_video_url',
							'desc' => esc_html__( 'Add video url', 'benevolence-wpl' ),
						],

					],
				],
				[
					'name'   => esc_html__('Audio', 'benevolence-wpl'), // Optional
					'id'     => $prefix . 'cpt_audio',
					'type'   => 'group',
					'desc'   => esc_html__('Press the Add button in order to add audio files.', 'benevolence-wpl'), // Optional
					'clone'  => true,
					'sort_clone' => true,
					'collapsible' => true,
					'save_state'  => true,
					'group_title' => array( 'field' => $prefix .'cpt_audio_title' ),
					'fields'     => [
						[
							'type' => 'text',
							'name' => esc_html__( 'File title', 'benevolence-wpl' ),
							'id'   => $prefix . 'cpt_audio_title',
							'desc' => esc_html__( 'Title', 'benevolence-wpl' ),
						],
						[
							'type' => 'file_input',
							'name' => esc_html__( 'Audio File', 'benevolence-wpl' ),
							'id'   => $prefix . 'cpt_audio_file',
							'desc' => esc_html__( 'Add audio file', 'benevolence-wpl' ),
						],

					],
				],
				[
					'name'   => esc_html__('Documents', 'benevolence-wpl'), // Optional
					'id'     => $prefix . 'cpt_documents',
					'type'   => 'group',
					'desc'   => esc_html__('Press the Add button in order to add a document.', 'benevolence-wpl'), // Optional
					'clone'  => true,
					'sort_clone' => true,
					'collapsible' => true,
					'save_state'  => true,
					'group_title' => array( 'field' => $prefix .'cpt_document_title' ),
					'fields'     => [
						[
							'type' => 'text',
							'name' => esc_html__( 'File title', 'benevolence-wpl' ),
							'id'   => $prefix . 'cpt_document_title',
							'desc' => esc_html__( 'Title', 'benevolence-wpl' ),
						],
						[
							'type' => 'file_input',
							'name' => esc_html__( 'Document', 'benevolence-wpl' ),
							'id'   => $prefix . 'cpt_document_file',
							'desc' => esc_html__( 'Add a document', 'benevolence-wpl' ),
						],

					],
				],
				[
					'type'    => 'select_advanced',
					'name'    => esc_html__( 'Share Buttons', 'benevolence-wpl' ),
					'id'      => $prefix . 'share_buttons',
					'desc'    => esc_html__( 'Activate or deactivate Share Buttons', 'benevolence-wpl' ),
					'options' => [
						'on'  => esc_html__( 'On', 'benevolence-wpl' ),
						'off' => esc_html__( 'Off', 'benevolence-wpl' ),
					],
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_sermons_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for Sponsors
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_sponsor_meta_box' ) ) {

	function wpl_sponsor_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Sponsor Options', 'benevolence-wpl' ),
			'id'         => 'sponsor_meta_box',
			'post_types' => ['post_sponsor'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'file_input',
					'name' => esc_html__( 'Logo', 'benevolence-wpl' ),
					'id'   => $prefix . 'logo_image',
					'desc' => esc_html__( 'The required dimensions:  (260x80px).', 'benevolence-wpl' ),
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'URL', 'benevolence-wpl' ),
					'id'   => $prefix . 'sponsor_url',
					'desc' => esc_html__( 'Add a sponsor URL, ex: https://wplook.com', 'benevolence-wpl' ),
				],
				[
					'type'    => 'select_advanced',
					'name'    => esc_html__( 'Open in a new tab?', 'benevolence-wpl' ),
					'id'      => $prefix . 'sponsor_blank',
					'desc'    => esc_html__( 'Do you want to open the sponsors site in a new browser tab?', 'benevolence-wpl' ),
					'options' => [
						'on'  => esc_html__( 'Yes', 'benevolence-wpl' ),
						'off' => esc_html__( 'No', 'benevolence-wpl' ),
					],
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_sponsor_meta_box' );

}


/*-----------------------------------------------------------
	Metabox for CPT Media Box
-----------------------------------------------------------*/

if ( ! function_exists( 'wpl_cpt_media_meta_box' ) ) {

	function wpl_cpt_media_meta_box( $meta_boxes ) {
		$prefix = 'wpl_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Media Options', 'benevolence-wpl' ),
			'id'         => 'cpt_media_meta_box',
			'post_types' => ['post_causes', 'post_projects', 'post_events', 'post_ministries'],
			'context'    => 'normal',
			'autosave'   => true,
			'fields'     => [
				[
					'name'   => esc_html__('Gallery', 'benevolence-wpl'), // Optional
					'id'     => $prefix . 'cpt_gallery',
					'type'   => 'group',
					'desc'   => esc_html__('Press the Add button in order to add images to gallery.', 'benevolence-wpl'),
					'clone'  => true,
					'sort_clone' => true,
					'collapsible' => true,
					//'save_state'  => true,
					'group_title' => array( 'field' => $prefix .'cpt_image_caption' ),
					'fields'     => [
						[
							'type' => 'text',
							'name' => esc_html__( 'Caption', 'benevolence-wpl' ),
							'id'   => $prefix . 'cpt_image_caption',
							'desc' => esc_html__( 'Image caption', 'benevolence-wpl' ),
						],
						[
							'type' => 'file_input',
							'name' => esc_html__( 'Gallery Image', 'benevolence-wpl' ),
							'id'   => $prefix . 'cpt_image',
							'desc' => esc_html__( 'AThe required dimensions:  (1200 x 800 px)', 'benevolence-wpl' ),
						],

					],
				],
				[
					'type' => 'text',
					'name' => esc_html__( 'Video', 'benevolence-wpl' ),
					'id'   => $prefix . 'cpt_video',
					'desc' => esc_html__( 'Add a video for this cause', 'benevolence-wpl' ),
				],
				[
					'type'    => 'select_advanced',
					'name'    => esc_html__( 'Share Buttons', 'benevolence-wpl' ),
					'id'      => $prefix . 'share_buttons',
					'desc'    => esc_html__( 'Activate or deactivate Share Buttons', 'benevolence-wpl' ),
					'options' => [
						'on'  => esc_html__( 'On', 'benevolence-wpl' ),
						'off' => esc_html__( 'Off', 'benevolence-wpl' ),
					],
				],
			],
		];

		return $meta_boxes;
	}

	add_filter( 'rwmb_meta_boxes', 'wpl_cpt_media_meta_box' );

}?>
