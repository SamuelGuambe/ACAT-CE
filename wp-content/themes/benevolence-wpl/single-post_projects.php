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
	$project_start_date = get_post_meta( $pid, 'wpl_project_start_date', true );
	$project_end_date = get_post_meta( $pid, 'wpl_project_end_date', true );
	$share_buttons = get_post_meta( $pid, 'wpl_share_buttons', true);
	$project_status = get_post_meta( $pid, 'wpl_project_status', true );
	$projects_project_status_display = ot_get_option( 'wpl_projects_project_status_display' );
	$projects_project_status_display = ( $projects_project_status_display == 'off' ? false : true );
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
																<?php  echo '<img src="'.$item['wpl_cpt_image'].'" alt="'.$item['wpl_cpt_image_caption'].'" />'; ?>

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

		<?php if( $projects_project_status_display ) : ?>
			<!-- Cause details -->
			<aside class="widget">
				<div class="info-box">
					<?php // Project Status ?>
					<?php if ( $project_status == 'active' || $project_status == 'complete' ) { ?>

						<div class="info-row"><?php _e('Project Status', 'benevolence-wpl'); ?><span class="fright"><?php if ( $project_status == 'active') { _e('Active', 'benevolence-wpl'); } else {_e('Completed', 'benevolence-wpl');} ?></span></div>
					<?php } ?>

					<?php // Start date ?>
					<?php if ( $project_start_date !='' ) { ?>
						<div class="info-row"><?php _e('Start date', 'benevolence-wpl'); ?><span class="fright"><?php echo date_i18n( get_option('date_format'), strtotime($project_start_date) ); ?></span></div>
					<?php } ?>

					<?php // End date ?>
					<?php if ( $project_end_date !='' ) { ?>
						<div class="info-row"><?php _e('End date', 'benevolence-wpl'); ?><span class="fright"><?php echo date_i18n( get_option('date_format'), strtotime($project_end_date) ); ?></span></div>
					<?php } ?>

					<?php // Share Buttons ?>
					<?php if ( $share_buttons !='off' ) { ?>
						<div class="info-row"><?php _e('Share', 'benevolence-wpl'); ?>
							<span class="fright share-btns">
								<?php wplook_get_share_buttons(); ?>
							</span>
						</div>
					<?php } ?>
				</div>
			</aside> <!-- .widget cause details -->
		<?php endif; ?>

		<!-- Include Sidebar -->
		<?php get_sidebar('projects'); ?>

	</div><!-- #secondary -->
	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
