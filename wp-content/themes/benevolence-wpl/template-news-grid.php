<?php
/**
 * Template Name: Blog/News Grid
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.0
 * @version 4.6
 */
?>

<?php get_header(); ?>
<?php $page_width = get_post_meta(get_the_ID(), 'wpl_sidebar_option', true); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ms <?php if ( $page_width != 'off' ) { echo 'grid_9'; } else { echo 'grid_12'; } ?>">

		<div id="content" class="site-content js-masonry">
			<?php $args = array( 'post_type' => 'post','post_status' => array( 'publish', 'private' ), 'posts_per_page' => ot_get_option('wpl_blog_per_page'), 'paged'=> $paged); ?>
			<?php $wp_query = new WP_Query( $args ); ?>
			<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<!-- Article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
						<!-- Figure / Image -->
						<?php if ( has_post_thumbnail() ) {?>
							<figure>
								<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('small-thumb'); ?>
								</a>
								<div class="widget-date">
									<time class="entry-times" datetime="<?php echo get_the_date( 'c' ) ?>"><i class="far fa-clock"></i> <?php wplook_get_date(); ?></time>
									<span class="entry-nrcomments"><i class="far fa-comment"></i><?php comments_number( '0', '1', '%' ); ?></span>
									<div class="clear"></div>
								</div>
							</figure>
						<?php } ?>

						<div class="box-conten-margins">
							<!-- Title -->
							<h1 class="entry-header">
								<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h1>

							<!-- Description -->
							<div class="short-description">
								<p><?php echo wplook_short_excerpt(ot_get_option('wpl_blog_grid_excerpt_limit'));?></p>
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
				<p><?php _e('Sorry, no posts matched your criteria.', 'benevolence-wpl'); ?></p>
			<?php endif; ?>

		</div>
		<div class="pagination-grid">
			<?php wplook_content_navigation('postnav' ) ?>
		</div>
	</div>

	<!-- Right Sidebar -->
	<?php if ($page_width != 'off') { ?>
		<?php get_sidebar(); ?>
	<?php } ?>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
