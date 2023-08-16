<?php
/**
 * The default Sidebar. It will appear on all Press/Blog pages
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>

<div id="secondary" class="widget-area grid_3">
	<?php if ( ! dynamic_sidebar( 'post-1' ) ) : ?>
	<?php endif; // end sidebar widget area ?>
</div><!-- #secondary .widget-area -->
