<?php
/**
 * Template Name: Stripe Thank You!
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.1.7
 * @version 4.6
 */
?>

<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="content-area grid_12 ml">
		<div id="content" class="site-content">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; // end of the loop. ?>

			<?php
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$error = false;

					try {
					    if (!isset($_POST['stripeToken'])) throw new Exception("The Stripe Token was not generated correctly");

							$cu = wp_get_current_user();
						 	$wplook_donation_frequency = ( isset( $_POST["donation_frequency"] ) && !empty( $_POST["donation_frequency"] ) ) ? $_POST["donation_frequency"] : false;
							$wplook_amount_cc = ( isset( $_POST["amount_cc"] ) && !empty( $_POST["amount_cc"] ) ) ? $_POST["amount_cc"] : false;
							$wplook_cause_id = ( isset( $_POST["causeid"] ) && !empty( $_POST["causeid"] ) ) ? $_POST["causeid"] : 0;

							if ($wplook_donation_frequency == 'onetime') {
								$wplook_donation_frequency_meta = 'onetime';
								$wplook_donation_frequency = 'day';
							} else {
								$wplook_donation_frequency_meta = $wplook_donation_frequency;
							}

							//Add customers local and to stripe if not exist
							$wplook_customer = get_user_meta( $cu->ID, '_swp_stripe_customer', true);
							if( $wplook_customer == '' ) {
								$new_stripe_customer = \Stripe\Customer::create(array(
									"description" => "Customer for " . get_bloginfo('name'),
									"email" => $cu->user_email,
									'card' => $_POST['stripeToken'],
									"metadata" => array (
											"wpl_username" => $cu->user_login,
											"wpl_first_name" => get_user_meta( $cu->ID, 'first_name', true ),
											"wpl_last_name" =>  get_user_meta( $cu->ID, 'last_name', true ),
										),
								));
								//add customer ID to user meta
								add_user_meta( $cu->ID, '_swp_stripe_customer', $new_stripe_customer->id, true );
								$wplook_customer = get_user_meta( $cu->ID, '_swp_stripe_customer', true);
							}


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

							$anonymous = array_key_exists( 'anonymous-stripe', $_POST ) ? $_POST['anonymous-stripe'] : false;

						    //create new subscription if doesn't exist
							$customer_obj = \Stripe\Customer::retrieve($wplook_customer);
							//create card object
							$customer_obj->sources->create(array("source" => $_POST['stripeToken']));
							//create subscriptions for customer object
							$customer_obj->subscriptions->create(
								array( 'plan'	=> $first_cause_plan ,
										'metadata' => array (
											'wpl_sub_frequency' => $wplook_donation_frequency_meta,
											'wpl_user_id' => $cu->ID,
											'wpl_user_name' => $cu->user_login,
											'wpl_first_name' => get_user_meta( $cu->ID, 'first_name', true ),
											'wpl_last_name' =>  get_user_meta( $cu->ID, 'last_name', true ),
											'wpl_cause_id' =>  $wplook_cause_id,
											'wpl_anonymous' => $anonymous ? 'on' : 'off',
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
						the_content();
					}
					else {
						printf( '<h1>%s<h1>', __( 'Sorry, the transaction not occurred', 'benevolence-wpl' ) );
						echo esc_html($error);
					}
				}
			?>
		</div>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
