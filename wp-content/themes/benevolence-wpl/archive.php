<?php
/**
 * The default template for displaying Post Archive
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>

<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ml grid_9">
		<div id="content" class="site-content">
			<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>

			<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

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
							<p><?php echo wplook_short_excerpt(ot_get_option('wpl_blog_excerpt_limit'));?></p>
						</div>

						<div class="entry-meta">
								<a class="read-more-button fleft" href="<?php the_permalink(); ?>" title="<?php _e('Read more', 'benevolence-wpl'); ?>"><?php _e('Read more', 'benevolence-wpl'); ?></a>
								<?php if ( ot_get_option('wpl_date_blog_post') != "off" ) { ?>
									<time class="entry-time" datetime="<?php echo get_the_date( 'c' ) ?>"><a href="#"><i class="far fa-clock"></i> <?php wplook_get_date_time(); ?></a></time>
								<?php } ?>

								<?php if ( ot_get_option('wpl_author_blog_post') != "off" ) { ?>
									<span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="far fa-user"></i> <?php echo get_the_author(); ?></a></span>
								<?php } ?>
							</div>
						<div class="clear"></div>
					</article>

			<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php _e('Sorry, no posts matched your criteria.', 'benevolence-wpl'); ?></p>
			<?php endif; ?>

			<?php wplook_content_navigation('postnav' ) ?>
		</div>
	</div>

	<!-- Right Sidebar -->
	<div id="secondary" class="widget-area grid_3">
		<?php get_sidebar(); ?>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
