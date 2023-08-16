<?php
/**
 * The default template for displaying Single Sermon
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
	$wpl_cpt_video = get_post_meta( $pid, 'wpl_cpt_video', true);
	$wpl_cpt_gallery = get_post_meta( $pid, 'wpl_cpt_gallery', true);
	$video_sermons = get_post_meta( $pid, 'wpl_cpt_video_sermons', true);
	$wpl_cpt_audio = get_post_meta( $pid, 'wpl_cpt_audio', true);
	$wpl_cpt_documents = get_post_meta( $pid, 'wpl_cpt_documents', true);
	$share_buttons = get_post_meta( $pid, 'wpl_share_buttons', true);
?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ml grid_9 ?>">
		<div id="content" class="site-content">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article class="single">
						<div class="entry-content">

							<?php // Display Sermons tabs
								if ( ! empty( $wpl_cpt_gallery ) || $wpl_cpt_video != '' || ! empty ($wpl_cpt_audio ) || ! empty( $wpl_cpt_documents ) || !empty( $video_sermons ) ) { ?>

								<div class="tabs_table">
									<ul class="tabs">
										<!-- Photo -->
										<?php if ( ! empty( $wpl_cpt_gallery ) ) { ?>
											<li><a title="<?php _e('Photo', 'benevolence-wpl'); ?>" rel="tab-1" class="selected"><i class="far fa-image"></i> <span><?php _e('Photo', 'benevolence-wpl'); ?></span></a></li>
										<?php } ?>

										<!-- Video -->
										<?php if ( $wpl_cpt_video != '' || ! empty( $video_sermons ) ) { ?>
											<li><a title="<?php _e('Video', 'benevolence-wpl'); ?>" rel="tab-2" class=""><i class="fab fa-youtube"></i> <span><?php _e('Video', 'benevolence-wpl'); ?></span></a></li>
										<?php } ?>

										<!-- Audio -->
										<?php if ( ! empty ($wpl_cpt_audio ) ) { ?>
											<li><a title="<?php _e('Audio', 'benevolence-wpl'); ?>" rel="tab-3" class=""><i class="fas fa-headphones-alt"></i> <span><?php _e('Audio', 'benevolence-wpl'); ?></span></a></li>
										<?php } ?>

										<!-- Documents -->
										<?php if ( ! empty( $wpl_cpt_documents ) ) { ?>
											<li><a title="<?php _e('Files', 'benevolence-wpl'); ?>" rel="tab-4" class=""><i class="far fa-file-alt"></i> <span><?php _e('Files', 'benevolence-wpl'); ?></span></a></li>
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
																<?php
																	echo '<img src="'.$item['wpl_cpt_image'].'" alt="'.$item['wpl_cpt_image_caption'].'" />';
																?>
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
										<?php if ( ! empty( $video_sermons ) ) { ?>
											<div class="tab-content fitvid" id="tab-2">
												<?php foreach( $video_sermons as $item ) { ?>
													<?php
														if ( ! empty($item['wpl_cpt_video_title'])) {
															echo "<h3>";
																echo $item['wpl_cpt_video_title'];
															echo "<h3>";
														}
														echo wp_oembed_get( $item['wpl_cpt_video_url'] );
													?>
												<?php } ?>
											</div>
										<?php } ?>

										<!-- This will be deprecated in 1.0.8 -->
											<?php if ( $wpl_cpt_video != '') { ?>
												<div class="tab-content fitvid" id="tab-2">
													<?php echo wp_oembed_get( $wpl_cpt_video ); ?>
												</div>
											<?php } ?>

										<!-- Audio -->
										<?php if ( ! empty ($wpl_cpt_audio ) ) { ?>
											<div class="tab-content" id="tab-3">
												<?php foreach( $wpl_cpt_audio as $item ) {
													if ( $item['wpl_cpt_audio_file'] != '' ) {

														if ( $item['wpl_cpt_audio_title'] != '' ) {
															echo "<div class='audio-title'>"; ?>

															<a href="<?php echo $item['wpl_cpt_audio_file']; ?>" download><i class="fas fa-file-download"></i> Download <?php echo $item['wpl_cpt_audio_title']; ?></a>

															<?php
															echo "</div>";
														}

														echo do_shortcode( "[audio src='$item[wpl_cpt_audio_file]']" );
													}
												} ?>
											</div>
										<?php } ?>


										<!-- Documents -->
										<?php if ( ! empty( $wpl_cpt_documents ) ) { ?>
											<div class="tab-content" id="tab-4">
												<?php foreach( $wpl_cpt_documents as $item ) { ?>
													<?php $icon = wplook_get_icon_name($item['wpl_cpt_document_file']); ?>

													<?php if ( $item['wpl_cpt_document_file'] != '' ) { ?>
														<div class="document-title">
															<i class="<?php echo $icon; ?>"></i> <a href="<?php echo $item['wpl_cpt_document_file']; ?>" download="<?php echo $item['wpl_cpt_document_title']; ?>"><?php echo $item['wpl_cpt_document_title']; ?></a><br />
														</div>
													<?php } ?>
												<?php } ?>
											</div>
										<?php } ?>
										<div class="clear"></div>
									</div>
								</div>

							<?php } // End sermons tabs ?>

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

		<!-- Sermons detailes -->
		<aside class="widget">

			<div class="info-box">
				<div class="info-row"><?php _e('Date', 'benevolence-wpl'); ?><span class="fright"><?php wplook_get_date(); ?></span></div>

				<?php
					$user_first_name = get_the_author_meta('first_name');
					$user_last_name = get_the_author_meta('last_name');
				?>

				<?php if ($user_first_name && $user_last_name) { ?>
					<div class="info-row"><?php _e('Speaker', 'benevolence-wpl'); ?>
						<span class="fright"><?php echo $user_first_name; ?> <?php echo $user_last_name; ?></span>
					</div>
				<?php } else { ?>
					<div class="info-row"><?php _e('Speaker', 'benevolence-wpl'); ?>
						<span class="fright"><?php echo get_the_author(); ?></span>
					</div>
				<?php } ?>

				<?php if ( wplook_custom_taxonomies_terms_links() ) { ?>
					<div class="info-row"><?php _e('Category', 'benevolence-wpl'); ?><span class="fright"><?php echo wplook_custom_taxonomies_terms_links(); ?></span><div class="clear"></div></div>
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

		</aside> <!-- .widget sermons detailes -->

		<!-- Include Sidebar -->
		<?php get_sidebar('sermons'); ?>

	</div><!-- #secondary -->
	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
