<?php
/**
 * The default template for displaying Sermons archive
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
			<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			<?php
				$pid = $post->ID;
				$wpl_cpt_documents = get_post_meta( $pid, 'wpl_cpt_documents', true);
				$wpl_cpt_video = get_post_meta( $pid, 'wpl_cpt_video', true);
				$wpl_cpt_audio = get_post_meta( $pid, 'wpl_cpt_audio', true);
				$video_sermons = get_post_meta( $pid, 'wpl_cpt_video_sermons', true);
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
					<h1 class="entry-header">
						<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h1>

					<!-- Description -->
					<div class="short-description">
						<p><?php echo wplook_short_excerpt(ot_get_option('wpl_sermon_grid_excerpt_limit'));?></p>
					</div>

					<div class="clear"></div>

					<!-- Entry meta -->
					<div class="entry-meta accent-widget-detailes">
						<div class="sermons-icons">
							<!-- Video -->
							<?php if ( $wpl_cpt_video != '' || ! empty( $video_sermons ) ) { ?>
								<div class="scol25">
									<a href="<?php the_permalink(); ?>">
										<span class="youtube"><i class="fab fa-youtube"></i></span>
									</a>
								</div>
							<?php } ?>

							<!-- Audio -->
							<?php if ( ! empty ($wpl_cpt_audio ) ) { ?>
								<div class="scol25">
									<a href="<?php the_permalink(); ?>">
										<span class="music"><i class="fas fa-headphones-alt"></i></span>
									</a>
								</div>
							<?php } ?>

							<!-- Documents -->
							<?php if ( ! empty( $wpl_cpt_documents ) ) { ?>
								<div class="scol25">
									<a href="<?php the_permalink(); ?>">
										<span class="file"><i class="far fa-file-pdf"></i></span>
									</a>
								</div>
							<?php } ?>

							<!-- Read more -->
								<div class="scol25">
									<a href="<?php the_permalink(); ?>">
										<span class="file"><i class="fas fa-ellipsis-h"></i></span>
									</a>
								</div>

							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>

				</div>
			</article>

			<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php _e('Sorry, no sermons matched your criteria.', 'benevolence-wpl'); ?></p>
			<?php endif; ?>

		</div>
		<div class="pagination-grid">
			<?php wplook_content_navigation('postnav' ) ?>
		</div>
	</div>

	<!-- Right Sidebar -->
	<div id="secondary" class="widget-area grid_3">
		<?php get_sidebar('sermons'); ?>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
