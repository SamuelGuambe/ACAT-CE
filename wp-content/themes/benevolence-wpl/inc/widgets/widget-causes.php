<?php
/*
 * Plugin Name: Causes
 * Plugin URI: http://www.wplook.com
 * Description: Add Causes on pages
 * Author: Victor Tihai
 * @version 4.6
 * Author URI: http://www.wplook.com
*/
add_action('widgets_init', function(){return register_widget("wplook_causes_widget");});
class wplook_causes_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/

	public function __construct() {
		parent::__construct(
	 		'wplook_causes_widget',
	 		__( 'WPlook Causes', 'benevolence-wpl' ),
			array( 'description' => __( 'A widget for displaying latest causes', 'benevolence-wpl' ), )
		);
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Causes', 'benevolence-wpl' );
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
			$nr_posts = __( '4', 'benevolence-wpl' );
		}

		if ( $instance ) {
			$read_more_link = esc_attr( $instance[ 'read_more_link' ] );
		}
		else {
			$read_more_link = __( '', 'benevolence-wpl' );
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
						'taxonomy'  => 'wpl_causes_category'
					)
				); ?>

			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Causes:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of causes you want to display', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to all Causes:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('View all causes URL', 'benevolence-wpl'); ?></p>
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
		$instance['categories'] = sanitize_text_field($new_instance['categories']);
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
		$instance['read_more_link'] = sanitize_text_field($new_instance['read_more_link']);
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
		$categories = isset( $instance['categories'] ) ? esc_attr( $instance['categories'] ) : '';
		$nr_posts = isset( $instance['nr_posts'] ) ? esc_attr( $instance['nr_posts'] ) : '';
		$read_more_link = isset( $instance['read_more_link'] ) ? esc_attr( $instance['read_more_link'] ) : '';
		$clear_after = isset( $instance['clear_after'] ) ? esc_attr( $instance['clear_after'] ) : '';
		?>

		<?php

			if ( $categories < '1' ) {
				$args = array(
					'post_type' => 'post_causes',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
				);
			} else {
				$args = array(
					'post_type' => 'post_causes',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					'tax_query' => array(
						array(
							'taxonomy' => 'wpl_causes_category',
							'field' => 'id',
							'terms' => $categories
						)
					)
				);
			}

			$causes = null;
			$causes = new WP_Query( $args );
		?>

			<?php if( $causes->have_posts() ) : ?>
				<?php
					$goal_amount = get_post_meta(get_the_ID(), 'wpl_goal_amount', true);

				?>
					<?php if ($title=="") $title = "Causes"; ?>
					<?php echo $before_widget; ?>
					<?php if ( $title )
					if ( $read_more_link != '' ) {
						$view = __( 'View more', 'benevolence-wpl' );
						$url = '<span class="fright"><a href="' . $read_more_link . '">' . $view . '</a></span';
					} else {
						$url = '';
					}
					echo $before_title . $title . $url . $after_title; ?>



					<div class="js-masonry">

						<?php while ( $causes->have_posts() ) : $causes->the_post(); ?>
						<?php
							$goal_amount = get_post_meta(get_the_ID(), 'wpl_goal_amount', true);
							$pledge_donation = get_pledge_nb_total ('wpl_pledge_cause', get_the_ID() );
							$cause_status = get_post_meta( get_the_ID(), 'wpl_cause_status', true );
							$donation_box_cause = get_post_meta( get_the_ID(), 'wpl_donation_box_cause', true);
						?>
							<!-- Article -->
							<article class="item">
								<!-- Figure / Image -->
								<?php if ( has_post_thumbnail() ) {?>
									<figure>
										<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('small-thumb'); ?>
										</a>
									</figure>
								<?php } ?>

								<div class="box-conten-margins">
									<!-- Title -->
									<h1 class="entry-header">
										<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h1>

									<!-- Description -->
									<div class="short-description">
										<p><?php echo wplook_short_excerpt(ot_get_option('wpl_cause_grid_excerpt_limit'));?></p>
									</div>

									<!-- Progress Bar -->
									<?php if( !empty( $goal_amount ) ) { ?>
										<div class="small-pb">
											<div class="proggress-bar">
												<div class="dot" style="left: <?php echo formatMoney($percentage = $pledge_donation["total"] * 100 / $goal_amount, true) ?>%"></div>
												<div class="acumulated" style="width: <?php echo formatMoney($percentage = $pledge_donation["total"] * 100 / $goal_amount, true) ?>%;"></div>
											</div>
										</div>
									<?php } ?>

									<div class="clear"></div>

									<!-- Cause Details -->
									<div class="cause-details <?php echo ( empty( $goal_amount ) ? 'no-goal' : '' ) ?>">

										<!-- Raised -->
										<?php if( !empty( $goal_amount ) ) { ?>
											<div class="raised">
												<div class="desc"><?php _e('Raised', 'benevolence-wpl'); ?></div>
												<div class="value"><?php if ( $goal_amount != '0' && $goal_amount !='' ) { echo min(round($pledge_donation["total"]*100/$goal_amount, 0, PHP_ROUND_HALF_UP), 100); }?>%</div>
											</div>
										<?php } ?>

										<!-- Donors -->
										<div class="donors">
											<div class="desc"><?php _e('Donors', 'benevolence-wpl'); ?></div>
											<div class="value"><?php echo $pledge_donation["nb"]; ?></div>
										</div>

										<!-- Goal -->
										<?php if ( !empty( $goal_amount ) ) { ?>
											<div class="goal">
												<div class="desc"><?php _e('Goal', 'benevolence-wpl'); ?>/<?php echo ot_get_option('wpl_curency_code') ?></div>
												<div class="value"><?php echo formatMoney($goal_amount); ?></div>
											</div>
										<?php } ?>
										<div class="clear"></div>
									</div>

									<!-- Donate for this cause -->

									<div class="make-donation-box">
										<a class="make-donation" href="<?php the_permalink(); ?>"><?php if ( $donation_box_cause == 'off' || $cause_status == 'complete' ) { _e('Learn More', 'benevolence-wpl'); } else { _e('Make a Donation', 'benevolence-wpl'); } ?></a>
									</div>
								</div>
							</article>

						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				<?php echo $after_widget; ?>
			<?php else : ?>
				<aside><?php _e('Sorry, no causes matched your criteria.', 'benevolence-wpl'); ?></aside>
			<?php endif; ?>

			<?php if ( $clear_after =="0" ) { ?>
				<div class="clear-widget"></div>
			<?php } ?>
		<?php
	}
}
?>
