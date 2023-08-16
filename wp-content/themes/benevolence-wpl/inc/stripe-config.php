<?php
/**
 * Stripe Settings
 *
 * @package WordPress
 * @subpackage Benevolance
 * @since Benevolance 1.1.7
 * @version 4.6
 */
/*-----------------------------------------------------------------------------------*/
/*	Return stripe keys
/*-----------------------------------------------------------------------------------*/
	if ( ! function_exists( 'wplook_stripe_key' ) ) {
		function wplook_stripe_key($key) {
			$wplook_stripe = array(
				'secret_key'      => ot_get_option('wpl_cc_secret_key'),
				'publishable_key' => ot_get_option('wpl_cc_publishable_key')
			);
			if ($key === "secret_key") {
				return $wplook_stripe['secret_key'];
			} elseif ($key === "publishable_key") {
				return $wplook_stripe['wpl_cc_publishable_key'];
			} else {
				return $wplook_stripe;
			}
		}
	}
	\Stripe\Stripe::setApiKey(wplook_stripe_key('secret_key'));
?>
