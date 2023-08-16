<?php
/**
 * The default Sidebar. It will display on all pages
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>

<div id="secondary" class="grid_3 widget-area" role="complementary">
	<?php if( ot_get_option( 'wpl_pages_share' ) != 'off' ) : ?>
		<aside class="widget">
			<div class="info-box">
				<?php // Share Buttons ?>
				<div class="info-row"><?php _e('Share', 'benevolence-wpl'); ?>
					<span class="fright share-btns">
						<?php wplook_get_share_buttons(); ?>
					</span>
				</div>
			</div>
		</aside> <!-- .widget cause detailes -->
	<?php endif; ?>

	<?php if ( ( ot_get_option('wpl_menu_child') != "off" ) && ( $post->post_parent) ) { ?>
		<aside id="autogen-menu" class="widget widget_archive">
			<div class="widget-title"><h3><?php _e('Menu', 'benevolence-wpl'); ?></h3><div class="clear"></div></div>

			<?php if($post->post_parent) {
				$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0&sort_column=post_date");
			} else {
				$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&sort_column=post_date");
			}

			if ($children) { ?>
				<ul>
					<?php echo $children; ?>
				</ul>
			<?php } ?>
		</aside>
	<?php } ?>

	<?php if ( is_active_sidebar( 'page-1' ) ) : ?>
		<?php if ( ! dynamic_sidebar( 'page-1' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
	<?php endif; ?>
</div>
