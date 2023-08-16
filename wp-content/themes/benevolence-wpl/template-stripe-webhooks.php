<?php
/**
 * Template Name: Webhooks for Stripe Page
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.1.7
 * @version 4.6
 */
?>
<?php
	$wplook_request = @file_get_contents("php://input");
	$wplook_event_json = json_decode($wplook_request);

	// $wplook_request = wp_remote_get('php://input');
	// $wplook_response = wp_remote_retrieve_body( $wplook_request );
	// $wplook_event_json = json_decode($wplook_response);

	//Open the file to get existing content
	//$objData = serialize( $body);
	// $file = get_template_directory().'/test.html';
	// $wplook_current = F__file_get_contents($file);

	if ($wplook_event_json->type == 'customer.subscription.created') {
		$wplook_cu = \Stripe\Customer::retrieve($wplook_event_json->data->object->customer);
		if ($wplook_event_json->data->object->metadata->wpl_sub_frequency == 'onetime') {
			$wplook_cu->subscriptions->retrieve($wplook_event_json->data->object->id)->cancel(array("at_period_end" => true ));
		}
		// Append a new person to the file
		// $wplook_current = "<pre>\n";
		// $wplook_current .= $wplook_event_json->data->object->metadata->wpl_sub_frequency;
		// $wplook_current .= "<hr>\n";
		// $wplook_current .= $objData;
		// $wplook_current .= "</pre><hr>\n";
	}

if ($wplook_event_json->type == 'charge.succeeded' ) {

	$wplook_charge = \Stripe\Charge::retrieve($wplook_event_json->data->object->id);
	$wplook_invoice = \Stripe\Invoice::retrieve($wplook_event_json->data->object->invoice);

	$wplook_charge_id = $wplook_event_json->data->object->id;
	$wplook_status = $wplook_charge->status;
	$wplook_customer = $wplook_invoice->customer;
	$wplook_total = $wplook_invoice->total/100;
	$wplook_subscription = $wplook_invoice->subscription;
	$wplook_user_id = $wplook_invoice->lines->data[0]->metadata->wpl_user_id;
	if ($wplook_user_id == '0') {
		$wplook_user_email = $wplook_invoice->lines->data[0]->metadata->wpl_user_email;
	} else {
		$wplook_get_user = get_user_by( 'id', $wplook_user_id );
		$wplook_user_email = $wplook_get_user->user_email;
	}
	$wplook_user_name = $wplook_invoice->lines->data[0]->metadata->wpl_user_name;
	$wplook_first_name = $wplook_invoice->lines->data[0]->metadata->wpl_first_name;
	$wplook_last_name = $wplook_invoice->lines->data[0]->metadata->wpl_last_name;
	$wplook_cause_id = $wplook_invoice->lines->data[0]->metadata->wpl_cause_id;

	//create new post pledges
	$wplook_my_post = array(
		'post_title'    => $wplook_event_json->data->object->id,
		'post_status'   => 'publish',
		'post_author'   => $wplook_user_id,
		'comment_status' => 'closed',
		'ping_status' => 'closed',
		'post_type'      => 'post_pledges'
	);
	$wplook_post_id = wp_insert_post( $wplook_my_post );
	add_post_meta($wplook_post_id, "wpl_pledge_cause", $wplook_cause_id);
	add_post_meta($wplook_post_id, "wpl_pledge_transaction_id", $wplook_event_json->data->object->id);
	add_post_meta($wplook_post_id, "wpl_pledge_first_name", $wplook_first_name);
	add_post_meta($wplook_post_id, "wpl_pledge_last_name", $wplook_last_name);
	add_post_meta($wplook_post_id, "wpl_pledge_email", $wplook_user_email);
	add_post_meta($wplook_post_id, "wpl_pledge_customer", $wplook_customer);
	add_post_meta($wplook_post_id, "wpl_pledge_donation_amount", $wplook_total);
	add_post_meta($wplook_post_id, "wpl_pledge_payment_source", 'Stripe');
	add_post_meta($wplook_post_id, "wpl_pledge_payment_Status", 'Completed');

	$wplook_email_var = array();
	$wplook_email_var['wpl_first_name'] = $wplook_first_name;
	$wplook_email_var['wpl_last_name'] = $wplook_last_name;
	$wplook_email_var['wpl_total'] = $wplook_total;
	$wplook_email_var['wpl_curency_code'] = ot_get_option('wpl_curency_code');
	if ($wplook_cause_id == '0') {
		$wplook_email_var['wpl_url_cause'] = get_site_url();
		$wplook_email_var['wpl_title_cause'] = __('General Donation', 'benevolence-wpl');
	} else {
		$wplook_email_var['wpl_url_cause'] = get_permalink($wplook_cause_id);
		$wplook_email_var['wpl_title_cause'] = get_the_title($wplook_cause_id);
	}
	$wplook_email_var['wpl_customer'] = $wplook_customer;
	$wplook_email_var['wpl_charge_id'] = $wplook_charge_id;
	$wplook_email_var['wpl_blog_name'] = get_bloginfo('name');

	$wplook_user_subject = ot_get_option('wpl_email_title_to_user');
	$wplook_user_template = ot_get_option('wpl_email_message_to_user');

	$wplook_admin_subject = ot_get_option('wpl_email_title_to_admin');
	$wplook_admin_template = ot_get_option('wpl_email_message_to_admin');

	foreach($wplook_email_var as $key => $value) {
		$wplook_user_template = str_replace('{{ '.$key.' }}', $value, $wplook_user_template);
		$wplook_admin_template = str_replace('{{ '.$key.' }}', $value, $wplook_admin_template);
	}


	//send mail to user
	$wplook_to = $wplook_user_email;
	$wplook_headers = array('Content-Type: text/html; charset=UTF-8');
	$wplook_headers[] = 'From:'. get_bloginfo('admin_email');
	wp_mail( $wplook_to, $wplook_user_subject, $wplook_user_template, $wplook_headers );


	//send mail to admin
	$wplook_to_admin = get_bloginfo('admin_email');
	$wplook_headers_admin = array('Content-Type: text/html; charset=UTF-8');
	$wplook_headers_admin[] = 'From:'. get_bloginfo('admin_email');

	wp_mail( $wplook_to_admin, $subject_admin, $wplook_admin_template, $wplook_headers_admin );
}
	// for test only
	//file_put_contents($file, $wplook_current);
?>
