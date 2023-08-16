<?php
/**
 * Ministries archive listing
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.1.0
 * @version 4.6
 */
?>


<?php get_header(); ?>
<?php
	$pid = $post->ID;
	$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true);
?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ml <?php if ( $page_width != 'off' ) { echo 'grid_9'; } else { echo 'grid_12'; } ?>">
		<div id="content" class="site-content">
			<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					$pid = $post->ID;
					$project_status = get_post_meta( $pid, 'wpl_project_status', true );
				?>
					<!-- Article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class('list'); ?>>
						<?php if ( has_post_thumbnail() ) {?>
							<figure>
								<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('small-thumb'); ?>
								</a>
							</figure>
						<?php } ?>

						<h1 class="entry-header">
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h1>

						<div class="short-description">
							<p><?php echo wplook_short_excerpt(ot_get_option('wpl_ministries_excerpt_limit'));?></p>
						</div>

						<div class="entry-meta">
							<a class="read-more-button fleft" href="<?php the_permalink(); ?>" title="<?php _e('Read more', 'benevolence-wpl'); ?>"><?php _e('Read more', 'benevolence-wpl'); ?></a>
						</div>
						<div class="clear"></div>
					</article>

			<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php _e('Sorry, no ministries matched your criteria.', 'benevolence-wpl'); ?></p>
			<?php endif; ?>

			<?php wplook_content_navigation('postnav' ) ?>
		</div>
	</div>

	<!-- Right Sidebar -->
	<?php if ($page_width != 'off') { ?>
		<div id="secondary" class="widget-area grid_3">
			<?php get_sidebar('ministries'); ?>
		</div>
	<?php } ?>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
