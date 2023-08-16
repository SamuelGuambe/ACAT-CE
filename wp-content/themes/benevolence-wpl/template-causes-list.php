<?php
/**
 * Template Name: Causes List
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
	<div id="primary" class="content-area ml <?php if ( $page_width != 'off' ) { echo 'grid_9'; } else { echo 'grid_12'; } ?>">
		<div id="content" class="site-content">

		<?php // Display the default content
			if ( $post->post_content != '' ) { ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="single">
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
						<div class="clear"></div>
					</article>
				<?php endwhile;
			} // End displaying the default content
		?>

		<?php $args = array( 'post_type' => 'post_causes','post_status' => array( 'publish', 'private' ), 'posts_per_page' => ot_get_option('wpl_cause_per_page'), 'paged'=> $paged); ?>
			<?php $wp_query = new WP_Query( $args ); ?>
			<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<?php $goal_amount = get_post_meta(get_the_ID(), 'wpl_goal_amount', true); ?>
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
							<p><?php echo wplook_short_excerpt(ot_get_option('wpl_cause_excerpt_limit'));?></p>
						</div>

						<div class="entry-meta">
							<a class="read-more-button fleft" href="<?php the_permalink(); ?>" title="<?php _e('Read more', 'benevolence-wpl'); ?>"><?php _e('Read more', 'benevolence-wpl'); ?></a>
							<?php if ( !empty( $goal_amount ) ) { ?>
								<span class="entry-help-us"><i class="far fa-heart"></i> <?php _e('Help us to collect:', 'benevolence-wpl'); ?> <?php echo formatMoney($goal_amount); ?> <?php echo ot_get_option('wpl_currency_code') ?></span>
							<?php } ?>


						</div>
						<div class="clear"></div>
					</article>

			<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php _e('Sorry, no causes matched your criteria.', 'benevolence-wpl'); ?></p>
			<?php endif; ?>

			<?php wplook_content_navigation('postnav' ) ?>
		</div>
	</div>

	<!-- Right Sidebar -->
	<?php if ($page_width != 'off') { ?>
		<div id="secondary" class="widget-area grid_3">
			<?php get_sidebar('causes'); ?>
		</div>
	<?php } ?>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
