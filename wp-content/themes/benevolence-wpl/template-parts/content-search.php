<?php
/**
 * The default template for displaying content for pages
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */
?>

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
	</div>

	<div class="clear"></div>

</article>
