<?php
/**
 * The default Custom post type for Ministries
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since benevolence 1.0.0
 * @version 4.6
 */
?>
<?php
if (!function_exists('wpl_ministries_cpt')) {
	function wpl_ministries_cpt(){

		$url_rewrite = ot_get_option('wpl_ministries_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'ministry'; }

		$url_rewrite_name = ot_get_option('wpl_ministries_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = 'Ministry'; }

		register_post_type('post_ministries',
			array(
				'labels' => array(
					'name' => __( 'Ministries', 'benevolence-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Ministry', 'benevolence-wpl' ),
					'add_new_item' => __( 'Add New Ministry', 'benevolence-wpl' ),
					'edit' => __( 'Edit', 'benevolence-wpl' ),
					'edit_item' => __( 'Edit Ministry', 'benevolence-wpl' ),
					'new_item' => __( 'New Ministry', 'benevolence-wpl' ),
					'view' => __( 'View', 'benevolence-wpl' ),
					'view_item' => __( 'View Ministries', 'benevolence-wpl' ),
					'search_items' => __( 'Search Ministries', 'benevolence-wpl' ),
					'not_found' => __( 'No Ministries found', 'benevolence-wpl' ),
					'not_found_in_trash' => __( 'No Ministries found in Trash', 'benevolence-wpl' ),
					'parent' => __( 'Parent Project', 'benevolence-wpl' ),
				),
				'description' => __( 'Easily lets you create some beautiful Ministries.', 'benevolence-wpl' ),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-megaphone',
				'show_in_rest' => true,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author', 'custom-fields'),
			)
		);
	}
	add_action('init', 'wpl_ministries_cpt');
}


/*-----------------------------------------------------------------------------------*/
/*	Adding category for Ministries
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_ministries_category')) {
	function wpl_ministries_category() {

		$url_rewrite = ot_get_option('wpl_ministries_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'ministries-items'; }

		register_taxonomy('wpl_ministries_category', 'post_ministries',
			array(
				'hierarchical' => true,
				'labels' => array(
					  'name' => __( 'Ministry Categories', 'benevolence-wpl' ),
					  'singular_name' => __( 'Category', 'benevolence-wpl' ),
					  'search_items' =>  __( 'Search in Categories', 'benevolence-wpl' ),
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
				'query_var' => true,
				'show_in_rest' => true,
				'rewrite' => array('slug' => $url_rewrite)
			)
		);
	}
	add_action('init', 'wpl_ministries_category');
}
