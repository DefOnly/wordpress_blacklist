<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaProCursor' ) ) {
    class DadaProCursor {

        private static $_instance = null;

        private $enable_cursor_effect = false;
        private $cursor_type = 'type-1';
        private $cursor_link_hover_effect = '';
        private $cursor_lightbox_hover_effect = '';

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            $this->enable_cursor_effect = dada_customizer_settings( 'enable_cursor_effect' );
            $this->cursor_type = dada_customizer_settings( 'cursor_type' );
            $this->cursor_link_hover_effect = dada_customizer_settings( 'cursor_link_hover_effect' );
            $this->cursor_lightbox_hover_effect = dada_customizer_settings( 'cursor_lightbox_hover_effect' );
            $this->load_modules();
            $this->frontend();
        }

        function load_modules() {
            include_once DADA_PRO_DIR_PATH.'modules/cursor/customizer/index.php';

        }

        function frontend() {
            $dark_mode_enabled = dada_customizer_settings('enable_dark_mode');
            if($this->enable_cursor_effect) 
            {
                    add_action( 'dada_after_main_css', array( $this, 'enqueue_assets' ) );
                    add_action( 'dada_hook_top', array( $this, 'load_template' ) );
            }
           if($dark_mode_enabled ==1)
           {
                add_action( 'dada_hook_top', array( $this, 'load_template_darkmode' ) );
                add_action( 'dada_after_main_css', array( $this, 'enqueue_assets' ) );
                add_action( 'wp_enqueue_scripts', array( $this, 'dark_theme_enqueue_scripts' ));
           }
        }
        function dark_theme_enqueue_scripts() {
            // Register the script
            wp_register_script( 'dark-mode', DADA_PRO_DIR_URL . 'modules/cursor/assets/js/dark-mode.js', array( 'jquery' ), '1.0.0', true );
            // Enqueue the script
            wp_enqueue_script( 'dark-mode' );
        }
        function enqueue_assets() {
            if($this->enable_cursor_effect) {
                wp_enqueue_style( 'dada-cursor', DADA_PRO_DIR_URL . 'modules/cursor/assets/css/cursor.css', false, DADA_PRO_VERSION, 'all');
                wp_enqueue_script( 'dada-cursor', DADA_PRO_DIR_URL . 'modules/cursor/assets/js/cursor.js', array('jquery'), DADA_PRO_VERSION, true );
                wp_localize_script('dada-cursor', 'wdtCursorObjects', array (
                    'enableCursorEffect' => $this->enable_cursor_effect
                ));
            }
            $dark_mode_enabled = dada_customizer_settings('enable_dark_mode');
            if($dark_mode_enabled ==1)
            {
                wp_enqueue_style( 'dada-cursor', DADA_PRO_DIR_URL . 'modules/cursor/assets/css/dark-mode.css', false, DADA_PRO_VERSION, 'all');
            }
        }

        function load_template() {
            echo '<div class="wdt-cursor-wrapper '.esc_attr($this->cursor_type).' '.esc_attr($this->cursor_link_hover_effect).' '.esc_attr($this->cursor_lightbox_hover_effect).'">
                    <div class="wdt-cursor wdt-cursor-outer"></div>
                    <div class="wdt-cursor wdt-cursor-inner"></div>
                </div>';
        }
        function load_template_darkmode()
        {
            include_once DADA_PRO_DIR_PATH.'modules/cursor/layout/template.php';
        }

    }
}

DadaProCursor::instance();
