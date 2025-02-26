<?php
if ( ! function_exists( 'dada_template_part' ) ) {
	/**
	 * Function that echo module template part.
	 */
	function dada_template_part( $module, $template, $slug = '', $params = array() ) {
		echo dada_get_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'dada_get_template_part' ) ) {
	/**
	 * Function that load module template part.
	 */
	function dada_get_template_part( $module, $template, $slug = '', $params = array() ) {

		$file_path = '';
		$html      =  '';

		$template_path = DADA_MODULE_DIR . '/' . $module;
		$temp_path = $template_path . '/' . $template;

		if ( ! empty( $temp_path ) ) {
			if ( ! empty( $slug ) ) {
				$file_path = "{$temp_path}-{$slug}.php";
				if ( ! file_exists( $file_path ) ) {
					$file_path = $temp_path . '.php';
				}
			} else {
				$file_path = $temp_path . '.php';
			}
		}

		$file_path = apply_filters( 'dada_get_template_plugin_part', $file_path, $module, $template, $slug);

		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		if ( $file_path && file_exists( $file_path ) ) {
			ob_start();
			include( $file_path );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'dada_get_page_id' ) ) {
	function dada_get_page_id() {

		$page_id = get_queried_object_id();

		if( is_archive() || is_search() || is_404() || ( is_front_page() && is_home() ) ) {
			$page_id = -1;
		}

		return $page_id;
	}
}

/* Convert hexdec color string to rgb(a) string */
if ( ! function_exists( 'dada_hex2rgba' ) ) {
	function dada_hex2rgba($color, $opacity = false) {

		$default = 'rgb(0,0,0)';

		if(empty($color)) {
			return $default;
		}

		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		if (strlen($color) == 6) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
				return $default;
		}

		$rgb =  array_map('hexdec', $hex);

		if($opacity){
			if(abs($opacity) > 1) {
				$opacity = 1.0;
			}
			$output = implode(",",$rgb).','.$opacity;
		} else {
			$output = implode(",",$rgb);
		}

		return $output;

	}
}

if ( ! function_exists( 'dada_html_output' ) ) {
	function dada_html_output( $html ) {
		return apply_filters( 'dada_html_output', $html );
	}
}


if ( ! function_exists( 'dada_theme_defaults' ) ) {
	/**
	 * Function to load default values
	 */
	function dada_theme_defaults() {

		$defaults = array (
			'primary_color' => '#DD4242',
			'primary_color_rgb' => dada_hex2rgba('#DD4242', false),
			'secondary_color' => '#000000',
			'secondary_color_rgb' => dada_hex2rgba('#000000', false),
			'tertiary_color' => '#2F2F2F',
			'tertiary_color_rgb' => dada_hex2rgba('#2F2F2F', false),
			'quaternary_color' => '#F9F9F9',
			'quaternary_color_rgb' => dada_hex2rgba('#F9F9F9', false),
			'body_bg_color' => '#191919',
			'body_bg_color_rgb' => dada_hex2rgba('#191919', false),
			//Dark Mode starts
			'dark_primary_color' => '#dd4242',
			'dark_primary_color_rgb' => dada_hex2rgba('#dd4242', false),
			'dark_secondary_color' => '#1c1c1c',
			'dark_secondary_color_rgb' => dada_hex2rgba('#1c1c1c', false),
			'dark_tertiary_color' => '#e3e1d4',
			'dark_tertiary_color_rgb' => dada_hex2rgba('#e3e1d4', false),
			'dark_quaternary_color' => '#F9F9F9',
			'dark_quaternary_color_rgb' => dada_hex2rgba('#F9F9F9', false),
			'dark_body_bg_color' => '#ffffff',
			'dark_body_bg_color_rgb' => dada_hex2rgba('#ffffff', false),
			//Dark mode ends
			'body_text_color' => '#b5b5b5',
			'body_text_color_rgb' => dada_hex2rgba('#b5b5b5', false),
			'headalt_color' => '#FFFFFF',
			'headalt_color_rgb' => dada_hex2rgba('#FFFFFF', false),
			'link_color' => '#FFFFFF',
			'link_color_rgb' => dada_hex2rgba('#FFFFFF', false),
			'link_hover_color' => '#DD4242',
			'link_hover_color_rgb' => dada_hex2rgba('#DD4242', false),
			'border_color' => '#969696',
			'border_color_rgb' => dada_hex2rgba('#969696', false),
			'accent_text_color' => '#FFFFFF',
			'accent_text_color_rgb' => dada_hex2rgba('#FFFFFF', false),
			//Dark mode starts
			'dark_body_text_color' => '#4d4d4d',
			'dark_body_text_color_rgb' => dada_hex2rgba('#4d4d4d', false),
			'dark_headalt_color' => '#000000',
			'dark_headalt_color_rgb' => dada_hex2rgba('#000000', false),
			'dark_link_color' => '#000000',
			'dark_link_color_rgb' => dada_hex2rgba('#000000', false),
			'dark_link_hover_color' => '#dd4242',
			'dark_link_hover_color_rgb' => dada_hex2rgba('#dd4242', false),
			'dark_border_color' => '#969696',
			'dark_border_color_rgb' => dada_hex2rgba('#969696', false),
			'dark_accent_text_color' => '#FFFFFF',
			'dark_accent_text_color_rgb' => dada_hex2rgba('#FFFFFF', false),
			//Dark mode ends
			'body_typo' => array (
				'font-family' => "Poppins",
				'font-fallback' => '"Poppins", sans-serif',
				'font-weight' => 400,
				'fs-desktop' => 16,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.75,
				'lh-desktop-unit' => ''
			),
			'h1_typo' => array (
				'font-family' => "Poppins",
				'font-fallback' => '"Poppins", sans-serif',
				'font-weight' => 600,
				'fs-desktop' => 60,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.4,
				'lh-desktop-unit' => ''
			),
			'h2_typo' => array (
				'font-family' => "Poppins",
				'font-fallback' => '"Poppins", sans-serif',
				'font-weight' => 600,
				'fs-desktop' => 50,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.4,
				'lh-desktop-unit' => ''
			),
			'h3_typo' => array (
				'font-family' => "Poppins",
				'font-fallback' => '"Poppins", sans-serif',
				'font-weight' => 600,
				'fs-desktop' => 40,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.4,
				'lh-desktop-unit' => ''
			),
			'h4_typo' => array (
				'font-family' => "Poppins",
				'font-fallback' => '"Poppins", sans-serif',
				'font-weight' => 600,
				'fs-desktop' => 30,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.4,
				'lh-desktop-unit' => ''
			),
			'h5_typo' => array (
				'font-family' => "Poppins",
				'font-fallback' => '"Poppins", sans-serif',
				'font-weight' => 600,
				'fs-desktop' => 24,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.4,
				'lh-desktop-unit' => ''
			),
			'h6_typo' => array (
				'font-family' => "Poppins",
				'font-fallback' => '"Poppins", sans-serif',
				'font-weight' => 600,
				'fs-desktop' => 18,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.4,
				'lh-desktop-unit' => ''
			),
			'extra_typo' => array (
				'font-family' => "Dancing Script",
				'font-fallback' => '"Dancing Script", sans-serif',
				'font-weight' => 400,
				'fs-desktop' => 14,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1,
				'lh-desktop-unit' => ''
			),

		);

		return $defaults;

	}
}