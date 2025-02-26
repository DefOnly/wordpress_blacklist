<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaPlusSiteShareIcons' ) ) {
    class DadaPlusSiteShareIcons {

        private static $_instance = null;

        private $follow_us_link = false;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
            $this->follow_us_link = dada_customizer_settings('show_follow_us_icons');
            $this->load_modules();
            $this->frontend();
        }

        function load_modules() {
            include_once DADA_PLUS_DIR_PATH.'modules/site-share-icons/customizer/index.php';
        }

        function frontend() {
            if( $this->follow_us_link ) {
                add_action( 'dada_after_main_css', array( $this, 'enqueue_assets' ) );
                add_action( 'wp_footer', array( $this, 'load_template' ), 999 );
            }
        }

        function enqueue_assets() {
            wp_enqueue_style( 'site-share-icons-style', DADA_PLUS_DIR_URL . 'modules/site-share-icons/assets/css/style.css', false, DADA_PLUS_VERSION, 'all' );
        }

        function load_template() {
            if($this->follow_us_link) {
                echo dada_get_template_part( 'site-share-icons/layouts', '/template', '', array() );
            }
        }
    }
}

DadaPlusSiteShareIcons::instance();