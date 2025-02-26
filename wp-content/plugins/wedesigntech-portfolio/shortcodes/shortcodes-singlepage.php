<?php

if( !class_exists('WDTPortfolioSinglePageShortcodes') ) {

	class WDTPortfolioSinglePageShortcodes {

		/**
		 * Instance variable
		 */
		private static $_instance = null;

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 */
		public static function instance() {

			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		function __construct() {

			add_shortcode ( 'wdt_sp_featured_image', array ( $this, 'wdt_sp_featured_image' ) );
			add_shortcode ( 'wdt_sp_featured_item', array ( $this, 'wdt_sp_featured_item' ) );
			add_shortcode ( 'wdt_sp_features', array ( $this, 'wdt_sp_features' ) );
			add_shortcode ( 'wdt_sp_contact_details', array ( $this, 'wdt_sp_contact_details' ) );
			add_shortcode ( 'wdt_sp_social_links', array ( $this, 'wdt_sp_social_links' ) );
			add_shortcode ( 'wdt_sp_comments', array ( $this, 'wdt_sp_comments' ) );
			add_shortcode ( 'wdt_sp_utils', array ( $this, 'wdt_sp_utils' ) );
			add_shortcode ( 'wdt_sp_taxonomy', array ( $this, 'wdt_sp_taxonomy' ) );
			add_shortcode ( 'wdt_sp_contact_form', array ( $this, 'wdt_sp_contact_form' ) );
			add_shortcode ( 'wdt_sp_post_date', array ( $this, 'wdt_sp_post_date' ) );
			add_shortcode ( 'wdt_sp_mls_number', array ( $this, 'wdt_sp_mls_number' ) );
			add_shortcode ( 'wdt_sp_navigation', array ( $this, 'wdt_sp_navigation' ) );

		}


		function wdt_shortcodeHelper($content = null) {
			$content = do_shortcode ( shortcode_unautop ( $content ) );
			$content = preg_replace ( '#^<\/p>|^<br \/>|<p>$#', '', $content );
			$content = preg_replace ( '#<br \/>#', '', $content );
			return trim ( $content );
		}

		function wdt_sp_featured_image( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'listing_id' => '',
				'image_size' => 'full',
				'with_link'  => '',
				'class'      => '',
			), $attrs, 'wdt_sp_featured_image' );


			$output = '';

			if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
				global $post;
				$attrs['listing_id'] = $post->ID;
			}

			if($attrs['listing_id'] != '') {

				$featured_image_id = get_post_thumbnail_id($attrs['listing_id']);
				$image_details = wp_get_attachment_image_src($featured_image_id, $attrs['image_size']);

                $image_sizes = wp_get_attachment_metadata($featured_image_id);
                $width = (isset($image_sizes['width']) && !empty($image_sizes['width'])) ? 'width="'.$image_sizes['width'].'"' : '';
                $height = (isset($image_sizes['height']) && !empty($image_sizes['height'])) ? 'height="'.$image_sizes['height'].'"' : '';

				$output .= '<div class="wdt-listings-feature-image-holder '.esc_attr( $attrs['class'] ).'">';
						$output .= '<a href="'.esc_url( get_permalink($attrs['listing_id']) ).'">';
						$output .= '<img src="'.esc_url($image_details[0]).'" title="'.esc_attr__('Featured Image','wdt-portfolio').'" alt="'.esc_attr__('Featured Image','wdt-portfolio').'" '.$width.' '.$height.' />';
						$output .= '</a>';
				$output .= '</div>';

			} else {

				$listing_singular_label = apply_filters( 'listing_label', 'singular' );

				$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

			}

			return $output;

		}

		function wdt_sp_featured_item( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'listing_id' => '',
				'type'       => 'type1',
				'class'      => '',
			), $attrs, 'wdt_sp_featured_item' );

			$output = '';

			if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
				global $post;
				$attrs['listing_id'] = $post->ID;
			}

			if($attrs['listing_id'] != '') {

				$wdt_featured_item = get_post_meta($attrs['listing_id'], 'wdt_featured_item', true);
				if($wdt_featured_item == 'true') {

					$output .= '<div class="wdt-listings-featured-item-container '.esc_attr( $attrs['class'] ).' '.esc_attr( $attrs['type'] ).'">';
						$output .= '<span>'.esc_html__('Featured','wdt-portfolio').'</span>';
					$output .= '</div>';

				}

			} else {

				$listing_singular_label = apply_filters( 'listing_label', 'singular' );
				$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

			}

			return $output;

		}

		function wdt_sp_features( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'listing_id'             => '',
				'type'                   => 'type1',
				'include'                => '',
				'columns'                => 4,
				'features_image_or_icon' => '',
				'class'                  => '',
			), $attrs, 'wdt_sp_features' );

			$output = '';

			if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
				global $post;
				$attrs['listing_id'] = $post->ID;
			}

			if($attrs['listing_id'] != '') {

				if($attrs['columns'] == 1) {
					$column_class = 'wdt-column wdt-one-column';
				} else if($attrs['columns'] == 2) {
					$column_class = 'wdt-column wdt-one-half';
				} else if($attrs['columns'] == 3) {
					$column_class = 'wdt-column wdt-one-third';
				} else if($attrs['columns'] == 4) {
					$column_class = 'wdt-column wdt-one-fourth';
				} else if($attrs['columns'] == -1) {
					if($attrs['type'] == 'listing') {
						$column_class = '';
					} else {
						$column_class = '';
						$attrs['class'] .= ' wdt-no-column';
					}
				}

                $wdt_features_title = $wdt_features_subtitle = $wdt_features_value = $wdt_features_valueunit = $wdt_features_icon = $wdt_features_image = array ();
                if($attrs['listing_id'] > 0) {
                    $wdt_features_title = get_post_meta($attrs['listing_id'], 'wdt_features_title', true);
                    $wdt_features_subtitle = get_post_meta($attrs['listing_id'], 'wdt_features_subtitle', true);
                    $wdt_features_value = get_post_meta($attrs['listing_id'], 'wdt_features_value', true);
                    $wdt_features_valueunit = get_post_meta($attrs['listing_id'], 'wdt_features_valueunit', true);
                    $wdt_features_icon = get_post_meta($attrs['listing_id'], 'wdt_features_icon', true);
                    $wdt_features_image = get_post_meta($attrs['listing_id'], 'wdt_features_image', true);
                }

                $j = 0; $i = 1;
                if(is_array($wdt_features_title) && !empty($wdt_features_title)) {

                    if($attrs['include'] != '') {
                        $include_keys = explode(',', $attrs['include']);
                    } else {
                        if($attrs['type'] == 'listing') {
                            $include_keys = array_keys($wdt_features_title);
                            array_splice($include_keys, 4);
                        } else {
                            $include_keys = array_keys($wdt_features_title);
                        }
                    }

                    $output .= '<div class="wdt-listings-features-box-container '.esc_attr( $attrs['type'] ).' '.esc_attr( $attrs['class'] ).'">';
                        foreach($wdt_features_title as $wdt_feature_title) {

                            if(in_array($j, $include_keys)) {

                                if($i == 1 && $attrs['columns'] != -1) { $first_class = 'first';  } else { $first_class = ''; }
                                if($i == $attrs['columns']) { $i = 1; } else { $i = $i + 1; }

                                $wdt_features_image_html = $style_attr = '';
                                $image_url = wp_get_attachment_image_src($wdt_features_image[$j], 'full');
                                if($image_url != '') {
                                    $wdt_features_image_html .= ' <div class="wdt-listings-features-box-item-img"  style="background-image:url('.esc_url($image_url[0]).');"></div>';
                                    if($attrs['type'] == 'listing' && $attrs['features_image_or_icon'] == 'image') {
                                        $style_attr .= 'style="background-image:url('.esc_url($image_url[0]).');"';
                                    }
                                }

                                $wdt_features_icon_html = '';
                                if(($attrs['type'] == 'listing' && $attrs['features_image_or_icon'] == 'icon' && isset($wdt_features_icon[$j]) && !empty($wdt_features_icon[$j])) || ($attrs['type'] != 'listing' && isset($wdt_features_icon[$j]) && !empty($wdt_features_icon[$j]))) {
                                    $wdt_features_icon_html .= '<div class="wdt-listings-features-box-item-icon"><span class="'.esc_attr($wdt_features_icon[$j]).'"></span></div>';
                                }

                                $wdt_features_title_html = '';
                                if(isset($wdt_feature_title) && !empty($wdt_feature_title)) {
                                    $wdt_features_title_html .= '<div class="wdt-listings-features-box-item-title">'.esc_attr($wdt_feature_title).'</div>';
                                }

                                $wdt_features_subtitle_html = '';
                                if(isset($wdt_features_subtitle[$j]) && !empty($wdt_features_subtitle[$j])) {
                                    $wdt_features_subtitle_html .= '<div class="wdt-listings-features-box-item-subtitle">'.esc_attr($wdt_features_subtitle[$j]).'</div>';
                                }

                                $wdt_features_value_html = '';
                                if(isset($wdt_features_value[$j]) && !empty($wdt_features_value[$j])) {
                                    $wdt_features_value_html .= '<div class="wdt-listings-features-box-item-value">';
                                        $wdt_features_value_html .= esc_attr($wdt_features_value[$j]);
                                        if(isset($wdt_features_valueunit[$j]) && !empty($wdt_features_valueunit[$j])) {
                                            $wdt_features_value_html .= '<span>'.esc_attr($wdt_features_valueunit[$j]).'</span>';
                                        }
                                    $wdt_features_value_html .= '</div>';
                                }


                                $output .= '<div class="wdt-listings-features-box-item '.esc_attr($column_class).' '.esc_attr($first_class).'" '.$style_attr.'>';

                                    if($attrs['type'] == 'listing') {
                                        $output .= $wdt_features_icon_html;
                                        $output .= $wdt_features_title_html;
                                        $output .= $wdt_features_value_html;
                                    } else if($attrs['type'] == 'type1') {
                                        $output .= $wdt_features_title_html;
                                        $output .= $wdt_features_value_html;
                                    } else if($attrs['type'] == 'type2') {
                                        $output .= $wdt_features_image_html;
                                        $output .= $wdt_features_title_html;
                                        $output .= $wdt_features_value_html;
                                    } else if($attrs['type'] == 'type3') {
                                        $output .= $wdt_features_icon_html;
                                        $output .= $wdt_features_title_html;
                                        $output .= $wdt_features_value_html;
                                    } else if($attrs['type'] == 'type4') {
                                        $output .= $wdt_features_title_html;
                                        $output .= $wdt_features_value_html;
                                    } else if($attrs['type'] == 'type5') {
                                        $output .= $wdt_features_title_html;
                                        $output .= $wdt_features_value_html;
                                    } else if($attrs['type'] == 'type6') {
                                        $output .= $wdt_features_image_html;
                                        $output .= '<div class="wdt-listings-features-box-item-details">';
                                            $output .= $wdt_features_title_html;
                                            $output .= $wdt_features_value_html;
                                        $output .= '</div>';
                                    } else if($attrs['type'] == 'type7') {
                                        $output .= $wdt_features_title_html;
                                        $output .= $wdt_features_value_html;
                                    }

                                $output .= '</div>';

                            }

                            $j++;

                        }
                    $output .= '</div>';
                }

			} else {

				$listing_singular_label = apply_filters( 'listing_label', 'singular' );
				$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

			}

			return $output;

		}

		function wdt_sp_contact_details( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'listing_id'              => '',
				'type'                    => '',
				'contact_details'         => 'list',
				'include_address'         => '',
				'include_email'           => '',
				'include_phone'           => '',
				'include_mobile'          => '',
				'include_skype'           => '',
				'include_website'         => '',
				'class'                   => '',
			), $attrs, 'wdt_sp_contact_details' );

			$output = '';

			if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
				global $post;
				$attrs['listing_id'] = $post->ID;
			}

			if($attrs['listing_id'] != '') {

				if($attrs['type'] == 'listing') {
					$attrs['type'] = '';
				}

                $output .= '<div class="wdt-listings-contactdetails-container '.esc_attr( $attrs['type'] ).' '.esc_attr( $attrs['class'] ).'">';

                    $output .= '<ul class="wdt-listings-contactdetails-list">';

                        if($attrs['include_address'] == 'true') {

                            $wdt_latitude  = get_post_meta($attrs['listing_id'], 'wdt_latitude', true);
                            $wdt_longitude = get_post_meta($attrs['listing_id'], 'wdt_longitude', true);
                            $wdt_address   = get_post_meta($attrs['listing_id'], 'wdt_address', true);
                            $wdt_zip       = get_post_meta($attrs['listing_id'], 'wdt_zip', true);
                            $wdt_country   = get_post_meta($attrs['listing_id'], 'wdt_country', true);

                            $contact_address = $wdt_address;
                            if($wdt_country != '') {
                                $contact_address .= ', '.$wdt_country;
                            }
                            if($wdt_zip != '') {
                                $contact_address .= ' '.$wdt_zip;
                            }

                            $contact_address = trim($contact_address, ',');

                            if($contact_address != '') {
                                $output .= '<li><span class="fa fa-map-marker"></span>';
                                    $output .= '<p>';
                                        $output .= $contact_address;
                                    $output .= '</p>';
                                $output .= '</li>';
                            }

                        }

                        if($attrs['contact_details'] == 'author') {

                            $author = get_post($attrs['listing_id']);
                            $author_id = $author->post_author;

                            if($attrs['include_email'] == 'true') {
                                $wdt_email = get_the_author_meta( 'user_email' , $author_id );
                                if($wdt_email != '') {
                                    $output .= '<li><span class="fa fa-envelope"></span><a href="mailto:'.sanitize_email($wdt_email).'">'.esc_html($wdt_email).'</a></li>';
                                }
                            }

                            if($attrs['include_phone'] == 'true') {
                                $wdt_phone = get_the_author_meta( 'wdt_user_phone' , $author_id );
                                if($wdt_phone != '') {
                                    $output .= '<li><span class="fa fa-phone"></span><a href="tel:'.esc_attr($wdt_phone).'" class="phone" data-listingid="'.esc_attr($attrs['listing_id']).'" target="_blank">'.esc_html($wdt_phone).'</a></li>';
                                }
                            }

                            if($attrs['include_mobile'] == 'true') {
                                $wdt_mobile = get_the_author_meta( 'wdt_user_mobile' , $author_id );
                                if($wdt_mobile != '') {
                                    $output .= '<li><span class="fa fa-mobile"></span><a href="tel:'.esc_attr($wdt_mobile).'" class="mobile" data-listingid="'.esc_attr($attrs['listing_id']).'" target="_blank">'.esc_html($wdt_mobile).'</a></li>';
                                }
                            }

                            if($attrs['include_skype'] == 'true') {
                                $wdt_skype = get_the_author_meta( 'wdt_user_skype' , $author_id );
                                if($wdt_skype != '') {
                                    $output .= '<li><span class="fab fa-skype"></span>'.esc_html($wdt_skype).'</li>';
                                }
                            }

                            if($attrs['include_website'] == 'true') {
                                $wdt_website = get_the_author_meta( 'wdt_user_website' , $author_id );
                                if($wdt_website != '') {
                                    $output .= '<li><span class="fa fa-globe"></span><a href="'.esc_url($wdt_website).'" class="web" data-listingid="'.esc_attr($attrs['listing_id']).'" target="_blank">'.esc_html($wdt_website).'</a></li>';
                                }
                            }

                        } else if($attrs['contact_details'] == 'list') {

                            if($attrs['include_email'] == 'true') {
                                $wdt_email = get_post_meta($attrs['listing_id'], 'wdt_email', true);
                                if($wdt_email != '') {
                                    $output .= '<li><span class="fa fa-envelope"></span><a href="mailto:'.esc_attr($wdt_email).'">'.esc_attr($wdt_email).'</a></li>';
                                }
                            }

                            if($attrs['include_phone'] == 'true') {
                                $wdt_phone = get_post_meta($attrs['listing_id'], 'wdt_phone', true);
                                if($wdt_phone != '') {
                                    $output .= '<li><span class="fa fa-phone"></span><a href="tel:'.sanitize_email($wdt_phone).'" class="phone" data-listingid="'.esc_attr($attrs['listing_id']).'" target="_blank">'.esc_html($wdt_phone).'</a></li>';
                                }
                            }

                            if($attrs['include_mobile'] == 'true') {
                                $wdt_mobile = get_post_meta($attrs['listing_id'], 'wdt_mobile', true);
                                if($wdt_mobile != '') {
                                    $output .= '<li><span class="fa fa-mobile"></span><a href="tel:'.esc_attr($wdt_mobile).'" class="mobile" data-listingid="'.esc_attr($attrs['listing_id']).'" target="_blank">'.esc_html($wdt_mobile).'</a></li>';
                                }
                            }

                            if($attrs['include_skype'] == 'true') {
                                $wdt_skype = get_post_meta($attrs['listing_id'], 'wdt_skype', true);
                                if($wdt_skype != '') {
                                    $output .= '<li><span class="fab fa-skype"></span>'.esc_html($wdt_skype).'</li>';
                                }
                            }

                            if($attrs['include_website'] == 'true') {
                                $wdt_website = get_post_meta($attrs['listing_id'], 'wdt_website', true);
                                if($wdt_website != '') {
                                    $output .= '<li><span class="fa fa-globe"></span><a href="'.esc_url($wdt_website).'" class="web" data-listingid="'.esc_attr($attrs['listing_id']).'" target="_blank">'.esc_html($wdt_website).'</a></li>';
                                }
                            }

                        }

                    $output .= '</ul>';

                $output .= '</div>';

			} else {

				$listing_singular_label = apply_filters( 'listing_label', 'singular' );

				$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

			}

			return $output;

		}

		function wdt_sp_social_links( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'listing_id'   => '',
				'type'         => '',
				'class'        => '',
			), $attrs, 'wdt_sp_social_links' );

			$output = '';

			if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
				global $post;
				$attrs['listing_id'] = $post->ID;
			}

			if($attrs['listing_id'] != '') {

				$output .= '<div class="wdt-listings-sociallinks-container '.esc_attr( $attrs['type'] ).' '.esc_attr( $attrs['class'] ).'">';

                    $output .= '<label>'.esc_html__('Socials:', 'wdt-portfolio').'</label>';

					$output .= '<ul class="wdt-listings-sociallinks-list">';

                        $wdt_social_items = get_post_meta($attrs['listing_id'], 'wdt_social_items', true);
                        $wdt_social_items = (isset($wdt_social_items) && is_array($wdt_social_items)) ? $wdt_social_items : array ();

                        $wdt_social_items_value = get_post_meta($attrs['listing_id'], 'wdt_social_items_value', true);
                        $wdt_social_items_value = (isset($wdt_social_items_value) && is_array($wdt_social_items_value)) ? $wdt_social_items_value : array ();

						$i = 0;
						if(is_array($wdt_social_items) && !empty($wdt_social_items)) {
							foreach($wdt_social_items as $wdt_social_item) {
								$output .= '<li><a href="'.esc_url($wdt_social_items_value[$i]).'"><span class="fab '.esc_attr($wdt_social_item).'"></span></a></li>';
								$i++;
							}
						}

					$output .= '</ul>';

				$output .= '</div>';

			} else {

				$listing_singular_label = apply_filters( 'listing_label', 'singular' );

				$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

			}

			return $output;

		}

		function wdt_sp_comments( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'class' => '',
			), $attrs, 'wdt_sp_comments' );

			$output = '';

			ob_start();

				comments_template();
				$comment_list_template = ob_get_contents();

			ob_end_clean();

			$output .= '<div class="wdt-listings-comment-list-holder '.esc_attr( $attrs['class'] ).'">';
				$output .= $comment_list_template;
			$output .= '</div>';

			return $output;

		}

		function wdt_sp_utils( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'listing_id'                    => '',
				'show_title'                    => '',
				'show_address'                  => '',
				'show_favourite'                => '',
				'show_pageview'                 => '',
				'show_print'                    => '',
				'show_socialshare'              => '',
				'show_averagerating'            => '',
				'show_featured'                 => '',
				'show_categories'               => '',
				'show_contracttype'             => '',
				'show_amenity'                  => '',
				'show_price'                    => '',
				'show_excerpt'                  => '',
				'class'                         => '',
			), $attrs, 'wdt_sp_utils' );

			$output = '';

			if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
				global $post;
				$attrs['listing_id'] = $post->ID;
			}

			if($attrs['listing_id'] != '') {

				$output .= '<div class="wdt-listings-utils-container '.esc_attr( $attrs['class'] ).'">';

					if($attrs['show_title'] == 'true') {

						$output .= '<div class="wdt-listings-utils-item wdt-listings-utils-title">';
							$output .= '<h3 class="wdt-listings-utils-title-item"><a href="'.esc_url( get_permalink($attrs['listing_id']) ).'">'.get_the_title($attrs['listing_id']).'</a></h3>';
						$output .= '</div>';

					}

					if($attrs['show_address'] == 'true') {

						$include_address = '';
						if($attrs['show_address'] == 'true') {
							$include_address = 'true';
						}

						$include_phone = $include_mobile = 'true';

						$output .= '<div class="wdt-listings-utils-item wdt-listings-utils-contactdetails">';
							$output .= do_shortcode('[wdt_sp_contact_details listing_id="'.esc_attr($attrs['listing_id']).'" contact_details="list" include_address="'.esc_attr($include_address).'" include_phone="'.esc_attr($include_phone).'" include_mobile="'.esc_attr($include_mobile).'" /]');
						$output .= '</div>';

					}

					if($attrs['show_favourite'] == 'true') {

						$current_user = wp_get_current_user();
						$user_id = $current_user->ID;

						$favourite_items = get_user_meta($user_id, 'favourite_items', true);
						$favourite_items = (is_array($favourite_items) && !empty($favourite_items)) ? $favourite_items : array();

						$favourite_attr = 'data-listingid="'.$attrs['listing_id'].'"';
						if($user_id > 0) {
							if(in_array($attrs['listing_id'], $favourite_items)) {
								$favourite_class = 'removefavourite';
								$favourite_icon_class = 'fa fa-heart';
							} else {
								$favourite_class = 'addtofavourite';
								$favourite_icon_class = 'far fa-heart';
							}
							$favourite_attr .= ' data-userid="'.$user_id.'"';
						} else {
							$favourite_class = 'wdt-login-link';
							$favourite_attr = '';
							$favourite_icon_class = 'far fa-heart';
						}

						$output .= '<div class="wdt-listings-utils-item wdt-listings-utils-favourite">';
							$output .= '<a class="wdt-listings-utils-favourite-item '.esc_attr( $favourite_class ).'" '.$favourite_attr.'><span class="'.$favourite_icon_class.'"></span></a>';
						$output .= '</div>';

					}

					if($attrs['show_pageview'] == 'true') {

						$total_views = get_post_meta($attrs['listing_id'], 'wdt_total_views', true);
						$total_views = ($total_views != '') ? $total_views : 0;

						$output .= '<div class="wdt-listings-utils-item wdt-listings-utils-pageview">';
							$output .= '<a class="wdt-listings-utils-pageview-item"><span class="fa fa-eye-slash"></span>'.esc_html($total_views).'</a>';
						$output .= '</div>';

					}

					if($attrs['show_print'] == 'true') {

						$output .= '<div class="wdt-listings-utils-item wdt-listings-utils-print">';
							$output .= '<a class="wdt-listings-utils-print-item"><span class="fa fa-print"></span></a>';
						$output .= '</div>';

					}

					if($attrs['show_socialshare'] == 'true') {

						$output .= '<div class="wdt-listings-utils-item wdt-listings-utils-socialshare">';
							$output .= do_shortcode('[wdt_sp_social_share listing_id="'.esc_attr($attrs['listing_id']).'" show_facebook="true" show_delicious="true" show_digg="true" show_stumbleupon="true" show_twitter="true" show_googleplus="true" show_linkedin="true" show_pinterest="true" /]');
						$output .= '</div>';

					}

					if($attrs['show_averagerating'] == 'true') {

						$output .= '<div class="wdt-listings-utils-item wdt-listings-utils-averagerating">';
							$output .= do_shortcode('[wdt_sp_average_rating listing_id="'.esc_attr($attrs['listing_id']).'" display="both" type="" /]');
						$output .= '</div>';

					}

					if($attrs['show_featured'] == 'true') {

						$output .= '<div class="wdt-listings-utils-item wdt-listings-utils-featured-item">';
							$output .= do_shortcode('[wdt_sp_featured_item listing_id="'.esc_attr($attrs['listing_id']).'" type="" /]');
						$output .= '</div>';

					}

					if($attrs['show_categories'] == 'true') {

						$output .= '<div class="wdt-listings-utils-item wdt-listings-utils-categories">';
							$output .= do_shortcode('[wdt_sp_taxonomy listing_id="'.esc_attr($attrs['listing_id']).'" taxonomy="wdt_listings_category" type="utils" /]');
						$output .= '</div>';

					}

					if($attrs['show_amenity'] == 'true') {

						$output .= '<div class="wdt-listings-utils-item wdt-listings-utils-contracttype">';
							$output .= do_shortcode('[wdt_sp_taxonomy listing_id="'.esc_attr($attrs['listing_id']).'" taxonomy="wdt_listings_amenity" type="utils" /]');
						$output .= '</div>';

					}

					if($attrs['show_price'] == 'true' && shortcode_exists('wdt_sp_price')) {

						$output .= '<div class="wdt-listings-utils-item wdt-listings-utils-price">';
							$output .= do_shortcode('[wdt_sp_price listing_id="'.esc_attr($attrs['listing_id']).'" type="" /]');
						$output .= '</div>';

					}

                    if($attrs['show_excerpt'] == 'true') {

						$output .= '<div class="wdt-listings-utils-item wdt-listings-utils-excerpt">';
							$output .= '<div class="wdt-listings-utils-excerpt-item">'.get_the_excerpt($attrs['listing_id']).'</div>';
						$output .= '</div>';

					}

				$output .= '</div>';

			} else {

				$listing_singular_label = apply_filters( 'listing_label', 'singular' );

				$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

			}

			return $output;

		}

		function wdt_sp_taxonomy( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'listing_id' => '',
				'taxonomy'   => 'wdt_listings_category',
				'type'       => '',
				'show_label' => 'false',
				'splice'     => '',
				'class'      => '',
			), $attrs, 'wdt_sp_taxonomy' );

			$output = '';

			if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
				global $post;
				$attrs['listing_id'] = $post->ID;
			}

			if($attrs['listing_id'] != '') {

				$listing_singular_label = apply_filters( 'listing_label', 'singular' );

				$listing_taxonomies = wp_get_post_terms($attrs['listing_id'], $attrs['taxonomy'], array ('orderby' => 'parent'));
				if(isset($attrs['splice']) && $attrs['splice'] != '') {
					array_splice($listing_taxonomies, $attrs['splice']);
				}

				if(!empty($listing_taxonomies)) {

					$output .= '<div class="wdt-listings-taxonomy-container '.esc_attr( $attrs['type'] ).' '.esc_attr( $attrs['class'] ).'">';

                        if($attrs['show_label'] == 'true') {
                            if($attrs['taxonomy'] == 'wdt_listings_category') {
                                $output .= '<label>'.esc_html__('Category:', 'wdt-portfolio').'</label>';
                            } else if($attrs['taxonomy'] == 'wdt_listings_amenity') {
                                $output .= '<label>'.apply_filters( 'amenity_label', 'singular' ).':</label>';
                            }
                        }

						$output .= '<ul class="wdt-listings-taxonomy-list">';

							foreach($listing_taxonomies as $listing_taxonomy) {

								if(isset($listing_taxonomy->term_id)) {

									$icon_image_url   = get_term_meta($listing_taxonomy->term_id, 'wdt-taxonomy-icon-image-url', true);
									$icon             = get_term_meta($listing_taxonomy->term_id, 'wdt-taxonomy-icon', true);
									$background_color = get_term_meta($listing_taxonomy->term_id, 'wdt-taxonomy-background-color', true);

									$tax_bg_color     = (isset($background_color) && !empty($background_color)) ? 'style="background-color:'.$background_color.';"': '';

									if($attrs['type'] == 'type1') {

										$output .= '<li>';
											$output .= '<a href="'.esc_url( get_term_link($listing_taxonomy->term_id) ).'">';
												$output .= '<span>'.esc_html($listing_taxonomy->name).'</span>';
											$output .= '</a>';
										$output .= '</li>';

									} else if($attrs['type'] == 'type2') {

										$output .= '<li>';
											$output .= '<a href="'.esc_url( get_term_link($listing_taxonomy->term_id) ).'">';
												if($icon != '') {
													$output .= '<span class="'.esc_attr( $icon ).'"></span>';
												}
												$output .= '<span>'.esc_html($listing_taxonomy->name).'</span>';
											$output .= '</a>';
										$output .= '</li>';

									} else if($attrs['type'] == 'type3') {

										$output .= '<li>';
											$output .= '<a href="'.esc_url( get_term_link($listing_taxonomy->term_id) ).'">';
												if($icon_image_url != '') {
													$output .= '<span class="wdt-listings-taxonomy-image" '.$tax_bg_color.'><img src="'.esc_url( $icon_image_url ).'" alt="'.sprintf( esc_html__('%1$s Taxonomy Image','wdt-portfolio'), $listing_singular_label ).'" title="'.sprintf( esc_attr__('%1$s Taxonomy Image','wdt-portfolio'), $listing_singular_label ).'" /></span>';
												}
												$output .= '<span>'.esc_html($listing_taxonomy->name).'</span>';
											$output .= '</a>';
										$output .= '</li>';

									} else if($attrs['type'] == 'type4') {

										$output .= '<li>';
											$output .= '<a href="'.esc_url( get_term_link($listing_taxonomy->term_id) ).'" '.$tax_bg_color.'>';
												if($icon != '') {
													$output .= '<span class="'.esc_attr( $icon ).'"></span>';
												}
												$output .= '<span>'.esc_html($listing_taxonomy->name).'</span>';
											$output .= '</a>';
										$output .= '</li>';

									} else if($attrs['type'] == 'type5') {

										$output .= '<li>';
											$output .= '<a href="'.esc_url( get_term_link($listing_taxonomy->term_id) ).'" '.$tax_bg_color.'>';
												if($icon_image_url != '') {
													$output .= '<span class="wdt-listings-taxonomy-image"><img src="'.esc_url( $icon_image_url ).'" alt="'.sprintf( esc_html__('%1$s Taxonomy Image','wdt-portfolio'), $listing_singular_label ).'" title="'.sprintf( esc_html__('%1$s Taxonomy Image','wdt-portfolio'), $listing_singular_label ).'" /></span>';
												}
												$output .= '<span>'.esc_html($listing_taxonomy->name).'</span>';
											$output .= '</a>';
										$output .= '</li>';

									} else if($attrs['type'] == 'type6') {

										$output .= '<li>';
											$output .= '<a href="'.esc_url( get_term_link($listing_taxonomy->term_id) ).'">';
												$output .= '<span>'.esc_html($listing_taxonomy->name).'</span>';
											$output .= '</a>';
										$output .= '</li>';

									} else if($attrs['type'] == 'type7') {

										$output .= '<li>';
											$output .= '<a href="'.esc_url( get_term_link($listing_taxonomy->term_id) ).'" '.$tax_bg_color.'>';
												$output .= '<span>'.esc_html($listing_taxonomy->name).'</span>';
											$output .= '</a>';
										$output .= '</li>';

									} else if($attrs['type'] == 'type8') {

										$output .= '<li>';
											$output .= '<a href="'.esc_url( get_term_link($listing_taxonomy->term_id) ).'" '.$tax_bg_color.'>';
												$output .= '<span>'.esc_html($listing_taxonomy->name).'</span>';
											$output .= '</a>';
										$output .= '</li>';

									} else if($attrs['type'] == 'utils') {

										$output .= '<li>';
											$output .= '<a href="'.esc_url( get_term_link($listing_taxonomy->term_id) ).'">';
												if($icon != '') {
													$output .= '<span class="'.esc_attr( $icon ).'"></span>';
												}
												$output .= '<span class="wdt-listings-taxonomy-name">'.esc_html($listing_taxonomy->name).'</span>';
											$output .= '</a>';
										$output .= '</li>';

									}

								}

							}

						$output .= '</ul>';

					$output .= '</div>';

				}

			} else {

				$listing_singular_label = apply_filters( 'listing_label', 'singular' );

				$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

			}

			return $output;

		}

		function wdt_sp_contact_form( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'listing_id'           => '',
				'textarea_placeholder' => '',
				'submit_label'         => '',
				'contact_point'        => '',
				'include_admin'        => '',
				'class'                => '',
			), $attrs, 'wdt_sp_contact_form' );

			$output = '';

			if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
				global $post;
				$attrs['listing_id'] = $post->ID;
			}

			if($attrs['listing_id'] != '') {

				$output .= '<div class="wdt-listings-contactform-container '.esc_attr( $attrs['class'] ).'">';

					$output .= '<form method="post" class="wdt-listings-contactform" name="wdt-listings-contactform">';

						$current_user = wp_get_current_user();
						$user_id = $current_user->ID;

						if(!is_user_logged_in()) {

							$output .= '<div class="wdt-column wdt-one-column first">
											<input class="wdt-contactform-name" name="wdt_contactform_name" type="text" placeholder="'.esc_attr__('Name','wdt-portfolio').'" required />
											<span></span>
										</div>';

							$output .= '<div class="wdt-listings-contactform-item">';

								$output .= '<div class="wdt-column wdt-one-column first">
												<input class="wdt-contactform-email" name="wdt_contactform_email" type="text" placeholder="'.esc_attr__('Email','wdt-portfolio').'" required />
												<span></span>
											</div>';

								$output .= '<div class="wdt-column wdt-one-column first">
												<input class="wdt-contactform-phone" name="wdt_contactform_phone" type="text" placeholder="'.esc_attr__('Phone','wdt-portfolio').'" required />
												<span></span>
											</div>';

							$output .= '</div>';

						}

						if($attrs['textarea_placeholder'] != '') {
							$listing_title = get_the_title($attrs['listing_id']);
							$textarea_placeholder = str_replace('{{title}}', $listing_title, $attrs['textarea_placeholder']);
						} else {
							$textarea_placeholder = esc_html__('Message','wdt-portfolio');
						}

						if($attrs['submit_label'] != '') {
							$submit_label = $attrs['submit_label'];
						} else {
							$submit_label = esc_html__('Submit','wdt-portfolio');
						}

						$output .= '<div class="wdt-column wdt-one-column first">
										<textarea class="wdt-contactform-message" name="wdt_contactform_message" rows="5" placeholder="'.esc_attr($textarea_placeholder).'"></textarea>
										<span></span>
									</div>';

						$output .= '<input class="wdt-contactform-listingid" name="wdt_contactform_listingid" type="hidden" value="'.esc_attr($attrs['listing_id']).'" />';
						$output .= '<input class="wdt-contactform-userid" name="wdt_contactform_userid" type="hidden" value="'.esc_attr($user_id).'" />';
						$output .= '<input class="wdt-contactform-contactpoint" name="wdt_contactform_contactpoint" type="hidden" value="'.esc_attr($attrs['contact_point']).'" />';
						$output .= '<input class="wdt-contactform-includeadmin" name="wdt_contactform_includeadmin" type="hidden" value="'.esc_attr($attrs['include_admin']).'" />';
						$output .= '<input class="wdt-contactform-nonce" name="wdt_contactform_nonce" type="hidden" value="'.wp_create_nonce('contact_listing_'.$attrs['listing_id']).'" />';

						$output .= '<div class="wdt-contactform-notification-box"></div>';

						$output .= '<a class="wdt-contactform-submit-button">'.esc_html__($submit_label).'</a>';

					$output .= '</form>';

				$output .= '</div>';

			} else {

				$listing_singular_label = apply_filters( 'listing_label', 'singular' );

				$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

			}

			return $output;

		}

		function wdt_sp_post_date( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'listing_id'       => '',
				'type'             => 'type1',
				'include_posttime' => '',
				'with_label'       => '',
				'with_icon'        => '',
				'class'            => ''
			), $attrs, 'wdt_sp_post_date' );

			$output = '';

			if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
				global $post;
				$attrs['listing_id'] = $post->ID;
			}

			if($attrs['listing_id'] != '') {

				if($attrs['type'] == 'listing') {
					$attrs['type'] = '';
				}

				$output .= '<div class="wdt-listings-post-dates-container '.esc_attr( $attrs['type'] ).' '.esc_attr( $attrs['class'] ).'">';

					$wdt_post_date = get_the_date( get_option('date_format'), $attrs['listing_id'] );

					if($wdt_post_date != '') {

						$output .= '<div class="wdt-listings-post-date-container">';

							if($attrs['with_icon'] == 'true') {
								$output .= '<span class="wdt-listings-post-date-icon"></span>';
							}

							if($attrs['with_label'] == 'true') {
								$output .= '<label class="wdt-listings-post-date-label">'.esc_html__('Posted On: ','wdt-portfolio').'</label>';
							}

							$output .= '<div class="wdt-listings-post-datetime-holder">';

								$output .= '<div class="wdt-listings-post-date-holder">';
									$output .= $wdt_post_date;
								$output .= '</div>';

								if($attrs['include_posttime'] == 'true') {

									$output .= '<div class="wdt-listings-post-time-holder">';

										$wdt_24_hour_format = get_post_meta($attrs['listing_id'], 'wdt_24_hour_format', true);

										if($wdt_24_hour_format == 'true') {
											$output .= get_the_time( 'G:i', $attrs['listing_id'] );
										} else {
											$output .= get_the_time( 'g:i A', $attrs['listing_id'] );
										}

									$output .= '</div>';

								}

							$output .= '</div>';

						$output .= '</div>';
					}

				$output .= '</div>';

			} else {

				$listing_singular_label = apply_filters( 'listing_label', 'singular' );

				$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

			}

			return $output;

		}

		function wdt_sp_mls_number( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'listing_id' => '',
				'type'       => 'type1',
				'with_label' => '',
				'class'      => '',
			), $attrs, 'wdt_sp_mls_number' );

			$output = '';

			if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
				global $post;
				$attrs['listing_id'] = $post->ID;
			}

			if($attrs['listing_id'] != '') {

				$wdt_mls_number = get_post_meta($attrs['listing_id'], 'wdt_mls_number', true);
				if($wdt_mls_number != '') {

					if($attrs['type'] == 'listing') {
						$attrs['type'] = '';
					}

					$output .= '<div class="wdt-listings-mls-number-container '.esc_attr( $attrs['type'] ).' '.esc_attr( $attrs['class'] ).'">';
						if($attrs['with_label'] == 'true') {
							$output .= '<label class="wdt-listings-mls-number-label">'.esc_html__('MLS Number: ','wdt-portfolio').'</label>';
						}
						$output .= '<span>'.esc_html($wdt_mls_number).'</span>';
					$output .= '</div>';

				}
			} else {

				$listing_singular_label = apply_filters( 'listing_label', 'singular' );
				$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );
			}

			return $output;
		}

        function wdt_sp_navigation( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'listing_id' => '',
				'type' => 'type1',
				'class' => '',
			), $attrs, 'wdt_sp_navigation' );

			$output = '';

			if($attrs['listing_id'] == '' && is_singular('wdt_listings')) {
				global $post;
				$attrs['listing_id'] = $post->ID;
			}

			if($attrs['listing_id'] != '') {

                $output .= '<div class="wdt-listings-nav-container '.esc_attr( $attrs['type'] ).'  '.esc_attr( $attrs['class'] ).'">';

                    $prev_post = get_previous_post();
                    if(!empty($prev_post)) {

                        $output .= '<div class="wdt-listings-nav-prev-wrapper">';
                            if(has_post_thumbnail($prev_post->ID)) {
                                $url = get_the_post_thumbnail_url($prev_post->ID, 'full');
                                $output .= '<a href="'.get_permalink($prev_post->ID).'" style=background-image:url('.esc_url($url).') class="wdt-listings-nav-prev-bgimg"></a>';
                            }
                            $output .= '<div class="wdt-listings-nav-title-wrapper">';
                                $output .= '<p><a href="'.get_permalink($prev_post->ID).'">'.esc_html__('Previous Portfolio','wdt-portfolio').'</a></p>';
                                $output .= '<span class="zmdi zmdi-long-arrow-left zmdi-hc-fw"></span>';
                                $output .= '<h3><a href="'.get_permalink($prev_post->ID).'" title="'.esc_attr($prev_post->post_title).'">';
                                    if(get_the_title($prev_post->ID)) {
                                        $output .= ($prev_post->post_title);
                                    } else {
                                        $output .= esc_html__('Previous Portfolio', 'wdt-portfolio');
                                    }
                                $output .= '</a></h3>';
                            $output .= '</div>';
                        $output .= '</div>';

                    } else {

                        $output .= '<div class="wdt-listings-nav-prev-wrapper no-post">';
                            $output .= '<a href="#" style="background-image:url('.esc_url(WDT_PLUGIN_URL.'/assets/images/no-post.jpg').');" class="wdt-listings-nav-prev-bgimg"></a>';
                            $output .= '<div class="wdt-listings-nav-title-wrapper">';
                                $output .= '<span class="zmdi zmdi-long-arrow-left zmdi-hc-fw"></span>';
                                $output .= '<h3>'.esc_html__('No previous portfolio to show!', 'wdt-portfolio').'</h3>';
                            $output .= '</div>';
                        $output .= '</div>';

                    }

                    if($attrs['type'] == 'type2'){
                        $output .= '<a href="'.esc_url(get_post_type_archive_link('wdt_listings')).'" class="wdt-single-portfolio-nav-back-btn"><span>'.esc_html__('Back to portfolios', 'wdt-portfolio').'</span></a>';
                    }

                    $next_post = get_next_post();
                    if(!empty($next_post)) {

                        $output .= '<div class="wdt-listings-nav-next-wrapper">';
                            if(has_post_thumbnail($next_post->ID)) {
                                $url = get_the_post_thumbnail_url($next_post->ID, 'full');
                                $output .= '<a href="'.get_permalink($next_post->ID).'" style=background-image:url('.esc_url($url).') class="wdt-listings-nav-next-bgimg"></a>';
                            }
                            $output .= '<div class="wdt-listings-nav-title-wrapper">';
                                $output .= '<p><a href="'.get_permalink($next_post->ID).'">'.esc_html__('Next Portfolio','wdt-portfolio').'</a></p>';
                                $output .= '<span class="zmdi zmdi-long-arrow-left zmdi-hc-fw"></span>';
                                $output .= '<h3><a href="'.get_permalink($next_post->ID).'" title="'.esc_attr($next_post->post_title).'">';
                                    if(get_the_title($next_post->ID)) {
                                        $output .= ($next_post->post_title);
                                    } else {
                                        $output .= esc_html__('Next Portfolio', 'wdt-portfolio');
                                    }
                                $output .= '</a></h3>';
                            $output .= '</div>';
                        $output .= '</div>';

                    } else {

                        $output .= '<div class="wdt-listings-nav-next-wrapper no-post">';
                            $output .= '<a href="#" style="background-image:url('.esc_url(WDT_PLUGIN_URL.'/assets/images/no-post.jpg').');"  class="wdt-listings-nav-next-bgimg"></a>';
                            $output .= '<div class="wdt-listings-nav-title-wrapper">';
                                $output .= '<span class="zmdi zmdi-long-arrow-left zmdi-hc-fw"></span>';
                                $output .= '<h3>'.esc_html__('No next portfolio to show!', 'wdt-portfolio').'</h3>';
                            $output .= '</div>';
                        $output .= '</div>';

                    }

                $output .= '</div>';

			} else {

				$listing_singular_label = apply_filters( 'listing_label', 'singular' );
				$output .= sprintf( esc_html__('Please provide %1$s id to display corresponding data!','wdt-portfolio'), strtolower($listing_singular_label) );

			}

			return $output;
		}

	}

	WDTPortfolioSinglePageShortcodes::instance();
}
?>