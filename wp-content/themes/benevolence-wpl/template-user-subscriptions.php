<?php
/**
 * Template Name: User Subscriptions Page
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
	if (isset($_GET["customer_id"]) AND isset($_GET["subscription_id"])) {
		$wplook_customer = \Stripe\Customer::retrieve($_GET["customer_id"]);
		$wplook_customer->subscriptions->retrieve($_GET["subscription_id"])->cancel(array("at_period_end" => true ));
	}
?>

<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area grid_12 ml">
		<div id="content" class="site-content">
		<?php do_action( 'wplook_user_urls' ); ?>
						<?php

							$wplook_cu = get_current_user_id();
							$wplook_cu_customer_id = get_user_meta( $wplook_cu , '_swp_stripe_customer', true);
							$wplook_all_sub = 0;
							$wplook_subscription_error = '';
							if( $wplook_cu_customer_id != '' ) {

								try {
									$wplook_user_t = \Stripe\Customer::retrieve($wplook_cu_customer_id);

									if ($wplook_user_t->deleted) {
										throw new Exception();
									}
									$wplook_cu_subscriptions = \Stripe\Customer::retrieve($wplook_cu_customer_id)->subscriptions->all(array('limit'=>90));
									$wplook_all_sub = count($wplook_cu_subscriptions->data);
								}
								catch (\Stripe\Error\InvalidRequest $e) {
									$wplook_subscription_error = $e->getMessage();
								} catch (\Stripe\Error\Authentication $e) {
									$wplook_subscription_error = $e->getMessage();
								} catch (\Stripe\Error\ApiConnection $e) {
									$wplook_subscription_error = $e->getMessage();
								} catch (\Stripe\Error\Base $e) {
									$wplook_subscription_error = $e->getMessage();
								} catch (Exception $e) {
									$wplook_subscription_error = $e->getMessage();
								}
								if ($wplook_subscription_error) {
									echo esc_html($wplook_subscription_error);
								}

								if ($wplook_all_sub > 0 ) { ?>

									<table style="width: 100%;" class="user-pleges">
										<thead>
											<tr>
												<th><?php _e('Subscriptions ID', 'benevolence-wpl'); ?></th>
												<th><?php _e('Cause Name', 'benevolence-wpl'); ?></th>
												<th><?php _e('Amount', 'benevolence-wpl'); ?></th>
												<th><?php _e('Interval', 'benevolence-wpl'); ?></th>
												<td></td>
											</tr>
										</thead>
										<tbody>
									<?php
									for ($i=0; $i < $wplook_all_sub; $i++) {
										$cause_id = $wplook_cu_subscriptions->data[$i]->metadata->wpl_cause_id;
										if ( !$wplook_cu_subscriptions->data[$i]->cancel_at_period_end ) {
											?>
											<tr>
												<td title="<?php echo esc_attr( $wplook_cu_subscriptions->data[$i]->plan->id ); ?>"><?php echo esc_html( $wplook_cu_subscriptions->data[$i]->id ); ?></td>
												<td>
													<?php echo esc_attr( $wplook_cu_subscriptions->data[$i]->cancel_at_period_end ); ?>
													<?php echo '<a target="_blank" href="'. esc_url( get_permalink($cause_id) ).'">'.get_the_title($cause_id).'</a>'; ?>
												</td>
												<!-- <td></td> -->
												<td><?php echo '<strong>' .esc_html( $wplook_cu_subscriptions->data[$i]->plan->amount /100 ).'</strong> '; echo ot_get_option('wpl_curency_code'); ?></td>
												<td title="<?php printf( _x( 'Next Payment:', 'Next Payment: [date] at [time]', 'benevolence-wpl' ), date( get_option( 'date_format' ), $wplook_cu_subscriptions->data[$i]->current_period_end ), date( get_option( 'time_format' ), $wplook_cu_subscriptions->data[$i]->current_period_end ) ); ?>"><?php echo esc_html( ucfirst($wplook_cu_subscriptions->data[$i]->plan->interval) ); ?></td>
												<td><a title="<?php _e('Cancel a subscription', 'benevolence-wpl') ?>" href="?customer_id=<?php echo esc_attr( $wplook_cu_customer_id );?>&subscription_id=<?php echo esc_attr( $wplook_cu_subscriptions->data[$i]->id );?>"><i class="fa fa-trash-o"></i></a></td>
											</tr>

									<?php } } ?>
										</tbody>
									</table>
								<?php } else {
									_e('You dont have active subscriptions' , 'benevolence-wpl');
								}
							}
						?>

		</div>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
