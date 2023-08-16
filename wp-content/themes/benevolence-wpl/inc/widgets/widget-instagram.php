<?php
/*
 * Plugin Name: INstagram Widget
 * Plugin URI: https://www.wplook.com
 * Description: This is a widget to display Instagram Photos
 * Author: Victor Tihai
 * @version 4.6
 * Author URI: https://www.wplook.com
*/
// Register Widget
add_action('widgets_init', function(){return register_widget("wplook_instagram_widget");});

// Widget Class
class wplook_Instagram_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'wplook_instagram_widget', // Base ID
			esc_html__( 'WPlook - Instagram Photos', 'benevolence-wpl' ), // Name
			array( 'description' => esc_html__( 'Show photos from an instagram account.', 'benevolence-wpl' ) ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		$amount = $instance['amount'];
		$access_token = $instance['access_token'];

		$accountinfo = $instance['accountinfo'];

		$username = '';
		if ( $access_token && $access_token !== '' ) {
			$username = explode( '.', $access_token );
			$username = $username[0];
		}

		echo $before_widget;

		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		/* Start - Widget Content */

		$transient_id = 'wpl_instagram_transient_' . $username . '_' . $amount;

		if ( false === ( $instagram_data = get_transient( $transient_id ) ) ) {

			$args = array(
				'timeout'     => 30,
			);

			// Get Images
			$url = 'https://api.instagram.com/v1/users/' . $username . '/media/recent/?access_token=' . $access_token . '&count=' . $amount;
			$data = json_decode( wp_remote_retrieve_body( wp_remote_get( $url, $args ) ), true );

			// Check if images are returned
			if ( isset( $data['data'] ) ) {

				$images_data = $data['data'];
				$images = array();

				// Generate array
				foreach ( $images_data as $image ) {

					$images[] = array(
						'image' => $image['images']['thumbnail']['url'],
						'url' => $image['link'],
					);

				}

				$instagram_data = array(
					'images' => $images,
					'avatar' => $images_data[0]['user']['profile_picture'],
					'name' => $images_data[0]['user']['full_name'],
					'user' => $images_data[0]['user']['username']
				);

				// Set Trainsient
				set_transient( $transient_id, $instagram_data, 12 * HOUR_IN_SECONDS );

			} else {
				$instagram_data = false;
			}

		}

		?>

		<div class="instagram-widget">
			<div class="instagram-widget-header clearfix">
				<?php if ( $accountinfo != "no") { ?>
					<div class="instagram-widget-avatar">
						<span class="instagram-widget-avatar"><img src="<?php echo esc_url( $instagram_data['avatar'] ); ?>" alt="" /></span>
					</div><!-- .instagram-widget-header-left -->

					<div class="instagram-widget-follow">
						<h4><?php echo esc_html( $instagram_data['name'] ); ?></h4>
						<a class="instagram-widget-button" href="https://www.instagram.com/<?php echo esc_attr( $instagram_data['user'] ); ?>"><?php esc_html_e( 'Follow', 'benevolence-wpl' ); ?></a>
					</div><!-- .instagram-widget-header-right -->
				<?php } ?>

			</div><!-- .instagram-widget-header -->
			<div class="instagram-widget-images clearfix">
				<?php if ( $instagram_data ) : ?>
					<?php foreach ( $instagram_data['images'] as $image ) : ?>
						<div class="instagram-widget-image">
							<a href="<?php echo esc_url( $image['url'] ); ?>" target="_blank"><img src="<?php echo esc_url( $image['image'] ); ?>" alt="" /></a>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div><!-- .instagram-widget -->

		<?php

		/* End - Widget Content */
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['amount'] = strip_tags( $new_instance['amount'] );
		$instance['accountinfo'] = strip_tags( $new_instance['accountinfo'] );
		$instance['access_token'] = strip_tags( $new_instance['access_token'] );
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		// Get values
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Instagram Photos';
		if ( isset( $instance[ 'amount' ] ) ) $amount = $instance[ 'amount' ]; else $amount = '9';
		if ( isset( $instance[ 'accountinfo' ] ) ) $accountinfo = $instance[ 'accountinfo' ]; else $accountinfo = 'yes';
		if ( isset( $instance[ 'access_token' ] ) ) $access_token = $instance[ 'access_token' ]; else $access_token = '';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'benevolence-wpl' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
				<label for="<?php echo $this->get_field_id('accountinfo'); ?>"> <?php _e('Display Account Information', 'benevolence-wpl'); ?> <br /> </label>
				<select id="<?php echo $this->get_field_id('accountinfo'); ?>" name="<?php echo $this->get_field_name('accountinfo'); ?>">
					<option value="yes" <?php selected( 'yes', $accountinfo ); ?>><?php _e('Yes', 'benevolence-wpl'); ?></option>
					<option value="no" <?php selected( 'no', $accountinfo ); ?>><?php _e('No', 'benevolence-wpl'); ?></option>
				</select>
			</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>"><?php esc_html_e( 'Amount:', 'benevolence-wpl' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'amount' ) ); ?>" type="text" value="<?php echo esc_attr( $amount ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>"><?php esc_html_e( 'Access Token:', 'benevolence-wpl' ); ?> ( can be found <a href="http://instagram.pixelunion.net" target="_blank">here</a> )</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'access_token' ) ); ?>" type="text" value="<?php echo esc_attr( $access_token ); ?>" />
		</p>
		<?php

	}

}
