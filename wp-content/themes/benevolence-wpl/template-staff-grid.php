<?php
/**
 * Template Name: Staff/Team Grid
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.0
 * @version 4.6
 */
?>

<?php get_header(); ?>

<?php
	$pid = $post->ID;
	$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true);
?>

<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ms <?php if ( $page_width != 'off' ) { echo 'grid_9'; } else { echo 'grid_12'; } ?>">

		<?php // Display the default content
		if ( $post->post_content != '' ) { ?>
				<div id="content" class="site-content">
						<?php while ( have_posts() ) : the_post(); ?>
							<article class="single">
								<div class="entry-content">
									<?php the_content(); ?>
								</div>
								<div class="clear"></div>
							</article>
						<?php endwhile;
					 // End displaying the default content ?>
					<div class="clear"></div>
				</div>
		<?php } ?>

		<div id="content-images" class="site-content js-masonry">
			<?php $args = array( 'post_type' => 'post_staff','post_status' => array( 'publish', 'private' ), 'posts_per_page' => ot_get_option('wpl_staff_per_page'), 'paged'=> $paged); ?>
			<?php $wp_query = new WP_Query( $args ); ?>
			<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

					<?php
						$pid = $post->ID;
						$candidate_position = get_post_meta( $pid, 'wpl_candidate_position', true);
					?>

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

			<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php _e('Sorry, no candidates matched your criteria.', 'benevolence-wpl'); ?></p>
			<?php endif; ?>

		</div>
		<div class="pagination-grid">
			<?php wplook_content_navigation('postnav' ) ?>
		</div>
	</div>

	<!-- Right Sidebar -->
	<?php if ($page_width != 'off') { ?>
		<div id="secondary" class="widget-area grid_3">
			<?php get_sidebar('staff'); ?>
		</div>
	<?php } ?>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
