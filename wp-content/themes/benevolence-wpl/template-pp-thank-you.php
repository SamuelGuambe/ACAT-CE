<?php
/**
 * Template Name: PayPal Thank You!
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0.0
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

					include_once( get_template_directory() . '/inc/paypal/class/paypal.php' );
					include_once( get_template_directory() . '/inc/paypal/class/httprequest.php' );

					//Use this form for production server
					$r = new PayPal(true);

					//Use this form for sandbox tests
					//$r = new PayPal();

					$final = $r->doPayment();

					if ($final['ACK'] == 'Success') {
						//echo 'Succeed!';
						$oToken = $r->getCheckoutDetails($final['TOKEN']);
						$txnID = $oToken['TOKEN'];
						$firstName = $oToken['FIRSTNAME'];
						$lastName = $oToken['LASTNAME'];
						$addressCountry = $oToken['COUNTRYCODE'];
						$payerEmail = $oToken['EMAIL'];


						$bani = explode("|", $oToken['CUSTOM']);
						$payment_gross = $bani[0];
						$valuta= $bani[1];
						$donCause= $bani[2];
						$anonymous = $bani[5] == 'anonymous' ? true : false;

						$my_post = array(
							'post_title' => $txnID,
							'post_status' => 'publish',
							'post_author' => 1,
							'comment_status' => 'closed',
							'ping_status' => 'closed',
							'post_type' => 'post_pledges'
						);
						$post_id = wp_insert_post( $my_post );

						add_post_meta($post_id, "wpl_pledge_cause", $donCause);
						add_post_meta($post_id, "wpl_pledge_transaction_id", $txnID);
						add_post_meta($post_id, "wpl_pledge_first_name", $firstName);
						add_post_meta($post_id, "wpl_pledge_last_name", $lastName);
						add_post_meta($post_id, "wpl_pledge_country", $addressCountry);
						add_post_meta($post_id, "wpl_pledge_email", $payerEmail);
						add_post_meta($post_id, "wpl_pledge_donation_amount", $payment_gross);
						add_post_meta($post_id, "wpl_pledge_payment_source", 'paypal');
						add_post_meta($post_id, "wpl_pledge_payment_Status", 'Completed');
						add_post_meta($post_id, "wpl_pledge_anonymous", $anonymous ? 'on' : 'off' );

					} else {
						//print_r($final);
					}
					?>
		</div>
	</div>

	<div class="clear"></div>

</div><!-- #main .site-main -->
<?php get_footer(); ?>
