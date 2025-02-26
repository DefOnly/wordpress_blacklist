<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (! class_exists ( 'DadaProPostTypes' )) {
	/**
	 *
	 * @author iamdesigning11
	 *
	 */
	class DadaProPostTypes {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

		function __construct() {

			// Mega Menu Post Type
			require_once DADA_PRO_DIR_PATH . 'post-types/mega-menu-post-type.php';

		}
	}
}

DadaProPostTypes::instance();