<?php

/*
* Update Summary - Options Filter
*/

if( ! function_exists( 'dada_shop_woo_single_summary_options_cdada_render' ) ) {
	function dada_shop_woo_single_summary_options_cdada_render( $options ) {

		$options['countdown'] = esc_html__('Summary Count Down', 'dada-pro');
		return $options;

	}
	add_filter( 'dada_shop_woo_single_summary_options', 'dada_shop_woo_single_summary_options_cdada_render', 10, 1 );

}

/*
* Update Summary - Styles Filter
*/

if( ! function_exists( 'dada_shop_woo_single_summary_styles_cdada_render' ) ) {
	function dada_shop_woo_single_summary_styles_cdada_render( $styles ) {

		array_push( $styles, 'wdt-shop-coundown-timer' );
		return $styles;

	}
	add_filter( 'dada_shop_woo_single_summary_styles', 'dada_shop_woo_single_summary_styles_cdada_render', 10, 1 );

}

/*
* Update Summary - Scripts Filter
*/

if( ! function_exists( 'dada_shop_woo_single_summary_scripts_cdada_render' ) ) {
	function dada_shop_woo_single_summary_scripts_cdada_render( $scripts ) {

		array_push( $scripts, 'jquery-downcount' );
		array_push( $scripts, 'wdt-shop-coundown-timer' );
		return $scripts;

	}
	add_filter( 'dada_shop_woo_single_summary_scripts', 'dada_shop_woo_single_summary_scripts_cdada_render', 10, 1 );

}