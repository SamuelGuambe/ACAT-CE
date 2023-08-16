<?php
/*
 * Widget Name: Text Enchanted
 * Author: Victor Tihai
 * @version 4.6
 * Author URI: https://wplook.com
*/

add_action('widgets_init', function(){return register_widget("wplook_text_enchanted_widget");});
class wplook_text_enchanted_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/

	public function __construct() {
		parent::__construct(
	 		'wplook_text_enchanted_widget',
	 		__('WPlook Enchanted Text', 'benevolence-wpl'), // Name
			array( 'description' => __( 'A widget for displaying Enchanted Text', 'benevolence-wpl' ), )
		);
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/

	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );

			$et_title_1 = esc_attr( $instance[ 'et_title_1' ] );
			$et_text_1 = esc_attr( $instance[ 'et_text_1' ] );
			$et_img_1 = esc_attr( $instance[ 'et_img_1' ] );
			$et_text_btn_1 = esc_attr( $instance[ 'et_text_btn_1' ] );
			$et_url_btn_1 = esc_attr( $instance[ 'et_url_btn_1' ] );

			$et_title_2 = esc_attr( $instance[ 'et_title_2' ] );
			$et_text_2 = esc_attr( $instance[ 'et_text_2' ] );
			$et_img_2 = esc_attr( $instance[ 'et_img_2' ] );
			$et_text_btn_2 = esc_attr( $instance[ 'et_text_btn_2' ] );
			$et_url_btn_2 = esc_attr( $instance[ 'et_url_btn_2' ] );

			$et_title_3 = esc_attr( $instance[ 'et_title_3' ] );
			$et_text_3 = esc_attr( $instance[ 'et_text_3' ] );
			$et_img_3 = esc_attr( $instance[ 'et_img_3' ] );
			$et_text_btn_3 = esc_attr( $instance[ 'et_text_btn_3' ] );
			$et_url_btn_3 = esc_attr( $instance[ 'et_url_btn_3' ] );

			$et_title_4 = esc_attr( $instance[ 'et_title_4' ] );
			$et_text_4 = esc_attr( $instance[ 'et_text_4' ] );
			$et_img_4 = esc_attr( $instance[ 'et_img_4' ] );
			$et_text_btn_4 = esc_attr( $instance[ 'et_text_btn_4' ] );
			$et_url_btn_4 = esc_attr( $instance[ 'et_url_btn_4' ] );

			$clear_after = esc_attr( $instance[ 'clear_after' ] );
		}
		else {
			$title = __( 'Main Widget Title', 'benevolence-wpl' );

			$et_title_1 = '';
			$et_text_1 = '';
			$et_img_1 = '';
			$et_text_btn_1 = __( 'Read more', 'benevolence-wpl' );
			$et_url_btn_1 = '';

			$et_title_2 = '';
			$et_text_2 = '';
			$et_img_2 = '';
			$et_text_btn_2 = __( 'Read more', 'benevolence-wpl' );
			$et_url_btn_2 = '';

			$et_title_3 = '';
			$et_text_3 = '';
			$et_img_3 = '';
			$et_text_btn_3 = __( 'Read more', 'benevolence-wpl' );
			$et_url_btn_3 = '';

			$et_title_4 = '';
			$et_text_4 = '';
			$et_img_4 = '';
			$et_text_btn_4 = __( 'Read more', 'benevolence-wpl' );
			$et_url_btn_4 = '';

			$clear_after = 1;
		}
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Main Title:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<!-- 1 -->
			<h3><?php _e('First column', 'benevolence-wpl'); ?></h3>
			<hr>
			<p>
				<label for="<?php echo $this->get_field_id('et_title_1'); ?>"> <?php _e('Title:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('et_title_1'); ?>" name="<?php echo $this->get_field_name('et_title_1'); ?>" type="text" value="<?php echo $et_title_1; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Column title', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_text_1'); ?>"> <?php _e('Text:', 'benevolence-wpl'); ?> </label>
				<textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('et_text_1'); ?>" name="<?php echo $this->get_field_name('et_text_1'); ?>"><?php echo $et_text_1; ?></textarea>
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Column text (30-35 keywords)', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_img_1'); ?>"> <?php _e('Image:', 'benevolence-wpl'); ?> </label>
				<input type="text" class="img" name="<?php echo esc_attr( $this->get_field_name('et_img_1') ); ?>" id="<?php echo esc_attr($this->get_field_id('et_img_1')); ?>" value="<?php echo esc_html($et_img_1 ); ?>" />
				<input type="button" class="select-img button" value="Select Image" />

			<?php if ($et_img_1) { ?>
				<img src="<?php echo esc_url($et_img_1); ?>" alt="<?php _e('This is a demo image', 'benevolence-wpl'); ?>" style="width: 100%; height: auto; margin-bottom: 20px;">
			<?php } ?>
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Image Dimensions 260 x 145px', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_text_btn_1'); ?>"> <?php _e('Button text:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('et_text_btn_1'); ?>" name="<?php echo $this->get_field_name('et_text_btn_1'); ?>" type="text" value="<?php echo $et_text_btn_1; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Text Button', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_url_btn_1'); ?>"> <?php _e('Button URL:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('et_url_btn_1'); ?>" name="<?php echo $this->get_field_name('et_url_btn_1'); ?>" type="text" value="<?php echo $et_url_btn_1; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Button URL', 'benevolence-wpl'); ?></p>
			</p>


			<!-- 2 -->
			<h3><?php _e('Second column', 'benevolence-wpl'); ?></h3>
			<hr>
			<p>
				<label for="<?php echo $this->get_field_id('et_title_2'); ?>"> <?php _e('Title:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('et_title_2'); ?>" name="<?php echo $this->get_field_name('et_title_2'); ?>" type="text" value="<?php echo $et_title_2; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Column title', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_text_2'); ?>"> <?php _e('Text:', 'benevolence-wpl'); ?> </label>
				<textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('et_text_2'); ?>" name="<?php echo $this->get_field_name('et_text_2'); ?>"><?php echo $et_text_2; ?></textarea>
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Column text (30-35 keywords)', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_img_2'); ?>"> <?php _e('Image:', 'benevolence-wpl'); ?> </label>
				<input type="text" class="img" name="<?php echo esc_attr( $this->get_field_name('et_img_2') ); ?>" id="<?php echo esc_attr($this->get_field_id('et_img_2')); ?>" value="<?php echo esc_html($et_img_2 ); ?>" />
				<input type="button" class="select-img button" value="Select Image" />

			<?php if ($et_img_2) { ?>
				<img src="<?php echo esc_url($et_img_2); ?>" alt="<?php _e('This is a demo image', 'benevolence-wpl'); ?>" style="width: 100%; height: auto; margin-bottom: 20px;">
			<?php } ?>
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Image Dimensions 260 x 145px', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_text_btn_2'); ?>"> <?php _e('Button text:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('et_text_btn_2'); ?>" name="<?php echo $this->get_field_name('et_text_btn_2'); ?>" type="text" value="<?php echo $et_text_btn_2; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Text Button', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_url_btn_2'); ?>"> <?php _e('Button URL:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('et_url_btn_2'); ?>" name="<?php echo $this->get_field_name('et_url_btn_2'); ?>" type="text" value="<?php echo $et_url_btn_2; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Button URL', 'benevolence-wpl'); ?></p>
			</p>

			<!-- 3 -->
			<h3><?php _e('Third column', 'benevolence-wpl'); ?></h3>
			<hr>
			<p>
				<label for="<?php echo $this->get_field_id('et_title_3'); ?>"> <?php _e('Title:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('et_title_3'); ?>" name="<?php echo $this->get_field_name('et_title_3'); ?>" type="text" value="<?php echo $et_title_3; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Column title', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_text_3'); ?>"> <?php _e('Text:', 'benevolence-wpl'); ?> </label>
				<textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('et_text_3'); ?>" name="<?php echo $this->get_field_name('et_text_3'); ?>"><?php echo $et_text_3; ?></textarea>
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Column text (30-35 keywords)', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_img_3'); ?>"> <?php _e('Image:', 'benevolence-wpl'); ?> </label>
				<input type="text" class="img" name="<?php echo esc_attr( $this->get_field_name('et_img_3') ); ?>" id="<?php echo esc_attr($this->get_field_id('et_img_3')); ?>" value="<?php echo esc_html($et_img_3 ); ?>" />
				<input type="button" class="select-img button" value="Select Image" />

			<?php if ($et_img_3) { ?>
				<img src="<?php echo esc_url($et_img_3); ?>" alt="<?php _e('This is a demo image', 'benevolence-wpl'); ?>" style="width: 100%; height: auto; margin-bottom: 20px;">
			<?php } ?>
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Image Dimensions 260 x 145px', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_text_btn_3'); ?>"> <?php _e('Button text:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('et_text_btn_3'); ?>" name="<?php echo $this->get_field_name('et_text_btn_3'); ?>" type="text" value="<?php echo $et_text_btn_3; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Text Button', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_url_btn_3'); ?>"> <?php _e('Button URL:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('et_url_btn_3'); ?>" name="<?php echo $this->get_field_name('et_url_btn_3'); ?>" type="text" value="<?php echo $et_url_btn_3; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Button URL', 'benevolence-wpl'); ?></p>
			</p>

			<!-- 4 -->
			<h3><?php _e('Fourth column', 'benevolence-wpl'); ?></h3>
			<hr>
			<p>
				<label for="<?php echo $this->get_field_id('et_title_4'); ?>"> <?php _e('Title:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('et_title_4'); ?>" name="<?php echo $this->get_field_name('et_title_4'); ?>" type="text" value="<?php echo $et_title_4; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Column title', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_text_4'); ?>"> <?php _e('Text:', 'benevolence-wpl'); ?> </label>
				<textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('et_text_4'); ?>" name="<?php echo $this->get_field_name('et_text_4'); ?>"><?php echo $et_text_4; ?></textarea>
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Column text (30-35 keywords)', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_img_4'); ?>"> <?php _e('Image:', 'benevolence-wpl'); ?> </label>
				<input type="text" class="img" name="<?php echo esc_attr( $this->get_field_name('et_img_4') ); ?>" id="<?php echo esc_attr($this->get_field_id('et_img_4')); ?>" value="<?php echo esc_html($et_img_4 ); ?>" />
				<input type="button" class="select-img button" value="Select Image" />

			<?php if ($et_img_4) { ?>
				<img src="<?php echo esc_url($et_img_4); ?>" alt="<?php _e('This is a demo image', 'benevolence-wpl'); ?>" style="width: 100%; height: auto; margin-bottom: 20px;">
			<?php } ?>
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Image Dimensions 260 x 145px', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_text_btn_4'); ?>"> <?php _e('Button text:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('et_text_btn_4'); ?>" name="<?php echo $this->get_field_name('et_text_btn_4'); ?>" type="text" value="<?php echo $et_text_btn_4; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Text Button', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('et_url_btn_4'); ?>"> <?php _e('Button URL:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('et_url_btn_4'); ?>" name="<?php echo $this->get_field_name('et_url_btn_4'); ?>" type="text" value="<?php echo $et_url_btn_4; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Button URL', 'benevolence-wpl'); ?></p>
			</p>


			<p>
				<label for="<?php echo $this->get_field_id('size'); ?>">
					<?php _e('Clear after?', 'benevolence-wpl'); ?>
					<br />
				</label>
				<select id="<?php echo $this->get_field_id('clear_after'); ?>" name="<?php echo $this->get_field_name('clear_after'); ?>">
					<option value="0" <?php selected( '0', $clear_after ); ?>><?php _e('Yes', 'benevolence-wpl'); ?></option>
					<option value="1" <?php selected( '1', $clear_after ); ?>><?php _e('No', 'benevolence-wpl'); ?></option>
				</select>
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Clear after if you want to add one more widgets after this widget', 'benevolence-wpl'); ?></p>

			</p>

		<?php
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);

		$instance['et_title_1'] = sanitize_text_field($new_instance['et_title_1']);
		$instance['et_text_1'] = sanitize_text_field($new_instance['et_text_1']);
		$instance['et_img_1'] = sanitize_text_field($new_instance['et_img_1']);
		$instance['et_text_btn_1'] = sanitize_text_field($new_instance['et_text_btn_1']);
		$instance['et_url_btn_1'] = sanitize_text_field($new_instance['et_url_btn_1']);

		$instance['et_title_2'] = sanitize_text_field($new_instance['et_title_2']);
		$instance['et_text_2'] = sanitize_text_field($new_instance['et_text_2']);
		$instance['et_img_2'] = sanitize_text_field($new_instance['et_img_2']);
		$instance['et_text_btn_2'] = sanitize_text_field($new_instance['et_text_btn_2']);
		$instance['et_url_btn_2'] = sanitize_text_field($new_instance['et_url_btn_2']);

		$instance['et_title_3'] = sanitize_text_field($new_instance['et_title_3']);
		$instance['et_text_3'] = sanitize_text_field($new_instance['et_text_3']);
		$instance['et_img_3'] = sanitize_text_field($new_instance['et_img_3']);
		$instance['et_text_btn_3'] = sanitize_text_field($new_instance['et_text_btn_3']);
		$instance['et_url_btn_3'] = sanitize_text_field($new_instance['et_url_btn_3']);

		$instance['et_title_4'] = sanitize_text_field($new_instance['et_title_4']);
		$instance['et_text_4'] = sanitize_text_field($new_instance['et_text_4']);
		$instance['et_img_4'] = sanitize_text_field($new_instance['et_img_4']);
		$instance['et_text_btn_4'] = sanitize_text_field($new_instance['et_text_btn_4']);
		$instance['et_url_btn_4'] = sanitize_text_field($new_instance['et_url_btn_4']);

		$instance['clear_after'] = sanitize_text_field($new_instance['clear_after']);
		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );

		$et_title_1 = isset( $instance['et_title_1'] ) ? esc_attr( $instance['et_title_1'] ) : '';
		$et_text_1 = isset( $instance['et_text_1'] ) ? esc_attr( $instance['et_text_1'] ) : '';
		$et_img_1 = isset( $instance['et_img_1'] ) ? esc_attr( $instance['et_img_1'] ) : '';
		$et_text_btn_1 = isset( $instance['et_text_btn_1'] ) ? esc_attr( $instance['et_text_btn_1'] ) : '';
		$et_url_btn_1 = isset( $instance['et_url_btn_1'] ) ? esc_attr( $instance['et_url_btn_1'] ) : '';

		$et_title_2 = isset( $instance['et_title_2'] ) ? esc_attr( $instance['et_title_2'] ) : '';
		$et_text_2 = isset( $instance['et_text_2'] ) ? esc_attr( $instance['et_text_2'] ) : '';
		$et_img_2 = isset( $instance['et_img_2'] ) ? esc_attr( $instance['et_img_2'] ) : '';
		$et_text_btn_2 = isset( $instance['et_text_btn_2'] ) ? esc_attr( $instance['et_text_btn_2'] ) : '';
		$et_url_btn_2 = isset( $instance['et_url_btn_2'] ) ? esc_attr( $instance['et_url_btn_2'] ) : '';

		$et_title_3 = isset( $instance['et_title_3'] ) ? esc_attr( $instance['et_title_3'] ) : '';
		$et_text_3 = isset( $instance['et_text_3'] ) ? esc_attr( $instance['et_text_3'] ) : '';
		$et_img_3 = isset( $instance['et_img_3'] ) ? esc_attr( $instance['et_img_3'] ) : '';
		$et_text_btn_3 = isset( $instance['et_text_btn_3'] ) ? esc_attr( $instance['et_text_btn_3'] ) : '';
		$et_url_btn_3 = isset( $instance['et_url_btn_3'] ) ? esc_attr( $instance['et_url_btn_3'] ) : '';

		$et_title_4 = isset( $instance['et_title_4'] ) ? esc_attr( $instance['et_title_4'] ) : '';
		$et_text_4 = isset( $instance['et_text_4'] ) ? esc_attr( $instance['et_text_4'] ) : '';
		$et_img_4 = isset( $instance['et_img_4'] ) ? esc_attr( $instance['et_img_4'] ) : '';
		$et_text_btn_4 = isset( $instance['et_text_btn_4'] ) ? esc_attr( $instance['et_text_btn_4'] ) : '';
		$et_url_btn_4 = isset( $instance['et_url_btn_4'] ) ? esc_attr( $instance['et_url_btn_4'] ) : '';

		$clear_after = isset( $instance['clear_after'] ) ? esc_attr( $instance['clear_after'] ) : '';
		?>

					<?php echo $before_widget; ?>
					<?php echo $before_title . $title . $after_title; ?>
					<div class="js-masonry">


						<?php if ( $et_title_1 != '' && $et_text_1 != '' ) :?>
							<!-- Article 1 -->
							<article class='item post-<?php echo esc_attr($this->id); ?>'>
								<!-- Figure / Image -->
								<?php if ( $et_img_1 != '' ) {?>
									<figure>
										<a title="<?php echo esc_attr( $et_title_1 ); ?>" href="<?php echo esc_url( $et_url_btn_1 ); ?>">
											<img src="<?php echo esc_url( $et_img_1 ); ?>" />
										</a>
									</figure>
								<?php } ?>

								<div class="box-conten-margins">
									<!-- Title -->
									<h1 class="entry-header">
										<a title="<?php echo esc_attr( $et_title_1 ); ?>" href="<?php echo esc_url( $et_url_btn_1 ); ?>"><?php echo esc_attr( $et_title_1 ); ?></a>
									</h1>

									<!-- Description -->
									<div class="short-description">
										<p><?php echo esc_html( $et_text_1 );?></p>
									</div>

									<div class="clear"></div>

									<!-- Entry meta -->
									<?php if ( $et_url_btn_1 != ''  AND $et_text_btn_1 != '' ) : ?>
										<div class="entry-meta">
											<a class="read-more-button" href="<?php echo esc_url( $et_url_btn_1 ); ?>" title="<?php echo esc_attr( $et_text_btn_1 ); ?>"><?php echo esc_attr( $et_text_btn_1 ); ?></a>
											<div class="clear"></div>
										</div>
									<?php endif; ?>

								</div>
							</article>
						<?php endif; ?>

						<?php if ( $et_title_2 != '' && $et_text_2 != '' ) :?>
							<!-- Article 2 -->
							<article class='item post-<?php echo esc_attr($this->id); ?>'>
								<!-- Figure / Image -->
								<?php if ( $et_img_2 != '' ) {?>
									<figure>
										<a title="<?php echo esc_attr( $et_title_2 ); ?>" href="<?php echo esc_url( $et_url_btn_2 ); ?>">
											<img src="<?php echo esc_url( $et_img_2 ); ?>" />
										</a>
									</figure>
								<?php } ?>

								<div class="box-conten-margins">
									<!-- Title -->
									<h1 class="entry-header">
										<a title="<?php echo esc_attr( $et_title_2 ); ?>" href="<?php echo esc_url( $et_url_btn_2 ); ?>"><?php echo esc_attr( $et_title_2 ); ?></a>
									</h1>

									<!-- Description -->
									<div class="short-description">
										<p><?php echo esc_html( $et_text_2 );?></p>
									</div>

									<div class="clear"></div>

									<!-- Entry meta -->
									<?php if ( $et_url_btn_2 != ''  AND $et_text_btn_2 != '' ) : ?>
										<div class="entry-meta">
											<a class="read-more-button" href="<?php echo esc_url( $et_url_btn_2 ); ?>" title="<?php echo esc_attr( $et_text_btn_2 ); ?>"><?php echo esc_attr( $et_text_btn_2 ); ?></a>
											<div class="clear"></div>
										</div>
									<?php endif; ?>

								</div>
							</article>
						<?php endif; ?>

						<?php if ( $et_title_3 != '' && $et_text_3 != '' ) :?>
							<!-- Article 3 -->
							<article class='item post-<?php echo esc_attr($this->id); ?>'>
								<!-- Figure / Image -->
								<?php if ( $et_img_3 != '' ) {?>
									<figure>
										<a title="<?php echo esc_attr( $et_title_3 ); ?>" href="<?php echo esc_url( $et_url_btn_3 ); ?>">
											<img src="<?php echo esc_url( $et_img_3 ); ?>" />
										</a>
									</figure>
								<?php } ?>

								<div class="box-conten-margins">
									<!-- Title -->
									<h1 class="entry-header">
										<a title="<?php echo esc_attr( $et_title_3 ); ?>" href="<?php echo esc_url( $et_url_btn_3 ); ?>"><?php echo esc_attr( $et_title_3 ); ?></a>
									</h1>

									<!-- Description -->
									<div class="short-description">
										<p><?php echo esc_html( $et_text_3 );?></p>
									</div>

									<div class="clear"></div>

									<!-- Entry meta -->
									<?php if ( $et_url_btn_3 != ''  AND $et_text_btn_3 != '' ) : ?>
										<div class="entry-meta">
											<a class="read-more-button" href="<?php echo esc_url( $et_url_btn_3 ); ?>" title="<?php echo esc_attr( $et_text_btn_3 ); ?>"><?php echo esc_attr( $et_text_btn_3 ); ?></a>
											<div class="clear"></div>
										</div>
									<?php endif; ?>

								</div>
							</article>
						<?php endif; ?>

						<?php if ( $et_title_4 != '' && $et_text_4 != '' ) :?>
							<!-- Article 4 -->
							<article class='item post-<?php echo esc_attr($this->id); ?>'>
								<!-- Figure / Image -->
								<?php if ( $et_img_4 != '' ) {?>
									<figure>
										<a title="<?php echo esc_attr( $et_title_4 ); ?>" href="<?php echo esc_url( $et_url_btn_4 ); ?>">
											<img src="<?php echo esc_url( $et_img_4 ); ?>" />
										</a>
									</figure>
								<?php } ?>

								<div class="box-conten-margins">
									<!-- Title -->
									<h1 class="entry-header">
										<a title="<?php echo esc_attr( $et_title_4 ); ?>" href="<?php echo esc_url( $et_url_btn_4 ); ?>"><?php echo esc_attr( $et_title_4 ); ?></a>
									</h1>

									<!-- Description -->
									<div class="short-description">
										<p><?php echo esc_html( $et_text_4 );?></p>
									</div>

									<div class="clear"></div>

									<!-- Entry meta -->
									<?php if ( $et_url_btn_4 != ''  AND $et_text_btn_4 != '' ) : ?>
										<div class="entry-meta">
											<a class="read-more-button" href="<?php echo esc_url( $et_url_btn_4 ); ?>" title="<?php echo esc_attr( $et_text_btn_4 ); ?>"><?php echo esc_attr( $et_text_btn_4 ); ?></a>
											<div class="clear"></div>
										</div>
									<?php endif; ?>

								</div>
							</article>
						<?php endif; ?>

					</div>
				<?php echo $after_widget; ?>
				<?php if ( $clear_after == "0" ) { ?>
					<div class="clear-widget"></div>
				<?php } ?>
		<?php
	}
}
?>
