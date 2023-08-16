<?php
/**
 * Google Calendar widget, displaying a FullCalendar list.
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.1.7
 * @version 4.6
 */

add_action('widgets_init', function(){return register_widget("WPL_Google_Calendar_Widget");});
class WPL_Google_Calendar_Widget extends WP_Widget {

	/**
	 * Widget registration.
	 *
	 * @since 1.1.7
	 * @access public
	 */
	public function __construct() {
		parent::__construct(
	 		'WPL_Google_Calendar_Widget',
			__( 'WPlook Google Calendar', 'benevolence-wpl' ),
			array( 'description' => __( 'A widget for displaying a list of events stored in Google Calendar.', 'benevolence-wpl' ), )
		);
	}

	/**
	 * Display the admin form.
	 *
	 * @since 1.1.7
	 * @access public
	 * @param array $instance Options for the particular instance of the widget.
	 */
	public function form( $instance ) {

		$title = ( $instance && array_key_exists( 'title', $instance ) ? esc_attr( $instance[ 'title' ] ) : '' );
		$subtitle = ( $instance && array_key_exists( 'subtitle', $instance ) ? esc_attr( $instance[ 'subtitle' ] ) : '' );
		$calendar = ( $instance && array_key_exists( 'calendar', $instance ) ? esc_attr( $instance[ 'calendar' ] ) : '' );
		$color = ( $instance && array_key_exists( 'color', $instance ) ? esc_attr( $instance[ 'color' ] ) : '' );
		$button_text = ( $instance && array_key_exists( 'button_text', $instance ) ? esc_attr( $instance[ 'button_text' ] ) : __( 'View Calendar', 'benevolence-wpl' ) );
		$button_url = ( $instance && array_key_exists( 'button_url', $instance ) ? esc_attr( $instance[ 'button_url' ] ) : '' );

		?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'benevolence-wpl' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php _e( 'Subtitle:', 'benevolence-wpl' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'calendar' ) ); ?>"><?php _e( 'Google Calendar ID:', 'benevolence-wpl' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'calendar' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'calendar' ) ); ?>" type="text" value="<?php echo esc_attr( $calendar ); ?>" />
				<span class="widget-help">
					<?php printf( __( 'Add your Google Calendar ID. Read the <a href="%1$s" target="_blank">theme documentation</a> for more information.', 'benevolence-wpl' ), 'https://wplook.com/docs/benevolence/events-benevolence/google-calendar/' ); ?></p>
				</span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>"><?php _e( 'Events color:', 'benevolence-wpl' ); ?></label>
				<input class="widefat wplook-admin-color-picker" data-default-color="#ff9900" id="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'color' ) ); ?>" type="text" value="<?php echo esc_attr( $color ); ?>" />
				<span class="widget-help">
					<?php _e( 'The color all of the events will be displayed in.', 'benevolence-wpl' ); ?></p>
				</span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"><?php _e( 'Button text:', 'benevolence-wpl' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" />
				<span class="widget-help">
					<?php _e( 'The button could link to a page using the Google Calendar page template or the Google Calendar share URL. Leave blank to disable.', 'benevolence-wpl' ); ?></p>
				</span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>"><?php _e( 'Button URL:', 'benevolence-wpl' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_url' ) ); ?>" type="text" value="<?php echo esc_attr( $button_url ); ?>" />
			</p>

			<?php if( is_int( $this->number ) ) : ?>
				<p class="widget-help">
					<?php printf( __( 'The ID of this widget is: %1$s', 'benevolence-wpl' ), '<strong>#' . esc_attr( $this->id ) . '</strong>' ); ?></p>
				</p>
			<?php endif; ?>

		<?php

	}

	/**
	 * Process and save the widget options from the admin form.
	 *
	 * @since 1.1.7
	 * @access public
	 * @param array $new_instance Widget options from the form.
	 * @param array $old_instance Options for the particular instance of the widget.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['subtitle'] = sanitize_text_field( $new_instance['subtitle'] );
		$instance['calendar'] = esc_attr( $new_instance['calendar'] );
		$instance['color'] = sanitize_text_field( $new_instance['color'] );
		$instance['button_text'] = sanitize_text_field( $new_instance['button_text'] );
		$instance['button_url'] = sanitize_text_field( $new_instance['button_url'] );
		return $instance;

	}

	/**
	 * Generate and display the widget in the front-end of the site.
	 *
	 * @since 1.1.7
	 * @access public
	 * @param array $args Display arguments for the widget area.
	 * @param array $instance Options for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {

		wp_enqueue_script( 'moment' );
		wp_enqueue_script( 'fullcalendar' );
		wp_enqueue_script( 'fullcalendar-locale' );
		wp_enqueue_script( 'gcal' );
		wp_enqueue_style( 'fullcalendar' );

		extract( $args );
		$title = apply_filters( 'widget_title', ( !empty( $instance['title'] ) ? $instance['title'] : '' ) );
		$subtitle = ( !empty( $instance['subtitle'] ) ? $instance['subtitle'] : '' );
		$calendar = ( !empty( $instance['calendar'] ) ? $instance['calendar'] : '' );
		$color = ( !empty( $instance['color'] ) ? $instance['color'] : '' );
		$button_text = ( !empty( $instance['button_text'] ) ? $instance['button_text'] : '' );
		$button_url = ( !empty( $instance['button_url'] ) ? $instance['button_url'] : '' );

		$calendar_api_key = ot_get_option( 'wpl_api_settings_google_calendar_key' );
		$calendar_api_key = $calendar_api_key ? $calendar_api_key : null;

		$calendar_language = ot_get_option( 'wpl_events_calendar_language' );
		$calendar_language = $calendar_language ? $calendar_language : 'en';
		?>

			<?php echo $before_widget; ?>

			<?php
				if( !empty( $title ) ) :
					echo $before_title . $title . $after_title;
				endif;
			?>

			<?php if( !empty( $subtitle ) ) : ?>
				<p><?php echo $subtitle; ?></p>
			<?php endif; ?>

			<?php if( $calendar && $calendar_api_key ) : ?>
				<div class="wplook-calendar wplook-calendar-small wplook-google-calendar wplook-google-calendar-list" data-language="<?php echo esc_attr( $calendar_language ); ?>" data-color="<?php echo esc_attr( $color ); ?>" data-api-key="<?php echo esc_attr( $calendar_api_key ); ?>" data-calendar="<?php echo esc_attr( $calendar ); ?>">
					<div class="loading visible">
						<div class="loading-content">
							<div class="loading-events visible">
								<i class="fas fa-spinner"></i>
								<p><?php _e( 'Loading events', 'benevolence-wpl' ); ?></p>
							</div>

							<div class="error">
								<p><?php _e( 'An error has occured:', 'benevolence-wpl' ); ?></p>
								<p class="error-contents"></p>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php if( !empty( $button_text ) ) : ?>
				<a href="<?php echo esc_url( $button_url ); ?>" class="button" target="_blank"><?php echo $button_text; ?></a>
			<?php endif; ?>

			<?php echo $after_widget; ?>
		<?php
	}

}
?>
