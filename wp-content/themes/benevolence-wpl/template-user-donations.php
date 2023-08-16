<?php
/**
 * Template Name: User Donations Page
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.1.7
 * @version 4.6
 */
	if ( !is_user_logged_in() ) {
		$wplook_login_url = ot_get_option('wpl_login_link' ) ? get_permalink( ot_get_option('wpl_login_link' ) ) : home_url();
		return wp_redirect( $wplook_login_url  ); exit;
	}
?>

<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area grid_12 ml">
		<div id="content" class="site-content">
		<?php do_action( 'wplook_user_urls' ); ?>

						<?php
							$args = array(
							 'post_type' => 'post_pledges',
							 'post_status' => 'publish',
							 'posts_per_page' => ot_get_option('wpl_docs_per_page'),
							 'paged'=> $paged,
							 'author' => get_current_user_id(),
							 );

							$wp_query = new WP_Query( $args );
							//var_dump($wp_query );


							if ( $wp_query->post_count > 0 ) { ?>
								<table style="width: 100%;" class="user-pleges">
									<thead>
										<tr>
											<th><?php _e('Transaction ID', 'benevolence-wpl'); ?></th>
											<th><?php _e('Cause Name', 'benevolence-wpl'); ?></th>
											<!-- <th><?php _e('Date', 'benevolence-wpl'); ?></th> -->
											<th><?php _e('Amount', 'benevolence-wpl'); ?></th>
											<th><?php _e('Source', 'benevolence-wpl'); ?></th>
											<th><?php _e('Status', 'benevolence-wpl'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
											$wplook_pid = $post->ID;
											$wplook_pledges_meta = get_post_meta($wplook_pid);
											$wplook_pledge_cause_id 	=  isset($wplook_pledges_meta['wpl_pledge_cause'][0]) ? $wplook_pledges_meta['wpl_pledge_cause'][0] : false;
											$wplook_pledge_payment_Status 	=  isset($wplook_pledges_meta['wpl_pledge_payment_Status'][0]) ? $wplook_pledges_meta['wpl_pledge_payment_Status'][0] : false;
											$wplook_pledge_payment_source 	=  isset($wplook_pledges_meta['wpl_pledge_payment_source'][0]) ? $wplook_pledges_meta['wpl_pledge_payment_source'][0] : false;
											$wplook_pledge_donation_amount 	=  isset($wplook_pledges_meta['wpl_pledge_donation_amount'][0]) ? $wplook_pledges_meta['wpl_pledge_donation_amount'][0] : false;
											if ($wplook_pledge_payment_source == 'bank_transfer') {
												$wplook_pledge_payment_source = __('Bank Transfer', 'benevolence-wpl');
											} elseif ($wplook_pledge_payment_source == 'check_cash') {
												$wplook_pledge_payment_source = __('Check or Cash', 'benevolence-wpl');
											}
									?>
										<tr>
											<td><?php the_title(); ?></td>
											<td>
												<?php echo '<a target="_blank" href="'. esc_url( get_permalink($wplook_pledge_cause_id) ).'">'.get_the_title($wplook_pledge_cause_id).'</a><br>'; ?>
												<i class="subheader"><?php printf( _x( '%1$s at %2$s', '[date] at [time]', 'benevolence-wpl' ), get_the_date(), get_the_time() ); ?></i>
											</td>
											<!-- <td></td> -->
											<td><?php echo '<strong>' .esc_html( $wplook_pledge_donation_amount ).'</strong> '; echo ot_get_option('wpl_curency_code') ?></td>
											<td><?php echo esc_html( ucfirst($wplook_pledge_payment_source) ); ?></td>
											<td><?php echo esc_html( ucfirst($wplook_pledge_payment_Status) ); ?></td>
										</tr>

										<?php endwhile; ?>
										<?php endif; ?>
										<?php wp_reset_postdata(); ?>
									</tbody>
								</table>
								<?php wplook_content_navigation('postnav' ); ?>
							<?php } else {
								_e('No transaction!' , 'benevolence-wpl');
							}
						?>

		</div>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
