<?php
/**
 * The default Sidebar. It will display on contact page
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>

<?php if ( is_active_sidebar( 'contact-1' ) ) : ?>
	<div id="secondary" class="grid_3 widget-area" role="complementary">
		<?php if ( ! dynamic_sidebar( 'contact-1' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
	</div>
<?php endif; ?>
