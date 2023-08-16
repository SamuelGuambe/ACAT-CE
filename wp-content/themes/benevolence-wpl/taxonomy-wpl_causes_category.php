<?php
/**
 * The default Custom Post Causes Archive
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.0
 * @version 4.6
 */
?>
<?php if (ot_get_option('wpl_cause_taxonomy_template') == 'list') {
	include_once 'template-parts/archive-post_causes.php';
} else {
	include_once 'template-parts/archive-post_causes_grid.php';
} ?>
