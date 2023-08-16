<?php
/**
 * Template Name: Home page
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.0
 * @version 4.6
 */
?>

<?php get_header(); ?>
<div id="main" class="site-main container_12">

	<?php // Display the default content
	if ( $post->post_content != '' ) { ?>
		<div id="primary" class="content-area ml grid_12">
			<div id="content" class="site-content">
					<?php while ( have_posts() ) : the_post(); ?>
						<article class="single">
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
							<div class="clear"></div>
						</article>
					<?php endwhile;
				 // End displaying the default content ?>
				<div class="clear"></div>
			</div>
		</div>
	<?php } ?>

	<?php if (is_active_sidebar( 'front-1' ) || is_active_sidebar( 'front-2' ) || is_active_sidebar( 'front-3' ) || is_active_sidebar( 'front-4' ) || is_active_sidebar( 'front-5' ) || is_active_sidebar( 'front-6' ) ) { ?>
		<div class="homepage-widget-area">
			<?php if ( is_active_sidebar( 'front-1' ) ) : ?>
				<!-- First Widget Area -->
				<div class="<?php echo ot_get_option('wpl_first_front_widget_size') ?> first-home-widget-area">
					<?php ! dynamic_sidebar( 'front-1' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'front-2' ) ) : ?>
				<!-- Second Widget Area -->
				<div class="<?php echo ot_get_option('wpl_second_front_widget_size') ?> second-home-widget-area">
					<?php dynamic_sidebar( 'front-2' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'front-3' ) ) : ?>
				<!-- Third Widget Area -->
				<div class="<?php echo ot_get_option('wpl_third_front_widget_size') ?> third-home-widget-area">
					<?php dynamic_sidebar( 'front-3' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'front-4' ) ) : ?>
				<!-- Forth Widget Area -->
				<div class="<?php echo ot_get_option('wpl_forth_front_widget_size') ?> forth-home-widget-area">
					<?php dynamic_sidebar( 'front-4' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'front-5' ) ) : ?>
				<!-- Fifth Widget Area -->
				<div class="<?php echo ot_get_option('wpl_fifth_front_widget_size') ?> fifth-home-widget-area">
					<?php dynamic_sidebar( 'front-5' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'front-6' ) ) : ?>
				<!-- Fifth Widget Area -->
				<div class="<?php echo ot_get_option('wpl_sixth_front_widget_size') ?> fifth-home-widget-area">
					<?php dynamic_sidebar( 'front-6' ); ?>
				</div>
			<?php endif; ?>

		</div>
	<?php }	?>


	<div class="clear"></div>
</div><!-- #main .site-main -->
<?php if (ot_get_option('wpl_cpt_sponsors') != 'off') {
	get_template_part( 'template-parts/inc', 'sponsors' );
}
?>


<?php get_footer(); ?>
