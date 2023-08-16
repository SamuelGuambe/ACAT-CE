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

if (!function_exists('wpl_pledges_cpt')) {
	function wpl_pledges_cpt(){

		$url_rewrite = ot_get_option('wpl_pledges_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'pledges'; }

		register_post_type('post_pledges',
			array(
				'labels' => array(
					'name' => __( 'Pledges', 'benevolence-wpl' ),
					'singular_name' => __( 'Pledge', 'benevolence-wpl' ),
					'add_new' => __( 'Add New Pledge', 'benevolence-wpl' ),
					'add_new_item' => __( 'Add New Pledge', 'benevolence-wpl' ),
					'edit' => __( 'Edit', 'benevolence-wpl' ),
					'edit_item' => __( 'Edit Pledge', 'benevolence-wpl' ),
					'new_item' => __( 'New Pledge', 'benevolence-wpl' ),
					'view' => __( 'View', 'benevolence-wpl' ),
					'view_item' => __( 'View Pledges', 'benevolence-wpl' ),
					'search_items' => __( 'Search Pledges', 'benevolence-wpl' ),
					'not_found' => __( 'No Pledges found', 'benevolence-wpl' ),
					'not_found_in_trash' => __( 'No Pledges found in Trash', 'benevolence-wpl' ),
					'parent' => __( 'Parent Pledge', 'benevolence-wpl' ),
				),
				'description' => __( 'Easily lets you create some beautiful Pledges.', 'benevolence-wpl' ),
				'public' => false,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-money',
				'show_in_rest' => true,
				'supports' => array('title', 'thumbnail', 'author', 'author', 'custom-fields'),
			)
		);
	}
	add_action('init', 'wpl_pledges_cpt');
}
