<?php
/**
 * The default template for displaying Single Projects
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
	$wpl_cpt_video = get_post_meta( $pid, 'wpl_cpt_video', true);
	$wpl_cpt_gallery = get_post_meta( $pid, 'wpl_cpt_gallery', true);
	$share_buttons = get_post_meta( $pid, 'wpl_share_buttons', true);
	$event_location = get_post_meta( $pid, 'wpl_event_location', true);
	$event_address = get_post_meta( $pid, 'wpl_event_address', true);
	$event_lat = get_post_meta( $pid, 'wpl_event_latitude', true);
	$event_lng = get_post_meta( $pid, 'wpl_event_longitude', true);
	$event_google_maps = get_post_meta( $pid, 'wpl_event_google_maps', true);
	$event_pin = get_post_meta( $pid, 'wpl_event_pin_map_icon', true);
	$event_service_url = get_post_meta( $pid, 'wpl_event_service_url', true);
	$event_service_name = get_post_meta( $pid, 'wpl_event_service_name', true);
	$event_recurring_bool = get_post_meta( $pid, 'wpl_event_recurring_bool', true);
	$event_recurring_repeat_every = get_post_meta( $pid, 'wpl_event_recurring_repeat_every', true);
	$event_recurring_repeat_from = get_post_meta( $pid, 'wpl_event_recurring_repeat_from', true);
	$event_recurring_repeat_until = get_post_meta( $pid, 'wpl_event_recurring_repeat_until', true);

	// Get start and end times
	if( get_query_var( 'event_start' ) && get_query_var( 'event_end' ) ) {
		$event_start = intval( get_query_var( 'event_start' ) );
		$event_end = intval( get_query_var( 'event_end' ) );
	} else {
		$event_start = strtotime( get_post_meta( $pid, 'wpl_event_start', true ) );
		$event_end = strtotime( get_post_meta( $pid, 'wpl_event_end', true ) );
	}
?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ml grid_9 ?>">
		<div id="content" class="site-content">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article class="single">
						<div class="entry-content">

							<?php // Display projects tabs
								if ( ! empty( $wpl_cpt_gallery ) || $wpl_cpt_video != '' ) { ?>

								<div class="tabs_table">
									<ul class="tabs">
										<!-- Photo -->
										<?php if ( ! empty( $wpl_cpt_gallery ) ) { ?>
											<li><a title="Tab one" rel="tab-1" class="selected"><i class="far fa-image"></i> <span><?php _e('Photo', 'benevolence-wpl'); ?></span></a></li>
										<?php } ?>

										<!-- Video -->
										<?php if ( $wpl_cpt_video != '') { ?>
											<li><a title="Tab two" rel="tab-2" class=""><i class="fab fa-youtube"></i> <span><?php _e('Video', 'benevolence-wpl'); ?></span></a></li>
										<?php } ?>
									</ul>

									<div class="panes">
										<!-- Photo -->
										<?php if ( ! empty( $wpl_cpt_gallery ) ) { ?>
											<div class="tab-content" id="tab-1">
												<div class="flexslider flexslider-gallery loading">
													<ul class="slides">
														<?php foreach( $wpl_cpt_gallery as $item ) { ?>
															<li>
																<?php echo '<img src="'.$item['wpl_cpt_image'].'" alt="'.$item['wpl_cpt_image_caption'].'" />'; ?>

																<!-- Image caption -->
																<?php if ( $item['wpl_cpt_image_caption'] != '' ) { ?>
																	<div class="gallery-caption">
																		<div class="caption-margins">
																			<?php echo $item['wpl_cpt_image_caption']; ?>
																		</div>
																	</div>
																<?php } ?>
															</li>
														<?php } ?>
													</ul>
												</div>
											</div>
										<?php } ?>

										<!-- Video -->
										<?php if ( $wpl_cpt_video != '') { ?>
											<div class="tab-content fitvid" id="tab-2">
												<?php echo wp_oembed_get( $wpl_cpt_video ); ?>
											</div>
										<?php } ?>
										<div class="clear"></div>
									</div>
								</div>

							<?php } // End projects tabs ?>

							<!-- The Content -->
							<?php the_content(); ?>
						</div>
						<div class="clear"></div>
					</article>
			<?php endwhile; endif; ?>
			<?php comments_template( '', true ); ?>
		</div>
	</div>

	<!-- Sidebar -->
	<div id="secondary" class="grid_3 widget-area" role="complementary">

		<!-- Cause details -->
		<aside class="widget">
			<div class="info-box">
				<?php // Event start date ?>
				<?php if ( $event_start !='' ) { ?>
					<div class="info-row"><i class="far fa-clock"></i> <?php _e('Date and Time', 'benevolence-wpl'); ?></div>
					<div class="info-row"><span class=""><?php echo date_i18n( get_option('date_format'), $event_start ); ?></span><span> <?php _e('at', 'benevolence-wpl'); ?> </span> <span class=""><?php echo date(get_option('time_format'), $event_start); ?></span> - <br /><span class=""><?php echo date_i18n( get_option('date_format'), $event_end ); ?></span><span> <?php _e('at', 'benevolence-wpl'); ?> </span> <span class=""><?php echo date(get_option('time_format'), $event_end); ?></span></div>
				<?php } ?>

				<?php // Recurring event ?>
				<?php if ( $event_recurring_bool == 'on' && !empty( $event_recurring_repeat_from ) && !empty( $event_recurring_repeat_until ) ) { ?>
					<div class="info-row nmb">
						<i class="fas fa-undo-alt"></i> <?php _e('Recurring event', 'benevolence-wpl'); ?>
					</div>
					<div class="location recurring">
						<?php printf( _x( 'This event repeats every %1$d days, starting from %2$s until %3$s.', 'This event repeats every [number of days] days, starting from [date] until [date].', 'benevolence-wpl' ), $event_recurring_repeat_every, date_i18n( get_option('date_format'), strtotime( $event_recurring_repeat_from ) ), date_i18n( get_option('date_format'), strtotime( $event_recurring_repeat_until ) ) ); ?>
					</div>
				<?php } ?>

				<?php // Location ?>
				<?php if ( !empty( $event_location ) || !empty( $event_address ) || ( !empty( $event_lat ) && !empty( $event_lng ) ) || !empty( $event_google_maps ) ) : ?>
					<?php if( !empty( $event_location ) ) : ?>
						<div class="info-row nmb"><i class="fas fa-map-marker-alt"></i> <?php echo esc_attr( $event_location ); ?></div>
					<?php endif; ?>

					<?php if ( !empty( $event_address ) || ( !empty( $event_lat ) && !empty( $event_lng ) ) || !empty( $event_google_maps ) ) : ?>
						<div class="location">

							<?php if( !empty( $event_address ) ) : ?>
								<div class="event-address"><?php echo esc_attr( $event_address ); ?></div>
							<?php endif; ?>

							<?php
								if( !empty( $event_google_maps ) || ( !empty( $event_lat ) || !empty( $event_lng ) ) ) {
									$options = array(
										'api_key' => ot_get_option( 'wpl_maps_api_server_key' )
									);

									$maps = new WPlook_Google_Maps( $options );

									$maps->generate_map( array(
										'maps_address' => $event_google_maps,
										'marker' => $event_pin,
										'latitude' => $event_lat,
										'longitude' => $event_lng
									) );
								}
							?>

							<?php if( !empty( $event_address ) ) : ?>
								<div class="event-directions">
									<a target="_blank" class="buttonss small grey round" href="https://maps.google.com?daddr=<?php echo urlencode( $event_address ); ?>"><?php _e( 'Get Directions', 'benevolence-wpl' ); ?></a>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<?php // Ticket service ?>
				<?php if ( $event_service_name !='' && $event_service_url !='') { ?>
					<div class="info-row"><?php echo $event_service_name; ?><span class="fright"><a target="_blank" href="<?php echo $event_service_url ?>"><?php _e('Join the event', 'benevolence-wpl'); ?></a></span></div>
				<?php } ?>


				<?php // Share Buttons ?>
				<?php if ( $share_buttons !='off' ) { ?>
					<div class="info-row"><i class="fas fa-share-alt"></i> <?php _e('Share', 'benevolence-wpl'); ?>
						<span class="fright share-btns">
							<?php wplook_get_share_buttons(); ?>
						</span>
					</div>
				<?php } ?>
			</div>

		</aside> <!-- .widget cause detailes -->

		<!-- Include Sidebar -->
		<?php get_sidebar('events'); ?>

	</div><!-- #secondary -->
	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
