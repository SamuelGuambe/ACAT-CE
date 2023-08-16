<?php
/**
 * The default Custom post type for Projects
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since benevolence 1.0.0
 * @version 4.6
 */
?>
<?php
if (!function_exists('wpl_projects_cpt')) {
	function wpl_projects_cpt(){

		$url_rewrite = ot_get_option('wpl_projects_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'project'; }

		$url_rewrite_name = ot_get_option('wpl_projects_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = 'Project'; }

		register_post_type('post_projects',
			array(
				'labels' => array(
					'name' => __( 'Projects', 'benevolence-wpl' ),
					'singular_name' => $url_rewrite_name,
					'add_new' => __( 'Add New Project', 'benevolence-wpl' ),
					'add_new_item' => __( 'Add New Project', 'benevolence-wpl' ),
					'edit' => __( 'Edit', 'benevolence-wpl' ),
					'edit_item' => __( 'Edit Project', 'benevolence-wpl' ),
					'new_item' => __( 'New Project', 'benevolence-wpl' ),
					'view' => __( 'View', 'benevolence-wpl' ),
					'view_item' => __( 'View Projects', 'benevolence-wpl' ),
					'search_items' => __( 'Search Projects', 'benevolence-wpl' ),
					'not_found' => __( 'No Projects found', 'benevolence-wpl' ),
					'not_found_in_trash' => __( 'No Projects found in Trash', 'benevolence-wpl' ),
					'parent' => __( 'Parent Project', 'benevolence-wpl' ),
				),
				'description' => __( 'Easily lets you create some beautiful Projects.', 'benevolence-wpl' ),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-clipboard',
				'show_in_rest' => true,
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author', 'custom-fields'),
			)
		);
	}
	add_action('init', 'wpl_projects_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for projects
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_projects_category')) {
	function wpl_projects_category() {

		$url_rewrite = ot_get_option('wpl_projects_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'projects-category'; }

		register_taxonomy('wpl_projects_category', 'post_projects',
			array(
				'hierarchical' => true,
				'labels' => array(
					'name' => __( 'Projects Categories', 'benevolence-wpl' ),
					'singular_name' => __( 'Categories', 'benevolence-wpl' ),
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
	add_action('init', 'wpl_projects_category');
}
