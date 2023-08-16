<?php
/**
 * Custom Functions
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.0
 * @version 4.6
 */


/*-----------------------------------------------------------
	Enable svg support
-----------------------------------------------------------*/
if ( ! function_exists( 'avatar_add_svg_mime_types' ) ) {
	/**
	 * @param $mimes - MIME file type
	 * @return mixed
	 */
	function avatar_add_svg_mime_types( $mimes ) {
		if ( is_super_admin() ) {
			$mimes['svg'] = 'image/svg+xml';
		}
		return $mimes;
	}
	add_filter( 'upload_mimes', 'avatar_add_svg_mime_types' );
}

/*-----------------------------------------------------------------------------------*/
/*  Get Custom attacement ID
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'custom_get_attachment_id' ) ) {

	function custom_get_attachment_id( $guid ) {
		global $wpdb;

		/* nothing to find return false */
		if ( ! $guid )
		return false;

		/* get the ID */
		$id = $wpdb->get_var( $wpdb->prepare(
			"
			SELECT  p.ID
			FROM    $wpdb->posts p
			WHERE   p.guid = %s
					AND p.post_type = %s
			",
			$guid,
			'attachment'
		) );

		/* the ID was not found, try getting it the expensive WordPress way */
		if ( $id == 0 )
		$id = url_to_postid( $guid );

		return $id;
	}

}


/*-----------------------------------------------------------------------------------*/
/* [Function that return icon name depending on the file extension]
/* @param  [type] $file [file, or file patch]
/* @return [type]       [icon name]
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_icon_name' ) ) {

	function wplook_get_icon_name($file) {
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		switch ($ext) {
			case "odt":
				$icon_name = "far fa-file-alt";
				break;
			case "pdf":
				$icon_name = "far fa-file-pdf";
				break;
			case "zip":
			case "7z":
			case "rar":
			case "gz":
			case "gzip":
			case "tar":
				$icon_name = "far fa-file-archive";
				break;
			case "ppt":
			case "pptx":
				$icon_name = "far fa-file-powerpoint";
				break;
			case "doc":
			case "docx":
				$icon_name = "far fa-file-word";
				break;
			case "xls":
			case "xla":
			case "xlt":
			case "xlw":
			case "xlsx":
			case "xlsb":
			case "xltx":
			case "xltm":
			case "xlam":
				$icon_name = "far fa-file-excel";
				break;
			case "gif":
			case "png":
			case "jpg":
			case "jpeg":
			case "jpe":
			case "tif":
			case "tiff":
			case "ico":
			case "bmp":
			case "tif":
				$icon_name = "far fa-image";
				break;
			default:
				$icon_name = "far fa-file-alt";
		}

		return $icon_name;
	}
	add_filter( 'wpl_icone_name', 'wplook_get_icon_name' );
}


/*-----------------------------------------------------------------------------------*/
/*  Add a container for video
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_custom_oembed_filter' ) ) {

	add_filter( 'embed_oembed_html', 'wpl_custom_oembed_filter', 10, 4 ) ;

	function wpl_custom_oembed_filter($html, $url, $attr, $post_ID) {
		$return = '<div class="video-container">'.$html.'</div>';
	    return $return;
	}
}

/*-----------------------------------------------------------------------------------*/
/*  Get the donation amound and number of donors for one cause
/*-----------------------------------------------------------------------------------*/


if ( ! function_exists( 'get_pledge_nb_total' ) ) {

	function get_pledge_nb_total($key, $value) {
		global $wpdb;
		$key = esc_sql($key);
		$value = esc_sql($value);
		$meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='$key' AND meta_value='$value'", ARRAY_A);

		if (is_array($meta) && !empty($meta) && isset($meta[0])) {
			$i=0;
			$totalDonatii = 0;
			foreach ($meta as $value) {
				$nbDonatii 		= ++$i;
				$totalDonatii	+= get_post_meta($value["post_id"], 'wpl_pledge_donation_amount', true );
			}
			if ($i!= 0){
				return $donatii=array("nb"=>$nbDonatii,"total"=>$totalDonatii);
			}
		}
		return $donatii=array("nb"=>0,"total"=>0);;
	}

}

/*-----------------------------------------------------------
	Get taxonomies terms links
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_custom_taxonomies_terms_links' ) ) {

	function wplook_custom_taxonomies_terms_links() {
		global $post, $post_id;
		// get post by post id
		$post = get_post($post->ID);
		// get post type by post
		$post_type = $post->post_type;
		// get post type taxonomies
		$taxonomies = get_object_taxonomies($post_type);
		foreach ($taxonomies as $taxonomy) {
			// get the terms related to post
			$terms = get_the_terms( $post->ID, $taxonomy );
			if ( !empty( $terms ) ) {
				$out = array();
				foreach ( $terms as $term )
					$out[] = $term->name;
				$return = join( ', ', $out );
			} else {
				$return = '';
			}
			return $return;
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/*  Display share buttons on posts
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_share_buttons' ) ) {

	function wplook_get_share_buttons() {
		$url = urlencode( get_the_permalink() );
		$title = urlencode( get_the_title() ); 
		?>
		
		<a title="<?php _e('Facebook', 'benevolence-wpl'); ?>" class="share-icon-fb" id="fbbutton" onclick="fbwindows('https://www.facebook.com/sharer.php?u=<?php echo $url; ?>'); return false;"><i class="fab fa-facebook-f"></i></a>
		<a title="<?php _e('Twitter', 'benevolence-wpl'); ?>" class="share-icon-tw" id="twbutton" onClick="twwindows('https://twitter.com/intent/tweet?text=<?php echo $title; ?>&url=<?php echo $url; ?>'); return false;"><i class="fab fa-twitter"></i></a>
		<a title="<?php _e('Pinterest', 'benevolence-wpl'); ?>" class="share-icon-pt" id="pinbutton" onClick="pinwindows('https://pinterest.com/pin/create/button/?url=<?php echo $url; ?>&media=');"><i class="fab fa-pinterest"></i></a>
		<a title="<?php _e('Google+', 'benevolence-wpl'); ?>" class="share-icon-gp" id="gpbutton" onClick="gpwindows('https://plus.google.com/share?url=<?php echo $url; ?>');"><i class="fab fa-google-plus-g"></i></a>
	<?php }

}


/*-----------------------------------------------------------
	Custom Tag cloud Widget
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_tag_cloud_widget' ) ) {

	function wplook_tag_cloud_widget($args) {
		$args['largest'] = 14;
		$args['smallest'] = 14;
		$args['unit'] = 'px';
		return $args;
	}
	add_filter( 'widget_tag_cloud_args', 'wplook_tag_cloud_widget' );

}


/*-----------------------------------------------------------
	Get Date
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_date' ) ) {

	function wplook_get_date() {
		the_time(get_option('date_format'));
	}

}


/*-----------------------------------------------------------
	Get Time
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_time' ) ) {

	function wplook_get_time() {
		the_time(get_option('time_format'));
	}

}


/*-----------------------------------------------------------
	Get Date and Time
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_date_time' ) ) {

	function wplook_get_date_time() {
		the_time(get_option('date_format'));
		_e( ' at ', 'benevolence-wpl');
		the_time(get_option('time_format'));
	}

}


/*-----------------------------------------------------------------------------------*/
/*	Trim excerpt
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_short_excerpt' ) ) {

	function wplook_short_excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		}
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;
	}

}


/*-----------------------------------------------------------
	Display Navigation for post, pages, search
-----------------------------------------------------------*/

if ( !function_exists( 'wplook_content_navigation' ) ) {

	function wplook_content_navigation( $class = false ) {

		global $wp_query;
		$maximum = $wp_query->max_num_pages;

		if( $maximum < 2 ) {
			return false;
		}

		$current = get_query_var( 'paged' ) > 1 ? get_query_var( 'paged' ) : 1;
		$previous = $current - 1;
		$next = $current + 1;

		ob_start();

		?>

			<div class="pagination <?php echo esc_attr( $class ); ?>">

				<?php if( $current > 1 ) : ?>
					<div class="section back-buttons">
						<a href="<?php echo get_pagenum_link( 1 ); ?>" class="button first" title="<?php _e( 'Go to the first page', 'benevolence-wpl' ); ?>"><?php _e( 'First page', 'benevolence-wpl' ); ?></a>
						<a href="<?php echo get_pagenum_link( $previous ); ?>" class="button previous" title="<?php printf( __( 'Go to the page %d', 'benevolence-wpl' ), $current - 1 ); ?>"><?php _e( 'Previous page', 'benevolence-wpl' ); ?></a>
					</div>
				<?php endif; ?>

				<div class="section pager">
					<?php printf( __( 'Page %1$s of %2$d', 'benevolence-wpl' ), $current, $maximum ); ?>
				</div>

				<?php if( $current < $maximum ) : ?>
					<div class="section next-buttons">
						<a href="<?php echo get_pagenum_link( $next ); ?>" class="button next" title="<?php printf( __( 'Go to the page %d', 'benevolence-wpl' ), $current + 1 ); ?>"><?php _e( 'Next page', 'benevolence-wpl' ); ?></a>
						<a href="<?php echo get_pagenum_link( $maximum ); ?>" class="button last" title="<?php _e( 'Go to the last page', 'benevolence-wpl' ); ?>"><?php _e( 'Last page', 'benevolence-wpl' ); ?></a>
					</div>
				<?php endif; ?>

			</div>

		<?php

		echo ob_get_clean();

	}

}


/*-----------------------------------------------------------
	Format money
-----------------------------------------------------------*/

if ( ! function_exists( 'formatMoney' ) ) {
	// echo formatMoney(1050); # 1,050
	// echo formatMoney(1321435.4, true); # 1,321,435.40
	function formatMoney($number, $fractional=false) {
		if ($fractional) {
			$number = sprintf('%.2f', $number);
		}
		while (true) {
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
			if ($replaced != $number) {
				$number = $replaced;
			} else {
				break;
			}
		}
		return $number;
	}

}

/*-----------------------------------------------------------
	Breadcrumbs
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_breadcrumbs' ) ) {

	function wplook_breadcrumbs() {
		$showOnHome 	= '0'; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter 	= '>'; // delimiter between crumbs

		$showCurrent 	= '1'; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$before 		= '<span class="current">'; // tag before the current crumb
		$after 		= '</span>'; // tag after the current crumb

		$text['home'] = __('Home','benevolence-wpl'); // text for the 'Home' link
		$text['category'] = __('Archive for %s','benevolence-wpl'); // text for a category page
		$text['search'] = __('Search results for: %s','benevolence-wpl'); // text for a search results page
		$text['tag'] = __('Posts tagged %s','benevolence-wpl'); // text for a tag page
		$text['author'] = __('Posts by %s','benevolence-wpl'); // text for an author page
		$text['404'] = __('Error 404','benevolence-wpl'); // text for the 404 page

		global $post;
		$homeLink = home_url( '/' );

		echo '<a href="' . $homeLink . '">' . $text['home'] . '</a> ' . $delimiter . ' ';

		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif( is_tax() ) {
			$queried_object = get_queried_object();
			$term_name = $queried_object->name;
			$taxonomy_name = wplook_get_post_type_label_by_taxonomy( $queried_object->taxonomy );

			echo $taxonomy_name . ' ' . $delimiter . ' ' . $before . $term_name . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				//$slug = $post_type->rewrite;
				//echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
				echo '<span>' . $post_type->labels->singular_name .'</span>' ;
				if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				if ($showCurrent == 0) $cats = preg_replace("/^(.+)\s$delimiter\s$/", "$1", $cats);
				echo $cats;
					if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( (is_plugin_active( 'woocommerce/woocommerce.php')) && is_shop() ) {
			echo __('Shop','benevolence-wpl');
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			//$cat = get_the_category($parent->ID); $cat = $cat[0];
			//echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
			}
			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo ' ' . $delimiter . ' '; echo __('Page', 'benevolence-wpl') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

	} // end breadcrumbs()
}

if( !function_exists( 'wplook_get_post_type_label_by_taxonomy' ) ) {

	function wplook_get_post_type_label_by_taxonomy( $tax_name ) {

		switch ( $tax_name ) {
			case 'wpl_causes_category':
				$label = ot_get_option( 'wpl_causes_url_rewrite_name' );
				break;

			case 'wpl_documents_category':
				$label = ot_get_option( 'wpl_documents_url_rewrite_name' );
				break;

			case 'wpl_events_category':
				$label = ot_get_option( 'wpl_events_url_rewrite_name' );
				break;

			case 'wpl_gallery_category':
				$label = ot_get_option( 'wpl_gallery_url_rewrite_name' );
				break;

			case 'wpl_ministries_category':
				$label = ot_get_option( 'wpl_ministries_url_rewrite_name' );
				break;

			case 'wpl_projects_category':
				$label = ot_get_option( 'wpl_projects_url_rewrite_name' );
				break;

			case 'wpl_sermons_category':
				$label = ot_get_option( 'wpl_sermon_url_rewrite_name' );
				break;

			case 'wpl_staff_category':
				$label = ot_get_option( 'wpl_staff_url_rewrite_name' );
				break;
		}

		if( !isset( $label ) || !$label ) {
			$tax = get_taxonomy( $tax_name );

			if( !$tax ) {
				return;
			}

			$label = $tax->labels->name;
		}

		return $label;

	}

}


/*-----------------------------------------------------------------------------------*/
/*	Doctitle
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_doctitle' ) ) {
	function wplook_doctitle() {

		$page_template = get_page_template_slug();

		if( get_query_var( 'taxonomy' ) == 'wpl_events_category' ) {
			$pagination = ot_get_option( 'wpl_events_pagination' );
			$pagination = $pagination == 'on' ? true : false;
			$name = single_cat_title( false, false );
			$content = sprintf( _x( 'Upcoming Events in %s', 'Upcoming Events in [category name]', 'benevolence-wpl' ), $name );
		}

		if( get_query_var( 'taxonomy' ) == 'wpl_events_category' ) {
			$pagination = ot_get_option( 'wpl_events_pagination' );
			$pagination = $pagination == 'on' ? true : false;
			$name = single_cat_title( false, false );

			if( $pagination ) {
				$content = sprintf( _x( 'Upcoming Events in %s', 'Upcoming Events in [category name]', 'benevolence-wpl' ), $name );
			} else {
				$date = get_query_var( 'start_time' ) ? get_query_var( 'start_time' ) : date( 'U' );
				$content = sprintf( _x( 'Upcoming Events in %1$s: %2$s %3$d', 'Upcoming Events in [category name]: [month] [year]', 'benevolence-wpl' ), $name, date_i18n( 'F', $date ), date_i18n( 'Y', $date ) );
			}
		}

		elseif( $page_template == 'template-events-past.php' ) {
			$pagination = get_post_meta( get_the_ID(), 'wpl_events_pagination', true );
			$pagination = $pagination == 'on' ? true : false;

			if( $pagination ) {
				$content = __( 'Past events', 'benevolence-wpl' );
			} else {
				$date = get_query_var( 'start_time' ) ? get_query_var( 'start_time' ) : date( 'U' );
				$content = sprintf( _x( 'Past events: %1$s %2$d', 'Past events: [month] [year]', 'benevolence-wpl' ), date_i18n( 'F', $date ), date_i18n( 'Y', $date ) );
			}
		}

		elseif( $page_template == 'template-events-upcoming.php' ) {
			$pagination = get_post_meta( get_the_ID(), 'wpl_events_pagination', true );
			$pagination = $pagination == 'on' ? true : false;

			if( $pagination ) {
				$content = __( 'Upcoming events', 'benevolence-wpl' );
			} else {
				$date = get_query_var( 'start_time' ) ? get_query_var( 'start_time' ) : date( 'U' );
				$content = sprintf( _x( 'Upcoming events: %1$s %2$d', 'Upcoming events: [month] [year]', 'benevolence-wpl' ), date_i18n( 'F', $date ), date_i18n( 'Y', $date ) );
			}
		}

		elseif ( is_search() ) {
		  $content = __('Search Results for:', 'benevolence-wpl');
		  $content .= ' ' . esc_html(stripslashes(get_search_query()));
		}

		elseif ( is_day() ) {
			$content = __( 'Daily Archives:', 'benevolence-wpl');
			$content .= ' ' . esc_html(stripslashes( get_the_date()));
		}

		elseif ( is_month() ) {
			$content = __( 'Monthly Archives:', 'benevolence-wpl');
			$content .= ' ' . esc_html(stripslashes( get_the_date( 'F Y' )));
		}
		elseif ( is_year()  ) {
			$content = __( 'Yearly Archives:', 'benevolence-wpl');
			$content .= ' ' . esc_html(stripslashes( get_the_date( 'Y' ) ));
		}

		elseif ( is_author() ) {
			$content = __("Author's Posts", 'benevolence-wpl');

		}

		elseif ( is_404() ) {
			$content = __('Page Not Found', 'benevolence-wpl');
		}

		elseif ( is_plugin_active( 'woocommerce/woocommerce.php') && is_shop()  ) {
			$content = __('Shop', 'benevolence-wpl');
		}

		else {
			$content = '';
		}

		$elements = array("content" => $content);

		// Filters should return an array
		$elements = apply_filters('wplook_doctitle', $elements);

		// But if they don't, it won't try to implode
			if(is_array($elements)) {
			  $doctitle = implode(' ', $elements);
			} else {
			  $doctitle = $elements;
			}

			if ( get_query_var( 'taxonomy' ) == 'wpl_events_category' || is_search() || is_day() || is_month() || is_year() || is_404() || is_author() ) {
				$doctitle = $doctitle;
			}

		echo $doctitle;

	}
}


/*-----------------------------------------------------------
	Add custom Colors to the theme
-----------------------------------------------------------*/

add_action( 'customize_register', 'hg_customize_register' );
function hg_customize_register($wp_customize) {

	$colors = array();
	$colors[] = array( 'slug'=>'wpl_link_color', 'default' => '#239fdb', 'label' => __( 'Link color', 'benevolence-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_hover_link_color', 'default' => '#239fdb', 'label' => __( 'Hover link color', 'benevolence-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_accent_color', 'default' => '#3465aa', 'label' => __( 'Accent color', 'benevolence-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_accent_color2', 'default' => '#dd3333', 'label' => __( 'Accent color 2', 'benevolence-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_footer_color', 'default' => '#202020', 'label' => __( 'Footer', 'benevolence-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_footer_text_color', 'default' => '#ccc', 'label' => __( 'Footer text color', 'benevolence-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_footer_header_color', 'default' => '#fff', 'label' => __( 'Footer header color', 'benevolence-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	$colors[] = array( 'slug'=>'wpl_accent_text_color', 'default' => '#239fdb', 'label' => __( 'Accent color for text', 'benevolence-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	if( class_exists( 'WooCommerce' ) ) {
		$colors[] = array( 'slug'=>'wpl_wc_price_color', 'default' => '#77a464', 'label' => __( 'WooCommerce price colour', 'benevolence-wpl' ), 'sanitize_callback' => 'sanitize_hex_color' );
	}

	foreach($colors as $color) {

		add_option( $color['slug'], $color['default'] );

		// SETTINGS
		$wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));

		// CONTROLS
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'colors', 'settings' => $color['slug'] )));
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Print Custom Color Styles
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_print_custom_color_style' ) ) {

	function wplook_print_custom_color_style() { ?>
		<?php
			$link_color = get_option('wpl_link_color');
			$hover_link_color = get_option('wpl_hover_link_color');
			$accent_color = get_option('wpl_accent_color');
			$accent_color2 = get_option('wpl_accent_color2');
			$footer_color = get_option('wpl_footer_color');
			$footer_text_color = get_option('wpl_footer_text_color');
			$footer_header_color = get_option('wpl_footer_header_color');
			$accent_text_color = get_option('wpl_accent_text_color');
			$wc_price_color	= get_option('wpl_wc_price_color');

		?>
		<style>
			a, a:visited { color: <?php echo $link_color; ?>;}

			a:focus, a:active, a:hover, article.list:hover .entry-header a, article.item:hover:hover h1 a, .widget-event-body .event-info a:hover, article.item a.read-more-button { color: <?php echo $hover_link_color; ?>; }

			#masthead, #toolbar .language-menu li a:hover, #toolbar .language-menu li.current a, .widget ul li:hover, article.list .entry-meta .read-more-button, article.item:hover a.read-more-button, #postnav .nav-previous, #postnav .nav-next, .tabs_table .tabs li a, .tabs_table, .owl-Navigation a, .widget_archive .current_page_item, .widget-event-body .past-cal .past-ev:hover a, .widget-event-body .past-cal .calendar-ev:hover a { background: <?php echo $accent_color; ?> }

			article.list .entry-meta .read-more-button, article.item a.read-more-button, .woocommerce a.button.add_to_cart_button  {border: 1px solid <?php echo $accent_color; ?>}

			article.list:hover .entry-meta .read-more-button, article.item a.read-more-button, .woocommerce a.button.add_to_cart_button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce .star-rating span {color: <?php echo $accent_color; ?>}

			.WPlookAnounce, .widget-title span a, .widget-event-body .event-day-month .event-day, .acumulated, .cause-details, .accent-widget-detailes, .woocommerce ul.products li.product:hover .add_to_cart_button, .woocommerce-page ul.products li.product:hover .add_to_cart_button, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {background: <?php echo $accent_color; ?>;}

			.entry-content blockquote { border-left: 3px solid <?php echo $accent_color; ?>;}

			.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt { border-color: <?php echo $accent_color; ?>; }

			.widget-title span a:hover, .widget-event-body .event-day-month .event-month, .site-navigation.main-navigation .menu li:hover > a, .site-navigation.main-navigation .menu li a:hover, .mean-container .mean-nav ul li a.mean-expand:hover, #postnav .nav-previous:hover, #postnav .nav-next:hover, .wpcf7-submit:hover, .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content, .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content { background: <?php echo $accent_color2; ?>; }

			.mean-container .mean-nav ul li a:hover, .mean-container a.meanmenu-reveal, .buttonsx, .wpcf7-submit {color: <?php echo $accent_color2; ?>;}

			.entry-header-comments .read-more-button:hover, .buttonsx, .wpcf7-submit {border-color: <?php echo $accent_color2; ?>;}

			.site-navigation.main-navigation .menu .current-menu-item > a, .site-navigation.main-navigation .menu .current-menu-ancestor > a, .entry-header-comments .read-more-button:hover, .buttonsx:hover, .error-text, .widget ul li ul li:hover { color: #fff; background: <?php echo $accent_color2; ?>;}

			#colophon {background: <?php echo $footer_color ?>}

			#colophon p, #colophon a, #colophon aside, #colophon ul li a {color: <?php echo $footer_text_color ?>}

			#colophon h1, #colophon h2, #colophon h3, #colophon h4, #colophon h5, #colophon h6, #colophon aside h3 {color: <?php echo $footer_header_color ?>}

			#content h1, #content h2, #content h3, #content h4, #content h5, #content h6, .info-box .info-row span {color: <?php echo $accent_text_color ?>}

			.woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce div.product .stock, .woocommerce ul.products li.product .price { color:<?php echo $wc_price_color ?>; }

			.woocommerce span.onsale { background-color:<?php echo $wc_price_color ?>; }

		</style>
	<?php }

	if (get_option('wpl_link_color')) {
		add_action( 'wp_head', 'wplook_print_custom_color_style' );
	}
}

/*-----------------------------------------------------------------------------------*/
/*  Convert hexdec color string to rgb(a) string
/*-----------------------------------------------------------------------------------*/

function hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	if(empty($color))
		 return $default;

		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		//Check if color has 6 or 3 characters and get values
		if (strlen($color) == 6) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
				return $default;
		}

		//Convert hexadec to rgb
		$rgb =  array_map('hexdec', $hex);

		//Check if opacity is set(rgba or rgb)
		if($opacity){
			if(abs($opacity) > 1)
				$opacity = 1.0;
			$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
		} else {
			$output = 'rgb('.implode(",",$rgb).')';
		}

		//Return rgb(a) color string
		return $output;
}


/*-----------------------------------------------------------------------------------*/
/*	Custom CSS
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_custom_css' ) ) {

	function wpl_custom_css() {
		$wpl_css = ot_get_option('wpl_css');
		echo "<style>";
		echo $wpl_css;
		echo "</style>";
	}
	add_action( 'wp_head', 'wpl_custom_css' );

}


/*-----------------------------------------------------------------------------------*/
/*	BE Dashbord Widget
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_dashboard_widgets' ) ) {

	function wplook_dashboard_widgets() {
		global $wp_meta_boxes;
		unset(
			$wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
			$wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
		);
			wp_add_dashboard_widget( 'dashboard_custom_feed', '<a href="https://wplook.com?utm_source=Our-Themes&utm_medium=rss&utm_campaign=Benevolence">WPlook News</a>' , 'dashboard_custom_feed_output' );
	}
	add_action('wp_dashboard_setup', 'wplook_dashboard_widgets');
}


if ( ! function_exists( 'dashboard_custom_feed_output' ) ) {

	function dashboard_custom_feed_output() {
		echo '<div class="rss-widget rss-wplook">';
		wp_widget_rss_output(array(
			'url' => 'http://feeds.feedburner.com/wplook',
			'title' => '',
			'items' => 5,
			'show_summary' => 1,
			'show_author' => 0,
			'show_date' => 1
			));
		echo '</div>';
	}
}

if ( ! function_exists( 'wplook_bar_menu' ) ):

	function wplook_bar_menu() {
		global $wp_admin_bar;
		if ( !is_super_admin() || !is_admin_bar_showing() )
			return;
		$admin_dir = get_admin_url();

		$wp_admin_bar->add_menu(
			array(
				'id' => 'custom_menu',
				'title' => __( 'WPlook Panel', 'benevolence-wpl' ),
				'href' => FALSE,
				'meta' => array('title' => __( 'WPlook Options Panel', 'benevolence-wpl' ), 'class' => 'wplookpanel')
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_to',
				'parent' => 'custom_menu',
				'title' => __( 'Theme Options', 'benevolence-wpl' ),
				'href' => $admin_dir .'themes.php?page=ot-theme-options',
				'meta' => array( 'title' => __( 'Theme options', 'benevolence-wpl' ) )
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_sp',
				'parent' => 'custom_menu',
				'title' => __( 'Support', 'benevolence-wpl' ),
				'href' => 'https://wplook.com/docs/?utm_source=Support&utm_medium=link&utm_campaign=Benevolence',
				'meta' => array('title' => __( 'Support', 'benevolence-wpl' ))
			)
		);


		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_wt',
				'parent' => 'custom_menu',
				'title' => __( 'Our Themes', 'benevolence-wpl' ),
				'href' => 'https://wplook.com/wordpress/themes/?utm_source=Our-Themes&utm_medium=link&utm_campaign=Benevolence',
				'meta' => array('title' => __( 'Our themes', 'benevolence-wpl' ))
				)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_fb',
				'parent' => 'custom_menu',
				'title' => __( 'Like us on Facebook', 'benevolence-wpl' ),
				'href' => 'http://www.facebook.com/wplookthemes',
				'meta' => array('target' => 'blank', 'title' => __( 'Like us on Facebook', 'benevolence-wpl' ))
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_tw',
				'parent' => 'custom_menu',
				'title' => __( 'Follow us on Twitter', 'benevolence-wpl' ),
				'href' => 'http://twitter.com/#!/wplook',
				'meta' => array('target' => 'blank', 'title' => __( 'Follow us on Twitter', 'benevolence-wpl' ))
			)
		);
	}
	add_action('admin_bar_menu', 'wplook_bar_menu', '1000');
endif;


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for pledges
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'add_new_pledge_columns' ) ) {

	function add_new_pledge_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Transaction ID', 'benevolence-wpl' ),
			'wpl_pledge_cause' => __( 'Cause', 'benevolence-wpl' ),
			'wpl_pledge_first_name' => __( 'First Name', 'benevolence-wpl' ),
			'wpl_pledge_last_name' => __( 'Last Name', 'benevolence-wpl' ),
			'wpl_pledge_donation_amount' => __( 'Donation Amount', 'benevolence-wpl' ),
			'wpl_pledge_payment_source' => __( 'Payment Source', 'benevolence-wpl' ),
			'wpl_pledge_payment_Status' => __( 'Payment Status', 'benevolence-wpl' ),
			'date' => __( 'Date', 'benevolence-wpl' )
		);

	return $columns;

	}
	add_filter("manage_edit-post_pledges_columns", "add_new_pledge_columns");
	// Add to admin_init function

}

 if ( ! function_exists( 'wpl_pledge_columns' ) ) {

	function wpl_pledge_columns( $column, $post_id ) {

		switch ($column) {


			/*-----------------------------------------------------------
				Case: First Name
			-----------------------------------------------------------*/
			case 'wpl_pledge_cause' :

			$wpl_pledge_cause = get_post_meta( $post_id, 'wpl_pledge_cause', true );

			if ( empty( $wpl_pledge_cause ) )
				echo __( 'Unknown', 'benevolence-wpl' );

			else
				echo get_the_title( $wpl_pledge_cause );
			break;


			/*-----------------------------------------------------------
				Case: First Name
			-----------------------------------------------------------*/
			case 'wpl_pledge_first_name' :

			$wpl_pledge_first_name = get_post_meta( $post_id, 'wpl_pledge_first_name', true );

			if ( empty( $wpl_pledge_first_name ) )
				echo __( 'Unknown', 'benevolence-wpl' );

			else
				printf( __( '%s', 'benevolence-wpl' ), $wpl_pledge_first_name );

			break;

			/*-----------------------------------------------------------
				Case: Last Name
			-----------------------------------------------------------*/
			case 'wpl_pledge_last_name' :

			$wpl_pledge_last_name = get_post_meta( $post_id, 'wpl_pledge_last_name', true );

			if ( empty( $wpl_pledge_last_name ) )
				echo __( 'Unknown', 'benevolence-wpl' );

			else
				printf( __( '%s', 'benevolence-wpl' ), $wpl_pledge_last_name );

			break;


			/*-----------------------------------------------------------
				Case: Donation amount
			-----------------------------------------------------------*/
			case 'wpl_pledge_donation_amount' :

			$wpl_pledge_donation_amount = get_post_meta( $post_id, 'wpl_pledge_donation_amount', true );

			if ( empty( $wpl_pledge_donation_amount ) )
				echo __( 'Unknown', 'benevolence-wpl' );

			else
				printf( __( '%s', 'benevolence-wpl' ), $wpl_pledge_donation_amount );

			break;


			/*-----------------------------------------------------------
				Case: Payment Source
			-----------------------------------------------------------*/
			case 'wpl_pledge_payment_source' :

			$wpl_pledge_payment_source = get_post_meta( $post_id, 'wpl_pledge_payment_source', true );

			if ( empty( $wpl_pledge_payment_source ) )
				echo __( 'Unknown', 'benevolence-wpl' );

			else
				printf( __( '%s', 'benevolence-wpl' ), $wpl_pledge_payment_source );

			break;


			/*-----------------------------------------------------------
				Case: Payment Status
			-----------------------------------------------------------*/
			case 'wpl_pledge_payment_Status' :

			$wpl_pledge_payment_Status = get_post_meta( $post_id, 'wpl_pledge_payment_Status', true );

			if ( empty( $wpl_pledge_payment_Status ) )
				echo __( 'Unknown', 'benevolence-wpl' );

			else
				printf( __( '%s', 'benevolence-wpl' ), $wpl_pledge_payment_Status );

			break;

		} // end switch
	}
	add_action('manage_post_pledges_posts_custom_column', 'wpl_pledge_columns', 10, 2);

}


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Staff
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'add_new_staff_columns' ) ) {

	function add_new_staff_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Name', 'benevolence-wpl' ),
			'wpl_candidate_position' => __( 'Position', 'benevolence-wpl' ),
			'wpl_candidate_phone' => __( 'Phone', 'benevolence-wpl' ),
			'wpl_candidate_email' => __( 'Email', 'benevolence-wpl' ),
			'date' => __( 'Date', 'benevolence-wpl' )
		);

	return $columns;

	}
	add_filter("manage_edit-post_staff_columns", "add_new_staff_columns");

}


if ( ! function_exists( 'wpl_staff_columns' ) ) {

	function wpl_staff_columns( $column, $post_id ) {

		switch ($column) {


			/*-----------------------------------------------------------
				Staff: Position
			-----------------------------------------------------------*/
			case 'wpl_candidate_position' :

			$wpl_candidate_position = get_post_meta( $post_id, 'wpl_candidate_position', true );

			if ( empty( $wpl_candidate_position ) )
				echo __( 'Unknown', 'benevolence-wpl' );

			else
				printf( __( '%s', 'benevolence-wpl' ), $wpl_candidate_position );

			break;


			/*-----------------------------------------------------------
				Staff: Phone
			-----------------------------------------------------------*/
			case 'wpl_candidate_phone' :

			$wpl_candidate_phone = get_post_meta( $post_id, 'wpl_candidate_phone', true );

			if ( empty( $wpl_candidate_phone ) )
				echo __( 'Unknown', 'benevolence-wpl' );

			else
				printf( __( '%s', 'benevolence-wpl' ), $wpl_candidate_phone );

			break;


			/*-----------------------------------------------------------
				Staff: Email
			-----------------------------------------------------------*/
			case 'wpl_candidate_email' :

			$wpl_candidate_email = get_post_meta( $post_id, 'wpl_candidate_email', true );

			if ( empty( $wpl_candidate_email ) )
				echo __( 'Unknown', 'benevolence-wpl' );

			else
				printf( __( '%s', 'benevolence-wpl' ), $wpl_candidate_email );

			break;


		} // end switch
	}
	add_action('manage_post_staff_posts_custom_column', 'wpl_staff_columns', 10, 2);

}


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Events
/*-----------------------------------------------------------------------------------*/

// Add columns to the events listing page
if ( ! function_exists( 'add_new_events_columns' ) ) {

	function add_new_events_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Event Name', 'benevolence-wpl' ),
			'wpl_event_start' => __( 'Start', 'benevolence-wpl' ),
			'wpl_event_end' => __( 'End', 'benevolence-wpl' ),
			'wpl_event_address' => __( 'Address', 'benevolence-wpl' ),
		);

	return $columns;

	}
	add_filter("manage_edit-post_events_columns", "add_new_events_columns");

}

// Populate columns on the events listing page
if ( ! function_exists( 'wpl_events_columns' ) ) {

	function wpl_events_columns( $column, $post_id ) {

		switch ($column) {
			/*-----------------------------------------------------------
				Events: Start
			-----------------------------------------------------------*/
			case 'wpl_event_start' :

				$wpl_event_start = get_post_meta( $post_id, 'wpl_event_start', true );

				if ( empty( $wpl_event_start ) ) {
					echo __( 'Unknown', 'benevolence-wpl' );
				} else {
					$date_format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
					$wpl_event_start = date( $date_format, strtotime( $wpl_event_start ) );
					printf( __( '%s', 'benevolence-wpl' ), $wpl_event_start );
				}

			break;

			/*-----------------------------------------------------------
				Events: End
			-----------------------------------------------------------*/
			case 'wpl_event_end' :

			$wpl_event_end = get_post_meta( $post_id, 'wpl_event_end', true );

			if ( empty( $wpl_event_end ) ) {
				echo __( 'Unknown', 'benevolence-wpl' );
			} else {
				$date_format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
				$wpl_event_end = date( $date_format, strtotime( $wpl_event_end ) );
				printf( __( '%s', 'benevolence-wpl' ), $wpl_event_end );
			}

			break;


			/*-----------------------------------------------------------
				Events: Address
			-----------------------------------------------------------*/
			case 'wpl_event_address' :

			$wpl_event_address = get_post_meta( $post_id, 'wpl_event_address', true );

			if ( empty( $wpl_event_address ) )
				echo __( 'Unknown', 'benevolence-wpl' );

			else
				printf( __( '%s', 'benevolence-wpl' ), $wpl_event_address );

			break;


		} // end switch
	}
	add_action('manage_post_events_posts_custom_column', 'wpl_events_columns', 10, 2);

}

// Make start date and end date sortable
if ( !function_exists( 'add_new_events_sortable_columns' ) ) {

	function add_new_events_sortable_columns($columns) {
		$new_columns = array(
			'wpl_event_start' => 'wpl_event_start',
			'wpl_event_end' => 'wpl_event_end',
			'wpl_event_address' => 'wpl_event_address'
		);

		$columns = array_merge( $columns, $new_columns );

		return $columns;

	}

	add_filter("manage_edit-post_events_sortable_columns", "add_new_events_sortable_columns");

}

// Tell WordPress to sort the addresses alphabetically
if( !function_exists( 'wpl_events_columns_sorting_method_alphabetical' ) ) {

	function wpl_events_columns_sorting_method_alphabetical( $query ) {

		if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) { // && is_admin()?

			if( $orderby == 'wpl_event_address' ) {

				$query->set( 'meta_key', 'wpl_event_address' );
				$query->set( 'orderby', 'meta_value' );

			}

		}

	}

	add_filter( 'pre_get_posts', 'wpl_events_columns_sorting_method_alphabetical', 1 );
}

// Add a sorting method for start and end dates in the WP Query SQL
// This is also used in the front-end to sort upcoming events
// Source: http://wpdreamer.com/2014/04/how-to-make-your-wordpress-admin-columns-sortable/
if( !function_exists( 'wpl_events_columns_sorting_method_date' ) ) {

	function wpl_events_columns_sorting_method_date( $pieces, $query ) {

		global $wpdb;

		if ( ( $orderby = $query->get( 'orderby' ) ) ) {

			$order = strtoupper( $query->get( 'order' ) );
			if ( !( $order == 'ASC' || $order == 'DESC' ) ) {
				$order = 'ASC';
			}

			if( $orderby == 'wpl_event_start' || $orderby == 'wpl_event_end' ) {

				$pieces[ 'join' ] .= " LEFT JOIN $wpdb->postmeta wp_rd ON wp_rd.post_id = {$wpdb->posts}.ID AND wp_rd.meta_key = '$orderby'";

				$pieces[ 'orderby' ] = "CASE WHEN wp_rd.meta_value IS NULL then 1 ELSE 0 END, STR_TO_DATE( wp_rd.meta_value, '%Y-%m-%d %H:%i' ) $order, " . $pieces[ 'orderby' ];

			}

		}

		return $pieces;

	}

	add_filter( 'posts_clauses', 'wpl_events_columns_sorting_method_date', 1, 2 );
}

// Sort events by start date in ascending order by default
if( !function_exists( 'wpl_events_columns_sorting_default' ) ) {

	function wpl_events_columns_sorting_default( $vars ) {

		if( isset( $vars['post_type'] ) && $vars['post_type'] == 'post_events' ) {
			if( !isset( $vars['orderby'] ) ) {
				$new_vars = array(
					'orderby' => 'wpl_event_start',
					'order' => 'ASC'
				);

				$vars = array_merge( $vars, $new_vars );
			}
		}

		return $vars;

	}

	add_filter( 'request', 'wpl_events_columns_sorting_default' );
}


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Causes
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'add_new_causes_columns' ) ) {

	function add_new_causes_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Title', 'benevolence-wpl' ),
			'wpl_goal_amount' => __( 'Goal Amount', 'benevolence-wpl' ),
			'date' => __( 'Date', 'benevolence-wpl' )
		);

	return $columns;

	}
	add_filter("manage_edit-post_causes_columns", "add_new_causes_columns");

}


if ( ! function_exists( 'wpl_causes_columns' ) ) {

	function wpl_causes_columns( $column, $post_id ) {

		switch ($column) {

			/*-----------------------------------------------------------
				causes: Goal Amount
			-----------------------------------------------------------*/
			case 'wpl_goal_amount' :

			$wpl_goal_amount = get_post_meta( $post_id, 'wpl_goal_amount', true );

			if ( empty( $wpl_goal_amount ) )
				echo __( 'Unknown', 'benevolence-wpl' );

			else
				printf( __( '%s', 'benevolence-wpl' ), $wpl_goal_amount );

			break;

		} // end switch
	}
	add_action('manage_post_causes_posts_custom_column', 'wpl_causes_columns', 10, 2);

}


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Publications
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'add_new_publications_columns' ) ) {

	function add_new_publications_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Title', 'benevolence-wpl' ),
			'wpl_document_file_size' => __( 'File Size', 'benevolence-wpl' ),
			'date' => __( 'Date', 'benevolence-wpl' )
		);

	return $columns;

	}
	add_filter("manage_edit-post_documents_columns", "add_new_publications_columns");

}

if ( ! function_exists( 'wpl_publications_columns' ) ) {

	function wpl_publications_columns( $column, $post_id ) {

		switch ($column) {

			/*-----------------------------------------------------------
				causes: Goal Amount
			-----------------------------------------------------------*/
			case 'wpl_document_file_size' :

			$wpl_file_size = get_post_meta( $post_id, 'wpl_document_file_size', true );

			if ( empty( $wpl_file_size ) )
				echo __( 'Unknown', 'benevolence-wpl' );

			else
				printf( __( '%s', 'benevolence-wpl' ), $wpl_file_size );

			break;

		} // end switch
	}
	add_action('manage_post_documents_posts_custom_column', 'wpl_publications_columns', 10, 2);

}


/*-----------------------------------------------------------------------------------*/
/*	Buttons
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wplook_button')) {

	function wplook_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'url' => '#',
			'target' => '_self',
			'style' => 'grey',
			'size' => 'small',
			'type' => 'round'
	    ), $atts));

	   return '<a target="'.$target.'" class="buttonss '.$size.' '.$style.' '. $type .'" href="'.$url.'">' . do_shortcode($content) . '</a>';
	}
	add_shortcode('button', 'wplook_button');

}


/*-----------------------------------------------------------------------------------*/
/*	Alerts
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wplook_alert')) {

	function wplook_alert( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'style'   => 'white'
		), $atts));

		return '<div class="alert '.$style.'">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('alert', 'wplook_alert');

}


/*-----------------------------------------------------------------------------------*/
/*	Generate array for events page
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_generate_events_array' ) ) {

	// Accepts an array of arguments
	// $default_args = array(
	// 	'start_date' => 'd-m-Y',
	// 	'end_date' => 'd-m-Y',
	// 	'limit' => '',
	// 	'taxonomy' => '',
	//	'offset' => '',
	//	'sorting' => 'descending|ascending'
	// );
	function wplook_generate_events_array( $args = array() ) {

		// Set up variables
		$events = array();
		$event_id = 0;
		$current_time = current_time( 'timestamp' );
		$args['offset'] = array_key_exists( 'offset', $args ) && $args['offset'] ? $args['offset'] : 0;
		$args['limit'] = array_key_exists( 'limit', $args ) && $args['limit'] ? $args['limit'] : false;
		$args['sorting'] = array_key_exists( 'sorting', $args ) && $args['sorting'] == 'descending' ? 'descending' : 'ascending';

		// Generate start and end dates from the settings
		if( !empty( $args['start_date'] ) ) {
			$start_date_no_hour = $args['start_date'];
			$start_date_hour = $args['start_date'] . ' 00:00';
			$start_date_time = intval( date( 'U', strtotime( $start_date_hour ) ) );
		}

		if( !empty( $args['end_date'] ) ) {
			$end_date_no_hour = $args['end_date'];
			// Add a day to end the dates on midnight on the first day of the next month
			$end_date_hour = strtotime( $args['end_date'] . ' 00:00' ) + 86400;
			$end_date_hour = date( 'd-m-Y H:i', $end_date_hour );
			$end_date_time = date( 'U', strtotime( $end_date_no_hour ) ) + 86400;
		}

		// Define whether this function will need to get future events
		if( $start_date_time >= $current_time || $end_date_time >= $current_time ) {
			$future = true;
		} else {
			$future = false;
		}

		// Define whether this function will need to get past events
		if( $start_date_time < $current_time - 86400 || $end_date_time < $current_time ) {
			$past = true;
		} else {
			$past = false;
		}

		/*------------------------------------------------*/
		/*	WP Query settings
		/*------------------------------------------------*/
		// Initial settings for the WP Queries
		$query_args = array(
			'post_type' => 'post_events',
			'posts_per_page' => -1,
			'fields' => 'ids',
		);

		// Query settings: limit by taxonomy
		if( !empty( $args['taxonomy'] ) ) {
			$taxonomy_query = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'wpl_events_category',
						'field' => 'slug',
						'terms' => $args['taxonomy']
					),
				)
			);

			$query_args = array_merge( $query_args, $taxonomy_query );
		}

		// Query settings: limit by number of posts
		// if( !empty( $args['limit'] ) ) {
		// 	$limit_query = array(
		// 		'posts_per_page' => $args['limit'] * 2, // Doubling the limit seems safe, as some posts might be removed
		// 	);

		// 	$query_args = array_merge( $query_args, $limit_query );
		// }

		/*------------------------------------------------*/
		/*	WP Meta Query settings
		/*------------------------------------------------*/
		// Meta query: current events
		$query_current_meta_settings = array(
			'relation' => 'AND',
			array(
				'key'     => 'wpl_event_start',
				'value'   => date( 'Y-m-d H:i', $start_date_time ),
				'compare' => '>=',
				'type'    => 'DATETIME'
			),
			array(
				'key'     => 'wpl_event_start',
				'value'   => date( 'Y-m-d H:i', $end_date_time ),
				'compare' => '<=',
				'type'    => 'DATETIME'
			),
		);

		$query_current_settings = $query_args;
		$query_current_settings['meta_query'] = $query_current_meta_settings;

		$query_current = new WP_Query( $query_current_settings );
		$all_queries = $query_current->posts;

		// Meta query: future events
		if( $future == true ) {
			$query_future_meta_settings = array(
				array(
					'relation' => 'AND',
					array(
						'key'     => 'wpl_event_recurring_bool',
						'value'   => 'on',
						'compare' => '=',
					),
					array(
						'relation' => 'OR',
						array(
							'key'     => 'wpl_event_recurring_repeat_from',
							'value'   => $start_date_no_hour,
							'compare' => '<=',
							'type'    => 'DATE'
						),
						array(
							'key'     => 'wpl_event_recurring_repeat_until',
							'value'   => $start_date_no_hour,
							'compare' => '>=',
							'type'    => 'DATE'
						)
					)
				)
			);

			$query_future_settings = $query_args;
			$query_future_settings['meta_query'] = $query_future_meta_settings;

			$query_future = new WP_Query( $query_future_settings );
			$all_queries = array_merge( $all_queries, $query_future->posts );
		}

		// Meta query: past events
		if( $past == true ) {
			// End date or today, depending on whichever is closest
			if( $end_date_time > $current_time ) {
				$past_end_date_no_hour = date( 'd-m-Y', $current_time );
			} else {
				$past_end_date_no_hour = $end_date_no_hour;
			}

			$query_past_meta_settings = array(
				'relation' => 'AND',
				array(
					'key'     => 'wpl_event_recurring_bool',
					'value'   => 'on',
					'compare' => '=',
				),
				array(
					'key'     => 'wpl_events_past',
					'value'   => $start_date_no_hour,
					'compare' => '>=',
				),
				array(
					'key'     => 'wpl_events_past',
					'value'   => $past_end_date_no_hour,
					'compare' => '<=',
				)
			);

			$query_past_settings = $query_args;
			$query_past_settings['meta_query'] = $query_past_meta_settings;

			$query_past = new WP_Query( $query_past_settings );
			$all_queries = array_merge( $all_queries, $query_past->posts );
		}

		// Generate WP Query
		if( !empty( $all_queries ) ) {
			$final_query_args = array(
				'post__in' => $all_queries,
				'post_type' => 'post_events',
				'posts_per_page' => -1,
			);
			$query = new WP_Query( $final_query_args );
		} else {
			$query = null;
		}

		// Iterate over posts and generate a new array
		if ( $query && $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

			$pid = get_the_ID();

			// Determine whether the post is a recurring post or a standard post
			$is_recurring = get_post_meta( $pid, 'wpl_event_recurring_bool', true );

			if( $is_recurring == 'on' ) {
				$events[$event_id]['type'] = 'recurring';
			} else {
				$events[$event_id]['type'] = 'standard';
			}

			// Write object to the array
			global $post;
			$events[$event_id]['post'] = $post;

			// Put event metadata in the post for easy access
			$post_meta = get_post_meta( $pid );
			foreach( $post_meta as $key => $data ) {
				if( strpos( $key, 'wpl_event_' ) !== false ) {
					$events[$event_id][$key] = $data[0];
				}
			}

			// Give the post a local ID
			$events[$event_id]['event_id'] = $event_id;

			// Give the post a global ID
			$events[$event_id]['post_id'] = $pid;

			$event_id++;

		endwhile; wp_reset_postdata(); endif;

		// Interate over new array and add recurring posts
		foreach( $events as $event ) {

			if( $event['type'] != 'recurring' ) {
				continue;
			}

			// Initialize variables
			$repeat_until = strtotime( $event['wpl_event_recurring_repeat_until'] ) + 86400; // The specified 'until' date + 24 hours to make it the end of day, rather than the beginning of day
			$repeat_from = strtotime( $event['wpl_event_recurring_repeat_from'] ); // The 'from' date
			$repeat_every = 86400 * intval( $event['wpl_event_recurring_repeat_every'] );
			$event_length = strtotime( $event['wpl_event_end'] ) - strtotime( $event['wpl_event_start'] );
			$event_time_offset = strtotime( $event['wpl_event_start'] ) % 86400;

			if( empty( $repeat_until ) || empty( $repeat_from ) ) {
				continue;
			}

			// Future events: iterate over elements until time runs out
			if( $future == true ) {
				for( $i = $repeat_from; $i < $repeat_until && $i < $end_date_time; $i = $i + $repeat_every ) {
					$new_event = false;
					$new_event = $event;
					$new_event['type'] = 'recurring_child';
					$new_event['event_id'] = $event_id;
					$new_event['parent_event'] = $event['event_id'];
					$new_event['wpl_event_start'] = date( 'Y-m-d H:i', $i + $event_time_offset );
					$new_event['wpl_event_end'] = date( 'Y-m-d H:i', $i + $event_length + $event_time_offset );

					if( strtotime( $new_event['wpl_event_end'] ) >= $current_time ) {
						$events[$event_id] = $new_event;
					}

					$event_id++;
				}
			}

			// Deal with past events
			if( $past == true ) {

				$past_events = get_post_meta( $event['post_id'], 'wpl_events_past' );

				if( !empty( $past_events ) ) {

					foreach( $past_events as $past_event => $past_event_date ) {

						$today = date( 'd-m-Y' );

						$past_event_date = strtotime( $past_event_date );

						// Iterate over elements until time runs out
						if( $past_event_date < $repeat_until ) {

							$new_event = false;
							$new_event = $event;
							$new_event['type'] = 'recurring_past';
							$new_event['event_id'] = $event_id;
							$new_event['parent_event'] = $event['event_id'];
							$new_event['wpl_event_start'] = date( 'Y-m-d H:i', $past_event_date + $event_time_offset );
							$new_event['wpl_event_end'] = date( 'Y-m-d H:i', $past_event_date + $event_length + $event_time_offset );

							if(
								$new_event['wpl_event_start'] != $event['wpl_event_start'] && // Check if the repeated event isn't actually the original event
								$past_event_date + $event_length + $event_time_offset < current_time( 'timestamp' ) // Check if the event has happened today already
							) {
								$events[$event_id] = $new_event;
							}

							$event_id++;

						}

					}

				}

			}

		}

		// Remove everything that comes outside of the specified range
		foreach( $events as $event ) {
			if( strtotime( $event['wpl_event_start'] ) < $start_date_time || strtotime( $event['wpl_event_start'] ) > $end_date_time ) {
				unset( $events[$event['event_id']] );
			}
		}

		// Sort everything that's left in the array
		if( $args['sorting'] == 'ascending' ) {
			usort( $events, 'wplook_sort_events_array' );
		} else {
			usort( $events, 'wplook_sort_events_array_descending' );
		}

		// Count all posts
		$post_count = count( $events );

		// Remove everything that comes outside of the limit
		if( !empty( $args['limit'] ) ) {
			$events = array_slice( $events, $args['offset'], $args['limit'] );
		}

		// Put together final array
		$events_final = array(
			'post_count' => $post_count,
			'pages' => $args['limit'] ? ceil( $post_count / $args['limit'] ) : false,
			'posts' => $events,
			'sorting' => $args['sorting']
		);

		return $events_final;

	}

}


/*-----------------------------------------------------------------------------------*/
/*	Sorting function for events - sorts ascendingly by start date
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_sort_events_array' ) ) {

	function wplook_sort_events_array( $a, $b ) {

		if( $a['wpl_event_start'] == $b['wpl_event_start'] ) {
			return 0;
		}

		if( $a['wpl_event_start'] < $b['wpl_event_start'] ) {
			return -1;
		} else {
			return 1;
		}

	}

}


/*-----------------------------------------------------------------------------------*/
/*	Sorting function for events - sorts descending by start date
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_sort_events_array_descending' ) ) {

	function wplook_sort_events_array_descending( $a, $b ) {

		if( $a['wpl_event_start'] == $b['wpl_event_start'] ) {
			return 0;
		}

		if( $a['wpl_event_start'] > $b['wpl_event_start'] ) {
			return -1;
		} else {
			return 1;
		}

	}

}


/*-----------------------------------------------------------------------------------*/
/*	Generate monthly buttons/dropdown for the events page
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wpl_generate_events_monthly_buttons' ) ) {

	function wpl_generate_events_monthly_buttons( $type = 'future', $duration = 6 ) {

		// Decide whether to generate past or future buttons
		if( $type == 'past' ) {
			$operand = '-';
		} else {
			$operand = '+';
		}

		// Get start and end times from URL parameters
		if( get_query_var( 'start_time' ) && get_query_var( 'end_time' ) ) {
			$current_start_time = get_query_var( 'start_time' );
			$current_end_time = get_query_var( 'end_time' );
			$current_month = date( 'm', $current_start_time );
		} else {
			$current_start_time = intval( date( 'U' ) );
			$current_end_time = date( 'U', strtotime( date( 't-m-Y', $current_start_time ) ) ) + 86400;
			$current_month = date( 'm' );
		}

		// Get current page URL
		if( is_tax() ) {
			$page_url = get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		} else {
			$page_url = get_the_permalink();
		}
		?>

		<div class="month-selection">

		<?php
			// First month
			if( $type == 'past' ) {
				$start_time = date( 'U', strtotime( '1-' . date( 'm-Y' ) ) );
				$end_time = intval( date( 'U' ) );
			} else {
				$start_time = intval( date( 'U' ) );
				$end_time = date( 'U', strtotime( date( 't-m-Y', $start_time ) ) );
			}
			$month = date( 'm', $start_time );

			$class = '';
			if( $current_month == $month ) {
				$class .= 'current';
			}

			echo '<a href="' . esc_url( wpl_events_get_permalink( $page_url, $start_time, $end_time ) ) . '" class="item button ' . $class . '">' . __( 'This month', 'benevolence-wpl' ) . '</a>';
		?>

		<?php
			// Buttons for months 2 and 3
			for( $i = 1; $i < 3; $i++ ) {

				$start_time = date( 'U', strtotime( $operand . ' ' . $i . ' months', strtotime( date( '1-m-Y' ) ) ) );
				$end_time = date( 'U', strtotime( date( 't-m-Y', $start_time ) ) );
				$month = date( 'm', $start_time );
				$month_year = date_i18n( 'F Y', $start_time );

				$class = '';
				if( $current_month == $month ) {
					$class .= 'current';
				}

				echo '<a href="' . esc_url( wpl_events_get_permalink( $page_url, $start_time, $end_time ) ) . '" class="item button ' . $class . '">' . $month_year . '</a>';

			}
		?>

			<?php // Dropdown for the next 6 months ?>
			<?php if( $duration > 3 ) : ?>
				<select id="month-selection-dropdown" class="item">
					<option selected disabled><?php _e( 'Select a month', 'benevolence-wpl' ) ?></option>
					<?php
						for( $i = 3; $i < $duration; $i++ ) {

							if( $i == 0 ) { // First month behaves differently
								$start_time = intval( date( 'U' ) );
							} else {
								$start_time = date( 'U', strtotime( $operand . ' ' . $i . ' months', strtotime( date( '1-m-Y' ) ) ) );
							}
							$end_time = date( 'U', strtotime( date( 't-m-Y', $start_time ) ) );
							$month_year = date_i18n( 'F Y', $start_time );

							echo '<option data-url="' . esc_url( wpl_events_get_permalink( $page_url, $start_time, $end_time ) ) . '">' . $month_year . '</option>';

						}
					?>
					</select>
			<?php endif; ?>
			</div>

		<?php

	}

}

/*-----------------------------------------------------------------------------------*/
/*	Write events to a global variable, so 404s can be determined and the variable
/*  can be accessed on posts pages.
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_setup_events' ) ) {

	function wplook_setup_events() {

		global $wp_query, $wpl_events;

		// Figure out what template we're on
		$page_template = get_page_template_slug();
		$taxonomy = array_key_exists( 'taxonomy', $wp_query->query_vars ) ? $wp_query->query_vars['taxonomy'] : false;

		if( $page_template == 'template-events-past.php' ) {
			$template = 'past';
		} elseif( $page_template == 'template-events-upcoming.php' ) {
			$template = 'upcoming';
		} elseif( $taxonomy == 'wpl_events_category' ) {
			$template = 'taxonomy';
		} else { // We're not dealing with events - just quit
			return false;
		}

		// Set up and sanitize options
		$pid = get_the_ID();

		if( $template == 'taxonomy' ) {
			$duration = ot_get_option( 'wpl_events_duration' );
			$pagination = ot_get_option( 'wpl_events_pagination' );
			$events_per_page = ot_get_option( 'wpl_events_per_page' );
		} else {
			$duration = get_post_meta( $pid, 'wpl_events_duration', true );
			$pagination = get_post_meta( $pid, 'wpl_events_pagination', true );
			$events_per_page = get_post_meta( $pid, 'wpl_events_per_page', true );
		}

		$duration = ( !empty( $duration ) ? intval( $duration ) : 6 );
		$pagination = $pagination == 'on' ? true : false;
		$events_per_page = !empty( $events_per_page ) ? intval( $events_per_page ) : 10;
		$current_page = get_query_var( 'paged', 1 );
		$current_page = $current_page > 0 ? $current_page : 1;

		// Set up queries
		if( $template == 'past' ) {
			if( $pagination ) {
				$args = array(
					'start_date' => date( 'd-m-Y', current_time( 'timestamp' ) - ( $duration * 2592000 ) ),
					'end_date' => date( 'd-m-Y' ),
					'limit' => $events_per_page,
					'offset' => $events_per_page * $current_page - $events_per_page,
					'sorting' => 'descending'
				);
			} else {
				if( get_query_var( 'start_time' ) && get_query_var( 'end_time' ) ) {
					$args = array(
						'start_date' => date( 'd-m-Y', get_query_var( 'start_time' ) ),
						'end_date' => date( 'd-m-Y', get_query_var( 'end_time' ) ),
					);
				} else {
					$args = array(
						'start_date' => '01-' . date( 'm-Y' ),
						'end_date' => date( 'd-m-Y' ),
					);
				}
			}
		} elseif( $template == 'upcoming' ) {
			if( $pagination ) {
				$args = array(
					'start_date' => date( 'd-m-Y' ),
					'end_date' => date( 'd-m-Y', current_time( 'timestamp' ) + ( $duration * 2592000 ) ),
					'limit' => $events_per_page,
					'offset' => $events_per_page * $current_page - $events_per_page
				);
			} else {
				if( get_query_var( 'start_time' ) && get_query_var( 'end_time' ) ) {
					$args = array(
						'start_date' => date( 'd-m-Y', get_query_var( 'start_time' ) ),
						'end_date' => date( 'd-m-Y', get_query_var( 'end_time' ) ),
					);
				} else {
					$args = array(
						'start_date' => date( 'd-m-Y' ),
						'end_date' => date( 't-m-Y' ),
					);
				}
			}
		} elseif( $template == 'taxonomy' ) {
			if( $pagination ) {
				$args = array(
					'start_date' => date( 'd-m-Y' ),
					'end_date' => date( 'd-m-Y', current_time( 'timestamp' ) + ( $duration * 2592000 ) ),
					'limit' => $events_per_page,
					'offset' => $events_per_page * $current_page - $events_per_page,
					'taxonomy' => $wp_query->query['wpl_events_category'],
				);
			} else {
				if( get_query_var( 'start_time' ) && get_query_var( 'end_time' ) ) {
					$args = array(
						'start_date' => date( 'd-m-Y', get_query_var( 'start_time' ) ),
						'end_date' => date( 'd-m-Y', get_query_var( 'end_time' ) ),
						'taxonomy' => $wp_query->query['wpl_events_category'],
					);
				} else {
					$args = array(
						'start_date' => date( 'd-m-Y' ),
						'end_date' => date( 't-m-Y' ),
						'taxonomy' => $wp_query->query['wpl_events_category'],
					);
				}
			}
		}

		// Get events to a global
		$wpl_events = wplook_generate_events_array( $args );

	}

	add_action( 'wp', 'wplook_setup_events' );

}

/*-----------------------------------------------------------------------------------*/
/*	Generate events pagination
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wpl_events_pagination' ) ) {

	function wpl_events_pagination( $current, $maximum, $link = false ) {

		if( $maximum < 2 ) {
			return false;
		}

		$current = $current > 0 ? $current : 1;
		$maximum = $maximum > 0 ? $maximum : 1;
		$previous = $current - 1;
		$next = $current + 1;

		$link = $link ? $link : get_the_permalink();

		ob_start();

		?>

			<div class="pagination events-pagination">

				<?php if( $current > 1 ) : ?>
					<div class="section back-buttons">
						<a href="<?php echo esc_url( wpl_events_get_permalink_page( $link, 1 ) ); ?>" class="button first" title="<?php _e( 'Go to the first page', 'benevolence-wpl' ); ?>"><?php _e( 'First page', 'benevolence-wpl' ); ?></a>
						<a href="<?php echo esc_url( wpl_events_get_permalink_page( $link, $previous ) ); ?>" class="button previous" title="<?php printf( __( 'Go to the page %d', 'benevolence-wpl' ), $current - 1 ); ?>"><?php _e( 'Previous page', 'benevolence-wpl' ); ?></a>
					</div>
				<?php endif; ?>

				<div class="section pager">
					<?php printf( __( 'Page %1$s of %2$d', 'benevolence-wpl' ), $current, $maximum ); ?>
				</div>

				<?php if( $current < $maximum ) : ?>
					<div class="section next-buttons">
						<a href="<?php echo esc_url( wpl_events_get_permalink_page( $link, $next ) ); ?>" class="button next" title="<?php printf( __( 'Go to the page %d', 'benevolence-wpl' ), $current + 1 ); ?>"><?php _e( 'Next page', 'benevolence-wpl' ); ?></a>
						<a href="<?php echo esc_url( wpl_events_get_permalink_page( $link, $maximum ) ); ?>" class="button last" title="<?php _e( 'Go to the last page', 'benevolence-wpl' ); ?>"><?php _e( 'Last page', 'benevolence-wpl' ); ?></a>
					</div>
				<?php endif; ?>

			</div>

		<?php

		return ob_get_clean();

	}

}

/*-----------------------------------------------------------------------------------*/
/*	Check if events have occurred on a day and store them in an array
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wpl_store_event_if_is_occuring' ) ) {

	function wpl_store_event_if_is_occuring() {

		$today = date( 'd-m-Y' );
		$args = array(
			'start_date' => $today,
			'end_date' => $today,
		);
		$events = wplook_generate_events_array( $args );

		if( !empty( $events ) ): foreach( $events['posts'] as $event ):
			global $post;
			$post = $event['post'];

			$pid = $post->ID;
			$event_start = date( 'd-m-Y', strtotime( $event['wpl_event_start'] ) );

			if( $event_start == $today ) {

				$existing_meta = get_post_meta( $pid, 'wpl_events_past' );

				foreach( $existing_meta as $date ) {
					if( $date == $today ) {
						$matches = true;
					} else {
						$matches = false;
					}
				}

				if( $matches != true ) {
					add_post_meta( $pid, 'wpl_events_past', $today );
				}

			}
		endforeach; endif;

	}

	add_action( 'wplook_store_events_daily_hook', 'wpl_store_event_if_is_occuring', 100 );

}


/*-----------------------------------------------------------*/
/*	Allow start and end dates to be stored in the URL
/*-----------------------------------------------------------*/
if( !function_exists( 'wpl_add_events_to_query_vars' ) ) {

	function wpl_add_events_to_query_vars( $vars ) {

		$vars[] = 'event_start';
		$vars[] = 'event_end';
		$vars[] = 'start_time';
		$vars[] = 'end_time';

		return $vars;

	}

	add_filter( 'query_vars', 'wpl_add_events_to_query_vars' );

}


/*-----------------------------------------------------------*/
/*	Match events URLs and populate query variables
/*-----------------------------------------------------------*/

if( !function_exists( 'wpl_events_populate_query_vars' ) ) {

	function wpl_events_populate_query_vars() {

		// Get the events slug
		$events_slug = ot_get_option( 'wpl_events_url_rewrite' );
		$events_slug = ( !empty( $events_slug ) ? $events_slug : 'events' );

		$events_category_slug = ot_get_option( 'wpl_events_category_url_rewrite' );
		$events_category_slug = ( !empty( $events_category_slug ) ? $events_category_slug : 'events-category' );

		// Match the URL structure 'events/event-name/1467100800/1467122400' - times
		add_rewrite_rule( $events_slug . '\/([^\/]+)\/(\d{9}[^\/])\/(\d{9}[^\/])', 'index.php?post_events=$matches[1]&event_start=$matches[2]&event_end=$matches[3]', 'top' );

		// Match the URL structure 'events-category/events-category-name/1467100800/1467122400' - times
		add_rewrite_rule( $events_category_slug . '\/([^\/]+)\/(\d{9}[^\/])\/(\d{9}[^\/])', 'index.php?wpl_events_category=$matches[1]&start_time=$matches[2]&end_time=$matches[3]', 'top' );

		// Match the URL structure 'page-name/1467100800/1467122400' - upcoming/past events pages
		add_rewrite_rule( '([^\/]+)\/(\d{9}[^\/])\/(\d{9}[^\/])', 'index.php?pagename=$matches[1]&start_time=$matches[2]&end_time=$matches[3]', 'top' );

	}

	add_filter( 'init', 'wpl_events_populate_query_vars' );

}


/*-----------------------------------------------------------*/
/*	Generate rewrite rules for event categories
/*-----------------------------------------------------------*/

if( !function_exists( 'wplook_event_categories_rewrite_rules' ) ) {

	function wplook_event_categories_rewrite_rules( $rules ) {

		// Set up variables
		$taxonomy_rewrite = ot_get_option( 'wpl_events_category_url_rewrite' );
		$taxonomy_rewrite = $taxonomy_rewrite ? $taxonomy_rewrite : 'events-category';
		$taxonomy_rule = $taxonomy_rewrite . '/([^/]+)/page/?([0-9]{1,})/?$';

		// Iterate over all rules to find the events taxonomy rule and delete it
		foreach( $rules as $rule ) {
			if( $rule == $taxonomy_rule ) {
				unset( $rule );
			}
		}

		// Set replacement category rule
		$rules['events-category/([^/]+)/page/?([0-9]{1,})/?$'] = 'index.php?wpl_events_category=$matches[1]&page=$matches[2]';

	    return $rules;

	}

	add_filter( 'rewrite_rules_array', 'wplook_event_categories_rewrite_rules' );

}


/*-----------------------------------------------------------*/
/*	Check if events are available on paginated events pages
/*-----------------------------------------------------------*/

if( !function_exists( 'wplook_events_check_404' ) ) {

	function wplook_events_check_404() {

		global $wp_query, $wpl_events;

		// Check if we're dealing with events, otherwise just quit
		$page_template = get_page_template_slug();
		$taxonomy = array_key_exists( 'taxonomy', $wp_query->query_vars ) ? $wp_query->query_vars['taxonomy'] : false;

		if( $page_template != 'template-events-past.php' && $page_template != 'template-events-upcoming.php' && $taxonomy != 'wpl_events_category' ) {
			return false;
		}

		// If we are on a non-existent page, generate a 404 page
		if( get_query_var( 'page' ) > 1 && empty( $wpl_events['posts'] ) ) {
			$wp_query->set_404();
			status_header( 404 );
		}

	}

	add_action( 'template_redirect', 'wplook_events_check_404', 0 );

}


/*-----------------------------------------------------------*/
/*	Generate pretty URLs to events
/*-----------------------------------------------------------*/

if( !function_exists( 'wpl_events_get_permalink' ) ) {

	function wpl_events_get_permalink( $link, $start, $end ) {

		$permalink_structure = get_option( 'permalink_structure' );

		if( !empty( $permalink_structure ) ) { // Pretty permalinks enabled
			return trailingslashit( $link ) . $start . '/' . $end;
		} else { // Pretty permalinks disabled
			return add_query_arg( array( 'event_start' => $start, 'event_end' => $end ), $link );
		}

	}

}


/*-----------------------------------------------------------*/
/*	Generate pretty URLs to event pages
/*-----------------------------------------------------------*/

if( !function_exists( 'wpl_events_get_permalink_page' ) ) {

	function wpl_events_get_permalink_page( $link, $page ) {

		$permalink_structure = get_option( 'permalink_structure' );

		if( !empty( $permalink_structure ) ) { // Pretty permalinks enabled
			if( $page == 1 ) {
				return $link;
			} else {
				return trailingslashit( $link ) . 'page/' . $page;
			}
		} else { // Pretty permalinks disabled
			return add_query_arg( array( 'page' => $page ), $link );
		}

	}

}


/*-----------------------------------------------------------*/
/*	Confirm a singular event exists
/*-----------------------------------------------------------*/

if( !function_exists( 'wpl_events_singular_exists' ) ) {

	function wpl_events_singular_exists() {

		global $wp_query, $post;

		if(
			is_singular( 'post_events' ) &&
			get_query_var( 'event_start' ) &&
			get_query_var( 'event_end' )
		) {

			$pid = $post->ID;

			$event_start = intval( get_query_var( 'event_start' ) );
			$event_end = intval( get_query_var( 'event_end' ) );

			$args = array(
				'start_date' => date( 'd-m-Y', $event_start ),
				'end_date' => date( 'd-m-Y', $event_end )
			);

			$events = wplook_generate_events_array( $args );
			$event_exists = false;

			foreach( $events['posts'] as $key => $event ) {
				if( strtotime( $event['wpl_event_start'] ) == $event_start && strtotime( $event['wpl_event_end'] ) == $event_end ) {
					$event_exists = true;
					break;
				}
			}

			if( !$event_exists ) {
				global $wp_query;
				$wp_query->set_404();
				status_header( 404 );
			}

		}

	}

	add_action( 'template_redirect', 'wpl_events_singular_exists' );

}


/*-----------------------------------------------------------*/
/*	Flush rewrite rules on theme activation/update
/*-----------------------------------------------------------*/

if( !function_exists( 'wpl_events_flush_rewrite' ) ) {

	function wpl_events_flush_rewrite() {
		flush_rewrite_rules();
	}

	add_action( 'wplook_theme_activation', 'wpl_events_flush_rewrite' );

}


/*-----------------------------------------------------------*/
/*	Register store events daily WP Cron action on theme
/*  activation
/*-----------------------------------------------------------*/

if( !function_exists( 'wplook_store_events_daily_register' ) ) {

	function wplook_store_events_daily_register() {
		wp_schedule_event( time(), 'daily', 'wplook_store_events_daily_hook' );
	}

	add_action( 'wplook_theme_activation', 'wplook_store_events_daily_register' );

}


/*-----------------------------------------------------------*/
/*	Deregister store events daily WP Cron action on theme
/*  deactivation
/*-----------------------------------------------------------*/

if( !function_exists( 'wplook_store_events_daily_deregister' ) ) {

	function wplook_store_events_daily_deregister() {
		wp_clear_scheduled_hook( 'wplook_store_events_daily_hook' );
	}

	add_action( 'wplook_theme_deactivation', 'wplook_store_events_daily_deregister' );

}


/*-----------------------------------------------------------*/
/*	Execute actions on theme activation
/*-----------------------------------------------------------*/

if( !function_exists( 'wplook_theme_activation_functions' ) ) {

	function wplook_theme_activation_functions() {
		do_action( 'wplook_theme_activation' );
	}

	add_action( 'after_switch_theme', 'wplook_theme_activation_functions' );

}


/*-----------------------------------------------------------*/
/*	Execute actions on theme deactivation
/*-----------------------------------------------------------*/

if( !function_exists( 'wplook_theme_deactivation_functions' ) ) {

	function wplook_theme_deactivation_functions() {
		do_action( 'wplook_theme_deactivation' );
	}

	add_action( 'switch_theme', 'wplook_theme_deactivation_functions' );

}


/*-----------------------------------------------------------*/
/*	Check theme version and execute update procedures
/*-----------------------------------------------------------*/

if( !function_exists( 'wplook_check_theme_version' ) ) {

	function wplook_check_theme_version() {

		$option_name = 'wplook_benevolence_theme_version';
		$theme_directory = 'benevolence-wpl';

		if( get_option( $option_name ) == false ) {
			update_option( $option_name, wp_get_theme( $theme_directory )->Version );
			return;
		}

		if( version_compare( wp_get_theme( $theme_directory )->Version, get_option( $option_name ) ) == 1 ) {
			update_option( $option_name, wp_get_theme( $theme_directory )->Version );
			do_action( 'wplook_theme_deactivation' );
			do_action( 'wplook_theme_activation' );
		}

	}

	add_action( 'init', 'wplook_check_theme_version' );

}

/*-----------------------------------------------------------*/
/*	Get events using AJAX in FullCalendar
/*-----------------------------------------------------------*/

if( !function_exists( 'wplook_events_fullcalendar' ) ) {

	function wplook_events_fullcalendar() {

		$args = array(
			'start_date' => date( 'd-m-Y', strtotime( $_GET['start'] ) ),
			'end_date' => date( 'd-m-Y', strtotime( $_GET['end'] ) ),
		);

		$events = wplook_generate_events_array( $args );
		$calendar_events = array();

		if( !empty( $events['posts'] ) ) {
			foreach( $events['posts'] as $event ) {
				$pid = $event['post_id'];

				$event_start = $event['wpl_event_start'];
				$event_end = $event['wpl_event_end'];

				if( !empty( $event_start ) ) {
					$calendar_events[] = array(
						'id' => $pid,
						'title' => $event['post']->post_title,
						'start' => date_i18n( "Y-m-d", strtotime($event_start) ) . "T" . date_i18n( "H:i", strtotime($event_start) ),
						'end' => date_i18n( "Y-m-d", strtotime($event_end) ) . "T" . date_i18n( "H:i", strtotime($event_end) ),
						'url' => esc_url( wpl_events_get_permalink( get_the_permalink( $pid ), strtotime( $event_start ), strtotime( $event_end ) ) ),
						'color' => get_post_meta( $pid, 'wpl_single_event_color', true ),
					);
				}
			}
		}

		echo wp_json_encode( $calendar_events );

		wp_die();

	}

	add_action( 'wp_ajax_wplook_events_fullcalendar', 'wplook_events_fullcalendar' );
	add_action( 'wp_ajax_nopriv_wplook_events_fullcalendar', 'wplook_events_fullcalendar' );

}

/*-----------------------------------------------------------------------------------*/
/*	Generate a dropdown list of posts
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_dropdown_posts' ) ) {

	function wplook_dropdown_posts( $options, $widget_context ) {

		$defaults = array(
			'get_posts_args' => array(),
			'field_name' => '',
			'selected' => '',
			'first' => array(
				'name' => '',
				'value' => ''
			),
			'error' => ''
		);

		$options = array_merge( $defaults, $options );

		$posts = get_posts( $options['get_posts_args'] );

		?>

		<?php if( $posts || $options['first'] ) : ?>

			<select id="<?php echo $widget_context->get_field_id( $options['field_name'] ); ?>" name="<?php echo $widget_context->get_field_name( $options['field_name'] ); ?>">
				<?php if( $options['first'] ) : ?>
					<option value="<?php echo esc_attr( $options['first']['value'] ); ?>" <?php selected( $options['selected'], $options['first']['value'] ); ?>><?php echo esc_attr( $options['first']['name'] ); ?></option>
				<?php endif; ?>

				<?php foreach ($posts as $post) : ?>
					<option value="<?php echo $post->ID; ?>" <?php selected( $options['selected'], $post->ID ); ?>><?php echo $post->post_title; ?></option>
				<?php endforeach; ?>
			</select>

		<?php else: ?>

			<?php if( $options['error'] ) :
				echo esc_attr( $options['error'] );
			else: ?>
				<p><?php _e( 'No posts available.', 'benevolence-wpl' ); ?></p>
			<?php endif; ?>

		<?php endif; ?>

		<?php

	}

}

/*-----------------------------------------------------------------------------------*/
/*	Get a total amount and sum of pledges
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'wplook_get_pledges_totals' ) ) {

	function wplook_get_pledges_totals( $cause_id = false ) {

		if( $cause_id == false ) {
			global $post;
			$cause_id = $post->ID;
		}

		$args = array(
			'post_type' => 'post_pledges',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'wpl_pledge_payment_Status',
					'value' => 'Completed',
					'compare' => 'IN',
				),
				array(
					'key' => 'wpl_pledge_cause',
					'value' => $cause_id,
				)
			)
		);

		$query = new WP_Query( $args );

		$donations_number = 0;
		$donations_total = 0;

		if( $query->have_posts() ) :
			while( $query->have_posts() ) : $query->the_post();
				$pid = get_the_ID();
				$donations_number++;
				$donations_total += get_post_meta( $pid, 'wpl_pledge_donation_amount', true );
			endwhile; wp_reset_postdata();
		endif; wp_reset_query();

		return array(
			'number' => $donations_number,
			'total' => $donations_total,
		);

	}

}


if( !function_exists( 'wplook_render_footer_content' ) ) {

	/**
	 * Echo footer content, filtering it for strings like {{year}}.
	 *
	 * @since 1.1.10
	 */
	function wplook_render_footer_content() {

		// Set up footer content
		$footer_content = ot_get_option( 'wpl_copyright' );

		if( !$footer_content ) {
			return;
		}

		// Set up replacement values
		$strings = array(
			'year' => date( 'Y' ),
		);

		$strings = apply_filters( 'wplook_footer_replacements', $strings );

		// Set up arrays for str_replace
		$searches = array();
		$replacements = array();

		foreach( $strings as $search => $replace ) {
			if( !$search && !$replace ) {
				continue;
			}

			$searches[] = '{{' . $search . '}}';
			$replacements[] = $replace;
		}

		// Perform string replacement
		$footer_content = str_replace( $searches, $replacements, $footer_content );

		// Apply filters to final string
		$footer_content = apply_filters( 'wplook_footer_content', $footer_content );

		// Output footer content
		echo $footer_content;

	}

}


if( !function_exists( 'wplook_footer_google_analytics' ) ) {

	/**
	 * Print the Google Analytics code from Theme Options in the footer.
	 *
	 * @since 1.1.10
	 */
	function wplook_footer_google_analytics() {

		$code = ot_get_option( 'wpl_google_analytics_tracking_code' );

		if( $code ) {
			echo $code . "\n";
		}

	}

	add_action( 'wp_footer', 'wplook_footer_google_analytics' );

}



?>
