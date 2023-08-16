<?php
/**
 * The default Custom post type for Galleries
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.7
 * @version 4.6
 */
?>
<?php

if (!function_exists('wpl_gallery_cpt')) {

	function wpl_gallery_cpt(){

		$url_rewrite = ot_get_option('wpl_gallery_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'gallery'; }

		$url_rewrite_name = ot_get_option('wpl_gallery_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = 'Gallery'; }

		register_post_type('post_gallery',
			array(
				'labels' => array(
					'name' => __( 'Galleries', 'benevolence-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Gallery', 'benevolence-wpl' ),
					'add_new_item' => __( 'Add New Gallery', 'benevolence-wpl' ),
					'edit' => __( 'Edit', 'benevolence-wpl' ),
					'edit_item' => __( 'Edit Gallery', 'benevolence-wpl' ),
					'new_item' => __( 'New Gallery', 'benevolence-wpl' ),
					'view' => __( 'View', 'benevolence-wpl' ),
					'view_item' => __( 'View Gallery', 'benevolence-wpl' ),
					'search_items' => __( 'Search Galleries', 'benevolence-wpl' ),
					'not_found' => __( 'No Galleries found', 'benevolence-wpl' ),
					'not_found_in_trash' => __( 'No Galleries found in Trash', 'benevolence-wpl' ),
					'parent' => __( 'Parent Gallery', 'benevolence-wpl' ),
				),
				'description' => __( 'Easily lets you create some beautiful Galleries.', 'benevolence-wpl' ),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-format-gallery',
				'show_in_rest' => true,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author', 'custom-fields'),
			)
		);
	}
	add_action('init', 'wpl_gallery_cpt');
}


/*-----------------------------------------------------------------------------------*/
/*	Adding category for Galleries
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_gallery_category')) {

	function wpl_gallery_category() {

		$url_rewrite = ot_get_option('wpl_gallery_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'gallery-category'; }

		register_taxonomy('wpl_gallery_category', 'post_gallery',
			array(
				'hierarchical' => true,
				'labels' => array(
					'name' => __( 'Gallery Categories', 'benevolence-wpl' ),
					'singular_name' => __( 'Category', 'benevolence-wpl' ),
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
				'query_var' => true,
				'show_in_rest' => true,
				'rewrite' => array('slug' => $url_rewrite)
			)
		);
	}
	add_action('init', 'wpl_gallery_category');
}
