<?php
/**
 * The default Sidebar. It will display on all Galleries
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>

<?php if ( is_active_sidebar( 'gallery-1' ) ) : ?>
	<?php if ( ! dynamic_sidebar( 'gallery-1' ) ) : ?>
	<?php endif; // end sidebar widget area ?>
<?php endif; ?>
