<?php

if (!class_exists ( 'WDTPortfolioRegisterBusinessHoursModule' )) {

	class WDTPortfolioRegisterBusinessHoursModule extends WDTPortfolioAddon {

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

			$this->wdt_define_constants( 'WDT_BHOURS_PLUGIN_PATH', WDT_PLUGIN_PATH . 'modules/business-hours/' );
			$this->wdt_define_constants( 'WDT_BHOURS_PLUGIN_URL', WDT_PLUGIN_URL . 'modules/business-hours/' );

			add_filter ( 'wdt_metabox_tabs', array ( $this, 'wdt_metabox_tabs_tab' ) );

			add_action ( 'admin_enqueue_scripts', array ( $this, 'wdt_admin_enqueue_scripts' ), 120 );
			add_action ( 'wp_enqueue_scripts', array ( $this, 'wdt_enqueue_scripts' ), 20 );

			add_action ( 'wdt_addorupdate_listing_module', array ( $this, 'wdt_addorupdate_listing_businesshours_module' ), 10, 2 );

			require_once WDT_BHOURS_PLUGIN_PATH . 'shortcodes.php';
			require_once WDT_BHOURS_PLUGIN_PATH . 'utils.php';

		}

		function wdt_metabox_tabs_tab($tabs) {

			$tabs['business-hours'] = array (
				'label' => esc_html__('Business Hours','wdt-portfolio'),
				'icon' => 'fas fa-clock',
				'path' => WDT_BHOURS_PLUGIN_PATH . 'metabox-tab-listing.php'
			);

			return $tabs;

		}

		function wdt_admin_enqueue_scripts() {

			$this->wdt_register_dependent_files();

			$current_screen = get_current_screen();
			if($current_screen->id == 'wdt_listings') {
				wp_enqueue_style ( 'wdt-business-hours-fields' );
			}

		}

		function wdt_enqueue_scripts() {

			$this->wdt_register_dependent_files();
			$this->wdt_enqueue_registered_files();

		}

		function wdt_register_dependent_files() {

			wp_register_style ( 'wdt-business-hours-fields', WDT_BHOURS_PLUGIN_URL . 'assets/business-hours-fields.css', array ( 'wdt-fields' ) );
			wp_register_style ( 'wdt-business-hours-frontend', WDT_BHOURS_PLUGIN_URL . 'assets/business-hours-frontend.css', array ( 'fontawesome', 'icon-moon', 'material-icon', 'wdt-base', 'wdt-common', 'swiper' ) );

		}

		function wdt_enqueue_registered_files() {

			wp_enqueue_style ( 'wdt-business-hours-frontend' );

		}

		function wdt_addorupdate_listing_businesshours_module($data, $listing_id) {

			extract($data);

			update_post_meta($listing_id, 'wdt_business_hours', $wdt_business_hours);
			update_post_meta($listing_id, 'wdt_business_hours_24hour_format', $wdt_business_hours_24hour_format);

		}

	}

}

if( !function_exists('wdtBusinessHoursModule') ) {
	function wdtBusinessHoursModule() {
		return WDTPortfolioRegisterBusinessHoursModule::instance();
	}
}

wdtBusinessHoursModule();

?>