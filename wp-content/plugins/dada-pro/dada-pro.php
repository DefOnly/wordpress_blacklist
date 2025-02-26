<?php
/**
 * Plugin Name:	Dada Pro
 * Description: Adds advanced features for Dada Theme.
 * Version: 1.0.1
 * Author: the WeDesignTech team
 * Author URI: https://wedesignthemes.com/
 * Text Domain: dada-pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPro' ) ) {
    class DadaPro {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

            $this->define_constants();

            /**
             * Before Hook
             */
            do_action( 'dada_pro_before_plugin_load' );

                $this->load_helper();
                $this->load_modules();
                $this->frontend();
                $this->load_post_types();
                $this->load_widget_area_generator();

                add_filter( 'cs_framework_settings', array ( $this, 'dada_cs_framework_settings' ) );

                add_action( 'plugins_loaded', array( $this, 'check_if_user_logged_in' ) );

            /**
             * After Hook
             */
            do_action( 'dada_pro_after_plugin_load' );
        }

        function check_if_user_logged_in() {

            $this->load_codestar();

        }

        function define_constants() {

            define( 'DADA_PRO_VERSION', '1.0.0' );
            define( 'DADA_PRO_DIR_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
            define( 'DADA_PRO_DIR_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
            if( !defined('DADA_CUSTOMISER_VAL') ) {
                define( 'DADA_CUSTOMISER_VAL', 'dada-customiser-option');
            }

        }

        function i18n() {
            add_action( 'plugins_loaded', array( $this, 'i18n' ) );
            load_plugin_textdomain( 'dada-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        }

        function load_codestar() {
            if( !defined( 'CS_OPTION' ) ) {
                define( 'CS_OPTION', '_dada_cs_options' );
            }
            define( 'WDT_CS_FOLDER_PATH', 'dada-pro' );
            require_once DADA_PRO_DIR_PATH . 'cs-framework/cs-framework.php';
        }

        function load_helper() {
            require_once DADA_PRO_DIR_PATH . 'functions.php';
        }

        function load_modules() {

            /**
             * Before Hook
             */
            do_action( 'dada_pro_before_load_modules' );

                foreach( glob( DADA_PRO_DIR_PATH. 'modules/*/index.php'  ) as $module ) {
                    include_once $module;
                }

            /**
             * After Hook
             */
            do_action( 'dada_pro_after_load_modules' );

        }

        function load_post_types() {
            require_once DADA_PRO_DIR_PATH . 'post-types/post-types.php';
        }

        function load_widget_area_generator() {
            require_once DADA_PRO_DIR_PATH . 'widget-area/widget-area.php';
        }

        function frontend() {
            add_filter( 'body_class', array( $this, 'add_body_classes' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        }

        function add_body_classes( $classes ) {
            $classes[] = 'dada-pro-'.DADA_PRO_VERSION;
            return $classes;
        }

        function enqueue_assets() {

            /**
             * Add Common css & javascript
             */

            wp_enqueue_style( 'dada-pro-widget', DADA_PRO_DIR_URL . 'assets/css/widget.css', false, DADA_PRO_VERSION, 'all');

            do_action( 'dada_pro_after_asset_enqueue' );
        }

        function dada_cs_framework_settings($settings){

	        $settings           = array(
	          'menu_title'      => esc_html__('Dada Settings', 'dada-pro'),
	          'menu_type'       => 'menu',
	          'menu_slug'       => 'dada-pro-settings',
	          'ajax_save'       => true,
	          'show_reset_all'  => false,
	          'framework_title' => esc_html__('Dada', 'dada-pro'),
	        );

            return apply_filters( 'dada_pro_cs_framework_settings', $settings );
        }

    }
}

if( !function_exists( 'dada_pro' ) ) {
    function dada_pro() {
        return DadaPro::instance();
    }
}

register_activation_hook( __FILE__, 'dada_pro_activation_hook' );
function dada_pro_activation_hook() {
    if (!class_exists ( 'DadaPlus' )) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'dada-pro' ),
            '<strong>' . esc_html__( 'Dada Pro Plugin', 'dada-pro' ) . '</strong>',
            '<strong>' . esc_html__( 'Dada Plus Plugin', 'dada-pro' ) . '</strong>'
        );
        wp_die( sprintf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message ), 'Plugin dependency check', array( 'back_link' => true ) );
    } else {
        dada_pro();

        // Updating customizer default values
        $saved_settings = get_option( DADA_CUSTOMISER_VAL );
        $saved_settings = (is_array($saved_settings) && !empty($saved_settings)) ? $saved_settings : array ();

        if(!array_key_exists('pro-settings-updated',  $saved_settings)) {
            $pro_defaults = apply_filters( 'dada_pro_customizer_default', array( 'pro-settings-updated' => true ) );
            $saved_settings = array_merge($saved_settings, $pro_defaults);
        }

        if(class_exists('WooCommerce')) {
            if(!array_key_exists('shop-pro-settings-updated',  $saved_settings)) {
                $shop_pro_defaults = apply_filters( 'dada_shop_pro_customizer_default', array( 'shop-pro-settings-updated' => true ) );
                $saved_settings = array_merge($saved_settings, $shop_pro_defaults);
            }
        }

        if(!empty($saved_settings)) {
            update_option( constant( 'DADA_CUSTOMISER_VAL' ), $saved_settings );
        }

    }
}

if (class_exists ( 'DadaPlus' ) && class_exists ( 'DadaPro' )) {
    dada_pro();
} else {
    add_action( 'admin_init', 'dada_init' );
    function dada_init() {
        deactivate_plugins( __FILE__ );
    }
}