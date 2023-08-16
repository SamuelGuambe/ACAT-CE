<?php
/**
 *  User Register function and user menu
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.1.7
 * @version 4.6
 */

?>
<?php
function wplook_ur(&$fields, &$errors) {

	// Check args and replace if necessary
	if ( !is_array( $fields ) ) {
		$fields = array();
	}

	if ( !is_wp_error( $errors ) ) {
		$errors = new WP_Error;
	}

	// Check for form submit
	if ( isset( $_POST['submit'] ) ) {
		// Get fields from submitted form
		$fields = wplook_ur_get_fields();
		// Validate fields and produce errors
		if ( wplook_ur_validate( $fields, $errors ) ) {
			// If successful, register user
			$user_id = wp_insert_user( $fields );

			if( !is_wp_error($user_id) ) {}

			// And display a message
			printf( __( '%1$sThank you! Registration complete, now you can go to %3$s login page. %4$s %2$s ', 'benevolence-wpl' ),
					'<h1>', '</h1>', '<a href="' . esc_url( get_permalink( ot_get_option('wpl_login_link' ) ) ) . '">', '</a>' );
			// Clear field data
			$fields = array();

			return;
		}
	}

	// Santitize fields
	wplook_ur_sanitize($fields);
	// Generate form
	wplook_ur_display_form($fields, $errors);


}

function wplook_ur_sanitize(&$fields) {
	$fields['user_login']   =  isset($fields['user_login'])  ? sanitize_user($fields['user_login']) : '';
	$fields['user_pass']    =  isset($fields['user_pass'])   ? esc_attr($fields['user_pass']) : '';
	$fields['user_pass2']   =  isset($fields['user_pass2'])  ? esc_attr($fields['user_pass2']) : '';
	$fields['user_email']   =  isset($fields['user_email'])  ? sanitize_email($fields['user_email']) : '';
	$fields['first_name']   =  isset($fields['first_name'])  ? sanitize_text_field($fields['first_name']) : '';
	$fields['last_name']    =  isset($fields['last_name'])   ? sanitize_text_field($fields['last_name']) : '';
}

function wplook_ur_display_form( $fields = array(), $errors = null ) {
  // Check for wp error obj and see if it has any errors
  if (is_wp_error($errors) && count($errors->get_error_messages()) > 0) {
	// Display errors
	$html_errors = '<ul class="errors">';
	foreach ($errors->get_error_messages() as $key => $val) {
		$html_errors .= '<li>'.$val.'</li>';
	}
	$html_errors .= '</ul>';
	echo wp_kses( $html_errors, array( 'ul' => array( 'class' => array() ), 'li' => array() ) );
  }

  // Disaply form
  ?>
	<form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" id="wpl_register_user">
		<div class="user-register">
			<div class="grid_half">
				<label><?php _e('Username', 'benevolence-wpl'); ?></label>
				<input name="user_login" type="text" placeholder="<?php _e('Username', 'benevolence-wpl'); ?>" value="<?php echo (isset($fields['user_login']) ? $fields['user_login'] : '') ?>">

			</div>
			<div class="grid_half ">
				<label><?php _e('Email', 'benevolence-wpl' ); ?></label>
				<input name="user_email" type="text" placeholder="<?php _e('Email Address', 'benevolence-wpl'); ?>" value="<?php echo (isset($fields['user_email']) ? $fields['user_email'] : '') ?>">

			</div>
			<div class="grid_half">
				<label><?php _e('Password', 'benevolence-wpl'); ?></label>
				<input name="user_pass" type="password" placeholder="<?php _e('Password', 'benevolence-wpl'); ?>" value="<?php echo (isset($fields['user_pass']) ? $fields['user_pass'] : '') ?>">

			</div>
			<div class="grid_half ">
				<label><?php _e('Repeat Password', 'benevolence-wpl'); ?></label>
				<input name="user_pass2" type="password" placeholder="<?php _e('Repeat Password', 'benevolence-wpl'); ?>" value="<?php echo (isset($fields['user_pass2']) ? $fields['user_pass2'] : '') ?>">

			</div>
			<div class="grid_half">
				<label><?php _e('First Name', 'benevolence-wpl'); ?></label>
				<input name="first_name" type="text" placeholder="<?php _e('First Name', 'benevolence-wpl'); ?>" value="<?php echo (isset($fields['first_name']) ? $fields['first_name'] : '') ?>">

			</div>
			<div class="grid_half ">
				<label><?php _e('Last Name', 'benevolence-wpl'); ?></label>
				<input name="last_name" type="text" placeholder="<?php _e('Last Name', 'benevolence-wpl'); ?>" value="<?php echo (isset($fields['last_name']) ? $fields['last_name'] : '') ?>">
			</div>
			<div class="grid_full">
				<p class="fright">
					<input type="submit" name="submit" value="<?php _e('Register', 'benevolence-wpl'); ?>" class="button button-user-register" >
				</p>
			</div>
		</div>
	</form>
<?php
}

function wplook_ur_get_fields() {
	return array(
		'user_login'	=>  isset($_POST['user_login'])   ?  $_POST['user_login'] :  '',
		'user_pass'		=>  isset($_POST['user_pass'])    ?  $_POST['user_pass']  :  '',
		'user_pass2'	=>  isset($_POST['user_pass2'])   ?  $_POST['user_pass2'] :  '',
		'user_email'	=>  isset($_POST['user_email'])   ?  $_POST['user_email'] :  '',
		'first_name'	=>  isset($_POST['first_name'])   ?  $_POST['first_name'] :  '',
		'last_name'		=>  isset($_POST['last_name'])    ?  $_POST['last_name']  :  '',
	);
}

function wplook_ur_validate( &$fields, &$errors ) {

	// Make sure there is a proper wp error obj
	// If not, make one
	if (!is_wp_error($errors))  {
		$errors = new WP_Error;
	}

	// Validate form data

	if (empty($fields['user_login']) ) {
		$errors->add('user_login', __('Required form field "Username" is missing', 'benevolence-wpl') );
	}
	if ( empty($fields['user_pass']) ) {
		$errors->add('user_pass_field', __('Required form field "Password" is missing', 'benevolence-wpl') );
	}
	if ( empty($fields['user_pass2']) ) {
		$errors->add('user_pass2_field', __('Required form field "Repeat Password" is missing', 'benevolence-wpl') );
	}
	if ( empty($fields['user_email']) ) {
		$errors->add('user_email_field', __('Required form field "Email" is missing', 'benevolence-wpl') );
	}
	if ( empty($fields['first_name']) ) {
		$errors->add('first_name', __('Required form field "Frist Name" is missing', 'benevolence-wpl') );
	}
	if ( empty($fields['last_name']) ) {
		$errors->add('last_name', __('Required form field "Last Name" is missing', 'benevolence-wpl') );
	}
	if (strlen($fields['user_login']) < 4) {
		$errors->add('username_length', __('Username too short. At least 4 characters is required', 'benevolence-wpl') );
	}
	if (username_exists($fields['user_login'])) {
		$errors->add('user_name', __('Sorry, that username already exists!', 'benevolence-wpl') );
	}
	if (!validate_username($fields['user_login'])) {
		$errors->add('username_invalid', __('Sorry, the username you entered is not valid', 'benevolence-wpl') );
	}
	if (strlen($fields['user_pass']) < 5) {
		$errors->add('user_pass', __('Password length must be greater than 5', 'benevolence-wpl') );
	}
	if ( !($fields['user_pass'] === $fields['user_pass2']) ) {
		$errors->add('user_passs', __('Passwords do not match', 'benevolence-wpl') );
	}
	if (!is_email($fields['user_email'])) {
		$errors->add('email_invalid', __('Email is not valid', 'benevolence-wpl') );
	}
	if (email_exists($fields['user_email'])) {
		$errors->add('email', __('Email Already in use', 'benevolence-wpl') );
	}

	// If errors were produced, fail
	if (count($errors->get_error_messages()) > 0) {
		return false;
	}

	// Else, success!
	return true;
}

/*------------------------------------------------------------
	Get User links
============================================================*/
if ( !function_exists( 'wplook_get_user_urls' ) ) :
	function wplook_get_user_urls() { ?>
		<dl class="sub-nav user-nav">
		<?php
			global $post;
			$current_user = wp_get_current_user();
			$current_template = get_page_template_slug( $post->ID );
		?>
			<dt><b><?php echo esc_html($current_user->display_name); ?></b></dt>
			<dd class="<?php if ( $current_template == "template-user-donations.php" ) {echo "active";} ?>"><a href="<?php echo get_permalink( ot_get_option('wpl_donations_link' ) ); ?>"><?php _e('Donations', 'benevolence-wpl'); ?></a></dd>
			<dd class="<?php if ( $current_template == "template-user-subscriptions.php" ) {echo "active";} ?>"><a href="<?php echo get_permalink( ot_get_option('wpl_subscriptions_link' ) ); ?>"><?php _e('Active Subscriptions', 'benevolence-wpl'); ?></a></dd>
			<dd><a href="<?php echo wp_logout_url( home_url() ); ?>"><?php _e('Log out', 'benevolence-wpl'); ?></a></dd>
		</dl>
	<?php }
endif;
add_action( 'wplook_user_urls', 'wplook_get_user_urls' );
