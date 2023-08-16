<?php
/**
 * The main template file.
 *
 * @package WPlook
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
 ?>
<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area grid_9 ml">
		<div id="content" class="site-content">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
				<?php endwhile; ?>

				<?php wplook_content_navigation('postnav' ) ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</div>

	<?php get_sidebar(); ?>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
