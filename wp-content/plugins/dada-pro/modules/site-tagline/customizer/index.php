<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaProCustomizerSiteTagline' ) ) {
    class DadaProCustomizerSiteTagline {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            add_action( 'customize_register', array( $this, 'register' ), 15 );
            add_filter( 'dada_google_fonts_list', array( $this, 'fonts_list' ) );
        }

        function register( $wp_customize ) {

            /**
             * Option :Site Tagline Typography
             */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[site_tagline_typo]', array(
                        'type'    => 'option',
                    )
                );

                $wp_customize->add_control(
                    new Dada_Customize_Control_Typography(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[site_tagline_typo]', array(
                            'type'    => 'wdt-typography',
                            'section' => 'site-tagline-section',
                            'label'   => esc_html__( 'Typography', 'dada-pro'),
                        )
                    )
                );


            /**
             * Option : Site Title Color
             */
                $wp_customize->add_setting(
                    DADA_CUSTOMISER_VAL . '[site_tagline_color]', array(
                        'type'    => 'option',
                    )
                );

                $wp_customize->add_control(
                    new WP_Customize_Color_Control(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[site_tagline_color]', array(
                            'label'   => esc_html__( 'Color', 'dada-pro' ),
                            'section' => 'site-tagline-section',
                        )
                    )
                );
        }

        function fonts_list( $fonts ) {
            $settings = dada_customizer_settings( 'site_tagline_typo' );
            return dada_customizer_frontend_font( $settings, $fonts );
        }

    }
}

DadaProCustomizerSiteTagline::instance();