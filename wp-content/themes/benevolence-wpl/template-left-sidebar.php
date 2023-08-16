<?php
/**
 * Template Name: Left Sidebar Template
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.1
 * @version 4.6
 */
?>

<?php get_header(); ?>

<?php $page_width = get_post_meta(get_the_ID(), 'wpl_sidebar_option', true); ?>
<div id="main" class="site-main container_12">

	<!-- Right Sidebar -->
	<?php if ($page_width != 'off') {
		get_sidebar('page');
	} ?>


	<div id="primary" class="content-area ml <?php if ( $page_width != 'off' ) { echo 'grid_9'; } else { echo 'grid_12'; } ?>">
		<div id="content" class="site-content">
			<?php get_template_part('template-parts/content', 'page' ); ?>

		</div>
	</div>


	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
