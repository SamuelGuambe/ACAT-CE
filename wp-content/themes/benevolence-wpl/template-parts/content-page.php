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

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<article class="single">
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'benevolence-wpl' ) . '</span>', 'after' => '</div>' ) ); ?>
			</div>
			<div class="clear"></div>
		</article>

	<?php endwhile; endif; ?>
