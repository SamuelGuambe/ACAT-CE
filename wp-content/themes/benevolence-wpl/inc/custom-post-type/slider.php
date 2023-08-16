<?php
/**
 * The default Custom post type Slider
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>
<?php

if (!function_exists('wpl_sliders_cpt')) {
	function wpl_sliders_cpt(){

		$url_rewrite = 'Sliders';

		register_post_type('post_sliders',
			array(
				'labels' => array(
					'name' => __( 'Slides', 'benevolence-wpl' ),
					'singular_name' => __( 'Slide', 'benevolence-wpl' ),
					'add_new' => __( 'Add New Slide', 'benevolence-wpl' ),
					'add_new_item' => __( 'Add New Slide', 'benevolence-wpl' ),
					'edit' => __( 'Edit', 'benevolence-wpl' ),
					'edit_item' => __( 'Edit Slide', 'benevolence-wpl' ),
					'new_item' => __( 'New Slide', 'benevolence-wpl' ),
					'view' => __( 'View', 'benevolence-wpl' ),
					'view_item' => __( 'View Slide', 'benevolence-wpl' ),
					'search_items' => __( 'Search Slides', 'benevolence-wpl' ),
					'not_found' => __( 'No Slides found', 'benevolence-wpl' ),
					'not_found_in_trash' => __( 'No Slides found in Trash', 'benevolence-wpl' ),
					'parent' => __( 'Parent Slide', 'benevolence-wpl' ),
				),
				'description' => __( 'Create a front page slider with images, text and action buttons.', 'benevolence-wpl' ),
				'public' => false,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'menu_icon' => 'dashicons-slides',
				'show_in_rest' => true,
				'supports' => array('title', 'excerpt', 'thumbnail', 'author', 'page-attributes', 'custom-fields'),
			)
		);
	}
	add_action('init', 'wpl_sliders_cpt');
}
