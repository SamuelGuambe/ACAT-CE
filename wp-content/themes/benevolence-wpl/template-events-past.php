<?php
/**
 * Template Name: Events: Past
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.1.5
 * @version 4.6
 */
?>


<?php get_header(); ?>
<?php
	$pid = $post->ID;
	$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true );
	$duration = get_post_meta( $pid, 'wpl_events_duration', true );
	$duration = ( !empty( $duration ) ? intval( $duration ) : 6 );
	$pagination = get_post_meta( $pid, 'wpl_events_pagination', true );
	$pagination = $pagination == 'on' ? true : false;
	$current_page = get_query_var( 'page', 1 );
	$current_page = $current_page > 0 ? $current_page : 1;
?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ml <?php if ( $page_width != 'off' ) { echo 'grid_9'; } else { echo 'grid_12'; } ?>">
		<div id="content" class="site-content">

			<?php // Display the default content
				if ( have_posts() ) { ?>
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

			<?php if( !$pagination ) : ?>
				<div class="events-selection">
					<?php wpl_generate_events_monthly_buttons( 'past', $duration ); ?>
				</div>
			<?php endif; ?>

			<?php get_template_part( 'template-parts/inc', 'events-loop' ); ?>

			<?php if( $pagination ) : ?>
				<?php echo wpl_events_pagination( $current_page, $wpl_events['pages'] ); ?>
			<?php endif; ?>
		</div>
	</div>

	<!-- Right Sidebar -->
	<?php if ($page_width != 'off') { ?>
		<div id="secondary" class="widget-area grid_3">
			<?php get_sidebar('events'); ?>
		</div>
	<?php } ?>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
