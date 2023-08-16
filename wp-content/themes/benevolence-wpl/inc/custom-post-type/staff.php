<?php
/**
 * The default Custom post type for Staff
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>
<?php

if (!function_exists('wpl_staff_cpt')) {
	function wpl_staff_cpt(){

		$url_rewrite = ot_get_option('wpl_staff_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'staff'; }

		$url_rewrite_name = ot_get_option('wpl_staff_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = 'Staff'; }

		register_post_type('post_staff',
			array(
				'labels' => array(
					'name' => __( 'Staff', 'benevolence-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Staff Member', 'benevolence-wpl' ),
					'add_new_item' => __( 'Add New Staff Member', 'benevolence-wpl' ),
					'edit' => __( 'Edit', 'benevolence-wpl' ),
					'edit_item' => __( 'Edit Staff Member', 'benevolence-wpl' ),
					'new_item' => __( 'New Staff Member', 'benevolence-wpl' ),
					'view' => __( 'View', 'benevolence-wpl' ),
					'view_item' => __( 'View Staff Member', 'benevolence-wpl' ),
					'search_items' => __( 'Search for Staff Members', 'benevolence-wpl' ),
					'not_found' => __( 'No Staff Members found', 'benevolence-wpl' ),
					'not_found_in_trash' => __( 'No Staff Members found in Trash', 'benevolence-wpl' ),
					'parent' => __( 'Parent Staff Member', 'benevolence-wpl' ),
				),
				'description' => __( 'Easily lets you create some beautiful Staff.', 'benevolence-wpl' ),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-nametag',
				'show_in_rest' => true,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author', 'custom-fields'),
			)
		);
	}
	add_action('init', 'wpl_staff_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for Staff
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_staff_category')) {
	function wpl_staff_category() {

		$url_rewrite = ot_get_option('wpl_staff_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'staff-items'; }

		register_taxonomy('wpl_staff_category', 'post_staff',
			array(
				'hierarchical' => true,
				'labels' => array(
					  'name' => __( 'Staff Departments', 'benevolence-wpl' ),
					  'singular_name' => __( 'Department', 'benevolence-wpl' ),
					  'search_items' =>  __( 'Search in Department', 'benevolence-wpl' ),
					  'popular_items' => __( 'Popular Departments', 'benevolence-wpl' ),
					  'all_items' => __( 'All Departments', 'benevolence-wpl' ),
					  'parent_item' => __( 'Parent Department', 'benevolence-wpl' ),
					  'parent_item_colon' => __( 'Parent Department:', 'benevolence-wpl' ),
					  'edit_item' => __( 'Edit Department', 'benevolence-wpl' ),
					  'update_item' => __( 'Update Department', 'benevolence-wpl' ),
					  'add_new_item' => __( 'Add New Department', 'benevolence-wpl' ),
					  'new_item_name' => __( 'New Department Name', 'benevolence-wpl' ),
				),
				'show_ui' => true,
				'query_var' => true,
				'show_in_rest' => true,
				'rewrite' => array('slug' => $url_rewrite)
			)
		);
	}
	add_action('init', 'wpl_staff_category');
}
