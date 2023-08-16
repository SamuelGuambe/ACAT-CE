<?php
/**
 * Provides a notification everytime the theme is updated
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.1.0
 * @version 4.6
 */
?>
<?php
global $wplook_update_theme_slug, $wplook_update_theme_folder, $wplook_update_theme_info;
$wplook_update_theme_slug = 'benevolence';
$wplook_update_theme_folder = 'benevolence-wpl';
$wplook_update_theme_info = wp_get_theme( $wplook_update_theme_folder );

if( !function_exists( 'wplook_update_notifier_menu' ) ) {

	function wplook_update_notifier_menu() { // Add update item to WordPress' Appearance menu

		global $wplook_update_theme_slug, $wplook_update_theme_info;

		if( version_compare( $wplook_update_theme_info->Version, get_option( 'wpl_latest_theme_version' ), "<" ) ) {
			add_theme_page(
				sprintf( __( '%1$s Updates', 'benevolence-wpl' ), $wplook_update_theme_info->Name ), // Page title
				__( 'Theme Updates', 'benevolence-wpl' ) . ' ' . '<span class="update-plugins count-1"><span class="update-count">1</span></span>', // Menu name
				'install_themes', // Capability
				$wplook_update_theme_slug . '-updates', // Slug
				'wplook_update_notifier' // Handler
			);

			function wpl_theme_error_notice() {

				global $wplook_update_theme_slug, $wplook_update_theme_folder, $wplook_update_theme_info; ?>

				<div id="message" class="notice notice-warning">
					<p><?php printf( __( 'A newer version of the %1$s theme, %2$s, is now available to download from <a href="https://wplook.com/theme/benevolence-church-nonprofit-wordpress-theme/?utm_source=Update_notice&utm_medium=link&utm_campaign=Benevolence">WPlook Studio.</a>', 'benevolence-wpl' ), $wplook_update_theme_info->Name, trim( wp_remote_retrieve_body( wp_remote_get( 'https://update.wplook.com/' . $wplook_update_theme_slug . '.php?latest' ) ) ) ); ?></p>
				</div>
			<?php }
			add_action( 'admin_notices', 'wpl_theme_error_notice' );

		}
	}

	add_action('admin_menu', 'wplook_update_notifier_menu');

}


if( !function_exists( 'wplook_update_notifier' ) ) {

	function wplook_update_notifier() { // Theme Updates page content

		global $wplook_update_theme_slug, $wplook_update_theme_folder, $wplook_update_theme_info;

		?>

			<style>
				.updated p {
					font-weight: 600;
				}

				.update-nag {
					display: none;
				}

				.updater-content {
					overflow: hidden;
				}

				.instructions {
					float: left;
					width: 60%;
				}

				.image {
					float: right;
					width: 40%;
					box-sizing: border-box;
					padding-left: 2%;
				}

				.image img {
					border: 1px solid #ddd;
					width: 100%;
					height: auto;
				}

				@media only screen and ( max-width: 780px ) {

					.instructions, .image {
						float: none;
						width: 100%;
					}

					.image img {
						display: none;
					}

				}

				.theme-options span span {
					background-color: red;
				}
			</style>

			<div class="wrap">
				<h1><?php printf( __( '%1$s - Theme Updates', 'benevolence-wpl' ), $wplook_update_theme_info->Name ); ?></h1>

				<div class="updater-content">

					<div class="instructions">
						<h2><?php _e( 'Update the theme', 'benevolence-wpl' ); ?></h2>

						<p><?php _e( '<strong>Note:</strong> Make sure to make a backup of the theme and your WordPress site before updating the theme. Your content and settings will be preserved during the update, but it\'s important to have backups in case something goes wrong.', 'benevolence-wpl' ); ?></p>

						<?php if( is_multisite() ) : ?>

							<p><?php _e( '<strong>Note:</strong> You are using a multisite installation of WordPress. This means you might be on an installation of WordPress managed by someone else and might not be able to install themes yourself. If this is the case, and you do not have access to the theme files, contact your administrator about performing the update to get the latest and greatest features of this theme.', 'benevolence-wpl' ); ?></p>

						<?php endif; ?>

						<h3><?php _e( 'Manual theme update via FTP', 'benevolence-wpl' ); ?></h3>
						<ol>
							<li><?php _e( 'Download the latest version of the theme from the <a href="https://wplook.com/my-account/">WPlook Studio site</a>.', 'benevolence-wpl' ); ?></li>
							<li><?php printf( __( 'Login to your FTP account and navigate to <code>wp-content/themes</code>. Delete the theme folder called <code>%1$s</code>.', 'benevolence-wpl' ), $wplook_update_theme_folder ); ?></li>
							<li><?php printf( __( 'Extract the downloaded archive and upload the <code>%1$s</code> folder from your computer into the <code>wp-content/themes</code> folder on your server.', 'benevolence-wpl' ), $wplook_update_theme_folder ); ?></li>
						</ol>

						<h3><?php _e( 'Manual theme update via WordPress', 'benevolence-wpl' ); ?></h3>
						<ol>
							<li><?php _e( 'Download the latest version of the theme from the <a href="https://wplook.com/my-account/">WPlook Studio site</a>.', 'benevolence-wpl' ); ?></li>
							<li><?php _e( 'Login to your WordPress dashboard, head over to Appearance &rarr; Themes.', 'benevolence-wpl' ); ?></li>
							<li><?php printf( __( 'Activate another theme and delete the %1$s theme.', 'benevolence-wpl' ), $wplook_update_theme_info->Name ); ?></li>
							<li><?php printf( __( 'Head over to Appearance &rarr; Themes &rarr; Add New and upload <code>%1$s.zip</code>.', 'benevolence-wpl' ), $wplook_update_theme_folder ); ?></li>
							<li><?php printf( __( 'Activate the %1$s theme.', 'benevolence-wpl' ), $wplook_update_theme_info->Name ); ?></li>
						</ol>

						<h3><?php _e( 'Information and support', 'benevolence-wpl' ); ?></h3>
						<p><?php _e( 'If you have made any changes to the theme files, make sure to back those up and restore them after the update has completed. In the future, you should consider using <a href="https://codex.wordpress.org/Child_Themes">child themes</a> to ensure you can update safety without overwriting your changes.', 'benevolence-wpl' ); ?></p>
						<p><?php _e( 'If you have any questions about theme updates, please do not hesitate to <a href="https://wplook.com/help">contact us</a>.', 'benevolence-wpl' ); ?></p>

						<h3><?php printf( __( '%1$s changelog', 'benevolence-wpl' ), $wplook_update_theme_info->Name ); ?></h3>
						<?php echo wp_remote_retrieve_body( wp_remote_get( 'https://update.wplook.com/' . $wplook_update_theme_slug . '.php?changelog' ) ); ?>
					</div>

					<div class="image">
						<img src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" />
					</div>

				</div>

			</div>
		<?php
	}

}


if( !function_exists( 'wplook_update_latest_version' ) ) {

	function wplook_update_latest_version( $interval ) { // Check for updates

		global $wplook_update_theme_slug;

		$db_cache_field = 'wpl_latest_theme_version';
		$db_cache_field_last_updated = 'wpl_latest_cache_time';
		$last = get_option( $db_cache_field_last_updated );
		$now = time();

		if ( !$last || (( $now - $last ) > $interval) ) { // Check the cache

			$update_data = wp_remote_get( 'https://update.wplook.com/' . $wplook_update_theme_slug . '.php?latest' );

			if( wp_remote_retrieve_response_code( $update_data ) == 200 ) {

				$cache = wp_remote_retrieve_body( $update_data );
				if ( $cache ) {
					// We got good results
					update_option( $db_cache_field, $cache );
					update_option( $db_cache_field_last_updated, $now );
				}

			} else {

				delete_option( $db_cache_field );
				update_option( $db_cache_field_last_updated, $now );

			}

		}
	}

}

wplook_update_latest_version( 86400 ); // Check for updates every 24 hours

?>
