<?php
/**
 * The default template for displaying Single Document
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
	$document_file = get_post_meta(get_the_ID(), 'wpl_document_file', true);
	$document_file_size = get_post_meta(get_the_ID(), 'wpl_document_file_size', true);
	$icon = wplook_get_icon_name($document_file);
?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ml grid_9 ?>">
		<div id="content" class="site-content">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article class="single">
						<div class="entry-content">
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
		<aside class="widget doc-details">
			<div class="info-box">
				<?php // Document cover ?>
				<?php if ( has_post_thumbnail() ) {?>
					<div class="book-cover">
						<?php the_post_thumbnail('document-image'); ?>
					</div>
				<?php } ?>

				<?php // Size ?>
				<?php if ( $document_file !='' ) { ?>
					<div class="info-row"><?php _e('Size', 'benevolence-wpl'); ?><span class="fright"><?php echo $document_file_size; ?></span></div>
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

			<?php // Download ?>
			<?php if ( $document_file !='' ) { ?>
				<div class="download-file">
					<a href="<?php echo $document_file; ?>" download="<?php the_title();?>"><i class="<?php echo $icon; ?>"></i> <?php _e('Download', 'benevolence-wpl'); ?></a>
				</div>
			<?php } ?>

		</aside> <!-- .widget cause detailes -->

		<!-- Include Sidebar -->
		<?php get_sidebar('documents'); ?>

	</div><!-- #secondary -->
	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
