<?php
/**
 * The default Custom post type for Sponsors
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>
<?php

if (!function_exists('wpl_sponsors_cpt')) {
	function wpl_sponsors_cpt(){

		$url_rewrite = ot_get_option('wpl_sponsors_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'sponsor'; }

		register_post_type('post_sponsor',
			array(
				'labels' => array(
					'name' => __( 'Sponsors', 'benevolence-wpl' ),
					'singular_name' => __( 'Sponsor', 'benevolence-wpl' ),
					'add_new' => __( 'Add New Sponsor', 'benevolence-wpl' ),
					'add_new_item' => __( 'Add New Sponsor', 'benevolence-wpl' ),
					'edit' => __( 'Edit', 'benevolence-wpl' ),
					'edit_item' => __( 'Edit Sponsor', 'benevolence-wpl' ),
					'new_item' => __( 'New Sponsor', 'benevolence-wpl' ),
					'view' => __( 'View', 'benevolence-wpl' ),
					'view_item' => __( 'View Sponsor', 'benevolence-wpl' ),
					'search_items' => __( 'Search Sponsors', 'benevolence-wpl' ),
					'not_found' => __( 'No Sponsors found', 'benevolence-wpl' ),
					'not_found_in_trash' => __( 'No Sponsors found in Trash', 'benevolence-wpl' ),
					'parent' => __( 'Parent Sponsor', 'benevolence-wpl' ),
				),
				'description' => __( 'Easily lets you create some beautiful Sponsors.', 'benevolence-wpl' ),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-businessman',
				'show_in_rest' => true,
				'supports' => array('title', 'author', 'custom-fields'),
			)
		);
	}
	add_action('init', 'wpl_sponsors_cpt');
}
