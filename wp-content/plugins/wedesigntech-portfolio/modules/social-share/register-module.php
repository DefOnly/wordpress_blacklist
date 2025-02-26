<?php

if (!class_exists ( 'WDTPortfolioRegisterSocialShareModule' )) {

	class WDTPortfolioRegisterSocialShareModule extends WDTPortfolioAddon {

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

			$this->wdt_define_constants( 'WDT_SOCIALSHARE_PLUGIN_PATH', WDT_PLUGIN_PATH . 'modules/social-share/' );
			$this->wdt_define_constants( 'WDT_SOCIALSHARE_PLUGIN_URL', WDT_PLUGIN_URL . 'modules/social-share/' );

			add_action ( 'wp_enqueue_scripts', array ( $this, 'wdt_enqueue_scripts' ), 20 );

			require_once WDT_SOCIALSHARE_PLUGIN_PATH . 'shortcodes.php';

		}

		function wdt_enqueue_scripts() {
			$this->wdt_register_dependent_files();
			$this->wdt_enqueue_registered_files();
		}

		function wdt_register_dependent_files() {

			wp_register_style ( 'wdt-social-share-frontend', WDT_SOCIALSHARE_PLUGIN_URL . 'assets/social-share-frontend.css', array ( 'fontawesome', 'icon-moon', 'material-icon', 'wdt-base', 'wdt-common' ) );
			wp_register_script ( 'wdt-social-share-frontend', WDT_SOCIALSHARE_PLUGIN_URL . 'assets/frontend.js', array ('jquery', 'wdt-common'), false, true );

		}

		function wdt_enqueue_registered_files() {

			wp_enqueue_style ( 'wdt-social-share-frontend' );
			wp_enqueue_script ( 'wdt-social-share-frontend' );

		}

	}

}

if( !function_exists('wdtSocialShareModule') ) {
	function wdtSocialShareModule() {
		return WDTPortfolioRegisterSocialShareModule::instance();
	}
}

wdtSocialShareModule();

?>