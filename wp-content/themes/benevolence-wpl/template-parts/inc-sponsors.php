<?php
/**
 * The default template for displaying Sponsors
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>

<div class="sponsors">

	<div class="container_12">
		<div class="sponsor-title-nav">
			<div class="widget-title">
				<h3><?php _e('Our Sponsors', 'benevolence-wpl'); ?></h3>

				<div class="owl-Navigation">
					<a class="btn prev"><i class="fas fa-angle-left"></i></a>
					<a class="btn next"><i class="fas fa-angle-right"></i></a>
				</div>
			</div>
		</div>

		<div id="owl-sponsors" class="owl-carousel">

			<?php $args = array( 'post_type' => 'post_sponsor','post_status' => 'publish', 'orderby' => 'date', 'posts_per_page' => ot_get_option('wpl_sponsors_per_page'), 'paged'=> $paged); ?>
			<?php $wp_query = new WP_Query( $args ); ?>
			<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<?php
					$pid = $post->ID;
					$logo = get_post_meta( $pid, 'wpl_logo_image', true );
					$url = get_post_meta( $pid, 'wpl_sponsor_url', true );
					$blank = get_post_meta( $pid, 'wpl_sponsor_blank', true );
				?>

				<div class="item"><a <?php echo ( $blank != 'off' ? 'target="_blank"' : '' ); ?> href="<?php echo $url; ?>"><img src="<?php echo $logo; ?>" alt="<?php the_title(); ?>" width="260" height="80"></a> </div>


			<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php _e('Sorry, no sponsors matched your criteria.', 'benevolence-wpl'); ?></p>
			<?php endif; ?>

		</div>

	</div>
</div>
