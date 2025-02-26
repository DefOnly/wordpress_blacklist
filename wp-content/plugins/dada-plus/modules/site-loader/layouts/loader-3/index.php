<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPlusSiteLoaderThree' ) ) {
    class DadaPlusSiteLoaderThree {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            add_filter( 'dada_loader_layouts', array( $this, 'add_option' ) );

            $site_loader = dada_customizer_settings( 'site_loader' );

            if( $site_loader == 'loader-3' ) {

                add_action( 'dada_after_main_css', array( $this, 'enqueue_assets' ) );

                /**
                 * filter: dada_primary_color_style - to use primary color
                 * filter: dada_secondary_color_style - to use secondary color
                 * filter: dada_tertiary_color_style - to use tertiary color
                 */
                add_filter( 'dada_primary_color_style', array( $this, 'primary_color_css' ) );
                add_filter( 'dada_tertiary_color_style', array( $this, 'tertiary_color_style' ) );
            }

        }

        function add_option( $options ) {
            $options['loader-3'] = esc_html__('Loader 3', 'dada-plus');
            return $options;
        }

        function enqueue_assets() {
            wp_enqueue_style( 'site-loader', DADA_PLUS_DIR_URL . 'modules/site-loader/layouts/loader-3/assets/loader-3.css', false, DADA_PLUS_VERSION, 'all' );
            wp_enqueue_script( 'site-loader', DADA_PLUS_DIR_URL . 'modules/site-loader/layouts/loader-3/assets/loader-3.js', array('jquery'), DADA_PLUS_VERSION, true );
        }

        function primary_color_css( $style ) {
            $style .= ".loader3 { background-color:var( --wdtBodyBGColor );}";
            return $style;
        }

        function tertiary_color_style( $style ) {
            $style .= ".loader3:before { background-color:var( --wdtTertiaryColor );}";
            return $style;
        }
    }
}

DadaPlusSiteLoaderThree::instance();