<?php

/**
 * WooCommerce - Single - Module - 360 Viewer - Customizer Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'Dada_Shop_Customizer_Others_Size_Guide' ) ) {

    class Dada_Shop_Customizer_Others_Size_Guide {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            add_filter( 'dada_woo_single_page_settings', array( $this, 'single_page_settings' ), 10, 1 );
            add_action( 'customize_register', array( $this, 'register' ), 15);

        }

        function single_page_settings( $settings ) {

            $product_enable_size_guide                 = dada_customizer_settings('wdt-single-product-enable-size-guide' );
            $settings['product_enable_size_guide']     = $product_enable_size_guide;

            return $settings;

        }

        function register( $wp_customize ) {

            /**
            * Option : Enable Size Guide Button
            */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[wdt-single-product-enable-size-guide]', array(
                        'type' => 'option'
                    )
                );

                $wp_customize->add_control(
                    new Dada_Customize_Control_Switch(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[wdt-single-product-enable-size-guide]', array(
                            'type'    => 'wdt-switch',
                            'label'   => esc_html__( 'Enable Size Guide Button', 'dada-pro'),
                            'section' => 'woocommerce-single-page-default-section',
                            'choices' => array(
                                'on'  => esc_attr__( 'Yes', 'dada-pro' ),
                                'off' => esc_attr__( 'No', 'dada-pro' )
                            ),
                            'description'   => esc_html__('This option is applicable only for "WooCommerce Default" single page.', 'dada-pro'),
                        )
                    )
                );

        }

    }

}


if( !function_exists('dada_shop_customizer_others_size_guide') ) {
	function dada_shop_customizer_others_size_guide() {
		return Dada_Shop_Customizer_Others_Size_Guide::instance();
	}
}

dada_shop_customizer_others_size_guide();