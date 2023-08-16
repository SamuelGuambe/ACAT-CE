<?php
/**
 * The default Sidebar. It will display on all causes.
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>

<?php if ( is_active_sidebar( 'cause-1' ) ) : ?>
	<?php if ( ! dynamic_sidebar( 'cause-1' ) ) : ?>
	<?php endif; // end sidebar widget area ?>
<?php endif; ?>
