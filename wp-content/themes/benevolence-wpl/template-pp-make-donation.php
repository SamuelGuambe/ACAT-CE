<?php
/**
 * Template Name: Make a donation
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.0
 * @version 4.6
 */
$wplook_pid = get_the_ID();
?>
<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area grid_12 ml">
		<div id="content" class="site-content">
			<div class="entry-content">

			<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST') :
					$error = false;


					try {

						if (!(isset($_POST['fname']) && $_POST['fname'] != '')) throw new Exception("Add Frist Name");
						if (!(isset($_POST['lname']) && $_POST['lname'] != '')) throw new Exception("Add Last Name");
						if (!(isset($_POST['email']) && $_POST['email'] != '')) throw new Exception("Add Email");

					    if (!isset($_POST['stripeToken'])) throw new Exception("The Stripe Token was not generated correctly");

						$wplook_amount_cc = ( isset( $_POST["amount_cc"] ) && !empty( $_POST["amount_cc"] ) ) ? $_POST["amount_cc"] : false;
						$wplook_cause_id = ( isset( $_POST["causeid"] ) && !empty( $_POST["causeid"] ) ) ? $_POST["causeid"] : 0;
						$wplook_email = ( isset( $_POST["email"] ) && !empty( $_POST["email"] ) ) ? $_POST["email"] : false;
						$wplook_fname = ( isset( $_POST["fname"] ) && !empty( $_POST["fname"] ) ) ? $_POST["fname"] : false;
						$wplook_lname = ( isset( $_POST["lname"] ) && !empty( $_POST["lname"] ) ) ? $_POST["lname"] : false;
						$wplook_comments = ( isset( $_POST["comments"] ) && !empty( $_POST["comments"] ) ) ? $_POST["comments"] : false;
						$wplook_donation_frequency_meta = 'onetime';
						$wplook_donation_frequency = 'day';



						$customer = \Stripe\Customer::create(array(
							"description" => "Customer for " . get_bloginfo('name'),
							"email" => $wplook_email,
							'card' =>  $_POST['stripeToken'],
							"metadata" => array (
									"wpl_username" => 'wpl_guest',
									"wpl_first_name" => $wplook_fname,
									"wpl_last_name" =>  $wplook_lname,
									'wpl_cause_id' =>  $wplook_cause_id,
									"wpl_comments" =>  $wplook_comments,
								),
						));
						$wplook_customer_id = $customer->id;


						$first_cause_plan = get_post_meta( $wplook_cause_id, '_wpl_stripe_'.$wplook_donation_frequency.'_plan_'.$wplook_amount_cc, true );
						// Check if the plan exist, if no create it
						if (  $first_cause_plan == '' ) {
							$first_plan = \Stripe\Plan::create(array(
								"amount" => $wplook_amount_cc * 100,
								"interval" => $wplook_donation_frequency,
								"name" => get_the_title($wplook_cause_id),
								"currency" => ot_get_option('wpl_curency_code'),
								"id" => '_wpl_'.$wplook_donation_frequency.'_plan_'.$wplook_cause_id.'_'.$wplook_amount_cc
								)
							);
							add_post_meta( $wplook_cause_id, '_wpl_stripe_'.$wplook_donation_frequency.'_plan_'.$wplook_amount_cc, $first_plan->id );
							$first_cause_plan = get_post_meta( $wplook_cause_id, '_wpl_stripe_'.$wplook_donation_frequency.'_plan_'.$wplook_amount_cc, true );
					    }


					    //create new subscription if doesn't exist
						$customer_obj = \Stripe\Customer::retrieve($wplook_customer_id);
						//create subscriptions for customer object
						$customer_obj->subscriptions->create(
							array( 'plan'	=> $first_cause_plan ,
									'metadata' => array (
										'wpl_sub_frequency' => $wplook_donation_frequency_meta,
										'wpl_user_id' => 0,
										'wpl_user_name' => 'wpl_guest',
										'wpl_user_email' => $wplook_email,
										"wpl_first_name" => $wplook_fname,
										"wpl_last_name" =>  $wplook_lname,
										'wpl_cause_id' =>  $wplook_cause_id,
										"wpl_comments" =>  $wplook_comments,
								),
							)
						);

					} catch (Exception $e) {
						$error = $e->getMessage();
					} catch (\Stripe\Error\ApiConnection $e) {
						$error = $e->getMessage();
						// Network problem, perhaps try again.
					} catch (\Stripe\Error\InvalidRequest $e) {
						$error = $e->getMessage();
						// You screwed up in your programming. Shouldn't happen!
					} catch (\Stripe\Error\Api $e) {
						$error = $e->getMessage();
						// Stripe's servers are down!
					} catch (\Stripe\Error\Card $e) {
						$error = $e->getMessage();
						// Card was declined.
					}
					if (!$error) {
						printf( '<h1>%s<h1>', __( 'Thank you! Your donation was received.', 'benevolence-wpl' ) );
						//the_content();
					}
					else {
						printf( '<h1>%s<h1>', __( 'Sorry, the transaction not occurred', 'benevolence-wpl' ) );
						echo '<span class="payment-errors">'.esc_html($error).'</span>';
					}
				else :
			 ?>

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; // end of the loop. ?>

				<span class="payment-errors"></span>

				<?php if ( ot_get_option('wpl_activate_paypal') == 'on' && ot_get_option('wpl_activate_cc_payment') == 'on' ) :  ?>
					<p class="donate-payment-title"><?php _e('Please select a payment method', 'benevolence-wpl'); ?></p>
					<div class="donate-payment-type">
						<label for="paypal"  class="paypal_label">
							<input type="radio" name="payment-type" value="paypal" id="paypal" checked="checked">
							<i class="fab fa-paypal"></i><?php _e('PayPal', 'benevolence-wpl'); ?>
						</label>

						<label for="stripe"  class="stripe_label">
							<input type="radio" name="payment-type" value="stripe" id="stripe">
							<i class="fas fa-credit-card"></i><?php _e('Credit Card', 'benevolence-wpl'); ?>
						</label>
					</div>
				<?php endif; ?>



		<?php if ( ot_get_option('wpl_activate_paypal') == 'on' ) :  ?>
		<!-- PayPal -->
		<div class="donatenow donatenow-paypal">
			<form class="donatenow" action="<?php echo get_template_directory_uri() ?>/inc/paypal/buy.php" method="post">
				<label class="donate-box">
					<input name="amount" type="number" min="<?php echo ot_get_option('wpl_min_amount') ?>" placeholder="<?php _e('Custom Amount in', 'benevolence-wpl'); ?> <?php echo ot_get_option('wpl_curency_code') ?>" title="<?php _e('Custom Amount', 'benevolence-wpl'); ?>">
				</label>
				<label class="donate-boxselect">
					<select name="cause">
						<option value="0|#| <?php _e('General Donation', 'benevolence-wpl'); ?>" <?php selected( '0' ); ?>><?php _e('General Donation', 'benevolence-wpl'); ?></option>
							<?php $args = array( 'post_type' => 'post_causes','post_status' => 'publish', 'posts_per_page' => 1000, 'paged'=> $paged); ?>
							<?php $wp_query = new WP_Query( $args ); ?>
							<?php if ( $wp_query->have_posts() ) :
							$id = get_the_ID();
							while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
								<option value="<?php echo $id; ?>|#| <?php the_title(); ?>" <?php selected( '<?php the_title(); ?>' ); ?>><?php the_title(); ?></option>
							<?php endwhile; wp_reset_postdata(); ?>
							<?php endif; ?>
					</select>
				</label>
				<label class="donate-box">
					<span>
						<input class="buttonsx donate" value="<?php _e('Donate Now', 'benevolence-wpl'); ?>" type="submit"></input >
						<input type="hidden" name="submitted" id="submitted" value="true" />
					</span>
				</label>
			</form>
		</div> <!-- /PayPal -->
		<?php endif; ?>

		<?php if ( ot_get_option('wpl_activate_cc_payment') == 'on' ) :  ?>
		<!-- Credit Card -->
		<div class="donatenow donatenow-stripe donatenow-stripe-general <?php if ( ot_get_option('wpl_activate_paypal') == 'on' ) echo 'is-hidden';  ?>" >


			<form  action="<?php echo get_permalink( $wplook_pid ); ?>" method="POST" id="payment-form">


						<div class="grid_half">
							<label class="donate-box"><?php _e('First Name', 'benevolence-wpl'); ?>
								<input value="<?php echo (isset($_POST['fname']) ? $_POST['fname'] : '') ?>" name="fname" type="text" placeholder="<?php _e('First Name', 'benevolence-wpl'); ?>">
							</label>
						</div>

						<div class="grid_half">
							<label class="donate-box"><?php _e('Last Name', 'benevolence-wpl'); ?>
								<input value="<?php echo (isset($_POST['lname']) ? $_POST['lname'] : '') ?>" name="lname"  type="text" placeholder="<?php _e('Last Name', 'benevolence-wpl'); ?>">
							</label>
						</div>

						<div class="grid_full">
							<label class="donate-box"><?php _e('Email', 'benevolence-wpl'); ?>
								<input value="<?php echo (isset($_POST['email']) ? $_POST['email'] : '') ?>" name="email" type="text" placeholder="<?php _e('Email', 'benevolence-wpl'); ?>">
							</label>
						</div>
						<div class="grid_half">
							<label class="donate-box"><?php _e('Card Number', 'benevolence-wpl'); ?>
								<input type="text" placeholder="<?php _e('Card Number', 'benevolence-wpl'); ?>" data-stripe="number" class="card-cc card-number" />
							</label>
						</div>
						<div class="grid_half">
							<label class="donate-box"><?php _e('Expiration Month  (MM)', 'benevolence-wpl'); ?>
								<input type="text" placeholder="MM" data-stripe="exp-month" class="card-cc card-expiry-month" />
							</label>
						</div>
						<div class="grid_half">
						<label class="donate-box"><?php _e('Expiration Year  (YYYY)', 'benevolence-wpl'); ?>
							<input type="text" placeholder="YYYY" data-stripe="exp-year" class="card-cc card-expiry-year" />
						</label>
						</div>
						<div class="grid_half">
						<label class="donate-box"><?php _e('Card Verification Code', 'benevolence-wpl'); ?>
							<input type="text" placeholder="  <?php _e('CVC', 'benevolence-wpl'); ?>" data-stripe="cvc"  class="card-cc card-cvc" />
						</label>
						</div>
						<div class="grid_half">
						<label class="donate-box"><?php _e('Custom Amount', 'benevolence-wpl'); ?>
							<input type="text" class="field" name="amount_cc" id="field-amount" placeholder="<?php _e('Custom Amount in', 'benevolence-wpl'); ?> <?php echo ot_get_option('wpl_curency_code') ?>" >
						</label>
						</div>
						<div class="grid_half">
							<label class="donate-boxselect"><?php _e('I give a donation for:', 'benevolence-wpl'); ?>
								<select name="causeid">
								<option value="<?php echo esc_attr( $wplook_pid ); ?>" <?php selected( '<?php echo esc_attr( $wplook_pid ); ?>' ); ?>><?php _e('General Donation', 'benevolence-wpl'); ?></option>
									<?php $args = array( 'post_type' => 'post_causes', 'post_status' => 'publish', 'posts_per_page' => 1000, 'paged'=> $paged); ?>
									<?php $wp_query = new WP_Query( $args ); ?>
									<?php if ( $wp_query->have_posts() ) :
									$id = get_the_ID();
									while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
										<option value="<?php echo $id; ?>" <?php selected( '<?php the_title(); ?>' ); ?>><?php the_title(); ?></option>
									<?php endwhile; wp_reset_postdata(); ?>
									<?php endif; ?>
								</select>
							</label>
						</div>
						<div class="grid_full">
							<p class="form-actions fright">
								<input class="buttonsx donate" value="<?php _e('Donate for this cause', 'benevolence-wpl'); ?>" type="submit">
							</p>
						</div>
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
			<div class="clear"></div>
		</div><!-- /Credit Card -->
		<?php endif; ?>
	<?php endif; ?>
	</div> <!--/content-->
		</div>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
