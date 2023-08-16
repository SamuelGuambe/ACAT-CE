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
	$when = get_post_meta( $pid, 'wpl_when', true);
	$ministry_time = get_post_meta( $pid, 'wpl_ministry_time', true);
	$ministry_location = get_post_meta( $pid, 'wpl_ministry_location', true);
	$ministry_address = get_post_meta( $pid, 'wpl_ministry_address', true);
	$ministry_latitude = get_post_meta( $pid, 'wpl_ministry_latitude', true);
	$ministry_longitude = get_post_meta( $pid, 'wpl_ministry_longitude', true);
	$ministry_google_maps = get_post_meta( $pid, 'wpl_ministry_google_maps', true);
	$ministry_pin = get_post_meta( $pid, 'wpl_ministry_pin_map_icon', true);
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

	<!-- Sidebr -->
	<div id="secondary" class="grid_3 widget-area" role="complementary">

		<!-- Cuase detailes -->
		<aside class="widget">
			<div class="info-box">
				<?php // Event start date ?>
				<?php if ( $when !='' ) { ?>
					<div class="info-row"><?php _e('When', 'benevolence-wpl'); ?><span class="fright"><?php echo $when; ?></span></div>
				<?php } ?>

				<?php if ( $ministry_time !='' ) { ?>
					<div class="info-row"><?php _e('at', 'benevolence-wpl'); ?><span class="fright"><?php echo $ministry_time; ?></span></div>
				<?php } ?>

				<?php // Location ?>
				<?php if ( !empty( $ministry_location ) || !empty( $ministry_address ) || ( !empty( $ministry_lat ) && !empty( $ministry_lng ) ) || !empty( $ministry_google_maps ) ) : ?>
					<?php if( !empty( $ministry_location ) ) : ?>
						<div class="info-row nmb"><?php echo esc_attr( $ministry_location ); ?></div>
					<?php endif; ?>

					<?php if ( !empty( $ministry_address ) || ( !empty( $ministry_lat ) && !empty( $ministry_lng ) ) || !empty( $ministry_google_maps ) ) : ?>
						<div class="location">

							<?php if( !empty( $ministry_address ) ) : ?>
								<div class="ministry-address"><?php echo esc_attr( $ministry_address ); ?></div>
							<?php endif; ?>

							<?php
								if( !empty( $ministry_google_maps ) || ( !empty( $ministry_latitude ) || !empty( $ministry_longitude ) ) ) {
									$options = array(
										'api_key' => ot_get_option( 'wpl_maps_api_server_key' )
									);

									$maps = new WPlook_Google_Maps( $options );

									$maps->generate_map( array(
										'maps_address' => $ministry_google_maps,
										'marker' => $ministry_pin,
										'latitude' => $ministry_latitude,
										'longitude' => $ministry_longitude
									) );
								}
							?>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<?php // Share Buttons ?>
				<?php if ( $share_buttons !='off' ) { ?>
					<div class="info-row"><?php _e('Share', 'benevolence-wpl'); ?>
						<span class="fright share-btns">
							<?php wplook_get_share_buttons(); ?>
						</span>
					</div>
				<?php } ?>
			</div>

		</aside> <!-- .widget cause detailes -->

		<!-- Include Sidebar -->
		<?php get_sidebar('ministries'); ?>

	</div><!-- #secondary -->
	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
