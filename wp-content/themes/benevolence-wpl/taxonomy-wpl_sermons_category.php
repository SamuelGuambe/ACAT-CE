<?php
/**
 * The default Custom Post Sermons Archive
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.0
 * @version 4.6
 */
?>
<?php if (ot_get_option('wpl_sermon_taxonomy_template') == 'list') {
	include_once 'template-parts/archive-post_sermons.php';
} else {
	include_once 'template-parts/archive-post_sermons_grid.php';
} ?>
