<?php
/**
 * The default template for displaying documents archive
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 4.5
 * @version 4.6
 */
?>
<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ml grid_9">
		<div id="content" class="site-content">
			<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<?php
					$pid = $post->ID;
					$document_file = get_post_meta( $pid, 'wpl_document_file', true);
					$icon = wplook_get_icon_name($document_file);
					$document_file_size = get_post_meta( $pid, 'wpl_document_file_size', true);
				?>
				<!-- Article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class('list'); ?>>
					<?php if ( has_post_thumbnail() ) {?>
						<figure>
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('small-thumb'); ?>
							</a>
						</figure>
					<?php } ?>

					<h1 class="entry-header">
						<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h1>

					<div class="short-description">
						<p><?php echo wplook_short_excerpt(ot_get_option('wpl_docs_excerpt_limit'));?></p>
					</div>

					<div class="entry-meta">
						<a class="read-more-button fleft" href="<?php the_permalink(); ?>" title="<?php _e('Read more', 'benevolence-wpl'); ?>"><?php _e('Read more', 'benevolence-wpl'); ?></a>
						<span class="entry-doc"><i class="<?php echo $icon; ?>"></i> <?php echo $document_file_size; ?></span>
					</div>
					<div class="clear"></div>
				</article>

			<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php _e('Sorry, no documents matched your criteria.', 'benevolence-wpl'); ?></p>
			<?php endif; ?>

			<?php wplook_content_navigation('postnav' ) ?>
		</div>
	</div>

	<!-- Right Sidebar -->
	<div id="secondary" class="widget-area grid_3">
		<?php get_sidebar('documents'); ?>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
