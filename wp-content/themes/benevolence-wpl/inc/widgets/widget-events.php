<?php
/*
 * Plugin Name: Events
 * Plugin URI: http://www.wplook.com
 * Description: Add Events on pages
 * Author: Victor Tihai
 * @version 4.6
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', function(){return register_widget("wplook_events_widget");});
class wplook_events_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/

	public function __construct() {
		parent::__construct(
	 		'wplook_events_widget',
	 		__( 'WPlook Events', 'benevolence-wpl' ),
			array( 'description' => __( 'A widget for displaying upcoming events', 'benevolence-wpl' ), )
		);
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/

	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		}
		else {
			$title = __( 'Events', 'benevolence-wpl' );
		}

		if ( $instance ) {
			$categories = esc_attr( $instance[ 'categories' ] );
		}
		else {
			$categories = __( 'All', 'benevolence-wpl' );
		}

		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = __( '3', 'benevolence-wpl' );
		}

		if ( $instance ) {
			$event_type = esc_attr( $instance[ 'event_type' ] );
		}
		else {
			$event_type = __( '', 'benevolence-wpl' );
		}

		if ( $instance ) {
			$duration = esc_attr( $instance[ 'duration' ] );
		}
		else {
			$duration = 60;
		}

		if ( $instance ) {
			$read_more_link = esc_attr( $instance[ 'read_more_link' ] );
		}
		else {
			$read_more_link = __( '', 'benevolence-wpl' );
		}

		if ( $instance ) {
			$calendar_url = esc_attr( $instance[ 'calendar_url' ] );
		}
		else {
			$calendar_url = __( '', 'benevolence-wpl' );
		}

		if ( $instance ) {
			$clear_after = esc_attr( $instance[ 'clear_after' ] );
		}
		else {
			$clear_after = __( '1', 'benevolence-wpl' );
		}

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'benevolence-wpl'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">
				<?php _e('Category:', 'benevolence-wpl'); ?>
				<br />
			</label>

			<?php wp_dropdown_categories(
				array(
					'name'	=> $this->get_field_name("categories"),
					'show_option_all'    => __('All', 'benevolence-wpl'),
					'show_count'	=> 1,
					'selected' => $categories,
					'taxonomy'  => 'wpl_events_category'
				)
			); ?>

		</p>

		<p>
			<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Events:', 'benevolence-wpl'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of events you want to display', 'benevolence-wpl'); ?></p>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('event_type'); ?>">
				<?php _e('Event type', 'benevolence-wpl'); ?>
				<br />
			</label>
			<select id="<?php echo $this->get_field_id('event_type'); ?>" name="<?php echo $this->get_field_name('event_type'); ?>">
				<option value="upcoming" <?php selected( 'upcoming', $event_type ); ?>><?php _e('Upcoming events', 'benevolence-wpl'); ?></option>
				<option value="past" <?php selected( 'past', $event_type ); ?>><?php _e('Past events', 'benevolence-wpl'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('duration'); ?>"> <?php _e('Duration in days:', 'benevolence-wpl'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('duration'); ?>" name="<?php echo $this->get_field_name('duration'); ?>" type="number" min="0" step="1" value="<?php echo $duration; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('If the widget is displaying fewer events than the "Number of Events" value above, you can increase this value to look for events over a longer period of time.', 'benevolence-wpl'); ?></p>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to all events:', 'benevolence-wpl'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('View all events URL', 'benevolence-wpl'); ?></p>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('calendar_url'); ?>"> <?php _e('Calendar:', 'benevolence-wpl'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('calendar_url'); ?>" name="<?php echo $this->get_field_name('calendar_url'); ?>" type="text" value="<?php echo $calendar_url; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Calendar URL', 'benevolence-wpl'); ?></p>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('clear_after'); ?>">
				<?php _e('Clear after?', 'benevolence-wpl'); ?>
				<br />
			</label>
			<select id="<?php echo $this->get_field_id('clear_after'); ?>" name="<?php echo $this->get_field_name('clear_after'); ?>">
				<option value="0" <?php selected( '0', $clear_after ); ?>><?php _e('Yes', 'benevolence-wpl'); ?></option>
				<option value="1" <?php selected( '1', $clear_after ); ?>><?php _e('No', 'benevolence-wpl'); ?></option>
			</select>
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Clear after if you want to add one or more widgets after this widget.', 'benevolence-wpl'); ?></p>
		</p>

		<?php
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['categories'] = sanitize_text_field($new_instance['categories']);
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
		$instance['event_type'] = sanitize_text_field($new_instance['event_type']);
		$instance['clear_after'] = sanitize_text_field($new_instance['clear_after']);
		$instance['duration'] = abs(intval($new_instance['duration']));
		$instance['read_more_link'] = sanitize_text_field($new_instance['read_more_link']);
		$instance['calendar_url'] = sanitize_text_field($new_instance['calendar_url']);
		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$categories = isset( $instance['categories'] ) ? esc_attr( $instance['categories'] ) : '';
		$nr_posts = isset( $instance['nr_posts'] ) ? esc_attr( $instance['nr_posts'] ) : '';
		$event_type = isset( $instance['event_type'] ) ? esc_attr( $instance['event_type'] ) : 'upcoming';
		$duration = isset( $instance['duration'] ) ? abs( intval( esc_attr( $instance['duration'] ) ) ) : 60;
		$clear_after = isset( $instance['clear_after'] ) ? esc_attr( $instance['clear_after'] ) : '';
		$read_more_link = isset( $instance['read_more_link'] ) ? esc_attr( $instance['read_more_link'] ) : '';
		$calendar_url = isset( $instance['calendar_url'] ) ? esc_attr( $instance['calendar_url'] ) : '';
		?>

		<?php

			$category_slug = get_term_by( 'id', $categories, 'wpl_events_category' );

			if( $event_type == 'past' ) {
				$start_date = date( 'd-m-Y', time() - $duration * 86400 );
				$end_date = date( 'd-m-Y' );
				$args = array(
					'start_date' => $start_date,
					'end_date' => $end_date,
					'taxonomy' => $category_slug,
					'limit' => $nr_posts,
					'sorting' => 'descending'
				);
			} else {
				$start_date = date( 'd-m-Y' );
				$end_date = date( 'd-m-Y', time() + $duration * 86400 );
				$args = array(
					'start_date' => $start_date,
					'end_date' => $end_date,
					'taxonomy' => $category_slug,
					'limit' => $nr_posts,
				);
			}

			$events = wplook_generate_events_array( $args );

			?>

			<?php if( !empty( $events['posts'] ) ): ?>

				<?php if ($title=="") $title = "Events"; ?>
					<?php echo $before_widget; ?>
					<?php if ( $title )
					if ( $read_more_link != '' ) {
						$view = __( 'View more', 'benevolence-wpl' );
						$url = '<span class="fright"><a href="' . $read_more_link . '">' . $view . '</a></span';
					} else {
						$url = '';
					}
					echo $before_title . $title . $url . $after_title; ?>

					<div class="widget-event-body">
						<?php foreach( $events['posts'] as $event ):
							$pid = $event['post_id'];
							$post = get_post( $pid );
							setup_postdata( $post );

							$event_start = $event['wpl_event_start'];
							$event_end = $event['wpl_event_end'];
							?>
							<article class="event-item">
								<div class="event-day-month fleft">
									<div class="event-month"><?php echo date_i18n( 'M', strtotime($event_start) ); ?></div>
									<div class="event-day"><?php echo date_i18n( 'd', strtotime($event_start) ); ?></div>

								</div>
								<div class="event-info fleft">
									<a href="<?php echo esc_url( wpl_events_get_permalink( get_the_permalink(), strtotime( $event_start ), strtotime( $event_end ) ) ); ?>"><?php the_title(); ?></a>
								</div>

								<div class="clear"></div>
							</article>

						<?php endforeach; wp_reset_postdata(); ?>

						<?php if($calendar_url) { ?>
							<div class="past-cal">
								<?php if ( $calendar_url ){ ?>
									<div class="calendar-ev fleft"><a href="<?php echo $calendar_url ?>"><?php _e('Calendar', 'benevolence-wpl'); ?></a></div>
								<?php } ?>

								<div class="clear"></div>
							</div>
						<?php }	?>
					</div>
				<?php echo $after_widget; ?>
				<?php if ( $clear_after =="0" ) { ?>
					<div class="clear-widget"></div>
				<?php } ?>
			<?php else: ?>
				<?php if ($title=="") $title = "Events"; ?>
				<?php echo $before_widget . $before_title . $title . $after_title; ?>
					<p><?php _e( 'No events scheduled at this time.', 'benevolence-wpl' ); ?></p>
				<?php echo $after_widget; ?>
				<?php if ( $clear_after =="0" ) { ?>
					<div class="clear-widget"></div>
				<?php } ?>
			<?php endif; ?>
		<?php
	}
}
?>
