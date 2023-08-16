<?php
/**
 * The default Custom Post Projects Archive
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.0
 * @version 4.6
 */
?>

<?php if (ot_get_option('wpl_projects_taxonomy_template') == 'list') {
	include_once 'template-parts/archive-post_projects.php';
} else {
	include_once 'template-parts/archive-post_projects_grid.php';
} ?>
