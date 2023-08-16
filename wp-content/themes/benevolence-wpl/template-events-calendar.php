<?php
/**
 * Template Name: Events: Calendar
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
	$event_color = get_post_meta( $pid, 'wpl_event_color', true);

	$calendar_language_post = get_post_meta( $pid, 'wpl_calendar_language', true );
	$calendar_language_global = ot_get_option( 'wpl_events_calendar_language' );

	if( !empty( $calendar_language_global ) ) {
		$calendar_language = $calendar_language_global;
	} elseif( !empty( $calendar_language_post ) ) {
		$calendar_language = $calendar_language_post;
	} else {
		$calendar_language = 'en';
	}
?>
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

			<div class="wplook-calendar wplook-calendar-large wplook-events-calendar" data-language="<?php echo $calendar_language; ?>" data-color="<?php echo $event_color ?>">
				<div class="loading visible">
					<div class="loading-content">
						<div class="loading-events visible">
							<i class="fas fa-spinner"></i>
							<p><?php _e( 'Loading events', 'benevolence-wpl' ); ?></p>
						</div>

						<div class="error">
							<p><?php _e( 'An error has occured:', 'benevolence-wpl' ); ?></p>
							<p class="error-contents"></p>
						</div>
					</div>
				</div>
			</div>

		</div>
		<?php wplook_content_navigation('postnav' ) ?>
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
