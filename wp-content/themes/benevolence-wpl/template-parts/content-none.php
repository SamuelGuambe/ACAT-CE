<?php
/**
 * The default template for displaying content for pages
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('list'); ?>>
	<?php _e('Sorry, no content matched your criteria.', 'benevolence-wpl'); ?>
</article>
