<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPlusBreadCrumbColor' ) ) {
    class DadaPlusBreadCrumbColor {

        private static $_instance = null;
        private $settings         = null;
        private $selector         = null;

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

            $wp_customize->add_section(
                new Dada_Customize_Section(
                    $wp_customize,
                    'site-breadcrumb-color-section',
                    array(
                        'title'    => esc_html__('Colors & Background', 'dada-plus'),
                        'panel'    => 'site-breadcrumb-main-panel',
                        'priority' => 10,
                    )
                )
            );

            if ( ! defined( 'DADA_PRO_VERSION' ) ) {
                $wp_customize->add_control(
                    new Dada_Customize_Control_Separator(
                        $wp_customize, DADA_CUSTOMISER_VAL . '[dada-plus-site-breadcrumb-color-separator]',
                        array(
                            'type'        => 'wdt-separator',
                            'section'     => 'site-breadcrumb-color-section',
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

DadaPlusBreadCrumbColor::instance();