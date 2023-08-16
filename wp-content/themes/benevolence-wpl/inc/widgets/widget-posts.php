<?php
/*
 * Plugin Name: Posts
 * Plugin URI: http://www.wplook.com
 * Description: Add Posts on pages
 * Author: Victor Tihai
 * @version 4.6
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', function(){return register_widget("wplook_posts_widget");});
class wplook_posts_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/

	public function __construct() {
		parent::__construct(
	 		'wplook_posts_widget',
	 		__( 'WPlook Posts', 'benevolence-wpl' ),
			array( 'description' => __( 'A widget for displaying latest Posts', 'benevolence-wpl' ), )
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
			$title = __( 'Posts', 'benevolence-wpl' );
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

		if ( $instance && array_key_exists( 'read_more_link', $instance ) ) {
			$read_more_link = esc_attr( $instance[ 'read_more_link' ] );
		}
		else {
			$read_more_link = __( '', 'benevolence-wpl' );
		}

		if ( $instance && array_key_exists( 'display_comments', $instance ) ) {
			$display_comments = esc_attr( $instance[ 'display_comments' ] );
		}
		else {
			$display_comments = __( '', 'benevolence-wpl' );
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
						'taxonomy'  => 'category'
					)
				); ?>

			</p>

			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Posts:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of posts you want to display', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to all Posts:', 'benevolence-wpl'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('View all Posts URL', 'benevolence-wpl'); ?></p>
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked( $display_comments, 'on' ); ?> id="<?php echo $this->get_field_id( 'display_comments' ); ?>" name="<?php echo $this->get_field_name( 'display_comments' ); ?>" />
				<label for="<?php echo $this->get_field_id('display_comments'); ?>"><?php _e('Display comment count', 'benevolence-wpl'); ?></label>
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
		$instance['display_comments'] = sanitize_text_field($new_instance['display_comments']);
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
		$display_comments = isset( $instance['display_comments'] ) ? $instance['display_comments'] : 'on';
		$display_comments = $display_comments ? 'on' : 'off';

			if ( $categories < '1' ) {
				$args = array(
					'ignore_sticky_posts'=> 1,
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
				);
			} else {
				$args = array(
					'ignore_sticky_posts'=> 1,
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					'cat' => $categories
				);
			}

			$posts = null;
			$posts = new WP_Query( $args );
		?>

			<?php if( $posts->have_posts() ) : ?>

				<!-- Latest Posts -->
				<?php if ($title=="") $title = "Latest posts"; ?>
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

							<!-- Article -->
							<article id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
								<!-- Figure / Image -->
								<?php if ( has_post_thumbnail() ) {?>
									<figure>
										<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('small-thumb'); ?>
										</a>
										<div class="widget-date">
											<time class="entry-times" datetime="<?php echo get_the_date( 'c' ) ?>"><i class="far fa-clock"></i> <?php wplook_get_date(); ?></time>
											<?php if( $display_comments == 'on' ) : ?>
												<span class="entry-nrcomments"><i class="far fa-comment"></i><?php comments_number( '0', '1', '%' ); ?></span>
											<?php endif; ?>
											<div class="clear"></div>
										</div>
									</figure>
								<?php } ?>

								<div class="box-conten-margins">
									<!-- Title -->
									<h1 class="entry-header">
										<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h1>

									<!-- Description -->
									<div class="short-description">
										<p><?php echo wplook_short_excerpt(ot_get_option('wpl_blog_grid_excerpt_limit'));?></p>
									</div>



									<div class="clear"></div>

									<!-- Entry meta -->
									<div class="entry-meta">
										<a class="read-more-button" href="<?php the_permalink(); ?>" title="<?php _e('Read more', 'benevolence-wpl'); ?>"><?php _e('Read more', 'benevolence-wpl'); ?></a>
										<div class="clear"></div>
									</div>
								</div>
							</article>

						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				<?php echo $after_widget; ?>
				<div class="clear"></div>
			<?php endif; ?>
		<?php
	}
}
?>
