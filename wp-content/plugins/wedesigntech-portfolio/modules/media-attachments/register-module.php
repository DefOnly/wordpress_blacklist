<?php

if (!class_exists ( 'WDTPortfolioRegisterMediaAttachmentsModule' )) {

	class WDTPortfolioRegisterMediaAttachmentsModule extends WDTPortfolioAddon {

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

			$this->wdt_define_constants( 'WDT_MATTACHMENTS_PLUGIN_PATH', WDT_PLUGIN_PATH . 'modules/media-attachments/' );
			$this->wdt_define_constants( 'WDT_MATTACHMENTS_PLUGIN_URL', WDT_PLUGIN_URL . 'modules/media-attachments/' );

			add_filter ( 'wdt_metabox_tabs', array ( $this, 'wdt_metabox_tabs_tab' ) );

			add_action ( 'admin_enqueue_scripts', array ( $this, 'wdt_admin_enqueue_scripts' ), 120 );
			add_action ( 'wp_enqueue_scripts', array ( $this, 'wdt_enqueue_scripts' ), 20 );

			add_action ( 'wdt_addorupdate_listing_module', array ( $this, 'wdt_addorupdate_listing_mediaattachments_module' ), 10, 2 );

			require_once WDT_MATTACHMENTS_PLUGIN_PATH . 'utils.php';
			require_once WDT_MATTACHMENTS_PLUGIN_PATH . 'shortcodes.php';

		}

		function wdt_metabox_tabs_tab($tabs) {

			$tabs['media-attachments'] = array (
				'label' => esc_html__('Media - Attachments','wdt-portfolio'),
				'icon'  => 'fas fa-camera-retro',
				'path'  => WDT_MATTACHMENTS_PLUGIN_PATH . 'metabox-tab-listing.php'
			);

			return $tabs;

		}

		function wdt_admin_enqueue_scripts() {

			$this->wdt_register_dependent_files();

			$current_screen = get_current_screen();
			if($current_screen->id == 'wdt_listings') {
				wp_enqueue_style ( 'wdt-media-attachments-fields' );
				wp_enqueue_script ( 'wdt-media-attachments-fields' );
			}

		}

		function wdt_enqueue_scripts() {

			$this->wdt_register_dependent_files();
			$this->wdt_enqueue_registered_files();

		}

		function wdt_register_dependent_files() {

			wp_register_style ( 'wdt-media-attachments-frontend', WDT_MATTACHMENTS_PLUGIN_URL . 'assets/media-attachments-frontend.css', array ( 'fontawesome', 'icon-moon', 'material-icon', 'wdt-base', 'wdt-common', 'swiper' ) );
			wp_register_script ( 'wdt-media-attachments-fields', WDT_MATTACHMENTS_PLUGIN_URL . 'assets/fields.js', array ('jquery', 'wdt-fields'), false, true );

		}

		function wdt_enqueue_registered_files() {

			wp_enqueue_style ( 'wdt-media-attachments-frontend' );

		}

		function wdt_addorupdate_listing_mediaattachments_module($data, $listing_id) {

			extract($data);

			update_post_meta($listing_id, 'wdt_media_attachments_titles', $wdt_media_attachments_titles);
			update_post_meta($listing_id, 'wdt_media_attachments_items', $wdt_media_attachments_items);

		}

	}

}

if( !function_exists('wdtMediaAttachmentsModule') ) {
	function wdtMediaAttachmentsModule() {
		return WDTPortfolioRegisterMediaAttachmentsModule::instance();
	}
}

wdtMediaAttachmentsModule();

?>