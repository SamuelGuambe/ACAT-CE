<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */

?>
<?php if( is_single()) { ?>
	<?php
		$pid = $post->ID;
		$share_buttons = get_post_meta( $pid, 'wpl_share_buttons', true);
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class("single"); ?>>

		<div class="entry-content">
			<?php // Featured image if any ?>
			<?php if( has_post_thumbnail() && ot_get_option('wpl_featured_image_post') != "off" ) { ?>
				<figure class="content-image">
					<?php the_post_thumbnail('gallery-image'); ?>
				</figure>
			<?php } ?>
			<div class="clear"></div>

			<?php // The content ?>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'benevolence-wpl' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div>

		<div class="entry-meta-news">
			<?php // Publication Date and time ?>
			<?php if ( ot_get_option('wpl_date_single_post') != "off" ) { ?>
				<time class="entry-time" datetime="<?php echo get_the_date( 'c' ) ?>"><i class="far fa-clock"></i> <?php wplook_get_date_time(); ?></time>
			<?php } ?>

			<?php // Author ?>
			<?php if ( ot_get_option('wpl_author_single_post') != "off" ) { ?>
				<span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="far fa-user"></i> <?php echo get_the_author(); ?></a></span>
			<?php } ?>

			<?php // Tags ?>
			<?php if ( get_the_tag_list( '', ', ' ) ) { ?>
				<span class="entry-tag"><i class="fas fa-tag"></i> <?php echo get_the_tag_list('',', ',''); ?></span>
			<?php } ?>

			<?php // Categories ?>
			<?php if ( ot_get_option('wpl_category_single_post') != "off" ) { ?>
				<span class="entry-category"><i class="far fa-folder"></i> <?php the_category(', ') ?></span>
			<?php }?>

			<?php // Share buttons ?>
			<?php if ( $share_buttons != 'off' ) { ?>
				<span class="share-via-box">
					<span class="share-via fleft"><?php _e('Share via:', 'benevolence-wpl'); ?> </span>
					<span class="fright share-btns">
						<?php wplook_get_share_buttons(); ?>
					</span>
				</span>
			<?php } ?>

			<div class="clear"></div>
		</div>

		<div class="clear"></div>
	</article>

	<?php comments_template( '', true ); ?>

<?php } else { ?>

	<!-- Article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class('list'); ?>>

		<?php if ( has_post_thumbnail() ) {?>
			<figure>
				<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('small-thumb', array('class' => 'round')); ?>
				</a>
			</figure>
		<?php } ?>

		<h1 class="entry-header">
			<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h1>

		<div class="short-description">
			<p><?php echo wplook_short_excerpt('35');?></p>
			<?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'benevolence-wpl' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div>

		<div class="entry-meta">
			<a class="read-more-button fleft" href="<?php the_permalink(); ?>" title="<?php _e('Read more', 'benevolence-wpl'); ?>"><?php _e('Read more', 'benevolence-wpl'); ?></a>
			<?php if ( ot_get_option('wpl_date_blog_post') != "off" ) { ?>
				<time class="entry-time" datetime="<?php echo get_the_date( 'c' ) ?>"><a href="#"><i class="far fa-clock"></i> <?php wplook_get_date_time(); ?></a></time>
			<?php } ?>

			<?php if ( ot_get_option('wpl_author_blog_post') != "off" ) { ?>
				<span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="far fa-user"></i> <?php echo get_the_author(); ?></a></span>
			<?php } ?>
		</div>

		<div class="clear"></div>
	</article>

<?php } ?>
