<?php
/**
 * The default template for displaying Causes archive
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 4.5
 * @version 4.6
 */
?>

<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ms grid_9">
		<div id="content" class="site-content js-masonry">
			<?php
				if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
				$pledge_donation = get_pledge_nb_total ('wpl_pledge_cause', get_the_ID() );
				$cause_status = get_post_meta( get_the_ID(), 'wpl_cause_status', true );
				$donation_box_cause = get_post_meta( get_the_ID(), 'wpl_donation_box_cause', true);
			?>
				<?php $goal_amount = get_post_meta(get_the_ID(), 'wpl_goal_amount', true); ?>

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
							<p><?php echo wplook_short_excerpt(ot_get_option('wpl_cause_grid_excerpt_limit'));?></p>
						</div>

						<!-- Progress Bar -->
						<?php if( !empty( $goal_amount ) ) { ?>
							<div class="small-pb">
								<div class="proggress-bar">
									<div class="dot" style="left: <?php echo formatMoney($percentage = $pledge_donation["total"] * 100 / $goal_amount, true) ?>%"></div>
									<div class="acumulated" style="width: <?php echo formatMoney($percentage = $pledge_donation["total"] * 100 / $goal_amount, true) ?>%;"></div>
								</div>
							</div>
						<?php } ?>

						<div class="clear"></div>

						<!-- Cause Detailes -->
						<div class="cause-details <?php echo ( empty( $goal_amount ) ? 'no-goal' : '' ) ?>">

							<!-- Raised -->
							<?php if( !empty( $goal_amount ) ) { ?>
								<div class="raised">
									<div class="desc"><?php _e('Raised', 'benevolence-wpl'); ?></div>
									<div class="value"><?php if ( $goal_amount != '0' && $goal_amount !='' ) { echo min(round($pledge_donation["total"]*100/$goal_amount, 0, PHP_ROUND_HALF_UP), 100); }?>%</div>
								</div>
							<?php } ?>

							<!-- Donors -->
							<div class="donors">
								<div class="desc"><?php _e('Donors', 'benevolence-wpl'); ?></div>
								<div class="value"><?php echo $pledge_donation["nb"]; ?></div>
							</div>

							<!-- Goal -->
							<?php if ( !empty( $goal_amount ) ) { ?>
								<div class="goal">
									<div class="desc"><?php _e('Goal', 'benevolence-wpl'); ?>/<?php echo ot_get_option('wpl_curency_code') ?></div>
									<div class="value"><?php echo formatMoney($goal_amount); ?></div>
								</div>
							<?php } ?>
							<div class="clear"></div>
						</div>

						<!-- Donate for this cause -->
						<div class="make-donation-box">
							<a class="make-donation" href="<?php the_permalink(); ?>"><?php if ( $donation_box_cause == 'off' || $cause_status == 'complete' ) { _e('Learn More', 'benevolence-wpl'); } else { _e('Make a Donation', 'benevolence-wpl'); } ?></a>
						</div>
					</div>
				</article>
			<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php _e('Sorry, no causes matched your criteria.', 'benevolence-wpl'); ?></p>
			<?php endif; ?>

		</div>
		<div class="pagination-grid">
			<?php wplook_content_navigation('postnav' ) ?>
		</div>
	</div>

	<!-- Right Sidebar -->
	<div id="secondary" class="widget-area grid_3">
		<?php get_sidebar('causes'); ?>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
