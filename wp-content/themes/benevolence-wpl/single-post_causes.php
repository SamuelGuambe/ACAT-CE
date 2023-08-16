<?php
/**
 * The default template for displaying Single causes
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>
<?php get_header(); ?>
<?php
	$pid = $post->ID;
	$page_width = get_post_meta( $pid, 'wpl_sidebar_option', true);
	$wpl_cpt_video = get_post_meta( $pid, 'wpl_cpt_video', true);
	$wpl_cpt_gallery = get_post_meta( $pid, 'wpl_cpt_gallery', true);
	$goal_amount = get_post_meta( $pid, 'wpl_goal_amount', true );
	$cause_status = get_post_meta( $pid, 'wpl_cause_status', true );
	$cause_end_date = get_post_meta( $pid, 'wpl_cause_end_date', true );
	$share_buttons = get_post_meta( $pid, 'wpl_share_buttons', true);
	$donation_box_cause = get_post_meta( $pid, 'wpl_donation_box_cause', true);
	$donation_info_box = get_post_meta( $pid, 'wpl_donation_info_box', true);
	$wplook_cu = wp_get_current_user();

	$totals = wplook_get_pledges_totals( $pid );
	$donations_raised = $totals['total'];
	$donations_number = $totals['number'];
?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area ml grid_9 ?>">
		<div id="content" class="site-content">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article class="single">
						<div class="entry-content">

							<?php // Display Causes tabs
								if ( ! empty( $wpl_cpt_gallery ) || $wpl_cpt_video != '' ) { ?>

								<div class="tabs_table">
									<ul class="tabs">
										<!-- Photo -->
										<?php if ( ! empty( $wpl_cpt_gallery ) ) { ?>
											<li><a title="<?php _e( 'Photos', 'benevolence-wpl' ); ?>" rel="tab-1" class="selected"><i class="far fa-image"></i> <span><?php _e('Photo', 'benevolence-wpl'); ?></span></a></li>
										<?php } ?>

										<!-- Video -->
										<?php if ( $wpl_cpt_video != '') { ?>
											<li><a title="<?php _e( 'Videos', 'benevolence-wpl' ); ?>" rel="tab-2" class=""><i class="fab fa-youtube"></i> <span><?php _e('Video', 'benevolence-wpl'); ?></span></a></li>
										<?php } ?>
									</ul>

									<div class="panes">
										<!-- Photo -->
										<?php if ( ! empty( $wpl_cpt_gallery ) ) { ?>
											<div class="tab-content" id="tab-1">
												<div class="flexslider flexslider-gallery loading">
													<ul class="slides">
														<?php foreach( $wpl_cpt_gallery as $item ) { ?>
															<li>
																<?php echo '<img src="'.$item['wpl_cpt_image'].'" alt="'.$item['wpl_cpt_image_caption'].'" />'; ?>

																<!-- Image caption -->
																<?php if ( $item['wpl_cpt_image_caption'] != '' ) { ?>
																	<div class="gallery-caption">
																		<div class="caption-margins">
																			<?php echo $item['wpl_cpt_image_caption']; ?>
																		</div>
																	</div>
																<?php } ?>
															</li>
														<?php } ?>
													</ul>
												</div>
											</div>
										<?php } ?>

										<!-- Video -->
										<?php if ( $wpl_cpt_video != '') { ?>
											<div class="tab-content fitvid" id="tab-2">
												<?php echo wp_oembed_get( $wpl_cpt_video ); ?>
											</div>
										<?php } ?>
										<div class="clear"></div>
									</div>
								</div>

							<?php } // End causes tabs ?>

							<!-- The Content -->
							<?php the_content(); ?>
						</div>
						<div class="clear"></div>
					</article>
			<?php endwhile; endif; ?>
			<?php comments_template( '', true ); ?>
		</div>
	</div>

	<!-- Sidebr -->
	<div id="secondary" class="grid_3 widget-area" role="complementary">

		<!-- Cuase detailes -->
		<aside class="widget">
			<?php if ( $donation_box_cause != 'off' && $cause_status != 'complete' ) { ?>
				<div class="widget-title"><h3>donate now</h3><div class="clear"></div></div>
				<?php if ( ot_get_option('wpl_activate_paypal') == 'on' && ot_get_option('wpl_activate_cc_payment') == 'on' ) :  ?>
					<p class="donate-payment-title"><?php _e('Please select a payment method', 'benevolence-wpl'); ?></p>
					<div class="donate-payment-type">
						<label for="paypal" class="paypal_label">
							<input type="radio" name="payment-type" value="paypal" id="paypal" checked="checked">
							<i class="fab fa-paypal"></i><?php _e('PayPal', 'benevolence-wpl'); ?>
						</label>

						<label for="stripe" class="stripe_label">
							<input type="radio" name="payment-type" value="stripe" id="stripe">
							<i class="fas fa-credit-card"></i><?php _e('Credit Card', 'benevolence-wpl'); ?>
						</label>
					</div>
				<?php endif; ?>

				<?php if ( ot_get_option('wpl_activate_paypal') == 'on' ) :  ?>
				<!-- PayPal -->
				<div class="donatenow donatenow-paypal">
				<form class="" action="<?php echo get_template_directory_uri() ?>/inc/paypal/buy.php" method="post">
					<label class="donate-box">
						<input name="amount" type="number" min="<?php echo ot_get_option('wpl_min_amount') ?>" placeholder="<?php printf( _x( 'Custom Amount in %s', 'Custom Amount in [currency code like USD]', 'benevolence-wpl' ), ot_get_option( 'wpl_curency_code' ) ); ?>" title="<?php _e('Custom Amount', 'benevolence-wpl'); ?>">
					</label>
					<label class="donate-boxselect" style="margin:0;">
						<input name="cause" type="hidden" value="<?php echo get_the_ID(); ?>|#| <?php the_title(); ?>">
					</label>

					<p class="donate-payment-title">
						<label class="donate-payment-title donate-anonymous" for="anonymous-pp">
							<input class="" id="anonymous-pp" name="anonymous-pp" type="checkbox" value="1">
							<?php _e('Hide my name from donation list', 'benevolence-wpl'); ?>
						</label>
					</p>

					<label class="donate-box">
						<p>
							<input class="make-donation" value="<?php _e('Donate for this cause', 'benevolence-wpl'); ?>" type="submit"></input>
							<input type="hidden" name="submitted" id="submitted" value="true" />
						</p>
					</label>
				</form>
				</div>
				<?php endif; ?>

				<?php if ( ot_get_option('wpl_activate_cc_payment') == 'on' ) :  ?>
					<!-- Credit Card -->
					<div class="donatenow donatenow-stripe <?php if ( ot_get_option('wpl_activate_paypal') == 'on' ) echo 'is-hidden';  ?>" >
						<span class="payment-errors"></span>
						<?php if(is_user_logged_in()) : ?>

						<form action="<?php echo get_permalink( ot_get_option('wpl_stripe_process_page') ); ?>" method="POST" id="payment-form">
									<div>
									<p class="donate-payment-title">

											<?php _e('Donation Frequency', 'benevolence-wpl'); ?>

									</p>
										<label for="onetime">
											<input type="radio" name="donation_frequency" value="onetime" id="onetime" checked="checked">
											<?php _e('One Time', 'benevolence-wpl'); ?>
										</label>
										<label for="week">
											<input type="radio" name="donation_frequency" value="week" id="week">
											<?php _e('Weekly', 'benevolence-wpl'); ?>
										</label>
										<label for="month">
											<input type="radio" name="donation_frequency" value="month" id="month">
											<?php _e('Monthly', 'benevolence-wpl'); ?>
										</label>
									</div>
									<label class="donate-box"><?php _e('Card Number', 'benevolence-wpl'); ?>
										<input type="text" placeholder="<?php _e('Card Number', 'benevolence-wpl'); ?>" data-stripe="number" class="card-cc card-number" />
									</label>

									<label class="donate-box"><?php _e('Expiration Month  (MM)', 'benevolence-wpl'); ?>
										<input type="text" placeholder="MM" data-stripe="exp-month" class="card-cc card-expiry-month" />
									</label>

									<label class="donate-box"><?php _e('Expiration Year  (YYYY)', 'benevolence-wpl'); ?>
										<input type="text" placeholder="YYYY" data-stripe="exp-year" class="card-cc card-expiry-year" />
									</label>

									<label class="donate-box"><?php _e('Card Verification Code', 'benevolence-wpl'); ?>
										<input type="text" placeholder="  <?php _e('CVC', 'benevolence-wpl'); ?>" data-stripe="cvc"  class="card-cc card-cvc" />
									</label>

									<label class="donate-box">
										<input type="number" class="field" name="amount_cc" id="field-amount" min="<?php echo ot_get_option('wpl_min_amount') ?>" placeholder="<?php _e('Custom Amount in', 'benevolence-wpl'); ?> <?php echo ot_get_option('wpl_curency_code') ?>" title="<?php _e('Custom Amount', 'benevolence-wpl'); ?>">
									</label>

									<p class="donate-payment-title">
										<label class="donate-payment-title donate-anonymous" for="anonymous-stripe">
										<input class="" id="anonymous-stripe" name="anonymous-stripe" type="checkbox" value="1">
										<?php _e('Hide my name from donation list', 'benevolence-wpl'); ?>
										</label>
									</p>

									<p class="form-actions">
										<input class="causeid" type="hidden" name="causeid" value="<?php echo get_the_ID(); ?>">
										<input class="userid" type="hidden" name="userid" value="<?php echo esc_attr( $wplook_cu->ID ); ?>">
										<input class="make-donation" value="<?php _e('Donate for this cause', 'benevolence-wpl'); ?>" type="submit">
									</p>
						</form>
						<script type="text/javascript">
							// this identifies your website in the createToken call below
							jQuery(document).ready(function() {
								Stripe.setPublishableKey('<?php echo ot_get_option('wpl_cc_publishable_key'); ?>');
							});
							function stripeResponseHandler(status, response) {
								if (response.error) {
									// re-enable the submit button
									jQuery('.button').removeAttr("disabled");
									// show the errors on the form
									jQuery(".payment-errors").html(response.error.message);
								} else {
									var form$ = jQuery("#payment-form");
									// token contains id, last4, and card type
									var token = response['id'];
									// insert the token into the form so it gets submitted to the server
									form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
									    // and submit
									form$.get(0).submit();
								}
							}
							jQuery(document).ready(function() {
								jQuery("#payment-form").submit(function(event) {
									// disable the submit button to prevent repeated clicks
									jQuery('.button').attr("disabled", "disabled");
									// createToken returns immediately - the supplied callback submits the form if there are no errors
									Stripe.createToken({
										number: jQuery('.card-number').val(),
										cvc: jQuery('.card-cvc').val(),
										exp_month: jQuery('.card-expiry-month').val(),
										exp_year: jQuery('.card-expiry-year').val(),
										metadata: {_wpl_user_id: jQuery('.userid').val(), _wpl_cause_id: jQuery('.causeid').val()}
									}, stripeResponseHandler);
									return false; // submit from callback
								});
							});
						</script>
						<?php else : ?>
							<div class="login_register">
								<p class="donate-payment-title donate-payment-subtitle">
									<?php _e('In order to be able to donate with a Credit Card you need to have an account.', 'benevolence-wpl'); ?>
								</p>
								<div class="donate-box">

										<?php wp_login_form(); ?>
								</div>

								<p class="register-url">
									<?php printf( __( '%2$s or create your free account now %3$s', 'benevolence-wpl' ),
												'<a href="'. esc_url( get_permalink( ot_get_option('wpl_login_link' ) ) ).'">',
												'<a href="'. esc_url( get_permalink( ot_get_option('wpl_register_link' ) ) ).'">',
												'</a>' ); ?>
								</p>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			<?php } ?>
		<div class="clear"></div>

			<?php if ($donation_info_box != 'off') { ?>

				<div class="info-box">
					<?php // Cause Status ?>
					<?php if ( $cause_status == 'active' || $cause_status == 'complete' ) { ?>

						<div class="info-row"><?php _e('Cause Status', 'benevolence-wpl'); ?><span class="fright"><?php if ( $cause_status == 'active') { _e('Active', 'benevolence-wpl'); } else {_e('Complete', 'benevolence-wpl');} ?></span></div>
					<?php } ?>

					<?php // Progress Bar info ?>
					<div class="info-row">
						<?php if( !empty( $goal_amount ) ) { ?>
							<span class="fleft"><?php if ( $goal_amount != '0' && $goal_amount !='' ) { echo formatMoney($percentage = $donations_raised * 100 / $goal_amount, true); } else { echo "0"; } ?>%</span>
						<?php } else { ?>
							<?php _e( 'Total raised', 'benevolence-wpl' ); ?>
						<?php } ?>
						<span class="fright"><?php echo $donations_raised; ?> <?php echo ot_get_option('wpl_curency_code') ?></span>
						<div class="clear"></div>
					</div>

					<?php // Progress Bar ?>
					<?php if( !empty( $goal_amount ) ) { ?>
						<div class="small-pb">
							<div class="proggress-bar">
								<div class="dot" style="left: <?php echo formatMoney($percentage = $donations_raised * 100 / $goal_amount, true) ?>%"></div>
								<div class="acumulated" style="width: <?php echo formatMoney($percentage = $donations_raised * 100 / $goal_amount, true) ?>%;"></div>
							</div>
						</div>
					<?php } ?>

					<?php // Goal Amount ?>
					<?php if ( !empty( $goal_amount ) ) { ?>
						<div class="info-row"><?php _e('Project Goal', 'benevolence-wpl'); ?><span class="fright"><?php echo formatMoney($goal_amount); ?> <?php echo ot_get_option('wpl_curency_code') ?></span></div>
					<?php } ?>

					<?php // End date ?>
					<?php if ( $cause_end_date != '' ) { ?>
						<div class="info-row"><?php _e('End date', 'benevolence-wpl'); ?><span class="fright"><?php echo date_i18n( get_option('date_format'), strtotime($cause_end_date) ); ?></span></div>
					<?php } ?>

					<?php // Number of Funders/donors ?>
					<div class="info-row"><?php _e('Funders', 'benevolence-wpl'); ?><span class="fright"><?php echo $donations_number; ?></span></div>
					<?php // Share Buttons ?>
					<?php if ( $share_buttons !='off' ) { ?>
						<div class="info-row"><?php _e('Share', 'benevolence-wpl'); ?>
							<span class="fright share-btns">
								<?php wplook_get_share_buttons(); ?>
							</span>
						</div>
					<?php } ?>

				</div>
			<?php } ?>
		</aside> <!-- .widget cause detailes -->

		<!-- Include Sidebar -->
		<?php get_sidebar('causes'); ?>

	</div><!-- #secondary -->
	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
