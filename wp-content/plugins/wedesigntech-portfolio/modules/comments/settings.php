<?php

function wdt_settings_comments_content() {

	$output = '';

	$listing_singular_label = apply_filters( 'listing_label', 'singular' );
	$listing_plural_label   = apply_filters( 'listing_label', 'plural' );

	$output .= '<form name="formOptionSettings" class="formOptionSettings" method="post">';

		$output .= '<div class="wdt-settings-options-holder">';
			$output .= '<div class="wdt-column wdt-one-fifth first">';
				$output .= '<label>'.esc_html__( 'Comment Requires Active Package','wdt-portfolio') .'</label>';
			$output .= '</div>';
			$output .= '<div class="wdt-column wdt-four-fifth">';
				$checked = ( 'true' ==  wdt_option('comments','comment-requires-package') ) ? ' checked="checked"' : '';
				$switchclass = ( 'true' ==  wdt_option('comments','comment-requires-package') ) ? 'checkbox-switch-on' :'checkbox-switch-off';
				$output .= '<div data-for="comment-requires-package" class="wdt-checkbox-switch '.esc_attr( $switchclass ).'"></div>';
				$output .= '<input id="comment-requires-package" class="hidden" type="checkbox" name="wdt[comments][comment-requires-package]" value="true" '.esc_attr( $checked ).' />';
			$output .= '</div>';
		$output .= '</div>';

		$output .= '<div class="wdt-option-settings-response-holder"></div>';

		$output .= '<a href="#" class="custom-button-style wdt-save-options-settings" data-settings="comments">'.esc_html__('Save Settings','wdt-portfolio').'</a>';

	$output .= '</form>';

	return $output;

}

echo wdt_settings_comments_content();
?>