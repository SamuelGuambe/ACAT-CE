<?php
/**
 * The default template for 404 error page
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>

<?php get_header(); ?>
	<div id="main" class="site-main container_12">

		<div id="primary" class="error404">

			<div class="error-text">
				<?php _e('404', 'benevolence-wpl'); ?>
			</div>

			<p class="oops"><?php _e('Oops! The page you were looking for could not be found.', 'benevolence-wpl'); ?></p>

			<div class="go-home-box">
				<a class="go-home-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Home', 'benevolence-wpl'); ?></a>
			</div>

		</div><!-- #primary .content-area -->

	<div class="clear"></div>
	</div><!-- #main .site-main -->
<?php get_footer(); ?>
