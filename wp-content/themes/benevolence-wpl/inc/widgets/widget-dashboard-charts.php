<?php
/**
 * Dashboard Widget
 *
 * @package WordPress
 * @subpackage Benevolence
 * @since Benevolence 1.1.7
 * @version 4.6
*/
?>
<?php
/*------------------------------------------------------------
	The widget show a chart for all causes in time.
============================================================*/
/*------------------------------------------------------------
	Function that outputs the contents of the dashboard widget
============================================================*/
function wpl_dashboard_widget_chart_all_causes_callback( $post, $callback_args ) {

	// get saved data
	if( !$wpl_dashboard_widget_chart_all_causes_options = get_option( 'wpl_dashboard_widget_chart_all_causes_options' ) )
		$wpl_dashboard_widget_chart_all_causes_options = array( );

	// check if saved data contains content
	$wpl_stats_by = isset( $wpl_dashboard_widget_chart_all_causes_options['stats_by'] ) ? $wpl_dashboard_widget_chart_all_causes_options['stats_by'] : false;

	// custom content saved by control callback, modify output
	if( $wpl_stats_by ) {
			$output = wpl_data_chart_preparation($wpl_stats_by);
	} else {
		$output = wpl_data_chart_preparation( 'week' );
	}

	echo $output;
	echo "<canvas id='stats_by_time' width='400' height='300' class='stats_by_class_wrap'></canvas>";
}

/*------------------------------------------------------------
	Control Callback for settings
============================================================*/
function wpl_dashboard_widget_chart_all_causes_control_callback() {
	// get saved data
	if( !$wpl_dashboard_widget_chart_all_causes_options = get_option( 'wpl_dashboard_widget_chart_all_causes_options' ) ){
		$wpl_dashboard_widget_chart_all_causes_options = array( );
	}

	// process update
	if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['wpl_dashboard_widget_chart_all_causes_options'] ) ) {
		// minor validation
		$wpl_dashboard_widget_chart_all_causes_options['stats_by'] = $_POST['wpl_dashboard_widget_chart_all_causes_options']['stats_by'];
		// save update
		update_option( 'wpl_dashboard_widget_chart_all_causes_options', $wpl_dashboard_widget_chart_all_causes_options );
	}

	// set defaults
	if( !isset( $wpl_dashboard_widget_chart_all_causes_options['stats_by'] ) ){
		$wpl_dashboard_widget_chart_all_causes_options['stats_by'] = 'days';
	} ?>

	<p>
		<label for="stats_by"><?php _e( 'Chart stats for the last' , 'benevolence-wpl' ); ?></label>
		<select name="wpl_dashboard_widget_chart_all_causes_options[stats_by]" id="stats_by">
			<?php
				$periods   = array(
					'week' => __( 'Last week', 'benevolence-wpl' ),
					'month' => __( 'Last month', 'benevolence-wpl' ),
					'year' => __( 'Last year', 'benevolence-wpl' ),
					'decade' => __( 'Last decade', 'benevolence-wpl' ),
				);
				foreach ( $periods as $val => $label ) { ?>
					<option value="<?php echo $val; ?>"<?php selected( $val, $wpl_dashboard_widget_chart_all_causes_options['stats_by'] ); ?>><?php echo esc_html( $label ); ?></option>
			<?php } ?>
		</select>
	</p>
	<?php
}

/*------------------------------------------------------------
	Function used in the action hook
============================================================*/
function wpl_add_dashboard_widget_chart_all_causes() {
	wp_add_dashboard_widget('wpl_dashboard_widget_chart_all_causes', __('Donations for all Causes', 'benevolence-wpl'), 'wpl_dashboard_widget_chart_all_causes_callback', 'wpl_dashboard_widget_chart_all_causes_control_callback');
}

/*------------------------------------------------------------
	Register the new dashboard widget with the 'wp_dashboard_setup' action
============================================================*/
add_action('wp_dashboard_setup', 'wpl_add_dashboard_widget_chart_all_causes' );

/*------------------------------------------------------------
	Chart preparation for donation by time
============================================================*/
function wpl_data_chart_preparation( $stats_by ) {
	//Default variables
	global $wpdb;
	$today  = current_time( 'timestamp' );
	$xaxe_list = $yaxe_list = '';
	$time = $time_query = $amounts_arr = array();
	$meta_key = 'wpl_pledge_donation_amount';
	$post_pledges = 'post_pledges';
	$post_pledges_arrg = array(
		'post_type' => $post_pledges,
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'no_found_rows' => true,
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false,
		'cache_results' => false,
		'fields' => 'ids'
	);


	if ( $stats_by == "week" ) {
		//For 7 days
		//Default variables for days
		$k = 7; //number of days
		$cache_time = 6 * HOUR_IN_SECONDS;

		for ( $i = 0; $i < $k; $i++ ) {
			array_push( $time, date_i18n( 'j M', strtotime( "-$i day", $today ) ) );
			$time_query[] = array(
				date( 'j', strtotime( "-$i day", $today ) ),
				date( 'm', strtotime( "-$i day", $today ) ),
				date( 'Y', strtotime( "-$i day", $today ) ),
			);
		}
		$xaxe_list = "datapleges.labels = ".json_encode( array_reverse( $time ) ).";";
		$time_query = array_reverse( $time_query );


		foreach ( $time_query as $value ) {
			$amounts = 0;
			$post_ids = 0;
			$post_pledges_arrg_plus =  array( 'date_query' => array(
				array(
					'year'  => $value[2],
					'month' => $value[1],
					'day' => $value[0],
				),
			) );
			// Check for transient. If none, then execute WP_Query
			if ( false === ( $the_query = get_transient( 'wpl_chart_all_causes_'.$stats_by.'_'.$value[0].'_'.$value[1].'_'.$value[2] ) ) ) {
				$the_query = new WP_Query( array_merge( $post_pledges_arrg, $post_pledges_arrg_plus ) );
				// Put the results in a transient.
				set_transient( 'wpl_chart_all_causes_'.$stats_by.'_'.$value[0].'_'.$value[1].'_'.$value[2], $the_query, $cache_time );
			}

			// The Loop
			if ( !empty( $the_query->posts ) ) {
				$post_ids = implode( ',', $the_query->posts );
			}

			if ( false === ( $the_query_sql = get_transient( 'wpl_chart_all_causes_sum_'.$stats_by.'_'.$value[0].'_'.$value[1].'_'.$value[2] ) ) ) {
				$the_query_sql = $wpdb->get_var( $wpdb->prepare(
					"
						SELECT SUM(meta_value)
						FROM $wpdb->postmeta
						WHERE post_id IN ($post_ids)
						AND meta_key = %s
					",
					$meta_key
				) );
				// Put the results in a transient.
				set_transient( 'wpl_chart_all_causes_sum_'.$stats_by.'_'.$value[0].'_'.$value[1].'_'.$value[2], $the_query_sql, $cache_time );
			}

			if( $the_query_sql == null ) {
				$the_query_sql = '0';
			}
			array_push( $amounts_arr, $the_query_sql );

		}
		$yaxe_list = "datapleges.datasets[0].data = ".json_encode( $amounts_arr ).";";

	} elseif ( $stats_by == "month" ) {
		//For 12 weeks
		//Default variables for weeks
		$k = 30; //number of days
		$cache_time = 6 * HOUR_IN_SECONDS;

		for ( $i = 0; $i < $k; $i++ ) {
			array_push( $time, date_i18n( 'j M', strtotime( "-$i day", $today ) ) );
			$time_query[] = array(
				date( 'j', strtotime( "-$i day", $today ) ),
				date( 'm', strtotime( "-$i day", $today ) ),
				date( 'Y', strtotime( "-$i day", $today ) ),
			);
		}
		$xaxe_list = "datapleges.labels = ".json_encode( array_reverse( $time ) ).";";
		$time_query = array_reverse( $time_query );


		foreach ( $time_query as $value ) {
			$amounts = 0;
			$post_ids = 0;
			$post_pledges_arrg_plus =  array( 'date_query' => array(
				array(
					'year'  => $value[2],
					'month' => $value[1],
					'day' => $value[0],
				),
			) );
			// Check for transient. If none, then execute WP_Query
			if ( false === ( $the_query = get_transient( 'wpl_chart_all_causes_'.$stats_by.'_'.$value[0].'_'.$value[1].'_'.$value[2] ) ) ) {
				$the_query = new WP_Query( array_merge( $post_pledges_arrg, $post_pledges_arrg_plus ) );
				// Put the results in a transient.
				set_transient( 'wpl_chart_all_causes_'.$stats_by.'_'.$value[0].'_'.$value[1].'_'.$value[2], $the_query, $cache_time );
			}

			// The Loop
			if ( !empty( $the_query->posts ) ) {
				$post_ids = implode( ',', $the_query->posts );
			}

			if ( false === ( $the_query_sql = get_transient( 'wpl_chart_all_causes_sum_'.$stats_by.'_'.$value[0].'_'.$value[1].'_'.$value[2] ) ) ) {
				$the_query_sql = $wpdb->get_var( $wpdb->prepare(
					"
						SELECT SUM(meta_value)
						FROM $wpdb->postmeta
						WHERE post_id IN ($post_ids)
						AND meta_key = %s
					",
					$meta_key
				) );
				// Put the results in a transient.
				set_transient( 'wpl_chart_all_causes_sum_'.$stats_by.'_'.$value[0].'_'.$value[1].'_'.$value[2], $the_query_sql, $cache_time );
			}

			if( $the_query_sql == null ) {
				$the_query_sql = '0';
			}
			array_push( $amounts_arr, $the_query_sql );

		}
		$yaxe_list = "datapleges.datasets[0].data = ".json_encode( $amounts_arr ).";";

	} elseif ( $stats_by == "year" ) {
		//For 12 months
		//Default variables for months
		$k = 12; //number of months
		$cache_time = 48 * HOUR_IN_SECONDS;

		for ( $i = 0; $i < $k; $i++ ) {
			array_push( $time, date_i18n( 'M Y', strtotime( "-$i month", $today ) ) );
			$time_query[] = array(
				date( 'm', strtotime( "-$i month", $today ) ),
				date( 'Y', strtotime( "-$i month", $today ) ),
			);
		}
		$xaxe_list = "datapleges.labels = ".json_encode( array_reverse( $time ) ).";";
		$time_query = array_reverse( $time_query );

		//SUM
		foreach ( $time_query as $value ) {
			$amounts = 0;
			$post_ids = 0;
			$post_pledges_arrg_plus =  array(
				'date_query' => array(
					array(
						'year'  => $value[1],
						'month' => $value[0],
					),
				)
			);
			// Check for transient. If none, then execute WP_Query
			if ( false === ( $the_query = get_transient( 'wpl_chart_all_causes_'.$stats_by.'_'.$value[0].'_'.$value[1] ) ) ) {
				$the_query = new WP_Query( array_merge( $post_pledges_arrg, $post_pledges_arrg_plus ) );
				// Put the results in a transient.
				set_transient( 'wpl_chart_all_causes_'.$stats_by.'_'.$value[0].'_'.$value[1], $the_query, $cache_time );
			}

			// The Loop

			if ( !empty( $the_query->posts ) ) {
				$post_ids = implode( ',', $the_query->posts );
			}

			if ( false === ( $the_query_sql = get_transient( 'wpl_chart_all_causes_sum_'.$stats_by.'_'.$value[0].'_'.$value[1] ) ) ) {
				$the_query_sql = $wpdb->get_var( $wpdb->prepare(
					"
						SELECT SUM(meta_value)
						FROM $wpdb->postmeta
						WHERE post_id IN ($post_ids)
						AND meta_key = %s
					",
					$meta_key
				) );
				// Put the results in a transient.
				set_transient( 'wpl_chart_all_causes_sum_'.$stats_by.'_'.$value[0].'_'.$value[1], $the_query_sql, $cache_time );
			}

			if( $the_query_sql == null ) {
				$the_query_sql = '0';
			}
			array_push( $amounts_arr, $the_query_sql );

		}

		$yaxe_list = "datapleges.datasets[0].data = ".json_encode( $amounts_arr ).";";

	} elseif ($stats_by == "decade" ) {
		//For 10 years
		//Default variables for years
		$k = 10; //number of years
		$cache_time = 7 * DAY_IN_SECONDS;
		for ( $i = 0; $i < $k; $i++ ) {
			array_push( $time, date_i18n( 'Y', strtotime( "-$i year", $today ) ) );
			$time_query[] = array(
				date( 'Y', strtotime( "-$i year", $today ) ),
			);
		}
		$xaxe_list = "datapleges.labels = ".json_encode( array_reverse( $time ) ).";";
		$time_query = array_reverse( $time_query );


		//SUM
		foreach ($time_query as $value) {
			$amounts = 0;
			$post_ids = 0;
			$post_pledges_arrg_plus =  array(
				'date_query' => array(
					array(
						'year'  => $value[0],
					),
				)
			);
			// Check for transient. If none, then execute WP_Query
			if ( false === ( $the_query = get_transient( 'wpl_chart_all_causes_'.$stats_by.'_'.$value[0] ) ) ) {
				$the_query = new WP_Query( array_merge( $post_pledges_arrg, $post_pledges_arrg_plus ) );
				// Put the results in a transient.
				set_transient( 'wpl_chart_all_causes_'.$stats_by.'_'.$value[0], $the_query, $cache_time );
			}

			if ( !empty( $the_query->posts ) ) {
				$post_ids = implode( ',', $the_query->posts );
			}

			if ( false === ( $the_query_sql = get_transient( 'wpl_chart_all_causes_sum_'.$stats_by.'_'.$value[0] ) ) ) {
				$the_query_sql = $wpdb->get_var( $wpdb->prepare(
					"
						SELECT SUM(meta_value)
						FROM $wpdb->postmeta
						WHERE post_id IN ($post_ids)
						AND meta_key = %s
					",
					$meta_key
				) );
				// Put the results in a transient.
				set_transient( 'wpl_chart_all_causes_sum_'.$stats_by.'_'.$value[0], $the_query_sql, $cache_time );
			}
			if( $the_query_sql == null ) {
				$the_query_sql = '0';
			}
			array_push( $amounts_arr, $the_query_sql );
		}

		$yaxe_list = "datapleges.datasets[0].data = ".json_encode( $amounts_arr ).";";
	} else {
		//default
	}
	$title_list_top = (array_sum($amounts_arr)) ? "datapleges.datasets[0].label = 'Donations (".array_sum($amounts_arr).' '.ot_get_option('wpl_curency_code').")';" : "datapleges.datasets[0].label = 'Sorry, No data available';";

	$data = "<script type='text/javascript'>";
	$data .= $title_list_top;
	$data .= $xaxe_list;
	$data .= $yaxe_list;
	$data .= "</script>";
	return $data;
}



/*------------------------------------------------------------
	The widget show a chart of top causes in time.
	======================================================
============================================================*/

// Function that outputs the contents of the dashboard widget
function wpl_dashboard_widget_chart_top_causes_callback( $post, $callback_args ) {

	// get saved data
	if( !$wpl_dashboard_widget_chart_top_causes_options = get_option( 'wpl_dashboard_widget_chart_top_causes_options' ) ){
		$wpl_dashboard_widget_chart_top_causes_options = array( );
	}

	// check if saved data contains content
	$wpl_top_by = isset( $wpl_dashboard_widget_chart_top_causes_options['top_by'] ) ? $wpl_dashboard_widget_chart_top_causes_options['top_by'] : false;
	$wpl_top_number = isset( $wpl_dashboard_widget_chart_top_causes_options['top_number'] ) ? $wpl_dashboard_widget_chart_top_causes_options['top_number'] : false;

	// custom content saved by control callback, modify output
	if( $wpl_top_by AND $wpl_top_number ) {
		   $output = wpl_data_chart_preparation_top( $wpl_top_by, $wpl_top_number );
	} else {
		$output = wpl_data_chart_preparation_top( 'day', '3' );
	}

	echo $output;
	echo "<canvas id='top_by_time' width='400' height='300' class='top_by_class_wrap'></canvas>";
}

function wpl_data_chart_preparation_top( $top_by, $top_number ) {
	global $wpdb;
	$today  = current_time( 'timestamp' );
	$this_day  = date('j', $today);
	$this_week  = date('W', $today);
	$this_month  = date('m', $today);
	$this_year  = date('Y', $today);
	$xaxe_list_top = $yaxe_list_top = '';
	$sum_value = $title = $args_pledges = $amounts_arr = array();
	$post_ids = $j = 0;
	$meta_key = 'wpl_pledge_donation_amount';
	$post_pledges = 'post_pledges';
	$cache_time = 1 * HOUR_IN_SECONDS;
	$cache_time_by_top = 6 * HOUR_IN_SECONDS;
	$args_pledges_init = array(
		'meta_key'     => 'wpl_pledge_cause',
		'post_type' => $post_pledges,
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'no_found_rows' => true,
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false,
		'cache_results' => false,
		'fields' => 'ids',
	);
	$args_cause = array(
		'post_type' => 'post_causes',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'no_found_rows' => true,
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false,
		'cache_results' => false,
		'fields' => 'ids'
	);
	$color_bg = array_slice( array(
		'rgba(255,99,132,1)',
		'rgba(54,162,235,1)',
		'rgba(255,206,86,1)',
		'rgba(122,208,58,1)',
		'rgba(77,83,96,1)',
		'rgba(192,69,153,1)',
		'rgba(76,195,184,1)',
		'rgba(233,228,76,1)',
		'rgba(195,161,72,1)',
		'rgba(186,194,74,1)'), 0, $top_number );
	$color_bg_h = array_slice( array(
		'rgba(255,99,132,0.5)',
		'rgba(54,162,235,0.5)',
		'rgba(255,206,86,0.5)',
		'rgba(122,208,58,0.5)',
		'rgba(77,83,96,0.5)',
		'rgba(192,69,153,0.5)',
		'rgba(76,195,184,0.5)',
		'rgba(233,228,76,0.5)',
		'rgba(195,161,72,0.5)',
		'rgba(186,194,74,0.5)'), 0, $top_number );

	if ($top_by == "day") {
		$args_pledges = array(
			'date_query' => array(
				array(
					 'year'  => $this_year,
					 'month'  => $this_month,
					 'day'  => $this_day
				 )
			)
		);
	} elseif ($top_by == "week" ) {
		$cache_time_by_top = 12 * HOUR_IN_SECONDS;
		$args_pledges = array(
			'date_query' => array(
				array(
					'year'  => $this_year,
					'week'  => $this_week,
				)
			)
		);
	} elseif ($top_by == "month" ) {
		$cache_time_by_top = 24 * HOUR_IN_SECONDS;
		$args_pledges = array(
			'date_query' => array(
				array(
					 'year'  => $this_year,
					 'month'  => $this_month,
				 )
			)
		);
	} elseif ($top_by == "year" ) {
		$cache_time_by_top = 48 * HOUR_IN_SECONDS;
		$args_pledges = array(
			'date_query' => array(
				array(
					 'year'  => $this_year
				 )
			)
		);
	} elseif ($top_by == "all" ) {
		$cache_time_by_top = 96 * HOUR_IN_SECONDS;
	} else {}

	if ( false === ( $query = get_transient( 'wpl_chart_top_causes_ids_'.$top_by  ) ) ) {
		$query = new WP_Query( $args_cause );
		set_transient( 'wpl_chart_top_causes_ids_'.$top_by, $query, HOUR_IN_SECONDS );
	}

	foreach ( $query->posts as $cause_id ) {
		$args_pledges_id = array( 'meta_value'   => $cause_id, );
		$args_pledges_final = array_merge( $args_pledges_init, $args_pledges, $args_pledges_id );

		if ( false === ( $the_query = get_transient( 'wpl_chart_top_pledges_id_'.$cause_id.'_by_'.$top_by  ) ) ) {
			$the_query = new WP_Query( $args_pledges_final );
			set_transient( 'wpl_chart_top_pledges_id_'.$cause_id.'_by_'.$top_by, $the_query, $cache_time_by_top );
		}

		if ( !empty( $the_query->posts ) ) {
			$post_ids = implode( ',', $the_query->posts );
		} else {
			$post_ids = 0;
		}

		if ( false === ( $the_query_sql = get_transient( 'wpl_chart_top_pledges_sum_'.$cause_id.'_by_'.$top_by  ) ) ) {
			$the_query_sql = $wpdb->get_var( $wpdb->prepare(
				"
					SELECT SUM(meta_value)
					FROM $wpdb->postmeta
					WHERE post_id IN ($post_ids)
					AND meta_key = %s
				",
				$meta_key
			) );
			set_transient( 'wpl_chart_top_pledges_sum_'.$cause_id.'_by_'.$top_by, $the_query_sql, $cache_time_by_top );
		}

		if( $the_query_sql == null OR $the_query_sql == '' ) {
			$the_query_sql = '0';
		}
		array_push( $amounts_arr, array('sumpledges' => (int)$the_query_sql, 'causeid' => $cause_id ));
	}


	foreach ($amounts_arr as $key => $row) {
	    $sumpledges[$key] = $row['sumpledges'];
	    $causeid[$key]  = $row['causeid'];
	}

// Sort the data with causeid descending, sumpledges ascending
// Add $data as the last parameter, to sort by the common key
if (isset($sumpledges)){
	array_multisort($sumpledges, SORT_DESC, $causeid, SORT_ASC,  $amounts_arr);
}


	$amounts_arr = array_slice( $amounts_arr, 0, $top_number );
	foreach ( $amounts_arr as $key => $value ) {
		array_push( $sum_value, $value['sumpledges'] );
		array_push( $title, html_entity_decode( get_the_title( $value['causeid'] ) ) );

	}
	$title_list_top = (array_sum($sum_value)) ? "datatopcausesoptions.options.title.text = 'Donations (".array_sum($sum_value).' '.ot_get_option('wpl_curency_code').")';" : "datatopcausesoptions.options.title.text = 'Sorry, No data available';";
	$backgroundColor = "datatopcauses.datasets[0].backgroundColor = ".wp_json_encode( $color_bg ).";";
	$hoverBackgroundColor = "datatopcauses.datasets[0].hoverBackgroundColor = ".wp_json_encode( $color_bg_h ).";";
	$xaxe_list_top = "datatopcauses.labels = ".wp_json_encode( $title ).";";
	$yaxe_list_top = "datatopcauses.datasets[0].data = ".wp_json_encode( $sum_value ).";";

	$data = "<script type='text/javascript'>";
	$data .= $title_list_top;
	$data .= $backgroundColor;
	$data .= $hoverBackgroundColor;
	$data .= $xaxe_list_top;
	$data .= $yaxe_list_top;
	$data .= "</script>";
	return $data;
}

/*------------------------------------------------------------
	Control Callback for top causes
============================================================*/
function wpl_dashboard_widget_chart_top_causes_control_callback() {
	// get saved data
	if( !$wpl_dashboard_widget_chart_top_causes_options = get_option( 'wpl_dashboard_widget_chart_top_causes_options' ) ) {
		$wpl_dashboard_widget_chart_top_causes_options = array( );
	}

	// process update
	if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['wpl_dashboard_widget_chart_top_causes_options'] ) ) {
		// minor validation
		$wpl_dashboard_widget_chart_top_causes_options['top_by'] = $_POST['wpl_dashboard_widget_chart_top_causes_options']['top_by'];
		$wpl_dashboard_widget_chart_top_causes_options['top_number'] = $_POST['wpl_dashboard_widget_chart_top_causes_options']['top_number'];
		// save update
		update_option( 'wpl_dashboard_widget_chart_top_causes_options', $wpl_dashboard_widget_chart_top_causes_options );
	}

	// set defaults
	if( !isset( $wpl_dashboard_widget_chart_top_causes_options['top_by'] ) ) {
		$wpl_dashboard_widget_chart_top_causes_options['top_by'] = 'day';
	}
	if( !isset( $wpl_dashboard_widget_chart_top_causes_options['top_number'] ) ) {
		$wpl_dashboard_widget_chart_top_causes_options['top_number'] = '3';
	} ?>

	<p>
		<label for="top_by"><?php _e( 'Chart stats for: ' , 'benevolence-wpl' ); ?></label>
		<select name="wpl_dashboard_widget_chart_top_causes_options[top_by]" id="top_by">
			<?php
				$periods   = array(
				'day' => __( 'Today', 'benevolence-wpl' ),
				'week' => __( 'This week', 'benevolence-wpl' ),
				'month' => __( 'This month', 'benevolence-wpl' ),
				'year' => __( 'This year', 'benevolence-wpl' ),
				'all' => __( 'All time', 'benevolence-wpl' ),
				);
				foreach ( $periods as $val => $label ) { ?>
					<option value="<?php echo $val; ?>"<?php selected( $val, $wpl_dashboard_widget_chart_top_causes_options['top_by'] ); ?>><?php echo esc_html( $label ); ?></option>
			<?php } ?>
		</select>
	</p>

	<p>
		<label for="top_number"><?php _e( 'Show me please: ' , 'benevolence-wpl' ); ?></label>
		<select name="wpl_dashboard_widget_chart_top_causes_options[top_number]" id="top_number">
			<?php
				$periods   = array(
				'3' => __( 'Top 3', 'benevolence-wpl' ),
				'5' => __( 'Top 5', 'benevolence-wpl' ),
				'10' => __( 'Top 10', 'benevolence-wpl' ),
			);
			foreach ( $periods as $val => $label ) { ?>
				<option value="<?php echo $val; ?>"<?php selected( $val, $wpl_dashboard_widget_chart_top_causes_options['top_number'] ); ?>><?php echo esc_html( $label ); ?></option>
			<?php } ?>
		</select>
	</p>

	<?php
}

/*------------------------------------------------------------
	Function used in the action hook
============================================================*/
function wpl_add_dashboard_widget_chart_top_causes() {
	wp_add_dashboard_widget('wpl_dashboard_widget_chart_top_causes', __('Donations for Top Causes', 'benevolence-wpl'), 'wpl_dashboard_widget_chart_top_causes_callback', 'wpl_dashboard_widget_chart_top_causes_control_callback');
}

/*------------------------------------------------------------
	Register the new dashboard widget with the 'wp_dashboard_setup' action
============================================================*/
add_action('wp_dashboard_setup', 'wpl_add_dashboard_widget_chart_top_causes' );




/*------------------------------------------------------------
	The widget show a chart of one cause in time.
	======================================================
============================================================*/

// Function that outputs the contents of the dashboard widget
function wpl_dashboard_widget_chart_cause_callback( $post, $callback_args ) {

	// get saved data
	if( !$wpl_dashboard_widget_chart_cause_options = get_option( 'wpl_dashboard_widget_chart_cause_options' ) )
		$wpl_dashboard_widget_chart_cause_options = array( );

	// check if saved data contains content
	$wpl_top_by = isset( $wpl_dashboard_widget_chart_cause_options['top_by'] ) ? $wpl_dashboard_widget_chart_cause_options['top_by'] : false;
	$wpl_cause_id = isset( $wpl_dashboard_widget_chart_cause_options['cause_id'] ) ? $wpl_dashboard_widget_chart_cause_options['cause_id'] : false;

	// custom content saved by control callback, modify output
	if( $wpl_top_by AND $wpl_cause_id ) {
		$output = wpl_data_chart_preparation_cause( $wpl_top_by, $wpl_cause_id );
	} else {
		$output = wpl_data_chart_preparation_cause( 'day', '-1' );
	}

	echo $output;
	echo "<canvas id='cause_by_time' width='400' height='300' class='cause_by_class_wrap'></canvas>";
}

function wpl_data_chart_preparation_cause( $top_by, $cause_id ) {
	global $wpdb;
	$today  = current_time( 'timestamp' );
	$this_day  = date('j', $today);
	$this_week  = date('W', $today);
	$this_month  = date('m', $today);
	$this_year  = date('Y', $today);
	$xaxe_list_top = $yaxe_list_top = '';
	$sum_value = $title = $amounts_arr = $args_pledges = array();
	$post_ids = $j = 0;
	$title_list_top = true;
	$cache_time_by_top = 6 * HOUR_IN_SECONDS;
	$meta_key = 'wpl_pledge_donation_amount';
	$post_pledges = 'post_pledges';
	$args_pledges_id = array( 'meta_value'   => $cause_id );
	$args_pledges_init = array(
		'meta_key'     => 'wpl_pledge_cause',
		'post_type' => $post_pledges,
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'no_found_rows' => true,
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false,
		'cache_results' => false,
		'fields' => 'ids',
	);
	$args_cause = array(
		'post_type' => 'post_causes',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'no_found_rows' => true,
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false,
		'cache_results' => false,
		'fields' => 'ids'
	);
	if ($top_by == "day") {
		$args_pledges = array(
			'date_query' => array(
				array(
					'year'  => $this_year,
					'month'  => $this_month,
					'day'  => $this_day
					)
				)
			);
	} elseif ($top_by == "week" ) {
		$cache_time_by_top = 12 * HOUR_IN_SECONDS;
		$args_pledges = array(
			'date_query' => array(
				array(
					'year'  => $this_year,
					'week'  => $this_week,
					)
				)
			);
	} elseif ($top_by == "month" ) {
		$cache_time_by_top = 24 * HOUR_IN_SECONDS;
		$args_pledges = array(
			'date_query' => array(
				array(
					'year'  => $this_year,
					'month'  => $this_month,
					)
				)
			);
	} elseif ($top_by == "year" ) {
		$cache_time_by_top = 48 * HOUR_IN_SECONDS;
		$args_pledges = array(
			'date_query' => array(
				array(
					'year'  => $this_year,
					)
				)
			);
	} elseif ($top_by == "all" ) {
		$cache_time_by_top = 96 * HOUR_IN_SECONDS;
	} else { }




		if ( false === ( $the_query = get_transient( 'wpl_chart_top_pledges_id_'.$cause_id.'_by_'.$top_by  ) ) ) {
			$the_query = new WP_Query( array_merge( $args_pledges_init, $args_pledges, $args_pledges_id ) );
			set_transient( 'wpl_chart_top_pledges_id_'.$cause_id.'_by_'.$top_by, $the_query, $cache_time_by_top );
		}

		if (empty($the_query->posts)) {
			$post_ids = 0;
		} else {
			$post_ids = implode(',', $the_query->posts);
		}

		if ( false === ( $the_query_sql = get_transient( 'wpl_chart_top_pledges_sum_'.$cause_id.'_by_'.$top_by  ) ) ) {
			$the_query_sql = $wpdb->get_var( $wpdb->prepare(
				"
					SELECT SUM(meta_value)
					FROM $wpdb->postmeta
					WHERE post_id IN ($post_ids)
					AND meta_key = %s
				",
				$meta_key
			) );
			set_transient( 'wpl_chart_top_pledges_sum_'.$cause_id.'_by_'.$top_by, $the_query_sql, $cache_time_by_top );
		}

		if($the_query_sql == null) {
			$title_list_top = false;
			$the_query_sql = '0';
		}
		$amounts_arr[0][$cause_id] = $the_query_sql;


	arsort($amounts_arr);
	foreach ($amounts_arr as $key => $value) {
		foreach ($value as $key2 => $value2) {
			array_push($sum_value, $value2);
			array_push( $title, html_entity_decode( get_the_title($key2) ) );
		}
	}

	$xaxe_list_top = "datatopcause.labels = ".wp_json_encode($title).";";
	$yaxe_list_top = "datatopcause.datasets[0].data = ".wp_json_encode($sum_value).";";

	$title_list_top = ($title_list_top) ? "datatopcauseoptions.options.title.text = 'Donations (".$sum_value[0].' '.ot_get_option('wpl_curency_code').")';" : "datatopcauseoptions.options.title.text = 'Sorry, No data available';";

	$data = "<script type='text/javascript'>";
	$data .= $title_list_top;
	$data .= $xaxe_list_top;
	$data .= $yaxe_list_top;
	$data .= "</script>";
	return $data;
}

function wpl_dashboard_widget_chart_cause_control_callback() {
	// get saved data
	if( !$wpl_dashboard_widget_chart_cause_options = get_option( 'wpl_dashboard_widget_chart_cause_options' ) )
		$wpl_dashboard_widget_chart_cause_options = array( );

	// process update
	if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['wpl_dashboard_widget_chart_cause_options'] ) ) {
		// minor validation
		$wpl_dashboard_widget_chart_cause_options['top_by'] = $_POST['wpl_dashboard_widget_chart_cause_options']['top_by'];
		$wpl_dashboard_widget_chart_cause_options['cause_id'] = $_POST['wpl_dashboard_widget_chart_cause_options']['cause_id'];
		// save update
		update_option( 'wpl_dashboard_widget_chart_cause_options', $wpl_dashboard_widget_chart_cause_options );
	}

	// set defaults
	if( !isset( $wpl_dashboard_widget_chart_cause_options['top_by'] ) ) {
		$wpl_dashboard_widget_chart_cause_options['top_by'] = 'day';
	}
	// set defaults
	if( !isset( $wpl_dashboard_widget_chart_cause_options['cause_id'] ) ) {
		$wpl_dashboard_widget_chart_cause_options['cause_id'] = '3';
	}
?>
	<p>
		<label for="top_by"><?php _e( 'Chart stats for : ' , 'benevolence-wpl' ); ?></label>
		<select name="wpl_dashboard_widget_chart_cause_options[top_by]" id="top_by">
			<?php
				$periods   = array(
				'day' => __( 'Today', 'benevolence-wpl' ),
				'week' => __( 'This week', 'benevolence-wpl' ),
				'month' => __( 'This month', 'benevolence-wpl' ),
				'year' => __( 'This year', 'benevolence-wpl' ),
				'all' => __( 'All time', 'benevolence-wpl' ),
			);
			foreach ( $periods as $val => $label ) {
				?>
				<option value="<?php echo $val; ?>"<?php selected( $val, $wpl_dashboard_widget_chart_cause_options['top_by'] ); ?>><?php echo esc_html( $label ); ?></option>
				<?php
			}
			?>
		</select>
	</p>

	<p>
		<label for="cause_id"><?php _e( 'Select Cause' , 'benevolence-wpl' ); ?></label>
		<select name="wpl_dashboard_widget_chart_cause_options[cause_id]" id="cause_id">
			<?php
				$minor = 'post_causes';
				echo str_replace( ' value="' . esc_attr( $minor ) . '"', ' value="' . esc_attr( $minor ) . '" selected="selected"', preg_replace( '/<\/?select[^>]*?>/i', '', wp_dropdown_pages( array( 'echo' => false, 'post_type'=>'post_causes','sort_order'   => 'ASC', 'sort_column'  => 'post_title', ) ) ) );
			?>
		</select>
	</p>

	<?php
}

/*------------------------------------------------------------
	Function used in the action hook
============================================================*/
function wpl_add_dashboard_widget_chart_cause() {
	wp_add_dashboard_widget('wpl_dashboard_widget_chart_cause', __('Cause donations performance', 'benevolence-wpl'), 'wpl_dashboard_widget_chart_cause_callback', 'wpl_dashboard_widget_chart_cause_control_callback');
}

/*------------------------------------------------------------
	Register the new dashboard widget with the 'wp_dashboard_setup' action
============================================================*/
add_action('wp_dashboard_setup', 'wpl_add_dashboard_widget_chart_cause' );


/*------------------------------------------------------------
	Comun
============================================================*/
function wpl_dashboard_load_scripts($hook) {

	if( $hook != 'index.php' )
		return;

	wp_enqueue_script( 'swp-charts', get_template_directory_uri() . '/assets/javascripts/chart.min.js', array( 'jquery' ) );

	wp_add_inline_script( 'swp-charts',
		"
			jQuery(document).ready(function() {
				if (document.getElementById('stats_by_time')) {
					var ctx = document.getElementById('stats_by_time').getContext('2d');
					var myBarChart = new Chart(ctx, dataplegesoptions);
				};

				if (document.getElementById('top_by_time')) {
				  var ctx = document.getElementById('top_by_time').getContext('2d');
				  var myDoughnutChart = new Chart(ctx, datatopcausesoptions);
				};

				if (document.getElementById('cause_by_time')) {
				  var ctx = document.getElementById('cause_by_time').getContext('2d');
				  var myPieChart = new Chart(ctx, datatopcauseoptions);
				};

			});


			var datapleges = {
				datasets: [
					{
						label: 'My First dataset',
						backgroundColor:  'rgba(122,208,58,0.7)',
						borderColor: 'rgba(122,208,58,1)',
						borderWidth: 1
					}
				]
			};
			var dataplegesoptions = {
				type: 'bar',
				data: datapleges,
				options: {
					legend: {
						display: true
					},
					tooltips: {
						callbacks: {
							label: function(tooltipItem) {
								return tooltipItem.yLabel +' ".ot_get_option('wpl_curency_code')."';
							}
						}
					},
					scales: {
						xAxes: [{
							stacked: true,
							gridLines: {display:false}
						}],
						yAxes: [{
							stacked: true,
							gridLines: {display:true}
						}]
					}
				}
			};



			var datatopcauses = {
				labels: 'My First dataset',
				datasets: [ {}]
			  };

			var datatopcausesoptions = {
				type: 'doughnut',
				data: datatopcauses,
				options: {
					tooltipTemplate: '<%= value %>%',
					cutoutPercentage: 40,
					title: {
						display: true,
						//text: 'Donations (".ot_get_option('wpl_curency_code').")',
					},
					legend: {
						position: 'bottom'
					},
				}
			}


			var datatopcause = {
				datasets: [
				{
					backgroundColor: [
					'rgba(54,162,235,1)'
					],
					hoverBackgroundColor: [
					'rgba(54,162,235,.7)',
					]
				}]
			};
			var datatopcauseoptions = {
				type: 'pie',
				data: datatopcause,
				options: {
					title: {
						display: true,
						//text: 'Donations (".ot_get_option('wpl_curency_code').")',
					},
					legend: {
						position: 'bottom'
					},
					cutoutPercentage: 30,
					circumference: Math.PI,
					rotation: 1.0 * Math.PI
				}
			}

		"
	 );
}
add_action('admin_enqueue_scripts', 'wpl_dashboard_load_scripts');
