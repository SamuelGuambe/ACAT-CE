<?php
/**
 * The default template for displaying Single causes
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>
<?php get_header(); ?>
<?php
	$pid = $post->ID;
	$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true);
	$candidate_position = get_post_meta( $pid, 'wpl_candidate_position', true);
	$candidate_phone = get_post_meta( $pid, 'wpl_candidate_phone', true);
	$candidate_email = get_post_meta( $pid, 'wpl_candidate_email', true);
	$candidate_blog = get_post_meta( $pid, 'wpl_candidate_blog', true);

	$candidate_share_items = get_post_meta($post->ID, 'candidate_share', true);
?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ml grid_9 ?>">
		<div id="content" class="site-content">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article class="single">
						<div class="entry-content">
							<!-- The Content -->
							<?php the_content(); ?>
						</div>
						<div class="clear"></div>
					</article>

			<?php endwhile; endif; ?>
			<?php comments_template( '', true ); ?>
		</div>
	</div>

	<!-- Sidebr -->
	<div id="secondary" class="grid_3 widget-area" role="complementary">

		<!-- Cuase detailes -->
		<aside class="widget">
			<!-- Article -->
			<div class="js-masonry">

				<article class="item">
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
						<h1 class="entry-header candidate">
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h1>
						<?php if ( $candidate_position !='' ) { ?>
							<div class="candidate-position">
								<div class="position"><?php echo $candidate_position; ?></div>
							</div>
						<?php } ?>
					</div>
				</article>
			</div>

			<div class="info-box">
				<?php // Candidate Phone ?>
				<?php if ( $candidate_phone !='' ) { ?>
					<div class="info-row"><?php _e('Phone', 'benevolence-wpl'); ?><span class="fright"><?php echo $candidate_phone; ?></span></div>
				<?php } ?>

				<?php // Candidate Email ?>
				<?php if ( $candidate_email !='' ) { ?>
					<div class="info-row"><?php _e('Email', 'benevolence-wpl'); ?><span class="fright"><?php echo $candidate_email; ?></span></div>
				<?php } ?>

				<?php // Candidate Blog URL ?>
				<?php if ( $candidate_blog !='' ) { ?>
					<div class="info-row"><?php _e('URL', 'benevolence-wpl'); ?><span class="fright"><a target="_blank" href="<?php echo $candidate_blog; ?>"><?php _e('Click to visit', 'benevolence-wpl'); ?></a></span></div>
				<?php } ?>

				<?php if ( ! empty( $candidate_share_items ) ) { ?>
					<div class="info-row"><?php _e('Follow', 'benevolence-wpl'); ?>
						<span class="fright">
							<?php
								foreach( $candidate_share_items as $item ) { ?>
									<a class="i-share-item" href="<?php echo $item['wpl_share_item_url']; ?>" target="_blank"><i class="<?php echo $item['wpl_share_item_icon']; ?>"></i></a>
							<?php } ?>
						</span>
					</div>
				<?php } ?>

			</div>

		</aside> <!-- .widget cause detailes -->

		<!-- Include Sidebar -->
		<?php //get_sidebar('staff'); ?>

	</div><!-- #secondary -->
	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
