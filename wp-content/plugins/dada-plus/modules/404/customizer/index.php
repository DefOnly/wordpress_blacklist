<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPlusCustomizerSite404' ) ) {
    class DadaPlusCustomizerSite404 {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            add_action( 'customize_register', array( $this, 'register' ), 15);
        }

        function register( $wp_customize ) {

            /**
             * 404 Page
             */
            $wp_customize->add_section(
                new Dada_Customize_Section(
                    $wp_customize,
                    'site-404-page-section',
                    array(
                        'title'    => esc_html__('404 Page', 'dada-plus'),
                        'priority' => dada_customizer_panel_priority( '404' )
                    )
                )
            );

            if ( ! defined( 'DADA_PRO_VERSION' ) ) {
                $wp_customize->add_control(
                    new Dada_Customize_Control_Separator(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[dada-plus-site-404-separator]',
                        array(
                            'type'        => 'wdt-separator',
                            'section'     => 'site-404-page-section',
                            'settings'    => array(),
                            'caption'     => DADA_PLUS_REQ_CAPTION,
                            'description' => DADA_PLUS_REQ_DESC,
                        )
                    )
                );
            }

        }

    }
}

DadaPlusCustomizerSite404::instance();