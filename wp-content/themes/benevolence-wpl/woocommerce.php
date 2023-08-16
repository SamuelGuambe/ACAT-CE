<?php
/**
 * The default template for displaying Single pages
 *
 * @package WPlook
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
 ?>

<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ml grid_9">
		<div id="content" class="site-content">
			<?php woocommerce_content(); ?>
		</div>
	</div>

	<!-- Right Sidebar -->
	<?php get_sidebar('shop'); ?>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
