<?php
/**
 * The default Custom post type for Causes
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>
<?php
if (!function_exists('wpl_causes_cpt')) {
	function wpl_causes_cpt(){

		$url_rewrite = ot_get_option('wpl_causes_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'cause'; }

		$url_rewrite_name = ot_get_option('wpl_causes_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = 'Cause'; }

		register_post_type('post_causes',
			array(
				'labels' => array(
					'name' => __( 'Causes', 'benevolence-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Cause', 'benevolence-wpl' ),
					'add_new_item' => __( 'Add New Cause', 'benevolence-wpl' ),
					'edit' => __( 'Edit', 'benevolence-wpl' ),
					'edit_item' => __( 'Edit Cause', 'benevolence-wpl' ),
					'new_item' => __( 'New Cause', 'benevolence-wpl' ),
					'view' => __( 'View', 'benevolence-wpl' ),
					'view_item' => __( 'View Cause', 'benevolence-wpl' ),
					'search_items' => __( 'Search Causes', 'benevolence-wpl' ),
					'not_found' => __( 'No Causes found', 'benevolence-wpl' ),
					'not_found_in_trash' => __( 'No Causes found in Trash', 'benevolence-wpl' ),
					'parent' => __( 'Parent Cause', 'benevolence-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Causes.', 'benevolence-wpl' ),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => true,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-sos',
				'show_in_rest' => true,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author', 'custom-fields'),
			)
		);
	}
	add_action('init', 'wpl_causes_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for causes
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_causes_category')) {
	function wpl_causes_category() {

		$url_rewrite = ot_get_option('wpl_causes_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'causes-category'; }

		register_taxonomy('wpl_causes_category', 'post_causes',
			array(
				'hierarchical' => true,
				'labels' => array(
					  'name' => __( 'Causes Categories', 'benevolence-wpl' ),
					  'singular_name' => __( 'Department', 'benevolence-wpl' ),
					  'search_items' =>  __( 'Search in Category', 'benevolence-wpl' ),
					  'popular_items' => __( 'Popular Categories', 'benevolence-wpl' ),
					  'all_items' => __( 'All Categories', 'benevolence-wpl' ),
					  'parent_item' => __( 'Parent Category', 'benevolence-wpl' ),
					  'parent_item_colon' => __( 'Parent Category:', 'benevolence-wpl' ),
					  'edit_item' => __( 'Edit Category', 'benevolence-wpl' ),
					  'update_item' => __( 'Update Category', 'benevolence-wpl' ),
					  'add_new_item' => __( 'Add New Category', 'benevolence-wpl' ),
					  'new_item_name' => __( 'New Category Name', 'benevolence-wpl' )
				),
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array('slug' => $url_rewrite)
			)
		);
	}
	add_action('init', 'wpl_causes_category');
}
