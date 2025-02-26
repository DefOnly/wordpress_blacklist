<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPro404Loader' ) ) {
    class DadaPro404Loader {
        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

            add_filter( 'dada_404_page_params', array( $this, 'page_404_customizer_params' ) );

            $page_id = dada_customizer_settings( 'notfound_pageid' );
            if( !empty( $page_id )  ) {
                add_filter( 'dada_404_get_template_part', array( $this, 'load_template' ), 11 );
            }
        }

        function page_404_customizer_params() {
            $page_id           = dada_customizer_settings('notfound_pageid' );
            $enable_404message = dada_customizer_settings('enable_404message');
            $notfound_style    = dada_customizer_settings('notfound_style');
            $notfound_darkbg   = dada_customizer_settings('notfound_darkbg');
            $notfound_bg       = dada_customizer_settings('notfound_background' );
            $notfound_bg_style = dada_customizer_settings('notfound_bg_style' );

            return array(
                'page_id'           => $page_id,
                'enable_404message' => $enable_404message,
                'notfound_style'    => $notfound_style,
                'notfound_darkbg'   => $notfound_darkbg,
                'notfound_bg'       => $notfound_bg,
                'notfound_bg_style' => $notfound_bg_style,
            );
        }

        function load_template() {

            $param = $this->page_404_customizer_params();
            return dada_get_template_part( '404', 'layouts/custom-page', '', $param );

        }
    }
}

DadaPro404Loader::instance();