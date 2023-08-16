<?php
/**
 * The default Custom post type for Sermons
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>
<?php
if (!function_exists('wpl_sermons_cpt')) {

	function wpl_sermons_cpt(){

		$url_rewrite = ot_get_option('wpl_sermons_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'sermon'; }

		$url_rewrite_name = ot_get_option('wpl_sermon_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = 'Sermon'; }

		register_post_type('post_sermons',
			array(
				'labels' => array(
					'name' => __( 'Sermons', 'benevolence-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Sermon', 'benevolence-wpl' ),
					'add_new_item' => __( 'Add New Sermon', 'benevolence-wpl' ),
					'edit' => __( 'Edit', 'benevolence-wpl' ),
					'edit_item' => __( 'Edit Sermon', 'benevolence-wpl' ),
					'new_item' => __( 'New Sermon', 'benevolence-wpl' ),
					'view' => __( 'View', 'benevolence-wpl' ),
					'view_item' => __( 'View Sermons', 'benevolence-wpl' ),
					'search_items' => __( 'Search Sermons', 'benevolence-wpl' ),
					'not_found' => __( 'No Sermons found', 'benevolence-wpl' ),
					'not_found_in_trash' => __( 'No Sermons found in Trash', 'benevolence-wpl' ),
					'parent' => __( 'Parent Sermon', 'benevolence-wpl' ),
				),
				'description' => __( 'Easily lets you create some beautiful Sermons.', 'benevolence-wpl' ),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-groups',
				'show_in_rest' => true,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author', 'author', 'custom-fields'),
			)
		);
	}
	add_action('init', 'wpl_sermons_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for Sermons
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_sermons_category')) {
	function wpl_sermons_category() {

		$url_rewrite = ot_get_option('wpl_sermon_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'sermons-category'; }

		register_taxonomy('wpl_sermons_category', 'post_sermons',
			array(
				'hierarchical' => true,
				'labels' => array(
					  'name' => __( 'Sermons Categories', 'benevolence-wpl' ),
					  'singular_name' => __( 'categories', 'benevolence-wpl' ),
					  'search_items' =>  __( 'Search in Category', 'benevolence-wpl' ),
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
	add_action('init', 'wpl_sermons_category');
}
