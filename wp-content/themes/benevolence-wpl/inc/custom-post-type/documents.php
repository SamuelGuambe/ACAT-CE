<?php
/**
 * The default Custom post type for Documents
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.4
 * @version 4.6
 */
?>
<?php
if (!function_exists('wpl_documents_cpt')) {
	function wpl_documents_cpt(){

		$url_rewrite = ot_get_option('wpl_documents_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'document'; }

		$url_rewrite_name = ot_get_option('wpl_documents_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = 'Document'; }

		register_post_type('post_documents',
			array(
				'labels' => array(
					'name' => __( 'Documents', 'benevolence-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Document', 'benevolence-wpl' ),
					'add_new_item' => __( 'Add New Document', 'benevolence-wpl' ),
					'edit' => __( 'Edit', 'benevolence-wpl' ),
					'edit_item' => __( 'Edit Document', 'benevolence-wpl' ),
					'new_item' => __( 'New Document', 'benevolence-wpl' ),
					'view' => __( 'View', 'benevolence-wpl' ),
					'view_item' => __( 'View Document', 'benevolence-wpl' ),
					'search_items' => __( 'Search Documents', 'benevolence-wpl' ),
					'not_found' => __( 'No Documents found', 'benevolence-wpl' ),
					'not_found_in_trash' => __( 'No Documents found in Trash', 'benevolence-wpl' ),
					'parent' => __( 'Parent Document', 'benevolence-wpl' )
				),
				'description' => __( 'Easily lets you create some beautiful Documents.', 'benevolence-wpl' ),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-media-document',
				'show_in_rest' => true,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author', 'custom-fields'),
			)
		);
	}
	add_action('init', 'wpl_documents_cpt');
}


/*-----------------------------------------------------------------------------------*/
/*	Adding category for Documents
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_documents_category')) {
	function wpl_documents_category() {

		$url_rewrite = ot_get_option('wpl_documents_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'documents-category'; }

		register_taxonomy('wpl_documents_category', 'post_documents',
			array(
				'labels' => array(
					  'name' => __( 'Document Categories', 'benevolence-wpl' ),
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
				'show_in_rest' => true,
				'query_var' => true,
				'rewrite' => array('slug' => $url_rewrite, 'hierarchical' => true),
				'hierarchical' => true,
			)
		);
	}
	add_action('init', 'wpl_documents_category');
}
