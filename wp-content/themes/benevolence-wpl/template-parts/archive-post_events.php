<?php
/**
 * The default template for displaying events archive
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.0
 * @version 4.6
 */
?>

<?php get_header(); ?>
<?php
	$duration = ot_get_option( 'wpl_events_duration' );
	$duration = ( !empty( $duration ) ? intval( $duration ) : 6 );
	$pagination = ot_get_option( 'wpl_events_pagination' );
	$pagination = $pagination == 'on' ? true : false;
	$current_page = get_query_var( 'page', 1 );
	$current_page = $current_page > 0 ? $current_page : 1;
?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ml grid_9">
		<div id="content" class="site-content">
			<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>

			<?php if( !$pagination ) : ?>
				<div class="events-selection">
					<?php wpl_generate_events_monthly_buttons( 'future', $duration ); ?>
				</div>
			<?php endif; ?>

			<?php get_template_part( 'template-parts/inc', 'events-loop' ); ?>

			<?php if( $pagination ) : ?>
				<?php echo wpl_events_pagination( $current_page, $wpl_events['pages'], get_term_link( $wp_query->query['wpl_events_category'], 'wpl_events_category' ) ); ?>
			<?php endif; ?>
		</div>
	</div>

	<!-- Right Sidebar -->
	<div id="secondary" class="widget-area grid_3">
		<?php get_sidebar('events'); ?>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
