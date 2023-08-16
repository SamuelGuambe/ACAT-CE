<?php
/**
 * The default Custom post type for Events
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>
<?php
if (!function_exists('wpl_events_cpt')) {

	function wpl_events_cpt(){

		$url_rewrite = ot_get_option('wpl_events_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'event'; }

		$url_rewrite_name = ot_get_option('wpl_events_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = 'Event'; }

		register_post_type('post_events',
			array(
				'labels' => array(
					'name' => __( 'Events', 'benevolence-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Event', 'benevolence-wpl' ),
					'add_new_item' => __( 'Add New Event', 'benevolence-wpl' ),
					'edit' => __( 'Edit', 'benevolence-wpl' ),
					'edit_item' => __( 'Edit Event', 'benevolence-wpl' ),
					'new_item' => __( 'New Event', 'benevolence-wpl' ),
					'view' => __( 'View', 'benevolence-wpl' ),
					'view_item' => __( 'View Event', 'benevolence-wpl' ),
					'search_items' => __( 'Search Events', 'benevolence-wpl' ),
					'not_found' => __( 'No Events found', 'benevolence-wpl' ),
					'not_found_in_trash' => __( 'No Events found in Trash', 'benevolence-wpl' ),
					'parent' => __( 'Parent Event', 'benevolence-wpl' ),
				),
				'description' => __( 'Easily lets you create some beautiful Events.', 'benevolence-wpl' ),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-calendar-alt',
				'show_in_rest' => true,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author', 'custom-fields'),
			)
		);
	}
	add_action('init', 'wpl_events_cpt');
}


/*-----------------------------------------------------------------------------------*/
/*	Adding category for Evenys
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_events_category')) {

	function wpl_events_category() {

		$url_rewrite = ot_get_option('wpl_events_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'events-category'; }

		register_taxonomy('wpl_events_category', 'post_events',
			array(
				'hierarchical' => true,
				'labels' => array(
					'name' => __( 'Events Categories', 'benevolence-wpl' ),
					'singular_name' => __( 'Department', 'benevolence-wpl' ),
					'search_items' => __( 'Search in Category', 'benevolence-wpl' ),
					'popular_items' => __( 'Popular Categories', 'benevolence-wpl' ),
					'all_items' => __( 'All Categories', 'benevolence-wpl' ),
					'parent_item' => __( 'Parent Category', 'benevolence-wpl' ),
					'parent_item_colon' => __( 'Parent Category:', 'benevolence-wpl' ),
					'edit_item' => __( 'Edit Category', 'benevolence-wpl' ),
					'update_item' => __( 'Update Category', 'benevolence-wpl' ),
					'add_new_item' => __( 'Add New Category', 'benevolence-wpl' ),
					'new_item_name' => __( 'New Category Name', 'benevolence-wpl' ),
				),
				'show_ui' => true,
				'show_in_rest' => true,
				'query_var' => true,
				'rewrite' => array('slug' => $url_rewrite)
			)
		);
	}
	add_action('init', 'wpl_events_category');
}
