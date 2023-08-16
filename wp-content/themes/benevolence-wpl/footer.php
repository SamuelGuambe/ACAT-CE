<?php
/**
 * The default footer file
 *
 * @package WPlook
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
 ?>
 	<footer id="colophon" class="site-footer" role="contentinfo">

		<!-- Footer Widget Area -->
		<div class="widget-area container_12" role="complementary">

			<div class="grid_12 ml">
				<?php if (is_active_sidebar( 'f1-widgets' ) ) { ?>

					<?php if ( is_active_sidebar( 'f1-widgets' ) ) : ?>
						<?php dynamic_sidebar( 'f1-widgets' ); ?>
					<?php endif; ?>

				<?php }	?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="site-info">
			<div class="container_12 copy">

				<div class="grid_6">
					<p><?php wplook_render_footer_content(); ?> <?php _e('Designed by', 'benevolence-wpl'); ?> <a href="https://wplook.com/theme/benevolence-church-nonprofit-wordpress-theme/?utm_source=Footer-URL&utm_medium=link&utm_campaign=Benevolence" title="<?php _e('WPlook', 'benevolence-wpl'); ?>" rel="nofollow" target="_blank">WPlook Studio</a></p>
				</div>

				<div class="grid_6 frighti">
					<?php
						if ( has_nav_menu( 'footernav' ) ) { ?>
							<nav class="footer-navigation">
								<?php wp_nav_menu( array('depth' => '3', 'theme_location' => 'footernav', 'container'	 => '','depth' => -1, )); ?>
							</nav>
					<?php } ?>
				</div>
				<div class="clear"></div>
			</div>

		</div>

	 </footer><!-- #colophon .site-footer -->

	</div><!-- #page .hfeed .site -->

	<?php wp_footer(); ?>
</body>
</html>