<?php

if (!class_exists ( 'WDTPortfolioRegisterCommentsModule' )) {

	class WDTPortfolioRegisterCommentsModule extends WDTPortfolioAddon {

		private $module_name;
		private $module_url;

		/**
		 * Instance variable
		 */
		private static $_instance = null;

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 */
		public static function instance() {

			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		function __construct() {

			$this->wdt_define_constants( 'WDT_COMMENTS_PLUGIN_PATH', WDT_PLUGIN_PATH . 'modules/comments/' );
			$this->wdt_define_constants( 'WDT_COMMENTS_PLUGIN_URL', WDT_PLUGIN_URL . 'modules/comments/' );

			add_action ( 'admin_enqueue_scripts', array ( $this, 'wdt_admin_enqueue_scripts' ), 120 );
			add_action ( 'wp_enqueue_scripts', array ( $this, 'wdt_enqueue_scripts' ), 20 );

			require_once WDT_COMMENTS_PLUGIN_PATH . 'shortcodes.php';
			require_once WDT_COMMENTS_PLUGIN_PATH . 'utils.php';

		}

		function wdt_admin_enqueue_scripts() {

			$this->wdt_register_dependent_files();

			$current_screen = get_current_screen();
			if($current_screen->id == 'comment') {

				// CSS
				wp_enqueue_style ( 'wdt-comments-backend' );

				// JS
				wp_enqueue_script ( 'wdt-fields' );

				wp_enqueue_script ( 'wdt-common' );
				wp_enqueue_script ( 'wdt-backend' );

				wp_enqueue_script ( 'wdt-comments-common' );

			}

		}

		function wdt_enqueue_scripts() {
			$this->wdt_register_dependent_files();
			$this->wdt_enqueue_registered_files();
		}

		function wdt_register_dependent_files() {

			wp_register_style ( 'wdt-comments-backend', WDT_COMMENTS_PLUGIN_URL . 'assets/comments-backend.css', array ( 'fontawesome', 'material-icon', 'chosen', 'wdt-fields', 'wdt-backend', 'wdt-common' ) );
			wp_register_style ( 'wdt-comments-frontend', WDT_COMMENTS_PLUGIN_URL . 'assets/comments-frontend.css', array ( 'fontawesome', 'icon-moon', 'material-icon', 'wdt-base', 'wdt-common', 'wdt-modules-singlepage' ) );

			wp_register_script ( 'wdt-comments-common', WDT_COMMENTS_PLUGIN_URL . 'assets/common.js', array ( 'jquery' ), false, true );
			wp_register_script ( 'wdt-comments-frontend', WDT_COMMENTS_PLUGIN_URL . 'assets/frontend.js', array ( 'jquery', 'wdt-modules-singlepage' ), false, true );

		}

		function wdt_enqueue_registered_files() {

			wp_enqueue_style ( 'wdt-comments-frontend' );

			wp_enqueue_script ( 'wdt-comments-common' );
			wp_enqueue_script ( 'wdt-comments-frontend' );

		}

	}

}

if( !function_exists('wdtCommentsModule') ) {
	function wdtCommentsModule() {
		return WDTPortfolioRegisterCommentsModule::instance();
	}
}

wdtCommentsModule();

?>