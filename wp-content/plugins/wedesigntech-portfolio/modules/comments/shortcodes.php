<?php

// Single Page - Featured Comments
if(!function_exists('wdt_sp_featured_comments')) {
	function wdt_sp_featured_comments($attrs, $content = null) {

		$attrs = shortcode_atts ( array (
			'enable_title'  => 'false',
			'enable_rating' => 'false',
			'enable_media'  => 'false',
			'class'         => '',

		), $attrs, 'wdt_sp_featured_comments' );

		$output = '';

		set_query_var('wdt_sp_comments_title', $attrs['enable_title']);
		set_query_var('wdt_sp_comments_rating', $attrs['enable_rating']);
		set_query_var('wdt_sp_comments_media', $attrs['enable_media']);

		ob_start();

			comments_template();
			$comment_list_template = ob_get_contents();

		ob_end_clean();

		$output .= '<div class="wdt-listings-comment-list-holder '.esc_attr( $attrs['class'] ).'">';
			$output .= $comment_list_template;
		$output .= '</div>';

		return $output;

	}
	add_shortcode ( 'wdt_sp_featured_comments', 'wdt_sp_featured_comments' );
}

// Single Page - Average Rating
if(!function_exists('wdt_sp_average_rating')) {
	function wdt_sp_average_rating( $attrs, $content = null ) {

		$attrs = shortcode_atts ( array (
			'listing_id' => '',
			'display'    => 'both',
			'type'       => 'type1',
			'class'      => '',
		), $attrs, 'wdt_sp_average_rating' );

		$output = '';

		if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
			global $post;
			$attrs['listing_id'] = $post->ID;
		}

		if($attrs['listing_id'] != '') {

			$output .= '<div class="wdt-listings-average-rating-container '.esc_attr( $attrs['type'] ).' '.esc_attr( $attrs['class'] ).'">';
				$wdt_average_ratings = get_post_meta($attrs['listing_id'], 'wdt_average_ratings', true);
                if($wdt_average_ratings == '') {
					$wdt_average_ratings = 0;
				}
				$wdt_average_ratings = round($wdt_average_ratings, 2);

				$wdt_rating_display_html = '';
				if($attrs['display'] == 'star-rating' || $attrs['display'] == 'both') {
					$wdt_rating_display_html .= '<div class="wdt-listings-average-rating-holder">';
						$wdt_rating_display_html .= wdt_comment_rating_display($wdt_average_ratings);
					$wdt_rating_display_html .= '</div>';
				}

				$wdt_average_ratings_html = $wdt_average_ratings_type2_html = '';
				if($attrs['display'] == 'overall-rating' || $attrs['display'] == 'both') {
					$wdt_average_ratings_html .= '<div class="wdt-listings-average-rating-overall"><span>'.esc_html( $wdt_average_ratings ).'</span>/<span>5</span></div>';
					$wdt_average_ratings_type2_html .= '<div class="wdt-listings-average-rating-overall"><span>'.esc_html( $wdt_average_ratings ).'</span></div>';
				}

				$comments = get_approved_comments( $attrs['listing_id'] );
				$total_comments = count($comments);

				$wdt_reviews_count_html = '<div class="wdt-listings-average-rating-reviews-count">'.sprintf(esc_html__('%1$s reviews','wdt-portfolio'), $total_comments).'</div>';

				if($attrs['type'] == 'type1') {
					$output .= $wdt_rating_display_html;
					$output .= $wdt_average_ratings_html;
				} else if($attrs['type'] == 'type2') {
					$output .= $wdt_average_ratings_html;
					$output .= $wdt_rating_display_html;
					$output .= $wdt_reviews_count_html;
				} else if($attrs['type'] == 'type3') {
					$output .= $wdt_average_ratings_type2_html;
					$output .= $wdt_rating_display_html;
					$output .= $wdt_reviews_count_html;
				} else {
					$output .= $wdt_average_ratings_type2_html;
					$output .= $wdt_rating_display_html;
				}


			$output .= '</div>';

		} else {

			$listing_singular_label = apply_filters( 'listing_label', 'singular' );

			$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

		}

		return $output;

	}
	add_shortcode ( 'wdt_sp_average_rating', 'wdt_sp_average_rating' );
}
?>