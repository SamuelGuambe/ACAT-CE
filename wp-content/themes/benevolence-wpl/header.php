<?php
/**
 * The header template file
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<!-- Inicio  Toolbar-->
		
		
		<!-- Inicio  Toolbar-->
		<div class="logo-online-giving">
			<div class="container_12">

				<!-- Site title and description -->
				<div class="grid_3 branding">
					<?php if (ot_get_option( 'wpl_logo' ) !== '' ) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo('description'); ?>" rel="home">
							<img src="<?php echo ot_get_option('wpl_logo'); ?>">
						</a>
					<?php } else { ?>
						<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo('description'); ?>" rel="home"> <?php bloginfo('name'); ?> </a></h1>

						<h2 id="site-description"><?php bloginfo('description'); ?></h2>
					<?php } ?>
				</div>

				<!-- Social Networking and Donation Button -->
				<div class="grid_9 frighti">
					<div class="header-links">

						<!-- Display the shopping cart if WooCommerce is active -->
						<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
						<?php
						if ( is_plugin_active( 'woocommerce/woocommerce.php') && ot_get_option('wpl_woo_cart') != 'off' ) { ?>
							<div class="shopping-cart">
								<?php global $woocommerce; ?>
								<i class="fas fa-shopping-cart"></i><a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php _e('View your shopping cart', 'benevolence-wpl'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'benevolence-wpl'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
							</div>
						<?php } ?>

						<?php if ( ot_get_option('wpl_donete_link') != "") { ?>
							<!-- Donation Button -->
							<div class="make-donation">
								<div class="phone">
								 <span class="fa fa-home" style="color: #003366;display:inline-block;font-size:28px;border:3px solid #003366; border-radius:100%; padding:10px; margin-right:10px"></span>
                                        <span class="anpstext-desc" style="color: #848484;display:inline-block">
						<small><?php _e('Praça 25 de Junho, 11 andar.', 'healthmedical-wpl'); ?></small>
						<small><?php _e('Cidade de MaputoA', 'healthmedical-wpl'); ?></small>
						
										</span>
									</div>
							</div>
						<?php } ?>
						<!--REPITICAO DE DONATION BUTTON-->
						
						<?php if ( ot_get_option('wpl_donete_link') != "") { ?>
							<!-- Donation Button -->
							<div class="make-donation">
								<div class="phone">
								 <span class="fa fa-phone" style="color: #003366;display:inline-block;font-size:28px;border:3px solid #003366; border-radius:100%; padding:10px; margin-right:10px"></span>
                                        <span class="anpstext-desc" style="color: #848484;display:inline-block">
						<small><?php _e('Fala com IGREME', 'healthmedical-wpl'); ?></small>
						<small><?php _e('+258 823336444', 'healthmedical-wpl'); ?></small>
											</span>
									</div>
							</div>
						<?php } ?>
					
						
						<?php if ( ot_get_option('wpl_donete_link') != "") { ?>
							<!-- Donation Button -->
							<div class="make-donation">
								<div class="phone">
                                    <span class="fa fa-envelope" style="color: #003366;display:inline-block;font-size:28px;border:3px solid #003366; border-radius:100%; padding:10px; margin-right:10px"></span>
                                        <span class="anpstext-desc" style="color: #848484;display:inline-block">
						<small><?php _e('Escreve-nos pelo', 'healthmedical-wpl'); ?></small>
						<small><?php _e('info@igreme.gov.mz', 'healthmedical-wpl'); ?></small>
											</span>
					</div><!-- /.phone -->
							</div>
						<?php } ?>
						
						
						
						<!--FIM REPITICAO DE DONATION BUTTON-->

					</div>
				</div>
				<div class="clear"></div>

			</div>
		</div>
		<div class="clear"></div>

			<div class="menu">

					<nav role="navigation" class="site-navigation main-navigation" id="site-navigation">
						<div class="responsive container_12"></div>
						<div class="container_12 non-res">
							<?php if ( has_nav_menu( 'primary' ) ) {
								wp_nav_menu( array('depth' => '5', 'theme_location' => 'primary', 'container'	 => ''));
							} ?>
						</div>
					</nav>
					<div class="clear"></div>
			</div>

			<?php get_template_part( 'template-parts/inc', 'slider' ); ?>

		<div class="clear"></div>
	</header><!-- #masthead .site-header -->
