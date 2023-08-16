<?php
/**
 * The default template for displaying Single Gallery
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
	$share_buttons = get_post_meta( $pid, 'wpl_share_buttons', true);
	$wpl_cpt_gallery = get_post_meta( $pid, 'wpl_cpt_gallery', true);
?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ml <?php if ( $page_width != 'off' ) { echo 'grid_9'; } else { echo 'grid_12'; } ?> ?>">
		<div id="content" class="site-content">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class("single"); ?>>
							<div class="entry-content">

								<!-- Photo Gallery -->
								<?php if ( ! empty( $wpl_cpt_gallery ) ) { ?>
									<div class="gallery-image-box">
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

								<div class="clear"></div>
								<?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'benevolence-wpl' ) . '</span>', 'after' => '</div>' ) ); ?>
							</div>
							<div class="entry-meta-news">
								<time class="entry-time" datetime="<?php echo get_the_date( 'c' ) ?>"><i class="far fa-clock"></i> <?php wplook_get_date_time(); ?></time>
								<span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="far fa-user"></i> <?php echo get_the_author(); ?></a></span>
								<?php if ( get_the_tag_list( '', ', ' ) ) { ?>
									<span class="entry-tag"><i class="fas fa-tag"></i> <?php echo get_the_tag_list('',', ',''); ?></span>
								<?php } ?>

								<?php if ( $share_buttons != 'off' ) { ?>

									<span class="share-via-box">
										<span class="share-via fleft"><?php _e('Share via:', 'benevolence-wpl'); ?> </span>
										<span class="fright share-btns">
											<?php wplook_get_share_buttons(); ?>
										</span>
									</span>

								<?php } ?>

								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						</article>

			<?php endwhile; endif; ?>
			<?php comments_template( '', true ); ?>
		</div>
	</div>

	<!-- Right Sidebar -->
	<?php if ($page_width != 'off') { ?>
		<div id="secondary" class="widget-area grid_3">
			<?php get_sidebar('gallery'); ?>
		</div>
	<?php } ?>
	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
