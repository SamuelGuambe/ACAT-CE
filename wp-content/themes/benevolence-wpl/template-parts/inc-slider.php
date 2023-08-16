<?php
/**
 * The default template for displaying Home page teaser
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>

<?php if ( (is_page_template('template-homepage.php')) || (is_home()) ){ ?>

	<?php $default_header_image = get_header_image(); ?>

	<?php if ( ( ot_get_option('wpl_rev_slider') == "on") && ot_get_option('wpl_slider_revolution') != '') {
		putRevSlider( ot_get_option( 'wpl_slider_revolution') );

	} elseif( $default_header_image ) { ?>

		<div class="home-teaser">
			<img src="<?php echo $default_header_image; ?>" alt="<?php the_title(); ?>">
		</div>

	<?php } else { ?>
		<?php if (ot_get_option('wpl_cpt_slider') != 'off') { ?>
			<div class="teaser">
				<div>
					<!-- Slider -->
					<div class="flexslider flexslider-teaser loading">
						<ul class="slides">

							<?php if ( ot_get_option('wpl_cpt_slider_order_by') == "menu_order") {
									$args = array( 'post_type' => 'post_sliders','post_status' => 'publish', 'posts_per_page' => 10, 'orderby' => 'menu_order', 'order' => 'ASC' );
							} else {
								$args = array( 'post_type' => 'post_sliders','post_status' => 'publish', 'posts_per_page' => 10, 'orderby' => 'date', 'order' => 'DESC'  );
							}?>

							<?php $the_query = new WP_Query( $args ); ?>
							<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<?php
									$slider_button_text = get_post_meta(get_the_ID(), 'wpl_slider_button_text', true);
									$slider_button_url = get_post_meta(get_the_ID(), 'wpl_slider_button_url', true);
									$slider_button_target = get_post_meta(get_the_ID(), 'wpl_slider_button_target', true);
								?>
								<li>
									<?php if ( has_post_thumbnail() ) {?>
										<a title="<?php the_title(); ?>" href="<?php echo $slider_button_url; ?>">
											<?php the_post_thumbnail('slider-image'); ?>
										</a>
									<?php } ?>
									<div class="flex-caption">

										<div class="flex-content container_12">
											<a class="grid_8 ml" title="<?php the_title(); ?>" href="<?php echo $slider_button_url; ?>">
												<h1 class="slider-title"><?php the_title(); ?></h1>
												<div class="slider-desc"><?php the_excerpt(); ?> </div>
											</a>
											<?php if ($slider_button_text !='' && $slider_button_url !='') { ?>
												<div class="grid_4">
													<a title="<?php echo $slider_button_text; ?>" href="<?php echo $slider_button_url ?>" class="btn round fright" <?php echo ( $slider_button_target == 'on' ? 'target="blank"' : '' ); ?>><?php echo $slider_button_text; ?></a>
												</div>
											<?php } ?>
										</div>

									</div>
								</li>
							<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							<?php else : ?>
								<li class="no-slider"></li>
							<?php endif; ?>
							<?php wp_reset_query(); ?>
						</ul>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
<?php } elseif ( is_archive() || is_search() || is_404() ) { ?>
	<!-- Display the Page header on archive page -->
	<div class="page-header">
		<div class="container_12">
			<div class="header-bg  no-headerimg">
				<div class="grid_10 ml header-title">
					<!-- Site Title -->
					<?php if( get_query_var( 'taxonomy' ) == 'wpl_events_category' ) : ?>
						<h1><?php wplook_doctitle(); ?></h1>
					<?php else : ?>
						<h1><?php single_cat_title(); ?> <?php wplook_doctitle(); ?></h1>
					<?php endif; ?>

					<!-- Rootline / Breadcrumb -->
					<?php if ( ot_get_option('wpl_breadcrumbs') != "off") { ?>
						<div id="rootline">
							<?php wplook_breadcrumbs(); ?>
						</div>
					<?php } ?>
				</div>
				<div class="grid_2 ml"></div>

				<div class="clear"></div>
			</div>
		</div>
	</div>

<?php } else { ?>
	<!-- Page header -->
	<div class="page-header">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php $header_image = get_post_meta( get_the_ID(), 'wpl_header_image', true); ?>
				<?php if ($header_image !='') { ?>

					<div class="min-img-height">
						<img src="<?php echo $header_image; ?>" alt="<?php the_title(); ?>">
					</div>

				<?php } ?>
			<?php endwhile; endif; ?>

		<div class="container_12">
			<div class="header-bg <?php if ($header_image =='') { echo "no-headerimg";} ?> ">
				<div class="grid_10 ml header-title">
					<!-- Site Title -->
					<h1>
						<?php
							$page_template = get_page_template_slug();

							if( $page_template == 'template-events-past.php' || $page_template == 'template-events-upcoming.php' ) {
								wplook_doctitle();
							} else {
								the_title();
							}
						?>
					</h1>

					<!-- Rootline / Breadcrumb -->
					<?php if ( ot_get_option('wpl_breadcrumbs') != "off") { ?>
						<div id="rootline">
							<?php wplook_breadcrumbs(); ?>
						</div>
					<?php } ?>
				</div>
				<div class="grid_2 ml"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
<?php } ?>
