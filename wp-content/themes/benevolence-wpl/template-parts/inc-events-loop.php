<?php
/**
 * The default events loop for future, past and archive templates
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.1.7
 * @version 4.6
 */
?>

<?php
	global $wpl_events;

	if( !empty( $wpl_events['posts'] ) ): foreach( $wpl_events['posts'] as $event ):
		$pid = $event['post_id'];
		$post = get_post( $pid );
		setup_postdata( $post );

		$event_start = array_key_exists( 'wpl_event_start', $event ) ? $event['wpl_event_start'] : false;
		$event_end = array_key_exists( 'wpl_event_end', $event ) ? $event['wpl_event_end'] : false;
	?>

	<!-- Article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class('list'); ?>>
		<?php if ( has_post_thumbnail() ) {?>
			<figure>
				<a title="<?php the_title(); ?>" href="<?php echo esc_url( wpl_events_get_permalink( get_the_permalink(), strtotime( $event_start ), strtotime( $event_end ) ) ); ?>">
					<?php the_post_thumbnail('small-thumb'); ?>
				</a>
			</figure>
		<?php } ?>

		<h1 class="entry-header">
			<a title="<?php the_title(); ?>" href="<?php echo esc_url( wpl_events_get_permalink( get_the_permalink(), strtotime( $event_start ), strtotime( $event_end ) ) ); ?>"><?php the_title(); ?></a>
		</h1>

		<div class="short-description">
			<p><?php echo wplook_short_excerpt(ot_get_option('wpl_events_excerpt_limit'));?></p>
		</div>

		<div class="entry-meta">
			<a class="read-more-button fleft" href="<?php echo esc_url( wpl_events_get_permalink( get_the_permalink(), strtotime( $event_start ), strtotime( $event_end ) ) ); ?>" title="<?php _e('Read more', 'benevolence-wpl'); ?>"><?php _e('Read more', 'benevolence-wpl'); ?></a>
			<time class="entry-time" datetime="<?php echo date('c',strtotime($event_start)); ?>">
				<i class="far fa-clock"></i><?php printf( __( '%1$s at %2$s', 'benevolence-wpl' ), date_i18n( get_option( 'date_format' ), strtotime( $event_start ) ), date_i18n( get_option( 'time_format' ), strtotime( $event_start ) ) ); ?>
			</time>
		</div>
		<div class="clear"></div>
	</article>

	<?php endforeach; wp_reset_postdata(); else: ?>
		<p><?php _e( 'Sorry, no events matched your criteria.', 'benevolence-wpl' ); ?></p>
	<?php endif; ?>
