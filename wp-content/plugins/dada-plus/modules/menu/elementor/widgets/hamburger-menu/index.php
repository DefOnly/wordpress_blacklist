<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPlusHeaderHamburgerMenuWidget' ) ) {
    class DadaPlusHeaderHamburgerMenuWidget {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
            add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_widget_styles' ) );
            add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_widget_scripts' ) );
            add_action( 'elementor/preview/enqueue_styles', array( $this, 'register_preview_styles') );
        }

        function register_widget_styles() {
           
            wp_register_style( 'wdt-hamburger-menu',
                DADA_PLUS_DIR_URL . 'modules/menu/elementor/widgets/assets/css/hamburger-menu.css', array(), DADA_PLUS_VERSION );
                
        }

        function register_widget_scripts() {
            wp_register_script( 'wdt-hamburger-menu',
                DADA_PLUS_DIR_URL . 'modules/menu/elementor/widgets/assets/js/hamburger-menu.js', array(), DADA_PLUS_VERSION, true );
        
        }

        function register_preview_styles() {
            wp_enqueue_style( 'wdt-hamburger-menu' );
            wp_enqueue_script( 'wdt-hamburger-menu' );
        }

        function register_widgets( $widgets_manager ) {
            require DADA_PLUS_DIR_PATH. 'modules/menu/elementor/widgets/hamburger-menu/class-widget-hamburger-header-menu.php';
            $widgets_manager->register( new \Elementor_Hamburger_Header_Menu() );
        }
    }
}

DadaPlusHeaderHamburgerMenuWidget::instance();