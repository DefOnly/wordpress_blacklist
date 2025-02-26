<?php

function wdt_settings_skin_content() {

	$output = '';

	$skin_settings = get_option('wdt-skin-settings');

	$primary_color = ( isset($skin_settings['primary-color']) && '' !=  $skin_settings['primary-color'] ) ? $skin_settings['primary-color'] : '#1e306e';
	$secondary_color = ( isset($skin_settings['secondary-color']) && '' !=  $skin_settings['secondary-color'] ) ? $skin_settings['secondary-color'] : '#2fa5fb';
	$tertiary_color = ( isset($skin_settings['tertiary-color']) && '' !=  $skin_settings['tertiary-color'] ) ? $skin_settings['tertiary-color'] : '#d2edf8';

	$primary_alternate_color = ( isset($skin_settings['primary-alternate-color']) && '' !=  $skin_settings['primary-alternate-color'] ) ? $skin_settings['primary-alternate-color'] : '';
	$secondary_alternate_color = ( isset($skin_settings['secondary-alternate-color']) && '' !=  $skin_settings['secondary-alternate-color'] ) ? $skin_settings['secondary-alternate-color'] : '';
	$tertiary_alternate_color = ( isset($skin_settings['tertiary-alternate-color']) && '' !=  $skin_settings['tertiary-alternate-color'] ) ? $skin_settings['tertiary-alternate-color'] : '';


	$output .= '<form name="formSkinSettings" class="formSkinSettings" method="post">';

		$output .= '<div class="wdt-note">'.esc_html__('Following colors will be used as default colors for "WeDesignTech Portfolio Addon".','wdt-portfolio').'</div>';

		$output .= '<div class="wdt-column wdt-one-third first">';
			$output .= '<div class="wdt-settings-options-holder">';
				$output .= '<div class="wdt-column wdt-one-fifth first">';
					$output .= '<label>'.esc_html__( 'Primary Color','wdt-portfolio').'</label>';
				$output .= '</div>';
				$output .= '<div class="wdt-column wdt-four-fifth">';
		            $output .= '<input name="wdt-skin-settings[primary-color]" class="wdt-color-field color-picker" data-alpha="true" type="text" value="'.esc_attr( $primary_color ).'" />';
		            $output .= '<div class="wdt-note">'.esc_html__('Choose primary color module skin.','wdt-portfolio').'</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';

		$output .= '<div class="wdt-column wdt-one-third">';
			$output .= '<div class="wdt-settings-options-holder">';
				$output .= '<div class="wdt-column wdt-one-fifth first">';
					$output .= '<label>'.esc_html__( 'Secondary Color','wdt-portfolio').'</label>';
				$output .= '</div>';
				$output .= '<div class="wdt-column wdt-four-fifth">';
		            $output .= '<input name="wdt-skin-settings[secondary-color]" class="wdt-color-field color-picker" data-alpha="true" type="text" value="'.esc_attr( $secondary_color ).'" />';
		            $output .= '<div class="wdt-note">'.esc_html__('Choose secondary color module skin.','wdt-portfolio').'</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';

		$output .= '<div class="wdt-column wdt-one-third">';
			$output .= '<div class="wdt-settings-options-holder">';
				$output .= '<div class="wdt-column wdt-one-fifth first">';
					$output .= '<label>'.esc_html__( 'Tertiary Color','wdt-portfolio').'</label>';
				$output .= '</div>';
				$output .= '<div class="wdt-column wdt-four-fifth">';
		            $output .= '<input name="wdt-skin-settings[tertiary-color]" class="wdt-color-field color-picker" data-alpha="true" type="text" value="'.esc_attr( $tertiary_color ).'" />';
		            $output .= '<div class="wdt-note">'.esc_html__('Choose tertiary color module skin.','wdt-portfolio').'</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';

		$output .= '<div class="wdt-hr-invisible"></div>';

		$output .= '<div class="wdt-skin-settings-response-holder"></div>';

		$output .= '<a href="#" class="custom-button-style wdt-save-skin-settings">'.esc_html__('Save Settings','wdt-portfolio').'</a>';

	$output .= '</form>';

    echo $output;

}

echo wdt_settings_skin_content();

?>