<?php
/**
 * The default Custom Post Docs Archive
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.0
 * @version 4.6
 */
?>
<?php if (ot_get_option('wpl_docs_taxonomy_template') == 'grid') {
	include_once 'template-parts/archive-post_documents.php';
} else {
	include_once 'template-parts/archive-post_documents_list.php';
} ?>
