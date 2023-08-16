<?php
/**
 * The default sidebar. It will display on all documents.
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>

<?php if ( is_active_sidebar( 'doc-1' ) ) : ?>
	<?php if ( ! dynamic_sidebar( 'doc-1' ) ) : ?>
	<?php endif; // end sidebar widget area ?>
<?php endif; ?>
