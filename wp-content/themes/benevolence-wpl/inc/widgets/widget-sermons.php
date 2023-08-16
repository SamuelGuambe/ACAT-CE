<?php
/*
 * Plugin Name: Posts
 * Plugin URI: http://www.wplook.com
 * Description: Add Posts on pages
 * Author: Victor Tihai
 * @version 4.6
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', function(){return register_widget("wplook_sermons_widget");});
class wplook_sermons_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/

	public function __construct() {
		parent::__construct(
	 		'wplook_sermons_widget',
	 		__( 'WPlook Sermons', 'benevolence-wpl' ),
			array( 'description' => __( 'A widget for displaying Sermons', 'benevolence-wpl' ), )
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
			$title = __( 'Sermons', 'benevolence-wpl' );
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
						'taxonomy'  => 'wpl_sermons_category'
					)
				); ?>

			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Sermons:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of Sermons you want to display', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to all Sermons:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('View all Sermons URL', 'benevolence-wpl'); ?></p>
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
					'ignore_sticky_posts'=> 1,
					'post_type' => 'post_sermons',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
				);
			} else {
				$args = array(
					'ignore_sticky_posts'=> 1,
					'post_type' => 'post_sermons',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					'tax_query' => array(
						array(
							'taxonomy' => 'wpl_sermons_category',
							'field' => 'id',
							'terms' => $categories
						),
					),
				);
			}

			$posts = null;
			$posts = new WP_Query( $args );
		?>

			<?php if( $posts->have_posts() ) : ?>

				<?php if ($title=="") $title = "Sermons"; ?>
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

						<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
							<?php
								$pid = $post->ID;
								$wpl_cpt_documents = get_post_meta( $pid, 'wpl_cpt_documents', true);
								$wpl_cpt_video = get_post_meta( $pid, 'wpl_cpt_video', true);
								$wpl_cpt_audio = get_post_meta( $pid, 'wpl_cpt_audio', true);
								$video_sermons = get_post_meta( $pid, 'wpl_cpt_video_sermons', true);
							?>
							<!-- Article -->
							<article id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
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
										<p><?php echo wplook_short_excerpt(ot_get_option('wpl_sermon_grid_excerpt_limit'));?></p>
									</div>

									<div class="clear"></div>

									<!-- Entry meta -->
									<div class="entry-meta accent-widget-detailes">
										<div class="sermons-icons">
											<!-- Video -->
											<?php if ( $wpl_cpt_video != '' || ! empty( $video_sermons ) ) { ?>
												<div class="scol25">
													<a href="<?php the_permalink(); ?>">
														<span class="youtube"><i class="fab fa-youtube"></i></span>
													</a>
												</div>
											<?php } ?>

											<!-- Audio -->
											<?php if ( ! empty ($wpl_cpt_audio ) ) { ?>
												<div class="scol25">
													<a href="<?php the_permalink(); ?>">
														<span class="music"><i class="fas fa-headphones-alt"></i></span>
													</a>
												</div>
											<?php } ?>

											<!-- Documents -->
											<?php if ( ! empty( $wpl_cpt_documents ) ) { ?>
												<div class="scol25">
													<a href="<?php the_permalink(); ?>">
														<span class="file"><i class="far fa-file-alt"></i></span>
													</a>
												</div>
											<?php } ?>

											<!-- Read more -->
											<div class="scol25">
												<a href="<?php the_permalink(); ?>">
													<span class="readmore"><i class="fas fa-ellipsis-h"></i></span>
												</a>
											</div>

											<div class="clear"></div>
										</div>
										<div class="clear"></div>
									</div>

								</div>
							</article>

						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				<?php echo $after_widget; ?>
				<?php if ( $clear_after =="0" ) { ?>
					<div class="clear-widget"></div>
				<?php } ?>
			<?php endif; ?>
		<?php
	}
}
?>
