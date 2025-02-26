<?php

// Single Page - Opening Hours
if(!function_exists('wdt_sp_opening_hours')) {
	function wdt_sp_opening_hours( $attrs, $content = null ) {

		$attrs = shortcode_atts ( array (

			'listing_id' => '',
			'show_current_time' => '',
			'class' => '',

		), $attrs, 'wdt_sp_opening_hours' );


		$output = '';

		if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
			global $post;
			$attrs['listing_id'] = $post->ID;
		}

		if($attrs['listing_id'] != '') {

			$wdt_business_hours  = get_post_meta($attrs['listing_id'], 'wdt_business_hours', true);
			$wdt_business_hours_24hour_format  = get_post_meta($attrs['listing_id'], 'wdt_business_hours_24hour_format', true);

			$weekdays = array (
						'sunday' => esc_html__('Sunday','wdt-portfolio'),
						'monday' => esc_html__('Monday','wdt-portfolio'),
						'tuesday' => esc_html__('Tuesday','wdt-portfolio'),
						'wednesday' => esc_html__('Wednesday','wdt-portfolio'),
						'thursday' => esc_html__('Thursday','wdt-portfolio'),
						'friday' => esc_html__('Friday','wdt-portfolio'),
						'saturday' => esc_html__('Saturday','wdt-portfolio'),
					);

			$output .= '<div class="wdt-listings-business-hours-container '.$attrs['class'].'">';

				$weekday_content = $open_hour_status = '';

				$weekday_content .= '<ul class="wdt-listings-business-hours-list">';

					foreach($weekdays as $weekday_key => $weekday_value) {

						$time_label = '';
						if($wdt_business_hours[$weekday_key]['start_time'][0] == '' || $wdt_business_hours[$weekday_key]['end_time'][0] == '') {

							$time_label .= '<span class="wdt-business-hours-off">'.esc_html__('OFF','wdt-portfolio').'</span>';

						} else {

							if($wdt_business_hours_24hour_format == 'true') {
								$time_label .= '<div class="wdt-business-hours-time">';
									$time_label .= '<span class="wdt-business-hours-starttime">'.esc_html( $wdt_business_hours[$weekday_key]['start_time'][0] ).'</span>';
									$time_label .= '<span class="wdt-business-hours-separator"> - </span>';
									$time_label .= '<span class="wdt-business-hours-endtime">'.esc_html( $wdt_business_hours[$weekday_key]['end_time'][0] ).'</span>';
								$time_label .= '</div>';
							} else {
								$time_label .= '<div class="wdt-business-hours-time">';
									$time_label .= '<span class="wdt-business-hours-starttime">'.esc_html( date('g:i A', strtotime($wdt_business_hours[$weekday_key]['start_time'][0])) ).'</span>';
									$time_label .= '<span class="wdt-business-hours-separator"> - </span>';
									$time_label .= '<span class="wdt-business-hours-endtime">'.esc_html( date('g:i A', strtotime($wdt_business_hours[$weekday_key]['end_time'][0])) ).'</span>';
								$time_label .= '</div>';
							}

							if ((date('l') == ucfirst($weekday_key))) {

								$start_time = strtotime($wdt_business_hours[$weekday_key]['start_time'][0]);
								$end_time = strtotime($wdt_business_hours[$weekday_key]['end_time'][0]);

								$current_timestamp = current_time( 'timestamp' );

								$open_hour_status .= '<div class="wdt-listings-business-hours-status">';
									if (($current_timestamp > $start_time) && ($current_timestamp < $end_time)) {
										$open_hour_status .= '<span class="wdt-open-hours-status wdt-open">'.esc_html__('Open','wdt-portfolio').'</span>';
									} else {
										$open_hour_status .= '<span class="wdt-open-hours-status wdt-closed">'.esc_html__('Closed','wdt-portfolio').'</span>';
									}
									$open_hour_status .= $time_label;
								$open_hour_status .= '</div>';

							}

						}

						$weekday_content .= '<li>';
							$weekday_content .= '<span class="wdt-business-hours-label">'.$weekday_value.'</span>';
							$weekday_content .= $time_label;
						$weekday_content .= '</li>';

					}

				$weekday_content .= '</ul>';

				$output .= $open_hour_status;
				$output .= $weekday_content;

				if($attrs['show_current_time'] == 'true') {
					$output .= '<div class="wdt-listings-business-hours-currenttime">'.current_time( get_option('date_format').' '.get_option('time_format') ).' <span>'.esc_html__('local time','wdt-portfolio').'</span></div>';
				}

			$output .= '</div>';

		} else {

			$listing_singular_label = apply_filters( 'listing_label', 'singular' );

			$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

		}

		return $output;

	}
	add_shortcode ( 'wdt_sp_opening_hours', 'wdt_sp_opening_hours' );
}

// Single Page - Opening Hours Status
if(!function_exists('wdt_sp_opening_hours_status')) {
	function wdt_sp_opening_hours_status( $attrs, $content = null ) {

		$attrs = shortcode_atts ( array (

					'listing_id' => '',
					'type'       => 'type1',
					'class'      => '',

				), $attrs, 'wdt_sp_opening_hours_status' );


		$output = '';

		if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
			global $post;
			$attrs['listing_id'] = $post->ID;
		}

		if($attrs['listing_id'] != '') {

			$wdt_business_hours  = get_post_meta($attrs['listing_id'], 'wdt_business_hours', true);

			if(isset($wdt_business_hours[strtolower(date('l'))]['start_time'][0]) && isset($wdt_business_hours[strtolower(date('l'))]['start_time'][0])) {

				$start_time = strtotime($wdt_business_hours[strtolower(date('l'))]['start_time'][0]);
				$end_time = strtotime($wdt_business_hours[strtolower(date('l'))]['end_time'][0]);

				$current_timestamp = current_time( 'timestamp' );

				$output .= '<div class="wdt-listings-business-hours-status-container '.esc_attr( $attrs['type'] ).' '.esc_attr( $attrs['class'] ).'">';

				if($attrs['type'] == 'type5') {

					if (($current_timestamp > $start_time) && ($current_timestamp < $end_time)) {
						$output .= '<span class="wdt-open-hours-status wdt-open"></span>';
					} else {
						$output .= '<span class="wdt-open-hours-status wdt-closed"></span>';
					}

				} else {

					if (($current_timestamp > $start_time) && ($current_timestamp < $end_time)) {
						$output .= '<span class="wdt-open-hours-status wdt-open">'.esc_html__('Open','wdt-portfolio').'</span>';
					} else {
						$output .= '<span class="wdt-open-hours-status wdt-closed">'.esc_html__('Closed','wdt-portfolio').'</span>';
					}

				}

				$output .= '</div>';

			}

		} else {

			$listing_singular_label = apply_filters( 'listing_label', 'singular' );

			$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

		}

		return $output;

	}
	add_shortcode ( 'wdt_sp_opening_hours_status', 'wdt_sp_opening_hours_status' );
}

// Search - Open Now Field
if(!function_exists('wdt_sf_open_now_field')) {
	function wdt_sf_open_now_field( $attrs, $content = null ) {

		$attrs = shortcode_atts ( array (

					'ajax_load' => '',
					'class' => '',

				), $attrs, 'wdt_sf_open_now_field' );


		$output = '';

		$output .= '<div class="wdt-sf-fields-holder wdt-sf-others-field-holder wdt-sf-opennow-field-holder '.$attrs['class'].'">';

			$additional_class = '';
			if($attrs['ajax_load'] == 'true') {
				$additional_class = 'wdt-with-ajax-load';
			}

			$output .= '<div class="wdt-sf-others-list '.esc_attr($additional_class).'">';
				$output .= '<div class="wdt-sf-others-list-item" data-itemvalue="opennow">'.esc_html__('Open Now','wdt-portfolio').'</div>';
			$output .= '</div>';

		$output .= '</div>';

		return $output;

	}
	add_shortcode ( 'wdt_sf_open_now_field', 'wdt_sf_open_now_field' );
}

?>