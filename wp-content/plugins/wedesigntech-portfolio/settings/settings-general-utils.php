<?php

function wdt_settings_general_content() {

	$output = '';

	$listing_singular_label  = apply_filters( 'listing_label', 'singular' );

	$output .= '<form name="formOptionSettings" class="formOptionSettings" method="post">';

		$output .= '<div class="wdt-settings-options-holder">';
			$output .= '<div class="wdt-column wdt-one-fifth first">';
				$output .= '<label>'.sprintf(esc_html__('%1$s Single Page Template','wdt-portfolio'), $listing_singular_label).'</label>';
			$output .= '</div>';
			$output .= '<div class="wdt-column wdt-four-fifth">';

				$single_page_template = wdt_option('general','single-page-template');
				$tpl_args = array (
					'post_type'        => 'page',
					'meta_key'         => '_wp_page_template',
					'meta_value'       => 'tpl-single-listing.php',
					'suppress_filters' => 0
				);
				$single_tpl_posts = get_posts($tpl_args);

				$output .= '<select name="wdt[general][single-page-template]" class="wdt-chosen-select">';

					$output .= '<option value="custom-template" '.selected('custom-template', $single_page_template, false ).'>'.esc_html__('Custom Template','wdt-portfolio').'</option>';
					$output .= '<option value="default-template-1" '.selected('default-template-1', $single_page_template, false ).'>'.esc_html__('Default Template 1','wdt-portfolio').'</option>';
					$output .= '<option value="default-template-2" '.selected('default-template-2', $single_page_template, false ).'>'.esc_html__('Default Template 2','wdt-portfolio').'</option>';
					$output .= '<option value="default-template-3" '.selected('default-template-3', $single_page_template, false ).'>'.esc_html__('Default Template 3','wdt-portfolio').'</option>';
					$output .= '<option value="default-template-4" '.selected('default-template-4', $single_page_template, false ).'>'.esc_html__('Default Template 4','wdt-portfolio').'</option>';
					$output .= '<option value="default-template-5" '.selected('default-template-5', $single_page_template, false ).'>'.esc_html__('Default Template 5','wdt-portfolio').'</option>';

					if(is_array($single_tpl_posts) && !empty($single_tpl_posts)) {
						foreach($single_tpl_posts as $single_tpl_post) {
							$output .= '<option value="'.esc_attr( $single_tpl_post->ID ).'" '.selected($single_tpl_post->ID, $single_page_template, false ).'>';
								$output .= esc_html( $single_tpl_post->post_title );
							$output .= '</option>';
						}
					}
				$output .= '</select>';

				$output .= '<div class="wdt-note">'.sprintf( esc_html__('If you like to build your %1$s single page by your own choose "Custom Template" else choose one of the predefined templates created using "Portfolio Single Page Template".','wdt-portfolio'), $listing_singular_label ).'</div>';

			$output .= '</div>';
		$output .= '</div>';

		$output .= '<div class="wdt-settings-options-holder">';
			$output .= '<div class="wdt-column wdt-one-fifth first">';
				$output .= '<label>'.esc_html__( 'MLS Number - Prefix','wdt-portfolio').'</label>';
			$output .= '</div>';
			$output .= '<div class="wdt-column wdt-four-fifth">';
	            $mls_number_prefix = wdt_option('general','mls-number-prefix');
	            $output .= '<input id="mls-number-prefix" name="wdt[general][mls-number-prefix]" type="text" value="'.esc_attr( $mls_number_prefix ).'" maxlength="4" style="text-transform:uppercase" />';
	            $output .= '<div class="wdt-note">'.esc_html__('If you wish you can add prefix for your MLS number.','wdt-portfolio').'</div>';
			$output .= '</div>';
		$output .= '</div>';

		$output .= '<div class="wdt-settings-options-holder">';
			$output .= '<div class="wdt-column wdt-one-fifth first">';
				$output .= '<label>'.esc_html__( 'MLS Number - Total Digits','wdt-portfolio').'</label>';
			$output .= '</div>';
			$output .= '<div class="wdt-column wdt-four-fifth">';
	            $mls_number_digits = wdt_option('general','mls-number-digits');
	            $output .= '<input id="mls-number-digits" name="wdt[general][mls-number-digits]" type="number" value="'.esc_attr( $mls_number_digits ).'" min="1" max="8" step="1"  />';
	            $output .= '<div class="wdt-note">'.esc_html__('If you wish you can add digits for your MLS number. Max value : 8','wdt-portfolio').'</div>';
			$output .= '</div>';
		$output .= '</div>';

		$output .= '<div class="wdt-settings-options-holder">';
			$output .= '<div class="wdt-column wdt-one-fifth first">';
				$output .= '<label>'.esc_html__( 'Restrict Page View Counter Over User IP','wdt-portfolio').'</label>';
			$output .= '</div>';
			$output .= '<div class="wdt-column wdt-four-fifth">';
                $checked = ( 'true' ==  wdt_option('general', 'restrict-counter-overuserip') ) ? ' checked="checked"' : '';
                $switchclass = ( 'true' ==  wdt_option('general', 'restrict-counter-overuserip') ) ? 'checkbox-switch-on' :'checkbox-switch-off';
	            $output .= '<div data-for="restrict-counter-overuserip" class="wdt-checkbox-switch '.esc_attr( $switchclass ).'"></div>';
	            $output .= '<input id="restrict-counter-overuserip" class="hidden" type="checkbox" name="wdt[general][restrict-counter-overuserip]" value="true" '.$checked.' />';
	            $output .= '<div class="wdt-note">'.esc_html__( 'YES! to restrict page view counter over user ip address. Second entry from same ip address will be restricted.','wdt-portfolio').'</div>';
			$output .= '</div>';
		$output .= '</div>';

		$output .= '<div class="wdt-option-settings-response-holder"></div>';

		$output .= '<a href="#" class="custom-button-style wdt-save-options-settings" data-settings="general">'.esc_html__('Save Settings','wdt-portfolio').'</a>';

	$output .= '</form>';

	return $output;

}

echo wdt_settings_general_content();

?>