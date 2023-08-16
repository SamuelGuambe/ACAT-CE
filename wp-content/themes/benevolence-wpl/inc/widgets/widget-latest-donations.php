<?php
/**
 * Display latest donations to either all or a particular cause.
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.1.7
 * @version 4.6
 */

add_action('widgets_init', function(){return register_widget("WPL_Latest_Donations");});

class WPL_Latest_Donations extends WP_Widget {

	/**
	 * Widget registration.
	 *
	 * @since 1.1.7
	 * @access public
	 */
	public function __construct() {
		parent::__construct(
	 		'WPL_Latest_Donations',
			__( 'WPlook Latest Donations', 'benevolence-wpl' ),
			array( 'description' => __( 'Display latest donations to either all causes or a selected cause, based on existing Pledges information from PayPal and Stripe.', 'benevolence-wpl' ), )
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

		$title = ( $instance && array_key_exists( 'title', $instance ) ? esc_attr( $instance[ 'title' ] ) : __( 'Latest donations', 'benevolence-wpl') );
		$description = ( $instance && array_key_exists( 'description', $instance ) ? esc_attr( $instance[ 'description' ] ) : '' );
		$cause = ( $instance && array_key_exists( 'cause', $instance ) ? esc_attr( $instance[ 'cause' ] ) : 'current' );
		$number = ( $instance && array_key_exists( 'number', $instance ) ? esc_attr( $instance[ 'number' ] ) : '3' );
		$display_information = ( $instance && array_key_exists( 'display_information', $instance ) ? esc_attr( $instance[ 'display_information' ] ) : 'on' );
		$display_total = ( $instance && array_key_exists( 'display_total', $instance ) ? esc_attr( $instance[ 'display_total' ] ) : 'on' );
		$display_goal = ( $instance && array_key_exists( 'display_goal', $instance ) ? esc_attr( $instance[ 'display_goal' ] ) : 'on' );
		$display_link = ( $instance && array_key_exists( 'display_link', $instance ) ? esc_attr( $instance[ 'display_link' ] ) : 'on' );

		?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'benevolence-wpl' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php _e( 'Description:', 'benevolence-wpl' ); ?></label>
				<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" rows="4"><?php echo esc_attr( $description ); ?></textarea>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cause' ) ); ?>"><?php _e( 'Cause:', 'benevolence-wpl' ); ?></label>
				<?php

					$args = array(
						'get_posts_args' => array(
							'post_type' => 'post_causes',
							'posts_per_page' => -1
						),
						'field_name' => 'cause',
						'selected' => $cause,
						'first' => array(
							'name' => __( 'Current cause', 'benevolence-wpl' ),
							'value' => 'current'
						),
					);

					wplook_dropdown_posts( $args, $this );

				?>
				<span class="widget-help"><?php _e( 'Use this widget in the <strong>Causes Widget area</strong> and select <strong>Current cause</strong> to display information for the cause currently being displayed.', 'benevolence-wpl' ); ?></span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of donations:', 'benevolence-wpl' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" value="<?php echo esc_attr( $number ); ?>" />
			</p>

			<p>
				<input class="widefat checkbox" id="<?php echo esc_attr( $this->get_field_id( 'display_information' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_information' ) ); ?>" type="checkbox" value="<?php echo esc_attr( $display_information ); ?>" <?php checked( $display_information, 'on' ); ?> />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_information' ) ); ?>"><?php _e( 'Display cause information', 'benevolence-wpl' ); ?></label>
				<span class="widget-help"><?php _e( 'Display the title, short description and image of a cause above the latest donations.', 'benevolence-wpl' ); ?></span>
			</p>

			<p>
				<input class="widefat checkbox" id="<?php echo esc_attr( $this->get_field_id( 'display_total' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_total' ) ); ?>" type="checkbox" value="<?php echo esc_attr( $display_total ); ?>" <?php checked( $display_total, 'on' ); ?> />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_total' ) ); ?>"><?php _e( 'Display total', 'benevolence-wpl' ); ?></label>
				<span class="widget-help"><?php _e( 'Display the total amount of donations for this cause below the latest donations.', 'benevolence-wpl' ); ?></span>
			</p>

			<p>
				<input class="widefat checkbox" id="<?php echo esc_attr( $this->get_field_id( 'display_goal' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_goal' ) ); ?>" type="checkbox" value="<?php echo esc_attr( $display_goal ); ?>" <?php checked( $display_goal, 'on' ); ?> />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_goal' ) ); ?>"><?php _e( 'Display goal', 'benevolence-wpl' ); ?></label>
				<span class="widget-help"><?php _e( 'Display the goal for donations for this cause below the latest donations.', 'benevolence-wpl' ); ?></span>
			</p>

			<p>
				<input class="widefat checkbox" id="<?php echo esc_attr( $this->get_field_id( 'display_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_link' ) ); ?>" type="checkbox" value="<?php echo esc_attr( $display_link ); ?>" <?php checked( $display_link, 'on' ); ?> />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_link' ) ); ?>"><?php _e( 'Display link', 'benevolence-wpl' ); ?></label>
				<span class="widget-help"><?php _e( 'Display the link to the single cause page below the latest donations.', 'benevolence-wpl' ); ?></span>
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
		$instance['description'] = wp_kses_data( $new_instance['description'] );
		$instance['cause'] = esc_attr( $new_instance['cause'] );
		$instance['number'] = intval( $new_instance['number'] );
		$instance['display_information'] = $new_instance['display_information'] ? 'on' : 'off';
		$instance['display_total'] = $new_instance['display_total'] ? 'on' : 'off';
		$instance['display_goal'] = $new_instance['display_goal'] ? 'on' : 'off';
		$instance['display_link'] = $new_instance['display_link'] ? 'on' : 'off';
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

		extract( $args );
		$title = apply_filters( 'widget_title', ( !empty( $instance['title'] ) ? $instance['title'] : '' ) );
		$description = ( !empty( $instance['description'] ) ? $instance['description'] : '' );
		$cause = ( !empty( $instance['cause'] ) ? $instance['cause'] : '' );
		$number = ( !empty( $instance['number'] ) ? intval( $instance['number'] ) : 3 );
		$display_information = $instance['display_information'] ? 'on' : 'off';
		$display_total = $instance['display_total'] ? 'on' : 'off';
		$display_goal = $instance['display_goal'] ? 'on' : 'off';
		$display_link = $instance['display_link'] ? 'on' : 'off';

		if( $cause == 'current' ) {
			global $post;
			$cause = get_the_ID( $post );
		}

		$pledges_args = array(
			'post_type' => 'post_pledges',
			'post_status' => 'publish',
			'posts_per_page' => $number,
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'wpl_pledge_payment_Status',
					'value' => 'Completed',
					'compare' => 'IN',
				),
				array(
					'key' => 'wpl_pledge_cause',
					'value' => $cause,
				),
			)
		);

		$pledges_query = new WP_Query( $pledges_args );

		if( $display_total || $display_goal ) {
			$totals = wplook_get_pledges_totals( $cause );
		}

		$goal = get_post_meta( $cause, 'wpl_goal_amount', true );
		$currency_code = ot_get_option( 'wpl_curency_code' );

		?>

			<?php echo $before_widget; ?>

			<?php
				if( !empty( $title ) ) :
					echo $before_title . $title . $after_title;
				endif;
			?>

			<?php if( $display_information ) : ?>
				<?php $cause_args = array( 'p' => $cause, 'post_type' => 'post_causes' ); ?>
				<?php $cause_query = new WP_Query( $cause_args ); ?>
				<?php if( $cause_query->have_posts() ) : ?>
					<?php while( $cause_query->have_posts() ) : $cause_query->the_post(); ?>
						<div class="cause-information <?php echo has_post_thumbnail() ? 'has-thumbnail' : 'no-thumbnail'; ?>">
							<?php if( has_post_thumbnail() ) : ?>
								<div class="image" style="background-image: url( '<?php the_post_thumbnail_url( 'medium' ); ?>' );"></div>
							<?php endif; ?>

							<h3 class="title"><?php the_title(); ?></h3>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; wp_reset_query(); ?>
			<?php endif; ?>

			<?php if( !empty( $description ) ) : ?>
				<p class="description"><?php echo $description; ?></p>
			<?php endif; ?>

			<?php if( $pledges_query->have_posts() ) : ?>
				<?php while( $pledges_query->have_posts() ) : $pledges_query->the_post(); ?>
					<?php
						$pid = get_the_ID();
						$email = get_post_meta( $pid, 'wpl_pledge_email', true );
						$first_name = get_post_meta( $pid, 'wpl_pledge_first_name', true );
						$last_name = get_post_meta( $pid, 'wpl_pledge_last_name', true );
						$value = get_post_meta( $pid, 'wpl_pledge_donation_amount', true );
						$anonymous = get_post_meta( $pid, 'wpl_pledge_anonymous', true );
					?>
					<div class="latest-pledges">
						<div class="pledge">
							<div class="image">
								<img src="<?php echo esc_url( 'https://www.gravatar.com/avatar/' . md5( strtolower( trim( $email ) ) ) . '?d=mm&s=120' ); ?>" />
							</div>

							<div class="content">
								<?php if( ( $first_name || $last_name ) && $anonymous == 'off' ) : ?>
									<p class="name"><?php printf( _x( '%1$s %2$s', '[first name] [last name]', 'benevolence-wpl' ), $first_name, $last_name ); ?></p>
								<?php else: ?>
									<p class="name"><?php _e( 'Anonymous', 'benevolence-wpl' ); ?></p>
								<?php endif; ?>

								<p class="value"><?php printf( _x( '+%1$0.2f %2$s', '[donation value] [currency code]', 'benevolence-wpl' ), $value, $currency_code ); ?></p>
							</div>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			<?php endif; wp_reset_query(); ?>

			<?php if( $display_total || $display_goal ) : ?>
				<div class="cause-statistics">
					<?php if( $display_total ) : ?>
						<div class="cause-total">
							<p class="label"><?php _e( 'Total donations', 'benevolence-wpl' ); ?></p>
							<p class="content"><?php printf( _x( '%1$0.2f %2$s', '[total donations] [currency code]', 'benevolence-wpl' ), $totals['total'], $currency_code ); ?></p>
						</div>
					<?php endif; ?>

					<?php if( $display_goal && $goal > 0 ) : ?>
						<div class="cause-goal">
							<p class="label"><?php _e( 'Goal', 'benevolence-wpl' ); ?></p>
							<p class="content"><?php printf( _x( '%1$0.2f %2$s', '[total donations] [currency code]', 'benevolence-wpl' ), $goal, $currency_code ); ?></p>
						</div>

						<div class="progress-bar">
							<div class="progress-bar-inner">
								<?php $raised = $totals['total'] * 90.2 / $goal; ?>
								<div class="bar raised" style="width: <?php echo esc_attr( $raised ); ?>%;"></div>

								<?php if( $totals['total'] <= 0 ) {
									$dot = -1;
								} elseif( $totals['total'] >= $goal ) {
									$dot = 92;
								} else {
									$dot = $totals['total'] * 90.2 / $goal;
								} ?>
								<div class="dot" style="left: <?php echo esc_attr( $dot ); ?>%;"></div>

								<?php if( $totals['total'] <= 0 ) {
									$left = 100;
								} elseif( $totals['total'] >= $goal ) {
									$left = 0;
								} else {
									$left = 100 - ( $totals['total'] * 90.2 / $goal );
								} ?>
								<div class="bar left <?php echo $left <= 0 || $left > 100 ? 'hidden' : ''; ?>" style="width: <?php echo esc_attr( $left ); ?>%;"></div>
							</div>
							<div class="completion"><?php printf( '%d%%', ( $totals['total'] / $goal ) * 100 ); ?></div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>


			<?php if( $display_link ) : ?>
				<a href="<?php echo get_the_permalink( $cause ); ?>" class="button" target="_blank"><?php _e( 'View cause', 'benevolence-wpl' ); ?></a>
			<?php endif; ?>

			<?php echo $after_widget; ?>


		<?php
	}

}
?>
