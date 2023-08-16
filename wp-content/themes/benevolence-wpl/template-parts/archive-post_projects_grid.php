<?php
/**
 * The default template for displaying Projects archive
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
			<?php
				$pid = $post->ID;
				$project_status = get_post_meta( $pid, 'wpl_project_status', true );
			?>
				<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<!-- Article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
						<!-- Figure / Image -->
						<?php if ( has_post_thumbnail() ) {?>
							<figure>
								<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('small-thumb'); ?>
								</a>
							</figure>
						<?php } ?>

						<div class="box-conten-margins">
							<!-- Title -->
							<h1 class="entry-header">
								<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h1>

							<!-- Description -->
							<div class="short-description">
								<p><?php echo wplook_short_excerpt(ot_get_option('wpl_projects_widget_excerpt_limit'));?></p>
							</div>

							<div class="clear"></div>

							<!-- Entry meta -->
							<div class="entry-meta">
								<a class="read-more-button" href="<?php the_permalink(); ?>" title="<?php _e('Read more', 'benevolence-wpl'); ?>"><?php _e('Read more', 'benevolence-wpl'); ?></a>
								<div class="clear"></div>
							</div>
						</div>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>

		<?php else : ?>
			<p><?php _e('Sorry, no projects matched your criteria.', 'benevolence-wpl'); ?></p>
		<?php endif; ?>

		</div>
		<div class="pagination-grid">
			<?php wplook_content_navigation('postnav' ) ?>
		</div>
	</div>
	<!-- Right Sidebar -->
	<div id="secondary" class="widget-area grid_3">
		<?php get_sidebar('projects'); ?>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
