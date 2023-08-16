<?php
/*
 * Plugin Name: Address
 * Plugin URI: http://www.wplook.com
 * Description: Add Address to pages
 * Author: Victor Tihai
 * @version 4.6
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', function(){return register_widget("wplook_address_widget");});
class wplook_address_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/

	public function __construct() {
		parent::__construct(
	 		'wplook_address_widget',
			__( 'WPlook Address', 'benevolence-wpl' ),
			array( 'description' => __( 'A widget for displaying Address', 'benevolence-wpl' ), )
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
			$title = __( 'Contact Us', 'benevolence-wpl' );
		}

		if ( $instance ) {
			$organisation_name = esc_attr( $instance[ 'organisation_name' ] );
		}
		else {
			$organisation_name = __( '', 'benevolence-wpl' );
		}

		if ( $instance ) {
			$street_address = esc_attr( $instance[ 'street_address' ] );
		}
		else {
			$street_address = __( '', 'benevolence-wpl' );
		}

		if ( $instance ) {
			$phone = esc_attr( $instance[ 'phone' ] );
		}
		else {
			$phone = __( '', 'benevolence-wpl' );
		}

		if ( $instance ) {
			$email = esc_attr( $instance[ 'email' ] );
		}
		else {
			$email = __( '', 'benevolence-wpl' );
		}

		if ( $instance ) {
			$website = esc_attr( $instance[ 'website' ] );
		}
		else {
			$website = __( '', 'benevolence-wpl' );
		}

		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('organisation_name'); ?>"> <?php _e('Organisation Name:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('organisation_name'); ?>" name="<?php echo $this->get_field_name('organisation_name'); ?>" type="text" value="<?php echo $organisation_name; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Add Organisation name', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('street_address'); ?>">
					<?php _e('Address:', 'benevolence-wpl'); ?>
				</label>
				<textarea cols="25" rows="10" class="widefat" id="<?php echo $this->get_field_id('street_address'); ?>" name="<?php echo $this->get_field_name('street_address'); ?>" type="text"><?php echo $street_address; ?></textarea>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('phone'); ?>"> <?php _e('Phone:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Add Phone Number', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('email'); ?>"> <?php _e('Email:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Add Email Address', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('website'); ?>"> <?php _e('Website:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('website'); ?>" name="<?php echo $this->get_field_name('website'); ?>" type="text" value="<?php echo $website; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Add Website Address', 'benevolence-wpl'); ?></p>
			</p>


		<?php
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['organisation_name'] = sanitize_text_field($new_instance['organisation_name']);
		$instance['street_address'] = wp_kses_post( $new_instance['street_address'] );
		$instance['phone'] = sanitize_text_field($new_instance['phone']);
		$instance['email'] = sanitize_text_field($new_instance['email']);
		$instance['website'] = sanitize_text_field($new_instance['website']);

		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$organisation_name = apply_filters( 'widget', $instance['organisation_name'] );
		$street_address = $instance['street_address'];
		$phone = apply_filters( 'widget', $instance['phone'] );
		$email = apply_filters( 'widget', $instance['email'] );
		$website = apply_filters( 'widget', $instance['website'] );

		?>



			<?php if ($title=="") $title = "Contact us"; ?>
			<?php echo $before_widget; ?>
			<?php if ( $title )
					echo $before_title . $title . $after_title; ?>


			<address class="vcard">
				<div class="address-margins">
					<?php if($organisation_name){ ?>
						<h3 class="org vcard"><a class="url fn org"><?php echo $organisation_name; ?></a></h3>
					<?php } ?>

					<p class="adr">
						<?php if ( $street_address ){ ?>
							<b><?php _e('Address:', 'benevolence-wpl'); ?></b> <span class="street-address"> <?php echo $street_address; ?></span>
						<?php } ?>

					</p>
					<?php if ( $phone ){ ?>
						<b><?php _e('Phone:', 'benevolence-wpl'); ?></b><span class="tel"> <a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo $phone; ?></a></span><br />
					<?php } ?>

					<?php if ( $email ){ ?>
						<b><?php _e('E-mail:', 'benevolence-wpl'); ?></b><span class="email"> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo $email; ?></a></span><br />
					<?php } ?>

					<?php if ( $website ){ ?>
						<b><?php _e('Website:', 'benevolence-wpl'); ?></b><span class="url"> <a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo $website; ?></a></span><br />
					<?php } ?>
				</div>
			</address>
		<?php echo $after_widget; ?>

		<?php
	}
}
?>
