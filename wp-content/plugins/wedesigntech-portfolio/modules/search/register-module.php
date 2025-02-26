<?php

if (!class_exists ( 'WDTPortfolioRegisterSearchModule' )) {

	class WDTPortfolioRegisterSearchModule extends WDTPortfolioAddon {

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

			$this->wdt_define_constants( 'WDT_SEARCH_PLUGIN_PATH', WDT_PLUGIN_PATH . 'modules/search/' );
			$this->wdt_define_constants( 'WDT_SEARCH_PLUGIN_URL', WDT_PLUGIN_URL . 'modules/search/' );

			$this->wdt_define_constants( 'WDT_PB_MODULE_SEARCHFORM_TITLE', sprintf( esc_html__('%1$s - Search Form','wdt-portfolio'), WDT_PLUGIN_NAME ) );

			add_action ( 'wp_enqueue_scripts', array ( $this, 'wdt_enqueue_scripts' ), 20 );

			require_once WDT_SEARCH_PLUGIN_PATH . 'shortcodes.php';

		}

		function wdt_enqueue_scripts() {

			$this->wdt_register_dependent_files();
			$this->wdt_enqueue_registered_files();

		}

		function wdt_register_dependent_files() {

			wp_register_style ( 'wdt-search-frontend', WDT_SEARCH_PLUGIN_URL . 'assets/search-frontend.css', array ( 'fontawesome', 'icon-moon', 'material-icon', 'wdt-base', 'wdt-common', 'wdt-fields' ) );
			wp_register_script ( 'wdt-search-frontend', WDT_SEARCH_PLUGIN_URL . 'assets/frontend.js', array ('jquery', 'wdt-frontend'), false, true );

		}

		function wdt_enqueue_registered_files() {

			//wp_enqueue_style ( 'jquery-ui' );
			wp_enqueue_style ( 'chosen' );
			wp_enqueue_style ( 'wdt-search-frontend' );

			wp_enqueue_script ( 'jquery-ui-slider' );
			wp_enqueue_script ( 'chosen' );
			wp_enqueue_script ( 'jquery-ui-datepicker' );
			wp_enqueue_script ( 'wdt-search-frontend' );
		}

	}

}

if( !function_exists('wdtSearchModule') ) {
	function wdtSearchModule() {
		return WDTPortfolioRegisterSearchModule::instance();
	}
}

wdtSearchModule();

?>