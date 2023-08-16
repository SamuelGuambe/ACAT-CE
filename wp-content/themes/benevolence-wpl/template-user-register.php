<?php
/**
 * Template Name: User Register Page
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.1.7
 * @version 4.6
 */
	if ( is_user_logged_in() ) {
		$wplook_login_url = ot_get_option('wpl_donations_link' ) ? get_permalink( ot_get_option('wpl_donations_link' ) ) : home_url();
		return wp_redirect( $wplook_login_url  ); exit;
	}
?>

<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area grid_12 ml">
		<div id="content" class="site-content">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; // end of the loop. ?>
			<?php
				//User Register Form
				wplook_ur( $fields, $errors );
			?>
		</div>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
