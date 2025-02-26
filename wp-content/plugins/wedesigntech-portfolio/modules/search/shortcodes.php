<?php
if( !class_exists('WDTPortfolioSearchFormShortcodes') ) {

	class WDTPortfolioSearchFormShortcodes {

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

			add_shortcode ( 'wdt_sf_keyword_field', array ( $this, 'wdt_sf_keyword_field' ) );
			add_shortcode ( 'wdt_sf_categories_field', array ( $this, 'wdt_sf_categories_field' ) );
			add_shortcode ( 'wdt_sf_tags_field', array ( $this, 'wdt_sf_tags_field' ) );
			add_shortcode ( 'wdt_sf_features_field', array ( $this, 'wdt_sf_features_field' ) );
			add_shortcode ( 'wdt_sf_orderby_field', array ( $this, 'wdt_sf_orderby_field' ) );
			add_shortcode ( 'wdt_sf_mls_number_field', array ( $this, 'wdt_sf_mls_number_field' ) );

			add_shortcode ( 'wdt_sf_submit_button', array ( $this, 'wdt_sf_submit_button' ) );

			add_shortcode ( 'wdt_sf_output_data_container', array ( $this, 'wdt_sf_output_data_container' ) );

		}

		function wdt_shortcodeHelper($content = null) {
			$content = do_shortcode ( shortcode_unautop ( $content ) );
			$content = preg_replace ( '#^<\/p>|^<br \/>|<p>$#', '', $content );
			$content = preg_replace ( '#<br \/>#', '', $content );
			return trim ( $content );
		}

		function wdt_sf_keyword_field( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'placeholder_text' => '',
				'ajax_load'        => '',
				'class'            => '',
			), $attrs, 'wdt_sf_keyword_field' );


			$output = '';

			$output .= '<div class="wdt-sf-fields-holder wdt-sf-keyword-field-holder '.esc_attr( $attrs['class'] ).'">';

				$additional_class = '';
				if($attrs['ajax_load'] == 'true') {
					$additional_class = 'wdt-with-ajax-load';
				}

				$placeholder_text = esc_html__('Keyword','wdt-portfolio');
				if($attrs['placeholder_text'] != '') {
					$placeholder_text = esc_html($attrs['placeholder_text']);
				}

				$wdt_sf_keyword = '';
				if(isset($_REQUEST['wdt_sf_keyword']) && $_REQUEST['wdt_sf_keyword'] != '') {
					$wdt_sf_keyword = wdt_sanitize_fields($_REQUEST['wdt_sf_keyword']);
				}

				$output .= '<input name="wdt_sf_keyword" class="wdt-sf-field wdt-sf-keyword '.esc_attr($additional_class).'" type="text" value="'.esc_attr($wdt_sf_keyword).'" placeholder="'.esc_attr($placeholder_text).'"/>';
				$output .= '<span></span>';

			$output .= '</div>';

			return $output;

		}

		function wdt_sf_categories_field( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'field_type'              => '',
				'placeholder_text'        => '',
				'dropdown_type'           => '',
				'ajax_load'               => '',
				'default_item_id'         => '',
				'show_parent_items_alone' => 'false',
				'child_of'                => '',
				'class'                   => '',
			), $attrs, 'wdt_sf_categories_field' );


			$output = '';

			$output .= '<div class="wdt-sf-fields-holder wdt-sf-categories-field-holder '.esc_attr( $attrs['class'] ).'">';

				$additional_class = '';
				if($attrs['ajax_load'] == 'true') {
					$additional_class = 'wdt-with-ajax-load';
				}

				$wdt_sf_categories = array ();
				if(isset($_REQUEST['wdt_sf_categories'])) {
					if(is_array($_REQUEST['wdt_sf_categories']) && !empty($_REQUEST['wdt_sf_categories'])) {
						$wdt_sf_categories = wdt_sanitize_fields($_REQUEST['wdt_sf_categories']);
					} else if($_REQUEST['wdt_sf_categories'] != '') {
						$wdt_sf_categories = explode(',', wdt_sanitize_fields($_REQUEST['wdt_sf_categories']));
					}
				} elseif($attrs['default_item_id'] != '') {
					$wdt_sf_categories = explode(',', wdt_sanitize_fields($attrs['default_item_id']));
				}

				$placeholder_text = esc_html__('Categories','wdt-portfolio');
				if($attrs['placeholder_text'] != '') {
					$placeholder_text = esc_html($attrs['placeholder_text']);
				}

				if($attrs['field_type'] == 'dropdown') {

					$mulitple_attr = '';
					if($attrs['dropdown_type'] == 'multiple') {
						$mulitple_attr = 'multiple';
					}

					$output .= '<select class="wdt-sf-field wdt-sf-categories '.esc_attr($additional_class).' wdt-chosen-select" name="wdt_sf_categories" data-placeholder="'.esc_attr($placeholder_text).'" '.esc_attr($mulitple_attr).'>';
						if($mulitple_attr == '') {
							$output .= '<option value="">'.esc_html($placeholder_text).'</option>';
						}

						$categories_args = array (
							'taxonomy'   => 'wdt_listings_category',
							'hide_empty' => 1,
						);

						if($attrs['child_of'] != '') {
							$categories_args['child_of'] = $attrs['child_of'];
						} else {
							$categories_args['parent'] = 0;
						}
						$listing_categories = get_categories($categories_args);

						if(is_array($listing_categories) && !empty($listing_categories)) {
							foreach($listing_categories as $listing_category) {
								$selected_attr = '';
								if(in_array($listing_category->term_id, $wdt_sf_categories)) {
									$selected_attr = 'selected="selected"';
								}
								$output .= '<option value="'.esc_attr($listing_category->term_id).'" '.$selected_attr.'>'.esc_html($listing_category->name).'</option>';

								if($attrs['show_parent_items_alone'] != 'true') {

									// Child Items
									$listing_category_childs = get_categories('taxonomy=wdt_listings_category&hide_empty=1&child_of='.$listing_category->term_id);
									if(is_array($listing_category_childs) && !empty($listing_category_childs)) {
										foreach($listing_category_childs as $listing_category_child) {
											$selected_attr = '';
											if(in_array($listing_category_child->term_id, $wdt_sf_categories)) {
												$selected_attr = 'selected="selected"';
											}
											$output .= '<option value="'.esc_attr($listing_category_child->term_id).'" '.$selected_attr.'>'."&emsp;".esc_html($listing_category_child->name).'</option>';
										}
									}

								}

							}
						}
					$output .= '</select>';

				} else {

					$output .= '<ul>';
						$listing_categories = get_categories('taxonomy=wdt_listings_category&hide_empty=1');
						if(isset($listing_categories)) {
							foreach($listing_categories as $listing_category) {
								$output .= '<li>
												<input type="checkbox" name="wdt_sf_categories[]" class="wdt-sf-field wdt-sf-categories '.esc_attr($additional_class).'" value="'.esc_attr($listing_category->term_id).'" id="wdt-sf-category-'.esc_attr($listing_category->term_id).'" '.checked(in_array($listing_category->term_id, $wdt_sf_categories), true, false).' />
												<label for="wdt-sf-category-'.esc_attr($listing_category->term_id).'">'.esc_html($listing_category->name).'</label>
											</li>';
							}
						}
					$output .= '</ul>';

				}

			$output .= '</div>';

			return $output;

		}

		function wdt_sf_tags_field( $attrs, $content = null ) {
			$attrs = shortcode_atts ( array (
				'field_type'       => '',
				'placeholder_text' => '',
				'dropdown_type'    => '',
				'ajax_load'        => '',
				'class'            => '',
			), $attrs, 'wdt_sf_tags_field' );

			$output = '';

			$output .= '<div class="wdt-sf-fields-holder wdt-sf-tags-field-holder '.esc_attr( $attrs['class'] ).'">';

				$additional_class = '';
				if($attrs['ajax_load'] == 'true') {
					$additional_class = 'wdt-with-ajax-load';
				}

				$wdt_sf_tags = array ();
				if(isset($_REQUEST['wdt_sf_tags'])) {
					if(is_array($_REQUEST['wdt_sf_tags']) && !empty($_REQUEST['wdt_sf_tags'])) {
						$wdt_sf_tags = wdt_sanitize_fields($_REQUEST['wdt_sf_tags']);
					} else if($_REQUEST['wdt_sf_tags'] != '') {
						$wdt_sf_tags = explode(',', wdt_sanitize_fields($_REQUEST['wdt_sf_tags']));
					}
				}

				$amenity_plural_label = apply_filters( 'amenity_label', 'plural' );

				$placeholder_text = $amenity_plural_label;
				if($attrs['placeholder_text'] != '') {
					$placeholder_text = esc_html($attrs['placeholder_text']);
				}

				if($attrs['field_type'] == 'dropdown') {

					$mulitple_attr = '';
					if($attrs['dropdown_type'] == 'multiple') {
						$mulitple_attr = 'multiple';
					}

					$output .= '<select class="wdt-sf-field wdt-sf-tags '.esc_attr($additional_class).' wdt-chosen-select" name="wdt_sf_tags" data-placeholder="'.esc_attr($placeholder_text).'" '.esc_attr($mulitple_attr).'>';
						if($mulitple_attr == '') {
							$output .= '<option value="">'.esc_html($placeholder_text).'</option>';
						}
						$listing_tags = get_categories('taxonomy=wdt_listings_amenity&hide_empty=1');
						if(isset($listing_tags)) {
							foreach($listing_tags as $listing_tag) {
								$selected_attr = '';
								if(in_array($listing_tag->term_id, $wdt_sf_tags)) {
									$selected_attr = 'selected="selected"';
								}
								$output .= '<option value="'.esc_attr($listing_tag->term_id).'" '.$selected_attr.'>'.esc_html($listing_tag->name).'</option>';
							}
						}
					$output .= '</select>';

				} else {

					$output .= '<ul>';
						$listing_tags = get_categories('taxonomy=wdt_listings_amenity&hide_empty=1');
						if(isset($listing_tags)) {
							foreach($listing_tags as $listing_tag) {
								$output .= '<li>
												<input type="checkbox" name="wdt_sf_tags[]" class="wdt-sf-field wdt-sf-tags '.esc_attr($additional_class).'" value="'.esc_attr($listing_tag->term_id).'" id="wdt-sf-tag-'.esc_attr($listing_tag->term_id).'" '.checked(in_array($listing_tag->term_id, $wdt_sf_tags), true, false).' />
												<label for="wdt-sf-tag-'.esc_attr($listing_tag->term_id).'">'.esc_html($listing_tag->name).'</label>
											</li>';
							}
						}
					$output .= '</ul>';

				}

			$output .= '</div>';

			return $output;

		}

		function wdt_sf_features_field( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'tab_id'               => '',
				'field_type'           => 'range',
				'placeholder_text'     => '',
				'min_value'            => 1,
				'max_value'            => 100,
				'dropdownlist_options' => '',
				'dropdown_type'        => '',
				'item_unit'            => '',
				'ajax_load'            => '',
				'class'                => '',
			), $attrs, 'wdt_sf_features_field' );

			$output = '';
			$output .= '<div class="wdt-sf-fields-holder wdt-sf-features-field-holder '.esc_attr( $attrs['class'] ).'">';

				if($attrs['tab_id'] != '') {

					$additional_class = '';
					if($attrs['ajax_load'] == 'true') {
						$additional_class = 'wdt-with-ajax-load';
					}

					// Tab Id
					$wdt_sf_features_tab_id = $attrs['tab_id'];
					$tab_id_name = '_tab'.$wdt_sf_features_tab_id;

					$output .= '<input name="wdt_sf_features_tab_id" class="wdt-sf-field wdt-sf-features-tab-id" type="hidden" value="'.esc_attr($wdt_sf_features_tab_id).'" />';


					// Item Unit
					$item_unit = $attrs['item_unit'];
					$output .= '<input name="wdt_sf_features_item_unit" class="wdt-sf-field wdt-sf-features-item-unit" type="hidden" value="'.esc_attr($item_unit).'" />';

					// Field Type
					$output .= '<input name="wdt_sf_features_field_type" class="wdt-sf-field wdt-sf-features-field-type" type="hidden" value="'.esc_attr($attrs['field_type']).'" />';

					// Extract Values
					$wdt_sf_features = array ();
					if(isset($_REQUEST['wdt_sf_features'.$tab_id_name])) {
						if(is_array($_REQUEST['wdt_sf_features'.$tab_id_name]) && !empty($_REQUEST['wdt_sf_features'.$tab_id_name])) {
							$wdt_sf_features = wdt_sanitize_fields($_REQUEST['wdt_sf_features'.$tab_id_name]);
						} else if($_REQUEST['wdt_sf_features'.$tab_id_name] != '') {
							$wdt_sf_features = explode(',', wdt_sanitize_fields($_REQUEST['wdt_sf_features'.$tab_id_name]));
						}
					}

					// Dropdown / List Options
					$dropdownlist_options = $attrs['dropdownlist_options'];
					$dropdownlist_options = ($dropdownlist_options != '') ? explode(',', $dropdownlist_options) : array ();

					if($attrs['field_type'] == 'dropdown') {

						if(!empty($dropdownlist_options)) {

							$placeholder_text = '';
							if($attrs['placeholder_text'] != '') {
								$placeholder_text = esc_html($attrs['placeholder_text']);
							}

							$mulitple_attr = '';
							if($attrs['dropdown_type'] == 'multiple') {
								$mulitple_attr = 'multiple';
							}

							$output .= '<select class="wdt-sf-field wdt-sf-features '.esc_attr($additional_class).' wdt-chosen-select" name="wdt_sf_features'.esc_attr( $tab_id_name ).'" data-placeholder="'.esc_attr($placeholder_text).'" '.esc_attr($mulitple_attr).'>';
								if($mulitple_attr == '') {
									$output .= '<option value="">'.esc_html($placeholder_text).'</option>';
								}
								if(isset($dropdownlist_options)) {
									foreach($dropdownlist_options as $dropdownlist_option) {
										$selected_attr = '';
										if(in_array($dropdownlist_option, $wdt_sf_features)) {
											$selected_attr = 'selected="selected"';
										}
										$output .= '<option value="'.esc_attr($dropdownlist_option).'" '.$selected_attr.'>'.esc_html($dropdownlist_option).'</option>';
									}
								}
							$output .= '</select>';

						}

					} else if($attrs['field_type'] == 'list') {

						if(!empty($dropdownlist_options)) {

							$output .= '<ul>';
								if(isset($dropdownlist_options)) {
									foreach($dropdownlist_options as $dropdownlist_option) {
										$output .= '<li>
														<input type="checkbox" name="wdt_sf_features'.esc_attr( $tab_id_name ).'[]" class="wdt-sf-field wdt-sf-features '.esc_attr($additional_class).'" value="'.esc_attr($dropdownlist_option).'" id="wdt-sf-features-'.esc_attr($dropdownlist_option).'" '.checked(in_array($dropdownlist_option, $wdt_sf_features), true, false).' />
														<label for="wdt-sf-features-'.esc_attr($dropdownlist_option).'">'.esc_html($dropdownlist_option).'</label>
													</li>';
									}
								}
							$output .= '</ul>';

						}

					} else {

						$wdt_sf_features_start = $attrs['min_value'];
						if(isset($_REQUEST['wdt_sf_features'.$tab_id_name.'_start']) && $_REQUEST['wdt_sf_features'.$tab_id_name.'_start'] != '') {
							$wdt_sf_features_start = wdt_sanitize_fields($_REQUEST['wdt_sf_features'.$tab_id_name.'_start']);
						}

						$wdt_sf_features_end = $attrs['max_value'];
						if(isset($_REQUEST['wdt_sf_features'.$tab_id_name.'_end']) && $_REQUEST['wdt_sf_features'.$tab_id_name.'_end'] != '') {
							$wdt_sf_features_end = wdt_sanitize_fields($_REQUEST['wdt_sf_features'.$tab_id_name.'_end']);
						}

						$output .= '<div class="wdt-sf-features-slider '.esc_attr($additional_class).'" data-min="'.esc_attr($attrs['min_value']).'" data-max="'.esc_attr($attrs['max_value']).'" data-updated-min="'.esc_attr($wdt_sf_features_start).'" data-updated-max="'.esc_attr($wdt_sf_features_end).'"  data-itemunit="'.esc_attr($item_unit).'">';
							$output .= '<div class="wdt-sf-features-slider-start-handle">'.esc_html($wdt_sf_features_start).' '.esc_html($item_unit).'</div>';
							$output .= '<div class="wdt-sf-features-slider-end-handle">'.esc_html($wdt_sf_features_end).' '.esc_html($item_unit).'</div>';
							$output .= '<div class="wdt-sf-features-slider-ranges">';
								$output .= '<div class="wdt-sf-features-slider-range-min-holder">';
									$output .= '<label>'.esc_html__('Min','wdt-portfolio').'</label>';
									$output .= '<div class="wdt-sf-features-slider-range-min">'.esc_html($attrs['min_value']).' '.esc_html($item_unit).'</div>';
								$output .= '</div>';
								$output .= '<div class="wdt-sf-features-slider-range-max-holder">';
									$output .= '<label>'.esc_html__('Max','wdt-portfolio').'</label>';
									$output .= '<div class="wdt-sf-features-slider-range-max">'.esc_html($attrs['max_value']).' '.esc_html($item_unit).'</div>';
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</div>';

						$output .= '<input name="wdt_sf_features'.esc_attr( $tab_id_name ).'_start" class="wdt-sf-field wdt-sf-features-start" type="hidden" value="'.esc_attr($wdt_sf_features_start).'" />';
						$output .= '<input name="wdt_sf_features'.esc_attr( $tab_id_name ).'_end" class="wdt-sf-field wdt-sf-features-end" type="hidden" value="'.esc_attr($wdt_sf_features_end).'" />';

					}

				} else {

					$output .= esc_html__('This features shortcode won\'t work without tab id. Please provide tab id.','wdt-portfolio');

				}

			$output .= '</div>';

			return $output;

		}

		function wdt_sf_orderby_field( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'field_type' => '',
				'placeholder_text' => '',
				'alphabetical_order' => 'true',
				'highestrated_order' => 'true',
				'mostreviewed_order' => 'true',
				'mostviewed_order' => 'true',
				'ajax_load' => '',
				'class' => '',
			), $attrs, 'wdt_sf_orderby_field' );


			$output = '';

			$output .= '<div class="wdt-sf-fields-holder wdt-sf-orderby-field-holder '.esc_attr( $attrs['class'] ).'">';

				$additional_class = '';
				if($attrs['ajax_load'] == 'true') {
					$additional_class = 'wdt-with-ajax-load';
				}

				$wdt_sf_orderby = array ();
				if(isset($_REQUEST['wdt_sf_orderby'])) {
					if(is_array($_REQUEST['wdt_sf_orderby']) && !empty($_REQUEST['wdt_sf_orderby'])) {
						$wdt_sf_orderby = wdt_sanitize_fields($_REQUEST['wdt_sf_orderby']);
					} else if($_REQUEST['wdt_sf_orderby'] != '') {
						$wdt_sf_orderby = explode(',', wdt_sanitize_fields($_REQUEST['wdt_sf_orderby']));
					}
				}

				$placeholder_text = esc_html__('Order By','wdt-portfolio');
				if($attrs['placeholder_text'] != '') {
					$placeholder_text = esc_html($attrs['placeholder_text']);
				}

				$orderby_items = array ();
				if($attrs['alphabetical_order'] == 'true') {
					$orderby_items['alphabetical'] = esc_html__('Alphabetical','wdt-portfolio');
				}
				if($attrs['highestrated_order'] == 'true') {
					$orderby_items['highest-rated'] = esc_html__('Highest Rated','wdt-portfolio');
				}
				if($attrs['mostreviewed_order'] == 'true') {
					$orderby_items['most-reviewed'] = esc_html__('Most Reviewed','wdt-portfolio');
				}
				if($attrs['mostviewed_order'] == 'true') {
					$orderby_items['most-viewed'] = esc_html__('Most Viewed','wdt-portfolio');
				}

				if($attrs['field_type'] == 'dropdown') {

					$output .= '<select class="wdt-sf-field wdt-sf-orderby '.esc_attr($additional_class).' wdt-chosen-select" name="wdt_sf_orderby">';
						$output .= '<option value="">'.esc_html($placeholder_text).'</option>';
						if(!empty($orderby_items)) {
							foreach($orderby_items as $orderby_item_key => $orderby_item) {
								$selected_attr = '';
								if(in_array($orderby_item_key, $wdt_sf_orderby)) {
									$selected_attr = 'selected="selected"';
								}
								$output .= '<option value="'.esc_attr($orderby_item_key).'" '.$selected_attr.'>'.esc_html($orderby_item).'</option>';
							}
						}
					$output .= '</select>';

				} else {

					$output .= '<ul class="wdt-sf-orderby-list '.esc_attr($additional_class).'">';
						if(!empty($orderby_items)) {
							foreach($orderby_items as $orderby_item_key => $orderby_item) {
								$output .= '<li>
												<a data-itemvalue="'.esc_attr($orderby_item_key).'" href="#">'.esc_html($orderby_item).'</a>
											</li>';
							}
						}
					$output .= '</ul>';

				}

			$output .= '</div>';

			return $output;

		}

		function wdt_sf_mls_number_field( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'placeholder_text' => '',
				'ajax_load' => '',
				'class' => '',
			), $attrs, 'wdt_sf_mls_number_field' );


			$output = '';

			$output .= '<div class="wdt-sf-fields-holder wdt-sf-mls-number-field-holder '.esc_attr( $attrs['class'] ).'">';

				$additional_class = '';
				if($attrs['ajax_load'] == 'true') {
					$additional_class = 'wdt-with-ajax-load';
				}

				$placeholder_text = esc_html__('MLS Number','wdt-portfolio');
				if($attrs['placeholder_text'] != '') {
					$placeholder_text = esc_html($attrs['placeholder_text']);
				}

				$wdt_sf_mls_number = '';
				if(isset($_REQUEST['wdt_sf_mls_number']) && $_REQUEST['wdt_sf_mls_number'] != '') {
					$wdt_sf_mls_number = wdt_sanitize_fields($_REQUEST['wdt_sf_mls_number']);
				}

				$output .= '<input name="wdt_sf_mls_number" class="wdt-sf-field wdt-sf-mls-number '.esc_attr($additional_class).'" type="text" value="'.esc_attr($wdt_sf_mls_number).'" placeholder="'.esc_attr($placeholder_text).'" />';
				$output .= '<span></span>';

			$output .= '</div>';

			return $output;

		}

		function wdt_sf_submit_button( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'output_type'       => '',
				'separate_page_url' => '',
				'class'             => '',
			), $attrs, 'wdt_sf_submit_button' );

			$output = '';
			$output .= '<div class="wdt-sf-fields-holder wdt-sf-submitbutton-field-holder '.esc_attr( $attrs['class'] ).'">';

				$additional_attr = $execution_class = 'wdt-execute';
				if($attrs['output_type'] == 'separate-page') {
					$additional_attr = esc_url($attrs['separate_page_url']);
					$execution_class = '';
				}

				$output .= '<a href="#" class="custom-button-style wdt-submit-searchform '.esc_attr($attrs['class']).' '.esc_attr($execution_class).'" data-outputtype="'.esc_attr($attrs['output_type']).'" data-separatepageurl="'.esc_attr( $additional_attr ).'">'.esc_html__('Submit','wdt-portfolio').'</a>';

			$output .= '</div>';

			return $output;

		}

		function wdt_sf_output_data_container( $attrs, $content = null ) {

			$attrs = shortcode_atts ( array (
				'type'                   => 'type1',
				'gallery'                => 'featured_image',
				'post_per_page'          => '',
				'columns'                => 1,
				'apply_isotope'          => '',
				'excerpt_length'         => '',
				'features_image_or_icon' => '',
				'features_include'       => '',
				'no_of_cat_to_display'   => 2,
				'apply_equal_height'     => 'false',
				'apply_custom_height'    => 'false',
				'height'                 => '',
				'vc_height'              => '',
				'sidebar_widget'         => 'false',
				'category_ids'           => '',
				'class'                  => '',
			), $attrs, 'wdt_sf_output_data_container' );

			$output = '';
			$data_attributes = array ();
			array_push($data_attributes, 'data-type="'.esc_attr($attrs['type']).'"');
			array_push($data_attributes, 'data-gallery="'.esc_attr($attrs['gallery']).'"');
			array_push($data_attributes, 'data-postperpage="'.esc_attr($attrs['post_per_page']).'"');
			array_push($data_attributes, 'data-columns="'.esc_attr($attrs['columns']).'"');
			array_push($data_attributes, 'data-applyisotope="'.esc_attr($attrs['apply_isotope']).'"');
			array_push($data_attributes, 'data-excerptlength="'.esc_attr($attrs['excerpt_length']).'"');
			array_push($data_attributes, 'data-featuresimageoricon="'.esc_attr($attrs['features_image_or_icon']).'"');
			array_push($data_attributes, 'data-featuresinclude="'.esc_attr($attrs['features_include']).'"');
			array_push($data_attributes, 'data-noofcattodisplay="'.esc_attr($attrs['no_of_cat_to_display']).'"');
			array_push($data_attributes, 'data-applyequalheight="'.esc_attr($attrs['apply_equal_height']).'"');
			array_push($data_attributes, 'data-categoryids="'.esc_attr($attrs['category_ids']).'"');

			// Custom attributes update from modules
			$wdt_custom_options = apply_filters('wdt_sf_output_data_container_data_attrs_from_modules', '', $attrs);
			array_push($data_attributes, 'data-customoptions="'.esc_attr($wdt_custom_options).'"');

			if(!empty($data_attributes)) {
				$data_attributes_string = implode(' ', $data_attributes);
			}

			if($attrs['apply_custom_height'] == 'true') {
				$attrs['class'] .= " wdt-content-scroll";
			}

			if($attrs['sidebar_widget'] == 'true') {
				$attrs['class'] .= " wdt-listings-sidebar-widget";
			}

			$height_attr = '';
			if($attrs['vc_height'] != '') {
				$height_attr = 'style="height:'.$attrs['vc_height'].'px;"';
			}

			$output .= '<div class="wdt-listing-output-data-container wdt-search-list-items  '.esc_attr( $attrs['class'] ).'" '.$height_attr.'>';
				$output .= '<div class="wdt-listing-output-data-holder" '.$data_attributes_string.'></div>';
				$output .= wdt_generate_loader_html(false);
			$output .= '</div>';

			return $output;

		}

	}

	WDTPortfolioSearchFormShortcodes::instance();

}

?>