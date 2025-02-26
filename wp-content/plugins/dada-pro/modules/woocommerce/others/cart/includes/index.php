<?php

/*
 * Cross Sell Product Listing
 */

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

if( ! function_exists( 'dada_shop_cross_sell_display' ) ) {

	function dada_shop_cross_sell_display() {

		$settings = dada_woo_others()->woo_default_settings();
		extract($settings);

		dada_shop_others_cart()->woo_load_listing( $cross_sell_style_template, $cross_sell_style_custom_template );

		$product_display_type = wc_get_loop_prop( 'product-display-type', 'grid' );
		if($product_display_type == 'list') {
			$cross_sell_column = 1;
		}

		wc_set_loop_prop( 'columns', $cross_sell_column);

		woocommerce_cross_sell_display( $limit = $cross_sell_column, $columns = $cross_sell_column, $orderby = 'rand', $order = 'desc' );

		dada_shop_cross_sell_product_style_reset_loop_prop();  /* Reset Product Style Variables Setup */

	}

	add_action( 'woocommerce_cart_collaterals', 'dada_shop_cross_sell_display', 15 );

}


/*
 * Reset Loop Prop
 */

if( ! function_exists( 'dada_shop_cross_sell_product_style_reset_loop_prop' ) ) {

	function dada_shop_cross_sell_product_style_reset_loop_prop() {

		$dada_shop_loop_prop = wc_get_loop_prop('wdt-shop-loop-prop', array ());

		if( is_array($dada_shop_loop_prop) && !empty($dada_shop_loop_prop) ) {
			foreach( $dada_shop_loop_prop as $loop_prop ) {
				unset($GLOBALS['woocommerce_loop'][$loop_prop]);
			}
		}

		unset($GLOBALS['woocommerce_loop']['columns']);
		unset($GLOBALS['woocommerce_loop']['wdt-shop-loop-prop']);

	}

}


/*
 * Cross Sell Heading
 */

if( ! function_exists( 'dada_shop_cross_sells_products_heading' ) ) {

	function dada_shop_cross_sells_products_heading($heading) {

        if( !function_exists( 'dada_pro' ) ) {
            return $heading; // If Theme-Plugin is not activated
        }

		$title = dada_customizer_settings( 'wdt-woo-cross-sell-title' );
		$heading = ( isset($title) && !empty($title) ) ? $title : $heading;

		return $heading;

	}

	add_filter( 'woocommerce_product_cross_sells_products_heading', 'dada_shop_cross_sells_products_heading', 1 );

}