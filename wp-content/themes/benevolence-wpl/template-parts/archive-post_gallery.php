<?php
/**
 * The default template for displaying Gallery archive
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.0
 * @version 4.6
 */
?>

<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ms grid_9">
		<div id="content" class="site-content js-masonry">
			<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>

			<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

				<!-- Article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
					<!-- Figure / Image -->
					<?php if ( has_post_thumbnail() ) {?>
						<figure>
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('document-image'); ?>
							</a>
						</figure>
					<?php } ?>

					<div class="box-conten-margins">
						<!-- Title -->
						<h1 class="entry-header">
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h1>
					</div>
				</article>

			<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php _e('Sorry, no galleries matched your criteria.', 'benevolence-wpl'); ?></p>
			<?php endif; ?>
		</div>
		<?php wplook_content_navigation('postnav' ) ?>
	</div>

	<!-- Right Sidebar -->
	<div id="secondary" class="widget-area grid_3">
		<?php get_sidebar('gallery'); ?>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
