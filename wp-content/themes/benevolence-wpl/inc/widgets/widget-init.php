<?php
/**
 * Register widget areas.
 *
 * @package WPlook
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */


/*-----------------------------------------------------------
	Include Widgets
-----------------------------------------------------------*/
get_template_part( '/inc/widgets/widget', 'featurednews' );

// Initiate Cause widget
if (ot_get_option('wpl_cpt_causes') != 'off') {
	get_template_part( '/inc/widgets/widget', 'causes' );
	get_template_part( '/inc/widgets/widget', 'latest-donations' );
	include_once( get_template_directory() . '/inc/widgets/widget-dashboard-charts.php' );
}

// Initiate Project widget
if (ot_get_option('wpl_cpt_projects') != 'off') {
	get_template_part( '/inc/widgets/widget', 'projects' );
}

// Initiate Docs widget
if (ot_get_option('wpl_cpt_documents') != 'off') {
	get_template_part( '/inc/widgets/widget', 'docs' );
}

// Initiate Gallery widget
if (ot_get_option('wpl_cpt_galleries') != 'off') {
	get_template_part( '/inc/widgets/widget', 'gallery' );
}

// Initiate Staff widget
if (ot_get_option('wpl_cpt_staff') != 'off') {
	get_template_part( '/inc/widgets/widget', 'staff' );
}

// Initiate Sermons widget
if (ot_get_option('wpl_cpt_sermons') != 'off') {
	get_template_part( '/inc/widgets/widget', 'sermons' );
}

// Initiate Events widget
if (ot_get_option('wpl_cpt_events') != 'off') {
	get_template_part( '/inc/widgets/widget', 'events' );
}

// Initiate Ministries widget
if (ot_get_option('wpl_cpt_ministry') != 'off') {
	get_template_part( '/inc/widgets/widget', 'ministries' );
}

get_template_part( '/inc/widgets/widget', 'quote' );
get_template_part( '/inc/widgets/widget', 'address' );
get_template_part( '/inc/widgets/widget', 'posts' );
//get_template_part( '/inc/widgets/widget', 'progress-bar' );
get_template_part( '/inc/widgets/widget', 'flickr' );
get_template_part( '/inc/widgets/widget', 'social' );
get_template_part( '/inc/widgets/widget', 'instagram' );
get_template_part( '/inc/widgets/widget', 'google-calendar' );
get_template_part( '/inc/widgets/widget', 'text-enchanted' );

function wplook_widgets_init() {

	/*-----------------------------------------------------------
		Home page Widget area
	-----------------------------------------------------------*/

	register_sidebar( array(
		'name' => __( 'First Home Page Widget area', 'benevolence-wpl' ),
		'id' => 'front-1',
		'description' => __('Widgets in this area will be shown only on the Home Page Template.','benevolence-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3><div class="clear"></div></div>'
	) );

	register_sidebar( array(
		'name' => __( 'Second Home Page Widget area', 'benevolence-wpl' ),
		'id' => 'front-2',
		'description' => __('Widgets in this area will be shown only on the Home Page Template.','benevolence-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3><div class="clear"></div></div>'
	) );

	register_sidebar( array(
		'name' => __( 'Third Home Page Widget area', 'benevolence-wpl' ),
		'id' => 'front-3',
		'description' => __('Widgets in this area will be shown only on the Home Page Template.','benevolence-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3><div class="clear"></div></div>'
	) );

	register_sidebar( array(
		'name' => __( 'Fourth Home Page Widget area', 'benevolence-wpl' ),
		'id' => 'front-4',
		'description' => __('Widgets in this area will be shown only on the Home Page Template.','benevolence-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3><div class="clear"></div></div>'
	) );

	register_sidebar( array(
		'name' => __( 'Fifth Home Page Widget area', 'benevolence-wpl' ),
		'id' => 'front-5',
		'description' => __('Widgets in this area will be shown only on the Home Page Template.','benevolence-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3><div class="clear"></div></div>'
	) );

	register_sidebar( array(
		'name' => __( 'Sixth Home Page Widget area', 'benevolence-wpl' ),
		'id' => 'front-6',
		'description' => __('Widgets in this area will be shown only on the Home Page Template.','benevolence-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3><div class="clear"></div></div>'
	) );

	/*-----------------------------------------------------------
		Pages widget area
	-----------------------------------------------------------*/

	register_sidebar( array(
		'name' => __( 'Page Widget area', 'benevolence-wpl' ),
		'id' => 'page-1',
		'description' => __('Widgets in this area will be shown on all Pages.','benevolence-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3><div class="clear"></div></div>'
	) );


	/*-----------------------------------------------------------
		Posts Widget area
	-----------------------------------------------------------*/

	register_sidebar( array(
		'name' => __( 'Press/Blog Widget area', 'benevolence-wpl' ),
		'id' => 'post-1',
		'description' => __('Widgets in this area will be shown on all Posts.','benevolence-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3><div class="clear"></div></div>'
	) );


	/*-----------------------------------------------------------
		Causes Widget area
	-----------------------------------------------------------*/

	if (ot_get_option('wpl_cpt_causes') != 'off') {

		register_sidebar( array(
			'name' => __( 'Causes Widget area', 'benevolence-wpl' ),
			'id' => 'cause-1',
			'description' => __('Widgets in this area will be shown on all Causes.','benevolence-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3><div class="clear"></div></div>'
		) );
	}

	/*-----------------------------------------------------------
		Event widget area
	-----------------------------------------------------------*/

	if (ot_get_option('wpl_cpt_events') != 'off') {
		register_sidebar( array(
			'name' => __( 'Event Widget area', 'benevolence-wpl' ),
			'id' => 'events-1',
			'description' => __('Widgets in this area will be shown on all Events.','benevolence-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3><div class="clear"></div></div>'
		) );
	}

	/*-----------------------------------------------------------
		Staff widget area
	-----------------------------------------------------------*/

	if (ot_get_option('wpl_cpt_staff') != 'off') {
		register_sidebar( array(
			'name' => __( 'Staff Widget area', 'benevolence-wpl' ),
			'id' => 'staff-1',
			'description' => __('Widgets in this area will be shown on all Staff.','benevolence-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3><div class="clear"></div></div>'
		) );
	}

	/*-----------------------------------------------------------
		Projects widget area
	-----------------------------------------------------------*/

	if (ot_get_option('wpl_cpt_projects') != 'off') {
		register_sidebar( array(
			'name' => __( 'Projects Widget area', 'benevolence-wpl' ),
			'id' => 'project-1',
			'description' => __('Widgets in this area will be shown on all Projects.','benevolence-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3><div class="clear"></div></div>'
		) );
	}


	/*-----------------------------------------------------------
		Ministries widget area
	-----------------------------------------------------------*/

	if (ot_get_option('wpl_cpt_ministry') != 'off') {
		register_sidebar( array(
			'name' => __( 'Ministries Widget area', 'benevolence-wpl' ),
			'id' => 'ministry-1',
			'description' => __('Widgets in this area will be shown on all Ministrie.','benevolence-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3><div class="clear"></div></div>'
		) );
	}
	/*-----------------------------------------------------------
		Documents Widget area
	-----------------------------------------------------------*/

	if (ot_get_option('wpl_cpt_documents') != 'off') {
		register_sidebar( array(
			'name' => __( 'Documents Widget area', 'benevolence-wpl' ),
			'id' => 'doc-1',
			'description' => __('Widgets in this area will be shown on all Documents.','benevolence-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3><div class="clear"></div></div>'
		) );
	}

	/*-----------------------------------------------------------
		Gallerry Widget area
	-----------------------------------------------------------*/

	if (ot_get_option('wpl_cpt_galleries') != 'off') {
		register_sidebar( array(
			'name' => __( 'Gallery Widget area', 'benevolence-wpl' ),
			'id' => 'gallery-1',
			'description' => __('Widgets in this area will be shown on all Gallery pages.','benevolence-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3><div class="clear"></div></div>'
		) );
	}

	/*-----------------------------------------------------------
		Sermons Widget area
	-----------------------------------------------------------*/

	if (ot_get_option('wpl_cpt_sermons') != 'off') {
		register_sidebar( array(
			'name' => __( 'Sermons Widget area', 'benevolence-wpl' ),
			'id' => 'sermon-1',
			'description' => __('Widgets in this area will be shown on all Sermon pages.','benevolence-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3><div class="clear"></div></div>'
		) );
	}


	/*-----------------------------------------------------------
		Define Shopping Widget area
	-----------------------------------------------------------*/

	if(is_plugin_active( 'woocommerce/woocommerce.php')) {
		register_sidebar( array(
			'name' => __( 'Shopping Widget area', 'benevolence-wpl' ),
			'id' => 'shop-1',
			'description' => __('Widgets in this area will be shown on shop section.','benevolence-wpl' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-title"><h3>',
			'after_title' => '</h3><div class="clear"></div></div>'
		) );
	}


	/*-----------------------------------------------------------
		Footer Widget area
	-----------------------------------------------------------*/

	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'benevolence-wpl' ),
		'id' => 'f1-widgets',
		'description' => __( 'The first footer widget area', 'benevolence-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	) );



	/*-----------------------------------------------------------
		Contact page Widget area
	-----------------------------------------------------------*/

	register_sidebar( array(
		'name' => __( 'Contact Page Widget area', 'benevolence-wpl' ),
		'id' => 'contact-1',
		'description' => __('Widgets in this area will be shown on Contact Pages.','benevolence-wpl' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3><div class="clear"></div></div>'
	) );
}
/** Register sidebars */
add_action( 'widgets_init', 'wplook_widgets_init' );
?>
